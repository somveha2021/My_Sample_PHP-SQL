-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_crud
DROP DATABASE IF EXISTS `db_crud`;
CREATE DATABASE IF NOT EXISTS `db_crud` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_crud`;

-- Dumping structure for table db_crud.article
DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `detail` longtext,
  `photo` varchar(250) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table db_crud.article: 0 rows
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
/*!40000 ALTER TABLE `article` ENABLE KEYS */;

-- Dumping structure for table db_crud.category
DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `icon` varchar(250) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table db_crud.category: 0 rows
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Dumping structure for table db_crud.countries
DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table db_crud.countries: 4 rows
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`id`, `name`) VALUES
	(1, 'Cambodia'),
	(2, 'Thailand'),
	(3, 'Korea'),
	(4, 'Korea 1');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;

-- Dumping structure for table db_crud.employees
DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `salary` int(10) NOT NULL,
  `photo` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Dumping data for table db_crud.employees: 2 rows
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` (`id`, `name`, `address`, `salary`, `photo`) VALUES
	(11, 'គិត ​ថៃសេង  KITH​ THAISENG', 'SIEM REAP, CAMBODIA', 2300, 'Home2-1.png'),
	(10, 'SENG  SOURNG', 'Siem Reap, Cambodia', 4400, '27973204_152939408738652_246136849792870665_n.png');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;

-- Dumping structure for table db_crud.group
DROP TABLE IF EXISTS `group`;
CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `role` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table db_crud.group: 3 rows
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` (`id`, `name`, `role`) VALUES
	(1, 'Admin', 'admin'),
	(2, 'Author', 'author'),
	(3, 'Editor', 'editor');
/*!40000 ALTER TABLE `group` ENABLE KEYS */;

-- Dumping structure for table db_crud.product
DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_code` varchar(15) NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_price` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_crud.product: ~10 rows (approximately)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`product_code`, `product_name`, `product_price`) VALUES
	('09388', 'Product name', 45),
	('0943', 'dlfksdlfks', 90),
	('097', 'dlsfkasldfksa', 56),
	('097666', 'ABC', 30),
	('19739140', 'Ancher', 30),
	('19739141', 'Product 2', 13),
	('19739142', 'Product 3', 34),
	('19739143', 'Product 4', 65),
	('19739144', 'Product 5', 32),
	('19739145', 'Product 6', 76),
	('19739146', 'Product 7', 90);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- Dumping structure for table db_crud.students
DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `stu_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `gender` varchar(250) DEFAULT NULL,
  `bod` varchar(250) DEFAULT NULL,
  `pob` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`stu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table db_crud.students: 0 rows
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
/*!40000 ALTER TABLE `students` ENABLE KEYS */;

-- Dumping structure for table db_crud.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table db_crud.users: 3 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `group_id`) VALUES
	(1, 'sourng', '$2y$10$c63aEoLxJi04u0DHRdk3/OOPNtarqJ/rwo9eBzWCuG1o5Qg6X9xka', '2019-05-21 02:29:03', 1),
	(2, 'thuna', '$2y$10$bVl27ZzLc7ETQ.0sB1Vl/.FZl0PFSsCp8C9NR3tvjgpL9foimcUJu', '2019-05-21 10:26:20', 2),
	(3, 'dara', '$2y$10$84iN4RVevTWMIVWZqq6tBul/Mg9MLr.TYMexhKRwH/3Fq5KE9gpXG', '2019-07-09 08:15:34', 3);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
