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
            $data = array(
                'title' => 'Dashboard Kasir',
                'transactions' => $this->Penjualan_model->get_today(current_user('user_id')),
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
            'low_stock' => $this->Barang_model->get_low_stock(),
            'chart_data' => $this->Penjualan_model->get_chart_data(7),
        );

        $this->render('dashboard/index', $data);
    }
}

