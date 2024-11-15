-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2024 at 04:29 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
-- /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
-- /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
-- /*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cars`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `image_url`) VALUES
(1, 'Tesla Model S', 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d2/2019_Tesla_Model_S_100D_--_02.jpg/1024px-2019_Tesla_Model_S_100D_--_02.jpg'),
(2, 'BMW M3', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/BMW_M3_F80_front_20180126.jpg/1024px-BMW_M3_F80_front_20180126.jpg'),
(3, 'Audi A4', 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3a/2021_Audi_A4_%28B9%29_front_1.5_TFSI.jpg/1024px-2021_Audi_A4_%28B9%29_front_1.5_TFSI.jpg'),
(4, 'Ford Mustang', 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d5/2021_Ford_Mustang_GT_5.0.jpg/1024px-2021_Ford_Mustang_GT_5.0.jpg'),
(5, 'Chevrolet Camaro', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/13/2020_Chevrolet_Camaro_2LT_3.6_Front.jpg/1024px-2020_Chevrolet_Camaro_2LT_3.6_Front.jpg'),
(6, 'Mercedes-Benz C-Class', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1e/2021_Mercedes-Benz_C-Class_W206_Sedan_front.jpg/1024px-2021_Mercedes-Benz_C-Class_W206_Sedan_front.jpg'),
(7, 'Toyota Corolla', 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/39/2020_Toyota_Corolla_SE_Sedan.jpg/1024px-2020_Toyota_Corolla_SE_Sedan.jpg'),
(8, 'Honda Civic', 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/36/2022_Honda_Civic_Sport_Hatchback.jpg/1024px-2022_Honda_Civic_Sport_Hatchback.jpg'),
(9, 'Porsche 911', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/43/2021_Porsche_911_Turbo_S_992_Front.jpg/1024px-2021_Porsche_911_Turbo_S_992_Front.jpg'),
(10, 'Lamborghini Huracán', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/45/2020_Lamborghini_Huracan_Evo_Front.jpg/1024px-2020_Lamborghini_Huracan_Evo_Front.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `car_id`) VALUES
(1, 3, 1),
(2, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `first_login` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `first_login`) VALUES
(1, 'qwerty', '$2y$10$laaTgEaHvdWdI.9NFQs7Ie73HyO1Tz03Vx.Smb36xFW4jUxPzOCry', '2024-11-11 10:57:55', 1),
(2, 'opop', '$2y$10$x8RaTSD1SI0OY7xwW0SG3OrlDljvtUZGzTRdn.z57yd/HEjExC6B2', '2024-11-11 10:58:41', 1),
(3, 'joshua', '$2y$10$ighNHAUpd9zL6iXpvHDNEeIqYDxUPx574xGjjbTswF03GOcxrtZaC', '2024-11-11 11:02:49', 1);

-- --------------------------------------------------------

-- Indexes for dumped tables

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

-- --------------------------------------------------------

-- AUTO_INCREMENT for dumped tables

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- --------------------------------------------------------

-- Constraints for dumped tables

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
