<?php
session_start(); // Memulai sesi

// Jika ada permintaan untuk logout
if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
    // Menghapus semua sesi yang aktif
    session_unset();

    // Menghancurkan sesi
    session_destroy();

    // Redirect ke halaman login
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Confirmation</title>
    <script>
        function confirmLogout() {
            // Menampilkan popup konfirmasi
            const isConfirmed = confirm("Apakah Anda yakin ingin keluar?");
            if (isConfirmed) {
                // Jika pengguna memilih "OK", arahkan ke logout dengan parameter confirm=yes
                window.location.href = "?confirm=yes";
            } else {
                // Jika pengguna memilih "Cancel", kembali ke halaman sebelumnya
                window.history.back();
            }
        }
        
    </script>
</head>
<body onload="confirmLogout()">
</body>
</html>