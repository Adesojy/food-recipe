-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 21, 2024 at 08:12 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kwam`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(255) NOT NULL,
  `category` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `created_at`) VALUES
(1, 'Breakfast', '2024-02-21 16:13:28'),
(2, 'Lunch', '2024-02-21 16:13:28'),
(3, 'Dinner', '2024-02-21 16:13:28'),
(4, 'Dessert', '2024-02-21 16:13:28'),
(5, 'Snack', '2024-02-21 16:13:28');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipe_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `instruction` text NOT NULL,
  `recipe_file` varchar(255) NOT NULL,
  `recipe_image` varchar(255) NOT NULL,
  `recipe_thumbnail` varchar(255) NOT NULL,
  `category` varchar(256) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  `popularity` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipe_id`, `title`, `description`, `instruction`, `recipe_file`, `recipe_image`, `recipe_thumbnail`, `category`, `location`, `created_at`, `user_id`, `popularity`) VALUES
(1, 'Jollof Rice', 'Nigerian Jollof Rice', '1. oojhjicjsjcoscj\r\n2. jojcihuhsuchsihci\r\n3. hkbkdushfiodufo\r\n4. hsifidfujjwouwui', 'dezjoi.jpg', 'dezjoi.jpg', 'dezjoi.jpg', 'Breakfast', 'Lagos State, Nigeria', '2024-02-15 13:58:56', 2, 0),
(2, 'Fried Rice', 'Nigerian Fried Rice', 'sdjhkdfkdlfdlfd\r\ndfgvsdgsdvg\r\nvzdvsdvdvs\r\nvdvsdvsvs', 'smartweb-Screenshot 2024-01-13 072240.png', 'smartweb-Screenshot 2024-01-13 072240.png', 'smartweb-Screenshot 2024-01-13 072240.png', 'Lunch', 'Lagos State, Nigeria', '2024-02-15 14:16:43', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','recipe_seeker','cook') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `email`, `role`) VALUES
(1, 'test', '$2y$10$XUnpygf.4uo.fG8BjJPwI.FNXjFHZQMwH1BTApGlJrT9k.Qe5oQwO', 'Yetunde', 'Berbard', 'test@test.com', 'recipe_seeker'),
(2, 'adesuwa', '$2y$10$hOnalue5hmFmmJWPshCG0uMleXzK2fg4.SYUdN5fD./utGN95/K8m', 'Favour', 'Akintunde', 'adesuwa@gmail.com', 'cook'),
(3, 'webczar', '$2y$10$ee23FlO38mdgLLIQKfExHOa8sdJsrcwD99puIDo99JWv.YBHOSlYG', 'Ayomide', 'Olagbemi', 'bolagbemi@gmail.com', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
