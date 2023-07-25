-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2023 at 05:01 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(50) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
('A-01', 'Admin', '$2y$10$TfK06tMHAKhvPU5ixYPh0uADhpT8OQD8Ou5Msag40/qukmuVSb8t.');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_paket`
--

CREATE TABLE `jenis_paket` (
  `id_jenis` varchar(50) NOT NULL,
  `paket` varchar(255) DEFAULT NULL,
  `harga` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_paket`
--

INSERT INTO `jenis_paket` (`id_jenis`, `paket`, `harga`) VALUES
('C-0001', 'Cuci Kering Reguler', 10000),
('C-0002', 'Cuci Kering Kilat', 12000),
('C-0003', 'Cuci Kering Express', 15000),
('C-0004', 'Cuci Komplit Reguler', 15000),
('C-0005', 'Cuci Komplit Kilat', 18000),
('C-0006', 'Cuci Komplit Express', 20000),
('C-0007', 'Cuci Satuan Boneka', 5000),
('C-0008', 'Cuci Satuan Selimut', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nama`, `telp`, `jabatan`) VALUES
('faefqaf23f', 'Ibnu', '087847361744', 'Manager Laundry');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `kode_pemesanan` varchar(50) NOT NULL,
  `total_berat` varchar(100) DEFAULT NULL,
  `tanggal_pesan` date DEFAULT NULL,
  `tanggal_ambil` date DEFAULT NULL,
  `id_admin` varchar(50) DEFAULT NULL,
  `id_jenis` varchar(50) DEFAULT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `harga` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`kode_pemesanan`, `total_berat`, `tanggal_pesan`, `tanggal_ambil`, `id_admin`, `id_jenis`, `nama_pelanggan`, `status`, `harga`) VALUES
('mgbletukxc', '10', '2023-07-23', '2023-07-29', 'A-01', 'C-0001', 'Ibnu Reyhan', 'sudah dibayar', '100000');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(50) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `telp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `telp`) VALUES
('enjhoiuxpw', 'Ibnu Reyhan', '081677487132'),
('P-0002', 'Ahmad Rendy', '082341235627'),
('P-0003', 'Slamet Sucipto', '089527814624'),
('P-0004', 'Indah Permata', ' 085629817685'),
('P-0005', 'Sri Utami', '084598562198');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `status` varchar(255) DEFAULT NULL,
  `kode_pemesanan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `jenis_paket`
--
ALTER TABLE `jenis_paket`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`kode_pemesanan`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD KEY `kode_pemesanan` (`kode_pemesanan`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`),
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_paket` (`id_jenis`);

--
-- Constraints for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD CONSTRAINT `riwayat_ibfk_1` FOREIGN KEY (`kode_pemesanan`) REFERENCES `order` (`kode_pemesanan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
