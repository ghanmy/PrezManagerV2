-- MySQL dump 10.13  Distrib 5.7.31, for Linux (x86_64)
--
-- Host: localhost    Database: prezmanager
-- ------------------------------------------------------
-- Server version	5.7.31

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (3),(4);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avion`
--

DROP TABLE IF EXISTS `avion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `capacite` int(11) NOT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avion`
--

LOCK TABLES `avion` WRITE;
/*!40000 ALTER TABLE `avion` DISABLE KEYS */;
INSERT INTO `avion` VALUES (2,225,'AirBus Pro110'),(3,250,'AirBus Pro112'),(4,180,'205'),(5,250,'AirBus Pro2100');
/*!40000 ALTER TABLE `avion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emprunt`
--

DROP TABLE IF EXISTS `emprunt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emprunt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `idmatriel` int(11) NOT NULL,
  `datep` date NOT NULL,
  `dater` date DEFAULT NULL,
  `duree` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emprunt`
--

LOCK TABLES `emprunt` WRITE;
/*!40000 ALTER TABLE `emprunt` DISABLE KEYS */;
INSERT INTO `emprunt` VALUES (7,1,1,'2014-05-10',NULL,30);
/*!40000 ALTER TABLE `emprunt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fos_user`
--

LOCK TABLES `fos_user` WRITE;
/*!40000 ALTER TABLE `fos_user` DISABLE KEYS */;
INSERT INTO `fos_user` VALUES (1,'admin','admin','admin@admin','admin@admin',1,'8cc9j5ahi3k08o40og0g8k4gogs084c','f4d0xeFzl/vnSLrawUc1z0fkz/msMblR0DAp5q1VQkpZFbHnRrH2JwgJEy5ms+ZgPDU9YhAVxsI9o8GJujZR6g==','2014-04-11 23:20:24',0,0,NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}',0,NULL);
/*!40000 ALTER TABLE `fos_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groupe_personnel`
--

DROP TABLE IF EXISTS `groupe_personnel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groupe_personnel` (
  `personnel_id` int(10) unsigned NOT NULL,
  `groupe_id` int(10) unsigned NOT NULL,
  KEY `groupe_personnel_personnel_id_foreign` (`personnel_id`),
  KEY `groupe_personnel_groupe_id_foreign` (`groupe_id`),
  CONSTRAINT `groupe_personnel_groupe_id_foreign` FOREIGN KEY (`groupe_id`) REFERENCES `groupes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `groupe_personnel_personnel_id_foreign` FOREIGN KEY (`personnel_id`) REFERENCES `personnels` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groupe_personnel`
--

LOCK TABLES `groupe_personnel` WRITE;
/*!40000 ALTER TABLE `groupe_personnel` DISABLE KEYS */;
INSERT INTO `groupe_personnel` VALUES (1,1),(2,1),(3,2),(3,1),(2,3),(1,3),(3,3);
/*!40000 ALTER TABLE `groupe_personnel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groupe_presentation`
--

DROP TABLE IF EXISTS `groupe_presentation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groupe_presentation` (
  `presentation_id` int(10) unsigned NOT NULL,
  `groupe_id` int(10) unsigned NOT NULL,
  KEY `groupe_presentation_presentation_id_foreign` (`presentation_id`),
  KEY `groupe_presentation_groupe_id_foreign` (`groupe_id`),
  CONSTRAINT `groupe_presentation_groupe_id_foreign` FOREIGN KEY (`groupe_id`) REFERENCES `groupes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `groupe_presentation_presentation_id_foreign` FOREIGN KEY (`presentation_id`) REFERENCES `presentations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groupe_presentation`
--

