-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2024 at 04:20 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `estatex`
--

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `trxid` varchar(10) NOT NULL,
  `datetime` datetime NOT NULL,
  `estate_id` int(11) NOT NULL,
  `buyer_name` varchar(50) NOT NULL,
  `buyer_contact` varchar(11) NOT NULL,
  `buyer_nid` varchar(10) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_method` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `trxid`, `datetime`, `estate_id`, `buyer_name`, `buyer_contact`, `buyer_nid`, `amount`, `payment_method`) VALUES
(16, 'Rsrby6kUAh', '2024-02-21 18:59:38', 26, 'fardin110', '01223654789', '0123456782', 6532, 'MasterCard'),
(17, 'E5mkoYnLX3', '2024-02-21 19:27:55', 25, 'fardin', '01234567891', '0123456789', 8900000, 'MasterCard'),
(18, 'jIsCRSSn9O', '2024-02-21 19:47:06', 29, 'fardin110', '01223654789', '0123456782', 120000000, 'VISA'),
(19, 'f1j3n8byLr', '2024-02-25 13:59:02', 30, 'fardin110', '01223654789', '0123456782', 453453, 'MasterCard');

-- --------------------------------------------------------

--
-- Table structure for table `real_estate`
--

CREATE TABLE `real_estate` (
  `estate_id` int(11) NOT NULL,
  `seller_Name` varchar(30) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `Area_Size` int(11) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `Block` varchar(10) DEFAULT NULL,
  `Street` varchar(255) DEFAULT NULL,
  `Buyer_NID` varchar(10) DEFAULT NULL,
  `Seller_NID` varchar(10) DEFAULT NULL,
  `Transaction_code` varchar(255) DEFAULT NULL,
  `Apartment_flag` tinyint(1) DEFAULT 0,
  `Land_flag` tinyint(1) DEFAULT 0,
  `Floor_No` int(20) DEFAULT NULL,
  `Apartment_No` int(6) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `real_estate`
--

INSERT INTO `real_estate` (`estate_id`, `seller_Name`, `price`, `Area_Size`, `City`, `Block`, `Street`, `Buyer_NID`, `Seller_NID`, `Transaction_code`, `Apartment_flag`, `Land_flag`, `Floor_No`, `Apartment_No`, `description`, `image`) VALUES
(28, 'Fardin Rahman', 12000000, 16000, 'Dhaka', 'West Dhanm', '10/A', NULL, '0123456789', NULL, 1, 0, 6, 6, 'Chobi dekho', 'sample.png'),
(31, 'Fardin Rahman', 120000000, 16000, 'Dhaka', 'West Dhanm', '10/A', NULL, '0123456782', NULL, 1, 0, 6, 6, 'DEKHOOOO', 'sample5.png'),
(32, 'Anonymous', 9800000, 5000, 'Khulna', 'Rose', '12/C', NULL, '0123456789', NULL, 0, 1, 0, 0, 'Photo of land', 'sample2.png'),
(33, 'Mark', 1450000, 1850, 'Chittagong', 'New Avenue', '6/E', NULL, '0123456782', NULL, 1, 0, 8, 8, 'Image of interior', 'photo2.jpg'),
(34, 'John', 56000000, 2200, 'Dhaka', 'Bashundhar', '3/C', NULL, '0123456782', NULL, 1, 0, 2, 2, 'Picture of house', 'Photo1.jpg'),
(35, 'Dwayne', 98000000, 42000, 'Rajshahi', 'Ranch vall', 'Court St', NULL, '0123456782', NULL, 0, 1, 0, 0, 'Photo of ploto', 'sample.png'),
(36, 'Clarissa', 21000000, 2600, 'Sylhet', 'Sector 7', 'Rose avenue', NULL, '0123456782', NULL, 1, 0, 9, 9, 'Photo of flat', 'sample3.png'),
(37, 'Fardin', 820000000, 26000, 'Dhaka', 'Wick St', '6/A', NULL, '0123456782', NULL, 1, 0, 10, 10, 'Photo of living room', 'login.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nid` varchar(10) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `dob` date NOT NULL,
  `street` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `nid`, `contact`, `dob`, `street`, `area`, `city`) VALUES
(1, 'fardin', 'fardin@gmail.com', '$2y$10$l08JhlcqI0VMbKzcEalL5OyXRY76ZmLej9WCOccUPzleQLb6gdPZS', '0123456789', '01234567891', '2000-02-18', '10/A', 'Dhanmondi', 'Dhaka'),
(2, 'fardin110', 'fardin110@gmail.com', '$2y$10$/jEwZmWlnHU/edP5t.rdE.4GvfzWw5cRuXJRZJ8RSB/pMs89e25L6', '0123456782', '01223654789', '2000-02-16', '12/A', 'Dmd', 'DHK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `real_estate`
--
ALTER TABLE `real_estate`
  ADD PRIMARY KEY (`estate_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `real_estate`
--
ALTER TABLE `real_estate`
  MODIFY `estate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
