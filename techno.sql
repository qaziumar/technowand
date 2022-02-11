-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2022 at 01:29 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techno`
--

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `offer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `offer_amount` decimal(10,2) NOT NULL,
  `offer_status` enum('Open','Accepted','Declined') NOT NULL DEFAULT 'Open',
  `start_date` date NOT NULL,
  `offered_by` int(11) NOT NULL,
  `offered_date` date NOT NULL,
  `comments` mediumtext NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`offer_id`, `user_id`, `offer_amount`, `offer_status`, `start_date`, `offered_by`, `offered_date`, `comments`, `created_on`, `updated_on`) VALUES
(1, 1, '2000.00', 'Declined', '2022-02-11', 2, '2022-02-11', 'This is For Dominos', '2022-02-11 15:36:59', '2022-02-11 11:06:00'),
(2, 1, '3000.00', 'Accepted', '2022-02-11', 2, '2022-02-11', 'This is for Pizza Hut', '2022-02-11 15:36:59', '2022-02-11 11:06:00'),
(3, 3, '4500.00', 'Open', '2022-02-11', 2, '2022-02-11', 'This is for Fun Republic', '2022-02-11 15:54:43', '2022-02-11 11:23:44'),
(4, 4, '3600.00', 'Open', '2022-02-11', 2, '2022-02-11', 'This is for Levis Jeans', '2022-02-11 15:54:43', '2022-02-11 11:23:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` char(1) NOT NULL DEFAULT 'N',
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `is_admin`, `created_on`, `updated_on`) VALUES
(1, 'Umar Adil', 'qzi.umar@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'N', '2022-02-11 12:26:27', '2022-02-11 07:55:13'),
(2, 'Technowand', 'admin@technowand.com', 'e10adc3949ba59abbe56e057f20f883e', 'Y', '2022-02-11 12:26:27', '2022-02-11 07:55:13'),
(3, 'John Doe', 'john@mailinator.com', 'e10adc3949ba59abbe56e057f20f883e', 'N', '2022-02-11 15:53:37', '2022-02-11 11:22:57'),
(4, 'Mike Hussey', 'mike@mailinator.com', 'e10adc3949ba59abbe56e057f20f883e', 'N', '2022-02-11 15:53:37', '2022-02-11 11:22:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`offer_id`),
  ADD KEY `User_id` (`user_id`),
  ADD KEY `offered_by` (`offered_by`);

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
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `User_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `offered_by` FOREIGN KEY (`offered_by`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
