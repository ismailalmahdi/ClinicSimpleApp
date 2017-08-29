-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 24, 2017 at 11:15 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myDatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctor_users`
--

CREATE TABLE `doctor_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `hashed_password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_users`
--

INSERT INTO `doctor_users` (`id`, `first_name`, `last_name`, `username`, `hashed_password`) VALUES
(13, 'Darvisan', 'Rao', 'darvisan', '$2y$10$YjgzZDNmYjM2YWRjNGYxM.LCbAleSGWj73dmoQ0AJHkP.09MHCFb2'),
(26, 'Ismail', 'Al.Mahdi', 'Dr.Ismail', '$2y$10$MzU3MGQ2YTEyZTg1ZWUyNuchcz/tLtCiYdQM04dizWlWIUtktyjdG'),
(27, 'Yamunah', 'devi', 'DR.Yamunah', '$2y$10$NmMwOTI1NDhiNjYwNDNlNuWzbonVO.kvqzyfore6avsmkLYTB/5aC'),
(28, '<h1>ismail</h1>', 's', 's', '$2y$10$NzUzYTU3NDhhYThiOGVlM.T9V0KQpm7wllcSd4ZOrqxi3JaTbUHqS');

-- --------------------------------------------------------

--
-- Table structure for table `patient_users`
--

CREATE TABLE `patient_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_users`
--

INSERT INTO `patient_users` (`id`, `first_name`, `last_name`, `gender`) VALUES
(10, 'Dr.Thiaga ', 'raju', 1);

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `sugar_level` double NOT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `patient_id`, `sugar_level`, `note`) VALUES
(9, 0, 7, 'note is awesome'),
(10, 0, 15, 'testomg'),
(11, 0, 3, 'test'),
(12, 0, 12, 'test'),
(13, 0, 19, 'test'),
(16, 9, 7.5, 'notes'),
(17, 12, 9, 'testing here'),
(18, 9, 123, 'test'),
(20, 10, 3, 'waow'),
(21, 10, 3.5, 'yesssss '),
(22, 10, 10, 'a'),
(23, 10, 7.5, 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctor_users`
--
ALTER TABLE `doctor_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_users`
--
ALTER TABLE `patient_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctor_users`
--
ALTER TABLE `doctor_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `patient_users`
--
ALTER TABLE `patient_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
