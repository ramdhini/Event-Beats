<?php
$host = 'localhost';
$user = 'root'; // Username phpMyAdmin
$password = ''; // Password phpMyAdmin (biarkan kosong jika tidak ada)
$dbname = 'eventbeast';

// Buat koneksi
$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}
?>
