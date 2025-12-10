<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_model extends CI_Model
{
    protected $table = 'penjualan';
    protected $detailTable = 'detail_penjualan';
    protected $primaryKey = 'id_penjualan';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_model');
    }

    public function get($id)
    {
        return $this->db->select('penjualan.*, user_account.full_name as kasir_name')
                        ->join('user_account', 'user_account.id_user = penjualan.id_user', 'left')
                        ->where('penjualan.'.$this->primaryKey, $id)
                        ->get($this->table)
                        ->row();
    }

    public function get_details($penjualan_id)
    {
        return $this->db->select('detail_penjualan.*, barang.nama_barang, barang.satuan')
                        ->join('barang', 'barang.id_barang = detail_penjualan.id_barang', 'left')
                        ->where('detail_penjualan.id_penjualan', $penjualan_id)
                        ->get($this->detailTable)
                        ->result();
    }

    public function get_today($user_id = null)
    {
        $this->db->select('penjualan.*, user_account.full_name as kasir_name');
        $this->db->join('user_account', 'user_account.id_user = penjualan.id_user', 'left');
        $this->db->where('DATE(tanggal)', date('Y-m-d'));
        if ($user_id) {
            $this->db->where('penjualan.id_user', $user_id);
        }
        return $this->db->order_by('tanggal', 'DESC')->get($this->table)->result();
    }

    public function get_between($start, $end)
    {
        return $this->db->select('penjualan.*, user_account.full_name as kasir_name')
                        ->join('user_account', 'user_account.id_user = penjualan.id_user', 'left')
                        ->where('DATE(tanggal) >=', $start)
                        ->where('DATE(tanggal) <=', $end)
                        ->order_by('tanggal', 'DESC')
                        ->get($this->table)
                        ->result();
    }

    public function get_between_kasir($start, $end, $user_id)
    {
        return $this->db->select('penjualan.*, user_account.full_name as kasir_name')
                        ->join('user_account', 'user_account.id_user = penjualan.id_user', 'left')
                        ->where('DATE(tanggal) >=', $start)
                        ->where('DATE(tanggal) <=', $end)
                        ->where('penjualan.id_user', $user_id)
                        ->order_by('tanggal', 'DESC')
                        ->get($this->table)
                        ->result();
    }

    public function create($data, $items)
    {
        $this->db->trans_start();
        $data['tanggal'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table, $data);
        $penjualan_id = $this->db->insert_id();

        foreach ($items as $item) {
            $detail = array(
                'id_penjualan' => $penjualan_id,
                'id_barang' => $item['barang_id'],
                'harga_saat_transaksi' => $item['harga'],
                'jumlah' => $item['qty'],
                'subtotal' => $item['subtotal'],
            );
            $this->db->insert($this->detailTable, $detail);
            $this->Barang_model->decrease_stock($item['barang_id'], $item['qty']);
        }

        $this->db->trans_complete();

        if (!$this->db->trans_status()) {
            throw new Exception('Gagal menyimpan transaksi penjualan');
        }

        return $penjualan_id;
    }

    public function get_total_today()
    {
        $row = $this->db->select_sum('total')
                        ->where('DATE(tanggal)', date('Y-m-d'))
                        ->get($this->table)
                        ->row();
        return $row ? (float) $row->total : 0;
    }

    public function get_total_transactions_today()
    {
        return $this->db->where('DATE(tanggal)', date('Y-m-d'))
                        ->count_all_results($this->table);
    }

    public function get_chart_data($days = 7)
    {
        $start = date('Y-m-d', strtotime('-'.($days - 1).' days'));
        $rows = $this->db->select('DATE(tanggal) as tgl, SUM(total) as total')
                         ->where('DATE(tanggal) >=', $start)
                         ->group_by('DATE(tanggal)')
                         ->order_by('tgl', 'ASC')
                         ->get($this->table)
                         ->result();

        $data = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $day = date('Y-m-d', strtotime('-'.$i.' days'));
            $data[$day] = 0;
        }

        foreach ($rows as $row) {
            $data[$row->tgl] = (float) $row->total;
        }

        return $data;
    }
}
