-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: mysql4.gear.host    Database: vms
-- ------------------------------------------------------
-- Server version	5.7.17-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `auth_tokens`
--

DROP TABLE IF EXISTS `auth_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_key` varchar(41) NOT NULL,
  `user_id` int(11) NOT NULL,
  `creation_time` int(11) NOT NULL COMMENT 'Will stop working at 03:14:07 UTC on 19 January 2038 (On current MySQL version)',
  `expiry` int(11) NOT NULL,
  `last_access` int(11) NOT NULL COMMENT 'Will stop working at 03:14:07 UTC on 19 January 2038 (On current MySQL version)',
  `device_info` varchar(200) NOT NULL COMMENT 'Stores human-readable device information',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_tokens`
--

LOCK TABLES `auth_tokens` WRITE;
/*!40000 ALTER TABLE `auth_tokens` DISABLE KEYS */;
INSERT INTO `auth_tokens` VALUES (3,'7703894a910d71b0f9a5a5a8c44177f15b1210ee',1,1498552552,1501144552,1498552552,'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:55.0) Gecko/20100101 Firefox/55.0'),(23,'66f2ab48d28ed63c314d9a9c0cf48b3a03427c3e',1,1501570214,1504162214,1501570519,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36'),(24,'7e1bb42a88891185e5a9d9e2fc03929dc6c74e7e',1,1501651067,1504243067,1501759714,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36'),(29,'27fcbc4df76faaec3d44c42f9e5dc00cf5f04c7a',1,1501759235,1504351235,1501759579,'okhttp/2.4.0');
/*!40000 ALTER TABLE `auth_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `creation_time` datetime NOT NULL,
  `remote_ip` varchar(45) NOT NULL,
  `access_level` int(2) NOT NULL DEFAULT '1' COMMENT 'Stores the access level of the user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='Table to store user data';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$CwuNhiptwoCO41TSmvxIj.U461K.wKoCdwEH52c9lzkm8Vjz7NybW','2017-06-20 12:32:00','127.0.0.1',1),(3,'nikhil','$2y$10$NcQ/Eh1RA1Jb7tUfi2UqdO5pn2CEXHrtEnnYDfURIIoFusr3D9NWq','2017-07-08 20:19:46','::1',0),(4,'admin1','$2y$10$kGWvg0Q83ZE5Gq0B3NTMTupjEE3IP/vs/OdWUR4TiGobjG6.DAx7q','2017-07-30 23:17:49','115.249.53.74',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitees`
--

DROP TABLE IF EXISTS `visitees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitees` (
  `visitee_no` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`visitee_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitees`
--

LOCK TABLES `visitees` WRITE;
/*!40000 ALTER TABLE `visitees` DISABLE KEYS */;
/*!40000 ALTER TABLE `visitees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitors`
--

DROP TABLE IF EXISTS `visitors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitors` (
  `visitor_no` int(11) NOT NULL AUTO_INCREMENT,
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
  `visitee_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`visitor_no`),
  KEY `entry_time` (`entry_time`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitors`
--

LOCK TABLES `visitors` WRITE;
/*!40000 ALTER TABLE `visitors` DISABLE KEYS */;
INSERT INTO `visitors` VALUES (2,'ec2a335401e3d08e6ab5575aed394a971fe39d44',42,'Douglas Adams','4242424242','5','ec2a335401e3d08e6ab5575aed394a971fe39d44.jpeg','2017-07-13 15:54:05',NULL,1,1,NULL),(3,'6849b40a547970f8ddc993de5e3c8415bf0b5187',1,'John O\' Connor','9191919191','4','6849b40a547970f8ddc993de5e3c8415bf0b5187.jpeg','2017-07-13 15:54:31',NULL,1,1,NULL),(4,'e21da24fe98a9e8c9da99139476c5135a3f33c9a',2,' Jessie Jackson','8181818181','3','e21da24fe98a9e8c9da99139476c5135a3f33c9a.jpeg','2017-07-13 15:55:06',NULL,1,1,NULL),(5,'ae3b614e3d85fceaf2704c45a1e9868009871963',5,'Judy Cortez','+0122312132','1','ae3b614e3d85fceaf2704c45a1e9868009871963.jpeg','2017-07-13 15:56:07',NULL,1,1,NULL),(6,'8be54ebb68cf8ab032948df15d22ccbce6a3eaa3',7,' April Bennett ','983463531','3','8be54ebb68cf8ab032948df15d22ccbce6a3eaa3.jpg','2017-07-13 15:56:42',NULL,1,1,NULL),(7,'231fe155f6e95586c97caa42736c8c07dbed165c',1,'post','9877777777','2','231fe155f6e95586c97caa42736c8c07dbed165c.jpg','2017-07-13 23:09:36',NULL,1,1,NULL),(8,'6e74ced452e04ef0c5b58b9c3564e515ca8d802c',1,'post','9877777777','2','6e74ced452e04ef0c5b58b9c3564e515ca8d802c.jpg','2017-07-13 23:10:22',NULL,1,1,NULL),(9,'918d05ecfefecf7e5b84420d83a279d914cb1046',1,'post','9877777777','2','918d05ecfefecf7e5b84420d83a279d914cb1046.jpg','2017-07-13 23:10:33',NULL,1,1,NULL),(10,'42af1fdc2d576b2fb8e69880c449a85300535f79',21,'post req','5686565656','1','42af1fdc2d576b2fb8e69880c449a85300535f79.jpg','2017-07-13 23:16:34',NULL,1,1,NULL),(11,'553fe5a6ded54cea5455f0d5b715af9e1b697c66',23,'logs','8946464646','1','553fe5a6ded54cea5455f0d5b715af9e1b697c66.jpg','2017-07-13 23:30:34',NULL,1,1,NULL),(12,'5092bc35b0c7f3ea1b90117cc2e674d23c405956',55,'vic','349849384','2','5092bc35b0c7f3ea1b90117cc2e674d23c405956.jpg','2017-07-14 15:00:51',NULL,1,1,NULL),(13,'2b4b71029eb66fc6edb47582f4ab5c0ddf24f4e0',55,'vickkkkk','349849384','2','2b4b71029eb66fc6edb47582f4ab5c0ddf24f4e0.jpg','2017-07-14 15:16:40',NULL,1,1,NULL),(14,'a18e9772a23cb38025fb1d4e45c23219f62712b5',1,'added success','6541239870','2','a18e9772a23cb38025fb1d4e45c23219f62712b5.jpg','2017-07-14 15:19:35',NULL,1,1,NULL),(15,'fc54b293c402e47496d3106473151e37d2b84272',1,'vicky','9864513278','2','fc54b293c402e47496d3106473151e37d2b84272.jpg','2017-07-15 05:25:36',NULL,1,1,NULL),(16,'86a6f833d5de089c83023438b8d48e4e8e63494a',31,'keynotes','865656464','1','86a6f833d5de089c83023438b8d48e4e8e63494a.jpg','2017-07-15 05:27:41',NULL,1,1,NULL),(17,'dc401f7e37211a5bb80d6efb6a1f72af0c8958ea',2,'last check','86865686868','3','dc401f7e37211a5bb80d6efb6a1f72af0c8958ea.jpg','2017-07-15 05:28:58',NULL,1,1,NULL),(18,'6b8d6d8b96319e38c5b7b3d835b7f7ad1818b181',11,'ankit','565659797678','3','6b8d6d8b96319e38c5b7b3d835b7f7ad1818b181.jpg','2017-07-15 05:35:23',NULL,1,1,NULL),(19,'beb3294dbff21ae34b1b0cb0d018eeef0506d99a',5,'kir','865659898','1','beb3294dbff21ae34b1b0cb0d018eeef0506d99a.jpg','2017-07-15 05:38:41',NULL,1,1,NULL),(20,'c3b8dda419e313555273c2c3863d48773b65b093',4,'cbshd','865686868','1','c3b8dda419e313555273c2c3863d48773b65b093.jpg','2017-07-15 05:39:46',NULL,1,1,NULL),(21,'5c273afec774a7df4c3f982dc3c4663890e20f00',51,'cjdud','9862689464','2','5c273afec774a7df4c3f982dc3c4663890e20f00.jpg','2017-07-27 09:52:24',NULL,1,1,NULL),(22,'531b62d193268f3829a32c884eaa7fa02f13973e',42,'Veeki','9999999999','1','531b62d193268f3829a32c884eaa7fa02f13973e.jpg','2017-07-31 11:43:47',NULL,1,1,NULL),(23,'fadb36ca5244bd2a30dcc8ad8aab3eed0ec988f7',23,'川崎忍者','9987412345','2','fadb36ca5244bd2a30dcc8ad8aab3eed0ec988f7.jpg','2017-07-31 23:42:16',NULL,1,1,NULL),(24,'4ec88a246c2169364220f22f18b43d143eac4653',52,'cjfjc','9865321458','5','4ec88a246c2169364220f22f18b43d143eac4653.jpg','2017-08-01 21:57:40',NULL,1,1,NULL),(25,'1a68535b0a594f1d06e83d501bd561274ea76fd5',86,'dkkfkd','866868676766','5','1a68535b0a594f1d06e83d501bd561274ea76fd5.jpg','2017-08-01 22:15:46',NULL,1,1,NULL),(26,'fa16bb9a05115ee05de03e5ece44a60b6b8276c7',51,'vicky','98653761998','5','fa16bb9a05115ee05de03e5ece44a60b6b8276c7.jpg','2017-08-01 22:22:09',NULL,1,1,NULL),(27,'83300eb6225759bf086b2d5d62853a9901278961',56,'cncjxjc','8956468686','0','83300eb6225759bf086b2d5d62853a9901278961.jpg','2017-08-02 23:13:23',NULL,1,1,NULL),(28,'89588806ebba9dbea4cca9ebeecfd79713b84c09',31,'praveen','9865412743','0','89588806ebba9dbea4cca9ebeecfd79713b84c09.jpg','2017-08-02 23:14:37',NULL,1,1,NULL),(29,'e6e082d1ed6b2971db9108d7bc20632df8cb1b41',56,'nikki','98653761988','0','e6e082d1ed6b2971db9108d7bc20632df8cb1b41.jpg','2017-08-03 16:47:08',NULL,1,1,NULL),(30,'2c166fc9c83ab0913e10ddc0b5a27b9b9e60b044',56,'jcjdjc','565989899','0','2c166fc9c83ab0913e10ddc0b5a27b9b9e60b044.jpg','2017-08-03 16:55:31',NULL,1,1,NULL),(31,'245c5239533f305897bccdadca6129ace9f47dbe',568,'xhxhxjjc','86868949767','0','245c5239533f305897bccdadca6129ace9f47dbe.jpg','2017-08-03 16:56:20',NULL,1,1,NULL);
/*!40000 ALTER TABLE `visitors` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-08-03 23:57:40
