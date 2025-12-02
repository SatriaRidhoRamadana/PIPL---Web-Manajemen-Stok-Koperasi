<?php
// Simple DB connectivity test for koperasi_pipl
error_reporting(E_ALL);
ini_set('display_errors', 1);
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'koperasi_pipl';

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
    http_response_code(500);
    echo "ERROR: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit;
}
$row = $mysqli->query('SELECT DATABASE()')->fetch_row();
echo "Connected to DB: " . ($row[0] ?? 'unknown') . "\n";
$version = $mysqli->server_info;
echo "MySQL server: " . $version . "\n";
$mysqli->close();
