<?php
include 'db.php';

// Query untuk mengambil data acara
$sql = "SELECT * FROM events";
$result = $conn->query($sql);

// Cek apakah query berhasil dan ada hasil
if ($result === false) {
    echo "Error: " . $conn->error;
    exit;
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
    <link rel="stylesheet" href="assets/scss/indexs.css" />
    <style>
    
    /* Styling untuk event card */

    </style>
</head>

<body>

<?php include 'header.php';?>

        <div class="hero">
            <div class="hero-headline">
                <span class="text-gradient-pink"> <b>Jangan </span> Sampai Ketinggalan! <br class="d-none d-lg-block" /> Pengalaman <span class="text-gradient-blue"> Konser </span> yang Tak Terlupakan</b>
            </div>

            <p class="hero-paragraph">
                Pesan tiket untuk acara favorit Anda dengan cepat dan aman.<br class="d-none d-lg-block" />
                Kami ada untuk membawa Anda lebih dekat ke momen yang tak terlupakan.
            </p>
            <a href="#grow-today" class="btn-green">
                Cari sekarang
            </a>
        </div>

        <div class="header-image">
    <div class="image-container">
        <img src="assets/images/poster1-nct.png" alt="NCT">
        <img src="assets/images/poster1-thescript.png" alt="The Script">
        <img src="assets/images/poster1-svt.png" alt="SVT">
        <img src="assets/images/poster1-maroon.png" alt="Maroon 5">
        <img src="assets/images/poster1-wte.png" alt="WTE">
        <img src="assets/images/poster1-keshi.png" alt="Keshi">
        <img src="assets/images/poster1-niki.png" alt="NIKI">
    </div>
</div>
    </header>

    <section class="grow-today">
    <div class="container">
        <div class="sub-title mb-1" id="grow-today" style="margin-top:70px;">
            <span class="text-gradient-pink"><b>Info Terkini</b></span>
        </div>
        <div class="title" style="margin-bottom: 50px;">
        <b>Acara Serupa</b>
        </div>

        <section class="events"> <!-- Kontainer untuk kartu acara -->
            <?php
            // Menampilkan data acara dalam bentuk card
            if ($result->num_rows > 0) {
                while ($event = $result->fetch_assoc()) {
                    ?>
                    <div class="event-card">
                        <!-- Link untuk membungkus gambar dan seluruh card -->
                        <a href="detail.php?id=<?php echo $event['id']; ?>" class="event-link">
                            <!-- Label Baru -->
                            <div class="new-label">Baru</div>
                            <img src="<?php echo $event['image_co']; ?>" alt="<?php echo $event['title']; ?>" class="event-image" />
                        </a>
                        <div class="card-content">
                            <div class="card-title">
                                <?php echo $event['title']; ?>
                            </div>
                            <div class="card-subtitle">
                                <?php echo $event['subtitle']; ?>
                            </div>
                            <div class="event-location">
                                <?php echo $event['location']; ?>  <!-- Menampilkan lokasi -->
                            </div>
                            <div class="description">
                                18.30 WIB <br> 
                                <?php echo $event['event_date']; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "No events found.";
            }
            ?>
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