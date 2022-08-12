-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 05, 2021 at 01:05 AM
-- Server version: 5.7.24
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bend`
--

-- --------------------------------------------------------

--
-- Table structure for table `bsp_kpm_error`
--

CREATE TABLE `bsp_kpm_error` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_kartu` char(16) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `err_id` int(11) NOT NULL,
  `agen_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bsp_kpm_error`
--

INSERT INTO `bsp_kpm_error` (`id`, `nama`, `no_kartu`, `nik`, `alamat`, `err_id`, `agen_id`, `updated_by`, `updated_at`) VALUES
(1, 'IYANG', '6032989840143757', '3205330902800005', 'KP SINGKUR', 4, 3, 2, 1628095715),
(2, 'DEDE SOLEH SUPRIATNA', '6032989853341421', '3205330907750007', 'KP SINGKUR', 1, 3, 2, 1628096239),
(3, 'MAE', '6032989845991093', '3205334502510002', 'KP. SINGKUR', 5, 0, 2, 1628096279),
(4, 'NURLILAH', '6032989840145521', '3205334309920004', 'KP SINGKUR', 1, 3, 2, 1628098013),
(5, 'SOPIAH', '6032989840147519', '3205334112920007', 'KP SINGKUR', 5, 3, 2, 1628098083);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bsp_kpm_error`
--
ALTER TABLE `bsp_kpm_error`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`agen_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bsp_kpm_error`
--
ALTER TABLE `bsp_kpm_error`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
