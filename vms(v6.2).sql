-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2017 at 05:56 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vms`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

DROP TABLE IF EXISTS `auth_tokens`;
CREATE TABLE `auth_tokens` (
  `id` int(11) NOT NULL,
  `auth_key` varchar(41) NOT NULL,
  `user_id` int(11) NOT NULL,
  `creation_time` int(11) NOT NULL COMMENT 'Will stop working at 03:14:07 UTC on 19 January 2038 (On current MySQL version)',
  `expiry` int(11) NOT NULL,
  `last_access` int(11) NOT NULL COMMENT 'Will stop working at 03:14:07 UTC on 19 January 2038 (On current MySQL version)',
  `device_info` varchar(200) NOT NULL COMMENT 'Stores human-readable device information'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_tokens`
--

INSERT INTO `auth_tokens` (`id`, `auth_key`, `user_id`, `creation_time`, `expiry`, `last_access`, `device_info`) VALUES
(24, '7e1bb42a88891185e5a9d9e2fc03929dc6c74e7e', 1, 1501651067, 1504243067, 1502118512, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `creation_time` datetime NOT NULL,
  `remote_ip` varchar(45) NOT NULL,
  `access_level` int(2) NOT NULL DEFAULT '1' COMMENT 'Stores the access level of the user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Table to store user data';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `creation_time`, `remote_ip`, `access_level`) VALUES
(1, 'admin', '$2y$10$CwuNhiptwoCO41TSmvxIj.U461K.wKoCdwEH52c9lzkm8Vjz7NybW', '2017-06-20 12:32:00', '127.0.0.1', 1),
(3, 'nikhil', '$2y$10$NcQ/Eh1RA1Jb7tUfi2UqdO5pn2CEXHrtEnnYDfURIIoFusr3D9NWq', '2017-07-08 20:19:46', '::1', 0),
(4, 'admin1', '$2y$10$kGWvg0Q83ZE5Gq0B3NTMTupjEE3IP/vs/OdWUR4TiGobjG6.DAx7q', '2017-07-30 23:17:49', '115.249.53.74', 1);

-- --------------------------------------------------------

--
-- Table structure for table `visitees`
--

DROP TABLE IF EXISTS `visitees`;
CREATE TABLE `visitees` (
  `visitee_no` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visitees`
--

INSERT INTO `visitees` (`visitee_no`, `name`, `email`) VALUES
(1, 'John Reese', 'ramana.ranganatham@bennett.edu.in'),
(2, 'Harold Swift', 'nikhil.ramakrishnan@bennett.edu.in');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

DROP TABLE IF EXISTS `visitors`;
CREATE TABLE `visitors` (
  `visitor_no` int(11) NOT NULL,
  `visitor_id` varchar(41) NOT NULL,
  `card_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile` varchar(16) NOT NULL,
  `purpose` varchar(50) NOT NULL,
  `photo_ref` varchar(50) NOT NULL,
  `entry_time` datetime NOT NULL,
  `exit_time` datetime DEFAULT NULL,
  `in_campus` tinyint(1) DEFAULT '1',
  `added_by` int(11) NOT NULL,
  `visitee_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`visitor_no`, `visitor_id`, `card_no`, `name`, `mobile`, `purpose`, `photo_ref`, `entry_time`, `exit_time`, `in_campus`, `added_by`, `visitee_no`) VALUES
(2, 'ec2a335401e3d08e6ab5575aed394a971fe39d44', 42, 'Douglas Adams', '4242424242', '5', 'ec2a335401e3d08e6ab5575aed394a971fe39d44.jpeg', '2017-07-13 15:54:05', NULL, 1, 1, NULL),
(3, '6849b40a547970f8ddc993de5e3c8415bf0b5187', 1, 'John O\' Connor', '9191919191', '4', '6849b40a547970f8ddc993de5e3c8415bf0b5187.jpeg', '2017-07-13 15:54:31', NULL, 1, 1, NULL),
(4, 'e21da24fe98a9e8c9da99139476c5135a3f33c9a', 2, ' Jessie Jackson', '8181818181', '3', 'e21da24fe98a9e8c9da99139476c5135a3f33c9a.jpeg', '2017-07-13 15:55:06', NULL, 1, 1, NULL),
(5, 'ae3b614e3d85fceaf2704c45a1e9868009871963', 5, 'Judy Cortez', '+0122312132', '1', 'ae3b614e3d85fceaf2704c45a1e9868009871963.jpeg', '2017-07-13 15:56:07', NULL, 1, 1, NULL),
(6, '8be54ebb68cf8ab032948df15d22ccbce6a3eaa3', 7, ' April Bennett ', '983463531', '3', '8be54ebb68cf8ab032948df15d22ccbce6a3eaa3.jpg', '2017-07-13 15:56:42', NULL, 1, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitees`
--
ALTER TABLE `visitees`
  ADD PRIMARY KEY (`visitee_no`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`visitor_no`),
  ADD KEY `entry_time` (`entry_time`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `visitees`
--
ALTER TABLE `visitees`
  MODIFY `visitee_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `visitor_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
