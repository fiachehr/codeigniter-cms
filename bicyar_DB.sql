-- MySQL dump 10.17  Distrib 10.3.17-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: bicyar_DB
-- ------------------------------------------------------
-- Server version	10.3.17-MariaDB

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
-- Current Database: `bicyar_DB`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `bicyar_DB` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `bicyar_DB`;

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_admin` (
  `adminUserGUID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `adminUserGroupID` bigint(12) NOT NULL,
  `adminUserEmail` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `adminUserMobile` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `adminUserPassword` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `adminUserFName` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `adminUserLName` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `adminUserAvatar` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adminUserStatus` enum('2','1','0','a') COLLATE utf8_unicode_ci NOT NULL,
  `adminLastVisit` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`adminUserGUID`),
  KEY `adminUserGroupID` (`adminUserGroupID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_admin`
--

LOCK TABLES `tbl_admin` WRITE;
/*!40000 ALTER TABLE `tbl_admin` DISABLE KEYS */;
INSERT INTO `tbl_admin` (`adminUserGUID`, `adminUserGroupID`, `adminUserEmail`, `adminUserMobile`, `adminUserPassword`, `adminUserFName`, `adminUserLName`, `adminUserAvatar`, `adminUserStatus`, `adminLastVisit`, `created_at`, `updated_at`) VALUES ('0FBC8FE4-1EFB-4D61-ABFD-769210179AF4',190527030915,'info@bicyar.com','09121111111','aafd1dfc28c601d28f5','مدیر','سایت',NULL,'1','2019-09-03 09:28:06','2019-05-27 15:10:07','2019-09-03 09:28:06'),('1',0,'admin@ago.ir','09122405231','2a9cafe1af63a0ffe90','مدیر','سایت','no_avatar.png','a','2019-08-31 15:13:49',NULL,'2019-05-27 14:42:43');
/*!40000 ALTER TABLE `tbl_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_board`
--

DROP TABLE IF EXISTS `tbl_board`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_board` (
  `boardGUID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `boardTitle` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `boardImg` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `boardStatus` enum('a','d') COLLATE utf8_unicode_ci NOT NULL,
  `boardLanguage` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`boardGUID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_board`
--

LOCK TABLES `tbl_board` WRITE;
/*!40000 ALTER TABLE `tbl_board` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_board` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_captcha`
--

DROP TABLE IF EXISTS `tbl_captcha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captchaTime` int(10) unsigned NOT NULL,
  `userIP` varchar(45) CHARACTER SET latin1 NOT NULL,
  `captchaString` varchar(20) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`captchaString`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_captcha`
--

LOCK TABLES `tbl_captcha` WRITE;
/*!40000 ALTER TABLE `tbl_captcha` DISABLE KEYS */;
INSERT INTO `tbl_captcha` (`captcha_id`, `captchaTime`, `userIP`, `captchaString`) VALUES (1,1567243998,'2.176.144.108','0947'),(2,1567244114,'2.176.144.108','2389'),(3,1567244573,'2.176.144.108','6953'),(4,1567244603,'2.176.144.108','4190'),(5,1567244606,'2.176.144.108','7421'),(6,1567244631,'2.176.144.108','9203'),(7,1567244685,'2.176.144.108','7358'),(8,1567244785,'2.176.144.108','3260'),(9,1567244855,'2.176.144.108','6129'),(10,1567244910,'2.176.144.108','4390'),(11,1567244966,'2.176.144.108','6097'),(12,1567244969,'2.176.144.108','8467'),(13,1567244996,'2.176.144.108','2493'),(14,1567245074,'2.176.144.108','8639'),(15,1567245093,'2.176.144.108','0618'),(16,1567245096,'2.176.144.108','6958'),(17,1567245272,'2.176.144.108','6298'),(18,1567245282,'2.176.144.108','6278'),(19,1567245358,'2.176.144.108','5329'),(20,1567245403,'2.176.144.108','1459'),(21,1567245525,'2.176.144.108','1256'),(22,1567245528,'2.176.144.108','8267'),(23,1567245558,'2.176.144.108','8946'),(24,1567245570,'2.176.144.108','1294'),(25,1567245571,'2.176.144.108','8495'),(26,1567245586,'2.176.144.108','1586'),(27,1567245651,'2.176.144.108','8037'),(28,1567245870,'2.176.144.108','0534'),(29,1567245872,'2.176.144.108','6057'),(30,1567245873,'2.176.144.108','8503'),(31,1567245916,'2.176.144.108','0495'),(32,1567246030,'2.176.144.108','3458'),(33,1567246033,'2.176.144.108','0526'),(34,1567246047,'2.176.144.108','5837'),(35,1567246050,'2.176.144.108','6798'),(36,1567246186,'2.176.144.108','2509'),(37,1567246230,'2.176.144.108','5019'),(38,1567246240,'2.176.144.108','4017'),(39,1567246320,'2.176.144.108','7401'),(40,1567246327,'2.176.144.108','8092'),(41,1567248138,'2.176.144.108','1075'),(42,1567248209,'2.176.144.108','5497'),(43,1567248277,'2.176.144.108','5769'),(44,1567251165,'213.207.199.21','9784'),(45,1567251170,'213.207.199.21','7654'),(46,1567258299,'3.15.240.36','6237'),(47,1567368411,'87.117.54.188','5219'),(48,1567368413,'87.117.54.188','3860');
/*!40000 ALTER TABLE `tbl_captcha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_category` (
  `id` bigint(12) NOT NULL AUTO_INCREMENT,
  `parentID` bigint(12) NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `categoryModule` int(2) NOT NULL,
  `categoryImg` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categoryURL` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `categoryIndex` int(3) NOT NULL DEFAULT 0,
  `categoryType` enum('c','l','a','f') COLLATE utf8_unicode_ci NOT NULL,
  `categoryStatus` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `categoryLanguage` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_category`
--

LOCK TABLES `tbl_category` WRITE;
/*!40000 ALTER TABLE `tbl_category` DISABLE KEYS */;
INSERT INTO `tbl_category` (`id`, `parentID`, `title`, `categoryModule`, `categoryImg`, `categoryURL`, `categoryIndex`, `categoryType`, `categoryStatus`, `categoryLanguage`, `created_at`, `updated_at`) VALUES (1,0,'ارتباط با ما',0,NULL,'Agotd/contact',8,'c','1','ir',NULL,'2019-08-19 12:29:53'),(2,0,'صفحه اصلی',0,NULL,'Agotd/index',1,'c','1','ir',NULL,'2019-08-19 12:29:50'),(8,0,'درباره ما',25,NULL,'درباره-ما/درباره-ما/',2,'c','1','ir','2019-05-27 15:45:03','2019-08-19 12:29:50'),(9,0,'کاتالوگ',25,NULL,'کاتالوگ/',6,'l','1','ir','2019-05-27 15:45:31','2019-08-19 12:29:52'),(31,40,'اسپری بدن',101,NULL,'محصولات/اسپری-بدن/',3,'c','1','ir','2019-06-01 09:22:48','2019-08-07 10:57:24'),(33,40,'کرم دست و صورت بیژن',101,NULL,'محصولات/کرم-دست-و-صورت-بیژن/',13,'c','1','ir','2019-06-01 09:23:53','2019-08-07 10:57:25'),(35,40,'عطر بانوان',101,NULL,'محصولات/عطر-بانوان/',10,'c','1','ir','2019-06-01 09:33:02','2019-08-07 10:57:25'),(36,40,'عطر مردانه',101,NULL,'محصولات/عطر-مردانه/',8,'c','1','ir','2019-06-01 09:33:37','2019-08-07 10:57:25'),(37,40,'عطر اسپرت',101,NULL,'محصولات/عطر-اسپرت/',9,'c','1','ir','2019-06-01 09:34:48','2019-08-07 10:57:25'),(38,40,'عطر روز بانوان',101,NULL,'محصولات/عطر-روز-بانوان/',11,'c','1','ir','2019-06-01 09:36:30','2019-08-07 10:57:25'),(39,40,'عطر شب بانوان',101,NULL,'محصولات/عطر-شب-بانوان/',12,'c','1','ir','2019-06-01 09:37:39','2019-08-07 10:57:25'),(40,0,'محصولات',101,NULL,'محصولات/',3,'c','1','ir','2019-06-01 09:39:56','2019-08-19 12:29:51'),(41,13,'کرم بیژن',1,'20190602135554mOGoWPKdmu.jpg','اخبار-محصولات/کرم-بیژن/',0,'c','1','ir','2019-06-02 13:55:54',NULL),(48,40,'عطر بیک',101,NULL,'محصولات/عطر-بیک/',1,'c','1','ir','2019-08-07 09:25:57','2019-08-07 10:57:24'),(50,40,'عطر رپیتون',101,NULL,'محصولات/عطر-رپیتون/',4,'c','1','ir','2019-08-07 10:48:21','2019-08-07 10:57:24'),(51,40,'عطر میس‌تین',101,NULL,'محصولات/عطر-میس‌تین/',5,'c','1','ir','2019-08-07 10:49:05','2019-08-07 10:57:24'),(55,40,'عطر میلرد',101,NULL,'محصولات/عطر-میلرد/',6,'c','1','ir','2019-08-07 10:52:33','2019-08-07 10:57:25'),(57,40,'عطر میلانو',101,NULL,'محصولات/عطر-میلانو/',7,'c','1','ir','2019-08-07 10:53:43','2019-08-07 10:57:25'),(60,40,'عطر دات کالکشن',101,NULL,'محصولات/عطر-دات-کالکشن/',2,'c','1','ir','2019-08-07 10:56:15','2019-08-07 10:57:24'),(62,0,'فروش ویژه',101,NULL,'فروش-ویژه/',4,'c','1','ir','2019-08-12 18:07:40','2019-08-19 12:29:51'),(63,0,'شرکت در قرعه کشی',25,NULL,'شرکت-در-قرعه-کشی/',9,'c','1','ir','2019-08-18 17:29:54','2019-08-19 12:29:54'),(64,0,'وبلاگ',1,NULL,'وبلاگ/',7,'c','1','ir','2019-08-19 10:37:11','2019-08-19 12:29:53'),(69,0,'عطر تبلیغاتی',1,NULL,'عطر-تبلیغاتی/',5,'c','1','ir','2019-08-19 12:29:28','2019-08-19 12:29:52'),(70,9,'عطر بیک',25,NULL,'کاتالوگ/عطر-بیک/',0,'a','1','ir','2019-08-19 13:03:01','2019-08-24 16:57:21'),(71,9,'عطر دات کالکشن',25,NULL,'کاتالوگ/عطر-دات-کالکشن/',0,'c','1','ir','2019-08-19 13:06:41',NULL);
/*!40000 ALTER TABLE `tbl_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_comment`
--

DROP TABLE IF EXISTS `tbl_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_comment` (
  `commentID` bigint(20) NOT NULL AUTO_INCREMENT,
  `commentParentID` bigint(20) DEFAULT NULL,
  `commentSrcGUID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `commentModule` int(2) NOT NULL,
  `commentUserName` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `commentUserEmail` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `commentBody` text COLLATE utf8_unicode_ci NOT NULL,
  `commentRegDate` date NOT NULL,
  `commentLike` int(5) NOT NULL DEFAULT 0,
  `commentDislike` int(5) NOT NULL DEFAULT 0,
  `commentStatus` enum('0','1','2') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`commentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_comment`
--

LOCK TABLES `tbl_comment` WRITE;
/*!40000 ALTER TABLE `tbl_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_contact`
--

DROP TABLE IF EXISTS `tbl_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_contact` (
  `contactID` int(4) NOT NULL AUTO_INCREMENT,
  `contactTitle` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `contactValue` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `contactType` enum('email','phone','mobile','address','sn-facebook','sn-linekdin','sn-twitter','sn-instagram','sn-telegram','sn-google','sn-youtube','sn-pintrest','sn-wiki','sn-whatsapp','sn-aparat','map') COLLATE utf8_unicode_ci NOT NULL,
  `contactLanguage` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`contactID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_contact`
--

LOCK TABLES `tbl_contact` WRITE;
/*!40000 ALTER TABLE `tbl_contact` DISABLE KEYS */;
INSERT INTO `tbl_contact` (`contactID`, `contactTitle`, `contactValue`, `contactType`, `contactLanguage`, `created_at`, `updated_at`) VALUES (1,'عنوان اطلاعات ارتباطی','021-74819','phone','ir','2019-08-19 12:55:45','2019-08-19 12:56:53'),(2,'عنوان اطلاعات ارتباطی','شهرک صنعتی خرمدشت، بلوار اصلی، خیابان سوم غربی، پلاک 100','address','ir','2019-08-19 12:58:09',NULL);
/*!40000 ALTER TABLE `tbl_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_group_role`
--

DROP TABLE IF EXISTS `tbl_group_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_group_role` (
  `roleID` int(11) NOT NULL AUTO_INCREMENT,
  `roleGroupID` bigint(12) NOT NULL,
  `moduleID` int(3) NOT NULL,
  `roleStatus` enum('0','1','2','3') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`roleID`),
  KEY `roleGroupID` (`roleGroupID`),
  CONSTRAINT `tbl_group_role_ibfk_1` FOREIGN KEY (`roleGroupID`) REFERENCES `tbl_user_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_group_role`
--

LOCK TABLES `tbl_group_role` WRITE;
/*!40000 ALTER TABLE `tbl_group_role` DISABLE KEYS */;
INSERT INTO `tbl_group_role` (`roleID`, `roleGroupID`, `moduleID`, `roleStatus`) VALUES (99,190527030915,102,'3'),(100,190527030915,99,'3'),(101,190527030915,98,'3'),(102,190527030915,92,'3'),(103,190527030915,73,'3'),(104,190527030915,40,'3'),(105,190527030915,27,'3'),(106,190527030915,100,'3'),(107,190527030915,71,'3'),(108,190527030915,58,'3');
/*!40000 ALTER TABLE `tbl_group_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_homepage`
--

DROP TABLE IF EXISTS `tbl_homepage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_homepage` (
  `homeItemID` int(11) NOT NULL AUTO_INCREMENT,
  `homeItemTitle` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `homeItemLabel` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `homeItemDesc` varchar(2048) COLLATE utf8_unicode_ci DEFAULT NULL,
  `homeItemLink` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `homeItemType` enum('LBX','SBX','PLX') COLLATE utf8_unicode_ci DEFAULT NULL,
  `homeItemImage` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `homeItemImageSize` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `homeItemLanguage` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`homeItemID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_homepage`
--

LOCK TABLES `tbl_homepage` WRITE;
/*!40000 ALTER TABLE `tbl_homepage` DISABLE KEYS */;
INSERT INTO `tbl_homepage` (`homeItemID`, `homeItemTitle`, `homeItemLabel`, `homeItemDesc`, `homeItemLink`, `homeItemType`, `homeItemImage`, `homeItemImageSize`, `homeItemLanguage`, `created_at`, `updated_at`) VALUES (1,'','بخش پارالاکس اول','','https://bicyar.com/Product/ProductArchive/35/%D9%85%D8%AD%D8%B5%D9%88%D9%84%D8%A7%D8%AA/%D8%B9%D8%B7%D8%B1-%D8%A8%D8%A7%D9%86%D9','PLX','20190810100356AXWLP3i42B.jpg','5000*5000','ir','2019-05-27 15:04:38','2019-08-10 10:03:56'),(2,'','بخش پارالاکس دوم','','https://bicyar.com/Product/ProductArchive/36/%D9%85%D8%AD%D8%B5%D9%88%D9%84%D8%A7%D8%AA/%D8%B9%D8%B7%D8%B1-%D9%85%D8%B1%D8%AF%D8','PLX','20190813135657r9IsdidWz8.jpg','5000*5000','ir','2019-05-27 15:04:56','2019-08-13 13:56:57'),(3,'پارالاکس ردیف سوم','بخش سوم پارالاکس','','https://bicyar.com/Product/ProductArchive/37/%D9%85%D8%AD%D8%B5%D9%88%D9%84%D8%A7%D8%AA/%D8%B9%D8%B7%D8%B1-%D8%A7%D8%B3%D9%BE%D8','PLX','20190813140743g2yzainctC.jpg','1024','ir','2019-07-23 15:12:33','2019-08-13 14:07:43'),(4,'','بخش پارالاکس چهارم','','https://bicyar.com/Product/ProductArchive/33/%D9%85%D8%AD%D8%B5%D9%88%D9%84%D8%A7%D8%AA/%DA%A9%D8%B1%D9%85-%D8%AF%D8%B3%D8%AA-%D','PLX','20190813141331mLjtI87yvs.jpg','1024','ir','2019-08-06 19:07:58','2019-08-13 14:13:31');
/*!40000 ALTER TABLE `tbl_homepage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_item_cat`
--

DROP TABLE IF EXISTS `tbl_item_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_item_cat` (
  `catItemID` bigint(20) NOT NULL AUTO_INCREMENT,
  `itemCatID` int(11) NOT NULL,
  `resrcGUID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`catItemID`)
) ENGINE=InnoDB AUTO_INCREMENT=838 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_item_cat`
--

LOCK TABLES `tbl_item_cat` WRITE;
/*!40000 ALTER TABLE `tbl_item_cat` DISABLE KEYS */;
INSERT INTO `tbl_item_cat` (`catItemID`, `itemCatID`, `resrcGUID`) VALUES (324,33,'FE6416E9-6A17-43DA-8948-86C250F9C578'),(325,33,'69F0627C-C773-478D-9773-82012C501239'),(326,33,'EC90A684-BB4A-4FB2-B7FA-F6E89657844E'),(327,33,'30EA6B6C-26AF-4F12-8E96-4B7614F55FFC'),(328,33,'0CC68C58-A3C9-4F13-9CB3-55FFB5E14332'),(329,33,'FB9965B3-0BE2-4003-A306-DA8491F97B66'),(540,36,'9C27F1CA-45C3-463F-8D4A-C24034198DE8'),(541,55,'9C27F1CA-45C3-463F-8D4A-C24034198DE8'),(542,35,'8E89A704-D91A-4296-96B3-08E78A5C2F11'),(543,38,'8E89A704-D91A-4296-96B3-08E78A5C2F11'),(544,51,'8E89A704-D91A-4296-96B3-08E78A5C2F11'),(551,35,'B699E075-128A-497C-ABF5-B0CE6616D43D'),(552,57,'B699E075-128A-497C-ABF5-B0CE6616D43D'),(553,35,'2074CDAE-6B8F-4AB8-B034-EDD229530ACE'),(554,57,'2074CDAE-6B8F-4AB8-B034-EDD229530ACE'),(555,36,'A4F3691E-A2E4-48B0-867B-FDD1F19AEFB1'),(556,57,'A4F3691E-A2E4-48B0-867B-FDD1F19AEFB1'),(557,36,'743293CB-83B9-4F02-8366-A178D544E482'),(558,57,'743293CB-83B9-4F02-8366-A178D544E482'),(559,35,'C0C1FD32-358E-4DEF-995A-A58B0CEEABC5'),(560,38,'C0C1FD32-358E-4DEF-995A-A58B0CEEABC5'),(561,57,'C0C1FD32-358E-4DEF-995A-A58B0CEEABC5'),(562,35,'EDA93A0C-ACDD-48A5-B41E-581A518EF0F8'),(563,39,'EDA93A0C-ACDD-48A5-B41E-581A518EF0F8'),(564,57,'EDA93A0C-ACDD-48A5-B41E-581A518EF0F8'),(565,36,'B180DF24-CC8A-4BA6-9373-8CFC7B25362F'),(566,37,'B180DF24-CC8A-4BA6-9373-8CFC7B25362F'),(567,57,'B180DF24-CC8A-4BA6-9373-8CFC7B25362F'),(568,57,'B9215844-2ABC-46E4-A9DB-FA4C46075BBC'),(569,36,'B9215844-2ABC-46E4-A9DB-FA4C46075BBC'),(570,35,'3B89098E-0032-438A-9FB2-3AA62C24E99E'),(571,50,'3B89098E-0032-438A-9FB2-3AA62C24E99E'),(572,35,'6A49C1C3-6947-4633-AA62-FD2AA77B5E14'),(573,50,'6A49C1C3-6947-4633-AA62-FD2AA77B5E14'),(574,35,'638012E0-EFB1-4BEB-A7DB-3992AF312630'),(575,50,'638012E0-EFB1-4BEB-A7DB-3992AF312630'),(576,35,'C9E27FE6-E736-4542-BA77-99C9F44C4E62'),(577,50,'C9E27FE6-E736-4542-BA77-99C9F44C4E62'),(578,35,'9143332D-EEDB-4330-8CBB-4C294DF6095F'),(579,50,'9143332D-EEDB-4330-8CBB-4C294DF6095F'),(580,35,'249DD765-8553-4159-AC79-A4D600CB929B'),(581,50,'249DD765-8553-4159-AC79-A4D600CB929B'),(585,36,'F97A879C-805A-467C-BB70-94846F0D5DAC'),(586,50,'F97A879C-805A-467C-BB70-94846F0D5DAC'),(587,36,'C33B2B3D-0F1D-4424-9873-504293E4A313'),(588,50,'C33B2B3D-0F1D-4424-9873-504293E4A313'),(589,36,'28811BA8-A356-4B6A-89AC-4BF56F49668F'),(590,50,'28811BA8-A356-4B6A-89AC-4BF56F49668F'),(591,36,'15371BBF-A5DC-4E13-8A04-899D5467A949'),(592,50,'15371BBF-A5DC-4E13-8A04-899D5467A949'),(593,36,'039013FD-49B5-4A72-90B9-81833F743860'),(594,50,'039013FD-49B5-4A72-90B9-81833F743860'),(597,37,'68F4D696-B355-44F3-8C3D-6710CEEBBFD5'),(598,36,'68F4D696-B355-44F3-8C3D-6710CEEBBFD5'),(599,48,'68F4D696-B355-44F3-8C3D-6710CEEBBFD5'),(600,35,'D84D3F3A-6443-4E52-888C-FF712A2CB969'),(601,38,'D84D3F3A-6443-4E52-888C-FF712A2CB969'),(602,48,'D84D3F3A-6443-4E52-888C-FF712A2CB969'),(651,35,'5C6D18F5-9FB7-4130-951F-AB69B8A6EC36'),(652,39,'5C6D18F5-9FB7-4130-951F-AB69B8A6EC36'),(653,48,'5C6D18F5-9FB7-4130-951F-AB69B8A6EC36'),(654,36,'E82A8826-D0EB-45C3-81F5-17B41D959067'),(655,48,'E82A8826-D0EB-45C3-81F5-17B41D959067'),(656,36,'40115BD5-03D3-420D-A857-8287DD70AA2A'),(657,35,'40115BD5-03D3-420D-A857-8287DD70AA2A'),(658,37,'40115BD5-03D3-420D-A857-8287DD70AA2A'),(659,48,'40115BD5-03D3-420D-A857-8287DD70AA2A'),(660,35,'4698E6DF-0DAE-46D9-96F0-ED252AE7B66E'),(661,38,'4698E6DF-0DAE-46D9-96F0-ED252AE7B66E'),(662,48,'4698E6DF-0DAE-46D9-96F0-ED252AE7B66E'),(666,36,'0B6D52FE-238B-4790-92AB-E28D2C5A407E'),(667,48,'0B6D52FE-238B-4790-92AB-E28D2C5A407E'),(668,36,'291404F2-044E-441A-A165-14C4F0F74C1A'),(669,37,'291404F2-044E-441A-A165-14C4F0F74C1A'),(670,48,'291404F2-044E-441A-A165-14C4F0F74C1A'),(674,35,'F3A4F5B6-22B1-4556-9529-8D3A0FF02034'),(675,39,'F3A4F5B6-22B1-4556-9529-8D3A0FF02034'),(676,48,'F3A4F5B6-22B1-4556-9529-8D3A0FF02034'),(677,31,'40477A2D-B63E-4093-833C-22493E440784'),(678,31,'1AB6B08E-0177-4A0A-9AD9-DDBBD657AA41'),(679,31,'737D040E-6F17-4B2A-9024-6355FC633EEC'),(680,31,'65168193-0B33-4BD8-9FE5-955C0C04AAA2'),(681,31,'8BB62DFF-56E2-4FA9-B9E3-05C525E387BC'),(682,31,'0B28CAB1-93BF-4F68-A25B-F302B3068BD8'),(683,31,'19749A8B-CC70-483E-BBC4-FD3E896D6DC6'),(684,31,'961EBEC0-0CCD-41D1-AF7C-C2749DBA0495'),(685,31,'DDB6685E-6C8D-42DC-88CC-BF85DB3A32E2'),(686,31,'E87F6E5C-E457-4BB7-A687-403DF33DC164'),(687,31,'621DC7A3-CE93-4BE0-90CD-D8147C51ED75'),(688,31,'D87DA537-D2C4-4A0E-81E3-37C8D7CB83A6'),(689,36,'96BAB1B0-6DAD-4BFB-8989-891428A49541'),(690,48,'96BAB1B0-6DAD-4BFB-8989-891428A49541'),(691,35,'39D7F09A-5792-43F5-B2A6-1FD32EF564A1'),(692,39,'39D7F09A-5792-43F5-B2A6-1FD32EF564A1'),(693,48,'39D7F09A-5792-43F5-B2A6-1FD32EF564A1'),(694,36,'32E4582D-6452-449B-A9D8-880E0DC75FBE'),(695,48,'32E4582D-6452-449B-A9D8-880E0DC75FBE'),(696,35,'045ADAF5-2E26-437D-8CD5-900300A63816'),(697,36,'045ADAF5-2E26-437D-8CD5-900300A63816'),(698,37,'045ADAF5-2E26-437D-8CD5-900300A63816'),(699,48,'045ADAF5-2E26-437D-8CD5-900300A63816'),(700,35,'B5AB5B04-485C-4FAC-9236-EE98F920BE15'),(701,38,'B5AB5B04-485C-4FAC-9236-EE98F920BE15'),(702,48,'B5AB5B04-485C-4FAC-9236-EE98F920BE15'),(706,36,'B7049A17-7A49-42D0-A9EE-972814CC6F99'),(707,48,'B7049A17-7A49-42D0-A9EE-972814CC6F99'),(708,35,'65C5D195-4194-4E61-8FF6-6DE968C4088A'),(709,36,'65C5D195-4194-4E61-8FF6-6DE968C4088A'),(710,37,'65C5D195-4194-4E61-8FF6-6DE968C4088A'),(711,48,'65C5D195-4194-4E61-8FF6-6DE968C4088A'),(712,35,'51042BAF-0C86-4FAC-BD58-4772FF2CBE69'),(713,38,'51042BAF-0C86-4FAC-BD58-4772FF2CBE69'),(714,48,'51042BAF-0C86-4FAC-BD58-4772FF2CBE69'),(715,35,'2247CBE0-5265-4CD4-BA40-2C6512241109'),(716,39,'2247CBE0-5265-4CD4-BA40-2C6512241109'),(717,48,'2247CBE0-5265-4CD4-BA40-2C6512241109'),(718,36,'96686A35-C9D0-4061-B284-5330255F0936'),(719,48,'96686A35-C9D0-4061-B284-5330255F0936'),(720,35,'349DB62C-0042-4AC2-98AE-78D7B1241C9F'),(721,36,'349DB62C-0042-4AC2-98AE-78D7B1241C9F'),(722,37,'349DB62C-0042-4AC2-98AE-78D7B1241C9F'),(723,48,'349DB62C-0042-4AC2-98AE-78D7B1241C9F'),(724,35,'0E1FA7CC-04E4-4C28-8BBB-364165D1F3D0'),(725,38,'0E1FA7CC-04E4-4C28-8BBB-364165D1F3D0'),(726,48,'0E1FA7CC-04E4-4C28-8BBB-364165D1F3D0'),(730,36,'7DBF4779-78D3-4FEF-8B09-3682E7952ABB'),(731,48,'7DBF4779-78D3-4FEF-8B09-3682E7952ABB'),(732,35,'30CDA588-0B31-4801-8D07-3C57C395EC4F'),(733,36,'30CDA588-0B31-4801-8D07-3C57C395EC4F'),(734,37,'30CDA588-0B31-4801-8D07-3C57C395EC4F'),(735,48,'30CDA588-0B31-4801-8D07-3C57C395EC4F'),(739,35,'3EE265C1-D8A8-4487-9340-AFADA1517E8D'),(740,39,'3EE265C1-D8A8-4487-9340-AFADA1517E8D'),(741,48,'3EE265C1-D8A8-4487-9340-AFADA1517E8D'),(742,35,'F31F2346-4D6F-4702-A28A-0C8841822CF2'),(743,38,'F31F2346-4D6F-4702-A28A-0C8841822CF2'),(744,48,'F31F2346-4D6F-4702-A28A-0C8841822CF2'),(746,35,'9DB11435-97DC-4882-9E3A-C25AB0E5C913'),(747,39,'9DB11435-97DC-4882-9E3A-C25AB0E5C913'),(748,51,'9DB11435-97DC-4882-9E3A-C25AB0E5C913'),(749,36,'4E00D032-9F21-4AFB-A114-46D966B7BAED'),(750,50,'4E00D032-9F21-4AFB-A114-46D966B7BAED'),(763,35,'90CCED8D-5C8D-4854-B2C1-DD53DF0A9CFC'),(764,38,'90CCED8D-5C8D-4854-B2C1-DD53DF0A9CFC'),(765,48,'90CCED8D-5C8D-4854-B2C1-DD53DF0A9CFC'),(766,62,'90CCED8D-5C8D-4854-B2C1-DD53DF0A9CFC'),(767,35,'926D9CFF-3643-42CA-9516-D5A0ED9411AC'),(768,39,'926D9CFF-3643-42CA-9516-D5A0ED9411AC'),(769,48,'926D9CFF-3643-42CA-9516-D5A0ED9411AC'),(770,62,'926D9CFF-3643-42CA-9516-D5A0ED9411AC'),(771,35,'61789D20-FCAA-46B6-8D55-AD86391AB256'),(772,39,'61789D20-FCAA-46B6-8D55-AD86391AB256'),(773,48,'61789D20-FCAA-46B6-8D55-AD86391AB256'),(774,62,'61789D20-FCAA-46B6-8D55-AD86391AB256'),(775,36,'5991C7CB-6CEB-4D4E-8D47-72828D66D4E6'),(776,60,'5991C7CB-6CEB-4D4E-8D47-72828D66D4E6'),(777,35,'70C3AF41-4902-49D8-83C4-97ECEB908643'),(778,60,'70C3AF41-4902-49D8-83C4-97ECEB908643'),(779,36,'4B75BD98-82E3-491F-9737-4EB14AF52097'),(780,60,'4B75BD98-82E3-491F-9737-4EB14AF52097'),(781,35,'CEAC5C92-DAB6-4CC7-ACEA-19F7DEB057ED'),(782,60,'CEAC5C92-DAB6-4CC7-ACEA-19F7DEB057ED'),(783,35,'7FC8C58E-F723-4E90-8FFE-C48AA9242201'),(784,60,'7FC8C58E-F723-4E90-8FFE-C48AA9242201'),(785,36,'CD262E52-FBEF-4F49-90FB-9EAF2A7B0B59'),(786,60,'CD262E52-FBEF-4F49-90FB-9EAF2A7B0B59'),(787,35,'8032FC4C-6085-431B-9C43-8E8D01739649'),(788,60,'8032FC4C-6085-431B-9C43-8E8D01739649'),(789,36,'0EC9088E-AA81-4838-8A5C-481B9CF7311B'),(790,60,'0EC9088E-AA81-4838-8A5C-481B9CF7311B'),(791,35,'5111B3C4-2887-4F8C-A0EE-C78CDBDCC18B'),(792,60,'5111B3C4-2887-4F8C-A0EE-C78CDBDCC18B'),(793,36,'5236E3AE-A2ED-4BE0-AB85-21E7252D40EB'),(794,60,'5236E3AE-A2ED-4BE0-AB85-21E7252D40EB'),(795,35,'F4D2C7E9-614C-4C93-85CB-54F7E2E215B3'),(796,60,'F4D2C7E9-614C-4C93-85CB-54F7E2E215B3'),(797,36,'A87E78B3-1AA8-4B7A-8A03-27C728C2ED36'),(798,60,'A87E78B3-1AA8-4B7A-8A03-27C728C2ED36'),(803,64,'FC40C72D-D33A-41D6-88A0-A3004C08C5FA'),(804,64,'1C09DDFA-5E86-4976-AFB0-60C5CC3339EF'),(807,64,'2A10DAAC-502D-4726-A4BE-89AA455DF0DD'),(815,64,'7D8192DB-932A-44C4-A879-379B02DA2EE4'),(818,36,'390F1C48-C746-488D-84CD-DB740578537E'),(819,55,'390F1C48-C746-488D-84CD-DB740578537E'),(831,69,'C973389E-CED0-4478-9C71-718422488099'),(832,69,'80040C95-336A-4BFB-BC4E-115783264D07'),(834,69,'E56A6971-336D-49BF-B72D-71AAB22BF69C'),(837,69,'7A5C0A83-6133-419C-8041-68B26A29F2E7');
/*!40000 ALTER TABLE `tbl_item_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_item_property_group`
--

DROP TABLE IF EXISTS `tbl_item_property_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_item_property_group` (
  `itemPropGrpID` int(11) NOT NULL AUTO_INCREMENT,
  `itemGUID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `propertyID` int(11) NOT NULL,
  PRIMARY KEY (`itemPropGrpID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_item_property_group`
--

LOCK TABLES `tbl_item_property_group` WRITE;
/*!40000 ALTER TABLE `tbl_item_property_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_item_property_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_item_tag`
--

DROP TABLE IF EXISTS `tbl_item_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_item_tag` (
  `tagItemID` int(11) NOT NULL AUTO_INCREMENT,
  `tagResrcGUID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `itemTagID` int(11) NOT NULL,
  PRIMARY KEY (`tagItemID`),
  KEY `tagResrcGUID` (`tagResrcGUID`),
  KEY `infoTagID` (`itemTagID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_item_tag`
--

LOCK TABLES `tbl_item_tag` WRITE;
/*!40000 ALTER TABLE `tbl_item_tag` DISABLE KEYS */;
INSERT INTO `tbl_item_tag` (`tagItemID`, `tagResrcGUID`, `itemTagID`) VALUES (21,'3EE265C1-D8A8-4487-9340-AFADA1517E8D',14),(22,'3EE265C1-D8A8-4487-9340-AFADA1517E8D',15);
/*!40000 ALTER TABLE `tbl_item_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_language`
--

DROP TABLE IF EXISTS `tbl_language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_language` (
  `languageID` int(3) NOT NULL AUTO_INCREMENT,
  `languageTitle` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `languageIcon` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `languageStatus` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`languageID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_language`
--

LOCK TABLES `tbl_language` WRITE;
/*!40000 ALTER TABLE `tbl_language` DISABLE KEYS */;
INSERT INTO `tbl_language` (`languageID`, `languageTitle`, `languageIcon`, `languageStatus`) VALUES (1,'فارسی','ir','1'),(2,'انگلیسی','us','0'),(3,'عربی','ae','0'),(4,'چینی','cn','0'),(5,'آلمانی','de','0'),(6,'اسپانیایی','es','0'),(7,'فرانسوی','fr','0'),(8,'ایتالیایی','it','0'),(9,'روسی','ru','0'),(10,'ترکی','tr','0');
/*!40000 ALTER TABLE `tbl_language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_link`
--

DROP TABLE IF EXISTS `tbl_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_link` (
  `linkID` int(11) NOT NULL AUTO_INCREMENT,
  `linkTitle` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `linkURL` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `linkPosition` enum('rsb','lsb','f') COLLATE utf8_unicode_ci NOT NULL,
  `linkLanguage` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `linkStatus` enum('a','d') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`linkID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_link`
--

LOCK TABLES `tbl_link` WRITE;
/*!40000 ALTER TABLE `tbl_link` DISABLE KEYS */;
INSERT INTO `tbl_link` (`linkID`, `linkTitle`, `linkURL`, `linkPosition`, `linkLanguage`, `linkStatus`, `created_at`, `updated_at`) VALUES (1,'درباره ما','https://bicyar.com/pageView/%D8%AF%D8%B1%D8%A8%D8%A7%D8%B1%D9%87-%D9%85%D8%A7/%D8%AF%D8%B1%D8%A8%D8%A7%D8%B1%D9%87-%D9%85%D8%A7/','f','ir','a','2019-08-06 19:27:35','2019-08-06 19:28:43');
/*!40000 ALTER TABLE `tbl_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_location`
--

DROP TABLE IF EXISTS `tbl_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_location` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `parentID` int(3) NOT NULL,
  `locDelFee` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=407 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_location`
--

LOCK TABLES `tbl_location` WRITE;
/*!40000 ALTER TABLE `tbl_location` DISABLE KEYS */;
INSERT INTO `tbl_location` (`id`, `title`, `parentID`, `locDelFee`) VALUES (1,'آذربایجان شرقی',0,'40000'),(2,'آذرشهر',1,'40000'),(3,'اسکو',1,'40000'),(4,'اهر ',1,'40000'),(5,'بستان‌آباد',1,'40000'),(6,'بناب ',1,'40000'),(7,'تبریز',1,'40000'),(8,'جلفا',1,'40000'),(9,'چاراویماق',1,'40000'),(10,'سراب',1,'40000'),(11,'شبستر ',1,'40000'),(12,'عجب‌شیر',1,'40000'),(13,'کلیبر ',1,'40000'),(14,'مراغه',1,'40000'),(15,'مرند ',1,'40000'),(16,'ملکان',1,'40000'),(17,'میانه',1,'40000'),(18,'ورزقان ',1,'40000'),(19,'هریس ',1,'40000'),(20,'هشترود',1,'40000'),(21,'آذربایجان غربی',0,'40000'),(22,'نقده',21,'40000'),(23,'ارومیه  ',21,'40000'),(24,'اشنویه',21,'40000'),(25,'بوکان',21,'40000'),(26,'پیرانشهر ',21,'40000'),(27,'تکاب ',21,'40000'),(28,'چالدران ',21,'40000'),(29,'خوی ',21,'40000'),(30,'سردشت ',21,'40000'),(31,'سلماس ',21,'40000'),(32,'شاهین‌دژ ',21,'40000'),(33,'ماکو ',21,'40000'),(34,'مهاباد',21,'40000'),(35,'میاندوآب',21,'40000'),(36,'اردبیل',0,'40000'),(37,'اردبیل ',36,'40000'),(38,'بیله‌سوار',36,'40000'),(39,'پارس‌آباد',36,'40000'),(40,'خلخال ',36,'40000'),(41,'کوثر ',36,'40000'),(42,'گِرمی ',36,'40000'),(43,'مِشگین‌شهر',36,'40000'),(44,'نَمین ',36,'40000'),(45,'نیر',36,'40000'),(46,'اصفهان',0,'40000'),(47,'آران و بیدگل ',46,'40000'),(48,'اردستان',46,'40000'),(49,'اصفهان ',46,'40000'),(50,'برخوار و میمه ',46,'40000'),(51,'تیران و کرون ',46,'40000'),(52,'چادگان ',46,'40000'),(53,'خمینی‌شهر ',46,'40000'),(54,'خوانسار ',46,'40000'),(55,'سمیرم ',46,'40000'),(56,'شهرضا ',46,'40000'),(57,'سمیرم سفلی ',46,'40000'),(58,'فریدن',46,'40000'),(59,'فریدون‌شهر',46,'40000'),(60,'فلاورجان ',46,'40000'),(61,'کاشان',46,'40000'),(62,'گلپایگان ',46,'40000'),(63,'لنجان',46,'40000'),(64,'مبارکه ',46,'40000'),(65,'نائین ',46,'40000'),(66,'نجف‌آباد ',46,'40000'),(67,'نطنز',46,'40000'),(68,'ایلام',0,'40000'),(69,'آبدانان',68,'40000'),(70,'ایلام ',68,'40000'),(71,'ایوان',68,'40000'),(72,'دره‌شهر ',68,'40000'),(73,'دهلران ',68,'40000'),(74,'مهران',68,'40000'),(75,'شیروان و چرداول ',68,'40000'),(76,'بوشهر',0,'40000'),(77,'بوشهر ',76,'40000'),(78,'تنگستان',76,'40000'),(79,'جم',76,'40000'),(80,'دشتستان ',76,'40000'),(81,'دشتی',76,'40000'),(82,'دیر ',76,'40000'),(83,'دیلم ',76,'40000'),(84,'کنگان ',76,'40000'),(85,'گناوه',76,'40000'),(86,'تهران',0,'40000'),(87,'اسلام‌شهر ',86,'40000'),(88,'پاکدشت ',86,'40000'),(89,'تهران ',86,'40000'),(90,'دماوند ',86,'40000'),(91,'رباط‌کریم',86,'40000'),(92,'ری ',86,'40000'),(93,'ساوجبلاغ ',86,'40000'),(94,'شمیرانات ',86,'40000'),(95,'شهریار ',86,'40000'),(96,'ورامین',86,'40000'),(98,'نظرآباد ',86,'40000'),(99,'چهارمحال و بختیاری',0,'40000'),(100,'اردل ',99,'40000'),(101,'بروجن ',99,'40000'),(102,'شهرکرد ',99,'40000'),(103,'فارسان ',99,'40000'),(104,'کوهرنگ',99,'40000'),(105,'لردگان',99,'40000'),(106,'خراسان جنوبی',0,'40000'),(107,'بیرجند',106,'40000'),(108,'درمیان ',106,'40000'),(109,'سرایان ',106,'40000'),(110,'سربیشه',106,'40000'),(111,'فردوس',106,'40000'),(112,'نهبندان',106,'40000'),(113,'قائنات',106,'40000'),(114,'خراسان رضوی',0,'40000'),(115,'بردسکن ',114,'40000'),(116,'تایباد ',114,'40000'),(117,'تربت جام ',114,'40000'),(118,'تربت حیدریه ',114,'40000'),(119,'چناران ',114,'40000'),(120,'خلیل‌آباد ',114,'40000'),(121,'خواف ',114,'40000'),(122,'درگز ',114,'40000'),(123,'رشتخوار ',114,'40000'),(124,'سبزوار ',114,'40000'),(125,'سرخس ',114,'40000'),(126,'فریمان ',114,'40000'),(127,'قوچان ',114,'40000'),(128,'کاشمر ',114,'40000'),(129,'کلات ',114,'40000'),(130,'گناباد ',114,'40000'),(131,'مشهد ',114,'40000'),(132,'مه ولات ',114,'40000'),(133,'نیشابور',114,'40000'),(134,'خراسان شمالی',0,'40000'),(135,'اسفراین ',134,'40000'),(136,'بجنورد ',134,'40000'),(137,'جاجرم ',134,'40000'),(138,'شیروان ',134,'40000'),(139,'فاروج',134,'40000'),(140,'مانه و سملقان',134,'40000'),(141,'خوزستان',0,'40000'),(142,'آبادان ',141,'40000'),(143,'امیدیه',141,'40000'),(144,'اندیمشک ',141,'40000'),(145,'اهواز',141,'40000'),(146,'ایذه',141,'40000'),(147,'باغ‌ملک',141,'40000'),(148,'بندر ماهشهر',141,'40000'),(149,'بهبهان',141,'40000'),(150,'خرمشهر',141,'40000'),(151,'دزفول',141,'40000'),(152,'دشت آزادگان ',141,'40000'),(153,'رامشیر ',141,'40000'),(154,'رامهرمز ',141,'40000'),(155,'شادگان',141,'40000'),(156,'شوش ',141,'40000'),(157,'شوشتر',141,'40000'),(158,'گتوند',141,'40000'),(159,'لالی ',141,'40000'),(160,'مسجد سلیمان',141,'40000'),(161,'هندیجان',141,'40000'),(162,'زنجان',0,'40000'),(163,'ابهر ',162,'40000'),(164,'ایجرود',162,'40000'),(165,'خدابنده',162,'40000'),(166,'خرمدره ',162,'40000'),(167,'زنجان ',162,'40000'),(168,'طارم ',162,'40000'),(169,'ماه‌نشان',162,'40000'),(170,'سمنان',0,'40000'),(171,'دامغان',170,'40000'),(172,'سمنان ',170,'40000'),(173,'شاهرود ',170,'40000'),(174,'گرمسار ',170,'40000'),(175,'مهدی‌شهر',170,'40000'),(176,'سیستان و بلوچستان',0,'40000'),(177,'ایرانشهر ',176,'40000'),(178,'چابهار ',176,'40000'),(179,'خاش ',176,'40000'),(180,'دلگان ',176,'40000'),(181,'زابل ',176,'40000'),(182,'زاهدان ',176,'40000'),(183,'زهک ',176,'40000'),(184,'سراوان ',176,'40000'),(185,'سرباز ',176,'40000'),(186,'کنارک ',176,'40000'),(187,'نیک‌شهر',176,'40000'),(188,'فارس',0,'40000'),(189,'آباده ',188,'40000'),(190,'ارسنجان ',188,'40000'),(191,'استهبان',188,'40000'),(192,'اقلید',188,'40000'),(193,'بوانات',188,'40000'),(194,'پاسارگاد',188,'40000'),(195,'جهرم',188,'40000'),(196,'خرم‌بید ',188,'40000'),(197,'خنج ',188,'40000'),(198,'داراب ',188,'40000'),(199,'زرین‌دشت ',188,'40000'),(200,'سپیدان ',188,'40000'),(201,'شیراز ',188,'40000'),(202,'فراشبند',188,'40000'),(203,'فسا ',188,'40000'),(204,'فیروزآباد ',188,'40000'),(205,'قیر و کارزین ',188,'40000'),(206,'کازرون ',188,'40000'),(207,'لارستان ',188,'40000'),(208,'لامِرد',188,'40000'),(209,'مرودشت ',188,'40000'),(210,'ممسنی ',188,'40000'),(211,'مهر ',188,'40000'),(212,'نی‌ریز',188,'40000'),(213,'قزوین',0,'40000'),(214,'آبیک ',213,'40000'),(215,'البرز ',213,'40000'),(216,'بوئین‌زهرا ',213,'40000'),(217,'تاکستان',213,'40000'),(218,'قزوین',213,'40000'),(219,'قم',0,'40000'),(220,'قم',219,'40000'),(221,'کردستان',0,'40000'),(222,'بانه ',221,'40000'),(223,'بیجار',221,'40000'),(224,'دیواندره ',221,'40000'),(225,'سروآباد ',221,'40000'),(226,'سقز ',221,'40000'),(227,'سنندج ',221,'40000'),(228,'قروه',221,'40000'),(229,'کامیاران',221,'40000'),(230,'مریوان',221,'40000'),(231,'کرمان',0,'40000'),(232,'بافت',231,'40000'),(233,'بردسیر',231,'40000'),(234,'بم ',231,'40000'),(235,'جیرفت ',231,'40000'),(236,'راور ',231,'40000'),(237,'رفسنجان',231,'40000'),(238,'رودبار جنوب ',231,'40000'),(239,'زرند',231,'40000'),(240,'سیرجان',231,'40000'),(241,'شهر بابک ',231,'40000'),(242,'عنبرآباد ',231,'40000'),(243,'قلعه گنج ',231,'40000'),(244,'کرمان ',231,'40000'),(245,'کوهبنان ',231,'40000'),(246,'کهنوج',231,'40000'),(247,'منوجان',231,'40000'),(248,'کرمانشاه',0,'40000'),(249,'اسلام‌آباد غرب ',248,'40000'),(250,'پاوه ',248,'40000'),(251,'ثلاث باباجانی ',248,'40000'),(252,'دالاهو ',248,'40000'),(253,'روانسر ',248,'40000'),(254,'سرپل ذهاب ',248,'40000'),(255,'سنقر ',248,'40000'),(256,'صحنه ',248,'40000'),(257,'قصر شیرین ',248,'40000'),(258,'کرمانشاه ',248,'40000'),(259,'کنگاور ',248,'40000'),(260,'گیلان غرب ',248,'40000'),(261,'هرسین',248,'40000'),(262,'کهکیلویه و بویراحمد',0,'40000'),(263,'بویراحمد ',262,'40000'),(264,'بهمئی ',262,'40000'),(265,'دنا ',262,'40000'),(266,'کهگیلویه ',262,'40000'),(267,'گچساران',262,'40000'),(268,'گلستان',0,'40000'),(269,'آزادشهر ',268,'40000'),(270,'آق‌قلا ',268,'40000'),(271,'بندر گز ',268,'40000'),(272,'ترکمن ',268,'40000'),(273,'رامیان',268,'40000'),(274,'علی‌آباد ',268,'40000'),(275,'کردکوی ',268,'40000'),(276,'کلاله ',268,'40000'),(277,'گرگان ',268,'40000'),(278,'گنبد کاووس ',268,'40000'),(279,'مراوه‌تپه ',268,'40000'),(280,'مینودشت',268,'40000'),(281,'گیلان',0,'40000'),(282,'آستارا ',281,'40000'),(283,'آستانه اشرفیه',281,'40000'),(284,'اَملَش ',281,'40000'),(285,'بندر انزلی ',281,'40000'),(286,'رشت ',281,'40000'),(287,'رضوانشهر ',281,'40000'),(288,'رودبار',281,'40000'),(289,'رودسر ',281,'40000'),(290,'سیاهکل ',281,'40000'),(291,'شَفت ',281,'40000'),(292,'صومعه‌سرا ',281,'40000'),(293,'طوالش ',281,'40000'),(294,'فومَن ',281,'40000'),(295,'لاهیجان ',281,'40000'),(296,'لنگرود',281,'40000'),(297,'ماسال',281,'40000'),(298,'لرستان',0,'40000'),(299,'ازنا',298,'40000'),(300,'الیگودرز ',298,'40000'),(301,'بروجرد',298,'40000'),(302,'پل‌دختر ',298,'40000'),(303,'خرم‌آباد',298,'40000'),(304,'دورود',298,'40000'),(305,'دلفان',298,'40000'),(306,'سلسله',298,'40000'),(307,'کوهدشت',298,'40000'),(308,'مازندران',0,'40000'),(309,'آمل ',308,'40000'),(310,'بابل ',308,'40000'),(311,'بابلسر ',308,'40000'),(312,'بهشهر ',308,'40000'),(313,'تنکابن ',308,'40000'),(314,'جویبار',308,'40000'),(315,'چالوس ',308,'40000'),(316,'رامسر ',308,'40000'),(317,'ساری ',308,'40000'),(318,'سوادکوه',308,'40000'),(319,'قائم‌شهر',308,'40000'),(320,'گلوگاه',308,'40000'),(321,'محمودآباد',308,'40000'),(322,'نکا',308,'40000'),(323,'نور ',308,'40000'),(324,'نوشهر',308,'40000'),(325,'مرکزی',0,'40000'),(326,'آشتیان ',325,'40000'),(327,'اراک ',325,'40000'),(328,'تفرش ',325,'40000'),(329,'خمین ',325,'40000'),(330,'دلیجان ',325,'40000'),(331,'زرندیه ',325,'40000'),(332,'ساوه ',325,'40000'),(333,'شازند ',325,'40000'),(334,'کمیجان ',325,'40000'),(335,'محلات',325,'40000'),(336,'هرمزگان',0,'40000'),(337,'ابوموسی ',336,'40000'),(338,'بستک ',336,'40000'),(339,'بندر عباس ',336,'40000'),(340,'بندر لنگه ',336,'40000'),(341,'جاسک ',336,'40000'),(342,'حاجی‌آباد ',336,'40000'),(343,'شهرستان خمیر ',336,'40000'),(344,'رودان  ',336,'40000'),(345,'قشم',336,'40000'),(346,'گاوبندی ',336,'40000'),(347,'میناب',336,'40000'),(348,'همدان',0,'40000'),(349,'اسدآباد ',348,'40000'),(350,'بهار ',348,'40000'),(351,'تویسرکان',348,'40000'),(352,'رزن ',348,'40000'),(353,'کبودرآهنگ',348,'40000'),(354,'ملایر ',348,'40000'),(355,'نهاوند ',348,'40000'),(356,'همدان',348,'40000'),(357,'یزد',0,'40000'),(358,'ابرکوه',357,'40000'),(359,'اردکان ',357,'40000'),(360,'بافق ',357,'40000'),(361,'تفت ',357,'40000'),(362,'خاتم',357,'40000'),(363,'صدوق ',357,'40000'),(364,'طبس ',106,'40000'),(365,'مهریز',357,'40000'),(366,'مِیبُد',357,'40000'),(367,'یزد',357,'40000'),(368,'منطقه 01',89,'40000'),(369,'منطقه 02',89,'40000'),(370,'منطقه 03',89,'40000'),(371,'منطقه 04',89,'40000'),(372,'منطقه 05',89,'40000'),(373,'منطقه 06',89,'40000'),(374,'منطقه 07',89,'40000'),(375,'منطقه 08',89,'40000'),(376,'منطقه 09',89,'40000'),(377,'منطقه 10',89,'40000'),(378,'منطقه 11',89,'40000'),(379,'منطقه 12',89,'40000'),(380,'منطقه 13',89,'40000'),(381,'منطقه 14',89,'40000'),(382,'منطقه 15',89,'40000'),(383,'منطقه 16',89,'40000'),(384,'منطقه 17',89,'40000'),(385,'منطقه 18',89,'40000'),(386,'منطقه 19',89,'40000'),(387,'منطقه 20',89,'40000'),(388,'منطقه 21',89,'40000'),(389,'منطقه 22',89,'40000'),(390,'البرز',0,'55000'),(392,'کرج',390,'40000'),(393,'نظر آباد',390,'40000'),(394,'محمدشهر',390,'40000'),(395,'کمال شهر',390,'40000'),(396,'ماهدشت',390,'40000'),(397,'هشتگرد',390,'40000'),(398,'مشکین دشت',390,'40000'),(399,'اشتهارد',390,'40000'),(400,'شهر جدید هشتگرد',390,'40000'),(401,'گرمدره',390,'40000'),(402,'کوهسار',390,'40000'),(403,'تنکان',390,'40000'),(404,'طالقان',390,'40000'),(405,'آسارا',390,'40000'),(406,'چهارباغ',390,'40000');
/*!40000 ALTER TABLE `tbl_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_lottery`
--

DROP TABLE IF EXISTS `tbl_lottery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_lottery` (
  `lotteryGUID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `lotteryTitle` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `lotteryWinnerCount` int(3) NOT NULL,
  `lotteryStatus` enum('e','d') COLLATE utf8_unicode_ci NOT NULL,
  `lotteryExpireDate` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`lotteryGUID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_lottery`
--

LOCK TABLES `tbl_lottery` WRITE;
/*!40000 ALTER TABLE `tbl_lottery` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_lottery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_lottery_chance`
--

DROP TABLE IF EXISTS `tbl_lottery_chance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_lottery_chance` (
  `chanceGUID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `chanceLotteryGUID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `chanceUserType` enum('on','off') COLLATE utf8_unicode_ci NOT NULL,
  `chanceUserGUID` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chanceUserName` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chanceUserMobileNo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chanceCode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `chanceStatus` enum('d','e','w','l') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`chanceGUID`),
  KEY `chanceLotteryGUID` (`chanceLotteryGUID`),
  CONSTRAINT `tbl_lottery_chance_ibfk_1` FOREIGN KEY (`chanceLotteryGUID`) REFERENCES `tbl_lottery` (`lotteryGUID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_lottery_chance`
--

LOCK TABLES `tbl_lottery_chance` WRITE;
/*!40000 ALTER TABLE `tbl_lottery_chance` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_lottery_chance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_module`
--

DROP TABLE IF EXISTS `tbl_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_module` (
  `moduleID` int(3) NOT NULL AUTO_INCREMENT,
  `moduleParentID` int(3) NOT NULL,
  `moduleTitle` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `moduleLabel` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `moduleAdminPage` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `moduleUIPage` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `moduleIcon` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `moduleStatus` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`moduleID`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_module`
--

LOCK TABLES `tbl_module` WRITE;
/*!40000 ALTER TABLE `tbl_module` DISABLE KEYS */;
INSERT INTO `tbl_module` (`moduleID`, `moduleParentID`, `moduleTitle`, `moduleLabel`, `moduleAdminPage`, `moduleUIPage`, `moduleIcon`, `moduleStatus`) VALUES (1,0,'خبر و مقالات','news','news/newsList','news/newsArchive','fa-newspaper-o','1'),(2,1,'خبرگزاریها','newsService','news/newsSrvList','','fa-feed','0'),(3,1,'ارسال خبرنامه','newsLater','news/newslatter','','fa-send-o','0'),(4,1,'نظرات کاربران','newsComment','comment/commentList/1','','fa-commenting-o','0'),(5,0,'محصولات','product','product/productList','product/productArchive','fa-retweet','0'),(6,5,'برندها','barnd','product/brandList','','fa-amazon','0'),(7,5,'سفارشات','order','product/orderList','','fa-hand-grab-o','0'),(8,5,'نظرات کاربران','productComment','comment/commentList/5','','fa-commenting-o','0'),(9,0,'تبلیغات','advertising','advertising/advertisingList','','fa-bullhorn','0'),(10,0,'گالری','gallery','gallery/galleryList','gallery/galleryArchive','fa-camera-retro','0'),(11,0,'پروژه ها','project','project/projectList','project/projectArchive','fa-road','0'),(12,0,'نمایندگیها','agency','agent/agentList','agent/agentArchive','fa-group','0'),(13,0,'پیوندها','link','link/linkList','','fa-link','1'),(14,0,'تابلوی اعلانات','board','board/boardList','','fa-television','0'),(15,0,'جملات بزرگان','speech','speech/speechList','','fa-comments-o','0'),(16,0,'دانلود','download','download/downloadList','download/downloadArchive','fa-download','0'),(17,16,'نظرات کاربران','downloadComment','comment/commentList/16','','fa-commenting-o','0'),(18,0,'سوالات متداول','faq','faq/faqList','faq/faqArchive','fa-question','0'),(19,0,'کاربران','user','user/userList','','fa-user','0'),(20,0,'فروشگاه','shop','Shop/factorList','','fa-shopping-cart','1'),(21,20,'کارت هدیه','gift','Shop/giftCardList','','fa-gift','1'),(22,20,'تنظیمات مالی فاکتور','factorFinancial','Shop/factorFinancialList','','fa-dollar ','1'),(23,20,'هزینه ارسال','delivery','Shop/deliveryFee','','fa-truck','1'),(24,20,'توضیحات فاکتور','description','Shop/factorDesc','','fa-credit-card','1'),(25,0,'صفحات و دسته بندی','category','category/pageAndCatList','pageView','fa-sitemap','1'),(26,0,'کاربران مدیریت','adminUser','admin/userList','','fa-dashboard','1'),(27,26,'گروه های کاربری','userGroup','Acms/userGroupList','','fa-users','1'),(28,0,'پشتیبانی','support','support/ticketList','','fa-support','0'),(29,28,'تیکتهای بسته شده','closeTicket','support/closeTicketList','','fa-close','0'),(30,28,'ارسال ایمیل','sendMail','support/sendEmail','','fa-envelope-o','0'),(31,28,'ارسال پیامک','sendSms','support/chatRoom','','fa-wechat','0'),(32,28,'پیامهای مناسبتی','sendMess','support/messageList','','fa-list','0'),(33,0,'مشتریان','costumer','costumer/costumerList','','fa-cubes','0'),(34,33,'فاکتورها','factor','costumer/factorList','','fa-cc-mastercard','0'),(35,33,'قراردادها','contract','costumer/contractList','','fa-file-text-o','0'),(36,33,'هاست و دامنه','domain','costumer/hostAndDomainList','','fa-internet-explorer','0'),(37,0,'تنظیمات سایت و ارتباط با ما','setting','acms/siteSetting','','fa-gear','0'),(38,37,'آدرس پستی','contact','acms/contactlist','','fa-phone','0'),(39,37,'شبکه های اجتماعی','network','acms/socialNetwork','','fa-facebook-official','0'),(40,26,'فعالیت کاربران','userLog','Acms/userLog','','fa-list-ol','1'),(41,0,'دانشنامه','information','information/informationList','information/informationArchive','fa-university','0'),(42,41,'نظرات کاربران','infoComment','comment/commentList/41','','fa-commenting-o','0'),(43,0,'املاک','estate','estate/estateList','','fa-building','0'),(44,0,'گالری صوتی و تصویری','media','media/mediaList','media/mediaArchive','fa-television','0'),(45,44,'نظرات کاربران','mediaComment','comment/commentList/44','','fa-commenting-o','0'),(46,0,'رویدادها','event','event/eventList','','fa-calendar-check-o','0'),(47,0,'وبلاگ','weblog','weblog/postList','weblog/postArchive','fa-file-word-o','0'),(48,47,'نظرات کاربران','weblogComment','comment/commentList/47','','fa-commenting-o','0'),(49,0,'نظرسنجی','vote','vote/voteList','vote/voteResult','fa-bar-chart','0'),(50,0,'آگهی','classified','classified/classifiedList','classified/classifiedArchive','fa-clone','0'),(51,0,'حسابداری','financial','accounting/productList','','fa-calculator','0'),(52,51,'فروش','sale','accounting/saleList','','fa-cc-visa','0'),(53,51,'هزینه ها','cost','accounting/costList','','fa-money','0'),(54,51,'اقساط','installment','accounting/installmentList','','fa-hand-paper-o','0'),(55,51,'چک','cheque','accounting/chequeList','','fa-bank','0'),(56,28,'ربات تلگرام','bot','support/botCommandList','','fa-code','0'),(57,10,'نظرات کاربران','galleryComment','commment/commentList/10','','fa-commenting-o','0'),(58,1,'لیست اخبار','newsList','news/newsList','','fa-newspaper-o','1'),(59,5,'لیست محصولات','productList','product/productList','','fa-retweet','0'),(60,9,'لیست تبلیغات','adverList','advertising/advertisingList','','fa-bullhorn','0'),(61,10,'لیست تصاویر','galleryList','gallery/galleryList','','fa-camera-retro','0'),(62,11,'لیست پروژه ها','projectList','project/projectList','','fa-road','0'),(63,12,'لیست نمایندگیها','agencyList','agent/agentList','','fa-group','0'),(64,13,'لیست پیوندها','linkList','link/linkList','','fa-link','1'),(65,14,'لیست تابلوی اعلانات','boardList','board/boardList','','fa-television','0'),(66,15,'لیست جملات بزرگان','speechList','speech/speechList','','fa-comments-o','0'),(67,16,'لیست فایلها','downloadList','download/downloadList','','fa-download','0'),(68,18,'لیست سوالات متداول','faqList','faq/faqList','','fa-question','0'),(69,19,'لیست کاربران سایت','userList','user/siteUserList','','fa-user','0'),(70,20,'لیست فاکتورها','shopFactor','shop/factorList','','fa-shopping-cart','1'),(71,25,'لیست صفحات و دسته بندی','categoryList','category/pageAndCatList','','fa-sitemap','1'),(72,25,'لیست مشخصه ها','propList','property/propertyList','','fa-th','0'),(73,26,'لیست کاربران مدیریت','adminList','Acms/userList','','fa-dashboard','1'),(74,28,'لیست تیکتها','ticketList','support/ticketList','','fa-support','0'),(75,33,'لیست مشتریان','costList','costumer/costumerList','','fa-cubes','0'),(76,37,'تنظیمات سایت','siteSetting','acms/siteSetting','','fa-gear','0'),(77,41,'لیست مطالب','infoList','information/informationList','','fa-university','0'),(78,43,'لیست املاک','estateList','estate/estateList','','fa-building','0'),(79,44,'لیست مدیا ها','mediaList','media/mediaList','','fa-television','0'),(80,47,'لیست پستها','postList','weblog/postList','','fa-file-word-o','0'),(81,49,'لیست نظرسنجی ها','voteList','vote/voteList','','fa-bar-chart','0'),(82,46,'لیست رویدادها','eventList','event/eventList','','fa-calendar-check-o','0'),(83,50,'لیست آگهی ها','classifiedList','classified/classifiedList','','fa-clone','0'),(84,51,'انبار','store','accounting/productList','','fa-calculator','0'),(87,85,'اسلایدر','slider','homepage/sliderList','','fa-image','0'),(88,0,'آمار بازدید','state','statistic/stateList','','fa-area-chart','0'),(89,0,'محصولات محدود بدون دسته بندی','smallProduct','ProductSM/productSMList','','fa-retweet','0'),(90,89,'لیست محصولات','smallProductList','ProductSM/productSMList','ProductSM/productArchive','fa-retweet','0'),(91,0,'کاربران','smallUser','UserSM/siteUserSMList','','fa-user','1'),(92,91,'لیست کاربران','smallUser','UserSM/siteUserSMList','','fa-user','1'),(93,0,'خبر و مقالات محدود','smallNews','NewsSM/newsSMList','','fa-newspaper-o','0'),(94,93,'لیست خبر و مقالات','smallNews','NewsSM/newsSMList','NewsSM/newsSMArchive','fa-newspaper-o','0'),(95,0,'محصولات محدود با دسته بندی','smallCatProduct','ProductSMC/productSMCList','','fa-retweet','0'),(96,95,'لیست محصولات','smallCatProduct','ProductSMC/productSMCList','ProductSMC/productSMCArchive','fa-retweet','0'),(97,0,'صفحه اصلی','homepage','Homepage/homepageItemList','','fa-home','1'),(98,97,'لیست بخشهای صفحه اصلی','homepage','Homepage/homepageItemList','','fa-home','1'),(99,97,'لیست اسلایدر','slider','Homepage/sliderList','','fa-image','1'),(100,25,'مدیریت ارتباط با ما','contact','Category/contactList','','fa-envelope','1'),(101,0,'محصولات','bicProduct','Product/ProductList','Product/ProductArchive','fa-retweet','1'),(102,101,'لیست محصولات','bicProduct','product/ProductList','Product/ProductList','fa-retweet','1'),(103,20,'قرعه کشی','lottery','Shop/lotteryList','Shop/theLottery','fa-trophy ','1'),(104,97,'لیست تابلو اعلانات','landing','board/boardList','','fa-window-maximize','1');
/*!40000 ALTER TABLE `tbl_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_module_state`
--

DROP TABLE IF EXISTS `tbl_module_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_module_state` (
  `stateID` int(11) NOT NULL AUTO_INCREMENT,
  `moduleStateID` int(3) NOT NULL,
  `moduleItemCount` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`stateID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_module_state`
--

LOCK TABLES `tbl_module_state` WRITE;
/*!40000 ALTER TABLE `tbl_module_state` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_module_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_news`
--

DROP TABLE IF EXISTS `tbl_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_news` (
  `newsGUID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `newsCode` bigint(20) NOT NULL AUTO_INCREMENT,
  `newsSoTitle` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `newsRTitle` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `newsTitle` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `newsArthur` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `newsSummery` text COLLATE utf8_unicode_ci NOT NULL,
  `newsBody` text COLLATE utf8_unicode_ci NOT NULL,
  `newsKeywords` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `newsLanguage` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `newsRecommanded` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `newsType` enum('n','m','g') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `newsStatus` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `newsHits` int(5) NOT NULL DEFAULT 0,
  `newsCommentCount` int(3) NOT NULL DEFAULT 0,
  `imageCount` int(3) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`newsGUID`),
  KEY `newsCode` (`newsCode`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_news`
--

LOCK TABLES `tbl_news` WRITE;
/*!40000 ALTER TABLE `tbl_news` DISABLE KEYS */;
INSERT INTO `tbl_news` (`newsGUID`, `newsCode`, `newsSoTitle`, `newsRTitle`, `newsTitle`, `newsArthur`, `newsSummery`, `newsBody`, `newsKeywords`, `newsLanguage`, `newsRecommanded`, `newsType`, `newsStatus`, `newsHits`, `newsCommentCount`, `imageCount`, `created_at`, `updated_at`) VALUES ('1C09DDFA-5E86-4976-AFB0-60C5CC3339EF',10,'گیاه معطر','درباره یاس (جاسمین)','گل جاسمین','مدیر سایت','چای گل جاسمین یا به انگلیسی Jasmine Flowering Tea یکی از گونه های چای چینی می باشد. در این محصول برگ چای سفید و گل جاسمین به یکدیگر وصل و سپس خشکانده شده است. هنگامی که چای گل را در آب جوش قرار می دهید به مانند یک گل شکوفا می شود.','<p><span style=\"color:rgb(0, 0, 0); font-family:yekan\">چای گل جاسمین یا به انگلیسی Jasmine Flowering Tea یکی از گونه های چای چینی می باشد. در این محصول برگ چای سفید و گل جاسمین به یکدیگر وصل و سپس خشکانده شده است. هنگامی که چای گل را در آب جوش قرار می دهید به مانند یک گل شکوفا می شود. و ظاهر زیبایی پیدا می کند. بنابراین توصیه می شود چای گل جاسمین را در ظروف یا قوری های شیشه ای درست کنید تا زیبایی آن دیده شود. همچنین با افزودن آب جوش می توانید دو تا سه بار از این چای استفاده مجدد کنید.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2 style=\"text-align:justify\">خواص چای گل جاسمین</h2>\r\n\r\n<h4 style=\"text-align:justify\">مقابله با انواع باکتری</h4>\r\n\r\n<p style=\"text-align:justify\">چای گل از طرفی با باکتری های بد مبارزه نموده و آنها را نابود می سازد، از طرف دیگر به ساخت باکتری هایی که برای هضم غذا مفید هستند کمک می کند.</p>\r\n\r\n<h4 style=\"text-align:justify\">کمک به لاغری</h4>\r\n\r\n<p style=\"text-align:justify\">چای گل جاسمین از طریق افزایش متابولیسم یا سوخت و ساز بدن موجب چربی سوزی و در نتیجه لاغری می شود. به تازگی مشخص شده کسانی که از این چای می نوشند در زمان کمتری نسبت به دیگران کاهش وزن پیدا کرده و لاغر می شوند.</p>\r\n\r\n<h4 style=\"text-align:justify\">رایحه درمانی یا آروماتراپی</h4>\r\n\r\n<p style=\"text-align:justify\">یکی از خصوصیات منحصر به فرد چای گل جاسمین عطر و رایحه دلپذیر آن است. تحقیقات روانشناسی کاربردی نشان می دهند بوئیدن و استنشاق چای گل می تواند ضربان قلب فرد را کاهش داده و منجر به آرام شدن فعالیت های عصبی و ریلکسیشن و بهبود خلق و خوی می شود.</p>\r\n\r\n<h4 style=\"text-align:justify\">جلوگیری از سرطان</h4>\r\n\r\n<p style=\"text-align:justify\">از آنجاییکه این چای مقادیر فراوانی آنتی اکسیدان دارد. لذا استفاده از آن ریسک مبتلا شدن به سرطان را پایین می آورد. دلیل این امر آن است که آنتی اکسیدان به رادیکال های آزاد موجود در بدن حمله نموده و از این طریق مانع از بروز سرطان می شود.</p>\r\n\r\n<h4 style=\"text-align:justify\">ضد پیری</h4>\r\n\r\n<p style=\"text-align:justify\">جالب است بدانید همین رادیکال های آزاد منجر می شوند تا در عملکرد و جوان سازی پوست اختلال ایجاد شود. بنابراین می توان گفت آنتی اکسیدان با از بین بردن رادیکال های آزاد روند پیری را نیز به تأخیر می اندازد.</p>\r\n\r\n<h4 style=\"text-align:justify\">بهبود گردش خون</h4>\r\n\r\n<p style=\"text-align:justify\">طبق آخرین یافته های علمی چای گل جاسمین می تواند منجر به تنظیم گردش خون افراد شود. از این رو، از بروز مواردی مانند انسداد عروق، آسیب های مغزی و لخته شدن خون پیشگیری می کند.</p>\r\n\r\n<h4 style=\"text-align:justify\">افزایش سلامت قلب</h4>\r\n\r\n<p style=\"text-align:justify\">یکی از فواید گل جاسمین پایین آوردن چربی خون و کلسترول بد می باشد. همچنین مانع از تشکیل این نوع کلسترول می شود. بدین ترتیب اگر می خواهید ریسک مبتلا شدن به بیماری های قلبی عروبی و سکته مغزی را در خود کاهش دهید، توصیه می کنیم مصرف این نوع چای را در دستور کار خود قرار دهید.</p>\r\n\r\n<h4 style=\"text-align:justify\">کاهش استرس</h4>\r\n\r\n<p style=\"text-align:justify\">از دوران قدیم چای گل جاسمین به دلیل ویژگیهایی که دارد به عنوان یک ماده ضد افسردگی شناخته شده است. با خوردن این چای احساس فوق العاده ای در شما ایجاد می شود.</p>\r\n\r\n<h4 style=\"text-align:justify\">جلوگیری از سرماخوردگی</h4>\r\n\r\n<p style=\"text-align:justify\">این چای با داشتن ویژگی های ضد ویروسی و ضد باکتریایی از بروز سرماخوردگی و آنفولانزا به ویژه در فصل زمستان جلوگیری می کند. همچنین استفاده از این چای موجب تسریع در فرآیند بهبودی و به دست آوردن سلامتی می شود.</p>\r\n\r\n<h4 style=\"text-align:justify\">جلوگیری از بیماری التهابی روده یا IBD</h4>\r\n\r\n<p style=\"text-align:justify\">بیماری التهابی روده یا IBD حالتی است که در آن فرد دچار نفخ شده و در ناحیه روده بزرگ احساس درد می کند. طبق یافته های علمی اخیر نوشیدن این نوع چای منجر به کاهش علائم این بیماری و همچنین بیماری کرون می شود.</p>','عطر, عطر بیک, اسانس, خوشبوکننده, عطر جیبی, عطر روز, عطر شب, عطر بانوان, عطر آقایان, پرفیوم','ir','1','n','1',0,0,1,'2019-08-19 11:57:28','0000-00-00 00:00:00'),('2A10DAAC-502D-4726-A4BE-89AA455DF0DD',11,'برای بانوان و آقایان','معرفی محصول جدید بیک','کرم دست و صورت بیژن','مدیر سایت','عرضه محصول جدید عطر بیکیار','<p><span style=\"color:rgb(111, 111, 111); font-family:iranyekan,roboto,arial; font-size:14px\">کرم مرطوب&zwnj;کننده پوست دست، صورت و بدن</span><br />\r\n<span style=\"color:rgb(111, 111, 111); font-family:iranyekan,roboto,arial; font-size:14px\">حاوی روغن آلوئه&zwnj;ورا و روغن بادام</span><br />\r\n<span style=\"color:rgb(111, 111, 111); font-family:iranyekan,roboto,arial; font-size:14px\">مناسب برای انواع پوست</span><br />\r\n<span style=\"color:rgb(111, 111, 111); font-family:iranyekan,roboto,arial; font-size:14px\">مناسب برای تمام افراد خانواده</span><br />\r\n<span style=\"color:rgb(111, 111, 111); font-family:iranyekan,roboto,arial; font-size:14px\">فاقد پارابن</span></p>','کرم, کرم بیژن, مرطوب کننده, کرم دست و صورت','ir','1','n','1',0,0,1,'2019-08-19 12:26:00','0000-00-00 00:00:00'),('7A5C0A83-6133-419C-8041-68B26A29F2E7',12,'','','NIKE','مدیر سایت','نایک تولید کننده انواع پوشاک ورزشی','<p>از مشتریان عطر تبلیغاتی بیک</p>\r\n\r\n<p>*****************************************</p>\r\n\r\n<p><span style=\"font-size:14px\"><strong>بـــــرند خود را با رایـــــحه خوش ماندگار سازید.</strong></span></p>\r\n\r\n<p>عطر بــیــک تولید کننده عطر تبلیغاتی و عطر اختصاصی با رایـــحـــه انتخابی شما</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>برند نایک در ایران، یکی از مشتریان عطر تبلیغاتی بیک است که با انتخاب عطر به عنوان هدیه و درج لوگو خود روی شیشه عطر، رایحه خوش را تقدیم مشتریان خود می&zwnj;نماید.</p>\r\n\r\n<p>انتخاب عطر به عنوان هدیه، اتفاقی جدید در هدایای تبلیغاتی است. شما ابتدا رایحه مورد نظر خود را از بین بیش از 30 رایحه انتخاب نموده و با ارسال طرح و لوگو مورد نظر خود، اقدام به چاپ آن روی شیشه عطر می&zwnj;نماییم.</p>\r\n\r\n<p>ضمن اینکه شما می&zwnj;توانید برای عطرهای تبلیغاتی خود، جعبه اختصاصی با طرح اختصاصی چاپ نمایید.</p>','','ir','0','n','1',0,0,1,'2019-08-19 12:35:57','0000-00-00 00:00:00'),('7D8192DB-932A-44C4-A879-379B02DA2EE4',8,'از گران‌ قیمت‌ترین گیاهان معطر','درباره گیاهان معطر بیشتر بدانید','وانیل','مدیر سایت','شاید شما هم از جمله علاقمندان طعم وانیل یا بوی وانیلی باشید.\r\n\r\nاجازه بدهید قبل از هر چیز، لازم است بر این نکته تاکید کنیم که به احتمال زیاد، آنچه شما به عنوان وانیل خورده‌اید یا دوست دارید، نوع سینتتیک یا تولید صنعتی وانیل است.','<p><a href=\"http://bestanswer.info/%d9%88%d8%a7%d9%86%db%8c%d9%84-%da%86%db%8c%d8%b3%d8%aa-%d9%88%d8%a7%d9%86%db%8c%d9%84-%d8%b7%d8%a8%db%8c%d8%b9%db%8c/\" rel=\"bookmark\" style=\"text-decoration-line: none; background: 0px 0px; transition: color 0.3s ease 0s; color: rgb(80, 88, 93);\">وانیل چیست</a></p>\r\n\r\n<p style=\"text-align:justify\">شاید شما هم از جمله علاقمندان طعم وانیل یا بوی وانیلی باشید.</p>\r\n\r\n<p style=\"text-align:justify\">اجازه بدهید قبل از هر چیز، لازم است بر این نکته تاکید کنیم که به احتمال زیاد، آنچه شما به عنوان وانیل خورده&zwnj;اید یا دوست دارید، نوع سینتتیک یا تولید صنعتی وانیل است.</p>\r\n\r\n<p style=\"text-align:justify\">این ماده بیشتر با استفاده از پروپیلن گلیکول و افزودنی&zwnj;های دیگر تولید می&zwnj;شود. اگر اسم پروپیلن گلیکول برایتان ناآشنا است، لازم به توضیح است که از این ماده در تولید ضد یخ خودرو هم استفاده می&zwnj;شود.</p>\r\n\r\n<h2 style=\"text-align:justify\">&nbsp;</h2>\r\n\r\n<h2 style=\"text-align:justify\"><strong>وانیل</strong>&nbsp;و&nbsp;<strong>گل ارکیده</strong></h2>\r\n\r\n<p style=\"text-align:justify\">احتمالاً شنیده&zwnj;اید که وانیل از گل ارکیده به دست می&zwnj;آید.</p>\r\n\r\n<p style=\"text-align:justify\">این حرف کاملاً درست است. فقط به خاطر داشته باشید که گل ارکیده حدود 60 گونه متفاوت دارد که تعداد کمی از این گونه ها، برای استخراج وانیل مناسب هستند.</p>\r\n\r\n<p style=\"text-align:justify\">به این گونه ها، وانیلا ارکید (Vanilla Orchid) می&zwnj;گویند.</p>','عطر, عطر بیک, اسانس, خوشبوکننده, عطر جیبی, عطر روز, عطر شب, عطر بانوان, عطر آقایان, پرفیوم','ir','1','n','1',0,0,1,'2019-08-19 11:31:35','0000-00-00 00:00:00'),('80040C95-336A-4BFB-BC4E-115783264D07',13,'','','PAMIR COLA','مدیر سایت','پامیر کولا تولید کننده انواع نوشیدنی','<p>از مشتریان عطر تبلیغاتی بیک</p>\r\n\r\n<p>*****************************************</p>\r\n\r\n<p><span style=\"font-size:14px\"><strong>بـــــرند خود را با رایـــــحه خوش ماندگار سازید.</strong></span></p>\r\n\r\n<p>عطر بــیــک تولید کننده عطر تبلیغاتی و عطر اختصاصی با رایـــحـــه انتخابی شما</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>نوشیدنی پامیرکولا از کشور افغانستان، یکی از مشتریان عطر تبلیغاتی بیک است که با انتخاب عطر به عنوان هدیه و درج لوگو خود روی شیشه عطر، رایحه خوش را تقدیم مشتریان خود می&zwnj;نماید.</p>\r\n\r\n<p>انتخاب عطر به عنوان هدیه، اتفاقی جدید در هدایای تبلیغاتی است. شما ابتدا رایحه مورد نظر خود را از بین بیش از 30 رایحه انتخاب نموده و با ارسال طرح و لوگو مورد نظر خود، اقدام به چاپ آن روی شیشه عطر می&zwnj;نماییم.</p>\r\n\r\n<p>ضمن اینکه شما می&zwnj;توانید برای عطرهای تبلیغاتی خود، جعبه اختصاصی با طرح اختصاصی چاپ نمایید.</p>','','ir','0','n','1',0,0,1,'2019-08-19 12:40:16','0000-00-00 00:00:00'),('C973389E-CED0-4478-9C71-718422488099',15,'','','SUN','مدیر سایت','سان تولید کننده انواع لوازم خانگی','<p>از مشتریان عطر تبلیغاتی بیک</p>\r\n\r\n<p>*****************************************</p>\r\n\r\n<p><span style=\"font-size:14px\"><strong>بـــــرند خود را با رایـــــحه خوش ماندگار سازید.</strong></span></p>\r\n\r\n<p>عطر بــیــک تولید کننده عطر تبلیغاتی و عطر اختصاصی با رایـــحـــه انتخابی شما</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>لوازم خانگی سان، یکی از مشتریان عطر تبلیغاتی بیک است که با انتخاب عطر به عنوان هدیه و درج لوگو خود روی شیشه عطر، رایحه خوش را تقدیم مشتریان خود می&zwnj;نماید.</p>\r\n\r\n<p>انتخاب عطر به عنوان هدیه، اتفاقی جدید در هدایای تبلیغاتی است. شما ابتدا رایحه مورد نظر خود را از بین بیش از 30 رایحه انتخاب نموده و با ارسال طرح و لوگو مورد نظر خود، اقدام به چاپ آن روی شیشه عطر می&zwnj;نماییم.</p>\r\n\r\n<p>ضمن اینکه شما می&zwnj;توانید برای عطرهای تبلیغاتی خود، جعبه اختصاصی با طرح اختصاصی چاپ نمایید.</p>','','ir','0','n','1',0,0,1,'2019-08-19 12:54:10','0000-00-00 00:00:00'),('E56A6971-336D-49BF-B72D-71AAB22BF69C',14,'','','GITI','مدیر سایت','جی‌تی تولید کننده لاستیک انواع خودرو','<p>از مشتریان عطر تبلیغاتی بیک</p>\r\n\r\n<p>*****************************************</p>\r\n\r\n<p><span style=\"font-size:14px\"><strong>بـــــرند خود را با رایـــــحه خوش ماندگار سازید.</strong></span></p>\r\n\r\n<p>عطر بــیــک تولید کننده عطر تبلیغاتی و عطر اختصاصی با رایـــحـــه انتخابی شما</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>گروه صنعتی جی&zwnj;تی، یکی از مشتریان عطر تبلیغاتی بیک است که با انتخاب عطر به عنوان هدیه و درج لوگو خود روی شیشه عطر، رایحه خوش را تقدیم مشتریان خود می&zwnj;نماید.</p>\r\n\r\n<p>انتخاب عطر به عنوان هدیه، اتفاقی جدید در هدایای تبلیغاتی است. شما ابتدا رایحه مورد نظر خود را از بین بیش از 30 رایحه انتخاب نموده و با ارسال طرح و لوگو مورد نظر خود، اقدام به چاپ آن روی شیشه عطر می&zwnj;نماییم.</p>\r\n\r\n<p>ضمن اینکه شما می&zwnj;توانید برای عطرهای تبلیغاتی خود، جعبه اختصاصی با طرح اختصاصی چاپ نمایید.</p>','','ir','0','n','1',0,0,1,'2019-08-19 12:51:36','0000-00-00 00:00:00'),('FC40C72D-D33A-41D6-88A0-A3004C08C5FA',9,'گیاهی علفی و دائمی','گیاهان معطر','برگاموت چیست؟','مدیر سایت','برگاموت (  Bergamot) گیاهی علفی و دائمی و بومی مناطق مردابی امریکا و کانادا است که به نام علمی Monarda didyma شناخته می شود .','<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-family:b mitra; font-size:12pt\">برگاموت (&nbsp;&nbsp;</span><span dir=\"LTR\" style=\"font-family:b mitra; font-size:12pt\">Bergamot</span><span style=\"font-family:b mitra; font-size:12pt\">) گیاهی علفی و دائمی و بومی مناطق مردابی امریکا و کانادا است که به نام علمی&nbsp;</span><span dir=\"LTR\" style=\"font-family:b mitra; font-size:12pt\">Monarda didyma</span><span style=\"font-family:b mitra; font-size:12pt\">&nbsp;شناخته می شود . نامگذاری عامیانه&nbsp; برگاموت بر روی این گیاه نیز به دلیل بوی آن است .&nbsp;</span><span dir=\"LTR\" style=\"font-family:b mitra; font-size:12pt\">Bergamot&nbsp;</span><span style=\"font-family:b mitra; font-size:12pt\">&nbsp;در زبان انگلیسی به معنای ترنج ( از خانواده نارنج ) است .</span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-family:b mitra; font-size:12pt\">گیاه برگاموت به عنوان گیاهی داروئی شناخته می شود و منافع فراوانی را برای آن ذکر کرده اند :</span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-family:b mitra; font-size:12pt\">&nbsp;آرام بخش ؛ رفع دردهای عضلانی ؛ رفع خستگی ؛ التیام بخش زخمها ؛ ترمیم پوست ؛درمان &nbsp;سرما خوردگی و آنفلوانزا ؛ باز کننده سینوس ها ؛ رفع گرفتگی ریه ها و ....</span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"font-family:b mitra; font-size:12pt\">برای ترکیب برگاموت با گیاهان دیگر نیز خواص فراوانی در کتب گیاهان داروئی ذکر شده است مواردی مانند : درمان عفونت های مجاری ادراری ؛ سوء هاضمه ؛ اعمال دستگاه گوارش و ...&nbsp;<br />\r\n<br />\r\nچای ارل گری سوفیا با عطر برگاموت ؛ بسیار آرامبخش و خاطره انگیز در اختیار مصرف کنندگان قرار گرفته است</span></p>','عطر, عطر بیک, اسانس, خوشبوکننده, عطر جیبی, عطر روز, عطر شب, عطر بانوان, عطر آقایان, پرفیوم','ir','1','n','1',0,0,1,'2019-08-19 11:45:47','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tbl_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_page_content`
--

DROP TABLE IF EXISTS `tbl_page_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_page_content` (
  `contentID` int(11) NOT NULL AUTO_INCREMENT,
  `cantentCategoryID` bigint(12) NOT NULL,
  `contentTitle` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contentKeywords` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contentDesc` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contentBody` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `contentLanguage` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`contentID`),
  KEY `cantentCategoryID` (`cantentCategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_page_content`
--

LOCK TABLES `tbl_page_content` WRITE;
/*!40000 ALTER TABLE `tbl_page_content` DISABLE KEYS */;
INSERT INTO `tbl_page_content` (`contentID`, `cantentCategoryID`, `contentTitle`, `contentKeywords`, `contentDesc`, `contentBody`, `contentLanguage`, `created_at`, `updated_at`) VALUES (1,8,'درباره ما','درباره ما','درباره ما','<p dir=\"RTL\" style=\"text-align: justify;\">کارخانه عطر بیکیار در سال 1375 کار خود را با تولید 4 رایحه عطر آغاز نمود ولی بتدریج با تنوع بخشیدن به اسانس&zwnj;ها و بسته&zwnj;بندی&zwnj;های خود اکنون بیش از 40 رایحه در سایزهای مختلف (5/7 میل یا همان عطر جیبی، 30 میل، 50 میل، 100 میل و 150 میل) را عرضه نمود و بهمین دلیل موفق به جلب نظر بسیاری از مصرف کنندگان خوش سلیقه ایرانی گردیده است<span dir=\"LTR\">.</span><br />\r\nکارخانه عطر بیک جزو معدود کارخانه های کاملا اتوماتیک در این صنعت بوده و محصولات آن از مرغوبترین مواد اولیه که توسط بهترین تولید کنندگان اروپایی تولید شده اند تهیه میشود<span dir=\"LTR\">.</span><br />\r\nخط تولید و لابراتوار مجهز این کارخانه بطور منظم مورد بازدید و کنترل کارشناسان وزارت بهداشت درمان و آموزش پزشکی قرار گرفته و لیسانس کمپانی بیک فرانسه نیز مهر تائید دیگری بر کیفیت مطلوب و مرغوب عطر بیک می باشد<span dir=\"LTR\">.</span><br />\r\nمهمترین هدف شرکت عطر بیکیار این است که فرصت خرید عطرهایی با کیفیت عالی و قیمت مناسب را در اختیار همگان قرار دهد<br />\r\nبهبود مستمر مواد اولیه، روش&zwnj;های تولید و کانال&zwnj;های مختلف توزیع این امکان را برای شرکت فراهم می&zwnj;سازد تا به آنچه که خود را به آن متعهد می&zwnj;داند عمل نموده و به اهداف خود نائل آید<span dir=\"LTR\">.</span></p>\r\n','ir','2019-05-27 15:47:36','2019-08-19 11:03:16');
/*!40000 ALTER TABLE `tbl_page_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_page_form`
--

DROP TABLE IF EXISTS `tbl_page_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_page_form` (
  `formGUID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `formResourceID` bigint(20) NOT NULL,
  `formGroupID` int(11) NOT NULL,
  `formEmail` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `formRegType` enum('2','1','0') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`formGUID`),
  KEY `formResourceID` (`formResourceID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_page_form`
--

LOCK TABLES `tbl_page_form` WRITE;
/*!40000 ALTER TABLE `tbl_page_form` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_page_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_page_link`
--

DROP TABLE IF EXISTS `tbl_page_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_page_link` (
  `linkID` int(11) NOT NULL AUTO_INCREMENT,
  `linkCategoryID` bigint(12) NOT NULL,
  `linkURL` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `linkType` enum('l','a') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`linkID`),
  KEY `linkCategoryID` (`linkCategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_page_link`
--

LOCK TABLES `tbl_page_link` WRITE;
/*!40000 ALTER TABLE `tbl_page_link` DISABLE KEYS */;
INSERT INTO `tbl_page_link` (`linkID`, `linkCategoryID`, `linkURL`, `linkType`) VALUES (3,9,'bicyar.com/assets/site/cataloge/milano.pdf','l');
/*!40000 ALTER TABLE `tbl_page_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_product`
--

DROP TABLE IF EXISTS `tbl_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_product` (
  `productGUID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `productCode` int(11) NOT NULL AUTO_INCREMENT,
  `productParentCode` int(11) NOT NULL,
  `productTitle` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `productVolume` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `productProYear` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `productBrand` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `productPrice` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `productDicount` int(2) DEFAULT NULL,
  `productSmellStr` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `productFRNet` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `productMINet` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `productENNet` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `productWeight` int(5) NOT NULL,
  `productPackage` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `productLicense` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `productVitamin` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `productUsage` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `productMaterial` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `productCountry` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `productDesc` text COLLATE utf8_unicode_ci NOT NULL,
  `productFor` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `productRecommanded` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `productStatus` enum('e','d') COLLATE utf8_unicode_ci NOT NULL,
  `productLanguage` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ir',
  `productHits` int(11) NOT NULL DEFAULT 0,
  `productCommentCount` int(5) NOT NULL DEFAULT 0,
  `productRate` int(1) DEFAULT 0,
  `imageCount` int(2) DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`productGUID`),
  KEY `productCode` (`productCode`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_product`
--

LOCK TABLES `tbl_product` WRITE;
/*!40000 ALTER TABLE `tbl_product` DISABLE KEYS */;
INSERT INTO `tbl_product` (`productGUID`, `productCode`, `productParentCode`, `productTitle`, `productVolume`, `productProYear`, `productBrand`, `productPrice`, `productDicount`, `productSmellStr`, `productFRNet`, `productMINet`, `productENNet`, `productWeight`, `productPackage`, `productLicense`, `productVitamin`, `productUsage`, `productMaterial`, `productCountry`, `productDesc`, `productFor`, `productRecommanded`, `productStatus`, `productLanguage`, `productHits`, `productCommentCount`, `productRate`, `imageCount`, `created_at`, `updated_at`) VALUES ('039013FD-49B5-4A72-90B9-81833F743860',76,0,'رپیتون شماره 12','50','1392','بیک','94800',0,'چرم و طبیعت- گرم','چرم','تنباکو','درختان جنگلی',200,'شیشه','34/10732','','','','ایران','<p>برگرفته از بوی چرم مرغوب که حال و هوای طبیعت را به ارمغان می&zwnj;آورد. بویی مخلوط از سنت و مدرنیته که عشق را در روزهای گرم تداعی می&zwnj;کند.</p>','آقایان','0','e','ir',0,0,0,1,'2019-08-07 12:10:08','2019-08-13 11:14:41'),('045ADAF5-2E26-437D-8CD5-900300A63816',44,0,'عطر بیک شماره 6','7.5','1376','بیک','14900',2,'طبیعت- خنک و شیرین','نعناع','سرخس','چوب سندل',30,'شیشه','34-10732','','','','ایران','<p>با عصاره&zwnj;ای از برگ نعناع و رایحه سرخس، به نرمی بر پوست نشسته و از شما خاطره&zwnj;ای شیرین به یادگار می&zwnj;گذارد.</p>','بانوان- آقایان','0','e','ir',0,0,0,1,'2019-06-02 10:09:14','2019-08-13 13:00:21'),('0B28CAB1-93BF-4F68-A25B-F302B3068BD8',20,0,'اسپری بدن شماره 6','150','1392','بیک','24000',0,'گل، مرکبات، چوب- گرم','چوب و مشک','عنبر','وانیل',100,'قوطی','1024-ظ-30','','','','ایران','<p>اسپری شماره 6 بیک</p>\r\n\r\n<p>مناسب برای آقایان</p>\r\n\r\n<p>نت&zwnj;های بالایی این رایحه چوبی، گلی و مشک هستند. نت&zwnj;های میانی آن مرکبات، بنفشه و نت&zwnj;های پایه&zwnj;اش آمیزه&zwnj;ای از عنبر و وانیل می&zwnj;باشد.</p>','آقایان','0','e','ir',0,0,0,1,'2019-06-01 11:53:20','2019-08-13 12:46:47'),('0B6D52FE-238B-4790-92AB-E28D2C5A407E',64,0,'عطر بیک شماره 25','7.5','1376','بیک','14900',0,'گل، طبیعت، مرکبات- گرم','رز و جاسمین','لیمو و پرتقال','چوب',30,'شیشه','34-10732','','','','ایران','<p>نت&zwnj;های بالایی این عطر نشاط و سرزندگی بسیاری را به وسیله نت&zwnj;های اقیانوسی و مرکبات ایجاد می&zwnj;کنند که با رایحه گرم و گلی آن به کمال می&zwnj;رسند. نت&zwnj;های چوبی آن سبب گرم&zwnj;تر شدن رایحه&zwnj;اش می&zwnj;شوند. نت&zwnj;های این رایحه حس مردانگی مدرنی را آشکار می&zwnj;کنند که آمیزه&zwnj;ای از مهارت و زیرکی است.</p>','آقایان','0','e','ir',0,0,0,1,'2019-08-07 10:06:31','2019-08-13 12:22:53'),('0CC68C58-A3C9-4F13-9CB3-55FFB5E14332',74,0,'کرم 50ml','50','1397','بیک','11000',0,'','','','',60,'قوطی','56/18077','E','دست، صورت و بدن','','ایران','<p>کرم مرطوب&zwnj;کننده پوست دست، صورت و بدن<br />\r\nحاوی روغن آلوئه&zwnj;ورا و روغن بادام<br />\r\nمناسب برای انواع پوست<br />\r\nمناسب برای تمام افراد خانواده<br />\r\nفاقد پارابن</p>','بانوان- آقایان','0','e','ir',0,0,0,1,'2019-08-07 11:38:24',NULL),('0E1FA7CC-04E4-4C28-8BBB-364165D1F3D0',53,0,'عطر بیک شماره 15','7.5','1376','بیک','14900',0,'میوه و طبیعت- خنک و ملایم','نارنگی و نارنج','سدر و سندل','مشک',30,'شیشه','34-10732','','','','ایران','<p>معجونی از عطر میوه نارنگی و نارنج با آمیزه&zwnj;ای از رایحه چای سبز که طراوتی تحسین برانگیز می&zwnj;آفریند. ترکیب عطر چوب سدر و صندل و بوی ملایم مشک به احساس زنانه آن افزوده و آن را مناسب هر ساعتی از روز می&zwnj;سازد. رایحه&zwnj;ای ویژه، نیروبخش و احساس برانگیز مناسب دختران و خانم&zwnj;های جوان با سلیقه امروزی.</p>','بانوان','0','e','ir',0,0,0,1,'2019-06-02 10:51:33','2019-08-13 13:03:29'),('0EC9088E-AA81-4838-8A5C-481B9CF7311B',32,0,'عطر دات کالکشن شماره 6','7.5','1392','بیک','14900',0,'گل، مرکبات، چوب- گرم','چوب و مشک','عنبر','وانیل',30,'شیشه','34-10732','','','','ایران','<p>عطر دات کالکشن شماره 6</p>\r\n\r\n<p>مناسب برای آقایان</p>\r\n\r\n<p>نت&zwnj;های بالایی این رایحه چوبی، گلی و مشک هستند. نت&zwnj;های میانی آن مرکبات، بنفشه و نت&zwnj;های پایه&zwnj;اش آمیزه&zwnj;ای از عنبر و وانیل می&zwnj;باشد.</p>','آقایان','0','e','ir',0,0,0,1,'2019-06-01 13:00:50','2019-08-17 11:19:22'),('15371BBF-A5DC-4E13-8A04-899D5467A949',77,0,'رپیتون شماره 11','50','1392','بیک','94800',0,'مرکبات، میوه، چرم- گرم و ملایم','لیمو','زیتون','چرم و تنباکو',200,'شیشه','34/10732','','','','ایران','<p>با این عطر در باغ&zwnj;های بهشت قدم می&zwnj;گذارید و این بوی مست&zwnj;کننده با بوی لیمو شما را به وجد خواهد آورد. بوی برگ&zwnj;های زیتون حس صلح و آرامش را به شما می&zwnj;دهد و با رایحه چرم و تنباکو این سفر را برای شما خاطره&zwnj;انگیز می&zwnj;کند.</p>','آقایان','0','e','ir',0,0,0,1,'2019-08-07 12:15:27','2019-08-13 11:10:59'),('19749A8B-CC70-483E-BBC4-FD3E896D6DC6',21,0,'اسپری بدن شماره 7','150','1392','بیک','24000',0,'گل و گیاه- خنک و ملایم','یاس','عنبر و مشک','نعناع هندی',100,'قوطی','1024-ظ-30','','','','ایران','<p>اسپری شماره 7 بیک</p>\r\n\r\n<p>مناسب برای بانوان</p>\r\n\r\n<p>این رایحه مدرن، مناسب بانوان فاخر امروزی و بسیار زنانه است. رایحه آن گیرا، با نشاط و فریبنده و در عین حال روشن و ملایم است. این اسپری رایحه دلفریبی از نت&zwnj;های گل یاس را در فضا پراکنده می&zwnj;سازد و نت&zwnj;های پایه آن که ترکیبی از عنبر، مشک و نعناع هندی هستند عطری بسیار وسوسه&zwnj;انگیز را ایجاد می&zwnj;کنند.</p>','بانوان','0','e','ir',0,0,2,1,'2019-06-01 12:00:52','2019-08-13 12:48:06'),('1AB6B08E-0177-4A0A-9AD9-DDBBD657AA41',16,0,'اسپری بدن شماره 2','150','1392','بیک','24000',0,'چوب و گیاه- گرم','چوب سندل','عنبر','سدر و مشک',100,'قوطی','1024-ظ-30','','','','ایران','<p>اسپری شماره 2 بیک</p>\r\n\r\n<p>مناسب برای آقایان</p>\r\n\r\n<p>این اسپری با رایحه بسیار پیچیده خود به آقایان کمک می&zwnj;کند ابعاد اسرارآمیز وجود خود را تقویت کنند. رایحه دلفریب آن بازتابی از باطن اغوا کننده&zwnj;اش است و در تمامی شرایط باعث احساس سرزندگی و اعتماد به نفس می&zwnj;شود. جذابیت آقایان با استفاده از رایحه هوس&zwnj;انگیز این عطر دوچندان می&zwnj;گردد.</p>','آقایان','0','e','ir',0,0,0,1,'2019-06-01 10:41:22','2019-08-13 12:36:38'),('2074CDAE-6B8F-4AB8-B034-EDD229530ACE',94,0,'میلانو سفید مات','100','1386','بیک','106800',0,'طبیعت- گرم و ملایم','برگاموت، یاسمین','چوب سندل','عنبر',230,'شیشه','34/14991','','','','ایران','<p>این رایحه شما را فریاد می&zwnj;زند، حس خالص عاشقی که قدرت را بازیافته است. نت آغازین با بوی خوش برگاموت و یاسمین شما را اغوا خواهد کرد و بعد به باغی از گلهای سفید پا خواهید گذاشت. شمیم چوب سندل و عنبر عمیق احساس زنانه را منتقل می&zwnj;نماید.</p>','بانوان','0','e','ir',0,0,0,1,'2019-08-07 15:42:38','2019-08-13 10:37:09'),('2247CBE0-5265-4CD4-BA40-2C6512241109',50,0,'عطر بیک شماره 12','7.5','1376','بیک','14900',0,'گل و مرکبات- خنک','گل‌های بهاری','گریپ فروت','بهار نارنج',30,'شیشه','34-10732','','','','ایران','<p>رایحه&zwnj;ای رمزآلود و پر هیجان که عطری خوشبو و غنی از رایحهی گل&zwnj;ها و دست&zwnj;چینی انرژی&zwnj;زا از گیاه گریپ&zwnj;فروت و بهار نارنج می&zwnj;آفریند و در پایان از آن خاطره&zwnj;ای به مانند کسی که از آن استفاده می&zwnj;کند به جا می&zwnj;گذارد.</p>','بانوان','0','e','ir',0,0,0,1,'2019-06-02 10:30:44','2019-08-13 13:02:34'),('249DD765-8553-4159-AC79-A4D600CB929B',82,0,'رپیتون شماره 06','50','1392','بیک','94800',0,'گل، گیاه، چرم- گرم و ملایم','سبزی‌های کوهی','وانیل','چرم',200,'شیشه','34/10732','','','','ایران','<p>رایحه&zwnj;ای از گل&zwnj;های سفید که تداعی&zwnj;کننده عشقی پیچیده است. رایحه&zwnj;ای اغواگر و فریبنده، نت بالایی آن رایحه سبزی&zwnj;های کوهی، نت اصلی آن رایحه وانیل و در پرده آخربا رایحه&zwnj;ای از چرم، پایانی جنجالی را ورق می&zwnj;زند.</p>','بانوان','0','e','ir',0,0,0,1,'2019-08-07 12:37:19','2019-08-13 11:03:23'),('28811BA8-A356-4B6A-89AC-4BF56F49668F',78,0,'رپیتون شماره 10','50','1392','بیک','94800',0,'جنگل و طبیعت- خنک','رزماری','چوب‌های جنگلی','رز',200,'شیشه','34/10732','','','','ایران','<p>رایحه&zwnj;ای از باغ&zwnj;های بهشتی که در کنار این باغ خودنمایی می&zwnj;کند و بوی چوب&zwnj;های جنگلی باران خورده را نمی&zwnj;توان در آن نادیده گرفت. در همه نت&zwnj;های این عطر اعجاب&zwnj;انگیز رد پایی از رزهای سراسر جهان یافت می&zwnj;شود.</p>','آقایان','0','e','ir',0,0,0,1,'2019-08-07 12:20:09','2019-08-13 11:08:49'),('291404F2-044E-441A-A165-14C4F0F74C1A',65,0,'عطر بیک شماره 26','7.5','1376','بیک','14900',0,'گیاه و چوب- گرم','سندل','سدر','چوب سدر و مشک',30,'شیشه','34-10732','','','','ایران','<p>نت&zwnj;های بالایی این عطر احساس نیرومندی از سرزندگی و رایحه جذابی چون حس شادابی و طراوت را به ارمغان می&zwnj;آورند. این عطر آفرینشی شرقی و متعالی از مردانگی است.</p>','آقایان','0','e','ir',0,0,0,1,'2019-08-07 10:10:37','2019-08-13 12:25:15'),('30CDA588-0B31-4801-8D07-3C57C395EC4F',56,0,'عطر بیک شماره 18','7.5','1376','بیک','14900',0,'مرکبات، گل، ادویه- گرم','لیمو ترش و نارنج','شمعدانی و بنفشه','ادویه‌جات',30,'شیشه','34-10732','','','','ایران','<p>رایحه&zwnj;&zwnj;ای با حس تقابل انرژی&zwnj;زا، آمیزه&zwnj;ای از رایحه خوش مرکبات، لیمو ترش، نارنج، گل&zwnj;های یاسمن و شمعدانی، که بوی برگهای بنفشه را نیز با خود به همراه دارد. در انتها نیز عطر گرم و احساس برانگیز ادویه&zwnj;جات و برگ درخت گردو تاثیر جادویی آن را دو چندان می&zwnj;سازد. عطری برای همه کسانی که نهایت لذت را از رندگی می&zwnj;خواهند.</p>','بانوان- آقایان','0','e','ir',0,0,0,1,'2019-06-02 11:03:30','2019-08-13 13:04:08'),('30EA6B6C-26AF-4F12-8E96-4B7614F55FFC',73,0,'کرم 75ml','75','1397','بیک','13000',0,'','','','',100,'تیوپی','56/18077','E','دست، صورت و بدن','','ایران','<p>کرم مرطوب&zwnj;کننده پوست دست، صورت و بدن<br />\r\nحاوی روغن آلوئه&zwnj;ورا و روغن بادام<br />\r\nمناسب برای انواع پوست<br />\r\nمناسب برای تمام افراد خانواده<br />\r\nفاقد پارابن</p>','بانوان- آقایان','0','e','ir',0,0,0,1,'2019-08-07 11:36:51',NULL),('32E4582D-6452-449B-A9D8-880E0DC75FBE',43,0,'عطر بیک شماره 5','7.5','1376','بیک','14900',0,'طبیعت- گرم','سرخس و سندل','چوب‌های جنگلی','سدر',30,'شیشه','34-10732','','','','ایران','<p>رایحه قوی جنگل، به همراه عطری متین از گل و میوه که جلوه&zwnj;ای از مردانگی و استواری به شما می&zwnj;بخشد.</p>','آقایان','0','e','ir',0,0,0,1,'2019-06-02 10:06:39','2019-08-13 13:00:09'),('349DB62C-0042-4AC2-98AE-78D7B1241C9F',52,0,'عطر بیک شماره 14','7.5','1376','بیک','14900',0,'گل و مرکبات- گرم','نارنگی','یاس و سوسن وحشی','دارچین و نعنا هندی',30,'شیشه','34-10732','','','','ایران','<p>عطری سرشار از طراوت، با رایحه شکوفه&zwnj;های نارنگی، پرتقال به همراه بوی خوش گلبرگ&zwnj;های گل یاس و سوسن وحشی که انرژی مثبت می&zwnj;آفریند. بوی دارچین این عطر، اعتماد به نفس را به شما هدیه می&zwnj;کند و عطر خوش نعناع هندی و وانیل آن آرامشی می&zwnj;بخشد که حتما بایستی آن را تجربه کرد. استفاده از آن در فعالیت&zwnj;های ورزشی مورد علاقه شما تجربه بی&zwnj;نظیر دیگری خواهد بود.</p>','بانوان- آقایان','0','e','ir',0,0,0,1,'2019-06-02 10:39:52','2019-08-13 13:03:17'),('390F1C48-C746-488D-84CD-DB740578537E',99,0,'میلُرد آبی','30','1392','بیک','50000',0,'مرکبات- گرم و شیرین','رایحه مرکبات','چوب سدر، یاسمن، زنجفیل','سندل و نعناع',80,'شیشه','34/14953','','','','ایران','<p><span dir=\"RTL\">این عطر جذاب و ماندگار با رایحه&zwnj;ای از مرکبات آغاز می&zwnj;شود و سپس بدنبال آن بویی&nbsp;گرم و دلچسب از چوب&zwnj;های سدار و سبز که بوی یاسمن و زنجفیل به نرمی بر آن نشسته و در انتها نیز بوی جنگل سندل&nbsp;و نعناع هندی مشام را می&zwnj;نوازد. جلوه ای یگانه از پرستیژ و وقار شخصیت مرد ایرانی.&nbsp;</span></p>','آقایان','0','e','ir',0,0,0,1,'2019-08-07 16:24:00','2019-08-26 17:11:03'),('39D7F09A-5792-43F5-B2A6-1FD32EF564A1',42,0,'عطر بیک شماره 4','7.5','1376','بیک','14900',0,'گل، میوه، مرکبات- گرم و شیرین','رز و یاسمن','لیمو','ترنج و پرتقال',30,'شیشه','34-10732','','','','ایران','<p>رایحه&zwnj;ای رمزآلود و پرهیجان زنانه، همچون شبهای پاریس، آمیخته&zwnj;ای غنی و پردوام از عصاره گل&zwnj;ها و میوه&zwnj;های معطر، که گرما، شور و جاذبه می&zwnj;آفریند.</p>','بانوان','0','e','ir',0,0,0,1,'2019-06-02 10:03:33','2019-08-13 12:59:57'),('3B89098E-0032-438A-9FB2-3AA62C24E99E',87,0,'رپیتون شماره 01','50','1392','بیک','94800',0,'میوه- خنک و ملایم','ترکیبی از میوه‌های تابستانی','هلو','چوب',200,'شیشه','34/10732','','','','ایران','<p dir=\"RTL\">این رایحه با شکوه ذاتی خود محیط شاد و مد روز مهمانی&zwnj;های نیویورک را تداعی می&zwnj;کند. این ترکیب تازگی، حساسیت و حس زندگی را در خود داراست. نت بالایی این عطر ترکیبی از میوه&zwnj;های تازه تابستان است که بوی هلوی آن حال و هوای تابستان و آفتاب را به شما هدیه می&zwnj;دهد و نت اصلی بوی چوب جنگلی را تداعی می&zwnj;کند<span dir=\"LTR\">.</span>این رایحه با شکوه ذاتی خود محیط شاد و مد روز مهمانی&zwnj;های نیویورک را تداعی می&zwnj;کند. این ترکیب تازگی، حساسیت و حس زندگی را در خود داراست. نت بالایی این عطر ترکیبی از میوه&zwnj;های تازه تابستان است که بوی هلوی آن حال و هوای تابستان و آفتاب را به شما هدیه می&zwnj;دهد و نت اصلی بوی چوب جنگلی را تداعی می&zwnj;کند<span dir=\"LTR\">.</span></p>','بانوان','0','e','ir',0,0,0,1,'2019-08-07 13:31:34','2019-08-13 10:51:50'),('3EE265C1-D8A8-4487-9340-AFADA1517E8D',62,0,'عطر بیک شماره 24','7.5','1376','بیک','14900',0,'گل، گیاه و میوه- گرم و ملایم','سوسن و رز','گیاه و سبزه‌زار','چوب سندل',30,'شیشه','34-10732','','','','ایران','<p>رایحه&zwnj;ای از گلبرگ&zwnj;های سوسن وحشی، رز و آمیزه&zwnj;ای از عطر میوه&zwnj;ها و سبزه&zwnj;زارها، که سرانجام اثری از بوی ملایم و گرم چوبهای قیمتی و صندل را به یادگار می&zwnj;گذارد. عطری که به آرامی روی پوست خانم&zwnj;ها نشسته و همچون گل لطیف است. مناسب خانم&zwnj;هایی که خود را در اوج می&zwnj;بینند. عطری مناسب برای استفاده در شب.</p>','بانوان','0','e','ir',0,0,0,1,'2019-06-02 11:25:42','2019-08-13 13:04:46'),('40115BD5-03D3-420D-A857-8287DD70AA2A',60,0,'عطر بیک شماره 22','7.5','1376','بیک','14900',0,'میوه و مرکبات- خنک','لیمو','گل ریحان و نعناع وحشی','چوب سدر و مشک',30,'شیشه','34-10732','','','','ایران','<p>رایحه استثنائی با ترکیبی از لیمو و گل ریحان و نعناع وحشی همراه با بوی خوش چوب سدر و مشک، عطری انرژی&zwnj;زا برای همه، خنک، راحت، ایده&zwnj;آل برای ورزش، تحرک و پویایی بیشتر.</p>','بانوان- آقایان','0','e','ir',0,0,0,1,'2019-06-02 11:18:23','2019-08-13 12:12:47'),('40477A2D-B63E-4093-833C-22493E440784',15,0,'اسپری بدن شماره 1','150','1392','بیک','24000',0,'گل و میوه- گرم','رز','عنبر ','وانیل',100,'قوطی','1024-ظ-30','','','','ایران','<p>اسپری شماره یک بیک</p>\r\n\r\n<p>مناسب برای بانوان</p>\r\n\r\n<p>ترکیبی هنرمندانه از گل&zwnj;های معطر و میوه&zwnj;های خوشبو که رز و عنبر آن را همراهی کرده و عطر رمزآلود و هیجان&zwnj;انگیز آفریده که در پایان رایحه جادویی وانیل آن شما را به لذت بیشتر از لحظات زندگی دعوت می&zwnj;نماید.</p>','بانوان','0','e','ir',0,0,0,1,'2019-06-01 10:28:16','2019-08-13 12:35:36'),('4698E6DF-0DAE-46D9-96F0-ED252AE7B66E',61,0,'عطر بیک شماره 23','7.5','1376','بیک','14900',0,'طبیعت، گل و میوه، ادویه- گرم و تند','چوب تازه و نارنگی','ادویه‌جات تند','سدر و عنبر',30,'شیشه','34-10732','','','','ایران','<p>ترکیبی از بوی چوب تازه، رایحه نارنگی و ادویه&zwnj;جات (هل و فلفل) به همراه عصاره گشنیز، زنبق زرد و یاس که در پایان بوئی قوی و دلچسب از عطر چوب سدر و عنبر بجای می&zwnj;گذارد. عطری سزشار از بوی تازگی و نشاط مناسب برای استفاده در طول روز برای خانم&zwnj;های خوش سلیقه و پر مشغله امروز.</p>','بانوان','0','e','ir',0,0,0,1,'2019-06-02 11:22:23','2019-08-13 12:14:20'),('4B75BD98-82E3-491F-9737-4EB14AF52097',28,0,'عطر دات کالکشن شماره 2','7.5','1392','بیک','14900',0,'چوب و گیاه- گرم','چوب سندل','عنبر','سدر و مشک',30,'شیشه','34-10732','','','','ایران','<p>عطر دات کالکشن شماره 2</p>\r\n\r\n<p>مناسب برای آقایان</p>\r\n\r\n<p>این اسپری با رایحه بسیار پیچیده خود به آقایان کمک می&zwnj;کند ابعاد اسرارآمیز وجود خود را تقویت کنند. رایحه دلفریب آن بازتابی از باطن اغوا کننده&zwnj;اش است و در تمامی شرایط باعث احساس سرزندگی و اعتماد به نفس می&zwnj;شود. جذابیت آقایان با استفاده از رایحه هوس&zwnj;انگیز این عطر دوچندان می&zwnj;گردد.</p>','آقایان','0','e','ir',0,0,0,1,'2019-06-01 12:49:49','2019-08-17 11:09:27'),('4E00D032-9F21-4AFB-A114-46D966B7BAED',81,0,'رپیتون شماره 07','50','1392','بیک','94800',10,'میوه، گل، گیاه- خنک','ترنج','آناناس','گل رز',200,'شیشه','34/10732','','','','ایران','<p>الهام گرفته از زندگی، جنگ و صلح فرماندهان بزرگ جنگی که قدرت، مهربانی و امید را زنده نگه می&zwnj;دارد. رایحه&zwnj;های این عطر ترکیبی از انگور سیاه، ترنج، سیب و آناناس برای نت آغازین و برای نت اصلی، گل رز جاسمین و در نهایت پایانی آرام به همراه رایحه بلوط، مشک و وانیل دارد.</p>','آقایان','0','e','ir',0,0,0,1,'2019-08-07 12:32:57','2019-08-13 15:24:35'),('51042BAF-0C86-4FAC-BD58-4772FF2CBE69',49,0,'عطر بیک شماره 11','7.5','1376','بیک','14900',0,'میوه و گل- خنک','رز و سنبل','لیمو','ترنج و پرتقال تونسی',30,'شیشه','34-10732','','','','ایران','<p>احساس شناوری در فضایی از عطر میوه&zwnj;های تازه و گل&zwnj;های لطیف که دختران جوان و پرانرژی را به سوی خود جذب و آنان را در تمامی لحظات جوانی و نشاط همراهی می&zwnj;کند.</p>','بانوان','0','e','ir',0,0,0,1,'2019-06-02 10:26:40','2019-08-13 13:02:13'),('5111B3C4-2887-4F8C-A0EE-C78CDBDCC18B',33,0,'عطر دات کالکشن شماره 7','7.5','1392','بیک','14900',0,'گل و گیاه- خنک و ملایم','یاس','عنبر و مشک','نعناع هندی',30,'شیشه','34-10732','','','','ایران','<p>عطر دات کالکشن شماره 7</p>\r\n\r\n<p>مناسب برای بانوان</p>\r\n\r\n<p>این رایحه مدرن، مناسب بانوان فاخر امروزی و بسیار زنانه است. رایحه آن گیرا، با نشاط و فریبنده و در عین حال روشن و ملایم است. این عطر&nbsp;رایحه دلفریبی از نت&zwnj;های گل یاس را در فضا پراکنده می&zwnj;سازد و نت&zwnj;های پایه آن که ترکیبی از عنبر، مشک و نعناع هندی هستند عطری بسیار وسوسه&zwnj;انگیز را ایجاد می&zwnj;کنند.</p>','بانوان','0','e','ir',0,0,0,1,'2019-06-01 13:03:38','2019-08-17 11:22:34'),('5236E3AE-A2ED-4BE0-AB85-21E7252D40EB',34,0,'عطر دات کالکشن شماره 8','7.5','1392','بیک','14900',0,'مرکبات و گیاه- خنک','سدر، نعناع هندی','گریپ فروت و لیمو','عنبر',30,'شیشه','34-10732','','','','ایران','<p>عطر دات کالکشن شماره 8</p>\r\n\r\n<p>مناسب برای آقایان</p>\r\n\r\n<p>عطری برازنده و امروزی مناسب آقایان خوش سلیقه. این عطر بی&zwnj;نهایت ماندگار و رایحه آن ترکیب موزونی از سدر، نعناع هندی و خس&zwnj;خس است که در نهایت رایحه&zwnj;ای شگفت&zwnj;انگیز و اروماتیک را تشکیل می&zwnj;دهد.</p>','آقایان','0','e','ir',0,0,0,1,'2019-06-01 13:05:50','2019-08-17 11:23:59'),('5991C7CB-6CEB-4D4E-8D47-72828D66D4E6',38,0,'عطر دات کالکشن شماره 12','7.5','1392','بیک','14900',0,'جنگل و طبیعت- خنک','نعناع هندی','سرخس','چوب سندل',30,'شیشه','34-10732','','','','ایران','<p>عطر دات کالکشن شماره 12</p>\r\n\r\n<p>مناسب برای آقایان</p>\r\n\r\n<p>این عطر با رایحه&zwnj;ای پرنشاط و پرانرژی، مردانگی و وقار دائمی را برای آقایان امروزی به ارمغان می&zwnj;آورد. رایحه ملایم، نیروبخش و باشکوه آن، روز پیش رویتان را تبدیل به تجربه&zwnj;ای از لذت حقیقی می&zwnj;گرداند.</p>','آقایان','0','e','ir',0,0,0,1,'2019-06-01 13:16:23','2019-08-17 11:05:03'),('5C6D18F5-9FB7-4130-951F-AB69B8A6EC36',58,0,'عطر بیک شماره 20','7.5','1376','بیک','14900',0,'گل و مرکبات- گرم و ملایم','وانیل','میخک و گل ابریشم','نارنج',30,'شیشه','34-10732','','','','ایران','<p>ترکیبی قوی و احساس برانگیز از وانیل معطر، عنبر و ادویه که همراهی میخک و گل ابریشم و عطر میوه&zwnj;ها بویژه عطر ملایم نارنج بر طراوت آن می&zwnj;افزاید. عطری شورانگیز و افسونگر مناسب بانوان برای استفاده در اوقات فراغت شبانه.</p>','بانوان','0','e','ir',0,0,0,1,'2019-06-02 11:10:03','2019-08-13 12:09:35'),('61789D20-FCAA-46B6-8D55-AD86391AB256',46,0,'عطر بیک شماره 8','7.5','1376','بیک','14900',10,'میوه، گل، طبیعت- خنک','یاس و شکوفه','پرتقال','چوب',30,'شیشه','34-10732','','','','ایران','<p>معجونی از عطر میوه&zwnj;ها و سپس دست&zwnj;چینی از گرمی و جاذبه گل ایلانگ، یاس و شکوفه پرتقال و در آخر رایحه&zwnj;ای رمزآلود از مشک، چوب و عنبر که خاطره&zwnj;ای دلپذیر از ساعت فراغت شبانه به جای می&zwnj;گذارد.</p>','بانوان','0','e','ir',0,0,0,1,'2019-06-02 10:15:55','2019-08-13 15:27:34'),('621DC7A3-CE93-4BE0-90CD-D8147C51ED75',25,0,'اسپری بدن شماره 11','150','1392','بیک','24000',0,'گل و میوه- گرم و شیرین','هلو','وانیل','انبه',100,'قوطی','1024-ظ-30','','','','ایران','<p>اسپری شماره 11&nbsp;بیک</p>\r\n\r\n<p>مناسب برای بانوان</p>\r\n\r\n<p>رایحه&zwnj;ای بسیار برازنده و مدرن که نت&zwnj;های گلی و میوه&zwnj;ای آن بسیار نشاط&zwnj;آور و ترکیب متعادلی از رایحه شیرین و پودری هستند. این عطر امروزی را دوشیزگان و بانوان شیک و خوش&zwnj;پوش ایرانی برگزیده&zwnj;اند.</p>','بانوان','0','e','ir',0,0,0,1,'2019-06-01 12:20:33','2019-08-13 12:57:32'),('638012E0-EFB1-4BEB-A7DB-3992AF312630',85,0,'رپیتون شماره 03','50','1392','بیک','94800',0,'گل و میوه- گرم و ملایم','گل‌های بهاری','ارکیده','وانیل',200,'قوطی','34/10732','','','','ایران','<p>رایحه&zwnj;ای از میوه&zwnj;ها به همراه گل&zwnj;های بهاری با طعم ارکیده و وانیل که ترکیبی خوشبو ساخته است. این رایحه توجه را به سمت شخص زیبایی که آن را استفاده کرده جلب می&zwnj;نماید.</p>','بانوان','0','e','ir',0,0,0,1,'2019-08-07 13:25:40','2019-08-13 10:56:13'),('65168193-0B33-4BD8-9FE5-955C0C04AAA2',18,0,'اسپری بدن شماره 4','150','1392','بیک','24000',0,'مرکبات، چوب، ادویه- گرم','اسطوخودوس','شمعدانی و بنفشه','عنبر و مشک',100,'قوطی','1024-ظ-30','','','','ایران','<p>اسپری شماره 4&nbsp;بیک</p>\r\n\r\n<p>مناسب برای آقایان</p>\r\n\r\n<p>این اسپری رایحه&zwnj;ای پر انرژی و جذاب دارد که حاصل نت&zwnj;های پرنشاط اروماتیک و نیروی ادویه&zwnj;ها و چوب&zwnj;های خوشبو است. تونالیته&zwnj;هایی از عطر مرکبات با نت&zwnj;های بی&zwnj;نهایت مردانه و اروماتیک اسطوخودوس، شمعدانی و بنفشه سبز به مشام می&zwnj;رسد. بوی خوش جوز هندی احساس گرمی و راحتی را آفریده و بوی چوب، عنبر و مشک آن تاثیر این آفرینش را دو چندان می&zwnj;سازد.</p>','آقایان','0','e','ir',0,0,0,1,'2019-06-01 11:02:27','2019-08-13 12:43:24'),('65C5D195-4194-4E61-8FF6-6DE968C4088A',48,0,'عطر بیک شماره 10','7.5','1376','بیک','14900',0,'مرکبات و طبیعت- خنک','پرتقال و نارنج','برگ نعناع','لیمو',30,'شیشه','34-10732','','','','ایران','<p>رایحه ملایم پرتقال و نارنج تازه به همراه بوی نسیم دریایی، احساس جوانی و طراوت را به ارمغان آورده و بوی خوش آن همچون پوست دیگری روی پوست شما قرار می&zwnj;گیرد. این عطر نشاط و شادابی را به شما هدیه می&zwnj;کند.</p>','بانوان- آقایان','0','e','ir',0,0,0,1,'2019-06-02 10:23:05','2019-08-13 13:01:59'),('68F4D696-B355-44F3-8C3D-6710CEEBBFD5',40,0,'عطر بیک شماره 2','7.5','1376','بیک','14900',0,'مرکبات، طبیعت- خنک','سرخس','لیمو','چوب',30,'شیشه','24-10732','','','','ایران','<p>رایحه&zwnj;ای به طراوت سبزه&zwnj;زارها، آمیزش عطر جنگل و درخت لیمو که به جوانان فعال شادابی و نیرو می&zwnj;بخشد.</p>','بانوان- آقایان','0','e','ir',0,0,0,1,'2019-06-02 09:57:01','2019-08-13 11:21:07'),('69F0627C-C773-478D-9773-82012C501239',71,0,'کرم 200ml','200','1397','بیک','27000',0,'','','','',230,'قوطی','56/18077','E','دست، صورت و بدن','','ایران','<p>کرم مرطوب&zwnj;کننده پوست دست، صورت و بدن<br />\r\nحاوی روغن آلوئه&zwnj;ورا و روغن بادام<br />\r\nمناسب برای انواع پوست<br />\r\nمناسب برای تمام افراد خانواده<br />\r\nفاقد پارابن</p>','بانوان- آقایان','0','e','ir',0,0,0,1,'2019-08-07 11:34:00',NULL),('6A49C1C3-6947-4633-AA62-FD2AA77B5E14',86,0,'رپیتون شماره 02','50','1392','بیک','94800',0,'گل و گیاه- خنک','گل‌های بهاری','لیمو، پرتقال تونسی','جاسمین',200,'شیشه','34/10732','','','','ایران','<p>رایحه عشق و لحظات رمانتیک که اکسیر حال خوب است. رایحه&zwnj;ای برای از خودگذشتگی در عشق، یکی شدن، اغواگری، با ترکیبی از لبخند گل&zwnj;های بهاری و خوش بینی یک رابطه عاشقانه، بوی تونیک لیمو به همراه پرتقال تونسی و از همه مهمتر جاسمین خوش&zwnj;بوی باغ&zwnj;های بهشت.</p>','بانوان','0','e','ir',0,0,0,1,'2019-08-07 13:28:51','2019-08-13 10:53:31'),('70C3AF41-4902-49D8-83C4-97ECEB908643',27,0,'عطر دات کالکشن شماره 1','7.5','1392','بیک','14900',0,'گل و میوه- گرم','رز','عنبر ','وانیل',30,'شیشه','34-10732','','','','ایران','<p>عطر دات کالکشن شماره یک</p>\r\n\r\n<p>مناسب برای بانوان</p>\r\n\r\n<p>ترکیبی هنرمندانه از گل&zwnj;های معطر و میوه&zwnj;های خوشبو که رز و عنبر آن را همراهی کرده و عطر رمزآلود و هیجان&zwnj;انگیز آفریده که در پایان رایحه جادویی وانیل آن شما را به لذت بیشتر از لحظات زندگی دعوت می&zwnj;نماید.</p>','بانوان','0','e','ir',0,0,4,1,'2019-06-01 12:46:26','2019-08-17 11:07:09'),('737D040E-6F17-4B2A-9024-6355FC633EEC',17,0,'اسپری بدن شماره 3','150','1392','بیک','24000',0,'مرکبات، میوه، چوب- گرم و ملایم','ترنج و پرتقال','مشک','چوب',100,'قوطی','1024-ظ-30','','','','ایران','<p>اسپری شماره 3&nbsp;بیک</p>\r\n\r\n<p>مناسب برای بانوان</p>\r\n\r\n<p>این رایحه سرشار از شور جوانی، عشق و شادی است. این رایحه انرژی&zwnj;بخش و سرزنده، آمیزه&zwnj;ای از نت&zwnj;های مرکبات و میوه و ترکیبی از رایحه دلفریب مشک و نت&zwnj;های چوبی است</p>','بانوان','0','e','ir',0,0,0,1,'2019-06-01 10:46:15','2019-08-13 12:37:44'),('743293CB-83B9-4F02-8366-A178D544E482',92,0,'میلانو مشکی مات','100','1386','بیک','106800',0,'طبیعت- گرم و شیرین','برگاموت','چای سبز','شاه توت',230,'شیشه','34/14991','','','','ایران','<p>یک رایحه مردانه اصیل که مانند رودهای کوه آلپ پرقدرت و باشکوه در فضای وحشی کوهستان جاری می&zwnj;شود. نت آغازین با بوی برگاموت و ماندارین شروع می&zwnj;شود که بوی چای سبز و شاه&zwnj;توت حس طبیعت آن را کامل می&zwnj;کند در نت میانی ماسک و سندل گرمای عشق را انتقال می&zwnj;دهد.</p>','آقایان','0','e','ir',0,0,0,1,'2019-08-07 15:36:10','2019-08-13 10:41:38'),('7DBF4779-78D3-4FEF-8B09-3682E7952ABB',55,0,'عطر بیک شماره 17','7.5','1376','بیک','14900',0,'مرکبات، گل، گیاه- خنک','نارنگی و گریپ‌فروت','نعناع، چوب سندل','ریحان و گل یاسمن',30,'شیشه','34-10732','','','','ایران','<p>رایحه نشاط&zwnj;بخش از نارنگی، گریپ فروت و لیمو که زیرمایه احساس برانگیز نعناع هندی، چوب صندل، سدر و وانیل را به همراه خود دارد و در انتها بوی جادویی بادام، برگ&zwnj;های ریحان و گل یاسمن تازه است که باقی می&zwnj;ماند. عطری است که مردانگی را در اوج القا کرده و جذابیت و اعتماد به نفس را به شما هدیه می&zwnj;کند.</p>','آقایان','0','e','ir',0,0,0,1,'2019-06-02 10:59:55','2019-08-13 13:03:55'),('7FC8C58E-F723-4E90-8FFE-C48AA9242201',29,0,'عطر دات کالکشن شماره 3','7.5','1392','بیک','14900',0,'مرکبات، میوه، چوب- گرم و ملایم','ترنج و پرتقال','مشک','چوب',30,'شیشه','34-10732','','','','ایران','<p>عطر دات کالکشن شماره 3</p>\r\n\r\n<p>مناسب برای بانوان</p>\r\n\r\n<p>این رایحه سرشار از شور جوانی، عشق و شادی است. این رایحه انرژی&zwnj;بخش و سرزنده، آمیزه&zwnj;ای از نت&zwnj;های مرکبات و میوه و ترکیبی از رایحه دلفریب مشک و نت&zwnj;های چوبی است.</p>','بانوان','0','e','ir',0,0,0,1,'2019-06-01 12:52:38','2019-08-17 11:12:41'),('8032FC4C-6085-431B-9C43-8E8D01739649',31,0,'عطر دات کالکشن شماره 5','7.5','1392','بیک','14900',0,'گل، مرکبات- گرم و ملایم','لیمو و پرتقال','یاسمن هندی','بنفشه',30,'شیشه','34-10732','','','','ایران','<p>عطر دات کالکشن شماره 5</p>\r\n\r\n<p>مناسب برای بانوان</p>\r\n\r\n<p>رایحه&zwnj;ای اعتیادآور و جوان&zwnj;پسند، مناسب افرادی است که جرات واقعیت بخشیدن به رویاهای خود را دارند. رایحه&zwnj;ای ملایم و به طرز زیرکانه&zwnj;ای هوس&zwnj;انگیز. این عطر سرشار از سرزندگی و انرژی است.</p>','بانوان','0','e','ir',0,0,0,1,'2019-06-01 12:57:51','2019-08-17 11:15:52'),('8BB62DFF-56E2-4FA9-B9E3-05C525E387BC',19,0,'اسپری بدن شماره 5','150','1392','بیک','24000',0,'گل، مرکبات- گرم و ملایم','لیمو و پرتقال','یاسمن هندی','بنفشه',100,'قوطی','1024-ظ-30','','','','ایران','<p>اسپری شماره 5&nbsp;بیک</p>\r\n\r\n<p>مناسب برای بانوان</p>\r\n\r\n<p>رایحه&zwnj;ای اعتیادآور و جوان&zwnj;پسند، مناسب افرادی است که جرات واقعیت بخشیدن به رویاهای خود را دارند. رایحه&zwnj;ای ملایم و به طرز زیرکانه&zwnj;ای هوس&zwnj;انگیز. این عطر سرشار از سرزندگی و انرژی است.</p>','بانوان','0','e','ir',0,0,0,1,'2019-06-01 11:13:14','2019-08-13 12:45:35'),('8E89A704-D91A-4296-96B3-08E78A5C2F11',97,0,'میس‌تین طلایی','50','1392','بیک','65000',0,'میوه و مرکبات- گرم','ترنج و گلابی','عنبر','مشک',100,'شیشه','34/14953','','','','ایران','<p><span dir=\"RTL\">رایحه&zwnj;ای با طراوت و تازگی شکوفه&zwnj;های پرتقال و گل ابریشم، ترنج و گلابی که سبک بال به پرواز درآمده و با گذر از میوه&zwnj;ها با گرمایی&nbsp;از عنبر و مشک سر زندگی و نشاط را به ارمغان می آورد.</span></p>','بانوان','0','e','ir',0,0,0,1,'2019-08-07 16:17:23','2019-08-13 10:28:10'),('90CCED8D-5C8D-4854-B2C1-DD53DF0A9CFC',57,0,'عطر بیک شماره 19','7.5','1376','بیک','14900',10,'گل- گرم','جاسمین','رز','وانیل',30,'شیشه','34-10732','','','','ایران','<p>رایحه&zwnj;ای که در برخورد اول غیر قابل اغماض است همانند عشق در نگاه اول. عطری متشکل از بوهای هیجان&zwnj;انگیز یک کوکتل از گل&zwnj;های بهاری جاسمین، فریزیای آفریقایی، رز و بوی مسخ کننده وانیل که حس بودن در یک باغ شرقی را به شما می&zwnj;دهد.</p>','بانوان','0','e','ir',0,0,0,1,'2019-06-02 11:06:38','2019-08-13 15:26:43'),('9143332D-EEDB-4330-8CBB-4C294DF6095F',83,0,'رپیتون شماره 05','50','1392','بیک','94800',0,'گل، ادویه تند، طبیعت- گرم و تند','گل مریم و رایحه شکلاتی','چوب‌های جنگلی','وانیل',200,'شیشه','34/10732','','','','ایران','<p>در این عطر بوی میوه و گل خیلی سریع شروع می&zwnj;شود و بوی فلفل قرمز را تداعی می&zwnj;کند، بوی گل مریم و رایحه شکلاتی آن، رایحه&zwnj;ای اثرگذار را به ارمغان می&zwnj;آورد، رایحه اصلی آن چوب&zwnj;های جنگلی و وانیل می&zwnj;باشد.</p>','بانوان','0','e','ir',0,0,0,1,'2019-08-07 12:40:36','2019-08-13 11:00:36'),('926D9CFF-3643-42CA-9516-D5A0ED9411AC',54,0,'عطر بیک شماره 16','7.5','1376','بیک','14900',10,'گل، میوه، طبیعت- گرم و ملایم','یاس و سوسن','انبه، میوه‌های قرمز','مشک و وانیل',30,'شیشه','34-10732','','','','ایران','<p>عطر سبدی از گل&zwnj;های شاداب و با طراوت یاس هندی، بنفشه و سوسن سفید که همراه عطر میوه&zwnj;های آبدار و خوش رنگ و بوی آناناس، انبه، هندوانه، گلابی و میوه&zwnj;های قرمز که ترکیب آن با عطر پر طراوت چوب&zwnj;های خوشبو، مشک و درخت وانیل از آن اکسیری جادویی بوجود آورده است. عطری قوی است پر از رمز و راز همچون دنیای شبانه خانم&zwnj;های شاد، با شخصیت و مصمم.</p>','بانوان','0','e','ir',0,0,0,1,'2019-06-02 10:56:21','2019-08-13 15:27:01'),('961EBEC0-0CCD-41D1-AF7C-C2749DBA0495',22,0,'اسپری بدن شماره 8','150','1392','بیک','24000',0,'مرکبات و گیاه- خنک','سدر، نعناع هندی','گریپ فروت و لیمو','عنبر',100,'قوطی','1024-ظ-30','','','','ایران','<p>اسپری شماره 8 بیک</p>\r\n\r\n<p>مناسب برای آقایان</p>\r\n\r\n<p>عطری برازنده و امروزی مناسب آقایان خوش سلیقه. این عطر بی&zwnj;نهایت ماندگار و رایحه آن ترکیب موزونی از سدر، نعناع هندی و خس&zwnj;خس است که در نهایت رایحه&zwnj;ای شگفت&zwnj;انگیز و اروماتیک را تشکیل می&zwnj;دهد.</p>','آقایان','0','e','ir',0,0,0,1,'2019-06-01 12:05:41','2019-08-13 12:50:44'),('96686A35-C9D0-4061-B284-5330255F0936',51,0,'عطر بیک شماره 13','7.5','1376','بیک','14900',0,'گل و مرکبات و طبیعت- خنک و ملایم','لیمو و نارنگی','چوب','سرو و سدر',30,'شیشه','34-10732','','','','ایران','<p>عطری جدید مخصوص آقایان با رایحه&zwnj;ای ویژه، ترکیبی از بوی ملایم گل&zwnj;ها، لیمو ترش و نارنگی در زمینه&zwnj;ای از بوی چوب&zwnj;های درخت سرو و سدر که باعث ماندگاری عطر شده و بر قدرت مردانگی آن می&zwnj;افزاید. عطری با طراوت و جذاب برای مردان امروز که دارای افکار برجسته&zwnj;ای هستند.</p>','آقایان','0','e','ir',0,0,0,1,'2019-06-02 10:33:50','2019-08-13 13:02:55'),('96BAB1B0-6DAD-4BFB-8989-891428A49541',39,0,'عطر بیک شماره 1','7.5','1376','بیک','14900',0,'جنگل و طبیعت- گرم و تند','مشک','سرخس','درختان جنگلی',30,'شیشه','34-10732','','','','ایران','<p>&nbsp;</p>\r\n\r\n<p>مردانه، غنی و پر قدرت، آمیخته&zwnj;ای از مشک و سرخس و عطرهای جنگلی که در کمال قدرت هرگز خود را تحمیل نمی&zwnj;کند. مطمئن همچون کسی که آن را بکار میگیرد.</p>','آقایان','0','e','ir',0,0,0,1,'2019-06-02 09:52:50','2019-08-13 12:59:41'),('9C27F1CA-45C3-463F-8D4A-C24034198DE8',98,0,'میلُرد مشکی','30','1392','بیک','50000',0,'مرکبات و گیاه- خنک','سرو','مشک و چوب کشمیری','گیاه بوربُن',80,'شیشه','34/14953','','','','ایران','<p><span dir=\"RTL\">نسیمی سرشار از طراوت روستا و درختان سرو آن وزیدن گرفته و پس از گذر از گرمای مشک و چوب کشمیری، ردّی از دو گیاه جانبخش&nbsp;</span>Bourbon<span dir=\"RTL\">و&nbsp;</span>&nbsp; Haitian<span dir=\"RTL\"> از خود بجا می&zwnj;گذارد.</span></p>','آقایان','0','e','ir',0,0,0,1,'2019-08-07 16:20:47','2019-08-13 10:23:57'),('9DB11435-97DC-4882-9E3A-C25AB0E5C913',96,0,'میس‌تین بنفش','50','1392','بیک','65000',10,'طبیعت- گرم','عنبر سفید','یاسمن هندی','مشک',100,'شیشه','34/14953','','','','ایران','<p><span dir=\"RTL\">رایحه&zwnj;ای قوی و گرم چون عنبر سفید و جنگل&zwnj;های کشمیر و گل&zwnj;های یاسمن هندی، اکسیری اسرارآمیز و رمزآلود که همگان را شیفته و فریفته خود می&zwnj;سازد.</span></p>','بانوان','0','e','ir',0,0,0,1,'2019-08-07 16:14:49','2019-08-13 15:24:17'),('A4F3691E-A2E4-48B0-867B-FDD1F19AEFB1',93,0,'میلانو مشکی براق','100','1386','بیک','106800',0,'میوه، مرکبات، طبیعت- گرم','سیب','مرکبات','چوب سندل',230,'شیشه','34/14991','','','','ایران','<p>رایحه&zwnj;ای تازه، نافذ با بوی چوب که شما را محسور می&zwnj;کند. نت آغازین با بوی سیب و مرکبات که با عطر گل&zwnj;های باغ&zwnj;های معلق بابل حس یک مرد قدرتمند را منتقل می&zwnj;نماید. رایحه سندل نت اصلی این عطر می&zwnj;باشد.</p>\r\n\r\n<p>&nbsp;</p>','آقایان','0','e','ir',0,0,0,1,'2019-08-07 15:39:18','2019-08-13 10:40:09'),('A87E78B3-1AA8-4B7A-8A03-27C728C2ED36',36,0,'عطر دات کالکشن شماره 10','7.5','1392','بیک','14900',0,'میوه، مرکبات، گیاه- خنک و ملایم','ترنج و نارنگی','هل سبز و توت وحشی','سدر، مشک و عنبر',30,'شیشه','34-10732','','','','ایران','<p>عطر دات کالکشن شماره 10</p>\r\n\r\n<p>مناسب برای آقایان</p>\r\n\r\n<p>رایحه این عطر با نت&zwnj;های بالایی ترنج و نارنگی آغاز و به نت&zwnj;های میانی مرکب از میوه&zwnj;های آبدار و هل سبز و توت وحشی می&zwnj;رسد و در انتها با نت&zwnj;های پایه آن یعنی خس&zwnj;خس، سدر، مشک و عنبر خاتمه می&zwnj;یابد.</p>','آقایان','0','e','ir',0,0,0,1,'2019-06-01 13:11:56','2019-08-17 11:26:24'),('B180DF24-CC8A-4BA6-9373-8CFC7B25362F',89,0,'میلانو سبز','100','1386','بیک','106800',0,'جنگل و طبیعت- گرم و تند','چوب','ادویه جات تند','سرخس',230,'شیشه','34/14991','','','','ایران','<p>طراوتی مطبوع و اطمینان&zwnj;بخش که احساس را نوازش می&zwnj;کند. عطری که در ابتدا با طراوت چوب جنگلی، تندی ادویه&zwnj;جات و سرزندگی گیاه سرخس حسی غریب، تازه و پاک را القاء کرده و سپس تجربه&zwnj;ای از مشک سفید، عنبر و دانه تونکا را به شما هدیه می&zwnj;کند.</p>','آقایان','0','e','ir',0,0,0,1,'2019-08-07 15:24:31','2019-08-13 10:48:13'),('B5AB5B04-485C-4FAC-9236-EE98F920BE15',45,0,'عطر بیک شماره 7','7.5','1376','بیک','14900',0,'گل و میوه- خنک و ملایم','رز و جاسمین','شکوفه‌های بهاری','پرتقال',30,'شیشه','34-10732','','','','ایران','<p>آمیخته&zwnj;ای هماهنگ از رایحه لطیف گل&zwnj;ها و میوه&zwnj;های معطر برای روزهای پرمشغله زن امروز. عطری که جذابیت و جدیت را به شما هدیه می&zwnj;دهد.</p>','بانوان','0','e','ir',0,0,0,1,'2019-06-02 10:13:14','2019-08-13 13:00:35'),('B699E075-128A-497C-ABF5-B0CE6616D43D',95,0,'میلانو سفید براق','100','1386','بیک','106800',0,'میوه و مرکبات- خنک','لیمو','پرتقال','ماسک',230,'شیشه','34/14991','','','','ایران','<p>رایحه&zwnj;ای مخصوص بانوان جذاب و جوان که جذابیت آنها را دو چندان می&zwnj;نماید. عاشقانه&zwnj;ای نانوشته اما خوشبو. شمیم عشق در این عطر جاریست که سرشار از شیطنت، شادابی و سرزندگی است. استفاده از این عطر حس رهایی در عین وابستگی را به شما می&zwnj;دهد که نتیجه بوی میوه&zwnj;های تازه، مرکبات و شکوفه&zwnj;های بهاریست. در نت اصلی رایحه ماسک خاطرات این عطر را ماندگار می&zwnj;کند.</p>','بانوان','0','e','ir',0,0,0,1,'2019-08-07 16:03:58','2019-08-13 10:35:11'),('B7049A17-7A49-42D0-A9EE-972814CC6F99',47,0,'عطر بیک شماره 9','7.5','1376','بیک','14900',0,'میوه، طبیعت- خنک','نارنگی و لیمو','مشک','چوب سندل',30,'شیشه','34-10732','','','','ایران','<p>عطری بی&zwnj;همتا برای مردان امروز همراه با احساس خنکی دلچسب با دست&zwnj;چینی از عطر میوه&zwnj;های تازه چون هندوانه، نارنگی و لیمو در ابتدا و به دنبال آن بوی مشک و صندل ویژگی&zwnj;های منحصر به فردی داشته که در تمام سال می&zwnj;توان از آن استفاده کرد.</p>','آقایان','0','e','ir',0,0,0,1,'2019-06-02 10:19:45','2019-08-13 13:01:00'),('B9215844-2ABC-46E4-A9DB-FA4C46075BBC',88,0,'میلانو آبی','100','1386','بیک','106800',0,'میوه، گل، مرکبات- خنک','لیمو و نارنج','گل رز','مشک',250,'شیشه','34/14991','','','','ایران','<p>سرشار از حس سرزندگی و نشاط، آمیزه&zwnj;ای اصیل از از تازگی، بوی گل&zwnj;های لیمو و نارنج، خنکی نعنا و گرمی میوه&zwnj;های استوایی، بدنبال آن رایحه&zwnj;ای از چوب گل رز، طراوت خزه&zwnj;های دریایی و تندی زنجبیل، در نهایت عطر چوب درخت صندل و مشک آهوی جنگل که احساس واقعی از مردانگی را تقدیم می&zwnj;نماید.</p>','آقایان','0','e','ir',0,0,0,1,'2019-08-07 15:09:30','2019-08-13 10:49:52'),('C0C1FD32-358E-4DEF-995A-A58B0CEEABC5',91,0,'میلانو طلایی','100','1386','بیک','106800',0,'گل و گیاه- گرم','سنبل','مشک سفید','نعناع هندی',230,'شیشه','34/14991','','','','ایران','<p>اکسیری احساس برانگیز، آمیزه&zwnj;ای از عطر سنبل، مشک سفید و نعناع هندی، رایحه&zwnj;ای منحصر بفرد، سرشار از انرژی، مخصوص بانوانی که مشتاق هیجان، شگفت&zwnj;انگیزی و احساسات هستند.</p>','بانوان','0','e','ir',0,0,0,1,'2019-08-07 15:33:00','2019-08-13 10:43:14'),('C33B2B3D-0F1D-4424-9873-504293E4A313',79,0,'رپیتون شماره 09','50','1392','بیک','94800',0,'مرکبات، میوه، گیاه- گرم','ترنج','آناناس','سندل',200,'شیشه','34/10732','','','','ایران','<p>رایحه&zwnj;ای برای مردانی با اعتماد به نفس بالا و عزمی راسخ که رایحه&zwnj;ای جذاب و در عین حال آرام دارد. این کنتراست به پیچیدگی این عطر می&zwnj;افزاید که مخاطب را مسخ می&zwnj;کند. نت آغازین آن ترنج، آناناس و بوی برگ&zwnj;های جنگلی است. نت اصلی آن صندل جادویی است.</p>','آقایان','0','e','ir',0,0,0,1,'2019-08-07 12:24:22','2019-08-13 11:07:42'),('C9E27FE6-E736-4542-BA77-99C9F44C4E62',84,0,'رپیتون شماره 04','50','1392','بیک','94800',0,'طبیعت، مرکبات، میوه- خنک','پرتقال','جاسمین','هلو و شاه توت',200,'شیشه','34/10732','','','','ایران','<p>این رایحه متمرکز است بر روی زیبایی، سادگی&nbsp;و خوشحالی درونی. بویی که زندگی را تداعی می&zwnj;کند و لذت&zwnj;های کوچک را به شما یادآوری می&zwnj;کند. این ترکیب شیرین و در عین حال ظریف متشکل از شکوفه&zwnj;های پرتقال و رایحه جاسمین است و اگر با دقت بو کنید. رایحه هلو و شاه&zwnj;توت را نیز استشمام خواهید کرد. بوی وانیل را در آن نمی&zwnj;توان نادیده گرفت.</p>','بانوان','0','e','ir',0,0,0,1,'2019-08-07 12:46:05','2019-08-13 10:57:30'),('CD262E52-FBEF-4F49-90FB-9EAF2A7B0B59',30,0,'عطر دات کالکشن شماره 4','7.5','1392','بیک','14900',0,'مرکبات، چوب، ادویه- گرم','اسطوخودوس','شمعدانی و بنفشه','عنبر و مشک',30,'شیشه','34-10732','','','','ایران','<p>عطر دات کالکشن شماره 4</p>\r\n\r\n<p>مناسب برای آقایان</p>\r\n\r\n<p>این اسپری رایحه&zwnj;ای پر انرژی و جذاب دارد که حاصل نت&zwnj;های پرنشاط اروماتیک و نیروی ادویه&zwnj;ها و چوب&zwnj;های خوشبو است. تونالیته&zwnj;هایی از عطر مرکبات با نت&zwnj;های بی&zwnj;نهایت مردانه و اروماتیک اسطوخودوس، شمعدانی و بنفشه سبز به مشام می&zwnj;رسد. بوی خوش جوز هندی احساس گرمی و راحتی را آفریده و بوی چوب، عنبر و مشک آن تاثیر این آفرینش را دو چندان می&zwnj;سازد.</p>','آقایان','0','e','ir',0,0,0,1,'2019-06-01 12:55:27','2019-08-17 11:14:04'),('CEAC5C92-DAB6-4CC7-ACEA-19F7DEB057ED',37,0,'عطر دات کالکشن شماره 11','7.5','1392','بیک','14900',0,'گل و میوه- گرم و شیرین','هلو','وانیل','انبه',30,'شیشه','34-10732','','','','ایران','<p>عطر دات کالکشن شماره 11</p>\r\n\r\n<p>مناسب برای بانوان</p>\r\n\r\n<p>رایحه&zwnj;ای بسیار برازنده و مدرن که نت&zwnj;های گلی و میوه&zwnj;ای آن بسیار نشاط&zwnj;آور و ترکیب متعادلی از رایحه شیرین و پودری هستند. این عطر امروزی را دوشیزگان و بانوان شیک و خوش&zwnj;پوش ایرانی برگزیده&zwnj;اند.</p>','بانوان','0','e','ir',0,0,0,1,'2019-06-01 13:14:03','2019-08-17 11:11:21'),('D84D3F3A-6443-4E52-888C-FF712A2CB969',41,0,'عطر بیک شماره 3','7.5','1376','بیک','14900',0,'گل و طبیعت- گرم و ملایم','رز ','سنبل','سرخس و سندل',30,'شیشه','24-10732','','','','ایران','<p>رایحه&zwnj;ای ظریف و شاعرانه برای هر روز و تمام روز بانوان. عطری به لطافت زمزمه گل&zwnj;ها و به شادابی بوستان&zwnj;های فرانسوی.</p>','بانوان','0','e','ir',0,0,0,1,'2019-06-02 10:00:26','2019-08-13 11:23:48'),('D87DA537-D2C4-4A0E-81E3-37C8D7CB83A6',26,0,'اسپری بدن شماره 12','150','1392','بیک','24000',0,'جنگل و طبیعت- خنک','نعناع هندی','سرخس','چوب سندل',100,'قوطی','1024-ظ-30','','','','ایران','<p>اسپری شماره 12 بیک</p>\r\n\r\n<p>مناسب برای آقایان</p>\r\n\r\n<p>این عطر با رایحه&zwnj;ای پرنشاط و پرانرژی، مردانگی و وقار دائمی را برای آقایان امروزی به ارمغان می&zwnj;آورد. رایحه ملایم، نیروبخش و باشکوه آن، روز پیش رویتان را تبدیل به تجربه&zwnj;ای از لذت حقیقی می&zwnj;گرداند.</p>','آقایان','0','e','ir',0,0,0,1,'2019-06-01 12:25:05','2019-08-13 12:58:35'),('DDB6685E-6C8D-42DC-88CC-BF85DB3A32E2',23,0,'اسپری بدن شماره 9','150','1392','بیک','24000',0,'چوب، گیاه، مرکبات- گرم و ملایم','لیمو و نارنگی','خس‌خس و نعناع هندی','چوب',100,'قوطی','1024-ظ-30','','','','ایران','<p>اسپری شماره 9 بیک</p>\r\n\r\n<p>مناسب برای بانوان</p>\r\n\r\n<p>عطری مرکب از گل&zwnj;های معطر و مرکبات بویژه لیمو و نارنگی، این نت&zwnj;ها احساس نشاط، شکوه، پاکی و هوس را به این عطر می&zwnj;بخشند. نت&zwnj;های خس&zwnj;خس و نعناع هندی، آمیزه بی&zwnj;همتایی از نت&zwnj;های چوبی هستند که باعث احساس پاکی در پایه این عطر می&zwnj;شوند.</p>','بانوان','0','e','ir',0,0,0,1,'2019-06-01 12:10:25','2019-08-13 12:53:03'),('E82A8826-D0EB-45C3-81F5-17B41D959067',59,0,'عطر بیک شماره 21','7.5','1376','بیک','14900',0,'گل، مرکبات، چوب- خنک','گریپ فروت و نعناع','شمعدانی و سنبل','سدر و مشک',30,'شیشه','34-10732','','','','ایران','<p>عطری با طراوت و هیجان&zwnj;انگیز از گریپ&zwnj;فروت، نعناع و سبزه&zwnj;زار که به همراه عطر خوش گشنیز و گل&zwnj;های شمعدانی و سنبل، رایحه&zwnj;ای دوست داشتنی بوجود آورده و در پایان خاطره&zwnj;ای از بوی چوب سدر و مشک از خود بجای می&zwnj;گذارد. عطری برای مردانی که در پی فرصت&zwnj;های طلایی بوده و همواره موفقیت را در تجربه&zwnj;های جدید جستجو می&zwnj;کنند.</p>','آقایان','0','e','ir',0,0,0,1,'2019-06-02 11:15:20','2019-08-13 12:11:25'),('E87F6E5C-E457-4BB7-A687-403DF33DC164',24,0,'اسپری بدن شماره 10','150','1392','بیک','24000',0,'میوه، مرکبات، گیاه- خنک و ملایم','ترنج و نارنگی','هل سبز و توت وحشی','سدر، مشک و عنبر',100,'قوطی','1024-ظ-30','','','','ایران','<p>اسپری شماره 10&nbsp;بیک</p>\r\n\r\n<p>مناسب برای آقایان</p>\r\n\r\n<p>رایحه این عطر با نت&zwnj;های بالایی ترنج و نارنگی آغاز و به نت&zwnj;های میانی مرکب از میوه&zwnj;های آبدار و هل سبز و توت وحشی می&zwnj;رسد و در انتها با نت&zwnj;های پایه آن یعنی خس&zwnj;خس، سدر، مشک و عنبر خاتمه می&zwnj;یابد.</p>','آقایان','0','e','ir',0,0,0,1,'2019-06-01 12:16:18','2019-08-13 12:56:07'),('EC90A684-BB4A-4FB2-B7FA-F6E89657844E',72,0,'کرم 100ml','100','1397','بیک','15000',0,'','','','',120,'قوطی','56/18077','E','دست، صورت و بدن','','ایران','<p>کرم مرطوب&zwnj;کننده پوست دست، صورت و بدن<br />\r\nحاوی روغن آلوئه&zwnj;ورا و روغن بادام<br />\r\nمناسب برای انواع پوست<br />\r\nمناسب برای تمام افراد خانواده<br />\r\nفاقد پارابن</p>','بانوان- آقایان','0','e','ir',0,0,0,1,'2019-08-07 11:35:24',NULL),('EDA93A0C-ACDD-48A5-B41E-581A518EF0F8',90,0,'میلانو قرمز','100','1386','بیک','106800',0,'گل و میوه- گرم و ملایم','آناناس، انبه','چوب‌های خوشبو، مشک','وانیل',230,'شیشه','34/14991','','','','ایران','<p>عطری از گل&zwnj;های شاداب و با طراوت یاس هندی، بنفشه و سوسن سفید همراه با رایحه&zwnj;ای از میوه&zwnj;های آبدار و خوش رنگ و بوی آناناس، هندوانه، انبه، گلابی و میوه&zwnj;های قرمز و ترکیبی از عطر پرطراوت چوب&zwnj;های خوشبو، مشک و درخت وانیل که از آن اکسیری جادویی بوجود آورده است. عطری است قوی، پر رمز و راز همچون دنیای شبانه خانم&zwnj;های شاد، باشخصیت و مصمم.</p>','بانوان','0','e','ir',0,0,0,1,'2019-08-07 15:29:32','2019-08-13 10:46:12'),('F31F2346-4D6F-4702-A28A-0C8841822CF2',66,0,'عطر بیک شماره 27','7.5','1376','بیک','14900',0,'میوه- گرم','میوه‌های قرمز','هلو','عنبر',30,'شیشه','34-10732','','','','ایران','<p>این عطر دارای رایحه&zwnj;ای میوه&zwnj;ای و گلی و ترکیبی از میوه&zwnj;های قرمز و میوه گل ساعتی، هلو و نت ملایمی از عنبر در پس آن است. رایحه آن بسیار اسرارآمیز، میوه&zwnj;ای، پرنشاط و مورد علاقه خانم&zwnj;های جوان است.</p>','بانوان','0','e','ir',0,0,0,1,'2019-08-07 10:14:48','2019-08-13 13:05:10'),('F3A4F5B6-22B1-4556-9529-8D3A0FF02034',67,0,'عطر بیک شماره 28','7.5','1376','بیک','14900',0,'گل و گیاه- گرم و ملایم','گل مریم و رز','نعناع هندی','وانیل',30,'شیشه','34-10732','','','','ایران','<p>این عطر موجی از طراوت بی&zwnj;نهایت و مرکب از نت&zwnj;های گلی و رایحه فریبنده نعناع هندی و وانیل است. رایحه آن جادویی از شادی و خوش&zwnj;شانسی را برای خانم&zwnj;ها به ارمغان می&zwnj;آورد.</p>','بانوان','0','e','ir',0,0,0,1,'2019-08-07 10:20:07','2019-08-13 12:30:15'),('F4D2C7E9-614C-4C93-85CB-54F7E2E215B3',35,0,'عطر دات کالکشن شماره 9','7.5','1392','بیک','14900',0,'چوب، گیاه، مرکبات- گرم و ملایم','لیمو و نارنگی','خس‌خس و نعناع هندی','چوب',30,'شیشه','34-10732','','','','ایران','<p>اسپری دات کالکشن شماره 9</p>\r\n\r\n<p>مناسب برای بانوان</p>\r\n\r\n<p>عطری مرکب از گل&zwnj;های معطر و مرکبات بویژه لیمو و نارنگی، این نت&zwnj;ها احساس نشاط، شکوه، پاکی و هوس را به این عطر می&zwnj;بخشند. نت&zwnj;های خس&zwnj;خس و نعناع هندی، آمیزه بی&zwnj;همتایی از نت&zwnj;های چوبی هستند که باعث احساس پاکی در پایه این عطر می&zwnj;شوند.</p>','بانوان','0','e','ir',0,0,0,1,'2019-06-01 13:08:00','2019-08-17 11:25:21'),('F97A879C-805A-467C-BB70-94846F0D5DAC',80,0,'رپیتون شماره 08','50','1392','بیک','94800',0,'مرکبات و گیاه- خنک','گریپ‌فروت','برگ‌های نخل','بلوط',200,'شیشه','34/10732','','','','ایران','<p>این عطر مردانه رایحه&zwnj;ای ورزشی و تازه دارد که تداعی کننده قدرت، پویایی و انرژی است. با رایحه&zwnj;ای از گریپ فروت شروع شده که با عطر برگ&zwnj;های نخل ساحل ادامه می&zwnj;یابد و در انتها بوی بلوط شما را مسخ می&zwnj;نماید.</p>','آقایان','0','e','ir',0,0,0,1,'2019-08-07 12:27:27','2019-08-13 11:06:15'),('FB9965B3-0BE2-4003-A306-DA8491F97B66',75,0,'کرم 20ml','20','1397','بیک','6000',0,'','','','',30,'قوطی','56/18077','E','دست، صورت و بدن','','ایران','<p>کرم مرطوب&zwnj;کننده پوست دست، صورت و بدن<br />\r\nحاوی روغن آلوئه&zwnj;ورا و روغن بادام<br />\r\nمناسب برای انواع پوست<br />\r\nمناسب برای تمام افراد خانواده<br />\r\nفاقد پارابن</p>','بانوان- آقایان','0','e','ir',0,0,0,1,'2019-08-07 11:40:01',NULL),('FE6416E9-6A17-43DA-8948-86C250F9C578',70,0,'کرم خانواده 450ml','450','1397','بیک','45000',0,'','','','',500,'قوطی پمپی','56/18077','E','دست، صورت و بدن','','ایران','<p>کرم مرطوب&zwnj;کننده پوست دست، صورت و بدن<br />\r\nحاوی روغن آلوئه&zwnj;ورا و روغن بادام<br />\r\nمناسب برای انواع پوست<br />\r\nمناسب برای تمام افراد خانواده<br />\r\nفاقد پارابن</p>\r\n\r\n<p>همراه با دو قوطی کوچک، مناسب برای قرار دادن در کیف</p>','بانوان- آقایان','0','e','ir',0,0,0,1,'2019-08-07 11:32:33',NULL);
/*!40000 ALTER TABLE `tbl_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_property`
--

DROP TABLE IF EXISTS `tbl_property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_property` (
  `propertyGUID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `propertyGroup` int(11) NOT NULL,
  `propertyTitle` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `propertyType` enum('1','2','3','4','5') COLLATE utf8_unicode_ci NOT NULL COMMENT '1->str,2->bool,3->text,4->chk,5->date',
  `propertyStatus` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`propertyGUID`),
  KEY `propertyGroup` (`propertyGroup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_property`
--

LOCK TABLES `tbl_property` WRITE;
/*!40000 ALTER TABLE `tbl_property` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_property` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_property_group`
--

DROP TABLE IF EXISTS `tbl_property_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_property_group` (
  `propertyGroupID` int(11) NOT NULL AUTO_INCREMENT,
  `propertyGroupTitle` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `propertyGroupModule` int(2) NOT NULL,
  `propertyGroupStatus` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `propertyLanguage` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`propertyGroupID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_property_group`
--

LOCK TABLES `tbl_property_group` WRITE;
/*!40000 ALTER TABLE `tbl_property_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_property_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_property_item`
--

DROP TABLE IF EXISTS `tbl_property_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_property_item` (
  `propertyItemID` int(11) NOT NULL AUTO_INCREMENT,
  `propertyItemTitle` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `itemPropertyGUID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`propertyItemID`),
  KEY `itemPropertyGUID` (`itemPropertyGUID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_property_item`
--

LOCK TABLES `tbl_property_item` WRITE;
/*!40000 ALTER TABLE `tbl_property_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_property_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_property_value`
--

DROP TABLE IF EXISTS `tbl_property_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_property_value` (
  `valueID` bigint(20) NOT NULL AUTO_INCREMENT,
  `valuePropertyID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `valueSrcGUID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `valuePackDataGUID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `valueContent` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`valueID`),
  KEY `valuePropertyID` (`valuePropertyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_property_value`
--

LOCK TABLES `tbl_property_value` WRITE;
/*!40000 ALTER TABLE `tbl_property_value` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_property_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_schedule`
--

DROP TABLE IF EXISTS `tbl_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_schedule` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `scheduleSrcID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `scheduleModuleID` int(2) NOT NULL,
  `scheduleStart` datetime NOT NULL,
  `scheduleEnd` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_schedule`
--

LOCK TABLES `tbl_schedule` WRITE;
/*!40000 ALTER TABLE `tbl_schedule` DISABLE KEYS */;
INSERT INTO `tbl_schedule` (`id`, `scheduleSrcID`, `scheduleModuleID`, `scheduleStart`, `scheduleEnd`) VALUES (2,'8EB3DC6D-8BFB-4BB2-94EB-667695388BE6',104,'2019-08-23 00:00:00','2019-08-25 00:00:00'),(3,'C3F7C43F-C2D4-4A3E-ABDE-3963EC55395B',104,'2019-08-23 00:00:00','2019-09-04 00:00:00');
/*!40000 ALTER TABLE `tbl_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_shop_factor`
--

DROP TABLE IF EXISTS `tbl_shop_factor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_shop_factor` (
  `factorID` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `factorUserID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `factorFinancialAction` text COLLATE utf8_unicode_ci NOT NULL,
  `factorGiftCard` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `factorDeliveryFee` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `factorSendAddress` text COLLATE utf8_unicode_ci NOT NULL,
  `factorAmount` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `factorPayment` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `factorUserAccount` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `factorPaymentStatus` enum('d','e') COLLATE utf8_unicode_ci NOT NULL,
  `factorStatus` enum('s','r','c','l','d') COLLATE utf8_unicode_ci NOT NULL,
  `factorRefID` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`factorID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_shop_factor`
--

LOCK TABLES `tbl_shop_factor` WRITE;
/*!40000 ALTER TABLE `tbl_shop_factor` DISABLE KEYS */;
INSERT INTO `tbl_shop_factor` (`factorID`, `factorUserID`, `factorFinancialAction`, `factorGiftCard`, `factorDeliveryFee`, `factorSendAddress`, `factorAmount`, `factorPayment`, `factorUserAccount`, `factorPaymentStatus`, `factorStatus`, `factorRefID`, `created_at`, `updated_at`) VALUES ('1908060206356834','9D33C80E-3CBC-495B-B2B7-0CD04D715675','[{\"actionTitle\":\"مالیات بر درآمد\",\"actionType\":\"+\",\"actionPercent\":\"10\"}]','0','8400','فارس - داراب -خیابان سلمان فارسی سه راه نهضت پلاک 176','1043000','1155700','0','d','s',NULL,'2019-08-06 14:06:35',NULL),('1908060206513309','9D33C80E-3CBC-495B-B2B7-0CD04D715675','[{\"actionTitle\":\"مالیات بر درآمد\",\"actionType\":\"+\",\"actionPercent\":\"10\"}]','0','8400','فارس - داراب -خیابان سلمان فارسی سه راه نهضت پلاک 176','1043000','1155700','0','d','s',NULL,'2019-08-06 14:06:51',NULL),('1908060207364557','9D33C80E-3CBC-495B-B2B7-0CD04D715675','[{\"actionTitle\":\"مالیات بر درآمد\",\"actionType\":\"+\",\"actionPercent\":\"10\"}]','0','8400','فارس - داراب -خیابان سلمان فارسی سه راه نهضت پلاک 176','1043000','1155700','0','d','s',NULL,'2019-08-06 14:07:36',NULL),('1908060208002094','9D33C80E-3CBC-495B-B2B7-0CD04D715675','[{\"actionTitle\":\"مالیات بر درآمد\",\"actionType\":\"+\",\"actionPercent\":\"10\"}]','0','8400','فارس - داراب -خیابان سلمان فارسی سه راه نهضت پلاک 176','1043000','1155700','0','d','s',NULL,'2019-08-06 14:08:00',NULL),('1908160329436111','9BE4033E-FF5F-41C7-88B7-21E6426E04F9','[{\"actionTitle\":\"مالیات بر درآمد\",\"actionType\":\"+\",\"actionPercent\":\"10\"}]','0','4800','چهارصددستگاه','596000','660400','0','d','s',NULL,'2019-08-16 15:29:43',NULL),('1908160330553439','9BE4033E-FF5F-41C7-88B7-21E6426E04F9','[{\"actionTitle\":\"مالیات بر درآمد\",\"actionType\":\"+\",\"actionPercent\":\"10\"}]','0','4800','چهارصددستگاه','596000','660400','0','d','s',NULL,'2019-08-16 15:30:55',NULL),('1908250927285278','8D7DBCDE-E383-4EA4-819B-ED5E2E55C92B','[{\"actionTitle\":\"مالیات بر درآمد\",\"actionType\":\"+\",\"actionPercent\":\"10\"}]','0','150000','تهران. میدان آرژانتین. خیابان بخارست. نبش 11 ام. ساختمان 38. طبقه 2 واحد9','298000','477800','0','d','s',NULL,'2019-08-25 21:27:28',NULL),('1908270936485034','C1D961D3-E700-47CA-B29B-68A3DFC9766C','[{\"actionTitle\":\"مالیات بر درآمد\",\"actionType\":\"+\",\"actionPercent\":\"10\"}]','0','150000','بزرگراه خرازی غرب-دریاچه خلیج فارس-میدان ساحل-مجتمع مسکونی پارسیا- بلوک سرو 3- واحد 16','149000','313900','0','d','s',NULL,'2019-08-27 09:36:48',NULL);
/*!40000 ALTER TABLE `tbl_shop_factor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_shop_factor_desc`
--

DROP TABLE IF EXISTS `tbl_shop_factor_desc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_shop_factor_desc` (
  `id` int(1) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_shop_factor_desc`
--

LOCK TABLES `tbl_shop_factor_desc` WRITE;
/*!40000 ALTER TABLE `tbl_shop_factor_desc` DISABLE KEYS */;
INSERT INTO `tbl_shop_factor_desc` (`id`, `description`) VALUES (1,'');
/*!40000 ALTER TABLE `tbl_shop_factor_desc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_shop_factor_financial`
--

DROP TABLE IF EXISTS `tbl_shop_factor_financial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_shop_factor_financial` (
  `financialID` int(11) NOT NULL AUTO_INCREMENT,
  `financialTitle` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `financialPercent` int(2) NOT NULL,
  `financialType` enum('-','+') COLLATE utf8_unicode_ci NOT NULL,
  `financialStartDate` date NOT NULL,
  `financialExpireDate` date NOT NULL,
  `financialStatus` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`financialID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_shop_factor_financial`
--

LOCK TABLES `tbl_shop_factor_financial` WRITE;
/*!40000 ALTER TABLE `tbl_shop_factor_financial` DISABLE KEYS */;
INSERT INTO `tbl_shop_factor_financial` (`financialID`, `financialTitle`, `financialPercent`, `financialType`, `financialStartDate`, `financialExpireDate`, `financialStatus`, `created_at`, `updated_at`) VALUES (2,'تخفیف',5,'-','2019-06-22','2019-07-22','1','2019-07-14 16:06:34',NULL),(3,'مالیات بر درآمد',10,'+','2019-06-30','2020-04-27','1','2019-07-14 16:45:09','2019-07-14 17:21:13');
/*!40000 ALTER TABLE `tbl_shop_factor_financial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_shop_factor_item`
--

DROP TABLE IF EXISTS `tbl_shop_factor_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_shop_factor_item` (
  `itemGUID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `itemFactorID` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `itemProductGUID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `itemProductTitle` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `itemAmount` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `itemQuantity` int(3) NOT NULL,
  PRIMARY KEY (`itemGUID`),
  KEY `itemFactorID` (`itemFactorID`),
  CONSTRAINT `tbl_shop_factor_item_ibfk_1` FOREIGN KEY (`itemFactorID`) REFERENCES `tbl_shop_factor` (`factorID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_shop_factor_item`
--

LOCK TABLES `tbl_shop_factor_item` WRITE;
/*!40000 ALTER TABLE `tbl_shop_factor_item` DISABLE KEYS */;
INSERT INTO `tbl_shop_factor_item` (`itemGUID`, `itemFactorID`, `itemProductGUID`, `itemProductTitle`, `itemAmount`, `itemQuantity`) VALUES ('090940DB-9464-44E9-9BFD-30482662F71D','1908060206513309','0E1FA7CC-04E4-4C28-8BBB-364165D1F3D0','عطر بیک شماره 15','149000',7),('0A6EA54D-8FCB-4077-95B1-34CDE72C09B1','1908060208002094','0E1FA7CC-04E4-4C28-8BBB-364165D1F3D0','عطر بیک شماره 15','149000',7),('2B7E0057-898E-45B3-A223-037560CEA833','1908160330553439','F3A4F5B6-22B1-4556-9529-8D3A0FF02034','عطر بیک شماره 28','149000',2),('30295B81-9BCA-4E54-9AAE-17B7BD069D07','1908160329436111','F3A4F5B6-22B1-4556-9529-8D3A0FF02034','عطر بیک شماره 28','149000',2),('3C5D1860-8F06-490B-B02E-100FF66833EF','1908060207364557','0E1FA7CC-04E4-4C28-8BBB-364165D1F3D0','عطر بیک شماره 15','149000',7),('98E6AB0D-E384-4EA3-B446-4552591E0FAA','1908060206356834','0E1FA7CC-04E4-4C28-8BBB-364165D1F3D0','عطر بیک شماره 15','149000',7),('A00A201F-CF7F-4F64-8017-84BC0F30B55B','1908160329436111','E82A8826-D0EB-45C3-81F5-17B41D959067','عطر بیک شماره 21','149000',2),('B1AD4ADE-31F6-43AC-9A37-B6D2465A37C3','1908270936485034','E82A8826-D0EB-45C3-81F5-17B41D959067','عطر بیک شماره 21','149000',1),('BD58D48D-D274-4B03-90FB-8D8FC13A5B23','1908250927285278','349DB62C-0042-4AC2-98AE-78D7B1241C9F','عطر بیک شماره 14','149000',2),('DF9BE7E9-EA3A-4208-88AE-B3AF637F3750','1908160330553439','E82A8826-D0EB-45C3-81F5-17B41D959067','عطر بیک شماره 21','149000',2);
/*!40000 ALTER TABLE `tbl_shop_factor_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_shop_giftcard`
--

DROP TABLE IF EXISTS `tbl_shop_giftcard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_shop_giftcard` (
  `giftID` int(11) NOT NULL AUTO_INCREMENT,
  `giftCardID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `giftCardExpireDate` date NOT NULL,
  `giftCardAmount` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `giftCardStatus` enum('e','d') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'e',
  `created_at` date NOT NULL,
  PRIMARY KEY (`giftID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_shop_giftcard`
--

LOCK TABLES `tbl_shop_giftcard` WRITE;
/*!40000 ALTER TABLE `tbl_shop_giftcard` DISABLE KEYS */;
INSERT INTO `tbl_shop_giftcard` (`giftID`, `giftCardID`, `giftCardExpireDate`, `giftCardAmount`, `giftCardStatus`, `created_at`) VALUES (26,'pZu23Z2da1','2019-07-31','100000','e','2019-07-14');
/*!40000 ALTER TABLE `tbl_shop_giftcard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_slider`
--

DROP TABLE IF EXISTS `tbl_slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_slider` (
  `sliderID` int(11) NOT NULL AUTO_INCREMENT,
  `sliderTitle` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sliderURL` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sliderImg` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `sliderCaption` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `sliderLanguage` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sliderID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_slider`
--

LOCK TABLES `tbl_slider` WRITE;
/*!40000 ALTER TABLE `tbl_slider` DISABLE KEYS */;
INSERT INTO `tbl_slider` (`sliderID`, `sliderTitle`, `sliderURL`, `sliderImg`, `sliderCaption`, `sliderLanguage`, `created_at`, `updated_at`) VALUES (8,'','https://bicyar.com/Product/ProductArchive/62/%D9%81%D8%B1%D9%88%D8%B4-%D9%88%DB%8C%DA%98%D9%87/0','20190813152323D4zW7Re27r.jpg','','ir','2019-08-13 15:23:23',NULL),(10,'','https://bicyar.com/pageView/%D9%88%D8%A8%D9%84%D8%A7%DA%AF/','20190813154420Cg2hLLFaX9.jpg','','ir','2019-08-13 15:44:20',NULL),(11,'','https://bicyar.com/Product/ProductArchive/33/%D9%85%D8%AD%D8%B5%D9%88%D9%84%D8%A7%D8%AA/%DA%A9%D8%B1%D9%85-%D8%AF%D8%B3%D8%AA-%D9%88-%D8%B5%D9%88%D8%B1%D8%AA-%D8%A8%DB%8C%DA%98%D9%86/0','20190817122921sipnxNMlCe.jpg','','ir','2019-08-17 12:29:21',NULL),(12,'','https://bicyar.com/news/newsArchive/64/%D9%88%D8%A8%D9%84%D8%A7%DA%AF/0','20190818121728RCJ9u72I8M.jpg','','ir','2019-08-18 12:17:28','2019-08-19 15:17:12');
/*!40000 ALTER TABLE `tbl_slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tag`
--

DROP TABLE IF EXISTS `tbl_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tag` (
  `tagID` int(11) NOT NULL AUTO_INCREMENT,
  `tagTitle` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`tagID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tag`
--

LOCK TABLES `tbl_tag` WRITE;
/*!40000 ALTER TABLE `tbl_tag` DISABLE KEYS */;
INSERT INTO `tbl_tag` (`tagID`, `tagTitle`) VALUES (1,'عطر'),(2,'دئودرانت'),(3,'تست 2'),(4,'تست'),(5,'یشسیشس'),(6,'یشسیشس'),(7,'یشسیشس'),(8,'زظطظطز'),(9,'423423423'),(10,'423423423'),(11,'423423423'),(12,'test'),(13,'ورساچه'),(14,'رز'),(15,'سوسن وحشی');
/*!40000 ALTER TABLE `tbl_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_group`
--

DROP TABLE IF EXISTS `tbl_user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user_group` (
  `id` bigint(12) NOT NULL,
  `parentID` bigint(12) NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `userGroupStartTime` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `userGroupEndTime` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `userGroupWeekday` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `userGroupDataAccess` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `userGroupStatus` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_group`
--

LOCK TABLES `tbl_user_group` WRITE;
/*!40000 ALTER TABLE `tbl_user_group` DISABLE KEYS */;
INSERT INTO `tbl_user_group` (`id`, `parentID`, `title`, `userGroupStartTime`, `userGroupEndTime`, `userGroupWeekday`, `userGroupDataAccess`, `userGroupStatus`, `created_at`, `updated_at`) VALUES (190527030915,0,'مدیر سایت','00:00','23:45','sa-su-mo-tu-we-th-fr','1','1','2019-05-27 15:09:15',NULL);
/*!40000 ALTER TABLE `tbl_user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_log`
--

DROP TABLE IF EXISTS `tbl_user_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user_log` (
  `logID` bigint(20) NOT NULL AUTO_INCREMENT,
  `logUserID` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `logDate` datetime NOT NULL,
  `logUserIP` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `logMessage` varchar(512) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`logID`)
) ENGINE=InnoDB AUTO_INCREMENT=692 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_log`
--

LOCK TABLES `tbl_user_log` WRITE;
/*!40000 ALTER TABLE `tbl_user_log` DISABLE KEYS */;
INSERT INTO `tbl_user_log` (`logID`, `logUserID`, `logDate`, `logUserIP`, `logMessage`) VALUES (1,'1','2019-05-27 15:04:38','188.211.87.75','ایجاد صفحه اول بخش پارالاکس اول'),(2,'1','2019-05-27 15:04:56','188.211.87.75','ایجاد صفحه اول بخش پارالاکس دوم'),(3,'1','2019-05-27 15:07:06','188.211.87.75','ویرایش صفحه اول بخش پارالاکس اول'),(4,'1','2019-05-27 15:07:31','188.211.87.75','ویرایش صفحه اول بخش پارالاکس اول'),(5,'1','2019-05-27 15:09:15','188.211.87.75','ایجاد گروه کاربری مدیر سایت'),(6,'1','2019-05-27 15:10:07','188.211.87.75','ایجاد کاربر مدیریت مدیر سایت'),(7,'1','2019-05-27 15:10:24','188.211.87.75',' خروج از کنترل پنل  '),(8,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:11:00','188.211.87.75',' اولین ورود و تغییر رمزمدیر سایت'),(9,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:11:02','188.211.87.75',' خروج از کنترل پنل  '),(10,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:11:15','188.211.87.75',' ورورد به کنترل پنل '),(11,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:42:08','188.211.87.75','ایجاد دسته بندی و صفحه دسته بندی 1'),(12,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:42:24','188.211.87.75','ایجاد دسته بندی و صفحه دسته بندی 2'),(13,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:42:43','188.211.87.75','ایجاد دسته بندی و صفحه دسته بندی 1-1'),(14,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:43:07','188.211.87.75','ایجاد دسته بندی و صفحه دسته بندی 1-1-1'),(15,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:43:37','188.211.87.75','ویرایش دسته بندی و صفحه دسته بندی 1-1-1'),(16,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:44:00','188.211.87.75','ایجاد دسته بندی و صفحه دسته یندی 1-2'),(17,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:45:03','188.211.87.75','ایجاد دسته بندی و صفحه درباره ما'),(18,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:45:31','188.211.87.75','ایجاد دسته بندی و صفحه کاتالوگ'),(19,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:45:52','188.211.87.75','ایجاد دسته بندی و صفحه سایت رسمی'),(20,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:46:13','188.211.87.75','ایجاد دسته بندی و صفحه آرشیو خبر'),(21,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:46:31','188.211.87.75','ایجاد دسته بندی و صفحه آرشیو موضوعی'),(22,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:46:59','188.211.87.75','ایجاد دسته بندی و صفحه اخبار محصولات'),(23,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:47:36','188.211.87.75','ایجاد محتوی صفحه درباره ما'),(24,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:48:19','188.211.87.75','ایجاد فایل یا لینک 20190527154819tUi9KDRPin.jpg'),(25,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:49:09','188.211.87.75','ویرایش فایل یا لینک 201905271549093IFImRStYo.jpg'),(26,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:49:39','188.211.87.75','ایجاد فایل یا لینک ago.ir'),(27,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:50:04','188.211.87.75','ویرایش فایل یا لینک bic.ir'),(28,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:51:02','188.211.87.75','ایجاد دسته بندی و صفحه تست برای دلیت فایل'),(29,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:51:30','188.211.87.75','ایجاد دسته بندی و صفحه تست برای دلیت لینک'),(30,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:52:25','188.211.87.75','ایجاد فایل یا لینک 20190527155225W9fDPK8gFP.jpg'),(31,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:52:36','188.211.87.75','حذف دسته بندی و صفحه تست-برای دلیت فایل'),(32,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:52:47','188.211.87.75','ایجاد فایل یا لینک ago.ir'),(33,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:52:57','188.211.87.75','حذف دسته بندی و صفحه تست-برای دلیت لینک'),(34,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 15:56:09','188.211.87.75','ایجاد محصولات تست 1'),(35,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:00:20','188.211.87.75','ایجاد محصولات تست 2'),(36,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:01:11','188.211.87.75','ایجاد محصولات تست 3'),(37,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:02:54','188.211.87.75','ویرایش محصولات تست 3'),(38,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:03:37','188.211.87.75','ویرایش محصولات تست 3'),(39,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:04:37','188.211.87.75','ویرایش محصولات تست 3'),(40,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:05:47','188.211.87.75','ویرایش محصولات تست 3'),(41,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:08:39','188.211.87.75','ویرایش محصولات تست 3'),(42,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:10:34','188.211.87.75','ویرایش محصولات تست 3'),(43,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:10:44','188.211.87.75','ویرایش محصولات تست 3'),(44,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:11:10','188.211.87.75','حذف محصولات تست 3'),(45,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:12:14','188.211.87.75','ایجاد اسلایدر test 1'),(46,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:12:58','188.211.87.75','ایجاد اسلایدر test 1'),(47,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:17:19','188.211.87.75','ایجاد اسلایدر test 1'),(48,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:18:09','188.211.87.75','ویرایش اسلایدر test 1'),(49,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:20:42','188.211.87.75','ویرایش صفحه اول بخش پارالاکس دوم'),(50,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:21:56','188.211.87.75','ایجاد گروه کاربری تست'),(51,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:22:53','188.211.87.75','ویرایش گروه کاربری تست'),(52,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:23:20','188.211.87.75','حذف گروه کاربری تست 1'),(53,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:24:16','188.211.87.75','ایجاد کاربر مدیریت مدیر سایت'),(54,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:24:43','188.211.87.75','ویرایش کاربر مدیریت مدیر سایت'),(55,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:25:04','188.211.87.75','ویرایش کاربر مدیریت مدیر سایت'),(56,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:25:15','188.211.87.75','ویرایش کاربر مدیریت مدیر سایت'),(57,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:25:44','188.211.87.75',' تغییر رمز ورود مدیر سایت'),(58,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:25:49','188.211.87.75','حذف کاربر مدیریت مدیر سایت'),(59,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:26:23','188.211.87.75','ایجاد اطلاعات ارتباطی ایمیل'),(60,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:26:48','188.211.87.75','ایجاد اطلاعات ارتباطی phone'),(61,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:27:09','188.211.87.75','ایجاد اطلاعات ارتباطی insta'),(62,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:27:24','188.211.87.75','ویرایش اطلاعات ارتباطی insta'),(63,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:27:37','188.211.87.75','ویرایش اطلاعات ارتباطی insta'),(64,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:27:50','188.211.87.75','حذف اطلاعات ارتباطی qinsta'),(65,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:43:28','188.211.87.75','ایجاد اخبار و مقاله سیشسی'),(66,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:44:23','188.211.87.75','ایجاد اخبار و مقاله طزظطز'),(67,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 16:44:39','188.211.87.75','ایجاد اخبار و مقاله یشسیشسیشس'),(68,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 17:13:29','188.211.87.75','حذف اخبار و مقاله یشسیشسیشس'),(69,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-27 17:15:16','188.211.87.75','حذف اخبار و مقاله طزظطز4234234'),(70,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 09:27:28','31.2.234.15',' ورورد به کنترل پنل '),(71,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 09:35:53','31.2.234.15','ایجاد گروه کاربری vorood dade paroduct'),(72,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 09:36:23','31.2.234.15','ویرایش گروه کاربری vorood dade paroduct'),(73,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 09:36:44','31.2.234.15','حذف گروه کاربری vorood dade paroduct'),(74,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 09:39:43','31.2.234.15','ایجاد کاربر مدیریت fi po'),(75,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 09:40:50','31.2.234.15','ویرایش کاربر مدیریت fi po'),(76,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 09:41:30','31.2.234.15',' تغییر رمز ورود fi po'),(77,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 09:42:17','31.2.234.15','حذف کاربر مدیریت fi po'),(78,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 09:48:57','31.2.234.15','ایجاد دسته بندی و صفحه عطر زنانه'),(79,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 09:49:30','31.2.234.15','ایجاد دسته بندی و صفحه روز'),(80,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 09:49:49','31.2.234.15','ایجاد دسته بندی و صفحه شب'),(81,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 09:50:59','31.2.234.15','حذف دسته بندی و صفحه دسته-بندی 2'),(82,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 09:52:40','31.2.234.15','ایجاد دسته بندی و صفحه درباره عطر'),(83,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 09:55:28','31.2.234.15','ایجاد محتوی صفحه درباره عطر'),(84,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 09:56:00','31.2.234.15','ایجاد دسته بندی و صفحه اطلاعات عطر زنانه'),(85,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 09:56:24','31.2.234.15','ایجاد فایل یا لینک 201905280956249HVnCrdM77.jpg'),(86,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 09:57:20','31.2.234.15','ایجاد دسته بندی و صفحه وب سایت رسمی'),(87,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 09:57:48','31.2.234.15','ایجاد فایل یا لینک bic.com'),(88,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 09:58:11','31.2.234.15','حذف دسته بندی و صفحه وب-سایت رسمی'),(89,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 09:58:29','31.2.234.15','حذف دسته بندی و صفحه اطلاعات-عطر زنانه'),(90,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 09:58:36','31.2.234.15','حذف دسته بندی و صفحه درباره-عطر'),(91,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 10:00:38','31.2.234.15','ایجاد اطلاعات ارتباطی اینستا'),(92,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 10:03:47','31.2.234.15','ایجاد اطلاعات ارتباطی نقشه'),(93,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 10:04:03','31.2.234.15','حذف اطلاعات ارتباطی نقشه'),(94,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 10:04:07','31.2.234.15','حذف اطلاعات ارتباطی اینستا'),(95,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 10:05:22','31.2.234.15','ایجاد اسلایدر test 1'),(96,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 10:05:41','31.2.234.15','ویرایش اسلایدر test 1'),(97,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 10:18:37','31.2.234.15','ایجاد اخبار و مقاله dsdsds'),(98,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 10:20:58','31.2.234.15','حذف اخبار و مقاله dsdsds'),(99,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-05-28 10:51:06','185.120.137.201',' ورورد به کنترل پنل '),(100,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 08:37:44','185.120.137.201',' ورورد به کنترل پنل '),(101,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:13:29','185.120.137.201','حذف دسته بندی و صفحه شب'),(102,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:13:50','185.120.137.201','حذف دسته بندی و صفحه روز'),(103,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:14:14','185.120.137.201','حذف دسته بندی و صفحه عطر-زنانه'),(104,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:14:30','185.120.137.201','حذف دسته بندی و صفحه دسته-یندی 1-2'),(105,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:14:38','185.120.137.201','حذف دسته بندی و صفحه دسته-بندی 1-1-1'),(106,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:14:47','185.120.137.201','حذف دسته بندی و صفحه دسته-بندی 1-1'),(107,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:14:58','185.120.137.201','حذف دسته بندی و صفحه دسته-بندی 1'),(108,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:16:41','185.120.137.201','ایجاد دسته بندی و صفحه عطر'),(109,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:17:25','185.120.137.201','ایجاد دسته بندی و صفحه عطر بیک'),(110,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:17:48','185.120.137.201','حذف دسته بندی و صفحه عطر-بیک'),(111,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:18:21','185.120.137.201','ایجاد دسته بندی و صفحه عطر بیک'),(112,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:19:01','185.120.137.201','ایجاد دسته بندی و صفحه دات کالکشن'),(113,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:19:17','185.120.137.201','ویرایش دسته بندی و صفحه عطر بیک'),(114,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:20:04','185.120.137.201','ایجاد دسته بندی و صفحه سامر'),(115,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:20:41','185.120.137.201','ایجاد دسته بندی و صفحه رپیتون'),(116,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:21:09','185.120.137.201','ایجاد دسته بندی و صفحه میس‌تین'),(117,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:21:41','185.120.137.201','ایجاد دسته بندی و صفحه میلُرد'),(118,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:22:12','185.120.137.201','ایجاد دسته بندی و صفحه میلانو'),(119,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:22:48','185.120.137.201','ایجاد دسته بندی و صفحه اسپری بدن'),(120,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:23:25','185.120.137.201','ایجاد دسته بندی و صفحه اسپری بدن بیک'),(121,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:23:53','185.120.137.201','ایجاد دسته بندی و صفحه کرم دست و صورت'),(122,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:24:13','185.120.137.201','ایجاد دسته بندی و صفحه بیژن'),(123,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:33:02','185.120.137.201','ایجاد دسته بندی و صفحه عطر زنانه'),(124,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:33:37','185.120.137.201','ایجاد دسته بندی و صفحه عطر مردانه'),(125,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:34:48','185.120.137.201','ایجاد دسته بندی و صفحه عطر اسپرت'),(126,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:36:30','185.120.137.201','ایجاد دسته بندی و صفحه عطر روز بانوان'),(127,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:36:52','185.120.137.201','ویرایش دسته بندی و صفحه عطر زنانه'),(128,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:37:39','185.120.137.201','ایجاد دسته بندی و صفحه عطر شب بانوان'),(129,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:39:56','185.120.137.201','ایجاد دسته بندی و صفحه محصولات'),(130,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:40:20','185.120.137.201','ویرایش دسته بندی و صفحه عطر'),(131,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:40:47','185.120.137.201','ویرایش دسته بندی و صفحه اسپری بدن'),(132,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:41:05','185.120.137.201','ویرایش دسته بندی و صفحه کرم دست و صورت'),(133,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:41:22','185.120.137.201','ویرایش دسته بندی و صفحه عطر بانوان'),(134,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:41:32','185.120.137.201','ویرایش دسته بندی و صفحه عطر مردانه'),(135,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:49:47','185.120.137.201','ویرایش دسته بندی و صفحه عطر اسپرت'),(136,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:50:04','185.120.137.201','ویرایش دسته بندی و صفحه عطر روز بانوان'),(137,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 09:50:36','185.120.137.201','ویرایش دسته بندی و صفحه عطر شب بانوان'),(138,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 10:19:36','185.120.137.201','ایجاد محصولات شماره یک'),(146,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 10:22:57','185.120.137.201','حذف محصولات شماره یک'),(147,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 10:28:16','185.120.137.201','ایجاد محصولات اسپری بدن شماره یک'),(148,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 10:41:22','185.120.137.201','ایجاد محصولات اسپری بدن شماره 2'),(149,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 10:46:15','185.120.137.201','ایجاد محصولات اسپری بدن شماره 3'),(150,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 11:02:27','185.120.137.201','ایجاد محصولات اسپری بدن شماره 4'),(154,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 11:13:14','185.120.137.201','ایجاد محصولات اسپری بدن شماره 5'),(156,'1','2019-06-01 11:25:31','5.196.121.49',' ورورد به کنترل پنل '),(175,'1','2019-06-01 11:40:57','5.196.121.49','ویرایش محصولات اسپری بدن شماره 3'),(176,'1','2019-06-01 11:41:08','5.196.121.49','ویرایش محصولات اسپری بدن شماره 2'),(177,'1','2019-06-01 11:41:20','5.196.121.49','ویرایش محصولات اسپری بدن شماره یک'),(178,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 11:45:46','185.120.137.201','ویرایش محصولات اسپری بدن شماره یک'),(179,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 11:46:11','185.120.137.201','ویرایش محصولات اسپری بدن شماره 2'),(180,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 11:46:32','185.120.137.201','ویرایش محصولات اسپری بدن شماره 3'),(181,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 11:47:47','185.120.137.201','ویرایش محصولات اسپری بدن شماره 4'),(182,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 11:48:17','185.120.137.201','ویرایش محصولات اسپری بدن شماره 4'),(183,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 11:48:43','185.120.137.201','ویرایش محصولات اسپری بدن شماره 5'),(184,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 11:53:20','185.120.137.201','ایجاد محصولات اسپری بدن شماره 6'),(185,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 12:00:52','185.120.137.201','ایجاد محصولات اسپری بدن شماره 7'),(186,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 12:05:41','185.120.137.201','ایجاد محصولات اسپری بدن شماره 8'),(187,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 12:10:25','185.120.137.201','ایجاد محصولات اسپری بدن شماره 9'),(188,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 12:10:41','185.120.137.201','حذف دسته بندی و صفحه اسپری-بدن بیک'),(189,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 12:16:18','185.120.137.201','ایجاد محصولات اسپری بدن شماره 10'),(190,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 12:20:33','185.120.137.201','ایجاد محصولات اسپری بدن شماره 11'),(191,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 12:25:05','185.120.137.201','ایجاد محصولات اسپری بدن شماره 12'),(192,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 12:46:26','185.120.137.201','ایجاد محصولات عطر دات کالکشن شماره 1'),(193,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 12:49:49','185.120.137.201','ایجاد محصولات عطر دات کالکشن شماره 2'),(194,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 12:52:38','185.120.137.201','ایجاد محصولات عطر دات کالکشن شماره 3'),(195,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 12:55:27','185.120.137.201','ایجاد محصولات عطر دات کالکشن شماره 4'),(196,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 12:57:51','185.120.137.201','ایجاد محصولات عطر دات کالکشن شماره 5'),(197,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 13:00:50','185.120.137.201','ایجاد محصولات عطر دات کالکشن شماره 6'),(198,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 13:03:38','185.120.137.201','ایجاد محصولات عطر دات کالکشن شماره 7'),(199,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 13:05:50','185.120.137.201','ایجاد محصولات عطر دات کالکشن شماره 8'),(200,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 13:08:00','185.120.137.201','ایجاد محصولات عطر دات کالکشن شماره 9'),(201,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 13:10:46','185.120.137.201','ویرایش محصولات اسپری بدن شماره 10'),(202,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 13:11:56','185.120.137.201','ایجاد محصولات عطر دات کالکشن شماره 10'),(203,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 13:14:03','185.120.137.201','ایجاد محصولات عطر دات کالکشن شماره 11'),(204,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-01 13:16:23','185.120.137.201','ایجاد محصولات عطر دات کالکشن شماره 12'),(205,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 09:11:45','185.120.137.201',' ورورد به کنترل پنل '),(206,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 09:52:50','185.120.137.201','ایجاد محصولات عطر بیک شماره 1'),(207,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 09:57:01','185.120.137.201','ایجاد محصولات عطر بیک شماره 2'),(208,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 10:00:26','185.120.137.201','ایجاد محصولات عطر بیک شماره 3'),(209,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 10:03:33','185.120.137.201','ایجاد محصولات عطر بیک شماره 4'),(210,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 10:04:07','185.120.137.201','ویرایش محصولات عطر بیک شماره 2'),(211,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 10:06:39','185.120.137.201','ایجاد محصولات عطر بیک شماره 5'),(212,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 10:09:14','185.120.137.201','ایجاد محصولات عطر بیک شماره 6'),(213,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 10:13:14','185.120.137.201','ایجاد محصولات عطر بیک شماره 7'),(214,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 10:15:55','185.120.137.201','ایجاد محصولات عطر بیک شماره 8'),(215,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 10:19:45','185.120.137.201','ایجاد محصولات عطر بیک شماره 9'),(216,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 10:23:05','185.120.137.201','ایجاد محصولات عطر بیک شماره 10'),(217,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 10:26:40','185.120.137.201','ایجاد محصولات عطر بیک شماره 11'),(218,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 10:30:44','185.120.137.201','ایجاد محصولات عطر بیک شماره 12'),(219,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 10:33:50','185.120.137.201','ایجاد محصولات عطر بیک شماره 13'),(220,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 10:39:52','185.120.137.201','ایجاد محصولات عطر بیک شماره 14'),(221,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 10:51:33','185.120.137.201','ایجاد محصولات عطر بیک شماره 15'),(222,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 10:56:21','185.120.137.201','ایجاد محصولات عطر بیک شماره 16'),(223,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 10:59:55','185.120.137.201','ایجاد محصولات عطر بیک شماره 17'),(224,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 11:03:30','185.120.137.201','ایجاد محصولات عطر بیک شماره 18'),(225,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 11:06:38','185.120.137.201','ایجاد محصولات عطر بیک شماره 19'),(226,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 11:10:03','185.120.137.201','ایجاد محصولات عطر بیک شماره 20'),(227,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 11:15:20','185.120.137.201','ایجاد محصولات عطر بیک شماره 21'),(228,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 11:18:23','185.120.137.201','ایجاد محصولات عطر بیک شماره 22'),(229,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 11:22:23','185.120.137.201','ایجاد محصولات عطر بیک شماره 23'),(230,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 11:25:42','185.120.137.201','ایجاد محصولات عطر بیک شماره 24'),(231,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 13:52:09','185.120.137.201',' ورورد به کنترل پنل '),(232,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 13:52:28','185.120.137.201','حذف دسته بندی و صفحه آرشیو-موضوعی'),(233,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 13:55:54','185.120.137.201','ایجاد دسته بندی و صفحه کرم بیژن'),(234,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 13:58:14','185.120.137.201','ایجاد اخبار و مقاله کرم دست و صورت بیژن'),(235,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 14:00:18','185.120.137.201','ایجاد دسته بندی و صفحه جشنواره بیک'),(236,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-06-02 14:01:47','185.120.137.201','ایجاد اخبار و مقاله جشنواره بوی خوش جوانی'),(237,'1','2019-07-09 14:47:41','::1',' ورورد به کنترل پنل '),(238,'1','2019-07-09 17:51:56','::1',' ورورد به کنترل پنل '),(239,'1','2019-07-09 18:19:42','::1','ایجاد اسلایدر عطر بیک برای خانم های شیک'),(240,'1','2019-07-09 18:20:13','::1','ایجاد اسلایدر عطر بیک برای آقایون شیک'),(241,'1','2019-07-09 18:20:55','::1','ایجاد اسلایدر عطر بیک برای افراد شیک'),(242,'1','2019-07-09 18:51:14','::1','ویرایش صفحه اول بخش پارالاکس اول'),(243,'1','2019-07-09 18:51:28','::1','ویرایش صفحه اول بخش پارالاکس دوم'),(244,'1','2019-07-11 13:39:49','::1',' ورورد به کنترل پنل '),(245,'1','2019-07-13 13:52:57','::1',' ورورد به کنترل پنل '),(246,'1','2019-07-13 15:27:42','::1','حذف کارت هدیه SeiLYPCjjC'),(247,'1','2019-07-13 16:41:39','::1','ویرایش توضیحات فاکتور ویرایش توضیحات فاکتور'),(248,'1','2019-07-13 16:43:13','::1','ویرایش توضیحات فاکتور ویرایش توضیحات فاکتور'),(249,'1','2019-07-13 16:43:26','::1','ویرایش توضیحات فاکتور ویرایش توضیحات فاکتور'),(250,'1','2019-07-14 09:40:35','::1',' ورورد به کنترل پنل '),(251,'1','2019-07-14 15:18:15','::1','ایجاد تنظیمات فاکتور مالیات'),(252,'1','2019-07-14 16:06:34','::1','ایجاد تنظیمات فاکتور تخفیف'),(253,'1','2019-07-14 16:45:09','::1','ایجاد تنظیمات فاکتور مالیات'),(254,'1','2019-07-14 17:19:34','::1','ویرایش تنظیمات فاکتور مالیات'),(255,'1','2019-07-14 17:19:45','::1','ویرایش تنظیمات فاکتور مالیات بر درآمد'),(256,'1','2019-07-14 17:19:58','::1','ویرایش تنظیمات فاکتور مالیات بر درآمد'),(257,'1','2019-07-14 17:20:05','::1','ویرایش تنظیمات فاکتور مالیات بر درآمد'),(258,'1','2019-07-14 17:20:46','::1','ویرایش تنظیمات فاکتور مالیات بر درآمد'),(259,'1','2019-07-14 17:21:13','::1','ویرایش تنظیمات فاکتور مالیات بر درآمد'),(260,'1','2019-07-16 14:23:42','::1',' ورورد به کنترل پنل '),(261,'1','2019-07-18 15:55:19','::1',' ورورد به کنترل پنل '),(262,'1','2019-07-20 11:26:47','::1',' ورورد به کنترل پنل '),(263,'1','2019-07-20 16:12:43','::1','ویرایش  1907191255307246'),(264,'1','2019-07-20 16:13:38','::1','ویرایش  فاکتور 1907191255307246'),(265,'1','2019-07-20 16:13:47','::1','ویرایش  فاکتور 1907191255307246'),(266,'1','2019-07-20 16:14:45','::1','ویرایش  فاکتور 1907191255307246'),(267,'1','2019-07-20 16:17:23','::1','ویرایش  فاکتور 1907191255307246'),(268,'1','2019-07-20 16:17:28','::1','ویرایش  فاکتور 1907191255307246'),(269,'1','2019-07-20 16:19:41','::1','ویرایش  فاکتور 1907191255307246'),(270,'1','2019-07-20 16:49:43','::1','حذف  فاکتور 1907191255307246'),(271,'1','2019-07-21 11:00:47','::1',' ورورد به کنترل پنل '),(272,'1','2019-07-21 15:27:01','::1',' ورورد به کنترل پنل '),(273,'1','2019-07-21 16:12:26','::1','ایجاد قرعه کشی دوره اول قرعه کشی'),(274,'1','2019-07-21 16:13:03','::1','ایجاد قرعه کشی دوره اول قرعه کشی'),(275,'1','2019-07-21 16:14:00','::1','ایجاد قرعه کشی دوره اول قرعه کشی'),(276,'1','2019-07-21 16:14:31','::1','ایجاد قرعه کشی دوره اول قرعه کشی'),(277,'1','2019-07-21 19:03:29','::1','حذف قرعه کشی دوره-اول-قرعه-کشی'),(278,'1','2019-07-22 10:19:24','::1',' ورورد به کنترل پنل '),(279,'1','2019-07-22 14:42:49','::1','ویرایش محصولات عطر بیک شماره 24'),(280,'1','2019-07-23 15:11:58','5.196.121.49',' ورورد به کنترل پنل '),(281,'1','2019-07-23 15:12:33','5.196.121.49','ایجاد صفحه اول بخش سوم پارالاکس'),(282,'1','2019-07-23 15:13:57','5.196.121.49','ویرایش صفحه اول بخش سوم پارالاکس'),(283,'1','2019-07-24 12:46:02','5.196.121.49',' ورورد به کنترل پنل '),(284,'1','2019-07-24 12:46:31','5.196.121.49',' تغییر رمز ورود مدیر سایت'),(285,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-24 12:54:23','185.120.137.201',' ورورد به کنترل پنل '),(286,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-24 13:06:43','185.120.137.201','ویرایش اسلایدر عطر بیک برای افراد شیک'),(287,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-24 14:25:31','185.120.137.201','ویرایش صفحه اول بخش پارالاکس اول'),(288,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-24 14:25:45','185.120.137.201','ویرایش صفحه اول بخش پارالاکس دوم'),(289,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-24 14:26:23','185.120.137.201','ویرایش صفحه اول بخش سوم پارالاکس'),(290,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-24 14:29:53','185.120.137.201','حذف دسته بندی و صفحه جشنواره-بیک'),(291,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-24 14:30:47','185.120.137.201','حذف اخبار و مقاله جشنواره بوی خوش جوانی'),(292,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-24 14:35:51','185.120.137.201','حذف دسته بندی و صفحه سایت-رسمی'),(293,'1','2019-07-29 15:06:55','5.196.121.49',' ورورد به کنترل پنل '),(294,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 10:17:19','185.120.137.201',' ورورد به کنترل پنل '),(295,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 10:24:03','185.120.137.201','ویرایش محصولات عطر بیک شماره 24'),(296,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 10:24:41','185.120.137.201','ویرایش محصولات عطر بیک شماره 23'),(297,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 10:26:36','185.120.137.201','ویرایش محصولات عطر بیک شماره 23'),(298,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 10:26:51','185.120.137.201','ویرایش محصولات عطر بیک شماره 24'),(299,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 11:24:02','185.120.137.201','ویرایش دسته بندی و صفحه درباره ما'),(300,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 11:32:16','185.120.137.201','حذف دسته بندی و صفحه آرشیو-خبر'),(301,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 11:33:30','185.120.137.201','ایجاد دسته بندی و صفحه تست منو'),(302,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 11:34:17','185.120.137.201','حذف دسته بندی و صفحه تست-منو'),(303,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 12:35:58','185.120.137.201','ایجاد دسته بندی و صفحه عطر تبلیغاتی'),(304,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 12:42:56','185.120.137.201','حذف دسته بندی و صفحه اخبار-محصولات'),(305,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 12:45:31','185.120.137.201','ایجاد دسته بندی و صفحه وبلاگ'),(306,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 12:50:03','185.120.137.201','ویرایش صفحه اول بخش پارالاکس دوم'),(307,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 12:51:07','185.120.137.201','ویرایش صفحه اول بخش پارالاکس دوم'),(308,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 12:51:57','185.120.137.201','ویرایش صفحه اول بخش سوم پارالاکس'),(309,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 12:55:50','185.120.137.201','ویرایش صفحه اول بخش سوم پارالاکس'),(310,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 12:57:19','185.120.137.201','ویرایش صفحه اول بخش پارالاکس اول'),(311,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 12:57:59','185.120.137.201','ویرایش صفحه اول بخش پارالاکس اول'),(312,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 13:01:09','185.120.137.201','ویرایش صفحه اول بخش سوم پارالاکس'),(313,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 13:01:25','185.120.137.201','ویرایش صفحه اول بخش پارالاکس دوم'),(314,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 13:03:59','185.120.137.201','ویرایش صفحه اول بخش پارالاکس اول'),(315,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 13:12:34','185.120.137.201','ویرایش صفحه اول بخش پارالاکس اول'),(316,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 13:14:25','2.176.181.23','ویرایش صفحه اول بخش پارالاکس دوم'),(317,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 13:17:22','185.120.137.201','ویرایش صفحه اول بخش پارالاکس اول'),(318,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 13:18:21','185.120.137.201','ویرایش صفحه اول بخش پارالاکس دوم'),(319,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 13:19:30','185.120.137.201','ویرایش صفحه اول بخش پارالاکس دوم'),(320,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 13:22:03','185.120.137.201','ویرایش صفحه اول بخش پارالاکس اول'),(321,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 13:22:35','185.120.137.201','ویرایش صفحه اول بخش پارالاکس دوم'),(322,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 13:22:57','185.120.137.201','ویرایش صفحه اول بخش سوم پارالاکس'),(323,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-07-30 13:28:09','185.120.137.201','ویرایش صفحه اول بخش پارالاکس اول'),(324,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-03 08:57:47','185.120.137.201',' ورورد به کنترل پنل '),(325,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-04 11:30:26','185.120.137.201',' ورورد به کنترل پنل '),(326,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-05 11:58:22','185.120.137.201',' ورورد به کنترل پنل '),(327,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-05 12:00:41','185.120.137.201','ایجاد محصولات کرم مرطوب‌کننده دست و صورت و بدن- 20ml'),(328,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-05 12:01:49','185.120.137.201','ویرایش محصولات کرم مرطوب‌کننده دست و صورت و بدن- 20ml'),(329,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-05 12:08:05','185.120.137.201','ویرایش محصولات کرم مرطوب‌کننده دست و صورت و بدن- 20ml'),(330,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-05 12:15:17','185.120.137.201','ویرایش محتوی صفحه درباره ما'),(331,'1','2019-08-06 18:20:29','5.196.121.49',' ورورد به کنترل پنل '),(332,'1','2019-08-06 18:58:12','5.196.121.49','ویرایش دسته بندی و صفحه کاتالوگ'),(333,'1','2019-08-06 18:59:34','5.196.121.49','ایجاد فایل یا لینک https://bicyar.com/assets/site/cataloge/milano.pdf'),(334,'1','2019-08-06 19:00:22','5.196.121.49','ویرایش فایل یا لینک bicyar.com/assets/site/cataloge/milano.pdf'),(335,'1','2019-08-06 19:07:58','5.196.121.49','ایجاد صفحه اول بخش پارالاکس چهارم'),(336,'1','2019-08-06 19:08:34','5.196.121.49','ویرایش صفحه اول بخش پارالاکس چهارم'),(337,'1','2019-08-06 19:27:35','5.196.121.49','ایجاد  گسترش فناوری آگو'),(338,'1','2019-08-06 19:28:43','5.196.121.49','ویرایش  گسترش فناوری آگو'),(339,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 08:22:30','185.120.137.201',' ورورد به کنترل پنل '),(340,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 08:41:11','185.120.137.201','ویرایش صفحه اول بخش سوم پارالاکس'),(341,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:14:37','185.120.137.201','حذف دسته بندی و صفحه میلانو'),(342,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:14:48','185.120.137.201','حذف دسته بندی و صفحه میلُرد'),(343,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:15:00','185.120.137.201','حذف دسته بندی و صفحه میس‌تین'),(344,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:15:11','185.120.137.201','حذف دسته بندی و صفحه رپیتون'),(345,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:15:23','185.120.137.201','حذف دسته بندی و صفحه سامر'),(346,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:15:33','185.120.137.201','حذف دسته بندی و صفحه دات-کالکشن'),(347,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:15:43','185.120.137.201','حذف دسته بندی و صفحه بیک'),(348,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:15:51','185.120.137.201','حذف دسته بندی و صفحه عطر'),(349,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:16:04','185.120.137.201','حذف دسته بندی و صفحه بیژن'),(350,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:16:42','185.120.137.201','ویرایش دسته بندی و صفحه کرم دست و صورت'),(351,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:19:05','185.120.137.201','ایجاد دسته بندی و صفحه عطر بیک'),(352,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:22:50','185.120.137.201','ویرایش محصولات عطر بیک شماره 24'),(353,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:23:50','185.120.137.201','حذف دسته بندی و صفحه عطر-بیک'),(354,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:24:34','185.120.137.201','ایجاد دسته بندی و صفحه عطر بیک'),(355,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:25:10','185.120.137.201','حذف دسته بندی و صفحه عطر-بیک'),(356,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:25:57','185.120.137.201','ایجاد دسته بندی و صفحه عطر بیک'),(357,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:26:55','185.120.137.201','ویرایش محصولات عطر بیک شماره 1'),(358,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:27:58','185.120.137.201','ویرایش محصولات عطر بیک شماره 2'),(359,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:28:37','185.120.137.201','ویرایش محصولات عطر بیک شماره 3'),(360,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:29:18','185.120.137.201','ویرایش محصولات عطر بیک شماره 4'),(361,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:29:54','185.120.137.201','ویرایش محصولات عطر بیک شماره 5'),(362,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:32:03','185.120.137.201','ویرایش محصولات عطر بیک شماره 5'),(363,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:32:47','185.120.137.201','ویرایش محصولات عطر بیک شماره 4'),(364,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:33:08','185.120.137.201','ویرایش محصولات عطر بیک شماره 1'),(365,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:33:25','185.120.137.201','ویرایش محصولات عطر بیک شماره 2'),(366,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 09:33:56','185.120.137.201','ویرایش محصولات عطر بیک شماره 3'),(367,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:06:31','185.120.137.201','ایجاد محصولات عطر بیک شماره 25'),(368,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:10:37','185.120.137.201','ایجاد محصولات عطر بیک شماره 26'),(369,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:14:48','185.120.137.201','ایجاد محصولات عطر بیک شماره 27'),(370,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:20:07','185.120.137.201','ایجاد محصولات عطر بیک شماره 28'),(371,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:20:20','185.120.137.201','ویرایش محصولات عطر بیک شماره 28'),(372,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:31:51','185.120.137.201','ویرایش محصولات عطر بیک شماره 26'),(373,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:32:29','185.120.137.201','ویرایش محصولات عطر بیک شماره 27'),(374,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:32:54','185.120.137.201','ویرایش محصولات عطر بیک شماره 27'),(375,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:33:35','185.120.137.201','ویرایش محصولات عطر بیک شماره 26'),(376,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:34:11','185.120.137.201','ویرایش محصولات عطر بیک شماره 25'),(377,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:34:36','185.120.137.201','ویرایش محصولات عطر بیک شماره 24'),(378,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:36:12','185.120.137.201','ویرایش محصولات عطر بیک شماره 23'),(379,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:36:40','185.120.137.201','ویرایش محصولات عطر بیک شماره 28'),(380,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:36:56','185.120.137.201','ویرایش محصولات عطر بیک شماره 27'),(381,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:37:13','185.120.137.201','ویرایش محصولات عطر بیک شماره 26'),(382,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:37:31','185.120.137.201','ویرایش محصولات عطر بیک شماره 25'),(383,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:37:52','185.120.137.201','ویرایش محصولات عطر بیک شماره 24'),(384,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:38:05','185.120.137.201','ویرایش محصولات عطر بیک شماره 23'),(385,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:38:32','185.120.137.201','ویرایش محصولات عطر بیک شماره 1'),(386,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:39:13','185.120.137.201','ویرایش محصولات عطر بیک شماره 2'),(387,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:44:38','185.120.137.201','ویرایش محصولات عطر بیک شماره 3'),(388,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:44:58','185.120.137.201','ویرایش محصولات عطر بیک شماره 4'),(389,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:45:24','185.120.137.201','ویرایش محصولات عطر بیک شماره 5'),(390,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:46:43','185.120.137.201','ایجاد دسته بندی و صفحه عطر رپیتون'),(391,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:47:20','185.120.137.201','حذف دسته بندی و صفحه عطر-رپیتون'),(392,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:48:21','185.120.137.201','ایجاد دسته بندی و صفحه عطر رپیتون'),(393,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:49:05','185.120.137.201','ایجاد دسته بندی و صفحه عطر میس‌تین'),(394,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:49:59','185.120.137.201','ایجاد دسته بندی و صفحه عطر میلرد'),(395,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:50:33','185.120.137.201','حذف دسته بندی و صفحه عطر-میلرد'),(396,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:50:55','185.120.137.201','ایجاد دسته بندی و صفحه عطر میلرد'),(397,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:51:04','185.120.137.201','حذف دسته بندی و صفحه عطر-میلرد'),(398,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:51:22','185.120.137.201','ایجاد دسته بندی و صفحه عطر میلرد'),(399,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:51:56','185.120.137.201','حذف دسته بندی و صفحه عطر-میلرد'),(400,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:52:33','185.120.137.201','ایجاد دسته بندی و صفحه عطر میلرد'),(401,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:53:10','185.120.137.201','ایجاد دسته بندی و صفحه عطر میلانو'),(402,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:53:18','185.120.137.201','حذف دسته بندی و صفحه عطر-میلانو'),(403,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:53:43','185.120.137.201','ایجاد دسته بندی و صفحه عطر میلانو'),(404,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:55:12','185.120.137.201','ایجاد دسته بندی و صفحه عطر دات کالکشن'),(405,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:55:19','185.120.137.201','حذف دسته بندی و صفحه عطر-دات کالکشن'),(406,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:55:45','185.120.137.201','ایجاد دسته بندی و صفحه عطر دات کالکشن'),(407,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:55:53','185.120.137.201','حذف دسته بندی و صفحه عطر-دات کالکشن'),(408,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 10:56:15','185.120.137.201','ایجاد دسته بندی و صفحه عطر دات کالکشن'),(409,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 11:16:36','185.120.137.201','ایجاد محصولات کرم 20ml'),(410,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 11:22:26','185.120.137.201','ایجاد محصولات کرم 50ml'),(411,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 11:29:23','185.120.137.201','حذف محصولات کرم 50ml'),(412,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 11:29:29','185.120.137.201','حذف محصولات کرم 20ml'),(413,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 11:32:33','185.120.137.201','ایجاد محصولات کرم خانواده 450ml'),(414,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 11:34:00','185.120.137.201','ایجاد محصولات کرم 200ml'),(415,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 11:35:24','185.120.137.201','ایجاد محصولات کرم 100ml'),(416,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 11:36:51','185.120.137.201','ایجاد محصولات کرم 75ml'),(417,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 11:38:24','185.120.137.201','ایجاد محصولات کرم 50ml'),(418,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 11:40:01','185.120.137.201','ایجاد محصولات کرم 20ml'),(419,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 12:10:08','185.120.137.201','ایجاد محصولات رپیتون شماره 12'),(420,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 12:15:27','185.120.137.201','ایجاد محصولات رپیتون شماره 11'),(421,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 12:20:09','185.120.137.201','ایجاد محصولات رپیتون شماره 10'),(422,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 12:24:22','185.120.137.201','ایجاد محصولات رپیتون شماره 09'),(423,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 12:27:27','185.120.137.201','ایجاد محصولات رپیتون شماره 08'),(424,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 12:32:57','185.120.137.201','ایجاد محصولات رپیتون شماره 07'),(425,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 12:37:19','185.120.137.201','ایجاد محصولات رپیتون شماره 06'),(426,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 12:40:36','185.120.137.201','ایجاد محصولات رپیتون شماره 05'),(427,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 12:46:05','185.120.137.201','ایجاد محصولات رپیتون شماره 04'),(428,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 13:25:40','185.120.137.201','ایجاد محصولات رپیتون شماره 03'),(429,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 13:28:51','185.120.137.201','ایجاد محصولات رپیتون شماره 02'),(430,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 13:31:34','185.120.137.201','ایجاد محصولات رپیتون شماره 01'),(431,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 15:09:30','185.120.137.201','ایجاد محصولات میلانو آبی'),(432,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 15:19:01','185.120.137.201','ویرایش محصولات میلانو آبی'),(433,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 15:24:31','185.120.137.201','ایجاد محصولات میلانو سبز'),(434,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 15:25:19','185.120.137.201','ویرایش محصولات میلانو سبز'),(435,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 15:29:32','185.120.137.201','ایجاد محصولات میلانو قرمز'),(436,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 15:33:00','185.120.137.201','ایجاد محصولات میلانو طلایی'),(437,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 15:36:10','185.120.137.201','ایجاد محصولات میلانو مشکی مات'),(438,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 15:39:18','185.120.137.201','ایجاد محصولات میلانو مشکی براق'),(439,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 15:42:38','185.120.137.201','ایجاد محصولات میلانو سفید مات'),(440,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 16:03:58','185.120.137.201','ایجاد محصولات میلانو سفید براق'),(441,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 16:14:49','185.120.137.201','ایجاد محصولات میس‌تین بنفش'),(442,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 16:17:23','185.120.137.201','ایجاد محصولات میس‌تین طلایی'),(443,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 16:20:47','185.120.137.201','ایجاد محصولات میلُرد مشکی'),(444,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 16:24:00','185.120.137.201','ایجاد محصولات میلُرد آبی'),(445,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-07 16:25:10','185.120.137.201','ویرایش صفحه اول بخش پارالاکس اول'),(446,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-10 10:02:44','185.120.137.201',' ورورد به کنترل پنل '),(447,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-10 10:03:57','185.120.137.201','ویرایش صفحه اول بخش پارالاکس اول'),(448,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-10 10:40:40','185.120.137.201','ویرایش صفحه اول بخش پارالاکس دوم'),(449,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-10 10:46:03','185.120.137.201','ویرایش صفحه اول بخش پارالاکس چهارم'),(450,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-10 10:56:41','185.120.137.201','ویرایش صفحه اول بخش پارالاکس چهارم'),(451,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-10 10:58:06','185.120.137.201','ویرایش صفحه اول بخش پارالاکس چهارم'),(452,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-10 11:07:05','185.120.137.201','ویرایش صفحه اول بخش سوم پارالاکس'),(453,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-10 11:45:41','185.120.137.201','ویرایش صفحه اول بخش سوم پارالاکس'),(454,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-11 15:19:11','185.120.137.201',' ورورد به کنترل پنل '),(455,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-11 15:35:17','185.120.137.201','ویرایش دسته بندی و صفحه عطر تبلیغاتی'),(456,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-12 08:48:48','204.18.220.201',' ورورد به کنترل پنل '),(457,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-12 13:53:14','204.18.220.201',' ورورد به کنترل پنل '),(458,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-12 14:00:33','204.18.220.201','ایجاد دسته بندی و صفحه فروش ویژه'),(459,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-12 14:59:03','204.18.220.201','حذف دسته بندی و صفحه فروش-ویژه'),(460,'1','2019-08-12 18:06:23','2.190.69.188',' ورورد به کنترل پنل '),(461,'1','2019-08-12 18:07:40','2.190.69.188','ایجاد دسته بندی و صفحه فروش ویژه'),(462,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:28:10','185.120.137.201',' ورورد به کنترل پنل '),(463,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:29:33','185.120.137.201','ویرایش محصولات عطر بیک شماره 1'),(464,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:30:03','185.120.137.201','ویرایش محصولات عطر بیک شماره 2'),(465,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:30:25','185.120.137.201','ویرایش محصولات عطر بیک شماره 3'),(466,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:30:59','185.120.137.201','ویرایش محصولات عطر بیک شماره 4'),(467,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:31:27','185.120.137.201','ویرایش محصولات عطر بیک شماره 5'),(468,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:32:22','185.120.137.201','ویرایش محصولات عطر بیک شماره 28'),(469,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:32:48','185.120.137.201','ویرایش محصولات عطر بیک شماره 27'),(470,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:33:18','185.120.137.201','ویرایش محصولات عطر بیک شماره 26'),(471,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:34:12','185.120.137.201','ویرایش محصولات عطر بیک شماره 25'),(472,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:34:44','185.120.137.201','ویرایش محصولات عطر بیک شماره 24'),(473,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:35:37','185.120.137.201','ویرایش محصولات عطر بیک شماره 28'),(474,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:35:53','185.120.137.201','ویرایش محصولات عطر بیک شماره 27'),(475,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:36:18','185.120.137.201','ویرایش محصولات عطر بیک شماره 26'),(476,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:36:59','185.120.137.201','ویرایش محصولات عطر بیک شماره 24'),(477,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:37:30','185.120.137.201','ویرایش محصولات عطر بیک شماره 25'),(478,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:38:10','185.120.137.201','ویرایش محصولات عطر بیک شماره 1'),(479,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:38:31','185.120.137.201','ویرایش محصولات عطر بیک شماره 2'),(480,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:38:53','185.120.137.201','ویرایش محصولات عطر بیک شماره 3'),(481,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:40:12','185.120.137.201','ویرایش محصولات عطر بیک شماره 8'),(482,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:40:47','185.120.137.201','ویرایش محصولات عطر بیک شماره 4'),(483,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:41:27','185.120.137.201','ویرایش محصولات عطر بیک شماره 5'),(484,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:42:01','185.120.137.201','ویرایش محصولات عطر بیک شماره 6'),(485,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:43:01','185.120.137.201','ویرایش محصولات عطر بیک شماره 7'),(486,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:43:37','185.120.137.201','ویرایش محصولات عطر بیک شماره 9'),(487,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:44:27','185.120.137.201','ویرایش محصولات عطر بیک شماره 10'),(488,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:44:48','185.120.137.201','ویرایش محصولات عطر بیک شماره 11'),(489,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:45:11','185.120.137.201','ویرایش محصولات عطر بیک شماره 12'),(490,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:45:36','185.120.137.201','ویرایش محصولات عطر بیک شماره 13'),(491,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:46:01','185.120.137.201','ویرایش محصولات عطر بیک شماره 13'),(492,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:46:49','185.120.137.201','ویرایش محصولات عطر بیک شماره 15'),(493,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:47:09','185.120.137.201','ویرایش محصولات عطر بیک شماره 16'),(494,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:47:31','185.120.137.201','ویرایش محصولات عطر بیک شماره 17'),(495,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:48:10','185.120.137.201','ویرایش محصولات عطر بیک شماره 14'),(496,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:49:02','185.120.137.201','ویرایش محصولات عطر بیک شماره 18'),(497,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:49:25','185.120.137.201','ویرایش محصولات عطر بیک شماره 19'),(498,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:49:48','185.120.137.201','ویرایش محصولات عطر بیک شماره 22'),(499,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:50:29','185.120.137.201','ویرایش محصولات عطر بیک شماره 20'),(500,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:51:00','185.120.137.201','ویرایش محصولات عطر بیک شماره 28'),(501,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:51:23','185.120.137.201','ویرایش محصولات عطر بیک شماره 27'),(502,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:51:42','185.120.137.201','ویرایش محصولات عطر بیک شماره 26'),(503,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:52:08','185.120.137.201','ویرایش محصولات عطر بیک شماره 25'),(504,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:52:51','185.120.137.201','ویرایش محصولات عطر بیک شماره 24'),(505,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:53:24','185.120.137.201','ویرایش محصولات عطر بیک شماره 21'),(506,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:53:48','185.120.137.201','ویرایش محصولات عطر بیک شماره 23'),(507,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:54:48','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 1'),(508,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:55:14','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 2'),(509,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:55:38','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 3'),(510,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:56:05','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 4'),(511,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:56:30','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 5'),(512,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:56:53','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 6'),(513,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:57:29','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 7'),(514,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:57:48','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 8'),(515,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:58:19','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 9'),(516,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:58:40','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 10'),(517,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:59:23','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 11'),(518,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 09:59:45','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 12'),(519,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 10:03:37','185.120.137.201','ویرایش محصولات میس‌تین بنفش'),(520,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 10:04:58','185.120.137.201','ویرایش محصولات رپیتون شماره 07'),(521,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 10:09:57','185.120.137.201','ویرایش محصولات میلُرد آبی'),(522,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 10:13:48','185.120.137.201','ویرایش محصولات میلُرد مشکی'),(523,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 10:22:40','185.120.137.201','ویرایش محصولات میلُرد آبی'),(524,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 10:23:57','185.120.137.201','ویرایش محصولات میلُرد مشکی'),(525,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 10:28:10','185.120.137.201','ویرایش محصولات میس‌تین طلایی'),(526,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 10:30:08','185.120.137.201','ویرایش محصولات میس‌تین بنفش'),(527,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 10:34:15','185.120.137.201','ویرایش محصولات میلانو سفید براق'),(528,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 10:35:11','185.120.137.201','ویرایش محصولات میلانو سفید براق'),(529,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 10:37:09','185.120.137.201','ویرایش محصولات میلانو سفید مات'),(530,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 10:40:09','185.120.137.201','ویرایش محصولات میلانو مشکی براق'),(531,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 10:41:38','185.120.137.201','ویرایش محصولات میلانو مشکی مات'),(532,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 10:43:14','185.120.137.201','ویرایش محصولات میلانو طلایی'),(533,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 10:46:12','185.120.137.201','ویرایش محصولات میلانو قرمز'),(534,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 10:48:13','185.120.137.201','ویرایش محصولات میلانو سبز'),(535,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 10:49:52','185.120.137.201','ویرایش محصولات میلانو آبی'),(536,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 10:51:50','185.120.137.201','ویرایش محصولات رپیتون شماره 01'),(537,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 10:53:31','185.120.137.201','ویرایش محصولات رپیتون شماره 02'),(538,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 10:56:13','185.120.137.201','ویرایش محصولات رپیتون شماره 03'),(539,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 10:57:30','185.120.137.201','ویرایش محصولات رپیتون شماره 04'),(540,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 11:00:36','185.120.137.201','ویرایش محصولات رپیتون شماره 05'),(541,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 11:03:23','185.120.137.201','ویرایش محصولات رپیتون شماره 06'),(542,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 11:04:38','185.120.137.201','ویرایش محصولات رپیتون شماره 07'),(543,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 11:06:15','185.120.137.201','ویرایش محصولات رپیتون شماره 08'),(544,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 11:07:42','185.120.137.201','ویرایش محصولات رپیتون شماره 09'),(545,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 11:08:49','185.120.137.201','ویرایش محصولات رپیتون شماره 10'),(546,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 11:10:59','185.120.137.201','ویرایش محصولات رپیتون شماره 11'),(547,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 11:14:41','185.120.137.201','ویرایش محصولات رپیتون شماره 12'),(548,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 11:19:15','185.120.137.201','ویرایش محصولات عطر بیک شماره 1'),(549,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 11:21:07','185.120.137.201','ویرایش محصولات عطر بیک شماره 2'),(550,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 11:23:48','185.120.137.201','ویرایش محصولات عطر بیک شماره 3'),(551,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 11:26:29','185.120.137.201','ویرایش محصولات عطر بیک شماره 4'),(552,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 11:28:26','185.120.137.201','ویرایش محصولات عطر بیک شماره 5'),(553,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 11:30:21','185.120.137.201','ویرایش محصولات عطر بیک شماره 6'),(554,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 11:31:47','185.120.137.201','ویرایش محصولات عطر بیک شماره 7'),(555,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 11:33:43','185.120.137.201','ویرایش محصولات عطر بیک شماره 8'),(556,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 11:41:25','185.120.137.201','ویرایش محصولات عطر بیک شماره 9'),(557,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 11:42:48','185.120.137.201','ویرایش محصولات عطر بیک شماره 10'),(558,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 11:45:46','185.120.137.201','ویرایش محصولات عطر بیک شماره 11'),(559,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 11:47:52','185.120.137.201','ویرایش محصولات عطر بیک شماره 12'),(560,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 11:49:27','185.120.137.201','ویرایش محصولات عطر بیک شماره 13'),(561,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 11:51:07','185.120.137.201','ویرایش محصولات عطر بیک شماره 14'),(562,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 11:52:11','185.120.137.201','ویرایش محصولات عطر بیک شماره 15'),(563,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:01:24','185.120.137.201','ویرایش محصولات عطر بیک شماره 16'),(564,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:03:08','185.120.137.201','ویرایش محصولات عطر بیک شماره 17'),(565,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:04:39','185.120.137.201','ویرایش محصولات عطر بیک شماره 18'),(566,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:07:01','185.120.137.201','ویرایش محصولات عطر بیک شماره 19'),(567,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:09:35','185.120.137.201','ویرایش محصولات عطر بیک شماره 20'),(568,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:11:25','185.120.137.201','ویرایش محصولات عطر بیک شماره 21'),(569,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:12:47','185.120.137.201','ویرایش محصولات عطر بیک شماره 22'),(570,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:14:20','185.120.137.201','ویرایش محصولات عطر بیک شماره 23'),(571,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:20:58','185.120.137.201','ویرایش محصولات عطر بیک شماره 24'),(572,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:22:53','185.120.137.201','ویرایش محصولات عطر بیک شماره 25'),(573,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:25:15','185.120.137.201','ویرایش محصولات عطر بیک شماره 26'),(574,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:28:49','185.120.137.201','ویرایش محصولات عطر بیک شماره 27'),(575,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:30:15','185.120.137.201','ویرایش محصولات عطر بیک شماره 28'),(576,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:35:36','185.120.137.201','ویرایش محصولات اسپری بدن شماره 1'),(577,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:36:38','185.120.137.201','ویرایش محصولات اسپری بدن شماره 2'),(578,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:37:44','185.120.137.201','ویرایش محصولات اسپری بدن شماره 3'),(579,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:43:24','185.120.137.201','ویرایش محصولات اسپری بدن شماره 4'),(580,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:45:35','185.120.137.201','ویرایش محصولات اسپری بدن شماره 5'),(581,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:46:47','185.120.137.201','ویرایش محصولات اسپری بدن شماره 6'),(582,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:48:06','185.120.137.201','ویرایش محصولات اسپری بدن شماره 7'),(583,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:50:44','185.120.137.201','ویرایش محصولات اسپری بدن شماره 8'),(584,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:53:03','185.120.137.201','ویرایش محصولات اسپری بدن شماره 9'),(585,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:56:07','185.120.137.201','ویرایش محصولات اسپری بدن شماره 10'),(586,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:57:32','185.120.137.201','ویرایش محصولات اسپری بدن شماره 11'),(587,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:58:35','185.120.137.201','ویرایش محصولات اسپری بدن شماره 12'),(588,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:59:41','185.120.137.201','ویرایش محصولات عطر بیک شماره 1'),(589,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 12:59:57','185.120.137.201','ویرایش محصولات عطر بیک شماره 4'),(590,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 13:00:09','185.120.137.201','ویرایش محصولات عطر بیک شماره 5'),(591,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 13:00:21','185.120.137.201','ویرایش محصولات عطر بیک شماره 6'),(592,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 13:00:35','185.120.137.201','ویرایش محصولات عطر بیک شماره 7'),(593,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 13:00:48','185.120.137.201','ویرایش محصولات عطر بیک شماره 8'),(594,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 13:01:00','185.120.137.201','ویرایش محصولات عطر بیک شماره 9'),(595,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 13:01:59','185.120.137.201','ویرایش محصولات عطر بیک شماره 10'),(596,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 13:02:13','185.120.137.201','ویرایش محصولات عطر بیک شماره 11'),(597,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 13:02:34','185.120.137.201','ویرایش محصولات عطر بیک شماره 12'),(598,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 13:02:55','185.120.137.201','ویرایش محصولات عطر بیک شماره 13'),(599,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 13:03:17','185.120.137.201','ویرایش محصولات عطر بیک شماره 14'),(600,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 13:03:29','185.120.137.201','ویرایش محصولات عطر بیک شماره 15'),(601,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 13:03:43','185.120.137.201','ویرایش محصولات عطر بیک شماره 16'),(602,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 13:03:55','185.120.137.201','ویرایش محصولات عطر بیک شماره 17'),(603,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 13:04:08','185.120.137.201','ویرایش محصولات عطر بیک شماره 18'),(604,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 13:04:20','185.120.137.201','ویرایش محصولات عطر بیک شماره 19'),(605,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 13:04:46','185.120.137.201','ویرایش محصولات عطر بیک شماره 24'),(606,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 13:05:10','185.120.137.201','ویرایش محصولات عطر بیک شماره 27'),(607,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 13:05:58','185.120.137.201','ویرایش محصولات کرم مرطوب‌کننده دست و صورت و بدن- 20ml'),(608,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 13:07:31','185.120.137.201','حذف محصولات کرم مرطوب‌کننده دست و صورت و بدن  20ml'),(609,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 13:56:58','185.120.137.201','ویرایش صفحه اول بخش پارالاکس دوم'),(610,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 14:07:43','185.120.137.201','ویرایش صفحه اول بخش سوم پارالاکس'),(611,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 14:13:32','185.120.137.201','ویرایش صفحه اول بخش پارالاکس چهارم'),(612,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 15:24:17','185.120.137.201','ویرایش محصولات میس‌تین بنفش'),(613,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 15:24:35','185.120.137.201','ویرایش محصولات رپیتون شماره 07'),(614,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 15:25:10','185.120.137.201','ویرایش محصولات عطر بیک شماره 19'),(615,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 15:25:39','185.120.137.201','ویرایش محصولات عطر بیک شماره 8'),(616,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 15:25:53','185.120.137.201','ویرایش محصولات عطر بیک شماره 16'),(617,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 15:26:43','185.120.137.201','ویرایش محصولات عطر بیک شماره 19'),(618,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 15:27:01','185.120.137.201','ویرایش محصولات عطر بیک شماره 16'),(619,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-13 15:27:34','185.120.137.201','ویرایش محصولات عطر بیک شماره 8'),(620,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-14 11:02:33','185.120.137.201',' ورورد به کنترل پنل '),(621,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-17 10:55:06','185.120.137.201',' ورورد به کنترل پنل '),(622,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-17 11:05:03','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 12'),(623,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-17 11:07:09','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 1'),(624,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-17 11:09:27','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 2'),(625,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-17 11:11:21','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 11'),(626,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-17 11:12:41','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 3'),(627,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-17 11:14:04','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 4'),(628,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-17 11:15:52','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 5'),(629,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-17 11:19:22','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 6'),(630,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-17 11:22:34','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 7'),(631,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-17 11:23:59','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 8'),(632,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-17 11:25:21','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 9'),(633,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-17 11:26:24','185.120.137.201','ویرایش محصولات عطر دات کالکشن شماره 10'),(634,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-18 12:15:54','185.120.137.201',' ورورد به کنترل پنل '),(635,'1','2019-08-18 17:17:29','147.135.204.124',' ورورد به کنترل پنل '),(636,'1','2019-08-18 17:29:54','147.135.204.124','ایجاد دسته بندی و صفحه شرکت در قرعه کشی'),(637,'1','2019-08-18 17:56:32','147.135.204.124','ویرایش دسته بندی و صفحه عطر تبلیغاتی'),(638,'1','2019-08-18 17:56:54','147.135.204.124','ویرایش دسته بندی و صفحه عطر تبلیغاتی1'),(639,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 10:32:05','185.120.137.201',' ورورد به کنترل پنل '),(640,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 10:35:57','185.120.137.201','حذف دسته بندی و صفحه عطر-تبلیغاتی'),(641,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 10:37:11','185.120.137.201','ایجاد دسته بندی و صفحه وبلاگ'),(642,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 10:37:37','185.120.137.201','حذف دسته بندی و صفحه وبلاگ'),(643,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 10:45:01','185.120.137.201','ایجاد دسته بندی و صفحه وانیل'),(644,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 10:46:14','185.120.137.201','حذف دسته بندی و صفحه وانیل'),(645,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 10:47:02','185.120.137.201','ایجاد دسته بندی و صفحه وانیل'),(646,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 10:47:25','185.120.137.201','حذف دسته بندی و صفحه وانیل'),(647,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 10:48:55','185.120.137.201','ایجاد دسته بندی و صفحه درباره گیاهان معطر چه میدانید؟'),(648,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 10:49:28','185.120.137.201','حذف دسته بندی و صفحه درباره-گیاهان معطر چه میدانید؟'),(649,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 11:03:16','185.120.137.201','ویرایش محتوی صفحه درباره ما'),(650,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 11:06:49','185.120.137.201','ایجاد دسته بندی و صفحه درباره گیاهان معطر چه میدانید؟'),(651,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 11:11:00','185.120.137.201','ایجاد اخبار و مقاله تست'),(652,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 11:13:15','185.120.137.201','حذف دسته بندی و صفحه درباره-گیاهان معطر چه میدانید؟'),(653,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 11:25:36','185.120.137.201','حذف اخبار و مقاله تست'),(654,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 11:31:35','185.120.137.201','ایجاد اخبار و مقاله تیتر'),(655,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 11:45:47','185.120.137.201','ایجاد اخبار و مقاله برگاموت چیست؟'),(656,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 11:57:28','185.120.137.201','ایجاد اخبار و مقاله گل جاسمین'),(657,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 12:05:41','185.120.137.201','حذف اخبار و مقاله کرم دست و صورت بیژن'),(658,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 12:26:00','185.120.137.201','ایجاد اخبار و مقاله کرم دست و صورت بیژن'),(659,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 12:29:28','185.120.137.201','ایجاد دسته بندی و صفحه عطر تبلیغاتی'),(660,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 12:35:57','185.120.137.201','ایجاد اخبار و مقاله برند Nike'),(661,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 12:40:16','185.120.137.201','ایجاد اخبار و مقاله نوشیدنی پامیرکولا'),(662,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 12:51:37','185.120.137.201','ایجاد اخبار و مقاله Giti'),(663,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 12:54:10','185.120.137.201','ایجاد اخبار و مقاله لوازم خانگی SUN'),(664,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 12:55:46','185.120.137.201','ایجاد اطلاعات ارتباطی عنوان اطلاعات ارتباطی'),(665,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 12:56:53','185.120.137.201','ویرایش اطلاعات ارتباطی عنوان اطلاعات ارتباطی'),(666,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 12:58:10','185.120.137.201','ایجاد اطلاعات ارتباطی عنوان اطلاعات ارتباطی'),(667,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 13:03:02','185.120.137.201','ایجاد دسته بندی و صفحه عطر بیک'),(668,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 13:06:41','185.120.137.201','ایجاد دسته بندی و صفحه عطر دات کالکشن'),(669,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 15:33:27','185.120.137.201','ایجاد دسته بندی و صفحه درباره گیاهان معطر چه میدانید؟'),(670,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-19 15:34:26','185.120.137.201','حذف دسته بندی و صفحه درباره-گیاهان معطر چه میدانید؟'),(671,'1','2019-08-24 15:17:08','147.135.204.124',' ورورد به کنترل پنل '),(672,'1','2019-08-24 16:55:59','147.135.204.124',' ورورد به کنترل پنل '),(673,'1','2019-08-24 16:57:21','147.135.204.124','ویرایش دسته بندی و صفحه عطر بیک'),(674,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-25 10:41:41','185.120.137.201',' ورورد به کنترل پنل '),(675,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-25 14:59:35','185.120.137.201',' ورورد به کنترل پنل '),(676,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-26 12:12:43','89.198.72.157',' ورورد به کنترل پنل '),(677,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-26 16:17:10','185.120.137.201',' ورورد به کنترل پنل '),(678,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-26 16:47:59','89.198.72.157',' ورورد به کنترل پنل '),(679,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-26 16:49:06','89.198.72.157','ویرایش محصولات میلُرد آبی'),(680,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-26 16:53:31','185.120.137.201',' ورورد به کنترل پنل '),(681,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-08-26 17:11:03','89.198.72.157','ویرایش محصولات میلُرد آبی'),(682,'1','2019-08-28 17:57:00','147.135.204.124',' ورورد به کنترل پنل '),(683,'1','2019-08-28 18:04:53','147.135.204.124','ایجاد تابلو اعلانات تست 1'),(684,'1','2019-08-28 18:19:02','147.135.204.124','ایجاد تابلو اعلانات تست 2'),(685,'1','2019-08-28 18:19:40','147.135.204.124','ایجاد تابلو اعلانات تست 3'),(686,'1','2019-08-28 18:20:04','147.135.204.124','ویرایش تابلو اعلانات تست 1'),(687,'1','2019-08-31 15:13:49','2.176.144.108',' ورورد به کنترل پنل '),(688,'1','2019-08-31 15:14:14','2.176.144.108','ایجاد تابلو اعلانات تست'),(689,'1','2019-08-31 15:14:24','2.176.144.108','ویرایش تابلو اعلانات تست'),(690,'1','2019-08-31 15:14:32','2.176.144.108','ویرایش تابلو اعلانات تست'),(691,'0FBC8FE4-1EFB-4D61-ABFD-769210179AF4','2019-09-03 09:28:06','185.120.137.201',' ورورد به کنترل پنل ');
/*!40000 ALTER TABLE `tbl_user_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_sm`
--

DROP TABLE IF EXISTS `tbl_user_sm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user_sm` (
  `userGUID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `userName` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `userMobileNo` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userEmail` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `userLocation` int(4) NOT NULL,
  `userPassword` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `userAccount` int(11) NOT NULL DEFAULT 0,
  `userStatus` enum('e','d') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`userGUID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_sm`
--

LOCK TABLES `tbl_user_sm` WRITE;
/*!40000 ALTER TABLE `tbl_user_sm` DISABLE KEYS */;
INSERT INTO `tbl_user_sm` (`userGUID`, `userName`, `userMobileNo`, `userEmail`, `userLocation`, `userPassword`, `userAccount`, `userStatus`, `created_at`, `updated_at`) VALUES ('826E26C7-9D8B-49C3-A7CA-3EE3353782A5','سحر علي پور','09128202124','sahar64_alp@yahoo.com',89,'95b75596607a70b12a0',0,'e','2019-09-03 15:32:47',NULL),('8D7DBCDE-E383-4EA4-819B-ED5E2E55C92B','مهدی حیدرپور','09128059054','Mahdiano1988@gmail.com',89,'bdbbd1839bf8c580d83',0,'e','2019-08-25 21:26:56',NULL),('9BE4033E-FF5F-41C7-88B7-21E6426E04F9','حسین حقگو','09112446142','titipool2@gmail.com',218,'1f3379d094af47e09dd',0,'e','2019-08-16 15:29:09',NULL),('9D33C80E-3CBC-495B-B2B7-0CD04D715675','فاطمه تاجوران','09171341073','Soneya159@yahoo.com',198,'abd714c105091fd6297',0,'e','2019-08-06 12:55:44',NULL),('C1D961D3-E700-47CA-B29B-68A3DFC9766C','حمیدرضا دامغانی','09125003129','damghani@yahoo.com',89,'14aea43b65c9a0bfd60',0,'e','2019-08-27 09:35:21',NULL),('DEB7F074-158B-42AF-BBE9-0AABFBBE3D1C','علی اصغر توحیدی فر','09105499103','Tkourush@gmail.com',133,'152811cfd8b90428ed5',0,'e','2019-08-15 12:47:59',NULL),('ED6BFCB0-F17C-474A-9372-A8DA63668390','ali','09121953419','ali.rajabi.1990@gmail.com',89,'a9127d46f9c7c690972',0,'e','2019-07-23 14:09:53',NULL),('F132A122-8CBD-4B7D-A8E0-7A59657B25A8','جعفر پورمجیب','09122405231','fiachehr@yahoo.com',89,'dd93bf3cdbddd5c2670',0,'e','2019-07-16 19:29:27',NULL);
/*!40000 ALTER TABLE `tbl_user_sm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_sm_address`
--

DROP TABLE IF EXISTS `tbl_user_sm_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user_sm_address` (
  `addressGUID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `addressUserGUID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`addressGUID`),
  KEY `addressUserGUID` (`addressUserGUID`),
  CONSTRAINT `tbl_user_sm_address_ibfk_1` FOREIGN KEY (`addressUserGUID`) REFERENCES `tbl_user_sm` (`userGUID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_sm_address`
--

LOCK TABLES `tbl_user_sm_address` WRITE;
/*!40000 ALTER TABLE `tbl_user_sm_address` DISABLE KEYS */;
INSERT INTO `tbl_user_sm_address` (`addressGUID`, `addressUserGUID`, `address`) VALUES ('0A7D0D33-7897-47D1-9776-39821C140744','F132A122-8CBD-4B7D-A8E0-7A59657B25A8','اندیشه شمالی'),('25BAD52C-6994-4937-A5D2-712ADC00373A','9D33C80E-3CBC-495B-B2B7-0CD04D715675','فارس - داراب -خیابان سلمان فارسی سه راه نهضت پلاک 176'),('271F67BA-3AB6-4DC1-AC7E-1519710F7B62','C1D961D3-E700-47CA-B29B-68A3DFC9766C','بزرگراه خرازی غرب-دریاچه خلیج فارس-میدان ساحل-مجتمع مسکونی پارسیا- بلوک سرو 3- واحد 16'),('59ACE7A3-C56D-42E5-B858-795F7357E211','DEB7F074-158B-42AF-BBE9-0AABFBBE3D1C','نیشابور شهر بار'),('8B1133DD-082D-4113-89A7-6E853242D254','F132A122-8CBD-4B7D-A8E0-7A59657B25A8','sadsdas'),('94F1C478-4ADB-4C98-BC5F-98B49C6340F6','826E26C7-9D8B-49C3-A7CA-3EE3353782A5','انتهاي فاطمي غربي، نرسيده به جمالزاده، كوچه پروين، پلاك 5'),('C1D2A2C5-36F8-4BF5-914E-8F703C0490A5','9BE4033E-FF5F-41C7-88B7-21E6426E04F9','چهارصددستگاه'),('D1BF5B78-6B15-4E1E-B393-88AE74F482CA','F132A122-8CBD-4B7D-A8E0-7A59657B25A8','جنت آباد'),('D995367B-6ED3-4996-AAE2-48ADC6333D9E','8D7DBCDE-E383-4EA4-819B-ED5E2E55C92B','تهران. میدان آرژانتین. خیابان بخارست. نبش 11 ام. ساختمان 38. طبقه 2 واحد9'),('E96AF2BA-C0BA-45F3-B179-98EF88831CBF','ED6BFCB0-F17C-474A-9372-A8DA63668390','تهران - خیابان مطهری - خیابان لارستان - پلاک 14');
/*!40000 ALTER TABLE `tbl_user_sm_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'bicyar_DB'
--

--
-- Dumping routines for database 'bicyar_DB'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-07  9:58:13
