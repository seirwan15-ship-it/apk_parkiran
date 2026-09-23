-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2026 at 02:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkir`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_area_parkir`
--

CREATE TABLE `tb_area_parkir` (
  `id_area` int(11) NOT NULL,
  `nama_area` varchar(50) DEFAULT NULL,
  `kapasitas` int(11) DEFAULT NULL,
  `terisi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_area_parkir`
--

INSERT INTO `tb_area_parkir` (`id_area`, `nama_area`, `kapasitas`, `terisi`) VALUES
(1, 'A', 50, 10),
(2, 'B', 40, 15),
(3, 'C', 30, 20),
(4, 'D', 20, 5),
(5, 'E', 60, 25),
(6, 'F', 35, 18),
(7, 'G', 45, 22),
(8, 'H', 25, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kendaraan`
--

CREATE TABLE `tb_kendaraan` (
  `id_kendaraan` int(11) NOT NULL,
  `plat_nomor` varchar(15) DEFAULT NULL,
  `jenis_kendaraan` varchar(20) DEFAULT NULL,
  `warna` varchar(20) DEFAULT NULL,
  `pemilik` varchar(100) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kendaraan`
--

INSERT INTO `tb_kendaraan` (`id_kendaraan`, `plat_nomor`, `jenis_kendaraan`, `warna`, `pemilik`, `id_user`) VALUES
(1, 'B1234AA', 'motor', 'hitam', 'Andi', 1),
(2, 'B2345BB', 'mobil', 'putih', 'Budi', 2),
(3, 'B3456CC', 'motor', 'merah', 'Citra', 3),
(4, 'B4567DD', 'mobil', 'hitam', 'Dedi', 4),
(5, 'B5678EE', 'motor', 'biru', 'Eka', 5),
(6, 'B6789FF', 'mobil', 'abu', 'Fajar', 6),
(10, 'D 2836 CCD', 'motor', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_log_aktivitas`
--

CREATE TABLE `tb_log_aktivitas` (
  `id_log` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `aktivitas` varchar(100) DEFAULT NULL,
  `waktu_aktivitas` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_log_aktivitas`
--

INSERT INTO `tb_log_aktivitas` (`id_log`, `id_user`, `aktivitas`, `waktu_aktivitas`) VALUES
(1, 1, 'login', '2026-04-18 07:00:00'),
(2, 2, 'input kendaraan', '2026-04-18 08:00:00'),
(3, 3, 'lihat laporan', '2026-04-18 09:00:00'),
(4, 4, 'update data', '2026-04-18 10:00:00'),
(5, 5, 'login', '2026-04-18 11:00:00'),
(6, 6, 'input transaksi', '2026-04-18 12:00:00'),
(9, 1, NULL, '2026-04-19 10:04:58'),
(10, 3, NULL, '2026-04-19 10:22:42'),
(11, 2, NULL, '2026-04-19 10:23:56'),
(12, 3, NULL, '2026-04-19 10:26:07'),
(13, 2, NULL, '2026-04-19 10:27:00'),
(14, 3, NULL, '2026-04-19 15:54:14'),
(15, 2, NULL, '2026-04-19 15:58:57'),
(16, 2, NULL, '2026-04-19 16:52:23'),
(17, 2, NULL, '2026-04-19 16:58:20'),
(18, 2, NULL, '2026-04-20 03:17:36'),
(19, 1, NULL, '2026-04-22 03:21:44'),
(20, 1, NULL, '2026-04-22 03:28:02'),
(21, 1, NULL, '2026-04-22 03:39:02'),
(22, 1, NULL, '2026-04-22 03:43:03'),
(23, 1, NULL, '2026-04-22 04:14:56'),
(24, 3, NULL, '2026-04-22 04:22:52'),
(25, 1, NULL, '2026-04-22 04:23:10'),
(26, 3, NULL, '2026-04-22 04:29:54'),
(27, 2, NULL, '2026-04-22 04:30:16'),
(28, 2, NULL, '2026-04-22 04:30:57'),
(29, 1, NULL, '2026-04-22 14:38:07'),
(30, 1, NULL, '2026-04-22 15:09:15'),
(31, 1, NULL, '2026-04-23 03:59:37'),
(32, 1, NULL, '2026-04-23 04:15:42'),
(33, 1, NULL, '2026-04-23 04:15:55'),
(34, 2, NULL, '2026-04-23 04:24:34'),
(35, 2, NULL, '2026-04-23 04:27:34'),
(36, 3, NULL, '2026-04-23 04:28:14'),
(37, 3, NULL, '2026-04-23 04:31:59'),
(38, 1, NULL, '2026-04-23 04:32:40'),
(39, 3, NULL, '2026-04-23 04:32:58'),
(40, 2, NULL, '2026-04-23 04:33:13'),
(41, 1, NULL, '2026-04-23 04:33:30'),
(42, 1, NULL, '2026-04-23 10:41:22'),
(43, 2, NULL, '2026-04-23 11:46:15'),
(44, 3, NULL, '2026-04-23 11:47:06'),
(45, 2, NULL, '2026-04-23 11:54:02'),
(46, 1, NULL, '2026-04-23 12:00:54'),
(47, 1, NULL, '2026-04-23 12:20:10'),
(48, 2, NULL, '2026-04-23 13:44:51'),
(49, 3, NULL, '2026-04-23 13:45:33'),
(50, 1, NULL, '2026-04-23 13:50:41'),
(51, 3, NULL, '2026-04-23 14:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tarif`
--

CREATE TABLE `tb_tarif` (
  `id_tarif` int(11) NOT NULL,
  `jenis_kendaraan` enum('motor','mobil','lainnya') DEFAULT NULL,
  `tarif_per_jam` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_tarif`
--

INSERT INTO `tb_tarif` (`id_tarif`, `jenis_kendaraan`, `tarif_per_jam`) VALUES
(1, 'motor', 2000),
(2, 'mobil', 5000),
(3, 'lainnya', 3000),
(4, 'motor', 2500),
(5, 'mobil', 5500),
(6, 'lainnya', 3500),
(7, 'motor', 3000),
(8, 'mobil', 6000),
(9, 'mobil', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_parkir` int(11) NOT NULL,
  `id_kendaraan` int(11) DEFAULT NULL,
  `waktu_masuk` datetime DEFAULT NULL,
  `waktu_keluar` datetime DEFAULT NULL,
  `id_tarif` int(11) DEFAULT NULL,
  `durasi_jam` int(11) DEFAULT NULL,
  `biaya_total` decimal(10,0) DEFAULT NULL,
  `status` enum('masuk','keluar') DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_area` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_parkir`, `id_kendaraan`, `waktu_masuk`, `waktu_keluar`, `id_tarif`, `durasi_jam`, `biaya_total`, `status`, `id_user`, `id_area`) VALUES
(1, 1, '2026-04-18 08:00:00', '2026-04-18 10:00:00', 1, 2, 4000, 'keluar', 2, 1),
(2, 2, '2026-04-18 09:00:00', '2026-04-18 12:00:00', 2, 3, 15000, 'keluar', 2, 2),
(3, 3, '2026-04-18 10:00:00', '2026-04-18 11:00:00', 1, 1, 2000, 'keluar', 4, 3),
(4, 4, '2026-04-18 11:00:00', '2026-04-23 18:45:11', 2, 123, 615000, 'keluar', 4, 4),
(5, 5, '2026-04-18 07:00:00', '2026-04-18 09:00:00', 1, 2, 4000, 'keluar', 6, 5),
(6, 6, '2026-04-18 06:00:00', '2026-04-18 08:00:00', 2, 2, 10000, 'keluar', 6, 6),
(10, 10, '2026-04-23 18:45:09', NULL, 1, NULL, NULL, 'masuk', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` enum('admin','petugas','owner') DEFAULT NULL,
  `status_aktif` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_lengkap`, `username`, `password`, `role`, `status_aktif`) VALUES
(1, 'Andi Saputra', 'andi', 'andi123', 'admin', 1),
(2, 'Budi Santoso', 'budi', 'budi123', 'petugas', 1),
(3, 'Citra Dewi', 'citra', 'citra123', 'owner', 1),
(4, 'Dedi Kurniawan', 'dedi', 'dedi123', 'petugas', 1),
(5, 'Eka Putri', 'eka', 'eka123', 'petugas', 1),
(6, 'Fajar Nugroho', 'fajar', 'fajar123', 'petugas', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_area_parkir`
--
ALTER TABLE `tb_area_parkir`
  ADD PRIMARY KEY (`id_area`);

--
-- Indexes for table `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_tarif`
--
ALTER TABLE `tb_tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_parkir`),
  ADD KEY `id_kendaraan` (`id_kendaraan`),
  ADD KEY `id_tarif` (`id_tarif`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_area` (`id_area`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_area_parkir`
--
ALTER TABLE `tb_area_parkir`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tb_tarif`
--
ALTER TABLE `tb_tarif`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_parkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  ADD CONSTRAINT `tb_kendaraan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Constraints for table `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  ADD CONSTRAINT `tb_log_aktivitas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`id_kendaraan`) REFERENCES `tb_kendaraan` (`id_kendaraan`),
  ADD CONSTRAINT `tb_transaksi_ibfk_2` FOREIGN KEY (`id_tarif`) REFERENCES `tb_tarif` (`id_tarif`),
  ADD CONSTRAINT `tb_transaksi_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`),
  ADD CONSTRAINT `tb_transaksi_ibfk_4` FOREIGN KEY (`id_area`) REFERENCES `tb_area_parkir` (`id_area`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
