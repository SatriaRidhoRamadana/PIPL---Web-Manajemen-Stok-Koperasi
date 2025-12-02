<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $page_data = array();

    protected function render($view, $data = array())
    {
        $data = array_merge($this->page_data, $data);
        $this->load->view('layouts/header', $data);
        $this->load->view($view, $data);
        $this->load->view('layouts/footer');
    }
}


