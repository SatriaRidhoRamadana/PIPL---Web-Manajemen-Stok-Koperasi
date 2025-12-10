<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        require_login();
        $this->load->model(array('Barang_model', 'Penjualan_model'));
    }

    public function index()
    {
        $role = current_user('role');

        if ($role === 'kasir') {
            check_role('kasir');
            $start = $this->input->get('start_date') ?: date('Y-m-d', strtotime('-30 days'));
            $end = $this->input->get('end_date') ?: date('Y-m-d');
            $transactions = $this->Penjualan_model->get_between_kasir($start, $end, current_user('user_id'));

            $total_transaksi = count($transactions);
            $total_omzet = 0;
            foreach ($transactions as $trx) {
                $total_omzet += $trx->total;
            }

            $data = array(
                'title' => 'Dashboard Kasir',
                'transactions' => $transactions,
                'start_date' => $start,
                'end_date' => $end,
                'total_transaksi' => $total_transaksi,
                'total_omzet' => $total_omzet,
                'rata_transaksi' => $total_transaksi > 0 ? $total_omzet / $total_transaksi : 0,
            );
            $this->render('dashboard/kasir', $data);
            return;
        }

        check_role(array('admin', 'owner'));
        $data = array(
            'title' => 'Dashboard',
            'total_barang' => $this->db->count_all('barang'),
            'total_transaksi' => $this->Penjualan_model->get_total_transactions_today(),
            'omzet_hari_ini' => $this->Penjualan_model->get_total_today(),
            // low stock threshold set to 10
            'low_stock' => $this->Barang_model->get_low_stock(10, 10),
            'chart_data' => $this->Penjualan_model->get_chart_data(7),
        );

        $this->render('dashboard/index', $data);
    }
}

