<?php
session_start(); // Mulai sesi untuk memeriksa status login
?>
<header class="header bg-navy">
        <!-- START: NAVBAR -->
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
                        <a class="nav-link active" aria-current="page" href="index.php">Beranda</a>
                        <a class="nav-link" href="search-user.php">Pencarian</a>
                        <a class="nav-link" href="history-user.php">Riwayat</a>
                        <a class="nav-link" href="#tentang">Tentang Kami</a>
                        <!-- Ganti 'Tentang Kami' menjadi 'Keluar' -->
                    <a class="nav-link" href="logout.php">Keluar</a>
                </div>

                <div class="d-grid">
                    <?php if (isset($_SESSION['user_email'])): ?>
                        <!-- Jika pengguna sudah login -->

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
                        
                    <?php else: ?>
                        <!-- Jika pengguna belum login, tampilkan tombol Masuk -->
                        <a class="btn-navy" href="login.php">Masuk</a>
                    <?php endif; ?>
                </div>
                </div>
            </div>
        </nav>
