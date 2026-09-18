-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: smartbase
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permisos` (
  `ID_permisos` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre_permisos` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_permisos`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` VALUES (1,'Acceso Total / Administración'),(2,'Consulta / Acceso Básico');
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisos_roles`
--

DROP TABLE IF EXISTS `permisos_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permisos_roles` (
  `ROLES_ID_roles` int(11) NOT NULL,
  `PERMISOS_ID_permisos` int(11) NOT NULL,
  PRIMARY KEY (`ROLES_ID_roles`,`PERMISOS_ID_permisos`),
  KEY `fk_permisos_roles_permisos_idx` (`PERMISOS_ID_permisos`),
  CONSTRAINT `fk_permisos_roles_permisos` FOREIGN KEY (`PERMISOS_ID_permisos`) REFERENCES `permisos` (`ID_permisos`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_permisos_roles_roles` FOREIGN KEY (`ROLES_ID_roles`) REFERENCES `roles` (`ID_roles`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos_roles`
--

LOCK TABLES `permisos_roles` WRITE;
/*!40000 ALTER TABLE `permisos_roles` DISABLE KEYS */;
INSERT INTO `permisos_roles` VALUES (1,1),(1,2),(2,2);
/*!40000 ALTER TABLE `permisos_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `ID_roles` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo_rol` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_roles`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador'),(2,'Usuario');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `ID_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `curp` varchar(18) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Apellido_Paterno` varchar(100) DEFAULT NULL,
  `Apellido_Materno` varchar(100) DEFAULT NULL,
  `Correo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ROLES_ID_roles` int(11) NOT NULL,
  `PUESTO_ID_puesto` int(11) DEFAULT NULL,
  `area` varchar(150) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_usuario`),
  UNIQUE KEY `curp_UNIQUE` (`curp`),
  KEY `fk_usuarios_roles_idx` (`ROLES_ID_roles`),
  KEY `fk_usuarios_puesto_idx` (`PUESTO_ID_puesto`),
  CONSTRAINT `fk_usuarios_puesto` FOREIGN KEY (`PUESTO_ID_puesto`) REFERENCES `puesto` (`ID_puesto`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_usuarios_roles` FOREIGN KEY (`ROLES_ID_roles`) REFERENCES `roles` (`ID_roles`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'MOPA051011MMCRRNA4','Ana Damaris Moreno Pérez ',NULL,NULL,'damimoreno38@gmail.com','$2y$10$ZlnCBU9m5Tvd4K62UdIjb.RnoPprsLEEamk7.yhmSijE499VjCcVm',1,NULL,'servicio social/ digitalizacion','1788891143_d7eed44f817c936714e5.jpeg'),(2,'MOPA051011MMCRRNA1','Jonathan Medina',NULL,NULL,'jonathan07@gmail.com','$2y$10$0c.SuYx3cuiFBXUp16/nB.CHGSMrlOWhQUDVfKuKmME01FiVEnv9C',2,NULL,'NN',NULL),(3,'MOPA051011MMCRRNA6',NULL,NULL,NULL,'','$2y$10$.m3iiix0nJKcSC6LdswG2OWvzByJXkfxgNKC/3A4jGk4OPPGTji/a',1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'smartbase'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-17 12:13:31
