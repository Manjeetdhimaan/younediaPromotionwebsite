-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 14, 2021 at 05:53 AM
-- Server version: 5.6.51-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `condosandtown`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `account_status` text NOT NULL,
  `order_status` text NOT NULL,
  `order_details` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `account_status`, `order_status`, `order_details`) VALUES
(1, 'gchoi123x@gmail.com', '$2y$10$L.EulZz03C9DkywZs80.RuGxw0/iwScw3el.hik3dvb04Z0QlX1yi', '2021-08-04 06:26:25', 'active', 'uncomplete\r\n+\runcomplete\r\n+\runcomplete\r\n+\runcomplete\n+\nuncomplete', 'YouTube URL: sdfasdf\r\nWants: Likes and Comments\r\nGender: Female\r\nAge: 35 to 44\r\nLocation: Global\r\nVideo Category: Music\r\nKeywords: sdf\r\nBudget: 224\r\nViews: 11200\r\n+\r\nYouTube URL: sdfasdf\r\nWants: Likes and Comments\r\nGender: Female\r\nAge: 35 to 44\r\nLocation: Global\r\nVideo Category: Music\r\nKeywords: sdf\r\nBudget: 224\r\nViews: 11200\r\n+\r\nYouTube URL: sdfasdf\r\nWants: Likes and Comments\r\nGender: Female\r\nAge: 35 to 44\r\nLocation: Global\r\nVideo Category: Music\r\nKeywords: sdf\r\nBudget: 224\r\nViews: 11200\r\n+\r\nYouTube URL: sdfasdf\r\nWants: Likes and Comments\r\nGender: Female\r\nAge: 35 to 44\r\nLocation: Global\r\nVideo Category: Music\r\nKeywords: sdf\r\nBudget: 224\r\nViews: 11200\n+\nYouTube URL: f\nWants: Likes and Comments\nGender: Male\nAge: 13 to 24\nLocation: Global\nVideo Category: Film and Animation\nKeywords: d\nBudget: 2\nViews: 100');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
