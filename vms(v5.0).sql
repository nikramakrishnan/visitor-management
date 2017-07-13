-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2017 at 12:30 PM
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
(3, '7703894a910d71b0f9a5a5a8c44177f15b1210ee', 1, 1498552552, 1501144552, 1498552552, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:55.0) Gecko/20100101 Firefox/55.0'),
(4, 'eb70437b3e9d948ffa173b9b8da30c9634d6819c', 1, 1498558073, 1501145494, 1499941601, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:55.0) Gecko/20100101 Firefox/55.0');

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
(2, 'siddharth', '$2y$10$A68J90ytXl/C3.Tk72p44eBhyUyL4pPHPL3hkcnKyBvfybBcrAoXi', '2017-07-08 20:09:19', '::1', 0),
(3, 'nikhil', '$2y$10$NcQ/Eh1RA1Jb7tUfi2UqdO5pn2CEXHrtEnnYDfURIIoFusr3D9NWq', '2017-07-08 20:19:46', '::1', 0);

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
  `added_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`visitor_no`, `visitor_id`, `card_no`, `name`, `mobile`, `purpose`, `photo_ref`, `entry_time`, `exit_time`, `in_campus`, `added_by`) VALUES
(2, 'ec2a335401e3d08e6ab5575aed394a971fe39d44', 42, 'Douglas Adams', '4242424242', '5', 'ec2a335401e3d08e6ab5575aed394a971fe39d44.jpeg', '2017-07-13 15:54:05', NULL, 1, 1),
(3, '6849b40a547970f8ddc993de5e3c8415bf0b5187', 1, 'John O\' Connor', '9191919191', '4', '6849b40a547970f8ddc993de5e3c8415bf0b5187.jpeg', '2017-07-13 15:54:31', NULL, 1, 1),
(4, 'e21da24fe98a9e8c9da99139476c5135a3f33c9a', 2, ' Jessie Jackson', '8181818181', '3', 'e21da24fe98a9e8c9da99139476c5135a3f33c9a.jpeg', '2017-07-13 15:55:06', NULL, 1, 1),
(5, 'ae3b614e3d85fceaf2704c45a1e9868009871963', 5, 'Judy Cortez', '+0122312132', '1', 'ae3b614e3d85fceaf2704c45a1e9868009871963.jpeg', '2017-07-13 15:56:07', NULL, 1, 1),
(6, '8be54ebb68cf8ab032948df15d22ccbce6a3eaa3', 7, ' April Bennett ', '983463531', '3', '8be54ebb68cf8ab032948df15d22ccbce6a3eaa3.jpg', '2017-07-13 15:56:42', NULL, 1, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `visitor_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
