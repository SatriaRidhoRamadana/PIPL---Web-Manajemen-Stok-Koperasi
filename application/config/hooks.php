<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/userguide3/general/hooks.html
|
*/

/*
| -------------------------------------------------------------------------
| Set Timezone Hook
| -------------------------------------------------------------------------
| This hook ensures timezone is set to Asia/Jakarta (Indonesia Western Time)
| for all system operations and database queries.
|
*/
$hook['pre_system'] = array(
	'class'    => '',
	'function' => 'set_timezone',
	'filename' => 'timezone.php',
	'filepath' => 'hooks',
	'params'   => array()
);

function set_timezone()
{
	date_default_timezone_set('Asia/Jakarta');
}
