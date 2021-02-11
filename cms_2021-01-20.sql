# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.11-MariaDB)
# Database: cms
# Generation Time: 2021-01-20 15:59:12 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table brands
# ------------------------------------------------------------

DROP TABLE IF EXISTS `brands`;

CREATE TABLE `brands` (
  `brand_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `order_id` int(11) unsigned NOT NULL,
  `cos_name` mediumtext DEFAULT NULL,
  `cos_lname` mediumtext DEFAULT NULL,
  `cos_nr` int(255) DEFAULT NULL,
  `cos_adress` varchar(255) DEFAULT NULL,
  `cos_city` mediumtext DEFAULT NULL,
  `cos_state` int(11) unsigned DEFAULT NULL,
  `cos_products` int(11) DEFAULT NULL,
  `cos_total` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table products_purchased
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products_purchased`;

CREATE TABLE `products_purchased` (
  `order_id` int(11) unsigned DEFAULT NULL,
  `product_id` bigint(11) unsigned DEFAULT NULL,
  `prod_name` varchar(255) DEFAULT NULL,
  `prod_brand` varchar(255) DEFAULT NULL,
  `prod_size` tinytext DEFAULT NULL,
  `prod_quantity` int(11) DEFAULT NULL,
  `prod_price` int(11) DEFAULT NULL,
  `price_total` int(11) DEFAULT NULL,
  `cos_name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  KEY `prod_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table produkte
# ------------------------------------------------------------

DROP TABLE IF EXISTS `produkte`;

CREATE TABLE `produkte` (
  `product_id` bigint(11) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` mediumtext DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `stock_price` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `shteti` int(11) unsigned DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `edited_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table shteti
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shteti`;

CREATE TABLE `shteti` (
  `id_shteti` int(11) unsigned NOT NULL,
  `shteti` text DEFAULT NULL,
  PRIMARY KEY (`id_shteti`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `shteti` WRITE;
/*!40000 ALTER TABLE `shteti` DISABLE KEYS */;

INSERT INTO `shteti` (`id_shteti`, `shteti`)
VALUES
	(1,'Shqiperi'),
	(2,'Kosove');

/*!40000 ALTER TABLE `shteti` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `name` mediumtext DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` mediumtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`user_id`, `username`, `name`, `password`, `role`, `created_at`)
VALUES
	(10840,'klejdi','Klejdi','$2y$10$ecbQhCTmQl.UHn1bu6oxEuqCYZ2WCv1UVuzLvnRfM8L/2epNlJwze','Admin','2021-01-20 15:18:44');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
