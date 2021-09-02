-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2021 at 05:11 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `intrebari`
--

CREATE TABLE `intrebari` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` char(10) NOT NULL,
  `Subject` varchar(100) NOT NULL,
  `Description` mediumtext NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `intrebari`
--

INSERT INTO `intrebari` (`id`, `name`, `username`, `email`, `mobile`, `Subject`, `Description`, `PostingDate`, `Status`) VALUES
(1, 'Ana', 'Ramon', 'AnaRamon@gmail.com', '0602312321', 'AES', 'safafasda', '2021-05-28 19:33:25', NULL),
(2, 'Jonel', 'Barbu', 'barbujonel@gmail.com', '0612690382', 'AES', 'a', '2021-05-28 19:33:33', NULL),
(3, 'Johnny', 'Bravo', 'johnny99@gmail.com', '0602312321', 'Vigenere', 'Cum sa criptez folosind algoritmul vigenere?', '2021-05-29 07:55:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id` int(11) NOT NULL COMMENT 'role_id',
  `role` varchar(255) DEFAULT NULL COMMENT 'role_text'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Editor'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(25) DEFAULT NULL,
  `roleid` tinyint(4) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `username`, `email`, `password`, `mobile`, `roleid`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'Ana', 'Ramon', 'AnaRamon@gmail.com', '577057011662f04fcee7fe642165173dc76f613c', '0612690382', 3, 0, '2021-05-27 19:08:17', '2021-05-27 19:08:17'),
(2, 'Jonel', 'Barbu', 'barbujonel@gmail.com', '577057011662f04fcee7fe642165173dc76f613c', '0612690387', 1, 0, '2021-05-27 13:22:06', '2021-05-27 13:22:06'),
(3, 'Johnny', 'Bravo', 'johnny99@gmail.com', '577057011662f04fcee7fe642165173dc76f613c', '060231232131', 2, 0, '2021-05-27 13:28:24', '2021-05-27 13:28:24'),
(4, 'Maria', 'Adamescu', 'Maria@gmail.com', '6d748db0b934a15c02061a41478d3807196076e9', '0726123678', 3, 0, '2021-05-28 20:06:11', '2021-05-28 20:06:11'),
(33, 'Armin', 'Osvath', 'armin.osvath99@e-uvt.ro', '1d96e4206bea782ac246c56f5a96ff8a1c6a06cf', '0682690382', 1, 0, '2021-05-29 10:25:49', '2021-05-29 10:25:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `intrebari`
--
ALTER TABLE `intrebari`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`,`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`,`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `intrebari`
--
ALTER TABLE `intrebari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'role_id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
