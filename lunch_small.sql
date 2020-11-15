-- MySQL dump 10.16  Distrib 10.1.37-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: lunch
-- ------------------------------------------------------
-- Server version	10.1.37-MariaDB

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
-- Table structure for table `lunch_order`
--

DROP TABLE IF EXISTS `lunch_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lunch_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `food` text NOT NULL,
  `person` text NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lunch_order`
--

LOCK TABLES `lunch_order` WRITE;
/*!40000 ALTER TABLE `lunch_order` DISABLE KEYS */;
INSERT INTO `lunch_order` VALUES (5,'2017-11-08','Pork Fried Rice (Mild) w/Eggroll','Clayton Felt',''),(6,'2017-11-08','Pineapple Chicken Rice - Eggroll','Jim Arp',''),(8,'2017-11-15','Crap on a stick','John Doe','stuff is good'),(11,'2017-11-15','MItch\'s Jack Lube in a bowl','Brent Bond','Mmm good'),(14,'2017-11-15','Chicken cooked in a savory sauce topped with delectable creamy crap ','Jim Arp',''),(16,'2017-11-09','Pork Fried Rice - Eggroll','Clayton Felt',''),(17,'2017-11-09','Shit on a Stick','Jim Arp','Best thing since sliced bread'),(18,'2018-08-29','Chicken fried rice MILD - Eggroll','Clayton',''),(19,'2018-08-29','Pineapple chicken fried rice','Jim',''),(20,'2018-09-06','Crap','Joe',''),(21,'2018-09-06','The Usual','Jim','crap'),(24,'2018-09-19','Chicken Fried Rice (Mild) w/Eggroll','Clayton',''),(25,'2018-11-14','Chicken Pad Thai Medium w/ egg roll','Ken',''),(26,'2018-11-14','Beef Brocolli w/egg roll','Clayton',''),(28,'2018-11-14','Spicey Chicken Fried Rice w/egg roll','Brent',''),(29,'2018-11-14','Pineapple Chicken Fried Rice (Hot) w egg roll','Jim',''),(30,'2019-02-27','Beef Brocoli, Eggroll','Clayton','');
/*!40000 ALTER TABLE `lunch_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `res` text NOT NULL,
  `times_chosen` int(11) DEFAULT NULL,
  `menu` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant`
--

LOCK TABLES `restaurant` WRITE;
/*!40000 ALTER TABLE `restaurant` DISABLE KEYS */;
/*!40000 ALTER TABLE `restaurant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant_record`
--

DROP TABLE IF EXISTS `restaurant_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurant_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `res_id` int(11) NOT NULL,
  `date_chosen` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant_record`
--

LOCK TABLES `restaurant_record` WRITE;
/*!40000 ALTER TABLE `restaurant_record` DISABLE KEYS */;
INSERT INTO `restaurant_record` VALUES (90,0,'2019-03-24');
/*!40000 ALTER TABLE `restaurant_record` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-26 19:46:57
