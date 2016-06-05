CREATE DATABASE  IF NOT EXISTS `demmonitoramento_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `demmonitoramento_db`;
-- MySQL dump 10.13  Distrib 5.7.9, for linux-glibc2.5 (x86_64)
--
-- Host: 127.0.0.1    Database: demmonitoramento_db
-- ------------------------------------------------------
-- Server version	5.6.21

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
-- Table structure for table `tb_bus`
--

DROP TABLE IF EXISTS `tb_bus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_bus` (
  `Plate` int(11) NOT NULL,
  `nrBus` varchar(45) NOT NULL,
  `idFleet` int(11) NOT NULL,
  `idDevice` int(11) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`Plate`),
  UNIQUE KEY `Placa_UNIQUE` (`Plate`),
  KEY `fk_tb_bus_tb_fleet_idx` (`idFleet`),
  KEY `fk_tb_bus_tb_device_idx` (`idDevice`),
  KEY `fk_tb_bus_tb_user1_idx` (`idUser`),
  CONSTRAINT `fk_tb_bus_tb_device` FOREIGN KEY (`idDevice`) REFERENCES `tb_device` (`idDevice`) ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_bus_tb_fleet` FOREIGN KEY (`idFleet`) REFERENCES `tb_fleet` (`idFleet`) ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_bus_tb_user1` FOREIGN KEY (`idUser`) REFERENCES `tb_user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_bus`
--

LOCK TABLES `tb_bus` WRITE;
/*!40000 ALTER TABLE `tb_bus` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_bus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_device`
--

DROP TABLE IF EXISTS `tb_device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_device` (
  `idDevice` int(11) NOT NULL,
  `VersionSO` varchar(45) DEFAULT NULL,
  `Storage` double(5,2) DEFAULT NULL,
  `CPU` varchar(45) DEFAULT NULL,
  `Processor Make` double(2,2) DEFAULT NULL,
  `CPUCore` varchar(45) DEFAULT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idDevice`),
  KEY `fk_tb_device_tb_user1_idx` (`idUser`),
  CONSTRAINT `fk_tb_device_tb_user1` FOREIGN KEY (`idUser`) REFERENCES `tb_user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_device`
--

LOCK TABLES `tb_device` WRITE;
/*!40000 ALTER TABLE `tb_device` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_fleet`
--

DROP TABLE IF EXISTS `tb_fleet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_fleet` (
  `idFleet` int(11) NOT NULL AUTO_INCREMENT,
  `nmFleet` varchar(200) NOT NULL,
  `idRoute` int(11) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idFleet`),
  KEY `fk_tb_fleet_tb_route_idx` (`idRoute`),
  KEY `fk_tb_fleet_tb_user1_idx` (`idUser`),
  CONSTRAINT `fk_tb_fleet_tb_route` FOREIGN KEY (`idRoute`) REFERENCES `tb_route` (`idRoute`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_fleet_tb_user1` FOREIGN KEY (`idUser`) REFERENCES `tb_user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_fleet`
--

LOCK TABLES `tb_fleet` WRITE;
/*!40000 ALTER TABLE `tb_fleet` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_fleet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_historyDevice`
--

DROP TABLE IF EXISTS `tb_historyDevice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_historyDevice` (
  `idHistoryDevice` int(11) NOT NULL AUTO_INCREMENT,
  `Latitude` varchar(45) NOT NULL,
  `Longitude` varchar(45) NOT NULL,
  `dthrLocation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idDevice` int(11) NOT NULL,
  PRIMARY KEY (`idHistoryDevice`),
  KEY `fk_tb_historyDevice_tb_device_idx` (`idDevice`),
  CONSTRAINT `fk_tb_historyDevice_tb_device` FOREIGN KEY (`idDevice`) REFERENCES `tb_device` (`idDevice`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_historyDevice`
--

LOCK TABLES `tb_historyDevice` WRITE;
/*!40000 ALTER TABLE `tb_historyDevice` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_historyDevice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_route`
--

DROP TABLE IF EXISTS `tb_route`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_route` (
  `idRoute` int(11) NOT NULL AUTO_INCREMENT,
  `nmRoute` varchar(200) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idRoute`),
  KEY `fk_tb_route_tb_user1_idx` (`idUser`),
  CONSTRAINT `fk_tb_route_tb_user1` FOREIGN KEY (`idUser`) REFERENCES `tb_user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_route`
--

LOCK TABLES `tb_route` WRITE;
/*!40000 ALTER TABLE `tb_route` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_route` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_setting`
--

DROP TABLE IF EXISTS `tb_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_setting` (
  `DistanceMax` int(11) NOT NULL DEFAULT '50',
  `SpeedMax` int(11) NOT NULL DEFAULT '80',
  `Acuracy` int(11) NOT NULL DEFAULT '20'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_setting`
--

LOCK TABLES `tb_setting` WRITE;
/*!40000 ALTER TABLE `tb_setting` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_user`
--

DROP TABLE IF EXISTS `tb_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `nmUser` varchar(250) NOT NULL,
  `Login` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_user`
--

LOCK TABLES `tb_user` WRITE;
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` VALUES (1,'Danne Makleyston','admin','0keJhXT6lEe',1);
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_way`
--

DROP TABLE IF EXISTS `tb_way`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_way` (
  `idWay` int(11) NOT NULL AUTO_INCREMENT,
  `nmPlace` varchar(500) NOT NULL,
  `idRoute` int(11) NOT NULL,
  PRIMARY KEY (`idWay`),
  KEY `fk_tb_way_tb_route_idx` (`idRoute`),
  CONSTRAINT `fk_tb_way_tb_route` FOREIGN KEY (`idRoute`) REFERENCES `tb_route` (`idRoute`) ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_way`
--

LOCK TABLES `tb_way` WRITE;
/*!40000 ALTER TABLE `tb_way` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_way` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'demmonitoramento_db'
--

--
-- Dumping routines for database 'demmonitoramento_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-05 13:01:39
