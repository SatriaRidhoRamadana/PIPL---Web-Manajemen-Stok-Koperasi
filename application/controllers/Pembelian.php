<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        require_login();
        check_role('admin');
        $this->load->model(array('Pembelian_model', 'Barang_model'));
    }

    public function index()
    {
        $data = array(
            'title' => 'Riwayat Pembelian',
            'pembelian' => $this->db->order_by('tanggal', 'DESC')->get('pembelian')->result(),
        );
        $this->render('pembelian/index', $data);
    }

    public function create()
    {
        $data = array(
            'title' => 'Pembelian / Restock',
            'barang' => $this->Barang_model->get_all(),
        );
        $this->render('pembelian/form', $data);
    }

    public function store()
    {
        $barang_ids = $this->input->post('barang_id');
        $qtys = $this->input->post('qty');
        $prices = $this->input->post('harga');

        if (!$barang_ids || !$qtys || !$prices) {
            $this->session->set_flashdata('error', 'Silakan input minimal satu barang');
            return redirect('pembelian/create');
        }

        $items = array();
        $total = 0;

        foreach ($barang_ids as $index => $barang_id) {
            $barang_id = (int) $barang_id;
            $qty = isset($qtys[$index]) ? (int) $qtys[$index] : 0;
            $harga = isset($prices[$index]) ? (int) $prices[$index] : 0;

            if (!$barang_id || $qty <= 0 || $harga <= 0) {
                continue;
            }

            $subtotal = $qty * $harga;
            $total += $subtotal;
            $items[] = array(
                'barang_id' => $barang_id,
                'qty' => $qty,
                'harga' => $harga,
                'subtotal' => $subtotal,
            );
        }

        if (empty($items)) {
            $this->session->set_flashdata('error', 'Tidak ada item valid yang disimpan');
            return redirect('pembelian/create');
        }

        $data = array(
            'kode_pembelian' => 'PB'.date('YmdHis'),
            'total' => $total,
        );

        try {
            $pembelian_id = $this->Pembelian_model->create($data, $items);
        } catch (Exception $e) {
            $this->session->set_flashdata('error', $e->getMessage());
            return redirect('pembelian/create');
        }

        $this->session->set_flashdata('success', 'Pembelian berhasil disimpan');
        redirect('pembelian/show/'.$pembelian_id);
    }

    public function show($id)
    {
        $pembelian = $this->Pembelian_model->get($id);
        if (!$pembelian) {
            show_404();
        }

        $data = array(
            'title' => 'Detail Pembelian',
            'pembelian' => $pembelian,
            'detail' => $this->Pembelian_model->get_details($id),
        );
        $this->render('pembelian/show', $data);
    }
}

