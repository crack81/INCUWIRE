CREATE DATABASE  IF NOT EXISTS `incuwire` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `incuwire`;
-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: incuwire
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

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
-- Table structure for table `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bitacora` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `volteo` smallint(6) DEFAULT NULL,
  `ventilador` tinyint(4) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `temperatura` float DEFAULT NULL,
  `humedad` float DEFAULT NULL,
  `posicionHuevo` varchar(45) DEFAULT NULL,
  `id_tipo_huevo` int(11) NOT NULL,
  `estado_ventilador` tinyint(4) DEFAULT NULL,
  `estado_puerta` tinyint(4) DEFAULT NULL,
  `dia_encubacion` tinyint(4) DEFAULT NULL,
  `numero_huevos` smallint(6) DEFAULT NULL,
  `id_encubadora_asignada` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_encubadora_asignada` (`id_encubadora_asignada`),
  KEY `id_tipo_huevo` (`id_tipo_huevo`),
  CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`id_encubadora_asignada`) REFERENCES `encubadora_asignada` (`id`),
  CONSTRAINT `bitacora_ibfk_2` FOREIGN KEY (`id_tipo_huevo`) REFERENCES `tipo_huevo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora`
--

LOCK TABLES `bitacora` WRITE;
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
/*!40000 ALTER TABLE `bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `encubadora`
--

DROP TABLE IF EXISTS `encubadora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `encubadora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modelo` varchar(45) NOT NULL,
  `precio` float NOT NULL,
  `id_tamano_encubadora` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `modelo` (`modelo`),
  KEY `id_tamano_encubadora` (`id_tamano_encubadora`),
  CONSTRAINT `encubadora_ibfk_1` FOREIGN KEY (`id_tamano_encubadora`) REFERENCES `tamano_encubadora` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `encubadora`
--

LOCK TABLES `encubadora` WRITE;
/*!40000 ALTER TABLE `encubadora` DISABLE KEYS */;
INSERT INTO `encubadora` VALUES (1,'incuwire1',1700,1,100,'encubadora modelo incuwire1 tamano mediano');
/*!40000 ALTER TABLE `encubadora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `encubadora_asignada`
--

DROP TABLE IF EXISTS `encubadora_asignada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `encubadora_asignada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idEncubadora` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_index` (`idEncubadora`,`idUsuario`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `encubadora_asignada_ibfk_1` FOREIGN KEY (`idEncubadora`) REFERENCES `encubadora` (`id`),
  CONSTRAINT `encubadora_asignada_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `encubadora_asignada`
--

LOCK TABLES `encubadora_asignada` WRITE;
/*!40000 ALTER TABLE `encubadora_asignada` DISABLE KEYS */;
INSERT INTO `encubadora_asignada` VALUES (1,1,1);
/*!40000 ALTER TABLE `encubadora_asignada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tamano_encubadora`
--

DROP TABLE IF EXISTS `tamano_encubadora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tamano_encubadora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tamano_encubadora`
--

LOCK TABLES `tamano_encubadora` WRITE;
/*!40000 ALTER TABLE `tamano_encubadora` DISABLE KEYS */;
INSERT INTO `tamano_encubadora` VALUES (1,'chica'),(3,'grande'),(2,'mediana');
/*!40000 ALTER TABLE `tamano_encubadora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_huevo`
--

DROP TABLE IF EXISTS `tipo_huevo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_huevo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_huevo`
--

LOCK TABLES `tipo_huevo` WRITE;
/*!40000 ALTER TABLE `tipo_huevo` DISABLE KEYS */;
INSERT INTO `tipo_huevo` VALUES (3,'avestruz'),(1,'gallina'),(2,'godorniz'),(4,'pato');
/*!40000 ALTER TABLE `tipo_huevo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(30) NOT NULL,
  `estatus` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'mamerto','crack81@gmail.com','password134',1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-08 20:15:36
