-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2022 at 09:26 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mma_gym_tes`
--

-- --------------------------------------------------------

--
-- Table structure for table `alat`
--

CREATE TABLE `alat` (
  `id_alat` int(11) NOT NULL,
  `nama_alat` varchar(30) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`id_alat`, `nama_alat`, `gambar`) VALUES
(2, 'tread mil', 'success'),
(3, 'resistan-belt', 'resistan-belt.jpg'),
(23, 'dummbella', '1YV2CYs8AX7ZgQFMCyfGuzEGfcnVdqxUD'),
(24, 'benchpress', '1dLsl3IcBgAHenj3bshRk_oxKGT8lQF-Z'),
(26, 'treadmil', '15UH3hBG_-hVcXL4ptN3djlMXKA_3jvKk');

-- --------------------------------------------------------

--
-- Table structure for table `gerakan`
--

CREATE TABLE `gerakan` (
  `id_gerakan` int(11) NOT NULL,
  `nama_gerakan` varchar(30) NOT NULL,
  `video` varchar(50) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `id_alat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gerakan`
--

INSERT INTO `gerakan` (`id_gerakan`, `nama_gerakan`, `video`, `gambar`, `id_alat`) VALUES
(1, 'lari', '1_t6r_wfZrKn_D5hy2NyxQh0REKyowbLI', '1reSkNZHny6iXhdV-ZlhSz5Y3qsPMQm0O', 2),
(5, 'gerakan', '1kq7SuewPzFwDRARgtGbOiapbT2_sfayd', '10Br6JpOq-hY-kJEkA7wz3bAkNP3Q7Q2i', 3),
(6, 'tes api data with video', '1kkccBLQQYvItAyyR5UVg1dtRFSswdls2', '1UkIqnrBXH3hkoWEOCU5vPadNwUYV3PzB', 2);

-- --------------------------------------------------------

--
-- Table structure for table `gerakan_menu`
--

CREATE TABLE `gerakan_menu` (
  `repetisi` int(11) NOT NULL,
  `setlatihan` int(11) NOT NULL,
  `note` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `id_rincian_latihan` int(11) NOT NULL,
  `id_gerakan` int(11) NOT NULL,
  `id_menu_latihan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `gerakan_menu`
--

