-- MySQL dump 10.13  Distrib 5.1.41, for debian-linux-gnu (i486)
--
-- Host: localhost    Database: rssreader
-- ------------------------------------------------------
-- Server version	5.1.41-3

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
-- Table structure for table `xy_category`
--

DROP TABLE IF EXISTS `xy_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xy_category` (
  `category_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_type` varchar(255) DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `category_order` int(11) unsigned DEFAULT NULL,
  `catetory_display` int(11) DEFAULT '1',
  PRIMARY KEY (`category_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xy_category`
--

LOCK TABLES `xy_category` WRITE;
/*!40000 ALTER TABLE `xy_category` DISABLE KEYS */;
INSERT INTO `xy_category` VALUES (1,'member','04',2,1),(2,'member','05',4,1),(3,'member','06',6,1),(4,'member','07',8,1),(5,'member','08',10,1),(6,'member','09',12,1);
/*!40000 ALTER TABLE `xy_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xy_member`
--

DROP TABLE IF EXISTS `xy_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xy_member` (
  `member_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `member_category_ID` bigint(20) unsigned DEFAULT '0',
  `member_login_name` varchar(255) NOT NULL DEFAULT '',
  `member_real_name` varchar(255) DEFAULT 'è¯¥æˆå‘˜å°šæœªæ·»åŠ ',
  `member_blog` varchar(255) DEFAULT '',
  `member_rss_url` varchar(255) DEFAULT '',
  `member_show_rss` char(1) DEFAULT 'N',
  `member_QQ` varchar(255) DEFAULT '',
  `member_mobile` varchar(255) DEFAULT '',
  `member_major` varchar(255) DEFAULT '',
  `member_pwd` varchar(255) NOT NULL DEFAULT '00000000',
  `member_image` varchar(255) NOT NULL DEFAULT 'http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg',
  PRIMARY KEY (`member_ID`),
  UNIQUE KEY `member_name` (`member_login_name`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xy_member`
--

LOCK TABLES `xy_member` WRITE;
/*!40000 ALTER TABLE `xy_member` DISABLE KEYS */;
INSERT INTO `xy_member` VALUES (1,1,'ybmmwjl@163.com','å®™æ–¯','ä¸ƒåº¦é»‘å…‰','http://zhwen.org/xlog/feed','N','','','','00000000','http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),(2,1,'example@gmail.com','èµ«æ‹‰','ä¸ƒåº¦é»‘å…‰','http://zhwen.org/xlog/feed','N','','','','00000000','http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),(3,1,'example1@gmail.com','èµ«å°”å¢¨æ–¯','ä¸ƒåº¦é»‘å…‰','','N','','','','00000000','http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),(4,1,'example3@gmail.com','é˜¿æ³¢ç½—','','','N','','','','00000000','http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),(5,6,'example4@gmail.com','é›…å…¸å¨œ','å…³äºŽæ´—èŒ¶','http://blog.sina.com.cn/rss/elina.xml','N','','','','00000000','http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),(7,6,'example5@gmail.com','å‘å¼—æ´›ç‹„å¿’','','','N','','','','00000000','http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),(8,6,'example6@gmail.com','é˜¿ç‘žæ–¯','','','N','','','','00000000','http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),(9,3,'example7@gmail.com','å“ˆå¾·æ–¯','å…³äºŽæ´—èŒ¶','http://blog.sina.com.cn/rss/elina.xml','N','','','','00000000','http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),(10,3,'example8@gmail.com','æ³¢å¡žå†¬','ä¸Šå–„è‹¥æ°´','http://blog.sina.com.cn/rss/sally90.xml','N','','','','00000000','http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),(11,3,'example9@gmail.com','ç€è€³å¡žç¦æ','','','N','','','','00000000','http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),(12,4,'example10@gmail.com','ç›–äºš','ä¸Šå–„è‹¥æ°´','http://blog.sina.com.cn/rss/sally90.xml','N','','','','00000000','http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),(13,4,'example11@gmail.com','ä¹Œæ‹‰è¯ºæ–¯','','','N','','','','00000000','http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),(14,4,'example12@gmail.com','æ™®ç½—ç±³ä¿®æ–¯','','','N','','','','00000000','http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),(15,4,'example13@gmail.com','èµ«å‡†æ–¯æ‰˜æ–¯','','','N','','','','00000000','http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),(16,4,'example14@gmail.com','èµ«æ‹‰å…‹å‹’æ–¯','','','N','','','','00000000','http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),(17,4,'example15@gmail.com','é˜¿å–€ç‰æ–¯','','','N','','','','00000000','http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),(18,4,'example16@gmail.com','å¿’ä¿®æ–¯','','','N','','','','00000000','http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),(19,4,'example17@gmail.com','è¿«ç‰æ–¯','','','N','','','','00000000','http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),(20,4,'example18@gmail.com','å¿’æ‹‰è’™','','','N','','','','00000000','http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),(21,4,'example20@gmail.com','åŸƒé˜¿æ–¯','','','N','','','','00000000','http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),(22,4,'example21@gmail.com','ä»£è¾¾ç½—æ–¯','','','N','','','','00000000','http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg');
/*!40000 ALTER TABLE `xy_member` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-02-07 18:35:06
