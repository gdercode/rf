-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2023 at 07:21 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rf`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_user_table`
--

CREATE TABLE `all_user_table` (
  `user_id` int(11) NOT NULL,
  `user_first_name` varchar(50) NOT NULL,
  `user_last_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_mobile` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `registration_date` datetime NOT NULL,
  `user_update_date` datetime NOT NULL,
  `user_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `all_user_table`
--

INSERT INTO `all_user_table` (`user_id`, `user_first_name`, `user_last_name`, `user_email`, `user_mobile`, `username`, `user_password`, `registration_date`, `user_update_date`, `user_role_id`) VALUES
(1, 'superAdmin', 'superAdmin', 'superAdmin@gmail.com', '+250782546969', 'superAdmin', '$2y$10$psjPKzl2I4DauRYmSAnxUOA3Ev/Z5qrWPWQnPdM40TlF7qPhcuTJe', '2022-08-04 10:42:55', '0000-00-00 00:00:00', 1),
(9, 'NIYONKURU', 'Jacqueline', 'niyonkuru@gmail.com', '+25779594711', 'niyonkuru', '$2y$10$h9ppxg5fde6496auAUDvTe.JpK2OkXzKPc4a5Ug0XBlMlYHajKK.W', '2023-01-05 19:46:00', '2023-02-17 17:06:42', 6),
(11, 'BUKEYENEZA', 'Mediatrice', 'm@gmail.com', '+25767041600', 'Meddy', '$2y$10$cwykKs7sa/KQo5SNYnZoT.EqsajNG4xrpXWecAh96T6kXObKGi/n.', '2023-01-05 20:14:43', '0000-00-00 00:00:00', 6);

-- --------------------------------------------------------

--
-- Table structure for table `in_stock_history_table`
--

CREATE TABLE `in_stock_history_table` (
  `in_hist_id` int(11) NOT NULL,
  `in_prod_id` int(11) NOT NULL,
  `in_prod_total_item` varchar(50) NOT NULL,
  `in_prod_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `in_stock_history_table`
--

INSERT INTO `in_stock_history_table` (`in_hist_id`, `in_prod_id`, `in_prod_total_item`, `in_prod_date`) VALUES
(23, 31, '30', '2023-01-05 00:00:00'),
(24, 32, '30', '2023-01-05 00:00:00'),
(25, 33, '50', '2023-01-05 00:00:00'),
(26, 34, '50', '2023-01-05 00:00:00'),
(27, 30, '30', '2023-01-05 00:00:00'),
(28, 31, '30', '2023-01-06 15:40:35'),
(29, 34, '5', '2023-01-06 15:43:30'),
(30, 32, '3', '2023-01-06 15:43:30'),
(31, 35, '35', '2023-01-06 17:25:56'),
(32, 37, '10', '2023-01-06 17:25:56'),
(33, 39, '5', '2023-01-06 17:25:56'),
(34, 36, '30', '2023-01-06 17:25:57'),
(35, 38, '5', '2023-01-06 17:25:57'),
(36, 42, '8', '2023-01-06 17:25:57'),
(37, 40, '300', '2023-01-06 17:25:57'),
(38, 41, '24', '2023-01-06 17:25:58'),
(39, 33, '2', '2023-01-10 10:05:01'),
(40, 42, '8', '2023-01-10 18:33:08'),
(41, 36, '30', '2023-01-10 18:33:09'),
(42, 37, '10', '2023-01-10 18:33:09'),
(43, 39, '5', '2023-01-10 18:33:09'),
(44, 38, '5', '2023-01-10 18:33:09'),
(45, 35, '35', '2023-01-10 18:33:09'),
(46, 44, '24', '2023-01-10 18:33:10'),
(47, 43, '300', '2023-01-10 18:33:10'),
(48, 45, '15', '2023-02-13 07:40:33'),
(49, 40, '123', '2023-02-13 07:40:33'),
(50, 41, '1', '2023-02-17 17:27:10'),
(51, 44, '2', '2023-02-17 17:27:10'),
(52, 40, '34', '2023-02-17 17:27:10'),
(53, 44, '12', '2023-02-17 17:27:35'),
(54, 45, '400', '2023-02-20 22:49:42');

-- --------------------------------------------------------

--
-- Table structure for table `in_stock_table`
--

CREATE TABLE `in_stock_table` (
  `in_stock_id` int(11) NOT NULL,
  `in_prod_id` int(11) NOT NULL,
  `in_prod_total_item` varchar(50) NOT NULL,
  `in_prod_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `out_stock_history_table`
--

CREATE TABLE `out_stock_history_table` (
  `out_hist_id` int(11) NOT NULL,
  `out_user_id` int(11) NOT NULL,
  `refugee_id` int(11) NOT NULL,
  `out_prod_id` int(11) NOT NULL,
  `out_quantity` varchar(50) NOT NULL,
  `out_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `out_stock_history_table`
--

INSERT INTO `out_stock_history_table` (`out_hist_id`, `out_user_id`, `refugee_id`, `out_prod_id`, `out_quantity`, `out_date`) VALUES
(17, 9, 0, 32, '1', '2023-01-05 00:00:00'),
(18, 9, 0, 34, '5', '2023-01-05 00:14:05'),
(19, 9, 0, 32, '2', '2023-01-06 15:35:48'),
(20, 9, 0, 31, '30', '2023-01-06 15:35:48'),
(21, 1, 0, 33, '2', '2023-01-10 10:04:26'),
(22, 1, 0, 31, '5', '2023-01-10 10:04:26'),
(23, 1, 0, 45, '3', '2023-02-13 07:42:50'),
(24, 1, 0, 41, '21', '2023-02-13 07:42:51'),
(25, 1, 0, 44, '9', '2023-02-13 23:24:28'),
(26, 1, 0, 40, '99', '2023-02-13 23:24:28'),
(27, 1, 0, 43, '15', '2023-02-14 00:40:44'),
(28, 1, 11, 42, '2', '2023-02-14 00:50:55'),
(29, 1, 11, 43, '15', '2023-02-14 00:50:55'),
(30, 9, 11, 42, '1', '2023-02-17 17:08:22'),
(31, 9, 11, 39, '1', '2023-02-17 17:08:23'),
(32, 9, 11, 43, '1', '2023-02-17 17:08:23'),
(33, 1, 9, 30, '2', '2023-02-17 17:22:51'),
(34, 1, 9, 39, '1', '2023-02-17 17:22:52'),
(35, 1, 11, 30, '25', '2023-02-20 22:47:30'),
(36, 1, 11, 45, '5', '2023-02-20 22:47:30'),
(37, 1, 11, 45, '7', '2023-02-20 22:48:44');

-- --------------------------------------------------------

--
-- Table structure for table `out_stock_table`
--

CREATE TABLE `out_stock_table` (
  `out_id` int(11) NOT NULL,
  `out_prod_id` int(11) NOT NULL,
  `out_quantity` varchar(50) NOT NULL,
  `out_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_table`
--

CREATE TABLE `product_table` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_registration_date` datetime NOT NULL,
  `product_update_date` datetime NOT NULL,
  `in_stock_status` varchar(15) NOT NULL,
  `out_stock_status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_table`
--

INSERT INTO `product_table` (`product_id`, `product_name`, `product_category`, `product_registration_date`, `product_update_date`, `in_stock_status`, `out_stock_status`) VALUES
(30, 'Batterie', 'Unit', '2023-01-06 15:09:03', '2023-01-06 15:09:03', '', ''),
(31, 'Batterie', 'Unit', '2023-01-06 15:11:23', '2023-01-06 15:11:23', '', ''),
(32, 'Batterie', 'Unit', '2023-01-06 15:13:25', '2023-02-17 17:26:50', '', ''),
(33, 'Kinju', 'Liquid', '2023-01-06 15:14:50', '2023-02-20 22:51:56', '', ''),
(34, 'Pneus', 'Unit', '2023-01-06 15:16:27', '2023-01-06 15:16:27', '', ''),
(35, 'Chambre a air', 'Unit', '2023-01-06 16:17:15', '2023-01-06 16:17:15', '', ''),
(36, 'Chambre a air', 'Unit', '2023-01-06 16:18:41', '2023-01-06 16:18:41', '', ''),
(37, 'Chambre a air', 'Unit', '2023-01-06 16:19:58', '2023-01-06 16:19:58', '', ''),
(38, 'Chambre a air', 'Unit', '2023-01-06 16:21:23', '2023-01-06 16:21:23', '', ''),
(39, 'Chambre a air', 'Unit', '2023-01-06 16:23:03', '2023-01-06 16:23:03', '', ''),
(40, 'STAR ONE', 'Liquid', '2023-01-06 16:26:44', '2023-01-06 16:26:44', '', ''),
(41, 'DIVYOL', 'Liquid', '2023-01-06 16:28:56', '2023-01-06 16:28:56', '', ''),
(42, 'MASTIC DE FER ISOPON', 'Unit', '2023-01-06 16:43:38', '2023-01-10 18:24:25', '', ''),
(43, 'STAR ONE DIESEL', 'Solid', '2023-01-10 18:26:08', '2023-02-17 17:25:03', '', ''),
(44, 'DIVYOL', 'Liquid', '2023-01-10 18:27:18', '2023-01-10 18:27:18', '', ''),
(45, 'umunyu', 'Solid', '2023-02-13 07:34:00', '2023-02-13 07:34:00', '', ''),
(46, 'Oil', 'Liquid', '2023-02-20 22:53:12', '2023-02-20 22:53:12', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `role_table`
--

CREATE TABLE `role_table` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `role_percentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_table`
--

INSERT INTO `role_table` (`role_id`, `role_name`, `role_percentage`) VALUES
(1, 'superAdmin', 100),
(6, 'Agent', 70),
(9, 'Refugee', 10),
(10, 'Admin', 92);

-- --------------------------------------------------------

--
-- Table structure for table `stock_table`
--

CREATE TABLE `stock_table` (
  `stock_id` int(11) NOT NULL,
  `stock_prod_id` int(11) NOT NULL,
  `stock_prod_quantity` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_table`
--

INSERT INTO `stock_table` (`stock_id`, `stock_prod_id`, `stock_prod_quantity`) VALUES
(8, 30, '3'),
(9, 31, '25'),
(10, 32, '30'),
(11, 33, '50'),
(12, 34, '50'),
(13, 35, '70'),
(14, 36, '60'),
(15, 37, '20'),
(16, 38, '10'),
(17, 39, '8'),
(18, 40, '358'),
(19, 41, '4'),
(20, 42, '13'),
(21, 43, '269'),
(22, 44, '29'),
(23, 45, '400'),
(24, 46, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_user_table`
--
ALTER TABLE `all_user_table`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_role_id` (`user_role_id`);

--
-- Indexes for table `in_stock_history_table`
--
ALTER TABLE `in_stock_history_table`
  ADD PRIMARY KEY (`in_hist_id`),
  ADD KEY `in_prod_id` (`in_prod_id`);

--
-- Indexes for table `in_stock_table`
--
ALTER TABLE `in_stock_table`
  ADD PRIMARY KEY (`in_stock_id`),
  ADD KEY `ibirangurwa_id` (`in_prod_id`);

--
-- Indexes for table `out_stock_history_table`
--
ALTER TABLE `out_stock_history_table`
  ADD PRIMARY KEY (`out_hist_id`),
  ADD KEY `out_user_id` (`out_user_id`,`out_prod_id`),
  ADD KEY `out_prod_id` (`out_prod_id`);

--
-- Indexes for table `out_stock_table`
--
ALTER TABLE `out_stock_table`
  ADD PRIMARY KEY (`out_id`),
  ADD KEY `out_user_id` (`out_prod_id`),
  ADD KEY `out_prod_id` (`out_prod_id`);

--
-- Indexes for table `product_table`
--
ALTER TABLE `product_table`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `role_table`
--
ALTER TABLE `role_table`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `stock_table`
--
ALTER TABLE `stock_table`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `stock_prod_id` (`stock_prod_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_user_table`
--
ALTER TABLE `all_user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `in_stock_history_table`
--
ALTER TABLE `in_stock_history_table`
  MODIFY `in_hist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `in_stock_table`
--
ALTER TABLE `in_stock_table`
  MODIFY `in_stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `out_stock_history_table`
--
ALTER TABLE `out_stock_history_table`
  MODIFY `out_hist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `out_stock_table`
--
ALTER TABLE `out_stock_table`
  MODIFY `out_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `product_table`
--
ALTER TABLE `product_table`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `role_table`
--
ALTER TABLE `role_table`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stock_table`
--
ALTER TABLE `stock_table`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `all_user_table`
--
ALTER TABLE `all_user_table`
  ADD CONSTRAINT `all_user_table_ibfk_1` FOREIGN KEY (`user_role_id`) REFERENCES `role_table` (`role_id`);

--
-- Constraints for table `in_stock_history_table`
--
ALTER TABLE `in_stock_history_table`
  ADD CONSTRAINT `in_stock_history_table_ibfk_1` FOREIGN KEY (`in_prod_id`) REFERENCES `product_table` (`product_id`);

--
-- Constraints for table `in_stock_table`
--
ALTER TABLE `in_stock_table`
  ADD CONSTRAINT `in_stock_table_ibfk_1` FOREIGN KEY (`in_prod_id`) REFERENCES `product_table` (`product_id`);

--
-- Constraints for table `out_stock_history_table`
--
ALTER TABLE `out_stock_history_table`
  ADD CONSTRAINT `out_stock_history_table_ibfk_1` FOREIGN KEY (`out_prod_id`) REFERENCES `product_table` (`product_id`),
  ADD CONSTRAINT `out_stock_history_table_ibfk_2` FOREIGN KEY (`out_user_id`) REFERENCES `all_user_table` (`user_id`);

--
-- Constraints for table `out_stock_table`
--
ALTER TABLE `out_stock_table`
  ADD CONSTRAINT `out_stock_table_ibfk_1` FOREIGN KEY (`out_prod_id`) REFERENCES `product_table` (`product_id`);

--
-- Constraints for table `stock_table`
--
ALTER TABLE `stock_table`
  ADD CONSTRAINT `stock_table_ibfk_1` FOREIGN KEY (`stock_prod_id`) REFERENCES `product_table` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
