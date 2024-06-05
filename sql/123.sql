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
