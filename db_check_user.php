<?php
// db_check_user.php
// Usage (browser):
//   http://localhost:8074/db_check_user.php?username=admin&password=secret
// Usage (CLI):
//   php db_check_user.php admin secret
// WARNING: This file is for local debugging only. Do not deploy to public servers.

error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'koperasi_pipl';

// get params
if (PHP_SAPI === 'cli') {
    $username = $argv[1] ?? null;
    $password = $argv[2] ?? null;
} else {
    $username = $_GET['username'] ?? null;
    $password = $_GET['password'] ?? null;
}

if (empty($username) || $password === null) {
    echo "Usage: db_check_user.php?username=USER&password=PASS\n";
    echo "Or: php db_check_user.php USER PASS\n";
    exit(1);
}

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
    echo "DB connect error: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error . "\n";
    exit(1);
}

$stmt = $mysqli->prepare('SELECT id_user, username, password_hash FROM user_account WHERE username = ? LIMIT 1');
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    echo "Found user: " . $row['username'] . " (id: " . $row['id_user'] . ")\n";
    echo "Stored hash: " . $row['password_hash'] . "\n";
    $ok = password_verify($password, $row['password_hash']);
    echo "password_verify result: " . ($ok ? 'MATCH' : 'NO MATCH') . "\n";
} else {
    echo "User not found: $username\n";
}

$stmt->close();
$mysqli->close();
