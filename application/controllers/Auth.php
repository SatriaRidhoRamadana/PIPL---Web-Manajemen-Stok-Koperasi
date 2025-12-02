<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index()
    {
        if (is_logged_in()) {
            return $this->_redirect_by_role();
        }

        $data = array();
        $data['error'] = null;

        if ($this->input->post()) {
            $this->form_validation->set_rules('username', 'Username', 'required|trim');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run()) {
                $user = $this->User_model->validate_login(
                    $this->input->post('username'),
                    $this->input->post('password')
                );

                if ($user) {
                    set_user_session($user);
                    return $this->_redirect_by_role();
                }

                // pass error directly to view for the current request
                $data['error'] = 'Username atau password salah';
            }
        }

        $data['title'] = 'Login Koperasi';
        $this->load->view('auth/login', $data);
    }

    public function logout()
    {
        destroy_user_session();
        redirect('auth');
    }

    private function _redirect_by_role()
    {
        $role = current_user('role');
        if ($role === 'kasir') {
            redirect('penjualan/create');
        }

        redirect('dashboard');
    }
}


