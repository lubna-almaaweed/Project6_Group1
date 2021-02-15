-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2021 at 10:15 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project6`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(25) DEFAULT NULL,
  `admin_email` varchar(30) DEFAULT NULL,
  `admin_pass` varchar(50) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `hot_pro_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_pass`, `store_id`, `hot_pro_id`) VALUES
(1, 'jenan', 'jenan@hot.com', '1234', 1, 2),
(2, 'Salameh', 'salameh@hotmail.com', '12345', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(25) DEFAULT NULL,
  `cat_desc` varchar(2000) DEFAULT NULL,
  `cat_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_desc`, `cat_img`) VALUES
(1, 'Ice Creem', 'Ice Creem desc', 'ice-cream1.jpg'),
(2, 'Cake Sweet', 'Cake desc', 'cake2.jpg'),
(6, 'Arabic Sweets', 'arabic sweets', 'Arabic-sweets2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hot_pro`
--

CREATE TABLE `hot_pro` (
  `hot_pro_id` int(11) NOT NULL,
  `h_pro_id` int(11) DEFAULT NULL,
  `h_store_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hot_pro`
--

INSERT INTO `hot_pro` (`hot_pro_id`, `h_pro_id`, `h_store_id`) VALUES
(2, 3, 3),
(0, 26, 6),
(0, 2, 1),
(0, 32, 10);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` varchar(50) DEFAULT NULL,
  `total` decimal(9,0) DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `o_d_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `total`, `payment`, `user_id`, `o_d_id`) VALUES
