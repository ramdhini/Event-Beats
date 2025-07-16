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

// Mendapatkan ID dari query string
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Query untuk mengambil detail acara berdasarkan ID
$query = "SELECT * FROM events WHERE id = $id";
$result = $conn->query($query);
$event = $result->fetch_assoc();

if (!$event) {
    die("Acara tidak ditemukan.");
}

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
    <title>Semina | Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/scss/details.css"/>

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
                        <a class="nav-link" href="#">Riwayat</a>
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

    <section class="main-content">
        <div class="preview-image bg-navy text-center">
            <img src="<?php echo $event['image_details']; ?>" class="img-content" alt="Event Image">
        </div>
    </section>

    <div class="details-content container">
        <div class="d-flex flex-wrap justify-content-lg-center gap">
            <!-- Left Side Description -->
            <div class="d-flex flex-column description">
                <div class="headline">
                    <b>Feel the <span class="text-gradient-pink"> Beat </span><br>
                    Move as One!</b>
                </div>
                <div class="event-details">
                    <h6><b>Tentang</b></h6>
                    <p class="details-paragraph">
                        <?php echo $event['description']; ?>
                    </p>
                </div>
            </div>
            
            <!-- Card Event -->
            <div class="d-flex flex-column card-event">
    <h6>Artis</h6>
    <div class="d-flex align-items-center gap-3 mt-3">
        
        <img src="<?php echo $event['img_profile']; ?>" class="img-content">

        <div class="desc">
            <div class="subtitle">
                <?php echo $event['subtitle']; ?>
            </div>
            <div class="speaker-name">
                <?php echo $event['artist']; ?>
            </div>
        </div>
    </div>
    <hr>
    <h6 class="tiket" >Tiket</h6>
    <div class="price my-3">Rp. <?php echo $event['price']; ?><span>/tiket</span></div>
    
    <div class="d-flex gap-3 align-items-center card-details">
        <img src="assets/icons/ic-marker.svg" alt="semina"> <?php echo $event['location']; ?>
    </div>
    <div class="d-flex gap-3 align-items-center card-details">
        <img src="assets/icons/ic-time.svg" alt="semina"> 
        18.30 WIB
    </div>
    <div class="d-flex gap-3 align-items-center card-details">
        <img src="assets/icons/ic-calendar.svg" alt="semina"> <?php echo $event['event_date']; ?>
    </div>
    <div class="beli">
    <a href="checkout.php?id=<?php echo $event['id']; ?>" class="btn-green"> Beli </a> 
    </div>
</div>
    </div>

    <?php
// Query baru untuk mengambil acara serupa
$query_similar = "SELECT * FROM events WHERE id != $id"; // Ambil 4 event lain selain event yang sedang ditampilkan
$result_similar = $conn->query($query_similar);
?>

<section class="grow-today">
    <div class="container">
        <div class="sub-title mb-1" id="grow-today" style="margin-top:70px;">
            <span class="text-gradient-pink"><b>Info Terkini</b></span>
        </div>
        <div class="title" style="margin-bottom: 50px;">
            <b>Acara Serupa</b>
        </div>

        <div class="events"> <!-- Kontainer untuk kartu acara -->
            <?php
            // Menampilkan data acara dalam bentuk card
            if ($result_similar->num_rows > 0) {
                while ($similar_event = $result_similar->fetch_assoc()) {
                    ?>
                    <div class="event-card"> 
                        <div class="new-label">Baru</div> <!-- Label Baru -->
                        <a href="detail.php?id=<?php echo $similar_event['id']; ?>" class="event-link">
                            <img src="<?php echo $similar_event['image_co']; ?>" alt="<?php echo $event['title']; ?>" class="event-image" />
                        </a>
                        <div class="card-content">
                            <div class="card-title">
                                <?php echo $similar_event['title']; ?>
                            </div>
                            <div class="speaker-name">
                                <?php echo $similar_event['subtitle']; ?>
                            </div>
                            <div class="event-location">
                                <?php echo $similar_event['location']; ?>
                            </div>
                            <div class="event-date-time">
                                18.30 WIB <br> 
                                <?php echo $similar_event['event_date']; ?>
                            </div>
                        </div>
                    </div> 
                    <?php
                }
            } else {
                echo "No events found.";
            }
            ?>
        </div>
    </div>
</section>
        </div>
    </section>

    <section class="stories" id="tentang">
        <div class="d-flex flex-row justify-content-center align-items-center container">
            <img src="assets/images/foto-about.png" alt="semina" class="d-none d-lg-block" width="515" />
            <div class="d-flex flex-column">
                <div>
                    <div class="sub-title">
                        <span class="text-gradient-pink"><b>Tentang EventBeast</b></span>
                    </div>
                    <div class="title">
                       <b>Untuk Pengalaman <br class="d-none d-lg-block" />
                        Terbaikmu!</b>
                    </div>
                </div>
                <p class="paragraph">
                    EvenBeats adalah platform terpercaya untuk memesan tiket <br class="d-none d-lg-block" />
                    konser dan event musik terbaik. Dengan tampilan mudah  <br class="d-none d-lg-block" />
                    dan proses cepat, kami membantu Anda mendapatkan tiket <br class="d-none d-lg-block" />
                    ke konser, festival, dan acara musik favorit, dari artis lokal <br class="d-none d-lg-block" />
                    hingga internasional. Jangan lewatkan momen seru di <br class="d-none d-lg-block" />
                    panggung - dapatkan tiket Anda sekarang!
                </p>
            </div>
        </div>
    </section>

    <section class="statistics container">
        <div class="d-flex flex-row flex-wrap justify-content-center align-items-center gap-5">
            <div class="d-flex flex-column align-items-center gap-1">
                <div class="title">
                    190Ribu+
                </div>
                <p>
                    Acara Diselenggarakan
                </p>
            </div>
            <div class="vr"></div>
            <div class="d-flex flex-column align-items-center gap-1">
                <div class="title">
                    3Juta+
                </div>
                <p>
                    Tiket Terjual
                </p>
            </div>
            <div class="vr d-none d-md-block"></div>
            <div class="d-flex flex-column align-items-center gap-1">
                <div class="title">
                    5Ribu+
                </div>
                <p>
                    Mitra Sukses
                </p>
            </div>
            <div class="vr"></div>
            <div class="d-flex flex-column align-items-center gap-1">
                <div class="title">
                    120Ribu+
                </div>
                <p>
                    Event Internasional
                </p>
            </div>
        </div>
    </section>

    <?php include 'footer.php';?>
</body>
</html>

<?php
$conn->close();
?>