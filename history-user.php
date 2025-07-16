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

// Mendapatkan ID pengguna dari session (contoh: diambil dari login)
session_start();
$id_user = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 0;

if (!$id_user) {
    echo "<script>alert('Anda harus login terlebih dahulu!'); window.location.href='login.php';</script>";
    exit();
}

$query = "SELECT t.*, e.title, e.subtitle, e.artist, e.event_date, e.price, e.image_details, e.image_co
          FROM transactions t
          JOIN events e ON t.id = e.id
          WHERE t.id_user = $id_user
          ORDER BY t.transaction_date DESC";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventBeast</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/scss/historyy.css" />
</head>

<body>

    <header class="header bg-navy">
        
        <nav class="container navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">

                <a class="navbar-brand" href="index.php" style="display: flex;">
                    <div class = "back-container">
                        <img src="assets/images/back-btn.png" class="logo" style="margin-left: -80px; "/>
                    </div>
                    <div class="logo-container">
                      <img src="assets/images/logo-app.png" alt="EventBeast " class="logo" />
                      <span class="logo-text">EventBeast</span>
                    </div>
                  </a>
                  
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav mx-auto my-3 my-lg-0">
                        <a class="nav-link" aria-current="page" href="index.php">Beranda</a>
                        <a class="nav-link" href="search-user.php">Pencarian</a>
                        <a class="nav-link active" href="#">Riwayat</a>
                        <a class="nav-link" href="index.php#tentang">Tentang Kami</a>
                        <a class="nav-link" href="logout.php">Keluar</a>
                    </div>
                    <div class="d-grid">

                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true): ?>
                            <!-- Jika pengguna adalah admin -->
                            <span class="nav-link" style="color: white;">Hai, Admin</span>
                            <?php else: ?>
                            <!-- Jika pengguna biasa -->
                            <span class="nav-link" style="color: white;">
                                Hai, 
                                <?php 
                                    // Pastikan first_name dan last_name ada di session
                                    if (isset($_SESSION['first_name']) && isset($_SESSION['last_name'])) {
                                        echo htmlspecialchars($_SESSION['first_name']) . ' ' . htmlspecialchars($_SESSION['last_name']);
                                    } else {
                                        echo 'Pengguna'; // Default jika nama tidak ada
                                    }
                                ?>
                            </span>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </nav>
      

        <div class="hero">
            <div class="hero-headline">
                <span class="text-gradient-pink"> Riwayat </span> Pemesanan Tiket <span class="text-gradient-blue"> Konser </span>
            </div>
        </div>

    </header>

    <section class="grow-today">
    <div class="events-list">
        <div class="event-card">
            <div class="event-content">
                <div class="row">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <img src="<?= $row['image_co']; ?>" class="card-img-top" alt="<?= $row['title']; ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($row['title']); ?></h5>
                                        <p class="card-text">
                                            <b>Artis</b> <?= htmlspecialchars($row['subtitle']); ?><br>
                                            <b>Tanggal Acara</b> <?= htmlspecialchars($row['event_date']); ?><br>
                                            <b>Jumlah Tiket</b> <?= htmlspecialchars($row['quantity']); ?><br>
                                            <b>Total Harga</b> Rp <?= htmlspecialchars($row['total_price']); ?><br>
                                            <b>Tanggal Transaksi</b> <?= htmlspecialchars($row['transaction_date']); ?>
                                        </p>
                                        <a href="detail.php?id=<?= $row['id']; ?>" class="btn btn-primary">Lihat Detail Acara</a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="text-center">Belum ada transaksi yang dilakukan.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--SAMPE SINI CUY-->

            <!--
                <img src="assets/images/history-svt.png" alt="Right Here World Tour">
                <div class="event-info">
                    <p class="event-name">SEVENTEEN</p>
                    <p class="event-details"><b>Right Here World Tour Asia</b><br>09 Februari 2025<br>Rp 3.500.000,-</p>
                    <p class="event-status">Status: <span class="status-paid">Sudah Dibayar</span></p>
                    <form action="detail.php" method="get">
                        <button type="submit" class="view-detail">Lihat Detail</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="event-card">
            <div class="event-content">
                <img src="assets/images/history-niki.png" alt="Buzz World Tour">
                <div class="event-info">
                    <p class="event-name">NIKI</p>
                    <p class="event-details"><b>Buzz World Tour in Jakarta</b><br>23 Februari 2025<br>Rp 1.250.000,-</p>
                    <p class="event-status">Status: <span class="status-paid">Sudah Dibayar</span></p>
                    <form action="detail.php" method="get">
                        <button type="submit" class="view-detail">Lihat Detail</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> --> 
    <footer class="footer bg-navy" style="padding-top: 60px;">
        <div class="container">
            
            <span class="logo-text" style="color: white; font-size: 2rem; font-weight: bold;">EventBeast</span>

            <div class="mt-3 d-flex flex-row flex-wrap footer-content align-items-baseline">
                <p class="paragraph">
                    EventBeats adalah platform digital <br class="d-md-block d-none" /> yang menyediakan informasi terkait <br class="d-md-block d-none" /> penjualan tiket untuk berbagai <br class="d-md-block d-none" /> konser di Indonesia.
    
                </p>
                <div class="d-flex flex-column footer-links">
                    <div class="title-links mb-3">Fitur</div>
                    <a href="#">Beranda</a>
                    <a href="#">Pencarian</a>
                    <a href="history.html">Riwayat</a>
                    <a href="#">Tentang Kami</a>
                    <a href="#">Masuk</a>
                </div>

                    <div class="footer-contact">
                      <div class="contact-item">
                        <img src="https://img.icons8.com/?size=100&id=9730&format=png&color=FFFFFF" alt="Phone Icon" class="icon">
                        <span>+6281319175247</span>
                      </div>
                      <div class="contact-item"> 
                        <img src="https://img.icons8.com/?size=100&id=59813&format=png&color=FFFFFF" alt="Instagram" class="icon">
                        <span>eventbeats.id</span>
                      </div>
                      <div class="contact-item">
                        <img src="https://img.icons8.com/?size=100&id=85500&format=png&color=FFFFFF" alt="Email" class="icon">
                        <span>eventbeats@gmail.com</span>
                      </div>
                      <div class="contact-item">
                        <img src="https://img.icons8.com/?size=100&id=2963&format=png&color=FFFFFF" alt="Instagram" class="icon">
                        <span>eventbeats.com</span>
                      </div>
                    </div>
        
    </footer>   

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
</body>

</html>