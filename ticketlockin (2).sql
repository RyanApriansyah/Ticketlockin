-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 27, 2025 at 05:11 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticketlockin`
--

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_penerbangan`
--

CREATE TABLE `jadwal_penerbangan` (
  `id_jadwal` int NOT NULL,
  `id_rute` int NOT NULL,
  `waktu_go` time NOT NULL,
  `waktu_land` time NOT NULL,
  `harga` int NOT NULL,
  `kap_kursi` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jadwal_penerbangan`
--

INSERT INTO `jadwal_penerbangan` (`id_jadwal`, `id_rute`, `waktu_go`, `waktu_land`, `harga`, `kap_kursi`) VALUES
(1, 1, '17:30:38', '00:30:38', 190000, 22),
(4, 3, '09:36:00', '10:37:00', 200000, 27),
(6, 5, '18:06:00', '20:09:00', 8000000, 20);

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id_kota` int NOT NULL,
  `nama_kota` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id_kota`, `nama_kota`) VALUES
(2, 'jekarda'),
(3, 'makassar'),
(4, 'pontianak'),
(5, 'bangka'),
(6, 'riau'),
(7, 'jogjakarta'),
(8, 'apex lejen');

-- --------------------------------------------------------

--
-- Table structure for table `maskapai`
--

CREATE TABLE `maskapai` (
  `id_maskapai` int NOT NULL,
  `foto_maskapai` text NOT NULL,
  `nama_maskapai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `maskapai`
--

INSERT INTO `maskapai` (`id_maskapai`, `foto_maskapai`, `nama_maskapai`) VALUES
(1, 'garuda.jpg', 'garuda\r\n'),
(3, 'Screenshot 2024-12-08 200429.png', 'hacker airline'),
(4, 'Screenshot (94).png', 'air asia '),
(5, 'Screenshot 2025-04-09 205242.png', 'pathfinder');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id_order_detail` int NOT NULL,
  `id_user` int NOT NULL,
  `id_penerbangan` int NOT NULL,
  `id_order` varchar(255) NOT NULL,
  `jumlah_tiket` int NOT NULL,
  `total_harga` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id_order_detail`, `id_user`, `id_penerbangan`, `id_order`, `jumlah_tiket`, `total_harga`) VALUES
(1, 7, 1, '680d27dbb81ac', 1, 190000),
(2, 7, 6, '680de54bdd610', 3, 24000000),
(3, 7, 4, '680e17b53dcaf', 3, 600000),
(4, 7, 4, '680e5362ef43d', 1, 200000),
(5, 7, 4, '680e5ad92f229', 2, 400000);

-- --------------------------------------------------------

--
-- Table structure for table `order_tiket`
--

CREATE TABLE `order_tiket` (
  `id_order` varchar(255) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `struk` varchar(255) NOT NULL,
  `status` enum('proses','terverivikasi') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_tiket`
--

INSERT INTO `order_tiket` (`id_order`, `tanggal_transaksi`, `struk`, `status`) VALUES
('680d27dbb81ac', '2025-04-26', '8ef2ce1a62bbaa271e53', 'terverivikasi'),
('680de54bdd610', '2025-04-27', 'd8de805968a5d52074ea', 'terverivikasi'),
('680e17b53dcaf', '2025-04-27', 'eb7892c2b169f8544ddd', 'proses'),
('680e5362ef43d', '2025-04-27', '0cb9d17db6163eece18d', 'proses'),
('680e5ad92f229', '2025-04-27', '842761553c7cd18f51a2', 'proses');

-- --------------------------------------------------------

--
-- Table structure for table `rute`
--

CREATE TABLE `rute` (
  `id_rute` int NOT NULL,
  `id_maskapai` int NOT NULL,
  `rute_asal` varchar(255) NOT NULL,
  `rute_tujuan` varchar(255) NOT NULL,
  `tanggal_go` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rute`
--

INSERT INTO `rute` (`id_rute`, `id_maskapai`, `rute_asal`, `rute_tujuan`, `tanggal_go`) VALUES
(1, 3, 'pontianak', 'jekarda', '2025-04-25'),
(3, 5, 'makassar', 'riau', '2025-04-27'),
(4, 4, 'pontianak', 'bangka', '2025-04-28'),
(5, 3, 'makassar', 'pontianak', '2025-04-29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `roles` enum('penumpang','petugas','admin') NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `username`, `email`, `roles`, `password`) VALUES
(7, 'ryane ganteng', 'ryan', 'ryane@gmail.com', 'penumpang', '123ryan'),
(8, 'ryanadmin ganteng', 'ryanadmin', 'ryana@gmail.com', 'admin', '123ryan'),
(9, 'ryanpetugas ', 'ryanp', 'ryanp@gmail.com', 'petugas', '123ryan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwal_penerbangan`
--
ALTER TABLE `jadwal_penerbangan`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_rute` (`id_rute`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `maskapai`
--
ALTER TABLE `maskapai`
  ADD PRIMARY KEY (`id_maskapai`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id_order_detail`),
  ADD KEY `id_jadwal` (`id_penerbangan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_order` (`id_order`);

--
-- Indexes for table `order_tiket`
--
ALTER TABLE `order_tiket`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`id_rute`),
  ADD KEY `id_maskapai` (`id_maskapai`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal_penerbangan`
--
ALTER TABLE `jadwal_penerbangan`
  MODIFY `id_jadwal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id_kota` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `maskapai`
--
ALTER TABLE `maskapai`
  MODIFY `id_maskapai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id_order_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rute`
--
ALTER TABLE `rute`
  MODIFY `id_rute` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal_penerbangan`
--
ALTER TABLE `jadwal_penerbangan`
  ADD CONSTRAINT `jadwal_penerbangan_ibfk_1` FOREIGN KEY (`id_rute`) REFERENCES `rute` (`id_rute`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`id_penerbangan`) REFERENCES `jadwal_penerbangan` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_detail_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_detail_ibfk_4` FOREIGN KEY (`id_order`) REFERENCES `order_tiket` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rute`
--
ALTER TABLE `rute`
  ADD CONSTRAINT `rute_ibfk_1` FOREIGN KEY (`id_maskapai`) REFERENCES `maskapai` (`id_maskapai`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
