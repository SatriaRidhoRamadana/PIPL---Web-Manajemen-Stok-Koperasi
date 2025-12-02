<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        require_login();
        check_role('admin');
        $this->load->model('User_model');
    }

    public function index()
    {
        $data = array(
            'title' => 'Kelola Pengguna',
            'users' => $this->User_model->get_all(),
        );
        $this->render('user/index', $data);
    }

    public function create()
    {
        $data = array(
            'title' => 'Tambah Pengguna',
            'user' => null,
        );
        $this->render('user/form', $data);
    }

    public function store()
    {
        $this->_set_rules();
        if ($this->form_validation->run() === FALSE) {
            return $this->create();
        }

        $this->User_model->create($this->_build_payload());
        $this->session->set_flashdata('success', 'Pengguna berhasil ditambahkan');
        redirect('user');
    }

    public function edit($id)
    {
        $user = $this->User_model->get($id);
        if (!$user) {
            show_404();
        }

        $data = array(
            'title' => 'Edit Pengguna',
            'user' => $user,
        );
        $this->render('user/form', $data);
    }

    public function update($id)
    {
        $user = $this->User_model->get($id);
        if (!$user) {
            show_404();
        }

        $this->_set_rules($id);
        if ($this->form_validation->run() === FALSE) {
            return $this->edit($id);
        }

        $this->User_model->update($id, $this->_build_payload());
        $this->session->set_flashdata('success', 'Pengguna berhasil diperbarui');
        redirect('user');
    }

    public function delete($id)
    {
        if ($id == current_user('user_id')) {
            $this->session->set_flashdata('error', 'Tidak dapat menghapus akun sendiri');
            return redirect('user');
        }
        $this->User_model->delete($id);
        $this->session->set_flashdata('success', 'Pengguna berhasil dihapus');
        redirect('user');
    }

    private function _set_rules($id = null)
    {
        $username_rule = 'required|trim|is_unique[user_account.username]';
        if ($id) {
            $username_rule = 'required|trim|callback__ignore_unique['.$id.']';
        }

        $this->form_validation->set_rules('username', 'Username', $username_rule);
        $this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('role', 'Role', 'required|in_list[admin,kasir,owner]');
        if (!$id) {
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        } else {
            $this->form_validation->set_rules('password', 'Password', 'min_length[6]');
        }
    }

    public function _ignore_unique($value, $id)
    {
        $user = $this->User_model->get_by_username($value);
        if ($user && $user->id_user != $id) {
            $this->form_validation->set_message('_ignore_unique', 'Username sudah digunakan');
            return FALSE;
        }
        return TRUE;
    }

    private function _build_payload()
    {
        $payload = array(
            'username' => $this->input->post('username'),
            'full_name' => $this->input->post('full_name'),
            'role' => $this->input->post('role'),
        );

        if ($this->input->post('password')) {
            $payload['password'] = $this->input->post('password');
        }

        return $payload;
    }
}

