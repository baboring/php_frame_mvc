-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: lab_c0661374
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.16-MariaDB

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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `u_guid` varchar(36) CHARACTER SET utf8 NOT NULL,
  `user_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT 'active status\n0 : just created\n1 : actived\n99: blocked ',
  `reg_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `expire_date` datetime DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  UNIQUE KEY `u_uuid_UNIQUE` (`u_guid`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='account table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (55,'1dafeb8f-7b95-46cc-a7a7-c58b9b905097','admin','1234','Benjamin',3,0,'2016-10-16 23:38:41','2017-10-17 05:38:41'),(64,'36bd6442-6f9e-4aad-8288-3a4d91e24ffd','amy@gmail.com','1234','Amy',1,0,'2016-10-17 01:29:28','2017-10-17 07:29:28'),(65,'38f2bb17-a53d-4997-b380-a8767f97ffbf','James@gmail.com','hsksf6C^','James',1,0,'2016-10-17 01:34:09','2017-10-17 07:34:09'),(66,'018fcac8-6d07-4dc3-9bc8-1f26f71c188e','Gamm@gmail.com','wPb8bw^c','Gamm',1,0,'2016-10-17 09:37:23','2017-10-17 15:37:23'),(67,'51ab3f64-f1b6-4d4f-aa23-fa107a8b33c7','Teda@gmail.com','Mdx0^bro','Teda',1,1,'2016-10-17 10:29:25','2017-10-17 16:29:25'),(68,'15953ba4-c39d-44c3-86ce-caa799e985d6','Guma@gmail.com','grTvw^t1','Guma',2,0,'2016-10-17 10:52:47','2017-10-17 16:52:47'),(70,'1c19d723-c10b-43a8-9f02-a4276662dcbf','Guma2@gmail.com','vN8k^ufa','Guma2',1,1,'2016-10-17 11:35:31','2017-10-17 17:35:31'),(71,'280ee21a-8499-4f11-87a5-74ee872759d9','baboring2','1234','baboring2',1,1,'2016-10-17 11:49:31','2017-10-17 17:49:31'),(74,'aa564ab6-c810-4de3-b876-03ff75ac1c82','baboring3@gmail.com','lN^s8vxb','baboring2',1,1,'2016-10-17 11:52:29','2017-10-17 17:52:29'),(75,'fa1c4b4c-7e58-49b0-a732-3c8f946b630a','benjamin','1234','Benjamin',2,0,'2016-10-17 11:53:35','2017-10-17 17:53:35'),(76,'879cbb8f-cfb0-4ded-9586-fb7b8305f358','baboring','1234','Hemilton',2,0,'2016-10-18 14:45:32','2017-10-18 20:45:32'),(77,'6486f543-ea94-4be3-95ae-898442494acf','hola@gmail.com','tkFw^i3z','Hollaho',1,1,'2016-10-18 23:16:32','2017-10-19 05:16:32'),(78,'3e60914a-4f5b-4b8a-bb8c-9053727c2346','karan@gmail.com','bsJ1ch^d','Karan',1,1,'2016-10-18 23:56:04','2017-10-19 05:56:04'),(79,'124f4909-9625-40d3-ba48-452391979d2e','final@aa.com','Hlfn^0qf','Final',1,1,'2016-10-18 23:58:13','2017-10-19 05:58:13'),(80,'53de21bd-c03f-4d18-9446-1fa993ffd1aa','test1','loq7icL^',NULL,3,1,'2016-10-19 00:27:59','2017-10-19 06:27:59'),(81,'52f8d9d0-5b65-4bdf-a1f4-e0c6621fe4fa','test2','mn^5qvNe',NULL,3,1,'2016-10-19 00:29:44','2017-10-19 06:29:44'),(82,'26293e60-2b0c-4674-a1b6-8b5f86af107e','test3','zh7rdiY^',NULL,3,1,'2016-10-19 00:32:12','2017-10-19 06:32:12');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `business`
--

DROP TABLE IF EXISTS `business`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `business` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `u_uid` int(11) DEFAULT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `b_name` varchar(45) DEFAULT NULL,
  `b_desc` varchar(45) DEFAULT NULL,
  `qr_code` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`bid`),
  UNIQUE KEY `u_uid_UNIQUE` (`u_uid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `business`
--

LOCK TABLES `business` WRITE;
/*!40000 ALTER TABLE `business` DISABLE KEYS */;
INSERT INTO `business` VALUES (1,68,'Guma','Fa','Guma@gmail.com','+1 215-233-1442','121 McMahon Drive','B-name','Hello',NULL),(2,75,'Benjamin','Park','baboring9@gmail.com','+2 519-383-5442','121 McMahon Drive','Ben`s Factory','Haha',NULL),(3,76,'Hemilton','Mal','Hemilton@gmail.com','123-333-4444','Shaperd Av 221','Teda Bus','I Think that I am best.',NULL);
/*!40000 ALTER TABLE `business` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `u_uid` int(11) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `qr_code` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cid`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `u_uuid_UNIQUE` (`u_uid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (3,64,'Amy','Lee','amy@gmail.com','+1 518-383-5442','131 McMahon Drive',NULL),(4,65,'James','Kal','James@gmail.com','+1 519-383-5442','141  McMahon Drive',NULL),(5,66,'Gamm','Pal','Gamm@gmail.com','+1 529-383-5442','21 McMahon Drive',NULL),(6,67,'Teda','Fol','Teda@gmail.com','+1 519-383-5442','4  McMahon Drive',NULL),(8,70,'Guma2','Gum','Guma2@gmail.com','+1 319-383-5442','5 ssss',NULL),(9,71,'Banggu','Tet','baboring2@gmail.com','+1 519-111-5442','a1 McMahon Drive',NULL),(10,74,'Dandppan','Dan','baboring3@gmail.com','+1 519-383-5090','8  McMahon Drive',NULL),(11,77,'Hollaho','Po','hola@gmail.com','510-232-1111','32 Mountain Dr.',NULL),(12,78,'Karan','Mal','karan@gmail.com','15193835442','121 McMahon Drive',NULL),(13,79,'Final','last','final@aa.com','15193835442','121 McMahon Drive',NULL);
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `records`
--

DROP TABLE IF EXISTS `records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `records` (
  `r_uid` int(11) NOT NULL AUTO_INCREMENT,
  `u_uid` int(11) NOT NULL,
  `s_uid` int(11) NOT NULL,
  `r_desc` varchar(45) DEFAULT NULL,
  `r_status` int(11) NOT NULL DEFAULT '0' COMMENT '0: assign\n1: performed\n2: completed\n99: canceled',
  `r_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `u_date` datetime DEFAULT NULL,
  PRIMARY KEY (`r_uid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COMMENT='inspection of fixing problem';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `records`
--

LOCK TABLES `records` WRITE;
/*!40000 ALTER TABLE `records` DISABLE KEYS */;
INSERT INTO `records` VALUES (3,65,75,'Be Nice',0,'2016-10-18 12:44:13',NULL),(4,65,75,'My Father`s Car',0,'2016-10-18 12:45:10',NULL),(5,65,75,'Thanks',0,'2016-10-18 12:56:57',NULL),(6,65,75,'Tire is flated',0,'2016-10-18 12:57:48',NULL),(7,65,75,'Check Aire Compresure',0,'2016-10-18 13:13:25',NULL),(8,67,75,'Check Engine Oil',0,'2016-10-18 13:14:04',NULL),(9,55,75,'Be care full',0,'2016-10-18 21:34:26',NULL),(10,64,75,'Check Air conditioner',0,'2016-10-18 21:55:41',NULL),(11,64,75,'Check Air conditioner',0,'2016-10-18 21:56:23',NULL),(12,64,75,'Check Air conditioner',0,'2016-10-18 21:57:52',NULL),(13,77,75,'',0,'2016-10-18 23:17:40',NULL);
/*!40000 ALTER TABLE `records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_type`
--

DROP TABLE IF EXISTS `service_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_type` (
  `s_uid` int(11) NOT NULL AUTO_INCREMENT,
  `s_code` int(4) NOT NULL,
  `s_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`s_code`),
  UNIQUE KEY `s_uid_UNIQUE` (`s_uid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COMMENT='service type';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_type`
--

LOCK TABLES `service_type` WRITE;
/*!40000 ALTER TABLE `service_type` DISABLE KEYS */;
INSERT INTO `service_type` VALUES (1,100,'Changing Engine Old'),(2,101,'Replace Break pad'),(3,102,'Charge Air Gas'),(4,103,'Brake repairers'),(5,104,'air-conditioning rep'),(6,105,'Front-end mechanics '),(7,106,'Transmission technic'),(8,107,'Drivability technici');
/*!40000 ALTER TABLE `service_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `s_uid` int(11) NOT NULL AUTO_INCREMENT,
  `s_owner_uid` int(11) NOT NULL,
  `s_type` int(11) NOT NULL,
  PRIMARY KEY (`s_uid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,68,100),(2,68,102),(3,68,104),(4,68,107),(5,75,104),(6,75,107),(7,76,100),(8,76,104),(9,76,105),(10,76,107);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task` (
  `t_uid` int(11) NOT NULL AUTO_INCREMENT,
  `r_uid` int(11) NOT NULL,
  `v_uid` int(11) NOT NULL,
  `s_uid` int(11) NOT NULL,
  `t_desc` varchar(45) DEFAULT NULL,
  `r_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `u_date` datetime DEFAULT NULL,
  PRIMARY KEY (`t_uid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (1,5,1,1,'1','2016-10-18 12:56:57',NULL),(2,5,1,1,'1','2016-10-18 12:56:57',NULL),(3,6,1,1,'1','2016-10-18 12:57:48',NULL),(4,6,1,1,'1','2016-10-18 12:57:48',NULL),(5,7,1,5,'','2016-10-18 13:13:25',NULL),(6,7,1,6,'','2016-10-18 13:13:25',NULL),(7,8,3,5,'','2016-10-18 13:14:04',NULL),(8,8,3,6,'','2016-10-18 13:14:04',NULL),(9,9,7,5,'','2016-10-18 21:34:26',NULL),(10,10,8,5,'','2016-10-18 21:55:41',NULL),(11,11,8,5,'','2016-10-18 21:56:23',NULL),(12,12,8,5,'','2016-10-18 21:57:52',NULL),(13,13,9,6,'','2016-10-18 23:17:40',NULL);
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_type` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `authority` tinyint(1) DEFAULT '0' COMMENT 'authority of administrator',
  PRIMARY KEY (`code`),
  UNIQUE KEY `type_UNIQUE` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_type`
--

LOCK TABLES `user_type` WRITE;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
INSERT INTO `user_type` VALUES (1,'Client',0),(2,'Business',1),(3,'Admin',99);
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles` (
  `v_uid` int(11) NOT NULL AUTO_INCREMENT,
  `v_owner_uid` int(11) NOT NULL,
  `v_company` varchar(45) DEFAULT NULL,
  `v_model` varchar(25) DEFAULT NULL,
  `v_plate_no` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`v_uid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COMMENT='	';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles`
--

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
INSERT INTO `vehicles` VALUES (1,65,'BMW','British Touring','BM3322'),(2,66,'Chevrolet','NASCAR','BS2211'),(3,67,'Ferrari','Ferrari 488 Spider','FE2215'),(4,70,'Honda','Civic 210','CV5462'),(5,71,'Hyundai','Avante','AV2566'),(6,74,'GMC','Canyon','GM2253'),(7,55,'GMC','Zec','GMD002'),(8,64,'GMC','Honet','HO1122'),(9,77,'Kia','Vols2','VGG0002'),(10,78,'GM','Acer','AA0000'),(11,79,'Fela','GGos','123322');
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-19  1:03:08
