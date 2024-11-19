-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2024 at 02:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

CREATE DATABASE job_portal;
USE job_portal;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `advert_clicks`
--

CREATE TABLE `advert_clicks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vacancy_ref` varchar(50) DEFAULT NULL,
  `click_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advert_clicks`
--

INSERT INTO `advert_clicks` (`id`, `user_id`, `vacancy_ref`, `click_date`) VALUES
(47, 2, 'JNB000435/NM', '2024-11-04 00:59:10'),
(48, 2, 'JNB000435/NM', '2024-11-04 01:04:24'),
(49, 2, 'JNB000435/NM', '2024-11-04 01:04:29'),
(50, 2, 'JNB000435/NM', '2024-11-04 01:04:37'),
(51, 2, 'JNB000435/NM', '2024-11-04 01:13:54'),
(52, 2, 'JNB000435/NM', '2024-11-05 01:14:00'),
(53, 2, 'JNB000435/NM', '2024-11-05 01:15:05'),
(54, 2, 'JNB000435/NM', '2024-11-05 01:22:24'),
(55, 2, 'JNB000435/NM', '2024-11-05 01:31:32'),
(56, 2, 'JNB000435/NM', '2024-11-05 01:39:36'),
(57, 2, 'JNB000435/NM', '2024-11-05 01:40:20'),
(58, 5, 'JNB000435/NM', '2024-11-05 12:58:11'),
(59, 5, 'JNB000435/NM', '2024-11-05 13:03:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`) VALUES
(2, 'William Rashopola', 'wmrashopola@outlook.com', '$2y$10$TWli.pJS5cvgONYK3dvjxuYBDTw1r7zQ3xMorcZxSxQeVCsZJi1ei'),
(5, 'Test', 'test@gmail.com', '$2y$10$jO.FiG9TRcrHyzeWYiM4lOlwLUbC1526q79x0SEnAzpHWUzSBW24.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advert_clicks`
--
ALTER TABLE `advert_clicks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advert_clicks`
--
ALTER TABLE `advert_clicks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advert_clicks`
--
ALTER TABLE `advert_clicks`
  ADD CONSTRAINT `advert_clicks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
