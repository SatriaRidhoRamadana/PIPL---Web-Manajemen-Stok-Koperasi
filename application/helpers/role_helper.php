<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('check_role')) {
    /**
     * Pastikan user memiliki salah satu role
     *
     * @param string|array $roles
     */
    function check_role($roles)
    {
        require_login();

        $CI =& get_instance();
        $roles = (array) $roles;
        $user_role = $CI->session->userdata('role');

        if (!in_array($user_role, $roles)) {
            show_error('Anda tidak memiliki akses ke halaman ini', 403, 'Akses Ditolak');
        }
    }
}

if (!function_exists('has_role')) {
    function has_role($roles)
    {
        $CI =& get_instance();
        if (!is_logged_in()) {
            return FALSE;
        }

        $roles = (array) $roles;
        return in_array($CI->session->userdata('role'), $roles);
    }
}


