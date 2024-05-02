-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2024 at 07:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `survey_db`
--
CREATE DATABASE IF NOT EXISTS `survey_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `survey_db`;

-- --------------------------------------------------------

--
-- Table structure for table `personal_details`
--

DROP TABLE IF EXISTS `personal_details`;
CREATE TABLE IF NOT EXISTS `personal_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_details`
--

INSERT INTO `personal_details` (`id`, `full_name`, `email`, `dob`, `contact_number`) VALUES
(1, 'Njabulo Innocent Zondi', 'innocentzondi86@gmail.com', '2000-12-20', '0623574682');

-- --------------------------------------------------------

--
-- Table structure for table `survey_responses`
--

DROP TABLE IF EXISTS `survey_responses`;
CREATE TABLE IF NOT EXISTS `survey_responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `respondent_id` int(11) DEFAULT NULL,
  `favorite_food` varchar(255) NOT NULL,
  `other_food` varchar(255) DEFAULT NULL,
  `movies_rating` varchar(20) NOT NULL,
  `radio_rating` varchar(20) NOT NULL,
  `eat_out_rating` varchar(20) NOT NULL,
  `watch_tv_rating` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `respondent_id` (`respondent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey_responses`
--

INSERT INTO `survey_responses` (`id`, `respondent_id`, `favorite_food`, `other_food`, `movies_rating`, `radio_rating`, `eat_out_rating`, `watch_tv_rating`) VALUES
(1, 1, 'Pap and Wors', '', 'Strongly Agree', 'Strongly Disagree', 'Agree', 'Disagree');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `survey_responses`
--
ALTER TABLE `survey_responses`
  ADD CONSTRAINT `survey_responses_ibfk_1` FOREIGN KEY (`respondent_id`) REFERENCES `personal_details` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
