-- MySQL dump 10.13  Distrib 5.6.28, for Linux (x86_64)
--
-- Host: localhost    Database: gradebook
-- ------------------------------------------------------
-- Server version	5.6.28

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
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(15) DEFAULT NULL,
  `last_name` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `birth_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,'Omar','Mohamed','omar@omar.com','202cb962ac59075b964b07152d234b70','male','1991-11-18 22:00:00'),(2,'Khaled','Karam','khaled@karam.com','202cb962ac59075b964b07152d234b70','male','1993-01-01 22:00:00'),(3,'Mustafa','Ahmed','mostafa@ahmed.com','202cb962ac59075b964b07152d234b70','male','1991-01-01 22:00:00'),(4,'Ahmed','Gouda','ahmed@gouda.com','202cb962ac59075b964b07152d234b70','male','1993-10-01 22:00:00'),(5,'Hoda','Taha','hoda@taha.com','202cb962ac59075b964b07152d234b70','female','1989-12-31 22:00:00'),(6,'Nouran','Ahmed','nouran@ahmed.com','202cb962ac59075b964b07152d234b70','female','1992-01-01 22:00:00'),(7,'Omar','Mahoumd','omar@mahmoud.com','202cb962ac59075b964b07152d234b70','male','1992-11-18 22:00:00'),(8,'Omar','Ali','omar@ali.com','202cb962ac59075b964b07152d234b70','male','1993-10-10 22:00:00'),(9,'Ahmed','Hassan','ahmed@hassan.com','202cb962ac59075b964b07152d234b70','male','1990-09-30 21:00:00'),(10,'Ahmed','Mohamed','ahmed@mohamed.com','202cb962ac59075b964b07152d234b70','male','1988-09-09 21:00:00'),(11,'Ahmed','Hamed','ahmed@hamed.com','202cb962ac59075b964b07152d234b70','male','1989-08-07 21:00:00');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-11  0:52:03
