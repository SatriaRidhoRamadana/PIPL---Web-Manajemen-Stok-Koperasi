<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('is_logged_in')) {
    function is_logged_in()
    {
        $CI =& get_instance();
        return (bool) $CI->session->userdata('user_id');
    }
}

if (!function_exists('current_user')) {
    function current_user($field = null)
    {
        $CI =& get_instance();
        $user = array(
            'user_id' => $CI->session->userdata('user_id'),
            'username' => $CI->session->userdata('username'),
            'role' => $CI->session->userdata('role'),
            'full_name' => $CI->session->userdata('full_name'),
        );

        if ($field && isset($user[$field])) {
            return $user[$field];
        }

        return $user;
    }
}

if (!function_exists('require_login')) {
    function require_login()
    {
        if (!is_logged_in()) {
            redirect('auth');
        }
    }
}

if (!function_exists('set_user_session')) {
    function set_user_session($user)
    {
        $CI =& get_instance();
        $session_data = array(
            'user_id' => $user->id_user,
            'username' => $user->username,
            'full_name' => $user->full_name,
            'role' => $user->role,
        );
        $CI->session->set_userdata($session_data);
    }
}

if (!function_exists('destroy_user_session')) {
    function destroy_user_session()
    {
        $CI =& get_instance();
        $CI->session->sess_destroy();
    }
}

