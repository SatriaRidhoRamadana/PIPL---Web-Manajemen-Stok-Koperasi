<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian_model extends CI_Model
{
    protected $table = 'pembelian';
    protected $detailTable = 'detail_pembelian';
    protected $primaryKey = 'id_pembelian';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_model');
    }

    public function get($id)
    {
        return $this->db->where($this->primaryKey, $id)->get($this->table)->row();
    }

    public function get_details($pembelian_id)
    {
        return $this->db->select('detail_pembelian.*, barang.nama_barang, barang.satuan')
                        ->join('barang', 'barang.id_barang = detail_pembelian.id_barang', 'left')
                        ->where('detail_pembelian.id_pembelian', $pembelian_id)
                        ->get($this->detailTable)
                        ->result();
    }

    public function get_between($start, $end)
    {
        return $this->db->where('DATE(tanggal) >=', $start)
                        ->where('DATE(tanggal) <=', $end)
                        ->order_by('tanggal', 'DESC')
                        ->get($this->table)
                        ->result();
    }

    public function create($data, $items)
    {
        $this->db->trans_start();
        $data['tanggal'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table, $data);
        $pembelian_id = $this->db->insert_id();

        foreach ($items as $item) {
            $detail = array(
                'id_pembelian' => $pembelian_id,
                'id_barang' => $item['barang_id'],
                'harga_beli' => $item['harga'],
                'jumlah' => $item['qty'],
                'subtotal' => $item['subtotal'],
            );
            $this->db->insert($this->detailTable, $detail);
            $this->Barang_model->increase_stock($item['barang_id'], $item['qty']);
        }

        $this->db->trans_complete();

        if (!$this->db->trans_status()) {
            throw new Exception('Gagal menyimpan pembelian');
        }

        return $pembelian_id;
    }
}
