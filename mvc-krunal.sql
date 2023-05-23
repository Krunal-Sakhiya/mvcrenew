-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2023 at 06:44 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvc-krunal`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `description` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `parent_id`, `path`, `name`, `status`, `description`, `create_at`, `update_at`) VALUES
(55, 0, '55', 'root', 2, 'root', '2023-05-05 11:27:02', '2023-05-09 09:50:38'),
(56, 55, '55=56', 'bed room', 1, 'bed room', '2023-05-05 11:27:42', NULL),
(57, 56, '55=56=57', 'bed', 2, 'bed', '2023-05-05 11:30:59', '0000-00-00 00:00:00'),
(63, 55, '55=63', 'kll', 1, 'kll', '2023-05-11 09:53:38', '0000-00-00 00:00:00'),
(65, 55, '55=65', 'cup', 1, 'ghh', '2023-05-23 06:28:01', '2023-05-23 06:37:04');

-- --------------------------------------------------------

--
-- Table structure for table `category_decimal`
--

CREATE TABLE `category_decimal` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_integer`
--

CREATE TABLE `category_integer` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_text`
--

CREATE TABLE `category_text` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_varchar`
--

CREATE TABLE `category_varchar` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_varchar`
--

INSERT INTO `category_varchar` (`value_id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 65, 161, 'green cup');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `billing_address_id` int(11) DEFAULT NULL,
  `shipping_address_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `mobile` varchar(40) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `billing_address_id`, `shipping_address_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `create_at`, `update_at`) VALUES