(1, NULL, '200', NULL, 20, 54),
(2, '', '0', '', 20, 2),
(3, '', '0', '', 20, 2),
(4, '', '0', '', 20, 2),
(5, '', '0', '', 20, 2),
(6, '', '0', '', 20, 2),
(7, '', '0', '', 20, 2),
(8, '', '0', '', 20, 2),
(58, '', '0', '', 20, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `o_d_id` int(11) NOT NULL,
  `pro_qty` int(11) DEFAULT NULL,
  `total` decimal(9,0) DEFAULT NULL,
  `pro_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`o_d_id`, `pro_qty`, `total`, `pro_id`) VALUES
(2, 2, '0', 6),
(52, 2, '40', 21),
(53, 2, '0', 21),
(54, 1, '8', 2),
(55, 2, '14', 13),
(56, 1, '7', 13),
(57, 2, NULL, 2),
(58, 1, '7', 13);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_id` int(11) NOT NULL,
  `pro_name` varchar(50) DEFAULT NULL,
  `pro_desc` varchar(2000) DEFAULT NULL,
  `pro_price` decimal(9,0) DEFAULT NULL,
  `offer` decimal(5,0) DEFAULT NULL,
  `is_off` varchar(25) DEFAULT NULL,
  `pro_img` varchar(255) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_id`, `pro_name`, `pro_desc`, `pro_price`, `offer`, `is_off`, `pro_img`, `store_id`, `cat_id`) VALUES
(2, 'Knafeh', 'knafeh', '8', '7', 'true', 'Arabic-sweets1.jpg', 1, 2),
(3, 'Mex Ice Creem', 'TripAdvisorBASKIN-ROBBINS', '11', '9', 'true', 'BR6.jpg', 3, 1),
(5, 'Man W aslwa', '', '8', '0', 'false', 'Nafeeseh_prodect6.jpg', 1, 6),
(6, 'Tamriah', '', '3', '2', 'true', 'ArafatSweets_Product5.jpg', 11, 6),
(8, 'Sweet arafat', 'test', '2', '1', 'true', 'Nafeeseh_prodect3.jpg', 1, 6),
(9, 'Basbosa Sweet', 'test', '11', '10', 'true', 'Nafeeseh_prodect2.jpg', 1, 6),
(10, 'Knafeh', ' Knafeh sweet', '15', '14', 'true', 'AlNejmahsweets_product1.jpg', 10, 6),
(11, 'Knafeh', 'Knafeh Sweets', '16', '0', 'false', 'Nafeeseh_prodect1.jpg', 1, 6),
(12, 'Knafeh', 'Knafeh Sweets', '13', '12', 'true', 'ArafatSweets_Product1.jpg', 11, 6),
(13, 'Chocolate Pralines ', '', '7', '6', 'true', 'BR3.png', 3, 1),
(14, 'Caramel Macchiato', '', '7', '0', 'false', 'BR4.png', 3, 1),
(15, 'Mom’s Makin’ Cookiem', '', '5', '0', 'false', 'BR1.png', 3, 1),
(16, 'ST’ Cookies', '', '6', '0', 'false', 'BR2.png', 3, 1),
(18, 'Cake Sweet', '', '12', '10', 'true', 'rawanBlack.jpg', 9, 2),
(19, 'Cake Sweet chkoo', '', '20', '19', 'true', 'rawanKitkat.jpg', 9, 2),
(21, 'Sweet strobary', '', '20', '0', 'false', 'rawanApple.jpg', 9, 2),
(22, 'Cake Sweet Doctor', '', '50', '0', 'false', 'cakeShopDoctor.jpg', 8, 2),
(23, 'Camera', '', '50', '0', 'false', 'cakeShopCamera.jpg', 8, 2),
(24, 'Ice cho', '', '5', '4', 'true', 'Gerard1.jpg', 5, 1),
(25, 'Ice Creem', '', '10', '0', 'false', 'Gusti1.jpg', 6, 1),
(26, 'Ice Creem swsw', '', '11', '0', 'false', 'Gusti2.jpg', 6, 1),
(27, 'Cake Orange', '', '40', '0', 'false', 'cakeryOrange.jpg', 7, 2),
(28, 'Cake Berry ', '', '15', '0', 'false', 'cakeryBerry.jpg', 7, 2),
(29, 'Waffel ', '', '4', '4', 'true', 'AlNejmahsweets_product4.jpg', 10, 6),
(30, ' Ice Creem sweet', '', '20', '0', 'false', 'Gerard8.jpg', 5, 1),
(31, 'waffel', '', '4', '0', 'false', 'AlNejmahsweets_product4.jpg', 10, NULL),
(32, 'em3ale', '', '15', '0', 'false', 'AlNejmahsweets_product2.jpg', 10, NULL),
(33, '7alawet aljeben', '', '6', '0', 'false', 'ArafatSweets_Product4.jpg', 11, NULL),
(34, 'ma3mol', '', '6', '0', 'false', 'HabibahSweets_product3.jpg', 12, NULL),
(35, 'Sweet Habibah', '', '16', '0', 'false', 'HabibahSweets_product5.jpg', 12, NULL),
(36, 'Sweet Habibah', '', '15', '0', 'false', 'HabibahSweets_product2.jpg', 12, NULL),
(37, 'Chees Cake', '', '6', '0', 'false', 'AlNejmahsweets_product3.jpg', 10, NULL),
(38, 'Sweet', '', '15', '14', 'true', 'Gusti7.jpg', 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pro_img`
--

CREATE TABLE `pro_img` (
  `pro_img_id` int(11) NOT NULL,
  `img_name` varchar(50) DEFAULT NULL,
  `pro_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` int(11) NOT NULL,
  `store_name` varchar(25) DEFAULT NULL,
  `store_bio` varchar(2000) DEFAULT NULL,
  `store_img` varchar(255) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `store_name`, `store_bio`, `store_img`, `cat_id`) VALUES
(1, 'Nafeeseh', 'Nafeeseh sweet', 'NafeesehLogo.jpg', 6),
(3, 'Baskin Robeins', 'Baskin Robbins Ice Creem', 'baskin-robbins_logo.png', 1),
(5, 'Gerard', 'Gerard Ice Creem', 'Gerard_Logo.jpg', 1),
(6, 'Gusti ', 'Gusti Ice Creem', 'Gusti_logo.jpg', 1),
(7, ' The Cakery', 'cakery Cake', 'cakery-logo.png', 2),
(8, 'The Cake Shop', 'The Cake Shop Cake', 'cakeShop-logo.png', 2),
(9, 'Rawan Cake', 'Rawan Cake', 'rawan-logo.png', 2),
(10, 'Al Nejmah sweets', 'Al Nejmah sweets', 'AlNejmahsweets_logo.png', 6),
(11, 'Arafat Sweets', 'Arafat Sweets', 'ArafatSweets_logo.jpg', 6),
(12, 'Habibah Sweets', 'Habibah Sweets', 'HabibahSweets_logo.jpg', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `fullname` varchar(40) DEFAULT NULL,
  `status` int(1) DEFAULT NULL COMMENT '1-active, 0-deactive',
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `fullname`, `status`, `created_at`) VALUES
(8, 'test1@ho.com', '8cb2237d0679ca88db6464eac60da96345513964', 'test2', 1, '2021-02-04 19:41:25'),
(9, 'Accessories@ho.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Accessories', 1, '2021-02-04 19:43:13'),
(10, 'Jenan1@hot.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Jenan1', 1, '2021-02-04 19:58:56'),
(11, 'jenan111@hotmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'jenan', 1, '2021-02-04 20:01:24'),
(12, 'a@ho.com', '7d0db336da36537dafbaec45fd68ca7037efac5a', 'Accessories', 1, '2021-02-04 20:04:30'),
(15, 'jenan10@hotmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'jenan', 1, '2021-02-06 18:45:50'),
(16, 'jenan@h1.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Accessories', 1, '2021-02-06 18:50:47'),
(17, 'test@h.com', '', 'test2t4', 1, '2021-02-06 19:48:54'),
(18, 'q@t.com', '', 'test', 1, '2021-02-07 04:57:16'),
(19, 'jenan@hotmail.com', '', 'جنان', 1, '2021-02-07 06:39:06'),
(20, 'Jenanm@hotmail.com', '1111', 'Jenan Musallam', 1, '2021-02-07 14:27:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_id` (`admin_id`),
  ADD KEY `store_id` (`store_id`),
  ADD KEY `hot_pro_id` (`hot_pro_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `cat_id` (`cat_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `o_d_id` (`o_d_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`o_d_id`),
  ADD UNIQUE KEY `o_d_id` (`o_d_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_id`),
  ADD UNIQUE KEY `pro_id` (`pro_id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `pro_img`
--
ALTER TABLE `pro_img`
  ADD PRIMARY KEY (`pro_img_id`),
  ADD UNIQUE KEY `pro_img_id` (`pro_img_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`),
  ADD UNIQUE KEY `store_id` (`store_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `o_d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `pro_img`
--
ALTER TABLE `pro_img`
  MODIFY `pro_img_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`),
  ADD CONSTRAINT `admin_ibfk_2` FOREIGN KEY (`hot_pro_id`) REFERENCES `products` (`pro_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`o_d_id`) REFERENCES `order_details` (`o_d_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `products` (`pro_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`);

--
-- Constraints for table `pro_img`
--
ALTER TABLE `pro_img`
  ADD CONSTRAINT `pro_img_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `products` (`pro_id`);

--
-- Constraints for table `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `store_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