LOCK TABLES `groupe_presentation` WRITE;
/*!40000 ALTER TABLE `groupe_presentation` DISABLE KEYS */;
INSERT INTO `groupe_presentation` VALUES (15,1),(15,2),(16,1),(14,2);
/*!40000 ALTER TABLE `groupe_presentation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groupes`
--

DROP TABLE IF EXISTS `groupes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groupes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groupes`
--

LOCK TABLES `groupes` WRITE;
/*!40000 ALTER TABLE `groupes` DISABLE KEYS */;
INSERT INTO `groupes` VALUES (1,'Equipe1','Equipe responsable sur sur produit X','2015-05-08 12:04:17','2015-05-08 12:04:17'),(2,'Equipe2','Equipe xwewqewew wew wqewe','2015-05-08 16:16:02','2015-05-08 16:16:02'),(3,'Equipe3','djkföljaskldfjaskldfjaskldjaskldjsa','2015-06-04 10:10:38','2015-06-04 10:10:38');
/*!40000 ALTER TABLE `groupes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matriel`
--

DROP TABLE IF EXISTS `matriel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matriel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `photo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matriel`
--

LOCK TABLES `matriel` WRITE;
/*!40000 ALTER TABLE `matriel` DISABLE KEYS */;
INSERT INTO `matriel` VALUES (1,'Audi','img/audi.jpg'),(2,'Megane','img/megane.jpg');
/*!40000 ALTER TABLE `matriel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2015_03_06_155504_create_presentation_table',2),('2015_03_06_160726_create_presentations_table',3),('2015_03_08_141407_create_personnels_table',4),('2015_03_23_200328_create_personnel_presentation_table',5),('2015_04_08_154957_create_presentations_views_table',6),('2015_04_11_154047_create_view_delais_table',7),('2015_05_08_123424_create_groupes_table',8),('2015_05_08_132501_create_personnel_groupe_table',9),('2015_05_08_134830_create_groupe_personnel_table',10),('2015_05_08_1345030_create_groupe_personnel_table',11),('2015_05_08_142218_create_groupe_presentation_table',12),('2015_05_09_204607_create_questions_table',13);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passager`
--

DROP TABLE IF EXISTS `passager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passager` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateNaissance` date NOT NULL,
  `sexe` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passager`
--

LOCK TABLES `passager` WRITE;
/*!40000 ALTER TABLE `passager` DISABLE KEYS */;
INSERT INTO `passager` VALUES (5,'Test','Testtt','1990-01-01','M'),(6,'Salim','Salhi','1992-01-01','M');
/*!40000 ALTER TABLE `passager` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personnel`
--

DROP TABLE IF EXISTS `personnel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personnel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateNaissance` date NOT NULL,
  `sexe` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `poste` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personnel`
--

LOCK TABLES `personnel` WRITE;
/*!40000 ALTER TABLE `personnel` DISABLE KEYS */;
INSERT INTO `personnel` VALUES (1,'Marwen','Kheder','1994-01-01','M','Commandant du bord'),(2,'Ali','Zahouri','2010-09-07','M','Copilote'),(3,'Salwa','Allouli','1990-10-10','F','Hôtesse'),(4,'Sawsen','Kallou','1990-12-06','F','Hôtesse'),(5,'Salhi','Dous','1989-09-19','M','Commandant du bord');
/*!40000 ALTER TABLE `personnel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personnel_presentation`
--

DROP TABLE IF EXISTS `personnel_presentation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personnel_presentation` (
  `personnel_id` int(10) unsigned NOT NULL,
  `presentation_id` int(10) unsigned NOT NULL,
  KEY `personnel_presentation_personnel_id_foreign` (`personnel_id`),
  KEY `personnel_presentation_presentation_id_foreign` (`presentation_id`),
  CONSTRAINT `personnel_presentation_personnel_id_foreign` FOREIGN KEY (`personnel_id`) REFERENCES `personnels` (`id`) ON DELETE CASCADE,
  CONSTRAINT `personnel_presentation_presentation_id_foreign` FOREIGN KEY (`presentation_id`) REFERENCES `presentations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personnel_presentation`
--

LOCK TABLES `personnel_presentation` WRITE;
/*!40000 ALTER TABLE `personnel_presentation` DISABLE KEYS */;
INSERT INTO `personnel_presentation` VALUES (1,15),(2,15),(1,16),(1,18),(1,19),(3,14),(7,21),(8,14),(7,19),(7,14),(7,18),(2,14),(2,16),(8,18);
/*!40000 ALTER TABLE `personnel_presentation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personnel_vol`
--

DROP TABLE IF EXISTS `personnel_vol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personnel_vol` (
  `personnel_id` int(11) NOT NULL,
  `vol_id` int(11) NOT NULL,
  PRIMARY KEY (`personnel_id`,`vol_id`),
  KEY `IDX_42FB6A5B1C109075` (`personnel_id`),
  KEY `IDX_42FB6A5B9F2BFB7A` (`vol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personnel_vol`
--

LOCK TABLES `personnel_vol` WRITE;
/*!40000 ALTER TABLE `personnel_vol` DISABLE KEYS */;
/*!40000 ALTER TABLE `personnel_vol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personnels`
--

DROP TABLE IF EXISTS `personnels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personnels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `personnels_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personnels`
--

LOCK TABLES `personnels` WRITE;
/*!40000 ALTER TABLE `personnels` DISABLE KEYS */;
INSERT INTO `personnels` VALUES (1,'Déléguée A','Prénom A','DéléguéeA@test.com','098f6bcd4621d373cade4e832627b4f6','2015-03-08 15:49:47','2020-08-18 12:02:56'),(2,'test2','rttttrrte','test2@test.com','cc03e747a6afbbcbf8be7668acfebee5','2015-03-09 17:49:28','2020-09-09 17:02:00'),(3,'test3','prenim','test3@test.com','8ad8757baa8564dc136c1e07507f4a98','2015-05-08 16:15:45','2015-05-08 16:15:45'),(7,'Rahali','Dali','rahali.dali@gmail.com','cc03e747a6afbbcbf8be7668acfebee5','2020-08-18 11:20:37','2020-08-24 12:17:18'),(8,'Douki','Skander','s.douki@pixelstrade.com','ae82f701213e3b71372f502b6aa6718a','2020-08-18 11:58:06','2020-09-14 13:03:34');
/*!40000 ALTER TABLE `personnels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `presentations`
--

DROP TABLE IF EXISTS `presentations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `presentations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `version` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ZipURI` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ThumURI` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `presentations`
--

LOCK TABLES `presentations` WRITE;
/*!40000 ALTER TABLE `presentations` DISABLE KEYS */;
INSERT INTO `presentations` VALUES (14,'Test html',1,'Hqehqqeqwqwq','uploads/1427838808Archive.zip','uploads/1427838808Archive/thumb.jpg','2015-03-29 14:18:27','2015-03-31 20:53:28'),(15,'Test html2',0,'ewewew','uploads/1427738766Test html2Archive.zip','uploads/1427738766Test html2Archive/thumb.jpg','2015-03-30 17:06:06','2015-03-30 17:06:06'),(16,'Celiprol',1,'dwjlkqwjlkjelkwje','uploads/1432844942Archive.zip','uploads/1432844942Archive/thumb.jpg','2015-04-02 13:29:19','2015-05-28 19:29:02'),(18,'Doliprex',1,'Doliprex est préconisé dans les maux de tête et la congestion nasale. Il soulage les symptômes des processus catarrhaux et grippaux avec fièvre et douleur élevée ou modérée. Cette présentation est réservée à l\'adulte (à partir de 15 ans).','uploads/1430586220Archive 2.zip','uploads/1430586220Archive 2/thumb.jpg','2015-05-02 16:02:13','2015-05-02 16:03:40'),(19,'Demo1',0,'Demo Pour PFE','uploads/1432843834Demo1Archive.zip','uploads/1432843834Demo1Archive/thumb.jpg','2015-05-28 19:10:34','2015-05-28 19:10:34'),(20,'Prez 2017 testing marque blanche',0,'reprendre la le projet afin de le mettre en ligne sur azure et le commercialiser','uploads/1491476359Prez 2017 testing marque blanchePIXELSTRADE eADV WorldWide.pdf','','2017-04-06 08:59:19','2017-04-06 08:59:19'),(21,'test presentation',0,'test','uploads/1597757786test presentation1427838808Archive (1).zip','uploads/1597757786test presentation1427838808Archive (1)/thumb.jpg','2020-08-18 11:36:26','2020-08-18 11:36:26');
/*!40000 ALTER TABLE `presentations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `presentations_views`
--

DROP TABLE IF EXISTS `presentations_views`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `presentations_views` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `presentation_id` int(10) unsigned NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `presentations_views_presentation_id_foreign` (`presentation_id`),
  CONSTRAINT `presentations_views_presentation_id_foreign` FOREIGN KEY (`presentation_id`) REFERENCES `presentations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `presentations_views`
--

LOCK TABLES `presentations_views` WRITE;
/*!40000 ALTER TABLE `presentations_views` DISABLE KEYS */;
INSERT INTO `presentations_views` VALUES (1,15,'2015-04-08'),(2,15,'2015-04-08'),(3,15,'2015-04-09'),(4,15,'2015-04-09'),(5,15,'2015-04-09'),(6,15,'2015-04-11'),(7,15,'2015-04-12'),(8,15,'2015-04-12'),(9,14,'2015-04-09'),(10,16,'2015-04-09'),(11,16,'2015-04-09'),(12,14,'2015-04-12'),(17,16,'2015-04-21'),(19,16,'2015-04-22'),(20,15,'2015-04-22'),(21,16,'2015-04-22'),(22,16,'2015-04-22'),(23,16,'2015-04-22'),(24,16,'2015-04-22'),(25,16,'2015-04-22'),(26,16,'2015-04-22'),(27,16,'2015-04-22'),(28,16,'2015-04-22'),(29,16,'2015-04-22'),(30,16,'2015-04-22'),(31,16,'2015-04-22'),(32,16,'2015-04-22'),(33,16,'2015-04-22'),(34,14,'2015-04-22'),(35,14,'2015-04-22'),(36,14,'2015-04-22'),(37,16,'2015-04-23'),(38,15,'2015-04-23'),(39,16,'2015-04-23'),(40,16,'2015-04-23'),(41,16,'2015-04-23'),(42,16,'2015-04-28'),(43,16,'2015-04-28'),(44,14,'2015-04-28'),(45,14,'2015-04-28'),(46,16,'2015-04-28'),(47,16,'2015-04-28'),(48,16,'2015-04-28'),(49,16,'2015-04-28'),(50,16,'2015-04-28'),(51,16,'2015-04-28'),(52,16,'2015-04-28'),(53,16,'2015-04-28'),(54,16,'2015-04-28'),(56,16,'2015-04-28'),(57,16,'2015-04-28'),(58,16,'2015-04-30'),(59,16,'2015-04-30'),(60,18,'2015-05-02'),(61,18,'2015-05-05'),(62,18,'2015-05-05'),(63,16,'2015-05-05'),(64,16,'2015-05-10'),(65,18,'2015-05-10'),(66,18,'2015-05-10'),(67,15,'2015-05-10'),(68,15,'2015-05-10'),(69,15,'2015-05-10'),(70,15,'2015-05-10'),(71,18,'2015-05-28'),(72,16,'2015-05-28'),(73,15,'2015-05-28'),(74,14,'2015-05-28'),(75,16,'2015-05-28'),(76,15,'2015-05-28'),(77,19,'2015-05-28'),(78,19,'2015-05-28'),(79,19,'2015-05-28'),(80,16,'2015-05-28'),(81,14,'2015-05-29'),(82,18,'2015-05-29'),(83,18,'2015-05-29'),(84,18,'2015-05-29'),(85,16,'2015-05-29'),(86,18,'2015-08-27'),(87,18,'2015-08-27'),(88,18,'2015-08-27'),(89,19,'2015-09-01'),(90,16,'2015-09-01'),(91,15,'2015-09-01'),(92,19,'2015-09-03'),(93,16,'2015-09-03'),(94,19,'2015-09-03'),(95,18,'2015-09-03'),(96,19,'2015-09-03'),(97,19,'2015-09-03'),(98,18,'2015-09-03'),(99,15,'2020-09-10');
/*!40000 ALTER TABLE `presentations_views` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (4,'Structum 500','products/1603099938.png','produit test','2020-10-19 09:32:18','2020-10-19 09:32:18'),(5,'MOVEACTIVE 2020','products/1603996546.jpg','Description MOVEACTIVE 2020','2020-10-20 09:28:30','2020-10-29 18:35:46'),(7,'NICOPASS','products/1603994475.jpg','description de Nicopass','2020-10-26 11:40:12','2020-10-29 18:01:15'),(8,'AI service cognitif','products/1603881926.jpg','AI service cognitif','2020-10-28 10:45:26','2020-10-28 10:45:26'),(10,'COTE Magazine Genève','products/1604585775.png','Novembre 2020','2020-11-05 14:16:15','2020-11-05 14:16:15'),(11,'COTE Magazine Zurich','products/1604586196.png','Été 2020','2020-11-05 14:23:16','2020-11-05 14:23:16'),(12,'COTE Magazine Lugano','products/1604586247.png','Été 2020','2020-11-05 14:24:07','2020-11-05 14:24:07');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produitferme`
--

DROP TABLE IF EXISTS `produitferme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produitferme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `uri` varchar(250) NOT NULL,
  `prix` int(11) NOT NULL,
  `qnt` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produitferme`
--

LOCK TABLES `produitferme` WRITE;
/*!40000 ALTER TABLE `produitferme` DISABLE KEYS */;
INSERT INTO `produitferme` VALUES (1,'cocacola','src/resource/coca.jpg',700,14),(2,'Apla','src/resource/apla.jpg',300,6),(3,'Fanta','src/resource/fanta.jpg',700,9),(4,'orangina','src/resource/orangina.jpg',600,20),(5,'eau','src/resource/eau.jpg',300,20),(6,'7up','src/resource/7up.jpg',900,30),(7,'Boga','src/resource/boga.jpg',800,10),(8,'Pepsi','src/resource/pepsi.jpg',900,17),(9,'schweppes','src/resource/schweppes.jpg',900,36),(10,'sprite','src/resource/sprite.jpg',900,15);
/*!40000 ALTER TABLE `produitferme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produitouvert`
--

DROP TABLE IF EXISTS `produitouvert`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produitouvert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `uri` varchar(250) NOT NULL,
  `prix` int(11) NOT NULL,
  `qnt` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produitouvert`
--

LOCK TABLES `produitouvert` WRITE;
/*!40000 ALTER TABLE `produitouvert` DISABLE KEYS */;
INSERT INTO `produitouvert` VALUES (1,'lait','src/resource/lait.jpg',400,11),(2,'cafe','src/resource/cafe.png',300,7),(3,'citronade','src/resource/citronade.png',700,9),(4,'the','src/resource/the.jpg',600,20),(5,'Chocolat','src/resource/chocolat.jpg',300,20);
/*!40000 ALTER TABLE `produitouvert` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `response` text COLLATE utf8_unicode_ci NOT NULL,
  `repindex` int(11) NOT NULL,
  `presentation_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_presentation_id_foreign` (`presentation_id`),
  CONSTRAINT `questions_presentation_id_foreign` FOREIGN KEY (`presentation_id`) REFERENCES `presentations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,'Question babababababa','[\"Aaaaa\",\"Bbbbbb\",\"Cccccc\"]',1,15),(2,'Question babababababa','[\"Aaaaa\",\"Bbbbbb\",\"Cccccc\"]',2,15),(3,'Question babababababa','[\"Aaaaa\",\"Bbbbbb\",\"Cccccc\"]',2,15),(4,'Qui est balalaw ?','[\"Wigle Wilge\",\"Rep de rep\",\"GO out\"]',1,15),(5,'Qui est balalaw ?','[\"Wigle Wilge\",\"Rep de rep\",\"GO out\"]',2,15),(6,'Qui est balalaw ?','[\"Wigle Wilge\",\"Rep de rep\",\"GO out\"]',2,15),(7,'Qui est balalaw ?','[\"Wigle Wilge\",\"Rep de rep\",\"GO out\"]',0,15),(8,'Qui est balalaw ?','[\"Wigle Wilge\",\"Rep de rep\",\"GO out\"]',2,15),(9,'Qualité de produit ?','[\"Trés bien\",\"Bien\",\"Moyenne\",\"mal\"]',2,15),(10,'Qualité de produit ?','[\"Trés bien\",\"Bien\",\"Moyenne\",\"mal\"]',0,15),(11,'Qualité de produit ?','[\"Trés bien\",\"Bien\",\"Moyenne\",\"mal\"]',2,15),(12,'Qualité de produit ?','[\"Trés bien\",\"Bien\",\"Moyenne\",\"mal\"]',1,15);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `passager_id` int(11) DEFAULT NULL,
  `vol_id` int(11) DEFAULT NULL,
  `etat` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C454C68271A51189` (`passager_id`),
  KEY `IDX_C454C6829F2BFB7A` (`vol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` VALUES (1,5,5,'V'),(5,5,7,'A'),(6,5,2,'V'),(10,5,6,'V');
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `idcreator` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
/*!40000 ALTER TABLE `team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `teamid` int(11) NOT NULL,
  `socre` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,0,0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'test','test@test.com','$2y$10$wmyGzMIb/lB93sXOmd6rBufzugNr4bxPB7i2ssA81ouTMOi5Bp/HG','c4GI7AXq6e5LueJCmvRjIUkGTb0B7n7OPH805NKAjkSwDLVCCSZZLRn2z9SW','2015-03-06 15:27:27','2020-09-04 07:49:43');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateurs`
--

LOCK TABLES `utilisateurs` WRITE;
/*!40000 ALTER TABLE `utilisateurs` DISABLE KEYS */;
INSERT INTO `utilisateurs` VALUES (1,'kheder','Marwen','test@test'),(2,'Ali','Salhi','Test@test');
/*!40000 ALTER TABLE `utilisateurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `view_delais`
--

DROP TABLE IF EXISTS `view_delais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `view_delais` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `presentation_id` int(10) unsigned NOT NULL,
  `delai` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `view_delais_presentation_id_foreign` (`presentation_id`),
  CONSTRAINT `view_delais_presentation_id_foreign` FOREIGN KEY (`presentation_id`) REFERENCES `presentations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `view_delais`
--

LOCK TABLES `view_delais` WRITE;
/*!40000 ALTER TABLE `view_delais` DISABLE KEYS */;
INSERT INTO `view_delais` VALUES (1,15,'[5,2,3,4]'),(2,15,'[7,1,5,2]'),(3,15,'[5,3,7,4]'),(4,14,'[2,5,3,4]');
/*!40000 ALTER TABLE `view_delais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vol`
--

DROP TABLE IF EXISTS `vol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `destination` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Avion_id` int(11) DEFAULT NULL,
  `duree` int(11) NOT NULL,
  `heure` time NOT NULL,
  `etat` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3111D10B79CDDA17` (`Avion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vol`
--

LOCK TABLES `vol` WRITE;
/*!40000 ALTER TABLE `vol` DISABLE KEYS */;
INSERT INTO `vol` VALUES (2,'2014-10-06','United Kingdom',2,55,'10:23:00','C'),(4,'2014-04-16','Algeria',2,14,'12:15:00',''),(5,'2014-04-07','Japan',2,50,'13:30:00',''),(6,'2014-04-14','United States',4,20,'16:15:00',''),(7,'2014-04-15','Tunisia',2,2323,'18:00:00','');
/*!40000 ALTER TABLE `vol` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-24 10:48:16
