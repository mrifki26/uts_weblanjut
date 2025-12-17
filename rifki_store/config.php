<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'game_store';

$conn = mysqli_connect($host, $user, $pass);
if (!$conn) {
    die('MySQL connection failed: ' . mysqli_connect_error());
}
if (!mysqli_select_db($conn, $db)) {
    die('Database "' . $db . '" not found. Import database.sql first.');
}
session_start();
?>