-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2024 at 07:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cow`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_token` int(11) NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delivered_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_token`, `order_time`, `delivered_time`, `status`) VALUES
(1, 13, 779775, '2024-06-06 18:58:47', '2024-06-01 13:47:05', 'ready'),
(2, 13, 886200, '2024-06-06 19:01:02', '2024-06-01 13:56:35', 'pending'),
(3, 13, 230940, '2024-06-06 18:57:50', '2024-06-01 14:20:57', NULL),
(4, 13, 528589, '2024-06-06 18:57:50', '2024-06-01 14:28:56', NULL),
(5, 13, 944052, '2024-06-06 18:57:50', '2024-06-01 14:30:55', NULL),
(6, 13, 159778, '2024-06-06 18:57:50', '2024-06-01 14:31:25', NULL),
(7, 13, 658380, '2024-06-06 18:57:50', '2024-06-01 14:31:30', NULL),
(8, 13, 861932, '2024-06-06 18:57:50', '2024-06-01 14:31:52', NULL),
(9, 13, 368874, '2024-06-06 18:53:21', '2024-06-01 14:32:45', 'ready'),
(10, 13, 655173, '2024-06-01 14:39:17', '2024-06-01 14:39:17', ''),
(11, 13, 611758, '2024-06-06 18:57:50', '2024-06-01 14:40:52', NULL),
(12, 13, 818530, '2024-06-06 18:57:50', '2024-06-01 14:41:23', NULL),
(13, 13, 150583, '2024-06-06 19:01:05', '2024-06-01 14:41:34', 'ready'),
(14, 13, 299598, '2024-06-06 18:57:50', '2024-06-01 14:53:12', NULL),
(15, 13, 692863, '2024-06-06 19:01:09', '2024-06-01 14:58:57', 'ready'),
(16, 13, 640119, '2024-06-06 19:01:11', '2024-06-01 14:59:08', 'ready'),
(17, 13, 261575, '2024-06-06 19:01:20', '2024-06-01 16:11:15', 'ready'),
(18, 13, 538514, '2024-06-06 19:01:23', '2024-06-01 16:54:39', 'ready'),
(19, 13, 695555, '2024-06-06 19:01:25', '2024-06-01 17:07:30', 'ready'),
(20, 13, 323437, '2024-06-06 19:01:28', '2024-06-01 17:19:15', 'ready'),
(21, 13, 921053, '2024-06-06 18:57:50', '2024-06-01 17:24:34', NULL),
(22, 13, 902447, '2024-06-06 19:01:30', '2024-06-01 17:24:40', 'ready'),
(23, 13, 976906, '2024-06-06 18:55:54', '2024-06-01 17:38:08', NULL),
(24, 13, 528527, '2024-06-06 18:55:49', '2024-06-01 17:43:19', NULL),
(25, 13, 196488, '2024-06-06 18:55:42', '2024-06-01 17:45:14', NULL),
(28, 6, 979835, '2024-06-08 15:12:02', '2024-06-08 15:12:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`) VALUES
(1, 1, 4),
(2, 2, 4),
(3, 9, 4),
(4, 9, 5),
(5, 10, 0),
(6, 10, 0),
(7, 13, 4),
(8, 13, 5),
(9, 14, 0),
(10, 14, 0),
(11, 15, 4),
(12, 15, 5),
(13, 16, 4),
(14, 16, 5),
(15, 17, 4),
(16, 17, 5),
(17, 18, 4),
(18, 18, 5),
(19, 19, 5),
(20, 20, 4),
(21, 20, 5),
(22, 22, 4),
(23, 23, 4),
(24, 23, 5),
(25, 24, 4),
(26, 24, 5),
(27, 25, 4),
(28, 25, 5),
(29, 26, 4),
(30, 26, 5),
(31, 27, 4),
(32, 27, 5),
(33, 28, 7),
(34, 28, 9);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `price`, `product_description`, `product_image`, `product_type`) VALUES
(6, 'chapati', '3000', 'wheat bread fried', '../uploads/a common Kenyan dish.jpg', 'food'),
(8, 'pilau', '8000', 'rice sseasoning chicken masala', '../uploads/Jollof Rice With Chicken.jpg', 'food'),
(9, 'samosa', '6999', 'meat with good taste', '../uploads/Best Keema Samosa Recipe (Patti Samosa) - Cubes N Juliennes.jpg', 'food');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `phone`, `password`, `zip_code`, `role`) VALUES
(6, 'happy ness', 'happy@gmail.com', '0710362599', '123', 16111, 'admin'),
(12, 'SIBONA NKANABO', 'GOOD@gmail.com', '0624107565', '0624107565', 1, 'cook'),
(14, 'midevu', 'GOO77@gmail.com', '0714613797', '0714613797', 16111, 'delivery');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
