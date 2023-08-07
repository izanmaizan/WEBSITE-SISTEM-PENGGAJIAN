-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2023 at 08:56 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penggajian`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_gaji`
--

CREATE TABLE `tb_gaji` (
  `kode_gaji` int(11) NOT NULL,
  `kary_id` int(11) NOT NULL,
  `bulan_transfer` date NOT NULL,
  `tgl_transfer` date NOT NULL,
  `jam_transfer` time NOT NULL,
  `jam_lembur` int(11) NOT NULL,
  `uang_lembur` int(11) NOT NULL,
  `total_gaji` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_gaji`
--

INSERT INTO `tb_gaji` (`kode_gaji`, `kary_id`, `bulan_transfer`, `tgl_transfer`, `jam_transfer`, `jam_lembur`, `uang_lembur`, `total_gaji`) VALUES
(2, 1, '2023-08-07', '2023-08-07', '09:00:00', 2, 500000, 5500000),
(3, 2, '2023-08-14', '2023-08-07', '10:00:00', 1, 300000, 4800000),
(4, 3, '2023-08-09', '2023-08-07', '08:30:00', 3, 600000, 6100000),
(5, 4, '2023-08-10', '2023-08-07', '09:30:00', 2, 700000, 7700000),
(6, 5, '2023-08-11', '2023-08-07', '11:00:00', 0, 150000, 6150000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `kary_id` int(11) NOT NULL,
  `kode_kar` varchar(10) NOT NULL,
  `nama_kar` varchar(100) NOT NULL,
  `alamat_kar` varchar(200) NOT NULL,
  `no_rek` varchar(50) NOT NULL,
  `gaji_utama` int(11) NOT NULL,
  `gol_kar` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`kary_id`, `kode_kar`, `nama_kar`, `alamat_kar`, `no_rek`, `gaji_utama`, `gol_kar`) VALUES
(1, 'KAR001', 'John Doe', 'Jl. Contoh No. 123', '1234567890', 5000000, 'A'),
(2, 'KAR002', 'Jane Smith', 'Jl. Sample No. 456', '9876543210', 4500000, 'B'),
(3, 'KAR003', 'Arya Stark', 'Winterfell', '1357924680', 5500000, 'A'),
(4, 'KAR004', 'Elon Musk', 'Mars Colony', '2468135790', 7000000, 'C'),
(5, 'KAR005', 'Natalie Johnson', '123 Main St', '5050505050', 6000000, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_gaji`
--
ALTER TABLE `tb_gaji`
  ADD PRIMARY KEY (`kode_gaji`),
  ADD KEY `kary_id` (`kary_id`);

--
-- Indexes for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`kary_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_gaji`
--
ALTER TABLE `tb_gaji`
  MODIFY `kode_gaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  MODIFY `kary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_gaji`
--
ALTER TABLE `tb_gaji`
  ADD CONSTRAINT `tb_gaji_ibfk_1` FOREIGN KEY (`kary_id`) REFERENCES `tb_karyawan` (`kary_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
