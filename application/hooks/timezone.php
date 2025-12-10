<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Timezone Hook
 * 
 * This hook ensures the timezone is set to Asia/Jakarta (Indonesia Western Time)
 * for all database operations and timestamp functions.
 */

// Ensure timezone is set to Indonesia Western Time (WIB)
date_default_timezone_set('Asia/Jakarta');

// Set MySQL session timezone if connected
$CI = &get_instance();
if (isset($CI->db)) {
    $CI->db->query("SET time_zone = '+07:00'");
}
