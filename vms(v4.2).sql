-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2017 at 02:25 PM
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
(4, 'eb70437b3e9d948ffa173b9b8da30c9634d6819c', 1, 1498558073, 1501145494, 1498558073, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:55.0) Gecko/20100101 Firefox/55.0');

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
(1, 'admin', '$2y$10$CwuNhiptwoCO41TSmvxIj.U461K.wKoCdwEH52c9lzkm8Vjz7NybW', '2017-06-20 12:32:00', '127.0.0.1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

DROP TABLE IF EXISTS `visitors`;
CREATE TABLE `visitors` (
  `visitor_no` int(11) NOT NULL,
  `card_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile` varchar(16) NOT NULL,
  `purpose` varchar(50) NOT NULL,
  `photo_ref` varchar(32) NOT NULL,
  `entry_time` datetime NOT NULL,
  `exit_time` datetime DEFAULT NULL,
  `in_campus` tinyint(1) DEFAULT '1',
  `added_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`visitor_no`, `card_no`, `name`, `mobile`, `purpose`, `photo_ref`, `entry_time`, `exit_time`, `in_campus`, `added_by`) VALUES
(30, 9, 'admin', '98827277', '3', '35837595a01897b2a6905697554.jpg', '2017-07-03 14:04:17', NULL, 1, 1),
(46, 21, 'KewlGuy', '+01-321-223-1521', '5', '45383595b835656820458135802.jpg', '2017-07-04 17:30:22', NULL, 1, 1),
(47, 21, 'Normal Number Guy', '9821465324', '3', '68090595b83fd4e574003667501.jpg', '2017-07-04 17:33:09', NULL, 1, 1);

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
  ADD PRIMARY KEY (`visitor_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `visitor_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
