CREATE DATABASE  IF NOT EXISTS `hospitalUniminuto` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `hospitalUniminuto`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: hospitalUniminuto
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_registro_personal`
--

DROP TABLE IF EXISTS `tbl_registro_personal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_registro_personal` (
  `PKREG_NCODIGO` int NOT NULL AUTO_INCREMENT,
  `FKUSU_NCODIGO` int DEFAULT NULL,
  `REG_CINGRESO` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `REG_CSALIDA` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`PKREG_NCODIGO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_registro_personal`
--

LOCK TABLES `tbl_registro_personal` WRITE;
/*!40000 ALTER TABLE `tbl_registro_personal` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_registro_personal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_rusuarios`
--

DROP TABLE IF EXISTS `tbl_rusuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_rusuarios` (
  `PKUSU_NCODIGO` int NOT NULL AUTO_INCREMENT,
  `USU_CDOCUMENTO` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `USU_CNOMBRE` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `USU_CAPELLIDO` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `USU_CESPECIALIDAD` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `USU_CONTRASENA` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`PKUSU_NCODIGO`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_rusuarios`
--

LOCK TABLES `tbl_rusuarios` WRITE;
/*!40000 ALTER TABLE `tbl_rusuarios` DISABLE KEYS */;
INSERT INTO `tbl_rusuarios` VALUES (1,'123456','admin','admin','admin','d1RGMi2iu8zWn/YLNL/oZA==');
/*!40000 ALTER TABLE `tbl_rusuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'hospitalUniminuto'
--

--
-- Dumping routines for database 'hospitalUniminuto'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-27 22:16:47
