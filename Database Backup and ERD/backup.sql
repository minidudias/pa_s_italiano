CREATE DATABASE  IF NOT EXISTS `pa_s_italiano` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pa_s_italiano`;
-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: pa_s_italiano
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `email` varchar(100) NOT NULL,
  `fname` varchar(40) DEFAULT NULL,
  `lname` text,
  `verification_code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('minidudias@gmail.com','Minidu','Dias','667e4c5af375b');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_pfp`
--

DROP TABLE IF EXISTS `admin_pfp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_pfp` (
  `path` varchar(100) NOT NULL,
  `admin_email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_admin_pfp_admin1_idx` (`admin_email`),
  CONSTRAINT `fk_admin_pfp_admin1` FOREIGN KEY (`admin_email`) REFERENCES `admin` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_pfp`
--

LOCK TABLES `admin_pfp` WRITE;
/*!40000 ALTER TABLE `admin_pfp` DISABLE KEYS */;
INSERT INTO `admin_pfp` VALUES ('resource/pfp/1.svg','minidudias@gmail.com');
/*!40000 ALTER TABLE `admin_pfp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attribute`
--

DROP TABLE IF EXISTS `attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attribute` (
  `id` int NOT NULL AUTO_INCREMENT,
  `attribute` varchar(30) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_attribute_category1_idx` (`category_id`),
  CONSTRAINT `fk_attribute_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attribute`
--

LOCK TABLES `attribute` WRITE;
/*!40000 ALTER TABLE `attribute` DISABLE KEYS */;
INSERT INTO `attribute` VALUES (1,'Large Pizza',1),(2,'Medium Pizza',1),(3,'Small Pizza',1),(4,'Standard Size',3),(5,'King Size',3),(6,'Kid\'s Size Serving',2),(7,'Standard Size Serving',2),(8,'Kid\'s Size Serving',5),(9,'Standard Size Serving',5),(10,'200ml Glass Bottle',6),(11,'1 Liter Bottle',6),(12,'Standard Cup',6),(13,'For 1-2 People',4),(14,'For 3-4 People',4);
/*!40000 ALTER TABLE `attribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `qty` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cart_product1_idx` (`product_id`),
  KEY `fk_cart_user1_idx` (`user_email`),
  CONSTRAINT `fk_cart_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_cart_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (19,2,12,'minidudias@gmail.com'),(21,1,13,'indujayawardene@gmail.com'),(22,1,15,'minidudias@gmail.com');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Pizzas'),(2,'Pastas'),(3,'Lasagne'),(4,'Appetizers'),(5,'Desserts'),(6,'Beverages');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `city` (
  `id` int NOT NULL AUTO_INCREMENT,
  `city_name` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` VALUES (1,'Kollupitiya'),(2,'Nugegoda');
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dm`
--

DROP TABLE IF EXISTS `dm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dm` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` varchar(100) DEFAULT NULL,
  `content` text,
  `date_time` datetime DEFAULT NULL,
  `status` int DEFAULT '0',
  `to_admin` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_dm_user1_idx` (`user`),
  CONSTRAINT `fk_dm_user1` FOREIGN KEY (`user`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dm`
--

LOCK TABLES `dm` WRITE;
/*!40000 ALTER TABLE `dm` DISABLE KEYS */;
INSERT INTO `dm` VALUES (1,'minidudias@gmail.com','Hey, I didn\'t recieve my order yet!','2023-01-28 11:22:00',1,1),(2,'minidudias@gmail.com','It\'ll be delevered to your doorstep soon!','2023-01-28 11:22:00',1,0),(10,'minidudias@gmail.com','Thank you so much!','2023-01-28 13:33:54',1,1),(22,'indujayawardene@gmail.com','Are you guys open today?','2023-01-28 13:33:54',1,1),(23,'indujayawardene@gmail.com','Yeah ma\'am we\'re open today!','2023-01-28 13:33:54',1,0),(28,'minidudias@gmail.com','Well, finally received it!','2024-06-26 13:11:25',2,1);
/*!40000 ALTER TABLE `dm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` int DEFAULT NULL,
  `feedback` text,
  `date` date DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_feedback_product1_idx` (`product_id`),
  KEY `fk_feedback_user1_idx` (`user_email`),
  CONSTRAINT `fk_feedback_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_feedback_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (1,2,'Awesome!','2023-01-22',1,'minidudias@gmail.com'),(2,1,'They\'ve actually added mozzarella!','2023-01-22',1,'minidudias@gmail.com'),(3,2,'My people loved it!','2023-01-22',1,'minidudias@gmail.com'),(4,3,'Slow delivery service...','2023-01-22',1,'minidudias@gmail.com');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images` (
  `code` varchar(200) NOT NULL,
  `product_id` int DEFAULT NULL,
  PRIMARY KEY (`code`),
  KEY `fk_images_product1_idx` (`product_id`),
  CONSTRAINT `fk_images_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES ('resource/prod_img/Cheesy Green Chillie Pizza063e782716c2d2.jpeg',1),('resource\\prod_img\\1.jpg',2),('resource/prod_img/BBQ Chicken Pizza063f46161d930e.jpeg',3),('resource\\prod_img\\2.jpg',4),('resource/prod_img/Spaghetti Bolognaise063f4a10d1c37a.jpeg',12),('resource/prod_img/Macaroni & Cheese 063f4a1da3ce8f.jpeg',13),('resource/prod_img/Chicken Lasagna063f4a4783783b.jpeg',14),('resource/prod_img/Double Cheese Lasagne063f4a4fce3f64.jpeg',15),('resource/prod_img/Garlic Bread Supreme063f4a701de07a.jpeg',16),('resource/prod_img/Wing It BBQ063f4a979ccd7c.jpeg',17),('resource/prod_img/Berry-Fest Gelato063f4ace7d8b56.jpeg',18),('resource/prod_img/Gelato-Pistachio063f4ae0fa5566.jpeg',19),('resource/prod_img/Coke Bottle063f4b0a87a45a.jpeg',20),('resource/prod_img/Blueberry Smoothie063f4b3e0d654a.jpeg',21);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` varchar(100) DEFAULT NULL,
  `product` int DEFAULT NULL,
  `order_id` varchar(25) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `qty` int DEFAULT '1',
  `status` int DEFAULT NULL,
  `visible_to_user` int DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_invoice_product1_idx` (`product`),
  KEY `fk_invoice_user1_idx` (`user`),
  CONSTRAINT `fk_invoice_product1` FOREIGN KEY (`product`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_invoice_user1` FOREIGN KEY (`user`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` VALUES (1,'minidudias@gmail.com',1,'63972fe8d6423','2022-12-12 19:14:00',1860,2,0,1),(3,'minidudias@gmail.com',1,'6397351bd8b8b','2022-12-12 19:35:43',980,1,4,1),(4,'minidudias@gmail.com',2,'639d3494d588b','2022-12-17 08:47:17',1540,1,3,1),(5,'minidudias@gmail.com',1,'639d5d6558db5','2022-12-17 11:42:28',980,1,0,1),(6,'indujayawardene@gmail.com',1,'639d5e2b51eb8','2022-12-17 11:44:31',980,1,2,1),(7,'minidudias@gmail.com',4,'639d5eada8e35','2023-02-01 11:46:37',980,1,0,1),(11,'indujayawardene@gmail.com',4,'639d5f06831fb','2023-02-12 11:48:10',980,2,1,1),(12,'minidudias@gmail.com',2,'63e9a92a5f38a','2023-02-13 08:37:19',1540,1,0,1),(13,'minidudias@gmail.com',1,'63f057446588c','2023-02-18 10:13:33',2060,2,0,1),(14,'minidudias@gmail.com',3,'63f057446588c','2023-02-18 10:13:33',2700,1,0,1),(15,'minidudias@gmail.com',2,'63f07bfcb26a2','2023-02-18 12:49:51',2880,2,0,1),(16,'minidudias@gmail.com',3,'63f07bfcb26a2','2023-02-18 12:49:51',2600,1,0,1),(17,'minidudias@gmail.com',3,'63f301472d1d7','2023-02-20 10:43:16',7800,3,0,1),(18,'minidudias@gmail.com',2,'63f322562ac80','2023-02-20 13:04:18',2880,2,0,0),(20,'minidudias@gmail.com',1,'66797da5c076f','2024-06-24 19:38:38',1080,1,0,1);
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `price` double DEFAULT NULL,
  `description` text,
  `title` varchar(100) DEFAULT NULL,
  `datetime_added` datetime DEFAULT NULL,
  `sid` int DEFAULT NULL,
  `status_id` int DEFAULT NULL,
  `attribute_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_series1_idx` (`sid`),
  KEY `fk_product_status1_idx` (`status_id`),
  KEY `fk_product_attribute1_idx` (`attribute_id`),
  KEY `fk_product_category1_idx` (`category_id`),
  CONSTRAINT `fk_product_attribute1` FOREIGN KEY (`attribute_id`) REFERENCES `attribute` (`id`),
  CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `fk_product_series1` FOREIGN KEY (`sid`) REFERENCES `series` (`id`),
  CONSTRAINT `fk_product_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,980,'Rich tomato sauce base topped with cream cheese, onions, tomato, green chillies & Mozzarella','Cheesy Green Chillie Pizza','2022-11-23 17:29:00',1,1,3,1),(2,1440,'Rich tomato sauce base topped with cream cheese, onions, tomato, green chillies & Mozzarella','Cheesy Green Chillie Pizza','2022-12-09 17:29:13',2,1,2,1),(3,2600,'BBQ chicken accompanied by spicy jalapenos, onions and a double layer of cheese','BBQ Chicken Pizza','2022-11-25 17:29:43',1,1,1,1),(4,1440,'Spicy veggie masala & paneer accompanied with pineapple, topped with a double layer of cheese','Spicy Veggie-Paneer Pizza','2022-11-26 17:35:22',3,1,2,1),(12,1380,'Delicious spaghetti with a meeting of the finest Swedish meatballs along with a spicy Italian sauce and mozzarella cheese, served with hot sauce.','Spaghetti Bolognaise','2022-12-08 15:52:18',5,1,7,2),(13,1240,'Macaroni elbow pasta mixed with cheese sauce, accompanied by grilled onions and layered with mozzarella cheese, served with hot sauce.','Macaroni & Cheese ','2022-12-08 16:20:02',7,1,7,2),(14,1380,'A true classic with layers of pasta chicken slathered with cheese sauce and mozzarella cheese.','Chicken Lasagna','2023-02-21 16:31:12',10,1,5,3),(15,1100,'A true classic with layers of pasta chicken slathered with cheese sauce and mozzarella cheese.','Double Cheese Lasagne','2023-02-21 16:33:24',9,1,4,3),(16,770,'Made with garlic butter, stuffed with onions, green chillies and cream cheese, topped with mozzarella.','Garlic Bread Supreme','2023-02-21 16:42:01',15,1,13,4),(17,1160,'Succulent chicken wings tossed in our famous BBQ sauce & baked to perfection!','Wing It BBQ','2023-02-21 16:52:33',14,1,14,4),(18,600,'Hand-picked berries mixed with whole milk, sugar and nuts.','Berry-Fest Gelato','2023-02-21 17:07:11',12,1,9,5),(19,650,'Hand-picked pistachio mixed with whole milk, sugar and raisins.','Gelato-Pistachio','2023-02-21 17:12:07',12,1,9,5),(20,150,'200ml bottle of Coca-Cola.','Coke Bottle','2023-02-21 17:23:12',16,1,10,6),(21,250,'Finest hand-picked blue berries mixed with whole milk.','Blueberry Smoothie','2023-02-21 17:36:56',17,1,12,6);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_image`
--

DROP TABLE IF EXISTS `profile_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile_image` (
  `path` varchar(100) NOT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_profile_image_user1_idx` (`user_email`),
  CONSTRAINT `fk_profile_image_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_image`
--

LOCK TABLES `profile_image` WRITE;
/*!40000 ALTER TABLE `profile_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `profile_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salutation`
--

DROP TABLE IF EXISTS `salutation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `salutation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `salutation` varchar(17) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salutation`
--

LOCK TABLES `salutation` WRITE;
/*!40000 ALTER TABLE `salutation` DISABLE KEYS */;
INSERT INTO `salutation` VALUES (1,'Mr.'),(2,'Ms.'),(3,'Mrs.'),(4,'Mx.'),(5,'Rev.'),(6,'St.'),(7,'Prefer not to use');
/*!40000 ALTER TABLE `salutation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `series`
--

DROP TABLE IF EXISTS `series`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `series` (
  `id` int NOT NULL AUTO_INCREMENT,
  `series` varchar(30) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_series_category1_idx` (`category_id`),
  CONSTRAINT `fk_series_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `series`
--

LOCK TABLES `series` WRITE;
/*!40000 ALTER TABLE `series` DISABLE KEYS */;
INSERT INTO `series` VALUES (1,'Classic Series Pizzas',1),(2,'Signature Series Pizzas',1),(3,'Vegetarian Series Pizzas',1),(4,'Classic Italian Spaghetti',2),(5,'Extra Cheesy Spaghetti',2),(6,'Vegetarian Series Spaghetti',2),(7,'Classic Series Macaroni',2),(8,'Seafood-Fiesta Series Macaroni',2),(9,'Classic Series Lasagne',3),(10,'Smoked-Meat Series Lasagne',3),(11,'Vegetarian Series Lasagne',3),(12,'Italian Gelatos',5),(13,'Classic Puddings',5),(14,'Classic Roasts',4),(15,'Breads and Toasts',4),(16,'Soft Drinks',6),(17,'Smoothies',6);
/*!40000 ALTER TABLE `series` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'Available'),(2,'Not Available');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `email` varchar(100) NOT NULL,
  `fname` varchar(40) DEFAULT NULL,
  `lname` text,
  `mobile` varchar(10) DEFAULT NULL,
  `pw` varchar(25) DEFAULT NULL,
  `joined_date` date DEFAULT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  `salut` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_user_salutation_idx` (`salut`),
  CONSTRAINT `fk_user_salutation` FOREIGN KEY (`salut`) REFERENCES `salutation` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('chamara.jiat@gmail.com','James','Harward','0770280838','123836','2024-06-28',NULL,1,1),('indujayawardene@gmail.com','Indu','Jayawardene','0777950629','bungi','2022-11-22',NULL,3,1),('minidudias@gmail.com','Minidu','Dias','0770280835','minie','2022-11-15','667a43f5663df',1,1),('minidudias@outlook.com','John','De Silva','0760200931','minie','2022-11-18','637cd0e24023ac',1,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_has_address`
--

DROP TABLE IF EXISTS `user_has_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_has_address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `city_id` int DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `line1` text,
  `line2` text,
  `postal_code` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_city_has_user_user1_idx` (`user_email`),
  KEY `fk_city_has_user_city1_idx` (`city_id`),
  CONSTRAINT `fk_city_has_user_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `fk_city_has_user_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_has_address`
--

LOCK TABLES `user_has_address` WRITE;
/*!40000 ALTER TABLE `user_has_address` DISABLE KEYS */;
INSERT INTO `user_has_address` VALUES (2,1,'minidudias@gmail.com','426, Saint John Lane','Colombo','80000'),(3,1,'indujayawardene@gmail.com','26, Deddugoda Lane, Karapitiya, Galle, Southern Province, Sri Lanka.','','80000'),(4,1,'chamara.jiat@gmail.com','St James, Main','','90000');
/*!40000 ALTER TABLE `user_has_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `watchlist`
--

DROP TABLE IF EXISTS `watchlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `watchlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_watchlist_user1_idx` (`user_email`),
  KEY `fk_watchlist_product1_idx` (`product_id`),
  CONSTRAINT `fk_watchlist_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_watchlist_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `watchlist`
--

LOCK TABLES `watchlist` WRITE;
/*!40000 ALTER TABLE `watchlist` DISABLE KEYS */;
INSERT INTO `watchlist` VALUES (24,'minidudias@gmail.com',1),(36,'minidudias@gmail.com',3),(39,'minidudias@gmail.com',19),(40,'minidudias@gmail.com',12),(43,'minidudias@gmail.com',15);
/*!40000 ALTER TABLE `watchlist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-08 13:46:08
