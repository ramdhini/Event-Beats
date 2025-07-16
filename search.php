<?php
// Koneksi ke database
$host = 'localhost'; // Atur sesuai pengaturan database Anda
$user = 'root'; // Username database Anda
$password = ''; // Password database Anda
$database = 'eventbeast'; // Nama database Anda

$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil kata kunci pencarian dari form
$search = isset($_POST['query']) ? $conn->real_escape_string($_POST['query']) : '';

// Query untuk mencari berdasarkan title
$query = "SELECT * FROM events WHERE title LIKE '%$search%'";
$result = $conn->query($query);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; 
    }
}

// Menampilkan hasil pencarian dalam format JSON
echo json_encode($data);

$conn->close();
?>
