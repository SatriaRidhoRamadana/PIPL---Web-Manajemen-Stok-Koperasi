<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        require_login();
        check_role('admin');
        $this->load->model(array('Barang_model', 'Kategori_model'));
    }

    public function index()
    {
        $data = array(
            'title' => 'Kelola Barang',
            'barang' => $this->Barang_model->get_all(),
        );
        $this->render('barang/index', $data);
    }

    public function create()
    {
        $data = array(
            'title' => 'Tambah Barang',
            'kategori' => $this->Kategori_model->get_all(),
            'barang' => null,
        );
        $this->render('barang/form', $data);
    }

    public function store()
    {
        $this->_set_rules();
        if ($this->form_validation->run() === FALSE) {
            return $this->create();
        }

        $payload = $this->_build_payload();
        $this->Barang_model->create($payload);
        $this->session->set_flashdata('success', 'Barang berhasil ditambahkan');
        redirect('barang');
    }

    public function edit($id)
    {
        $barang = $this->Barang_model->get($id);
        if (!$barang) {
            show_404();
        }

        $data = array(
            'title' => 'Edit Barang',
            'kategori' => $this->Kategori_model->get_all(),
            'barang' => $barang,
        );
        $this->render('barang/form', $data);
    }

    public function update($id)
    {
        $barang = $this->Barang_model->get($id);
        if (!$barang) {
            show_404();
        }

        $this->_set_rules();
        if ($this->form_validation->run() === FALSE) {
            return $this->edit($id);
        }

        $payload = $this->_build_payload();
        $this->Barang_model->update($id, $payload);
        $this->session->set_flashdata('success', 'Barang berhasil diupdate');
        redirect('barang');
    }

    public function delete($id)
    {
        $this->Barang_model->delete($id);
        $this->session->set_flashdata('success', 'Barang berhasil dihapus');
        redirect('barang');
    }

    private function _set_rules()
    {
        $this->form_validation->set_rules('sku', 'SKU', 'required|trim');
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('harga', 'Harga Jual', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|integer');
    }

    private function _build_payload()
    {
        $sku = $this->input->post('sku');
        $id_kategori = $this->input->post('id_kategori');
        // ensure sku starts with kategori kode if provided
        $this->load->model('Kategori_model');
        $kategori = $this->Kategori_model->get($id_kategori);
        if ($kategori && !empty($kategori->kode_kategori)) {
            $prefix = $kategori->kode_kategori . '-';
            if (strpos($sku, $prefix) !== 0) {
                $sku = $prefix . $sku;
            }
        }

        return array(
            'sku' => $sku,
            'nama_barang' => $this->input->post('nama_barang'),
            'id_kategori' => $id_kategori,
            'satuan' => $this->input->post('satuan'),
            'harga' => $this->input->post('harga'),
            'stok' => $this->input->post('stok'),
        );
    }
}

