-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2023 at 09:25 AM
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
  `cccd` int(15) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `debt_status` int(2) DEFAULT NULL,
  `selected_services` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`selected_services`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_rooms`
--

INSERT INTO `order_rooms` (`id`, `name`, `phone`, `ma_phong`, `stayNights`, `totalPrice`, `created_at`, `check_in`, `check_out`, `status`, `cccd`, `address`, `user_id`, `debt_status`, `selected_services`) VALUES
(46, 'Lên Văn D', 919938025, 118, 1, 900000, '2023-06-21 04:53:30', '2023-06-22', '2023-06-23', 3, 11, 'đường 30/4 phường Hưng Lợi, quận Ninh Kiều, tp Cần Thơ', NULL, 2, '[]'),
(51, 'Lê Minh Anh', 837641469, 112, 1, 1300000, '2023-06-21 05:45:30', '2023-06-23', '2023-06-24', 3, NULL, NULL, 4, 2, '[]'),
(64, 'thanh', 837641469, 118, 1, 900000, '2023-06-26 06:39:34', '2023-06-26', '2023-06-27', 1, 11, 'Cà Mau', NULL, 2, '[{\"id\":\"5\",\"name_service\":\"N\\u01b0\\u1edbc Su\\u1ed1i \\/ chai\",\"price_service\":10000,\"service_quantities\":\"0\",\"service_total_price\":0}]'),
(65, 'Nguyên Văn A', 837641469, 118, 1, 900000, '2023-06-26 06:43:39', '2023-06-30', '2023-07-01', 1, 11, 'Cà Mau', NULL, 2, '[]'),
(66, 'Nguyên Văn A', 848828730, 118, 1, 1200000, '2023-06-26 06:44:43', '2023-07-01', '2023-07-02', 1, 11, 'Cà Mau', NULL, 2, '[{\"id\":\"2\",\"name_service\":\"\\u0102n s\\u00e1ng \\/ bu\\u1ed5i\",\"price_service\":150000,\"service_quantities\":\"2\",\"service_total_price\":300000}]'),
(67, 'Hoàng Văn Thanh', 837641469, 118, 1, 1395000, '2023-06-26 06:45:59', '2023-06-29', '2023-06-23', 3, 11, 'Cà Mau', NULL, 2, '[{\"id\":\"2\",\"name_service\":\"\\u0102n s\\u00e1ng \\/ bu\\u1ed5i\",\"price_service\":150000,\"service_quantities\":\"3\",\"service_total_price\":450000},{\"id\":\"4\",\"name_service\":\"M\\u00ec g\\u00f3i \\/ g\\u00f3i\",\"price_service\":5000,\"service_quantities\":\"3\",\"service_total_price\":15000},{\"id\":\"5\",\"name_service\":\"N\\u01b0\\u1edbc Su\\u1ed1i \\/ chai\",\"price_service\":10000,\"service_quantities\":\"3\",\"service_total_price\":30000}]');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `admin_password` varchar(15) NOT NULL,
  `admin_name` varchar(30) NOT NULL,
  `position` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `admin_email`, `admin_password`, `admin_name`, `position`) VALUES
(1, 'admin@gmail.com', '123456', 'Hoang Van Thanh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(4, 'Lê Minh Anh', 'anh@gmail.com', '123456', '2023-05-26 04:10:39'),
(5, 'Mỹ Anh', 'myanh@gmail.com', '111111', '2023-06-02 12:30:07'),
(6, 'Duy khang', 'khang123@gmail.com', '1234567', '2023-06-20 05:01:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_debt`
--

CREATE TABLE `tbl_debt` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `ms_phong` int(10) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `debt` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_debt`
--

INSERT INTO `tbl_debt` (`id`, `name`, `ms_phong`, `check_in`, `check_out`, `debt`) VALUES
(1, 'thanh', 1, '2023-06-17', '2023-06-18', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rooms`
--

