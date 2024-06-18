-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2024 at 11:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `concertphpdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `concertId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `selectedSeat` int(11) NOT NULL,
  `bookingTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `qrCodeUrl` varchar(255) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `concertName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `concerts`
--

CREATE TABLE `concerts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `concertName` varchar(255) NOT NULL,
  `seatsCapacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `concerts`
--

INSERT INTO `concerts` (`id`, `name`, `image`, `concertName`, `seatsCapacity`) VALUES
(1, 'Ed Sheeran Tour (30th March 2024)', 'https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p2/01/2023/11/03/F95m-ZSaQAAW8fT-3228084999.jpg', 'Ed Sheeran Tour', 10),
(2, 'Music of the Spheres World Tour (31st March 2024)', 'https://media.karousell.com/media/photos/products/2023/6/21/cold_play_malaysia_concert_202_1687310359_38d9eece_progressive.jpg', 'Music of the Spheres World Tour', 10),
(3, 'Tom Jones Ages & Stages Tour (10th June 2024)', 'https://images.lifestyleasia.com/wp-content/uploads/sites/5/2024/01/10170711/Snapinsta.app_401095539_17939237780745883_6301259909790717595_n_1080.jpg', 'Tom Jones Ages & Stages Tour', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'kong10', '$2y$10$agF0GHdGrkNms2SXzY0Ww.h5JX3o/96H6JczJCrNGQS/WgaglNJOa', 'kong@gmail.com', '2024-04-16 08:41:18'),
(3, 'Dharmaseelan10', '$2b$10$aPrQy4aKTlobsRHCSmTuNuW22QQA5SVw21Eaye/PLjwdaz8WB6awu', 'dseelan563@gmail.com', '2024-03-18 02:51:02'),
(8, 'Lee10', '$2y$10$hDo5CbzBGLx2n8x8efUqYupJMt4Ry5mwXtz8yMtQZrSEmFSHNZ5Xu', 'lee@gmail.com', '2024-04-16 08:34:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `concertId` (`concertId`),
  ADD KEY `fk_userId` (`userId`);

--
-- Indexes for table `concerts`
--
ALTER TABLE `concerts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=396;

--
-- AUTO_INCREMENT for table `concerts`
--
ALTER TABLE `concerts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`concertId`) REFERENCES `concerts` (`id`),
  ADD CONSTRAINT `fk_userId` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
