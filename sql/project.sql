-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: project
-- ------------------------------------------------------
-- Server version	8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `billing`
--

DROP TABLE IF EXISTS `billing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `billing` (
  `name` varchar(90) DEFAULT NULL,
  `add1` varchar(200) DEFAULT NULL,
  `add2` varchar(200) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `pincode` varchar(6) DEFAULT NULL,
  `bid` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billing`
--

LOCK TABLES `billing` WRITE;
/*!40000 ALTER TABLE `billing` DISABLE KEYS */;
/*!40000 ALTER TABLE `billing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `booking` (
  `bid` int NOT NULL AUTO_INCREMENT,
  `cid` int DEFAULT NULL,
  `reg_no` varchar(30) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `package` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`bid`),
  KEY `cid` (`cid`),
  KEY `reg_no` (`reg_no`),
  CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`reg_no`) REFERENCES `vehicle_list` (`Reg_no`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
INSERT INTO `booking` VALUES (1,1,'MH-01-**-16**','2023-04-05','2023-04-07','12:00:00','18:00:00',NULL),(22,1,'MH-02-**-23**','2023-04-12','2023-04-13','11:00:00','20:00:00','Peace Of Standard'),(23,1,'MH-02-**-23**','2023-04-12','2023-04-13','11:00:00','20:00:00','Peace Of Standard'),(24,1,'MH-02-**-23**','2023-04-12','2023-04-13','11:00:00','20:00:00','Peace Of Standard'),(25,1,'MH-02-**-23**','2023-04-12','2023-04-13','11:00:00','20:00:00','Standard'),(26,1,'MH-02-**-23**','2023-04-12','2023-04-13','11:00:00','20:00:00','Standard'),(27,1,'MH-02-**-23**','2023-04-12','2023-04-13','11:00:00','20:00:00','Standard'),(28,1,'MH-02-**-23**','2023-04-12','2023-04-13','11:00:00','20:00:00','Standard'),(29,1,'MH-02-**-23**','2023-04-12','2023-04-13','11:00:00','20:00:00','Standard'),(30,1,'MH-02-**-23**','2023-04-12','2023-04-13','11:00:00','20:00:00','Standard'),(31,1,'MH-02-**-23**','2023-04-12','2023-04-13','11:00:00','20:00:00','Standard'),(32,1,'MH-02-**-23**','2023-04-12','2023-04-13','11:00:00','20:00:00','Standard'),(33,1,'MH-02-**-23**','2023-04-12','2023-04-13','11:00:00','20:00:00','Standard'),(34,1,'MH-02-**-23**','2023-04-12','2023-04-13','11:00:00','20:00:00','Standard'),(35,1,'MH-02-**-23**','2023-04-12','2023-04-13','11:00:00','20:00:00','Standard'),(36,1,'MH-02-**-23**','2023-04-12','2023-04-13','11:00:00','20:00:00','Standard');
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `name` varchar(90) DEFAULT NULL,
  `email` varchar(90) DEFAULT NULL,
  `phone` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES ('Atharva Phadke','atharva@gmail.com',1234567890),('Atharva Phadke','atharva@gmail.com',1234567890),('anuj','abcd@123.com',1234),('anuj','abcd@123.com',1234),('Neeraj','Neeraj@gmail.com',987654321),('sgjh','hjGS@APLHA',987654321),('abcd','efgh@abcd.com',1234),('kalpesh','kalpesh@gmail',1234567890),('Narendra Modi','bharat@india',1234567890);
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cust_details`
--

DROP TABLE IF EXISTS `cust_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `cust_details` (
  `cid` int NOT NULL,
  `fname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `pan_no` varchar(10) DEFAULT NULL,
  `ad_no` bigint DEFAULT NULL,
  `dl_no` varchar(30) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`cid`),
  CONSTRAINT `cust_details_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cust_details`
--

LOCK TABLES `cust_details` WRITE;
/*!40000 ALTER TABLE `cust_details` DISABLE KEYS */;
INSERT INTO `cust_details` VALUES (1,'Atharva','Phadke','2023-04-05','AFZPP7190K',98765432112,'MH04 7634529473','Mumbai, Maharashtra');
/*!40000 ALTER TABLE `cust_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `more`
--

DROP TABLE IF EXISTS `more`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `more` (
  `location` varchar(20) DEFAULT NULL,
  `class` varchar(10) DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `starttime` time DEFAULT NULL,
  `endtime` time DEFAULT NULL,
  `duration` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `more`
--

LOCK TABLES `more` WRITE;
/*!40000 ALTER TABLE `more` DISABLE KEYS */;
INSERT INTO `more` VALUES ('mumbai','lmv','2023-04-13','2023-04-15','10:30:00','20:00:00',0),('mumbai','mcwg','2023-04-13','2023-04-13','12:00:00','20:00:00',0),('mumbai','lmv','2023-04-13','2023-04-14','12:00:00','18:00:00',0),('mumbai','mcwg','2023-04-12','2023-04-13','11:00:00','20:00:00',0),('mumbai','mcwg','2023-04-12','2023-04-13','11:00:00','20:00:00',0);
/*!40000 ALTER TABLE `more` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price`
--

DROP TABLE IF EXISTS `price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `price` (
  `bid` int DEFAULT NULL,
  `duration` int DEFAULT NULL,
  `subtotal` float DEFAULT NULL,
  `damage` int DEFAULT NULL,
  `tax` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price`
--

LOCK TABLES `price` WRITE;
/*!40000 ALTER TABLE `price` DISABLE KEYS */;
/*!40000 ALTER TABLE `price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipping`
--

DROP TABLE IF EXISTS `shipping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `shipping` (
  `name` varchar(90) DEFAULT NULL,
  `add1` varchar(200) DEFAULT NULL,
  `add2` varchar(200) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `pincode` varchar(6) DEFAULT NULL,
  `bid` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipping`
--

LOCK TABLES `shipping` WRITE;
/*!40000 ALTER TABLE `shipping` DISABLE KEYS */;
/*!40000 ALTER TABLE `shipping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `states` (
  `state` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES ('Karnataka','Bengaluru'),('Maharashtra','Mumbai'),('Delhi-NCR','Delhi-NCR'),('Rajasthan','Jaipur'),('Telangana','Hyderabad'),('Tamil Nadu','Chennai'),('Punjab','Amritsar'),('Gujrat','Ahemedabad'),('Rajasthan','Udaipur'),('West Bengal','Kolkata'),('Maharashtra','Pune');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `create_datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'atharva','123@abcd','e10adc3949ba59abbe56e057f20f883e','2023-03-16 12:49:12');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_details`
--

DROP TABLE IF EXISTS `vehicle_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_details` (
  `vname` varchar(30) NOT NULL,
  `vrange` int DEFAULT NULL,
  `class` varchar(10) DEFAULT NULL,
  `charge_time` float DEFAULT NULL,
  `fast_charge` float DEFAULT NULL,
  `acceleration` float DEFAULT NULL,
  `dimension` varchar(30) DEFAULT NULL,
  `brakes` varchar(30) DEFAULT NULL,
  `capacity` int DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`vname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_details`
--

LOCK TABLES `vehicle_details` WRITE;
/*!40000 ALTER TABLE `vehicle_details` DISABLE KEYS */;
INSERT INTO `vehicle_details` VALUES ('Ather 450x',146,'mcwg',4.7,30,NULL,'1800 x 700 x 1250','Disc:Disc',2,'images/450x.png'),('Bajaj Chetak',90,'mcwg',5,NULL,NULL,'1890 x 725 x 760','Disc:Drum',2,'images/chetak.png'),('BYD Atto 3',521,'lmv',9.5,60,7.3,'4455 x 1875 x 1615','Ventillated-Disc:Disc',5,'images/atto3.png'),('Hyundai Kona Electric',450,'lmv',6.1,57,7.9,'4180 x 1800 x 1570','Disc:Drum',5,'images/kona.png'),('Kia Ev6',708,'lmv',8,180,5.2,'4695 x 1890 x 1550','Disc:Drum',5,'images/kiaev6.png'),('Mahindra XUV 400',375,'lmv',13,50,8.3,'4200 x 1821 x 1634','Disc:Disc',5,'images/xuv.png'),('MG ZS EV',447,'lmv',19,40,8.2,'4314 x 1809 x 1644','Disc:Drum',5,'images/mg.png'),('Ola S1',90,'mcwg',4,25,NULL,'1859 x 712 x 1160','Disc:Disc',2,'images/s1.png'),('Ola S1 Pro',181,'mcwg',6.5,45,NULL,'1859 x 712 x 1160','Disc:Disc',2,'images/s1.png'),('Tata Nexon EV',312,'lmv',9,60,9.9,'3993 x 1811 x 1606','Disc:Drum',5,'images/nexon.png'),('Tata Tiago EV',250,'lmv',6.9,58,14.72,'3769 x 1677 x 1536','Disc:Drum',5,'images/tiago.png'),('Tata Tigor EV',315,'lmv',9.4,59,14.88,'3993 x 1677 x 1532','Disc:Drum',5,'images/tigor.png'),('TVS IQube',75,'mcwg',7,NULL,NULL,'1805 x 645 x 1140','Disc:Drum',2,'images/iqube.png');
/*!40000 ALTER TABLE `vehicle_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_list`
--

DROP TABLE IF EXISTS `vehicle_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_list` (
  `Reg_no` varchar(20) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `location` varchar(30) DEFAULT NULL,
  `year` varchar(20) DEFAULT NULL,
  `price` int DEFAULT NULL,
  PRIMARY KEY (`Reg_no`),
  KEY `name` (`name`),
  CONSTRAINT `vehicle_list_ibfk_1` FOREIGN KEY (`name`) REFERENCES `vehicle_details` (`vname`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_list`
--

LOCK TABLES `vehicle_list` WRITE;
/*!40000 ALTER TABLE `vehicle_list` DISABLE KEYS */;
INSERT INTO `vehicle_list` VALUES ('KA-01-**-01**','Tata Tiago EV','bengluru','Dec 2022',145),('KA-01-**-09**','Tata Tigor EV','bengluru','Dec 2022',210),('KA-01-**-10**','Tata Nexon EV','bengluru','June 2022',290),('KA-02-**-02**','Tata Tiago EV','bengluru','Jan 2023',150),('KA-03-**-08**','Tata Tigor EV','bengluru','March 2022',201),('KA-03-**-10**','Tata Nexon EV','bengluru','June 2022',290),('KA-04-**-03**','Tata Tiago EV','bengluru','Jan 2023',150),('KA-04-**-08**','Tata Tigor EV','bengluru','March 2022',201),('MH-01-**-10**','Tata Nexon EV','mumbai','June 2022',290),('MH-01-**-15**','Kia Ev6','mumbai','Jan 2023',850),('MH-01-**-16**','Kia Ev6','mumbai','Jan 2023',850),('MH-02-**-02**','Tata Tiago EV','mumbai','Jan 2023',150),('MH-02-**-05**','Tata Tiago EV','mumbai','Dec 2022',140),('MH-02-**-09**','Tata Tigor EV','mumbai','Dec 2022',210),('MH-02-**-11**','Tata Nexon EV','mumbai','Sep 2022',295),('MH-02-**-17**','Hyundai Kona Electric','mumbai','Sep 2019',260),('MH-02-**-21**','Ola S1 Pro','mumbai','Dec 2020',60),('MH-02-**-23**','Bajaj Chetak','mumbai','Jun 2020',35),('MH-03-**-07**','Tata Tigor EV','mumbai','Feb 2022',201),('MH-03-**-08**','Tata Tigor EV','mumbai','March 2022',201),('MH-03-**-18**','Hyundai Kona Electric','mumbai','March 2021',265),('MH-03-**-20**','Ola S1','mumbai','Feb 2022',52),('MH-03-**-22**','Ola S1 Pro','mumbai','Dec 2021',65),('MH-04-**-03**','Tata Tiago EV','mumbai','Jan 2023',150),('MH-04-**-06**','Tata Tigor EV','mumbai','Dec 2021',200),('MH-04-**-12**','Tata Nexon EV','mumbai','Sep 2022',295),('MH-04-**-19**','Ola S1','mumbai','Aug 2020',50),('MH-04-**-20**','Ola S1','mumbai','Dec 2020',50),('MH-43-**-14**','MG ZS EV','mumbai','Dec 2022',310),('MH-47-**-01**','Tata Tiago EV','mumbai','Dec 2022',145),('MH-47-**-04**','Tata Tiago EV','mumbai','Dec 2022',145),('MH-47-**-08**','Tata Tigor EV','mumbai','March 2022',201),('MH-47-**-13**','MG ZS EV','mumbai','march 2022',305),('MH-47-**-20**','Ola S1 Pro','mumbai','Dec 2020',60),('MH-47-**-23**','Bajaj Chetak','mumbai','Dec 2020',35);
/*!40000 ALTER TABLE `vehicle_list` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-11  2:54:30
