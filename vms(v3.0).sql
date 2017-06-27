-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2017 at 12:36 PM
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

CREATE TABLE `visitors` (
  `visitor_no` int(11) NOT NULL,
  `card_no` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `purpose` varchar(50) NOT NULL,
  `photo_ref` varchar(32) NOT NULL,
  `in_campus` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`visitor_no`, `card_no`, `name`, `mobile`, `purpose`, `photo_ref`, `in_campus`) VALUES
(3, 12, 'mike', '944552832', '1', '2383594d563f1d802144136801.jpg', 1),
(4, 3, 'Jack', '9123654793', '1', '62509594d626813393897676135.jpg', 1),
(5, 12, 'Nik', '9123654793', '2', '26341594d653aecf5c401928411.jpg', 1),
(6, 21, 'Jill', '8743573845', '4', '54376594d706bed87f709245802.jpg', 1),
(7, 11, 'Atom', '9384940249', '2', '47325594d73a11aa34640848711.jpg', 1),
(8, 11, 'Atom', '9384940249', '2', '10679594d7455f0610695234416.jpg', 1),
(9, 13, 'Guy', '999834873', '3', '55167594d75f7a351a698190722.jpg', 1),
(10, 23, 'Kira', '9193473213', '5', '934075950b86ec6ae8044099239.jpg', 1),
(11, 123, 'Hello', '483927473', '2', '857859520aeb64e74979172011.png', 1),
(12, 123, 'Hello', '483927473', '2', '2089659520d29ba00a296809208.png', 1),
(13, 123, 'Hello', '483927473', '2', '1012159520d4417864834382451.png', 1),
(14, 1, 'A', '12345665', '2', '49768595211c976c59860455235.jpg', 1),
(15, 1, 'A', '12345665', '2', '34703595211f80b3a3687189582.jpg', 1),
(16, 1, 'A', '12345665', '2', '51395952126f64257248904851.jpg', 1),
(17, 41, 'Nk', '81827373', '3', '1670159522fc721788586784247.jpg', 1),
(18, 41, 'Nk', '81827373', '3', '959455952301c46d78093566619.jpg', 1),
(19, 41, 'Nk', '81827373', '3', '7399859523052e2fef233819580.jpg', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `visitor_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
