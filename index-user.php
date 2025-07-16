<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventBeast</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/scss/index.css" />
</head>

<body>
<?php include 'header.php';?>

        <div class="hero">
            <div class="hero-headline">
                <span class="text-gradient-pink"> Jangan </span> Sampai Ketinggalan! <br class="d-none d-lg-block" /> Pengalaman <span class="text-gradient-blue"> Konser </span> yang Tak Terlupakan
            </div>

            <p class="hero-paragraph">
                Pesan tiket untuk acara favorit Anda dengan cepat dan aman.<br class="d-none d-lg-block" />
                Kami ada untuk membawa Anda lebih dekat ke momen yang tak terlupakan.
            </p>
            <a href="#grow-today" class="btn-green">
                Cari sekarang
            </a>
        </div>

        <div class="d-flex flex-row flex-nowrap justify-content-center align-items-center gap-5 header-image">
            <img src="assets/images/poster1-nct.png">
            <img src="assets/images/poster1-thescript.png">
            <img src="assets/images/poster1-svt.png">
            <img src="assets/images/poster1-maroon.png">
            <img src="assets/images/poster1-wte.png">
            <img src="assets/images/poster1-keshi.png">
            <img src="assets/images/poster1-niki.png">
        </div>
    </header>

    <section class="grow-today">
        <div class="container">
            <div class="sub-title mb-1" id="grow-today" style="margin-top:70px;">
                <span class="text-gradient-pink">Info Terkini</span>
            </div>
            <div class="title" style="margin-bottom: 50px;">
                Acara Serupa
            </div>

            <div class="d-flex flex-row flex-nowrap justify-content-center align-items-center gap-4">
                <!-- CARD 1 -->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card-grow h-100">
                        <span class="badge-pricing">Baru</span>
                        <img src="assets/images/poster2-wte.png"/>
                        <div class="card-content">
                            <div class="card-title">
                                Play With Earth
                            </div>
                            <div class="card-subtitle">
                                Wave to Earth 
                            </div>
                            <div class="description">
                                Jakarta, 13 Feb 2025 <br> 18.30 WIB
                            </div>
                            <a href="detail.php?id=1" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card-grow h-100">
                        <span class="badge-pricing">Baru</span>
                        <img src="assets/images/poster2-thescript.png"/>
                        <div class="card-content">
                            <div class="card-title">
                                Satellites World Tour
                            </div>
                            <div class="card-subtitle">
                                The Script
                            </div>
                            <div class="description">
                                Surabaya, 16 Feb 2025 <br> 18.30 WIB
                            </div>
                            <a href="detail.php?id=2"  class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card-grow h-100">
                        <span class="badge-pricing">Baru</span>
                        <img src="assets/images/poster2-svt.png"/>
                        <div class="card-content">
                            <div class="card-title">
                                Right Here World Tour Asia
                            </div>
                            <div class="card-subtitle">
                                Seventeen
                            </div>
                            <div class="description">
                                Jakarta, 09 Feb 2025 <br> 18.30 WIB
                            </div>
                            <a href="detail.php?id=3"  class="stretched-link"></a>
                        </div>
                    </div>
                </div>


                <!-- CARD 4 -->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card-grow h-100">
                        <span class="badge-pricing">Baru</span>
                        <img src="assets/images/poster2-nct.png"/>
                        <div class="card-content">
                            <div class="card-title">
                                The Momentum
                            </div>
                            <div class="card-subtitle">
                                NCT 127
                            </div>
                            <div class="description">
                                Jakarta, 23 Feb 2025 <br> 18.30 WIB
                            </div>
                            <a href="detail.php?id=4"  class="stretched-link"></a>
                        </div>
                    </div>
                </div>
                <!--CARD 5-->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card-grow h-100">
                        <span class="badge-pricing">Baru</span>
                        <img src="assets/images/poster2-maroon.png"/>
                        <div class="card-content">
                            <div class="card-title">
                                Maroon 5 ASIA 2025
                            </div>
                            <div class="card-subtitle">
                                Maroon 5
                            </div>
                            <div class="description">
                                Jakarta, 01 Feb 2025 <br> 18.30 WIB
                            </div>
                            <a href="detail.php?id=1" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                <!--CARD 6-->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card-grow h-100">
                        <span class="badge-pricing">Baru</span>
                        <img src="assets/images/poster2-niki.png"/>
                        <div class="card-content">
                            <div class="card-title">
                                Buzz World Tour in Jakarta
                            </div>
                            <div class="card-subtitle">
                                NIKI
                            </div>
                            <div class="description">
                                Jakarta, 14 & 16 Feb 2025 <br> 18.30 WIB
                            </div>
                            <a href="detail.php" class="stretched-link"></a>
                        </div>
                    </div>
                </div>

                <!--CARD 7-->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card-grow h-100">
                        <span class="badge-pricing">Baru</span>
                        <img src="assets/images/poster2-keshi.png"/>
                        <div class="card-content">
                            <div class="card-title">
                                Requim Tour
                            </div>
                            <div class="card-subtitle">
                                Keshi
                            </div>
                            <div class="description">
                                Jakarta, 23 Feb 2025 <br> 18.30 WIB
                            </div>
                            <a href="detail.php" class="stretched-link"></a>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </section>

    <section class="stories" id="tentang">
        <div class="d-flex flex-row justify-content-center align-items-center container">
            <img src="assets/images/foto-about.png" alt="semina" class="d-none d-lg-block" width="515" />
            <div class="d-flex flex-column">
                <div>
                    <div class="sub-title">
                        <span class="text-gradient-pink">Tentang EventBeast</span>
                    </div>
                    <div class="title">
                        Untuk Pengalaman <br class="d-none d-lg-block" />
                        Terbaikmu!
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