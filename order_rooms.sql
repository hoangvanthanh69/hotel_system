-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 04:59 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dat_phong_ks`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_rooms`
--

CREATE TABLE `order_rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` int(11) NOT NULL,
  `ma_phong` int(30) NOT NULL,
  `stayNights` int(30) NOT NULL,
  `totalPrice` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `status` int(3) NOT NULL,
  `cccd` int(15) NOT NULL,
  `address` varchar(100) NOT NULL,
  `name_service` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_rooms`
--

INSERT INTO `order_rooms` (`id`, `name`, `phone`, `ma_phong`, `stayNights`, `totalPrice`, `created_at`, `check_in`, `check_out`, `status`, `cccd`, `address`, `name_service`) VALUES
(27, 'Lên Văn D', 837641469, 112, 2, 2600000, '2023-06-11 09:02:23', '2023-06-11', '2023-06-13', 3, 11223344, 'Cà Mau', ''),
(29, 'Nguyên Văn A', 919938025, 111, 1, 1200000, '2023-06-12 04:50:55', '2023-06-12', '2023-06-13', 3, 112233441, 'đường 30/4 phường Hưng Lợi, quận Ninh Kiều, tp Cần Thơ', ''),
(30, 'van thanh', 919938025, 110, 1, 600000, '2023-06-13 06:14:14', '2023-06-14', '2023-06-15', 3, 11223311, 'Cần Thơ', ''),
(31, 'van thanh', 919938025, 112, 2, 2600000, '2023-06-15 02:51:24', '2023-06-15', '2023-06-17', 3, 11223344, 'Cần Thơ', ''),
(32, 'Lên Văn D', 837641469, 115, 2, 3350000, '2023-06-15 02:59:26', '2023-06-16', '2023-06-18', 3, 112233441, 'Cần Thơ', 'Ăn sáng'),
(34, 'Nguyễn Văn Xuân', 12345678, 111, 2, 2700000, '2023-06-18 02:23:42', '2023-06-19', '2023-06-21', 2, 10101012, 'Hậu Giang', 'Quán bar'),
(35, 'Lê Thị Kim', 12312312, 112, 2, 2900000, '2023-06-19 06:35:16', '2023-06-20', '2023-06-22', 2, 11111000, 'đường 30/4 phường Hưng Lợi, quận Ninh Kiều, tp Cần Thơ', 'Quán bar'),
(36, 'van thanh', 837641469, 113, 1, 1250000, '2023-06-20 01:51:44', '2023-06-21', '2023-06-22', 1, 11223344, 'Cà Mau', 'Ăn sáng');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_rooms`
--
ALTER TABLE `order_rooms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_rooms`
--
ALTER TABLE `order_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
