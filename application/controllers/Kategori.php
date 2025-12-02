<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        require_login();
        check_role('admin');
        $this->load->model('Kategori_model');
    }

    public function index()
    {
        $data = array(
            'title' => 'Kelola Kategori',
            'kategori' => $this->Kategori_model->get_all(),
        );
        $this->render('kategori/index', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim');
        $this->form_validation->set_rules('kode_kategori', 'Kode Kategori', 'required|trim|alpha_numeric');
        if ($this->form_validation->run() === FALSE) {
            return $this->index();
        }

        $this->Kategori_model->create([
            'nama_kategori' => $this->input->post('nama_kategori'),
            'kode_kategori' => strtoupper($this->input->post('kode_kategori')),
        ]);
        $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan');
        redirect('kategori');
    }

    public function update($id)
    {
        $kategori = $this->Kategori_model->get($id);
        if (!$kategori) {
            show_404();
        }

        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim');
        $this->form_validation->set_rules('kode_kategori', 'Kode Kategori', 'required|trim|alpha_numeric');
        if ($this->form_validation->run() === FALSE) {
            return $this->index();
        }

        $this->Kategori_model->update($id, [
            'nama_kategori' => $this->input->post('nama_kategori'),
            'kode_kategori' => strtoupper($this->input->post('kode_kategori')),
        ]);
        $this->session->set_flashdata('success', 'Kategori berhasil diperbarui');
        redirect('kategori');
    }

    public function delete($id)
    {
        $this->Kategori_model->delete($id);
        $this->session->set_flashdata('success', 'Kategori berhasil dihapus');
        redirect('kategori');
    }
}


