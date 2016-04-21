CREATE DATABASE  IF NOT EXISTS `konferenz` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `konferenz`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: konferenz
-- ------------------------------------------------------
-- Server version	5.7.10-log

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
-- Table structure for table `benutzer`
--

DROP TABLE IF EXISTS `benutzer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `benutzer` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_login` varchar(45) DEFAULT NULL,
  `b_passwort` varchar(45) DEFAULT NULL,
  `b_level` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`b_id`),
  UNIQUE KEY `login_UNIQUE` (`b_login`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `benutzer`
--

LOCK TABLES `benutzer` WRITE;
/*!40000 ALTER TABLE `benutzer` DISABLE KEYS */;
INSERT INTO `benutzer` VALUES (1,'susi','1234','teilnehmer'),(2,'hansi','1234','teilnehmer'),(3,'admin','1234','admin'),(4,'hertha','1234','vortragender'),(5,'siegmund','1234','vortragender'),(6,'karli','1234','teilnehmer'),(7,'trudl','1234','teilnehmer');
/*!40000 ALTER TABLE `benutzer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teilnehmer`
--

DROP TABLE IF EXISTS `teilnehmer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teilnehmer` (
  `tn_id` int(11) NOT NULL AUTO_INCREMENT,
  `tn_name` varchar(45) DEFAULT NULL,
  `tn_vorname` varchar(20) NOT NULL,
  `tn_email` varchar(45) DEFAULT NULL,
  `tn_b_id` int(11) NOT NULL,
  PRIMARY KEY (`tn_id`,`tn_b_id`),
  KEY `fk_t_teilnehmer_t_benutzer_idx` (`tn_b_id`),
  CONSTRAINT `fk_t_teilnehmer_t_benutzer` FOREIGN KEY (`tn_b_id`) REFERENCES `benutzer` (`b_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teilnehmer`
--

LOCK TABLES `teilnehmer` WRITE;
/*!40000 ALTER TABLE `teilnehmer` DISABLE KEYS */;
INSERT INTO `teilnehmer` VALUES (1,'Meier','Susi','susi@gmx.at',1),(2,'Schmidt','Hansi','hansi@gmx.at',2),(3,'Hausfeld','Karli','karli@gmx.at',6),(4,'Strudl','Trudl','trudl@gmx.at',7);
/*!40000 ALTER TABLE `teilnehmer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tn_va`
--

DROP TABLE IF EXISTS `tn_va`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tn_va` (
  `tn_id` int(11) NOT NULL,
  `va_id` int(11) NOT NULL,
  PRIMARY KEY (`tn_id`,`va_id`),
  KEY `fk_t_teilnehmer_has_t_veranstaltungen_t_teilnehmer1_idx` (`tn_id`),
  KEY `fk_va_id_idx` (`va_id`),
  CONSTRAINT `fk_tn_id` FOREIGN KEY (`tn_id`) REFERENCES `teilnehmer` (`tn_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_va_id` FOREIGN KEY (`va_id`) REFERENCES `veranstaltungen` (`va_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tn_va`
--

LOCK TABLES `tn_va` WRITE;
/*!40000 ALTER TABLE `tn_va` DISABLE KEYS */;
INSERT INTO `tn_va` VALUES (1,10),(2,9),(2,12),(3,9),(3,11),(4,9),(4,13);
/*!40000 ALTER TABLE `tn_va` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veranstaltungen`
--

DROP TABLE IF EXISTS `veranstaltungen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `veranstaltungen` (
  `va_id` int(11) NOT NULL AUTO_INCREMENT,
  `va_titel` varchar(45) DEFAULT NULL,
  `va_datum` datetime DEFAULT NULL,
  `va_typ` varchar(45) DEFAULT NULL,
  `va_pdf` varchar(150) DEFAULT NULL,
  `va_vt_id` int(11) NOT NULL,
  PRIMARY KEY (`va_id`,`va_vt_id`),
  KEY `fk_t_veranstaltungen_t_vortragender1_idx` (`va_vt_id`),
  CONSTRAINT `fk_va_vt_id` FOREIGN KEY (`va_vt_id`) REFERENCES `vortragender` (`vt_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veranstaltungen`
--

LOCK TABLES `veranstaltungen` WRITE;
/*!40000 ALTER TABLE `veranstaltungen` DISABLE KEYS */;
INSERT INTO `veranstaltungen` VALUES (9,'Pro-Schoko-Kurs','2016-04-20 10:30:00','Kulinarik','Pro-Schoko-Kurs.pdf',1),(10,'Sei kein Hosentraeger','2016-04-18 09:45:00','Therapie','Sei-kein-Hosentraeger.pdf',2),(11,'Keine Angst vorm schwarzen Mann','2016-04-28 10:00:00','Therapie','Keine-Angst-vorm-schwarzen-Mann.pdf',2),(12,'Narrische Schwammerl','2016-04-25 14:30:00','Kulinarik','Narrische-Schwammerl.pdf',1),(13,'Mag dich dein Toaster','2016-04-26 10:00:00','Therapie','Mag-dich-dein-Toaster.pdf',2);
/*!40000 ALTER TABLE `veranstaltungen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vortragender`
--

DROP TABLE IF EXISTS `vortragender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vortragender` (
  `vt_id` int(11) NOT NULL AUTO_INCREMENT,
  `vt_name` varchar(45) DEFAULT NULL,
  `vt_vorname` varchar(20) NOT NULL,
  `vt_adresse` varchar(45) DEFAULT NULL,
  `vt_telefon` int(20) DEFAULT NULL,
  `vt_email` varchar(45) DEFAULT NULL,
  `vt_b_id` int(11) NOT NULL,
  PRIMARY KEY (`vt_id`,`vt_b_id`),
  KEY `fk_t_vortragender_t_benutzer1_idx` (`vt_b_id`),
  CONSTRAINT `fk_va_b_id` FOREIGN KEY (`vt_b_id`) REFERENCES `benutzer` (`b_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vortragender`
--

LOCK TABLES `vortragender` WRITE;
/*!40000 ALTER TABLE `vortragender` DISABLE KEYS */;
INSERT INTO `vortragender` VALUES (1,'Salat','Hertha','graz',1234567,'hertha@gmx.at',4),(2,'Freud','Siegmund','graz',1236589,'sigi@gmx.at',5);
/*!40000 ALTER TABLE `vortragender` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-21 11:56:05
