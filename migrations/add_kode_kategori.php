<?php
// Run this script once to add kode_kategori column and populate defaults
error_reporting(E_ALL);
ini_set('display_errors', 1);
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'koperasi_pipl';
$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
    echo "DB connect error: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error . "\n";
    exit(1);
}
// check if column exists
$res = $mysqli->query("SHOW COLUMNS FROM kategori LIKE 'kode_kategori'");
if ($res && $res->num_rows > 0) {
    echo "Column kode_kategori already exists.\n";
} else {
    $sql = "ALTER TABLE kategori ADD COLUMN kode_kategori VARCHAR(50) NOT NULL DEFAULT '' AFTER nama_kategori";
    if ($mysqli->query($sql)) {
        echo "Added column kode_kategori.\n";
    } else {
        echo "Failed to add column: " . $mysqli->error . "\n";
        $mysqli->close();
        exit(1);
    }
}
// populate defaults for empty kode_kategori
$sql = "SELECT id_kategori, nama_kategori FROM kategori";
$res = $mysqli->query($sql);
while ($row = $res->fetch_assoc()) {
    $id = $row['id_kategori'];
    $name = $row['nama_kategori'];
    $default = 'CAT' . $id;
    $update = $mysqli->prepare("UPDATE kategori SET kode_kategori = ? WHERE id_kategori = ? AND (kode_kategori = '' OR kode_kategori IS NULL)");
    $update->bind_param('si', $default, $id);
    $update->execute();
}
echo "Populated default kode_kategori for existing rows.\n";
$mysqli->close();
