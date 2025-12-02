<?php
// set_plain_passwords.php
// Sets password_hash = username + '123' for all users in user_account
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
$sql = "UPDATE user_account SET password_hash = CONCAT(username, '123')";
if ($mysqli->query($sql)) {
    echo "Passwords updated to username+'123' for all users. Affected rows: " . $mysqli->affected_rows . "\n";
} else {
    echo "Update failed: " . $mysqli->error . "\n";
}
$mysqli->close();
