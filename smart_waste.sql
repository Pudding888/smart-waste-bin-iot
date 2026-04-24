-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2026 at 02:05 PM
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
-- Database: `smart_waste`
--

-- --------------------------------------------------------

--
-- Table structure for table `bins`
--

CREATE TABLE `bins` (
  `bin_id` int(11) NOT NULL,
  `bin_code` varchar(50) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `waste_type` varchar(50) DEFAULT NULL,
  `capacity` float(10,2) DEFAULT NULL,
  `battery` float(10,2) DEFAULT NULL,
  `waste_level` int(11) DEFAULT NULL,
  `smell_level` int(11) DEFAULT NULL,
  `last_collected` datetime DEFAULT NULL,
  `recorded_time` datetime DEFAULT NULL,
  `collection_round` varchar(50) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bins`
--

INSERT INTO `bins` (`bin_id`, `bin_code`, `location`, `waste_type`, `capacity`, `battery`, `waste_level`, `smell_level`, `last_collected`, `recorded_time`, `collection_round`, `latitude`, `longitude`, `status`) VALUES
(10, '123', 'บ้านใครซักคน', 'ทั่วไป', 49.00, NULL, NULL, NULL, '2026-04-20 00:58:00', NULL, 'R200', 13.731714485040284, 100.45195380933293, NULL),
(11, '0001', ' อาคาร A', 'รีไซเคิล', 10.00, NULL, NULL, NULL, '2026-04-17 01:09:00', NULL, 'R20', 13.746488512325863, 100.56749906626177, NULL),
(12, '111', 'บ้านพุดดิ้ง', 'เปียก', 10.00, NULL, NULL, NULL, '2026-04-07 01:13:00', NULL, 'R2000', 13.766063482382872, 100.44149206479017, NULL),
(13, '0000', 'spu5', 'อันตราย', 38.00, NULL, NULL, NULL, '2026-04-20 01:13:00', NULL, 'R2', 13.812477025045027, 100.96658816066451, NULL),
(14, '325', 'บ้านพ่อ', 'ทั่วไป', 634.00, NULL, NULL, NULL, '2026-04-03 10:51:00', NULL, '', 13.757726810249702, 100.45316626762101, NULL),
(15, '999', 'หอพักA', 'รีไซเคิล', 1.00, NULL, NULL, NULL, '2026-04-15 10:56:00', NULL, 'R30', 14.035876731989948, 100.65978033907786, NULL),
(16, '0006', 'หอพักB', 'เปียก', 27.00, NULL, NULL, NULL, '2026-03-30 10:57:00', NULL, 'R300', 13.74938984111197, 100.581250004656, NULL),
(17, '1115', 'อาคาร C', 'อันตราย', 38.00, NULL, NULL, NULL, '2026-04-09 10:58:00', NULL, 'R111', 13.84848045694805, 100.58959241805304, NULL),
(18, 'BIN-I6B0MJ', 'บ้านพุดดิ้งV2', 'รีไซเคิล', 58.76, NULL, NULL, NULL, '2026-04-20 23:50:00', NULL, 'ROUND-Q8A4LF', 17.123992525352, 100.6831313678, NULL),
(19, 'BIN-70VZXO', 'อาคาร AA', 'อันตราย', 2.40, NULL, NULL, NULL, '2026-04-18 01:01:00', NULL, 'ROUND-DFSZCG', 20.399, 97.817, NULL),
(20, 'BIN-H6YUSQ', 'อาคาร AAA', 'ทั่วไป', 2.00, NULL, NULL, NULL, '2026-04-11 02:21:00', NULL, 'ROUND-3X9ICR', 12.797, 104.88, NULL),
(21, 'BIN-HHUG81', 'บ้านพุดดิ้งด', 'ทั่วไป', 1.00, NULL, NULL, NULL, '2026-04-21 02:50:00', NULL, 'ROUND-X1S3AY', 13.143, 100.538, NULL),
(22, 'BIN-0SIKR7', 'อาคาร CCC', 'ทั่วไป', 2.00, NULL, NULL, NULL, '2026-04-13 04:01:00', NULL, 'ROUND-8C91AD', 13.436, 100.488, NULL),
(23, 'BIN-8R33EL', 'เซเว่นหน้าบากทาง', 'รีไซเคิล', 12.00, NULL, NULL, NULL, '2026-04-03 04:12:00', NULL, 'ROUND-Y8NMWZ', 13.571, 100.51, NULL),
(24, 'BIN-WM74PW', 'spu1', 'ทั่วไป', 3.00, NULL, NULL, NULL, '2026-04-21 13:08:00', NULL, 'ROUND-OW706T', 13.716, 100.559, NULL),
(25, 'BIN-8LBWT9', 'บ่านบ้านบ๊าน', 'อันตราย', 1.00, NULL, NULL, NULL, '2026-04-06 18:46:00', NULL, 'ROUND-RBRQJR', 13.706, 100.459, NULL),
(26, 'BIN-E2D5YO', 'บ้านa', 'ทั่วไป', 56.00, NULL, NULL, NULL, '2026-04-07 19:46:00', NULL, 'ROUND-TTHEYA', 13.64, 100.418, NULL),
(27, 'BIN-YYARBW', 'อาคารZZZ', 'รีไซเคิล', 2.00, NULL, NULL, NULL, '2026-04-10 19:53:00', NULL, 'ROUND-T2NK8Y', 13.635, 100.525, NULL),
(28, 'BIN-DNZMD6', 'spu11', 'ทั่วไป', 4.00, NULL, NULL, NULL, '2026-05-08 20:02:00', NULL, 'ROUND-KAXHUX', 13.839, 100.515, NULL),
(29, 'BIN-9AL2RB', 'บ้านพุดดิ้ง2', 'ทั่วไป', 2.00, NULL, NULL, NULL, '2026-04-04 12:58:00', NULL, 'ROUND-LIZ623', 13.676, 100.421, NULL),
(30, 'BIN-RG51CU', 'บ้านน้องชาย', 'เปียก', 2.00, NULL, NULL, NULL, '2026-04-22 13:06:00', NULL, 'ROUND-62HOTG', 13.575, 100.58, NULL),
(32, 'BIN-G37QMZ', 'บ้านเพื่อนชายA', 'ทั่วไป', 3.00, NULL, NULL, NULL, '2026-03-30 13:24:00', NULL, 'ROUND-M0JFNP', 13.854, 100.436, NULL),
(33, 'BIN-A001', 'หน้าตึกวิศวะ (CPE)', 'ทั่วไป', 50.50, NULL, NULL, NULL, '2026-04-23 10:18:18', NULL, 'ROUND-01', 13.75633, 100.50182, NULL),
(34, 'BIN-B002', 'โรงอาหารกลาง', 'เปียก', 30.00, NULL, NULL, NULL, '2026-04-23 10:18:18', NULL, 'ROUND-01', 13.7565, 100.502, NULL),
(35, 'BIN-C003', 'สวนข้างห้องสมุด', 'รีไซเคิล', 40.00, NULL, NULL, NULL, '2026-04-23 10:18:18', NULL, 'ROUND-01', 13.7561, 100.5015, NULL),
(36, 'BIN-T001', 'หน้าตึกคณะ ICT', 'ทั่วไป', 50.00, NULL, NULL, NULL, '2026-04-23 10:21:02', NULL, 'ROUND-01', 13.75633, 100.50182, NULL),
(37, 'BIN-R002', 'โรงอาหารกลาง', 'รีไซเคิล', 30.50, NULL, NULL, NULL, '2026-04-23 10:21:02', NULL, 'ROUND-01', 13.7565, 100.502, NULL),
(38, 'BIN-D003', 'ลานจอดรถ', 'อันตราย', 20.00, NULL, NULL, NULL, '2026-04-23 10:21:02', NULL, 'ROUND-01', 13.757, 100.5025, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bin_status`
--

CREATE TABLE `bin_status` (
  `status_id` int(11) NOT NULL,
  `bin_id` int(11) DEFAULT NULL,
  `waste_level` int(11) DEFAULT NULL,
  `smell_level` int(11) DEFAULT NULL,
  `battery` float(10,2) DEFAULT NULL,
  `recorded_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bin_status`
--

INSERT INTO `bin_status` (`status_id`, `bin_id`, `waste_level`, `smell_level`, `battery`, `recorded_time`) VALUES
(4, 10, 67, 50, 49.00, '2026-04-20 00:58:49'),
(5, 11, 69, 68, 48.00, '2026-04-20 01:09:44'),
(6, 12, 37, 58, 29.00, '2026-04-20 01:13:22'),
(7, 13, 9, 49, 58.00, '2026-04-20 01:14:14'),
(8, 14, 48, 57, 38.00, '2026-04-20 10:51:23'),
(9, 15, 47, 58, 37.00, '2026-04-20 10:56:47'),
(10, 16, 68, 17, 44.00, '2026-04-20 10:57:32'),
(11, 17, 10, 46, 49.00, '2026-04-20 10:58:45'),
(12, 18, 47, 68, 18.00, '2026-04-20 23:50:58'),
(13, 19, 7, 10, 6.00, '2026-04-21 01:01:55'),
(14, 20, 4, 6, 9.00, '2026-04-21 02:21:24'),
(15, 21, 3, 2, 1.00, '2026-04-21 02:51:01'),
(16, 22, 86, 77, 63.00, '2026-04-21 04:01:37'),
(17, 23, 76, 67, 79.00, '2026-04-21 04:13:02'),
(18, 24, 87, 47, 78.00, '2026-04-21 13:09:01'),
(19, 25, 76, 67, 79.00, '2026-04-21 18:46:39'),
(20, 26, 66, 23, 61.00, '2026-04-21 19:46:49'),
(21, 27, 67, 23, 90.00, '2026-04-21 19:53:48'),
(22, 28, 66, 23, 61.00, '2026-04-21 20:02:27'),
(23, 29, 87, 73, 78.00, '2026-04-22 12:58:14'),
(24, 30, 87, 73, 78.00, '2026-04-22 13:06:03'),
(26, 32, 99, 60, 65.13, '2026-04-22 13:24:59');

-- --------------------------------------------------------

--
-- Table structure for table `latest_sensor`
--

CREATE TABLE `latest_sensor` (
  `id` int(11) NOT NULL,
  `waste_level` int(11) DEFAULT NULL,
  `smell_level` int(11) DEFAULT NULL,
  `battery` float(10,2) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `latest_sensor`
--

INSERT INTO `latest_sensor` (`id`, `waste_level`, `smell_level`, `battery`, `updated_at`) VALUES
(1, 96, 24, 94.00, '2026-04-21 01:46:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bins`
--
ALTER TABLE `bins`
  ADD PRIMARY KEY (`bin_id`);

--
-- Indexes for table `bin_status`
--
ALTER TABLE `bin_status`
  ADD PRIMARY KEY (`status_id`),
  ADD KEY `bin_id` (`bin_id`);

--
-- Indexes for table `latest_sensor`
--
ALTER TABLE `latest_sensor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bins`
--
ALTER TABLE `bins`
  MODIFY `bin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `bin_status`
--
ALTER TABLE `bin_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bin_status`
--
ALTER TABLE `bin_status`
  ADD CONSTRAINT `bin_status_ibfk_1` FOREIGN KEY (`bin_id`) REFERENCES `bins` (`bin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
