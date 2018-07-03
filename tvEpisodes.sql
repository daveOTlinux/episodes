-- MySQL dump 10.15  Distrib 10.0.34-MariaDB, for debian-linux-gnueabihf (armv7l)
--
-- Host: localhost    Database: mylists
-- ------------------------------------------------------
-- Server version	10.0.34-MariaDB-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tvEpisodes`
--

DROP TABLE IF EXISTS `tvEpisodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tvEpisodes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ShowName` char(40) NOT NULL,
  `NextEpisode` char(5) NOT NULL,
  `Season` char(5) NOT NULL,
  `ShowSource` char(30) NOT NULL,
  `ModifiedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `ShowName` (`ShowName`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COMMENT='List of next Season/Episode for watched TV shows';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tvEpisodes`
--

LOCK TABLES `tvEpisodes` WRITE;
/*!40000 ALTER TABLE `tvEpisodes` DISABLE KEYS */;
INSERT INTO `tvEpisodes` VALUES (1,'Lucifer','E19','s02','','2018-06-14 17:20:06'),(2,'Longmire','E01','S06','NetFlix','2018-06-14 17:21:23'),(3,'Dark Matter','E09','S03','NetFlix','2018-06-16 02:07:57'),(5,'iZombie','E01','S05','NetFlix','2018-07-02 16:56:48'),(6,'Jessica Jones','E11','S01','NetFlix','2018-06-16 19:22:10'),(7,'Lost in Space','E01','S02','NetFlix','2018-06-17 20:53:51'),(8,'Wynonna Earp','E13','S01','NetFlix','2018-07-01 22:32:07');
/*!40000 ALTER TABLE `tvEpisodes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-03 10:41:03
