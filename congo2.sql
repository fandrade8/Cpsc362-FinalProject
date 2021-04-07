-- <!-- 
--   Module Name: 
--   Date of Code: 4/20/2020
--   Programmer's Name: Steven Salazar
--   Description: This module contains the
--   databse for the site
--   Data Structures(if any): None
--   Algorithms(if any): None
--  -->

DROP DATABASE IF EXISTS congo2;
create database congo2;
use congo2;


GRANT ALL PRIVILEGES ON congo2.* TO test IDENTIFIED BY "1234";


-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2020 at 12:14 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `congo2`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkout_info`
--

CREATE TABLE `checkout_info` (
  `id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `address` varchar(40) NOT NULL,
  `city` varchar(25) NOT NULL,
  `state` varchar(10) NOT NULL,
  `zipcode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkout_info`
--

INSERT INTO `checkout_info` (`id`, `user_id`, `first_name`, `last_name`, `address`, `city`, `state`, `zipcode`) VALUES
(1, 3, 'John', 'Smith', '6407 cali st', 'Fullerton', 'ca', '90201');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `code` varchar(100) NOT NULL,
  `price` double(9,2) NOT NULL,
  `image` varchar(250) NOT NULL,
  `image2` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `category` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `price`, `image`, `image2`, `description`, `category`) VALUES
(1, 'IPhone 11 Pro', 'phone01', 1100.00, '../img/iphonethumb.jpg', '../img/iphone.jpeg', '• 5.8-inch OLED display\n• Water and dust resistant\n• Triple-camera', 'phones'),
(2, 'OnePlus 7T Pro', 'phone02', 600.00, '../img/oneplusthumb.jpg', '../img/oneplus.jpg', '• 256GB\n• Dual Sim\n• GSM Unloacked', 'phones'),
(3, 'Surface Pro 7', 'tablet01', 900.00, '../img/surface-prothumb.jpg', '../img/surface-pro.jpg', '• 12.3\" Touch-Screen\n• 10th Gen Intel Core i7\n• 16GB Memory', 'tablets'),
(4, 'IPad Pro', 'tablet02', 1300.00, '../img/ipadthumb.jpeg', '../img/ipad.jpg', '• 12.9-inch\n• 256GB\n• Space Gray', 'tablets'),
(5, 'Beats Solo3', 'headphones01', 200.00, '../img/beatsthumb.jpg', '../img/beats.jpg', '• Wireless On-Ear Headphones\n• Apple W1 Headphone Chip\n• 40 Hours Of Listening Time', 'headphones'),
(6, 'Montblanc MB01', 'headphone1', 500.00, '../img/montblancthumb.jpg', '../img/montblanc.jpg', '• Bluetooth 5.0\n• Wireless and Wired\n• Connectivity to Smartwatch', 'headphones');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `EmailAddress` varchar(30) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `UserID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`EmailAddress`, `Password`, `UserID`) VALUES
('mavdayot1@gmail.com', 'c4d02dd998a88f75fc3454c9df3c2259', 1),
('1@1', '25d55ad283aa400af464c76d713c07ad', 2),
('2@2', '1bbd886460827015e5d605ed44252251', 3),
('a@a', '1bbd886460827015e5d605ed44252251', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkout_info`
--
ALTER TABLE `checkout_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checkout_info_ibfk_1` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `UserID` (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkout_info`
--
ALTER TABLE `checkout_info`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkout_info`
--
ALTER TABLE `checkout_info`
  ADD CONSTRAINT `checkout_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
