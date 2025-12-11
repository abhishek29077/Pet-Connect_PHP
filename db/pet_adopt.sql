-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 18, 2025 at 01:57 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pet_adopt`
--

-- --------------------------------------------------------

--
-- Table structure for table `adoptionrequests`
--

DROP TABLE IF EXISTS `adoptionrequests`;
CREATE TABLE IF NOT EXISTS `adoptionrequests` (
  `request_id` int NOT NULL AUTO_INCREMENT,
  `pet_id` int DEFAULT NULL,
  `adopter_id` int DEFAULT NULL COMMENT 'user Id',
  `request_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` text,
  `approved_by` int DEFAULT NULL,
  `approval_date` date DEFAULT NULL,
  PRIMARY KEY (`request_id`),
  KEY `pet_id` (`pet_id`),
  KEY `adopter_id` (`adopter_id`),
  KEY `approved_by` (`approved_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `adoptions`
--

DROP TABLE IF EXISTS `adoptions`;
CREATE TABLE IF NOT EXISTS `adoptions` (
  `adoption_id` int NOT NULL AUTO_INCREMENT,
  `pet_id` int DEFAULT NULL,
  `adopter_id` int DEFAULT NULL COMMENT 'user id',
  `adoption_date` date DEFAULT NULL,
  PRIMARY KEY (`adoption_id`),
  KEY `pet_id` (`pet_id`),
  KEY `adopter_id` (`adopter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `profile` varchar(100) NOT NULL DEFAULT 'images/acc logo white.png',
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL,
  `status` enum('unread','read') NOT NULL DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `profile`, `name`, `email`, `subject`, `message`, `status`, `created_at`) VALUES
(1, 'images/acc logo white.png', 'cod', 'hj@dks.cn', 'kjhk', 'jll', 'read', '2025-08-03 13:51:40'),
(2, 'images/acc logo white.png', 'Sud', 'sud1@kl.cm', 'jkiik', 'Hello\r\ni am groot', 'read', '2025-08-03 14:57:08'),
(3, 'images/acc logo white.png', 'djskj', 'jk@sbj.xn', 'Hello', 'Hello dog', 'read', '2025-08-05 09:47:31'),
(4, 'images/acc logo white.png', 'dhskd', 'js@gdsj.cn', 'hello', 'hello', 'unread', '2025-08-06 04:09:58');

-- --------------------------------------------------------

--
-- Table structure for table `medicalrecords`
--

DROP TABLE IF EXISTS `medicalrecords`;
CREATE TABLE IF NOT EXISTS `medicalrecords` (
  `record_id` int NOT NULL AUTO_INCREMENT,
  `pet_id` int DEFAULT NULL,
  `diagnosis` varchar(255) DEFAULT NULL,
  `treatment` text,
  `record_date` date DEFAULT NULL,
  PRIMARY KEY (`record_id`),
  KEY `pet_id` (`pet_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

DROP TABLE IF EXISTS `pets`;
CREATE TABLE IF NOT EXISTS `pets` (
  `pet_id` int NOT NULL AUTO_INCREMENT,
  `pet_type_id` int DEFAULT NULL,
  `owner_id` int DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `age` int DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `breed` varchar(100) DEFAULT NULL,
  `health_status` varchar(255) DEFAULT NULL,
  `description` text,
  `image_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `status` enum('available','adopted') NOT NULL DEFAULT 'available',
  PRIMARY KEY (`pet_id`),
  KEY `pet_type_id` (`pet_type_id`),
  KEY `owner_id` (`owner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pettypes`
--

DROP TABLE IF EXISTS `pettypes`;
CREATE TABLE IF NOT EXISTS `pettypes` (
  `pet_type_id` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(50) NOT NULL,
  PRIMARY KEY (`pet_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pettypes`
--

INSERT INTO `pettypes` (`pet_type_id`, `type_name`) VALUES
(1, 'Dog'),
(2, 'Cat'),
(3, 'Rabbit'),
(4, 'Bird');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `staff_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`staff_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `username`, `password`, `contact`) VALUES
(1, 'admin', 'admin123', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `profile` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'images/user/acc logo white.png',
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` enum('male','female','others') DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `profile`, `name`, `email`, `gender`, `phone`, `address`, `password`) VALUES
(1, 'images/user/acc logo white.png', 'sud san', 'we@hj.lcrtr', 'male', '1234567892', 'nlnds\r\ndfdf', '123456');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
