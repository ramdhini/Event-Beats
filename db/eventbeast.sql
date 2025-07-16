-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2025 at 06:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: `eventbeast`
CREATE DATABASE IF NOT EXISTS `eventbeast`;
USE `eventbeast`;

-- --------------------------------------------------------

-- Table structure for table `events`
CREATE TABLE `events` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `subtitle` VARCHAR(255) NOT NULL,
  `artist` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `price` VARCHAR(20) NOT NULL, -- Menggunakan VARCHAR untuk menyimpan harga dengan titik
  `event_date` VARCHAR(255) NOT NULL, -- Tetap menggunakan VARCHAR untuk teks tanggal
  `image_details` VARCHAR(255) NOT NULL,
  `image_co` VARCHAR(255) NOT NULL, 
  `location` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `events`
INSERT INTO `events` (`id`, `title`, `subtitle`, `artist`, `description`, `price`, `event_date`, `image_details`, `image_co`, `location`) VALUES
(1, 'Play With Earth', 'Wave To Earth', 'Band/Musisi', 'Bersiaplah untuk tenggelam dalam alunan musik yang menenangkan bersama Wave to Earth, band indie asal Korea Selatan yang telah memukau pendengar di seluruh dunia. Dengan perpaduan unik antara indie rock, jazz, dan lo-fi, mereka menciptakan melodi yang mengalir seperti ombak dan lirik puitis yang menggugah emosi.', '858.000', '13 Februari 2025', 'assets/images/details-wte.png', 'assets/images/payment-wte.png', 'Istora Senayan, Jakarta'),
(2, 'Satellities World Tour', 'The Script', 'Band Rock', 'The Script merupakan band rock asal Irlandia, dibentuk di Dublin pada 2007. Band ini awalnya terdiri atas tiga anggota utama, yaitu Danny O Donoghue sebagai vokalis, Mark Sheehan gitaris, dan Glen Power drummer.', '1.150.000', '14 Februari 2025', 'assets/images/details-ts.png', 'assets/images/payment-ts.png', 'ICE BSD CITY, Jakarta'),
(3, 'Right Here World Tour Asia', 'Seventeen', 'Grup Vokal Pria', 'Seventeen, boy group asal Korea Selatan yang dibentuk oleh Pledis Entertainment, telah mencuri hati jutaan penggemar di seluruh dunia dengan bakat, kerja keras, dan chemistry luar biasa antar anggotanya. Debut pada tahun 2015. Seventeen terdiri dari 13 anggota yang berbagi peran dalam tiga sub-unit: Vocal Unit, Hip-Hop Unit, dan Performance Unit.', '3.500.000', '09 Februari 2025', 'assets/images/details-svt.png', 'assets/images/payment-svt.png', 'JIS, Jakarta'),
(4, 'The Momentum', 'NCT 127', 'Grup Vocal Pria', 'NCT 127 adalah salah satu sub-unit dari grup global NCT yang bernaung di bawah SM Entertainment. Dibentuk pada tahun 2016, 127 merujuk pada garis bujur Seoul, mencerminkan akar budaya mereka yang mendunia.', '3.500.000', '09 Februari 2025', 'assets/images/details-nct.png', 'assets/images/payment-nct.png', 'Istora Senayan, Jakarta'),
(5, 'Asia Tour', 'Maroon 5', 'Band', 'Maroon 5 adalah grup band pop rock asal Amerika Serikat yang berdiri sejak tahun 1994 dengan nama awal Kara s Flower. Pada era Kara s Flower, personil aslinya adalah Adam Levine (vokal, gitar), Jesse Carmichael (gitar), Mickey Madden (bass), dan Ryan Dusick (drum). Tahun 2001, Kara s Flower menambahkan seorang gitaris, James Valentine, dan mengubah namanya menjadi Maroon 5.', '2.350.000', '01 Februari 2025', 'assets/images/details-maroon.png', 'assets/images/payment-maroon.png', 'JIS, Jakarta'),
(6, 'Buzz World Tour in Jakarta', 'NIKI', 'Penyanyi', 'NIKI atau Niki Zefanya adalah seorang penyanyi, penulis lagu, dan produser musik berdarah Indonesia yang berkarier secara internasional di bawah label 88rising yang berbasis di Amerika Serikat.', '1.250.000', '09 Februari 2025', 'assets/images/details-niki.png', 'assets/images/payment-niki.png', 'Beach City International Stadium, Jakarta'),
(7, 'REQUIEM World Tour', 'Keshi', 'Penyanyi', 'Keshi (nama asli: Casey Luong) adalah seorang seniman multitalenta asal Amerika yang dikenal sebagai penyanyi, penulis lagu, produser rekaman, dan multi-instrumentalis. Ia terkenal karena vokal falsetto yang unik dan musiknya yang kaya akan tekstur.', '1.175.000', '23 Februari 2025', 'assets/images/details-keshi.png', 'assets/images/payment-keshi.png', 'Istora Senayan, Jakarta');

-- --------------------------------------------------------

-- Table structure for table `users`
CREATE TABLE `users` (
  `id_user` INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `first_name` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NOT NULL,
  `phone_number` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `users`
INSERT INTO `users` (`id_user`, `email`, `password`, `first_name`, `last_name`, `phone_number`) VALUES
(1, 'admin@gmail.com', 'admin', 'Admin', 'User ', '1234567890'),
(2, 'user1@gmail.com', 'password1', 'Rahmat', 'Angga', '087709239927'),
(3, 'dhini@gmail.com', 'password2', 'Dhini', 'Novita', '123456');

-- --------------------------------------------------------

-- Table structure for table `transactions`
CREATE TABLE `transactions` (
  `id_transaksi` INT(11) NOT NULL AUTO_INCREMENT,
  `id_user` INT(11) NOT NULL,
  `id` INT(11) NOT NULL,
  `transaction_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quantity` INT(11) NOT NULL,
  `total_price` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  FOREIGN KEY (`id_user`) REFERENCES `users`(`id_user`) ON DELETE CASCADE,
  FOREIGN KEY (`id`) REFERENCES `events`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `transactions`
INSERT INTO `transactions` (`id_user`, `id`, `quantity`, `total_price`) VALUES
(2, 1, 2, '1.716.000'),  -- User 2 buys 2 tickets for event 1
(3, 2, 1, '1.150.000'),  -- User 3 buys 1 ticket for event 2
(2, 3, 3, '10.500.000');  -- User 2 buys 3 tickets for event 3

COMMIT;