INSERT INTO `gerakan_menu` (`repetisi`, `setlatihan`, `note`, `id_rincian_latihan`, `id_gerakan`, `id_menu_latihan`) VALUES
(1, 1, '1 kilometer', 1, 1, 1),
(1, 1, '60 menit', 2, 5, 1),
(10, 2, 'tes catatatn', 3, 6, 1),
(2, 1, 'edit note tes', 6, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_latihan`
--

CREATE TABLE `jadwal_latihan` (
  `id_jadwal` int(11) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_menu_latihan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_latihan`
--

INSERT INTO `jadwal_latihan` (`id_jadwal`, `hari`, `id_user`, `id_menu_latihan`) VALUES
(1, 'senin', 1, 1),
(2, 'selasa', 1, 2),
(3, 'minggu', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_latihan`
--

CREATE TABLE `menu_latihan` (
  `id_menu_latihan` int(11) NOT NULL,
  `nama_menu_latihan` varchar(50) NOT NULL,
  `part` varchar(10) NOT NULL,
  `level` varchar(10) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_latihan`
--

INSERT INTO `menu_latihan` (`id_menu_latihan`, `nama_menu_latihan`, `part`, `level`, `gambar`) VALUES
(1, 'contoh data', 'badan', 'beginer', '1Zuh2SDSzsjmmn8rMawJ6iHxMJxfCE2B_'),
(2, 'contoh data 2', 'seluruh ba', 'beginer', 'contoh2.jpg'),
(3, 'tes api', 'badan', 'pemula', '1AkyfvQwiIyXNOXrtk9FHA5e9H9gD1i8v'),
(4, 'Ruth Britt', 'Yvonne Cru', 'menengah', '1Co3Yv0g9qsXW_kxWLq4RY5EiqamZ6riB'),
(5, 'Kelly Mcleod', 'Freya Reye', 'menengah', '1ChW5n3RWl7Q3EeAdiBFY6VagWatC1wha');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `email` varchar(255) NOT NULL,
  `otp` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`email`, `otp`) VALUES
('coba@coab.cob', 8590),
('bachtiarah73@gmal.com', 3506),
('fuuigsi', 6831);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `tanggal_waktu` date NOT NULL,
  `id` int(11) NOT NULL,
  `id_gerakan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat`
--

INSERT INTO `riwayat` (`tanggal_waktu`, `id`, `id_gerakan`) VALUES
('2022-11-10', 1, 1),
('2022-11-09', 1, 5),
('2022-11-09', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usermma`
--

CREATE TABLE `usermma` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(50) NOT NULL,
  `Alamat` varchar(200) NOT NULL,
  `akses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usermma`
--

INSERT INTO `usermma` (`id`, `nama`, `password`, `email`, `Alamat`, `akses`) VALUES
(1, 'Bachtiar Arya Habibie', '12344321', 'bachtiar@mma.gym', 'jln belitung no 17 kecamatan Sumbersari Kabupaten Jember', 2),
(2, 'Syarafina Khalishah', '170903', 'syarafina17@gmail.com', 'Bondowoso', 1),
(4, 'Nugroho Jeri', 'qwerty', 'jeri@nug.com', 'Pacitan', 2),
(5, 'coba', 'qwer', 'coba@coab.cob', 'jember', 0),
(6, 'bachtiar', 'bachtiar', 'bachtiarah73@gmail.com', 'jember', 1),
(14, 'Suscip', 'Pa$$w0rd!', 'xakoku@mailinator.com', 'Molestiae in amet o', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id_alat`);

--
-- Indexes for table `gerakan`
--
ALTER TABLE `gerakan`
  ADD PRIMARY KEY (`id_gerakan`),
  ADD KEY `gerakan_ibfk_1` (`id_alat`);

--
-- Indexes for table `gerakan_menu`
--
ALTER TABLE `gerakan_menu`
  ADD PRIMARY KEY (`id_rincian_latihan`),
  ADD KEY `tes` (`id_gerakan`),
  ADD KEY `tes2` (`id_menu_latihan`);

--
-- Indexes for table `jadwal_latihan`
--
ALTER TABLE `jadwal_latihan`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `menu_latihan` (`id_menu_latihan`);

--
-- Indexes for table `menu_latihan`
--
ALTER TABLE `menu_latihan`
  ADD PRIMARY KEY (`id_menu_latihan`);

--
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id`,`id_gerakan`),
  ADD KEY `id_gerakan` (`id_gerakan`);

--
-- Indexes for table `usermma`
--
ALTER TABLE `usermma`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alat`
--
ALTER TABLE `alat`
  MODIFY `id_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `gerakan`
--
ALTER TABLE `gerakan`
  MODIFY `id_gerakan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `gerakan_menu`
--
ALTER TABLE `gerakan_menu`
  MODIFY `id_rincian_latihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jadwal_latihan`
--
ALTER TABLE `jadwal_latihan`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu_latihan`
--
ALTER TABLE `menu_latihan`
  MODIFY `id_menu_latihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `usermma`
--
ALTER TABLE `usermma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gerakan`
--
ALTER TABLE `gerakan`
  ADD CONSTRAINT `gerakan_ibfk_1` FOREIGN KEY (`id_alat`) REFERENCES `alat` (`id_alat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gerakan_menu`
--
ALTER TABLE `gerakan_menu`
  ADD CONSTRAINT `gerakan_menu_ibfk_1` FOREIGN KEY (`id_gerakan`) REFERENCES `gerakan` (`id_gerakan`) ON DELETE CASCADE,
  ADD CONSTRAINT `gerakan_menu_ibfk_2` FOREIGN KEY (`id_menu_latihan`) REFERENCES `menu_latihan` (`id_menu_latihan`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal_latihan`
--
ALTER TABLE `jadwal_latihan`
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `usermma` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_latihan` FOREIGN KEY (`id_menu_latihan`) REFERENCES `menu_latihan` (`id_menu_latihan`) ON DELETE CASCADE;

--
-- Constraints for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD CONSTRAINT `riwayat_ibfk_1` FOREIGN KEY (`id`) REFERENCES `usermma` (`id`),
  ADD CONSTRAINT `riwayat_ibfk_2` FOREIGN KEY (`id_gerakan`) REFERENCES `gerakan` (`id_gerakan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
