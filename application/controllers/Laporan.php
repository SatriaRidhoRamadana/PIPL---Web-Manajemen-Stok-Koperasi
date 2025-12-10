<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        require_login();
        $this->load->model(array('Penjualan_model', 'Pembelian_model', 'Barang_model'));
    }

    public function penjualan()
    {
        check_role(array('admin', 'owner'));
        $start = $this->input->get('start_date') ?: date('Y-m-01');
        $end = $this->input->get('end_date') ?: date('Y-m-d');

        $penjualan = $this->Penjualan_model->get_between($start, $end);
        
        // Hitung analisis
        $total_transaksi = count($penjualan);
        $total_omzet = 0;
        $total_uang_masuk = 0;
        foreach ($penjualan as $p) {
            $total_omzet += $p->total;
            $total_uang_masuk += $p->bayar;
        }
        
        $data = array(
            'title' => 'Laporan Penjualan',
            'penjualan' => $penjualan,
            'start_date' => $start,
            'end_date' => $end,
            'total_transaksi' => $total_transaksi,
            'total_omzet' => $total_omzet,
            'total_uang_masuk' => $total_uang_masuk,
            'rata_transaksi' => $total_transaksi > 0 ? $total_omzet / $total_transaksi : 0,
        );
        $this->render('laporan/penjualan', $data);
    }

    public function stok()
    {
        check_role(array('admin', 'owner'));
        $data = array(
            'title' => 'Laporan Stok Barang',
            'barang' => $this->Barang_model->get_all(),
        );
        $this->render('laporan/stok', $data);
    }

    public function pembelian()
    {
        check_role(array('admin', 'owner'));
        $start = $this->input->get('start_date') ?: date('Y-m-01');
        $end = $this->input->get('end_date') ?: date('Y-m-d');

        $data = array(
            'title' => 'Laporan Pembelian',
            'pembelian' => $this->Pembelian_model->get_between($start, $end),
            'start_date' => $start,
            'end_date' => $end,
        );
        $this->render('laporan/pembelian', $data);
    }

    public function penjualan_harian()
    {
        check_role('kasir');
        $start = $this->input->get('start_date') ?: date('Y-m-d', strtotime('-30 days'));
        $end = $this->input->get('end_date') ?: date('Y-m-d');
        $data = array(
            'title' => 'Laporan Penjualan',
            'penjualan' => $this->Penjualan_model->get_between_kasir($start, $end, current_user('user_id')),
            'start_date' => $start,
            'end_date' => $end,
        );
        $this->render('laporan/penjualan_kasir', $data);
    }
}


