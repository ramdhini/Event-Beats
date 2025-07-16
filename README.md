# EventBeats: Sistem Pemesanan Tiket Konser Online


EventBeats adalah aplikasi berbasis web yang menyediakan layanan pemesanan tiket konser yang komprehensif untuk semua acara di seluruh Indonesia. Dirancang untuk memberikan akses tanpa hambatan bagi pengguna, mulai dari penemuan acara hingga pembelian tiket, EventBeats menjadikan pengalaman mencari dan mendapatkan tiket konser menjadi lebih mudah dan menyenangkan.

## Fitur Utama

* **Pencarian & Penemuan Event:** Jelajahi daftar konser dan event berdasarkan lokasi, tanggal, genre musik, atau artis.
* **Detail Event Lengkap:** Dapatkan informasi detail tentang setiap event, termasuk jadwal, lokasi, deskripsi artis, dan harga tiket yang tersedia.
* **Pemesanan Tiket Mudah:** Proses pembelian tiket yang intuitif dan cepat.
* **Manajemen Akun Pengguna:** Pengguna dapat membuat akun, melihat riwayat pemesanan, dan melakukan pencarian berbagai tiket konser.
* **Pembayaran Aman:** Integrasi dengan metode pembayaran yang aman untuk transaksi yang terjamin. 

## Teknologi yang Digunakan

* **Frontend:**
    * HTML5
    * CSS
    * JavaScript 
* **Backend:**
    * PHP 
* **Database:**
    * MySQL

## Persyaratan Sistem

Untuk menjalankan sistem EventBeats ini, Anda memerlukan lingkungan server web yang mendukung PHP dan MySQL. Rekomendasi:

* **Web Server:** Apache atau Nginx
* **PHP:** Versi 7.x atau lebih tinggi 
* **MySQL:** Versi 5.x atau lebih tinggi
* **XAMPP/WAMP/MAMP:** Direkomendasikan untuk pengembangan dan pengujian lokal karena sudah bundling Apache, MySQL, dan PHP dalam satu paket instalasi.

## Instalasi

Ikuti langkah-langkah di bawah ini untuk menginstal dan menjalankan Sistem Pemesanan Tiket Konser Online EventBeats di lingkungan lokal Anda:

1.  **Clone Repository:**
    Buka Git Bash atau terminal Anda, lalu jalankan perintah berikut:
    ```bash
    git clone [https://github.com/ramdhini/EventBeats.git](https://github.com/ramdhini/EventBeats.git)
    ```
    Atau Anda juga dapat mengunduh file ZIP dari repositori GitHub.

2.  **Pindahkan ke Direktori Web Server:**
    * Setelah di-clone/diunduh, pindahkan folder `Event-Beats` ke direktori root dokumen server web lokal Anda:
        * Jika menggunakan **XAMPP**, pindahkan ke `C:\xampp\htdocs\`.
        * Jika menggunakan **WAMP**, pindahkan ke `C:\wamp64\www\`.
        * Jika menggunakan **MAMP**, pindahkan ke direktori `htdocs` MAMP Anda.

3.  **Buat Database:**
    * Buka peramban web Anda dan akses phpMyAdmin (biasanya melalui `http://localhost/phpmyadmin`).
    * Buat database baru dengan nama **`eventbeast`**.

4.  **Impor Database:**
    * Pilih database `eventbeast` yang baru Anda buat di phpMyAdmin.
    * Klik tab `Import` pada navigasi atas.
    * Pilih file SQL database `eventbeast.sql` yang seharusnya ada di dalam folder proyek `Event-Beats` Anda.
    * Klik tombol `Go` untuk memulai proses impor tabel.

5.  **Konfigurasi Koneksi Database:**
    * Buka file konfigurasi koneksi database Anda `db.php` di dalam folder proyek `Event-Beats` Anda menggunakan editor teks.
    * Pastikan isinya sudah sesuai dengan pengaturan database lokal Anda. Contoh:
        ```php
        <?php
$host = 'localhost';
$user = 'root'; 
$password = ''; 
$dbname = 'eventbeast';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}
?>
        ```
        (Tidak ada perubahan yang diperlukan jika file Anda sudah seperti di atas dan nama database Anda adalah `eventbeast`, karena sudah sesuai dengan pengaturan XAMPP/WAMP default dan nama database.)

6.  **Akses Aplikasi:**
    * Setelah semua langkah di atas selesai, buka peramban web Anda.
    * Navigasi ke URL: `http://localhost/Event-Beats/` (sesuaikan jika Anda mengganti nama folder proyek Anda).

## Kredensial Default (Contoh)

Untuk tujuan pengujian setelah instalasi, Anda dapat menggunakan kredensial default berikut:

* **Pengguna:**
    * Username: `dhini@gmail.com` *(Contoh, sesuaikan dengan data di database Anda)*
    * Password: `password2` *(Contoh, sesuaikan dengan data di database Anda)*

*(**Penting:** Demi keamanan, sangat disarankan untuk segera mengubah kredensial default ini setelah instalasi berhasil.)*

## Kontribusi

Kontribusi disambut baik! Jika Anda ingin berkontribusi, silakan fork repositori ini dan buat pull request dengan fitur atau perbaikan Anda.



## Kontak

Jika Anda memiliki pertanyaan, saran, atau ingin melaporkan masalah, silakan hubungi:

* [Ramdhini] - [ramdhininovita0811@gmail.com]



