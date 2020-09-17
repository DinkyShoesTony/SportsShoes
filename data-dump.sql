# ************************************************************
# Sequel Pro SQL dump
# Version 5446
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.25-google)
# Database: SportsShoesTest
# Generation Time: 2020-09-17 13:31:15 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table company
# ------------------------------------------------------------

DROP TABLE IF EXISTS `company`;

CREATE TABLE `company` (
  `company_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_location` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_domain` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`company_id`),
  UNIQUE KEY `nameloc` (`company_name`,`company_location`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;

INSERT INTO `company` (`company_id`, `company_name`, `company_location`, `company_domain`)
VALUES
	(1,'Sportsshoes.com','Bradford','Sportsshoes.com'),
	(2,'B-Sporting Ltd','Bradford','b-sporting-ltd.com'),
	(7,'Monkey','Fun','monkeys.com'),
	(11,'Acme Ltd','Bradford','acme.com');

/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table company_employees
# ------------------------------------------------------------

DROP TABLE IF EXISTS `company_employees`;

CREATE TABLE `company_employees` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `email_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employee_id` (`employee_id`,`email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT=') ENGINE=InnoDB DEFAULT CHARSET=utf8;';

LOCK TABLES `company_employees` WRITE;
/*!40000 ALTER TABLE `company_employees` DISABLE KEYS */;

INSERT INTO `company_employees` (`id`, `employee_id`, `company_id`, `email_id`)
VALUES
	(1,1,1,1),
	(2,3,1,3),
	(3,6,1,6),
	(4,8,1,8),
	(5,2,2,2),
	(6,4,2,4),
	(7,5,2,5),
	(8,9,2,9),
	(16,27,11,23);

/*!40000 ALTER TABLE `company_employees` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table employee
# ------------------------------------------------------------

DROP TABLE IF EXISTS `employee`;

CREATE TABLE `employee` (
  `employee_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;

INSERT INTO `employee` (`employee_id`, `firstname`, `lastname`)
VALUES
	(1,'John','Smith'),
	(2,'Albert','Einstein'),
	(3,'Isaac','Newton'),
	(4,'Stephen','Hawking'),
	(5,'Mike','Faraday'),
	(6,'Tim','Berners-Lee'),
	(7,'Alex','Fleming'),
	(8,'Joe','Priestley'),
	(9,'William','Ford'),
	(27,'Robert','O\'Neal');

/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table employee_email
# ------------------------------------------------------------

DROP TABLE IF EXISTS `employee_email`;

CREATE TABLE `employee_email` (
  `email_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email_address` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`email_id`),
  UNIQUE KEY `email` (`email_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `employee_email` WRITE;
/*!40000 ALTER TABLE `employee_email` DISABLE KEYS */;

INSERT INTO `employee_email` (`email_id`, `email_address`)
VALUES
	(2,'a.einstein@b-sporting-ltd.com'),
	(3,'i.newton@sportsshoes.com'),
	(8,'j.priestley@sportsshoes.com'),
	(1,'j.smith@sportsshoes.com'),
	(5,'m.faraday@b-sporting-ltd.com'),
	(7,'m.fleming@sportsshoes.com'),
	(23,'r.oneal@acme-ltd.com'),
	(4,'s.hawking@b-sporting-ltd.com'),
	(6,'t.berners-lee@sportsshoes.com'),
	(9,'w.ford@b-sporting-ltd.com');

/*!40000 ALTER TABLE `employee_email` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