(76, 141, 142, '9', '9', '9@gmail.com', 'male', '9', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 147, 148, 'o', 'o', 'o', 'male', 'o', 1, '2023-05-04 10:20:10', '2023-05-05 10:00:09'),
(86, 160, 161, 'p', 'p', 'p', 'male', 'p', 2, '2023-05-05 10:45:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `address_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`address_id`, `customer_id`, `address`, `city`, `state`, `country`, `zipcode`) VALUES
(141, 76, '9', '9', '9', '9', '9'),
(142, 76, '9', '9', '9', '9', '9'),
(147, 79, 'oqqqqqqqqqqq', 'o', 'o', 'o', 'o'),
(148, 79, 'pppppppppppppp', 'p', 'p', 'p', 'p'),
(160, 86, 'pp', 'pp', 'pp', 'pp', 'p'),
(161, 86, 'oo', 'o', 'o', 'oo', 'oo');

-- --------------------------------------------------------

--
-- Table structure for table `eav_attribute`
--

CREATE TABLE `eav_attribute` (
  `attribute_id` int(11) NOT NULL,
  `entity_type_id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `backend_type` varchar(20) NOT NULL,
  `input_type` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `backend_model` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eav_attribute`
--

INSERT INTO `eav_attribute` (`attribute_id`, `entity_type_id`, `code`, `backend_type`, `input_type`, `name`, `status`, `backend_model`) VALUES
(142, 1, 'product notes', 'varchar', 'text', 'Product Notes', 1, ''),
(159, 1, 'model', 'integer', 'select', 'Model', 1, ''),
(161, 2, 'color', 'varchar', 'text', 'Color', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `eav_attribute_option`
--

CREATE TABLE `eav_attribute_option` (
  `option_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `position` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eav_attribute_option`
--

INSERT INTO `eav_attribute_option` (`option_id`, `name`, `attribute_id`, `position`) VALUES
(83, 'Laptop', 159, 1),
(84, 'Phone', 159, 2),
(89, 'Tablate', 159, 3);

-- --------------------------------------------------------

--
-- Table structure for table `entity_type`
--

CREATE TABLE `entity_type` (
  `entity_type_id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `entity_model` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `entity_type`
--

INSERT INTO `entity_type` (`entity_type_id`, `type_name`, `entity_model`) VALUES
(1, 'product', ''),
(2, 'category', ''),
(3, 'customer', ''),
(4, 'salesman', ''),
(5, 'vendor', '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(5) DEFAULT 100,
  `description` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `color` enum('red','green','yellow') NOT NULL,
  `material` enum('hard','soft') NOT NULL,
  `small_id` int(11) DEFAULT NULL,
  `thumbnail_id` int(11) DEFAULT NULL,
  `base_id` int(11) DEFAULT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `sku`, `cost`, `price`, `quantity`, `description`, `status`, `color`, `material`, `small_id`, `thumbnail_id`, `base_id`, `create_at`, `update_at`) VALUES
(291, 'nokia 1100', '8', '4000.00', '5000.00', 4, 'old model', 1, 'red', 'hard', NULL, NULL, NULL, '2023-05-23 05:58:08', NULL),
(292, 'kl', '8', '90.00', '999.00', 9, 'jkl', 1, 'red', 'hard', 0, 0, 0, '2023-05-23 06:02:37', '2023-05-23 06:02:58');

-- --------------------------------------------------------

--
-- Table structure for table `product_decimal`
--

CREATE TABLE `product_decimal` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_integer`
--

CREATE TABLE `product_integer` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_integer`
--

INSERT INTO `product_integer` (`value_id`, `entity_id`, `attribute_id`, `value`) VALUES
(8, 291, 159, 83),
(9, 292, 159, 83);

-- --------------------------------------------------------

--
-- Table structure for table `product_text`
--

CREATE TABLE `product_text` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_text`
--

INSERT INTO `product_text` (`value_id`, `entity_id`, `attribute_id`, `value`) VALUES
(8, 291, 142, '');

-- --------------------------------------------------------

--
-- Table structure for table `product_varchar`
--

CREATE TABLE `product_varchar` (
  `value_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_varchar`
--

INSERT INTO `product_varchar` (`value_id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 292, 142, 'green');

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

CREATE TABLE `salesman` (
  `salesman_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `company` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesman`
--

INSERT INTO `salesman` (`salesman_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `company`, `create_at`, `update_at`) VALUES
(4, '5', '5', '5@gmail.com', 'female', '5', 1, '5', '2023-04-08 10:17:22', '2023-04-29 11:52:52'),
(7, 'op', 'op', 'p@gmail.com', '', '98833r093', 1, 'op', '2023-04-25 06:59:05', '2023-04-26 01:20:08'),
(37, 'p', 'p', 'p@gmail.com', 'male', 'p', 2, 'p', '2023-04-29 11:53:35', NULL),
(39, 'abc', 'as', 'ac@gmail.com', 'male', '98833r093', 1, 'qw', '2023-05-03 12:24:28', '2023-05-09 08:36:55');

-- --------------------------------------------------------

--
-- Table structure for table `salesman_address`
--

CREATE TABLE `salesman_address` (
  `address_id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesman_address`
--

INSERT INTO `salesman_address` (`address_id`, `salesman_id`, `address`, `city`, `state`, `country`, `zipcode`) VALUES
(4, 4, '5', '5', '5', '5', '5'),
(7, 7, 'op', 'op', 'o', 'po', 'p'),
(37, 37, 'p', 'p', 'p', 'p', 'p'),
(39, 39, 'jkq', 'jk', 'jk', 'jk', 'jk');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `mobile` varchar(40) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `company` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `company`, `create_at`, `update_at`) VALUES
(45, '1', '1', '1', 'male', '', 1, '', '2023-05-10 09:37:20', NULL),
(46, 'p', 'p', 'pp', 'male', 'p', 1, 'p', '2023-05-10 09:37:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_address`
--

CREATE TABLE `vendor_address` (
  `address_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor_address`
--

INSERT INTO `vendor_address` (`address_id`, `vendor_id`, `address`, `city`, `state`, `country`, `zipcode`) VALUES
(45, 45, '', '', '', '', ''),
(46, 46, 'p', 'p', 'p', 'p', 'p');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `category_decimal`
--
ALTER TABLE `category_decimal`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id` (`entity_id`,`attribute_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `category_integer`
--
ALTER TABLE `category_integer`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id` (`entity_id`,`attribute_id`);

--
-- Indexes for table `category_text`
--
ALTER TABLE `category_text`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id` (`entity_id`,`attribute_id`);

--
-- Indexes for table `category_varchar`
--
ALTER TABLE `category_varchar`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id` (`entity_id`,`attribute_id`) USING BTREE;

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `billing_address_id` (`billing_address_id`),
  ADD KEY `shipping_address_id` (`shipping_address_id`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `eav_attribute`
--
ALTER TABLE `eav_attribute`
  ADD PRIMARY KEY (`attribute_id`),
  ADD UNIQUE KEY `entity_type_id_2` (`entity_type_id`,`code`),
  ADD KEY `entity_type_id` (`entity_type_id`);

--
-- Indexes for table `eav_attribute_option`
--
ALTER TABLE `eav_attribute_option`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `entity_type`
--
ALTER TABLE `entity_type`
  ADD PRIMARY KEY (`entity_type_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_decimal`
--
ALTER TABLE `product_decimal`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id` (`entity_id`,`attribute_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `product_integer`
--
ALTER TABLE `product_integer`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id` (`entity_id`,`attribute_id`);

--
-- Indexes for table `product_text`
--
ALTER TABLE `product_text`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id` (`entity_id`,`attribute_id`);

--
-- Indexes for table `product_varchar`
--
ALTER TABLE `product_varchar`
  ADD PRIMARY KEY (`value_id`),
  ADD UNIQUE KEY `entity_id` (`entity_id`,`attribute_id`) USING BTREE;

--
-- Indexes for table `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`salesman_id`);

--
-- Indexes for table `salesman_address`
--
ALTER TABLE `salesman_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `salesman_id` (`salesman_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `category_decimal`
--
ALTER TABLE `category_decimal`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_integer`
--
ALTER TABLE `category_integer`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_text`
--
ALTER TABLE `category_text`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_varchar`
--
ALTER TABLE `category_varchar`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `eav_attribute`
--
ALTER TABLE `eav_attribute`
  MODIFY `attribute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `eav_attribute_option`
--
ALTER TABLE `eav_attribute_option`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `entity_type`
--
ALTER TABLE `entity_type`
  MODIFY `entity_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;

--
-- AUTO_INCREMENT for table `product_decimal`
--
ALTER TABLE `product_decimal`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_integer`
--
ALTER TABLE `product_integer`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_text`
--
ALTER TABLE `product_text`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_varchar`
--
ALTER TABLE `product_varchar`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `salesman_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `salesman_address`
--
ALTER TABLE `salesman_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `vendor_address`
--
ALTER TABLE `vendor_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_decimal`
--
ALTER TABLE `category_decimal`
  ADD CONSTRAINT `category_decimal_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_integer`
--
ALTER TABLE `category_integer`
  ADD CONSTRAINT `category_integer_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_text`
--
ALTER TABLE `category_text`
  ADD CONSTRAINT `category_text_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_varchar`
--
ALTER TABLE `category_varchar`
  ADD CONSTRAINT `category_varchar_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`billing_address_id`) REFERENCES `customer_address` (`address_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`shipping_address_id`) REFERENCES `customer_address` (`address_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `eav_attribute`
--
ALTER TABLE `eav_attribute`
  ADD CONSTRAINT `eav_attribute_ibfk_1` FOREIGN KEY (`entity_type_id`) REFERENCES `entity_type` (`entity_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eav_attribute_option`
--
ALTER TABLE `eav_attribute_option`
  ADD CONSTRAINT `eav_attribute_option_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_decimal`
--
ALTER TABLE `product_decimal`
  ADD CONSTRAINT `product_decimal_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_integer`
--
ALTER TABLE `product_integer`
  ADD CONSTRAINT `product_integer_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_text`
--
ALTER TABLE `product_text`
  ADD CONSTRAINT `product_text_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_varchar`
--
ALTER TABLE `product_varchar`
  ADD CONSTRAINT `product_varchar_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salesman_address`
--
ALTER TABLE `salesman_address`
  ADD CONSTRAINT `salesman_address_ibfk_1` FOREIGN KEY (`salesman_id`) REFERENCES `salesman` (`salesman_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD CONSTRAINT `vendor_address_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
