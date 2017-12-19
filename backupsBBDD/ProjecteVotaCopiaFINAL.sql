-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: ProjecteVotaCopia
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.16.04.1

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
-- Table structure for table `consulta`
--

DROP TABLE IF EXISTS `consulta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consulta` (
  `id_consulta` int(4) NOT NULL AUTO_INCREMENT,
  `pregunta` text NOT NULL,
  `id_usuario` int(4) NOT NULL,
  PRIMARY KEY (`id_consulta`),
  KEY `id_consulta` (`id_consulta`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `consulta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consulta`
--

LOCK TABLES `consulta` WRITE;
/*!40000 ALTER TABLE `consulta` DISABLE KEYS */;
INSERT INTO `consulta` VALUES (1,'Chocolate negro o blanco?',1),(2,'Gimnasio o Workout?',1),(3,'Cocacola o fanta?',1);
/*!40000 ALTER TABLE `consulta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invitaciones`
--

DROP TABLE IF EXISTS `invitaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invitaciones` (
  `id_usuario` int(11) NOT NULL,
  `id_consulta` int(11) NOT NULL,
  `votado` int(1) DEFAULT '0',
  KEY `id_usuario` (`id_usuario`),
  KEY `id_consulta` (`id_consulta`),
  KEY `id_usuario_2` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invitaciones`
--

LOCK TABLES `invitaciones` WRITE;
/*!40000 ALTER TABLE `invitaciones` DISABLE KEYS */;
INSERT INTO `invitaciones` VALUES (1,2,0),(2,2,0),(8,1,0),(36,3,1),(34,1,1),(34,2,1),(34,3,1);
/*!40000 ALTER TABLE `invitaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opciones`
--

DROP TABLE IF EXISTS `opciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opciones` (
  `id_opciones` int(4) NOT NULL AUTO_INCREMENT,
  `descripcionOpciones` varchar(30) NOT NULL,
  `id_consulta` int(4) NOT NULL,
  PRIMARY KEY (`id_opciones`),
  KEY `id_opciones` (`id_opciones`),
  KEY `id_consulta` (`id_consulta`),
  CONSTRAINT `opciones_ibfk_1` FOREIGN KEY (`id_consulta`) REFERENCES `consulta` (`id_consulta`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opciones`
--

LOCK TABLES `opciones` WRITE;
/*!40000 ALTER TABLE `opciones` DISABLE KEYS */;
INSERT INTO `opciones` VALUES (1,'Negro',1),(2,'Blanco',1),(3,'Gimnasio',2),(4,'Workout',2),(5,'fanta',3),(6,'cocacola',3);
/*!40000 ALTER TABLE `opciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) DEFAULT NULL,
  `apellido` varchar(20) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `Admin` tinyint(1) NOT NULL,
  `token` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'admin','','8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918','admin@gmail.com',1,''),(2,'alumne','','3dfe56c8d9ec06273119fbbb5c3e095a15524a125d130ca950b942712ef1dacd','alumne@gmail.com',0,''),(8,'Alejandro','Novoa','03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4','alejandrooo96@gmail.com',0,''),(21,NULL,NULL,'52lwf6cb7xaursgdco63n39az05y581hpj4t3kqfcaem021vi','gtorresdonaire@iesesteveterradas.cat',0,'52lwf6cb7xaursgdco63n39az05y581hpj4t3kqfcaem021vi'),(34,'Genis','Torres','cd77c0726c195e75521002efc28beef03769ffbc1b83d5bbf22a390cadf087a7','genistorres97@gmail.com',0,''),(36,'Juan Antonio','Torres','03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4','torresdiesel65@gmail.com',0,'');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votos`
--

DROP TABLE IF EXISTS `votos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votos` (
  `id_voto` int(4) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(4) NOT NULL,
  `id_consulta` int(4) NOT NULL,
  `hash_e` varchar(256) NOT NULL,
  PRIMARY KEY (`id_voto`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votos`
--

LOCK TABLES `votos` WRITE;
/*!40000 ALTER TABLE `votos` DISABLE KEYS */;
INSERT INTO `votos` VALUES (2,36,3,'€µÑ¤5¾ñR=Š×å¨Ößª§R sA<°§‚ü€X@.úy%‡ÉÌjÊ«áŒ\nc@Ë	´K‰ñÍ–v	ÀY>Ï'),(3,34,1,'•ÐV¥ŽjÒ$;ÝèDo…‡†ysdZÙôro0°‘d›-\ZGø¹¯Ñ0€:OÑ$k$\rúÙoþWÌÒ´ƒ¦åoá'),(4,34,3,'©ô6üÁÞ•B´NëÿRTM£…s„&î&ÿËÈ7À‡üö¦’}$å/ÓZ7ªWd1ùš‡¾šR…•’<!'),(5,34,2,'2ëm.\0p«z«¾¦†e/„õÈw§7ôØÓ5E<?šÆðZQ)ôVvüÝ)ÓÂ´‡º-ß-MƒoˆÛ');
/*!40000 ALTER TABLE `votos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votos_opciones`
--

DROP TABLE IF EXISTS `votos_opciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votos_opciones` (
  `hash` varchar(255) DEFAULT NULL,
  `id_opciones` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votos_opciones`
--

LOCK TABLES `votos_opciones` WRITE;
/*!40000 ALTER TABLE `votos_opciones` DISABLE KEYS */;
INSERT INTO `votos_opciones` VALUES ('orgq30awhziebmf1ta6k37dbx83lvjuf289ad52sd50pn4cey',6),('smi81uka3tbjoc6frfeg474np7c0wd5y5h1lv8axf39qf529z',1),('osk8va5axr61035f2eebn2wgfyq9iz8cc9u0ml3ef4dt7pehj',6),('xjqa460o9lwh8a1nzfdes381gfcmbb2vbeifby3ura7t455pk',3);
/*!40000 ALTER TABLE `votos_opciones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-19 15:13:33
