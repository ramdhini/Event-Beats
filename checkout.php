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

session_start(); // Pastikan session dimulai

// Mendapatkan ID dari query string
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id === 0) {
    die("ID acara tidak valid.");
}

// Query untuk mengambil detail acara berdasarkan ID
$query = $conn->prepare("SELECT * FROM events WHERE id = ?");
$query->bind_param('i', $id);
$query->execute();
$result = $query->get_result();
$event = $result->fetch_assoc();

if (!$event) {
    die("Acara tidak ditemukan.");
}

// Proses form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone_number = $conn->real_escape_string($_POST['no_telepon']);
    $quantity = 1; // Misalkan kita ambil 1 tiket
    $total_price = $event['price']; // Ambil harga dari event

    // Validasi email apakah sesuai dengan email pengguna yang login
    if (!isset($_SESSION['user_email']) || $_SESSION['user_email'] !== $email) {
        echo "<script>alert('Email yang dimasukkan tidak sesuai dengan email login Anda.');</script>";
    } else {
        // Ambil user_id dari tabel users berdasarkan email
        $user_query = $conn->prepare("SELECT id_user FROM users WHERE email = ?");
        $user_query->bind_param('s', $email);
        $user_query->execute();
        $user_result = $user_query->get_result();
        
        if ($user_result->num_rows > 0) {
            $user = $user_result->fetch_assoc();
            $id_user = $user['id_user'];

            // Insert ke tabel transactions
            $insert_query = $conn->prepare("INSERT INTO transactions (id_user, id, quantity, total_price) VALUES (?, ?, ?, ?)");
            $insert_query->bind_param('iiid', $id_user, $id, $quantity, $total_price);

            if ($insert_query->execute()) {
                // Redirect ke halaman sukses
                header("Location: successpay.php?id=$id");
                exit();
            } else {
                echo "<script>alert('Terjadi kesalahan saat menyimpan transaksi.');</script>";
            }
        } else {
            echo "<script>alert('User tidak ditemukan. Silakan mendaftar terlebih dahulu.');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semina | Checkout</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/scss/main-co.css" />

    
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

    <section class="bg-navy">
        <div class="checkout container">
            <div class="text-center checkout-title">
                Amankan Tiketmu Sekarang
            </div>

            <div class="event-details container d-flex flex-wrap justify-content-lg-center align-items-center gap-5">
            <img src="<?php echo $event['image_co']; ?>" class="img-content" alt="Event Image">
                <div class="d-flex flex-column gap-3">
                    <h5><?php echo $event['title']; ?><br class="d-none d-md-block">
                    </h5>

                    <div class="d-flex align-items-center gap-3">
                        <img src="assets/icons/ic-marker-white.svg" alt="">
                        <span><?php echo $event['location']; ?></span>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <img src="assets/icons/ic-time-white.svg" alt="">
                        <span>18.30 WIB</span>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <img src="assets/icons/ic-calendar-white.svg" alt="">
                        <span><?php echo $event['event_date']; ?></span>
                    </div>
                </div>
                <div class="total-price">
                <div class="price my-3">Rp. <?php echo $event['price']; ?><span>/tiket</span></div>
                </div>
            </div>

            <form action="" method="POST" class="container form-semina">
                <!-- Personal Details -->
                <div class="personal-details">
                    <div class="row row-cols-lg-8 row-cols-md-2 row-cols-1 justify-content-lg-center">
                        <div class="form-title col-lg-8">
                            <span>01</span>
                            <div>
                                Informasi Pribadi
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-lg-8 row-cols-md-2 row-cols-1 justify-content-center">
                        <!-- First Name -->
                        <div class="mb-4 col-lg-4">
                            <label for="first_name" class="form-label">
                                Nama Depan
                            </label>
                            <input type="text" name="first_name" placeholder="Masukkan Nama Depan" class="form-control" id="first_name">
                        </div>


                        <!-- Last Name -->
                        <div class="mb-4 col-lg-4">
                            <label for="last_name" class="form-label">
                                Nama Belakang
                            </label>
                            <input type="text" name="last_name" placeholder="Masukkan Nama Belakang" class="form-control" id="last_name">
                        </div>
                    </div>
                    <div class="row row-cols-lg-8 row-cols-md-2 row-cols-12 justify-content-center">
                        <!-- Email -->
                        <div class="mb-4 col-lg-4">
                            <label for="email_address" class="form-label">
                                Email
                            </label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email">
                        </div>
                        <!-- Role -->
                        <div class="mb-4 col-lg-4">
                            <label for="exampleFormControlInput1" class="form-label">
                                Nomor Telepon
                            </label>
                            <input type="text" name="no_telepon" class="form-control" id="role" placeholder="Masukkan Nomor Telepon">
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="payment-method mt-4">
                    <div class="row row-cols-lg-8 row-cols-md-2 row-cols-1 justify-content-lg-center">
                        <div class="form-title col-lg-8">
                            <span>02</span>
                            <div>
                                Metode Pembayaran
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-lg-8 row-cols-md-2 row-cols-1 justify-content-center gy-4 gy-md-0">
                        <div class="col-lg-4">
                            <label class="payment-radio h-100 d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-4">
                                    <img src="assets/icons/ic-mastercard.svg" alt="">
                                    <div>Mastercard</div>
                                </div>
                                <input type="radio" checked="checked" name="metode_pembayaran">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label class="payment-radio h-100 d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-4">
                                    <img src="assets/icons/ic-sewallet.svg" alt="">
                                    <div class="d-flex flex-column gap-1">
                                        Sewallet
                                        <span class="balance">Saldo: Rp.50.000</span>
                                    </div>
                                </div>
                                <input type="radio" name="metode_pembayaran">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                </div>

                <div class="d-flex flex-column align-items-center footer-payment gap-4">
                    
                <div class="button-container">
                     <button type="submit" class="btn-green">Bayar</button>
                </div>

                    


                    <div>
                        <img src="assets/icons/ic-secure.svg" alt="">
                        <span>Pembayaran Anda aman dan terenkripsi</span>
                    </div>
                </div>

            </form>

        </div>
    </section>

    <footer class="footer bg-navy">
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