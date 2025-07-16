<?php
// Koneksi ke database
$host = 'localhost'; 
$user = 'root'; 
$password = ''; 
$database = 'eventbeast';
$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses penambahan acara
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_event'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $subtitle = $conn->real_escape_string($_POST['subtitle']);
    $artist = $conn->real_escape_string($_POST['artist']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = $conn->real_escape_string($_POST['price']);
    $event_date = $conn->real_escape_string($_POST['event_date']);
    $image_details = $conn->real_escape_string($_POST['image_details']);
    $image_co = $conn->real_escape_string($_POST['image_co']);
    $location = $conn->real_escape_string($_POST['location']);

    $query = "INSERT INTO events (title, subtitle, artist, description, price, event_date, image_details, image_co, location) 
              VALUES ('$title', '$subtitle', '$artist', '$description', '$price', '$event_date', '$image_details', '$image_co', '$location')";

    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Acara berhasil ditambahkan!');</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tambah Acara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<link href="admin.css" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
       
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="admin-add-events.php">Tambah Acara</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin-delete-events.php">Hapus Acara</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <h2>Tambah Acara Konser Baru</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="title" class="form-label">Judul Acara Konser</label>
            <input type="text" name="title" class="form-control" placeholder="misal: Live in Concert" required>
        </div>
        <div class="mb-3">
            <label for="subtitle" class="form-label">Artist</label>
            <input type="text" name="subtitle" class="form-control" placeholder="misal: JKT48" required>
        </div>
        <div class="mb-3">
            <label for="artist" class="form-label">Status</label>
            <input type="text" name="artist" class="form-control" placeholder="misal: Girlgrup" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="text" name="price" class="form-control" placeholder="misal: 250.000"required>
        </div>
        <div class="mb-3">
            <label for="event_date" class="form-label">Tanggal Acara</label>
            <input type="text" name="event_date" class="form-control" placeholder="misal: 03 Februari 2025" required>
        </div>
        <div class="mb-3">
            <label for="image_details" class="form-label">Gambar Detail Acara</label>
            <input type="text" name="image_details" class="form-control" placeholder="masukkan url gambar" required>
        </div>
        <div class="mb-3">
            <label for="image_co" class="form-label">Gambar Acara</label>
            <input type="text" name="image_co" class="form-control" placeholder="masukkan url gambar" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Lokasi Acara</label>
            <input type="text" name="location" class="form-control" placeholder="masukkan url gambar" required>
        </div>
        <button type="submit" name="add_event" class="btn btn-primary">Tambah Acara</button>
    </form>
</div>
</body>
</html>

<?php
$conn->close();
?>