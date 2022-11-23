-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2022 at 04:07 AM
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
(23, 'dummbell', '1YV2CYs8AX7ZgQFMCyfGuzEGfcnVdqxUD'),
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
(1, 'lari', 'lari.mp4', 'lari.jpg', 2),
(5, 'gerakan', 'gerakan.mp4', 'gerakan.jpg', 3),
(6, 'tes api', '1gG0kHiI0Sbo4mNKMDJoO6Cw6-1mCmwYg', '', 23),
(7, 'tes api 2', '10KkWKYQroXMlTIILn1c0gEiwgUn0_2mt', '1R33ilG0YAXAT5yBLC7EcGhUBY5a8T2ZF', 23);

-- --------------------------------------------------------

--
-- Table structure for table `gerakan_menu`
--

CREATE TABLE `gerakan_menu` (
  `repetisi` int(11) NOT NULL,
  `setlatihan` int(11) NOT NULL,
  `note` varchar(20) NOT NULL,
  `id_gerakan` int(11) NOT NULL,
  `id_menu_latihan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gerakan_menu`
--

INSERT INTO `gerakan_menu` (`repetisi`, `setlatihan`, `note`, `id_gerakan`, `id_menu_latihan`) VALUES
(1, 1, '1 kilometer', 1, 1),
(1, 1, 'menit', 5, 1);

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
(1, 'contoh data', 'badan', 'beginer', 'contoh.jpg'),
(2, 'contoh data 2', 'seluruh ba', 'beginer', 'contoh2.jpg');

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
('coba@coab.cob', 8590);

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
(1, 'Bachtiar Arya Habibie', '1234', 'bachtiar@mma.gym', 'Jember', 1),
(2, 'Syarafina Khalishah', '170903', 'syarafina17@gmail.com', 'Bondowoso', 1),
(4, 'Nugroho Jeri', 'qwerty', 'jeri@nug.com', 'Pacitan', 2),
(5, 'coba', 'qwer', 'coba@coab.cob', 'jember', 0),
(6, 'bachtiar', 'bachtiar', 'bachtiarah73@gmail.com', 'jember', 1);

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
  ADD PRIMARY KEY (`id_gerakan`,`id_menu_latihan`),
  ADD KEY `id_menu_latihan` (`id_menu_latihan`);

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
  MODIFY `id_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `gerakan`
--
ALTER TABLE `gerakan`
  MODIFY `id_gerakan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jadwal_latihan`
--
ALTER TABLE `jadwal_latihan`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu_latihan`
--
ALTER TABLE `menu_latihan`
  MODIFY `id_menu_latihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usermma`
--
ALTER TABLE `usermma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `gerakan_menu_ibfk_1` FOREIGN KEY (`id_gerakan`) REFERENCES `gerakan` (`id_gerakan`),
  ADD CONSTRAINT `gerakan_menu_ibfk_2` FOREIGN KEY (`id_menu_latihan`) REFERENCES `menu_latihan` (`id_menu_latihan`);

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
