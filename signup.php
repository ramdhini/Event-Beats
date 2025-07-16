<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone_number = $_POST['phone_number'];

    // Validasi input
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || strlen($password) < 6 || empty($phone_number)) {
        echo 'Semua kolom harus diisi dengan benar!';
        exit;
    }

   

    // Simpan ke database
    $stmt = $conn->prepare('INSERT INTO users (first_name, last_name, email, password, phone_number) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('sssss', $first_name, $last_name, $email, $password, $phone_number);

    if ($stmt->execute()) {
        echo 'Akun berhasil dibuat!';
        header('Location: login.php'); // Arahkan ke halaman login
        exit;
    } else {
        echo 'Error: ' . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