CREATE TABLE `tbl_rooms` (
  `id` int(11) NOT NULL,
  `ma_phong` int(30) NOT NULL,
  `image` varchar(100) NOT NULL,
  `image2` varchar(100) NOT NULL,
  `image3` varchar(100) NOT NULL,
  `type` int(3) NOT NULL,
  `amount` varchar(30) NOT NULL,
  `price` double NOT NULL,
  `describe` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_rooms`
--

INSERT INTO `tbl_rooms` (`id`, `ma_phong`, `image`, `image2`, `image3`, `type`, `amount`, `price`, `describe`, `created_at`) VALUES
(2, 111, 'p110a39.jpg', 'p110b21.jpg', 'p110c61.jpg', 1, '2', 1200000, 'Có nhiều cây xanh, view hướng ra vòng xoáy trung tâm thành phố', '2023-05-23 04:20:24'),
(3, 112, 'p112a22.jpg', 'p112b6.jpg', 'p112c78.jpg', 2, '4 - 5', 1300000, 'View hướng ra núi, có nhiều cây xanh, thích hợp cho gia đình nghĩ dưỡng', '2023-05-23 04:49:04'),
(4, 113, 'p113a56.jpg', 'p113b23.jpg', 'p113c5.jpg', 1, '4 - 5', 1100000, 'View hướng ra biển mát mẻ, ngắm biển về đêm, thích hợp cho gia đình', '2023-05-23 04:53:41'),
(7, 114, 'p114a22.jpg', 'p114b6.jpg', 'p114c37.jpg', 1, '2', 1800000, 'Có nhiều cảnh đẹp xung quanh, thích hợp cho các chuyến du lịch, công tác nghĩ dưỡng.', '2023-05-23 04:57:41'),
(8, 115, 'p115a29.jpg', 'p115b95.jpg', 'p115c76.jpg', 1, '2', 1600000, 'Có nhiều cây xanh, mát bẻ, ngắm view biển, thích hợp ngắm hoàn hôn.', '2023-05-23 04:57:58'),
(10, 116, 'p116a0.jpg', 'p116b61.jpg', 'p117b57.jpg', 1, '2', 1500000, 'View biển và núi, mát mẻ thích hợp cho công tác, du lịch nghĩ dưỡng, với bạn bè, người thân yêu', '2023-06-05 05:37:38'),
(11, 117, 'p112a10.jpg', 'p112b86.jpg', 'p115c25.jpg', 2, '4 - 5', 1700000, 'Ban công hướng ra núi và biển, có nhiều cây xanh xung quanh, thích hợp đi chơi nghĩ dưỡng.', '2023-06-05 05:40:41'),
(12, 118, 'p110a51.jpg', 'p110b44.jpg', 'p111a77.jpg', 2, '2', 900000, 'view đẹp', '2023-06-20 01:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service`
--

CREATE TABLE `tbl_service` (
  `id` int(11) NOT NULL,
  `type_service` varchar(30) NOT NULL,
  `name_service` varchar(100) NOT NULL,
  `price_service` int(11) DEFAULT NULL,
  `note_service` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_service`
--

INSERT INTO `tbl_service` (`id`, `type_service`, `name_service`, `price_service`, `note_service`) VALUES
(2, 'Ẩm thực', 'Ăn sáng / buổi', 150000, 'mọi người đều có thể ăn'),
(4, 'Ẩm thực', 'Mì gói / gói', 5000, 'mọi người đều có thể ăn'),
(5, 'Ẩm thực', 'Nước Suối / chai', 10000, 'mọi người đều có thể ăn');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `id` int(11) NOT NULL,
  `code_staff` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` int(11) NOT NULL,
  `cccd` int(15) NOT NULL,
  `address` varchar(70) NOT NULL,
  `wage` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`id`, `code_staff`, `name`, `phone`, `cccd`, `address`, `wage`) VALUES
(1, 1113, 'Hoàng Văn Thanh', 837641468, 110110111, 'đường 30/4 phường Hưng Lợi, quận Ninh Kiều, tp Cần Thơ', 8000000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_rooms`
--
ALTER TABLE `order_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_debt`
--
ALTER TABLE `tbl_debt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rooms`
--
ALTER TABLE `tbl_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_service`
--
ALTER TABLE `tbl_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_rooms`
--
ALTER TABLE `order_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_debt`
--
ALTER TABLE `tbl_debt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_rooms`
--
ALTER TABLE `tbl_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_service`
--
ALTER TABLE `tbl_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
