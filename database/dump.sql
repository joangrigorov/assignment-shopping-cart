CREATE DATABASE  IF NOT EXISTS `shopping_cart` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `shopping_cart`;
-- MySQL dump 10.13  Distrib 5.6.24, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: shopping_cart
-- ------------------------------------------------------
-- Server version	5.6.24-0ubuntu2

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
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sessionID` char(26) DEFAULT NULL,
  `product` int(11) DEFAULT NULL,
  `quantityRequested` int(10) unsigned DEFAULT NULL,
  `dateAdded` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_cart_1_idx` (`product`),
  KEY `session_id` (`sessionID`),
  CONSTRAINT `fk_cart_1` FOREIGN KEY (`product`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discount_coupon`
--

DROP TABLE IF EXISTS `discount_coupon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discount_coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `discountRate` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discount_coupon`
--

LOCK TABLES `discount_coupon` WRITE;
/*!40000 ALTER TABLE `discount_coupon` DISABLE KEYS */;
REPLACE INTO `discount_coupon` VALUES (1,'DISC23',25),(2,'DISC28',40);
/*!40000 ALTER TABLE `discount_coupon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentOrder` int(11) DEFAULT NULL,
  `product` int(11) DEFAULT NULL,
  `quantityRequested` int(10) unsigned DEFAULT NULL,
  `pricePurchased` float(12,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_items_1_idx` (`parentOrder`),
  KEY `fk_order_items_2_idx` (`product`),
  CONSTRAINT `fk_order_items_1` FOREIGN KEY (`parentOrder`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
  CONSTRAINT `fk_order_items_2` FOREIGN KEY (`product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
REPLACE INTO `order_items` VALUES (8,19,6,1,304.00),(9,20,8,1,201.00),(10,20,7,1,249.00);
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `totalPrice` float(12,2) DEFAULT NULL,
  `firstName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
REPLACE INTO `orders` VALUES (18,'2015-05-01 04:02:35',0.00,NULL,NULL,NULL,NULL,NULL,NULL),(19,'2015-05-01 04:05:24',304.00,'Joan','Grigorov','7 Maxim Raykovich street','Drezden','Bulgaria','(123) 142-5122'),(20,'2015-05-01 04:07:03',337.50,'Joan','Grigorov','7 Maxim Raykovich street','Drezden','Bulgaria','(123) 142-5122');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `shortDescription` varchar(225) DEFAULT NULL,
  `fullDescription` text,
  `price` float(12,2) DEFAULT NULL,
  `photo` varchar(45) DEFAULT NULL,
  `quantityAvailable` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
REPLACE INTO `products` VALUES (6,'Odyssey OAS130 Alto Saxophone Outfit','The OdysseyTM Alto SaXophone SaXophone is a tremendously popular entry-level choice featuring a durable, attractive polished gold clear lacquer brass body, engraved bell.','Product Description\r\n\r\nThe OdysseyTM Alto SaXophone SaXophone is a tremendously popular entry-level choice featuring a durable, attractive polished gold clear lacquer brass body, engraved bell, power forged keywork, stainless steel rods, springs and pins, pearloid keycaps, high F# key, single braced pad cup on low C, fine tuning adjustment, quality pads and mouthpiece, adjustable thumb rest. Supplied with cork grease, locking deluxe neck strap, reed and instruction guide. The ABS Hard Case is lightweight, strong and durable with a plush lined, snug-fit black interior and comfort carry handle. Absolutely ideal for novices & beginners who are just starting out, the Odyssey OAS130 is an affordable, popular choice throughout the UK.\r\n\r\nManufacturer\'s Description\r\nGenerations of experience, precise design, modern hi-tech manufacturing techniques, careful quality control, consistent attention to detail, and a personal touch are all hallmarks of Oddyssey instruments.',304.00,NULL,20),(7,'\'Paolo Mark\' Alto','Stunning \'Paolo Mark\' Alto Saxophone with Case + Accessories Extremely nice tone given the low price Precision engineering, easy action and accurate intonation','Stunning \'Paolo Mark\' Alto Saxophone with Case + Accessories Extremely nice tone given the low price Precision engineering, easy action and accurate intonation Perfect for beginner / intermediate and student musicians. Exceptional value! Finish: Gold Lacquer Instrument Level: Beginner / Student / Intermediate Case: Soft Case with Luxury Soft Interior Accessories: Mouthpiece & Reed, Cloth, Cleaning Rod, White Gloves, Neck Strap',249.00,NULL,20),(8,'Windsor Alto Saxophone','Windsor have done it again and designed an entry level alto saxophone at an affordable price for beginners, ideal for any budding player who is looking to take up this magnificant instrument.','Product Description\r\nWindsor have done it again and designed an entry level alto saxophone at an affordable price for beginners, ideal for any budding player who is looking to take up this magnificant instrument. Complete with everything you need to get playing straight out of the box, the impressive Windsor alto sax comes in a fully lined plush hard case for maximum protection of your instrument whilst on the move, as well as including a strap and cleaning kit. The Windsor alto saxophone is ideal for novice players, offering a great instrument, well designed and manufactured to ensure comfortable playability and a superb tone. Features: Gold laquer finish Cleaning kit Strap Mouthpiece Ligature Reed Plush lined hard case\r\nManufacturer\'s Description\r\nThe Windsor Alto Saxophone is the perfect instrument for students, enthusiasts and even players looking to purchase a second instrument at a great price. This instrument is manufactured under strict quality controls and easily compares to other well-known brands but at a fraction of the cost.\r\n\r\nA cleaning kit, mouthpiece with reed and cover is included as well as a plush lined durable Plush Lined Case. It has a one year manufacturers warranty against any manufacturing defects so you can buy with complete confidence .',201.00,NULL,25);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-01 10:07:46
