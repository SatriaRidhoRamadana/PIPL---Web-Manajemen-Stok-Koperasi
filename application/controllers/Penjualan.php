<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        require_login();
        check_role('kasir');
        $this->load->model(array('Penjualan_model', 'Barang_model'));
    }

    public function index()
    {
        $start = $this->input->get('start_date') ?: date('Y-m-d', strtotime('-30 days'));
        $end = $this->input->get('end_date') ?: date('Y-m-d');
        $data = array(
            'title' => 'Riwayat Penjualan',
            'penjualan' => $this->Penjualan_model->get_between_kasir($start, $end, current_user('user_id')),
            'start_date' => $start,
            'end_date' => $end,
        );
        $this->render('penjualan/index', $data);
    }

    public function create()
    {
        $data = array(
            'title' => 'Transaksi Penjualan',
            'barang' => $this->Barang_model->get_all(),
        );
        $this->render('penjualan/form', $data);
    }

    public function store()
    {
        $barang_ids = $this->input->post('barang_id');
        $qtys = $this->input->post('qty');
        $this->form_validation->set_rules('bayar', 'Uang Bayar', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', strip_tags(validation_errors()));
            return redirect('penjualan/create');
        }

        if (!$barang_ids || !$qtys) {
            $this->session->set_flashdata('error', 'Silakan pilih minimal 1 barang');
            return redirect('penjualan/create');
        }

        $items = array();
        $total = 0;

        foreach ($barang_ids as $index => $barang_id) {
            $barang_id = (int) $barang_id;
            $qty = isset($qtys[$index]) ? (int) $qtys[$index] : 0;
            if (!$barang_id || $qty <= 0) {
                continue;
            }

            $barang = $this->Barang_model->get($barang_id);
            if (!$barang) {
                continue;
            }

            $harga = (float) $barang->harga;
            $subtotal = $harga * $qty;
            $total += $subtotal;

            $items[] = array(
                'barang_id' => $barang_id,
                'harga' => $harga,
                'qty' => $qty,
                'subtotal' => $subtotal,
            );
        }

        if (empty($items)) {
            $this->session->set_flashdata('error', 'Tidak ada item valid dalam transaksi');
            return redirect('penjualan/create');
        }

        $bayar = (int) $this->input->post('bayar');
        if ($bayar < $total) {
            $this->session->set_flashdata('error', 'Uang bayar kurang dari total belanja');
            return redirect('penjualan/create');
        }

        $data = array(
            'kode_penjualan' => 'PJ'.date('YmdHis'),
            'id_user' => current_user('user_id'),
            'total' => $total,
            'bayar' => $bayar,
            'kembali' => $bayar - $total,
        );

        try {
            $penjualan_id = $this->Penjualan_model->create($data, $items);
        } catch (Exception $e) {
            $this->session->set_flashdata('error', $e->getMessage());
            return redirect('penjualan/create');
        }

        redirect('penjualan/show/'.$penjualan_id);
    }

    public function show($id)
    {
        $penjualan = $this->Penjualan_model->get($id);
        if (!$penjualan) {
            show_404();
        }

        $data = array(
            'title' => 'Detail Penjualan',
            'penjualan' => $penjualan,
            'detail' => $this->Penjualan_model->get_details($id),
        );
        $this->render('penjualan/show', $data);
    }
}

