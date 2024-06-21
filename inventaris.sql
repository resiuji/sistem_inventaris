-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2021 at 07:59 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_barang`
--

CREATE TABLE `detail_barang` (
  `id` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `merk` varchar(20) DEFAULT NULL,
  `deskripsi` text NOT NULL,
  `kondisi` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_barang`
--

INSERT INTO `detail_barang` (`id`, `kode`, `id_jenis`, `merk`, `deskripsi`, `kondisi`) VALUES
(1, 'k001', 1, 'Asus', 'Komputer untuk ujian', 1),
(2, 'k002', 1, 'Asus', 'Komputer untuk ujian', 0),
(3, 'p001', 2, 'Canon', 'Printer kualitas tinggi', 1),
(4, 'm001', 3, NULL, 'Meja ukuran 100 x 50 cm', 1),
(5, 'd001', 5, 'goPro', 'Drone canggih', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id` int(11) NOT NULL,
  `nama_jenis` varchar(20) NOT NULL,
  `kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id`, `nama_jenis`, `kategori`) VALUES
(1, 'Komputer', 'Elektronik'),
(2, 'Printer', 'Elektronik'),
(3, 'Meja Kayu', 'Mebel'),
(4, 'Kursi Kayu', 'Mebel'),
(5, 'Drone', 'Elektronik');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `nama`, `is_admin`) VALUES
(1, 'resi@gmail.com', 'resi', 'password', 'Resi Uji Maulana', 1),
(6, 'admin@gmail.com', 'admin', '$2y$10$U60qhDN1opYJOsFCyT/58u5loy00zbOiQsKZraC1SW/xMZip5YrxO', 'Admin', 1),
(10, 'coba@gmail.com', 'cobaadmin', '$2y$10$G/iv2Q28Bz9nOYRSyB/VjOn1xdnKg/FTlyRx0neeRdlxI3uhrixN6', 'coba tambah admin', 1),
(12, 'coba@gmail.com', 'cobauser', '$2y$10$DiY7ish0usIsVaUB0duEtu/xvQzML5nKRJCrftXx6NszYQLrBoeAm', 'Coba User', 0),
(17, 'user@gmail.com', 'user', '$2y$10$R.XEacuF8jUb4hkPUpGH7OgXpgC1EYKmcIUWPQUWnf2bSH2noC9Dy', 'User', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_barang`
--
ALTER TABLE `detail_barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode` (`kode`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_barang`
--
ALTER TABLE `detail_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_barang`
--
ALTER TABLE `detail_barang`
  ADD CONSTRAINT `detail_barang_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_barang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
