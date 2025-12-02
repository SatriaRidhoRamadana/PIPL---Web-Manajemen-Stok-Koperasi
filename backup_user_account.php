<?php
// backup_user_account.php
// Exports INSERT statements for user_account table to backup_user_account.sql
error_reporting(E_ALL);
ini_set('display_errors', 1);
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'koperasi_pipl';
$outFile = __DIR__ . '/backup_user_account.sql';
$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
    echo "DB connect error: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error . "\n";
    exit(1);
}
$res = $mysqli->query('SELECT * FROM user_account');
if (!$res) {
    echo "Query error: " . $mysqli->error . "\n";
    exit(1);
}
$fp = fopen($outFile, 'w');
if (!$fp) {
    echo "Failed to open output file: $outFile\n";
    exit(1);
}
fwrite($fp, "-- Backup of user_account table\n");
while ($row = $res->fetch_assoc()) {
    $cols = array();
    $vals = array();
    foreach ($row as $k => $v) {
        $cols[] = "`$k`";
        if ($v === null) $vals[] = 'NULL';
        else $vals[] = "'" . $mysqli->real_escape_string($v) . "'";
    }
    $line = "INSERT INTO `user_account` (" . implode(',', $cols) . ") VALUES (" . implode(',', $vals) . ");\n";
    fwrite($fp, $line);
}
fclose($fp);
echo "Backup written to: $outFile\n";
$mysqli->close();
