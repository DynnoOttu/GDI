-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2024 at 10:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gereja_gmit_genesaret _danau_ina_lasiana`
--

-- --------------------------------------------------------

--
-- Table structure for table `jemaat`
--

CREATE TABLE `jemaat` (
`id_jemaat` int(4) NOT NULL,
`id_pendeta` int(4) NOT NULL,
`id_kepala_keluarga` int(4) NOT NULL,
`nama` varchar(50) NOT NULL,
`tempat_dan_tanggal_lahir` varchar(100) NOT NULL,
`jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jemaat`
--

INSERT INTO `jemaat` (`id_jemaat`, `id_pendeta`, `id_kepala_keluarga`, `nama`, `tempat_dan_tanggal_lahir`, `jenis_kelamin`) VALUES
(12, 1, 4, 'Aldo', 'Kupang', 'Laki-Laki'),
(15, 4, 3, 'Yon o', 'Bandung', 'Laki-Laki');

-- --------------------------------------------------------

--
-- Table structure for table `kepala_keluarga`
--

CREATE TABLE `kepala_keluarga` (
`id_kepala_keluarga` int(4) NOT NULL,
`id_rayon` int(4) NOT NULL,
`jenis_kk` enum('Rumah','asrama') NOT NULL,
`nomor_kk` int(11) NOT NULL,
`alamat` varchar(255) NOT NULL,
`nama_asrama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kepala_keluarga`
--

INSERT INTO `kepala_keluarga` (`id_kepala_keluarga`, `id_rayon`, `jenis_kk`, `nomor_kk`, `alamat`, `nama_asrama`) VALUES
(3, 2, 'Rumah', 4, 'mn', 'mb'),
(4, 2, 'asrama', 20, 'bandung', 'asrama GMIT');

-- --------------------------------------------------------

--
-- Table structure for table `kordinator`
--

CREATE TABLE `kordinator` (
`id_kordinator` int(4) NOT NULL,
`id_majelis` int(11) NOT NULL,
`id_rayon` int(11) NOT NULL,
`nama_kordinator` varchar(50) NOT NULL,
`alamat` varchar(255) NOT NULL,
`status` enum('Aktif','Tidak Aktif') NOT NULL,
`telepon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `majelis`
--

CREATE TABLE `majelis` (
`id_majelis` int(4) NOT NULL,
`id_periode` int(4) NOT NULL,
`id_jemaat` int(4) NOT NULL,
`id_rayon` int(4) NOT NULL,
`jabatan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendeta`
--

CREATE TABLE `pendeta` (
`id_pendeta` int(4) NOT NULL,
`id_periode` int(4) NOT NULL,
`nama_pendeta` varchar(50) NOT NULL,
`tanggal_menjabat` date NOT NULL,
`tanggal_jabatan_berakhir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendeta`
--

INSERT INTO `pendeta` (`id_pendeta`, `id_periode`, `nama_pendeta`, `tanggal_menjabat`, `tanggal_jabatan_berakhir`) VALUES
(1, 2, 'Aldo Wabang', '2024-07-20', '2024-08-21'),
(4, 89, 'yohanis ottu', '2024-07-01', '2024-08-01');

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
`id_periode` int(4) NOT NULL,
`id_pendeta` int(4) NOT NULL,
`jabatan_majelis` varchar(50) NOT NULL,
`jabatan_pendeta` varchar(255) NOT NULL,
`tanggal_menjabat` date NOT NULL,
`tanggal_jabatan_berahkir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id_periode`, `id_pendeta`, `jabatan_majelis`, `jabatan_pendeta`, `tanggal_menjabat`, `tanggal_jabatan_berahkir`) VALUES
(1, 2, 'Penatua', '', '2024-07-11', '2024-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `rayon`
--

CREATE TABLE `rayon` (
`id_rayon` int(4) NOT NULL,
`rayon` varchar(50) NOT NULL,
`keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rayon`
--

INSERT INTO `rayon` (`id_rayon`, `rayon`, `keterangan`) VALUES
(2, 'syalommmm', 'aminnnnn');

-- --------------------------------------------------------

--
-- Table structure for table `status_sosial_jemaat`
--

CREATE TABLE `status_sosial_jemaat` (
`id_status_sosial_jemaat` int(11) NOT NULL,
`id_jemaat` int(11) NOT NULL,
`pendidikan` varchar(50) NOT NULL,
`pekerjaan` varchar(50) DEFAULT NULL,
`status_baptis` enum('Sudah','Belum') DEFAULT NULL,
`tanggal_baptis` varchar(20) DEFAULT NULL,
`status_sidi` enum('Sudah','Belum') DEFAULT NULL,
`tanggal_sidi` varchar(20) DEFAULT NULL,
`status_pernikahan` enum('Kawin','Belum Kawin','Cerai Hidup','Cerai Mati') DEFAULT NULL,
`tanggal_nikah` varchar(20) DEFAULT NULL,
`meninggal_at` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
`id_user` int(4) NOT NULL,
`email` varchar(100) NOT NULL,
`password` varchar(50) NOT NULL,
`nama` varchar(50) NOT NULL,
`kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `nama`, `kategori`) VALUES
(1, 'admin@gmail.com', 'admin', 'admin', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jemaat`
--
ALTER TABLE `jemaat`
ADD PRIMARY KEY (`id_jemaat`);

--
-- Indexes for table `kepala_keluarga`
--
ALTER TABLE `kepala_keluarga`
ADD PRIMARY KEY (`id_kepala_keluarga`);

--
-- Indexes for table `kordinator`
--
ALTER TABLE `kordinator`
ADD PRIMARY KEY (`id_kordinator`);

--
-- Indexes for table `majelis`
--
ALTER TABLE `majelis`
ADD PRIMARY KEY (`id_majelis`);

--
-- Indexes for table `pendeta`
--
ALTER TABLE `pendeta`
ADD PRIMARY KEY (`id_pendeta`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
ADD PRIMARY KEY (`id_periode`);

--
-- Indexes for table `rayon`
--
ALTER TABLE `rayon`
ADD PRIMARY KEY (`id_rayon`);

--
-- Indexes for table `status_sosial_jemaat`
--
ALTER TABLE `status_sosial_jemaat`
ADD PRIMARY KEY (`id_status_sosial_jemaat`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jemaat`
--
ALTER TABLE `jemaat`
MODIFY `id_jemaat` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kepala_keluarga`
--
ALTER TABLE `kepala_keluarga`
MODIFY `id_kepala_keluarga` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kordinator`
--
ALTER TABLE `kordinator`
MODIFY `id_kordinator` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `majelis`
--
ALTER TABLE `majelis`
MODIFY `id_majelis` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pendeta`
--
ALTER TABLE `pendeta`
MODIFY `id_pendeta` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
MODIFY `id_periode` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rayon`
--
ALTER TABLE `rayon`
MODIFY `id_rayon` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status_sosial_jemaat`
--
ALTER TABLE `status_sosial_jemaat`
MODIFY `id_status_sosial_jemaat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id_user` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;