-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 11, 2024 at 03:10 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contest`
--

-- --------------------------------------------------------

--
-- Table structure for table `contbl`
--

CREATE TABLE `contbl` (
  `id` int(2) NOT NULL,
  `firstName` varchar(55) NOT NULL,
  `lastName` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `conNum` bigint(15) NOT NULL,
  `streetAddress` varchar(55) NOT NULL,
  `city` varchar(55) NOT NULL,
  `province` varchar(55) NOT NULL,
  `zipCode` int(7) NOT NULL,
  `country` varchar(55) NOT NULL,
  `appLetter` varchar(255) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `valId` varchar(255) NOT NULL,
  `date` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contbl`
--

INSERT INTO `contbl` (`id`, `firstName`, `lastName`, `email`, `conNum`, `streetAddress`, `city`, `province`, `zipCode`, `country`, `appLetter`, `cv`, `picture`, `valId`, `date`, `status`) VALUES
(42, 'Eric', 'Jocson', 'jocsonjhoneric@gmail.com', 639887612234, 'Pigtas', 'ALIAGA', 'NUEVA ECIJA', 3111, 'UK', 'application/42_application_letter_JOCSON_RESUME12.pdf.png', 'resume/42_curriculum_vitae_JOCSON_RESUME12.pdf.png', 'image/42_picture_Jocson__Jhon_Eric-removebg-preview.png', 'validId/42_valid_id_257692272_459578682553209_1037505326951843829_n.png', '2024-04-10', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contbl`
--
ALTER TABLE `contbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contbl`
--
ALTER TABLE `contbl`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
