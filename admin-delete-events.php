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

// Proses penghapusan acara
if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    $delete_query = "DELETE FROM events WHERE id = $delete_id";

    if ($conn->query($delete_query) === TRUE) {
        echo "<script>alert('Acara berhasil dihapus!'); window.location.href='admin_delete_event.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Ambil semua acara untuk ditampilkan
$query = "SELECT * FROM events";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Hapus Acara</title>
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
                    <a class="nav-link" href="admin-add-events.php">Tambah Acara</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="admin-delete-events.php">Hapus Acara</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <h2>Daftar Acara Konser</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Gambar </th>
                <th>Judul</th>
                <th>Artis</th>
                <th>Tanggal Acara</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td style ="width:50px; height:50px;"><img src="<?= $row['image_co']; ?>" class="card-img-top" alt="<?= $row['title']; ?>"></td>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['subtitle']); ?></td>
                        <td><?php echo htmlspecialchars($row['event_date']); ?></td>
                        <td>
                            <a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus acara ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Tidak ada</td>
                    <tr>
                    <td colspan="5" class="text-center">Tidak ada acara yang ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php
$conn->close();
?>