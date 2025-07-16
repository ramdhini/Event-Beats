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
    <link rel="stylesheet" href="assets/scss/search.css" />
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
                        <a class="nav-link active" href="search-user.php">Pencarian</a>
                        <a class="nav-link" href="history-user.php">Riwayat</a>
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
        <span class="text-gradient-pink"> Temukan </span> Tiket Konser yang <span class="text-gradient-blue"> Kamu </span> Inginkan!
    </div>

    <div class="search-container">
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Cari acara favorit kamu...">
            <button type="button" class="search-btn" id="searchBtn">
                <img src="https://img.icons8.com/?size=100&id=112468&format=png&color=FFFFFF" alt="Search Icon" class="icon">
            </button>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
    $('#searchBtn').on('click', function () {
        var query = $('#searchInput').val();

        // Kirim pencarian ke PHP menggunakan AJAX
        $.ajax({
            type: "POST",
            url: "search.php",
            data: { query: query },
            success: function (response) {
                var data = JSON.parse(response);
                var resultHtml = '';

                if (data.length > 0) {
                    data.forEach(function (event) {
                        // Menambahkan link di sekitar gambar yang mengarah ke halaman detail berdasarkan subtitle acara
                        resultHtml += `
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="card-grow h-100">
                                    <a href="detail.php?id=${event.id}">
                                        <img src="${event.image_co}" alt="${event.title}" />
                                    </a>
                                    <div class="card-content">
                                        <div class="card-title">${event.title}</div>
                                        <div class="card-subtitle">${event.subtitle}</div>
                                        <div class="description">
                                        ${event.location}<br>
                                           ${event.event_date} <br>
                                            18.30 WIB
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                } else {
                    resultHtml = '<p>No results found.</p>';
                }

                $('#results').html(resultHtml);
            }
        });
    });
});

</script>

    </header>
    <section class="grow-today">
    <div class="container">
        <div class="mt-3 row gap" id="results">
            <!-- Hasil pencarian akan ditampilkan di sini -->
        </div>
    </div>

</section>
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
                    <a href="#">Riwayat</a>
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