-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2017 at 07:41 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shopping_cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
`id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total` decimal(9,2) NOT NULL,
  `total_discount` decimal(9,2) NOT NULL,
  `total_with_discount` decimal(9,2) NOT NULL,
  `total_tax` decimal(9,2) NOT NULL,
  `total_with_tax` decimal(9,2) NOT NULL,
  `grand_total` decimal(9,2) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `product_id`, `user_id`, `name`, `total`, `total_discount`, `total_with_discount`, `total_tax`, `total_with_tax`, `grand_total`, `created_date`, `modified_date`) VALUES
(1, 2, 4, 'sadhukuttu test', '8.00', '23.00', '30.00', '23.00', '45.00', '98.00', '2017-06-16 10:42:11', '2017-06-16 05:12:11');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `tax` decimal(9,2) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `tax`, `created_date`, `modified_date`) VALUES
(1, 'sadhukuttu', 'test today', '100.00', '2017-06-16 10:00:58', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `discount` decimal(9,2) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `discount`, `created_date`, `modified_date`) VALUES
(2, 3, 'sadhukuttu', 'test', '0.00', '100567.00', '2017-06-16 10:25:43', '0000-00-00 00:00:00'),
(3, 3, 'sadhukuttu', 'test', '0.00', '100567.00', '2017-06-16 10:26:22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `mobile_no` varchar(12) DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `dob`, `mobile_no`, `role_id`, `created_date`, `modified_date`) VALUES
(1, 'bs.sandhya.in', 'sandhya', 'bs', '2017-06-07', NULL, 1, '2017-06-16 00:00:00', '2017-06-16 02:28:14'),
(2, '', 'ammu', 'test', '1990-01-22', '8807946650', 2, '2017-06-16 11:00:15', '0000-00-00 00:00:00'),
(3, 'bs.sandhu@gmail.com', 'ammu', 'test', '1990-01-22', '8807946650', 2, '2017-06-16 11:01:27', '0000-00-00 00:00:00'),
(4, 'bs.sandhu@gmail.com', 'ammu', 'test', '1990-01-22', '8807946650', 2, '2017-06-16 11:09:49', '0000-00-00 00:00:00'),
(5, 'bs.sandhu@gmail.com', 'ammu', 'test', '1990-01-22', '8807946650', 2, '2017-06-16 11:10:33', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
