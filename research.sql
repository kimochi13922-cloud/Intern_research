-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.0.51b-community-nt-log - MySQL Community Edition (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             12.17.0.7270
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for research
CREATE DATABASE IF NOT EXISTS `research` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `research`;

-- Dumping structure for table research.research_file
CREATE TABLE IF NOT EXISTS `research_file` (
  `owner_id` int(11) NOT NULL,
  `categories` text NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  `file` longblob,
  `description` text,
  `file_name` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table research.research_list
CREATE TABLE IF NOT EXISTS `research_list` (
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  `authors` text NOT NULL,
  `departments` text NOT NULL,
  `categories` text NOT NULL,
  `progress` text NOT NULL,
  `journal` text NOT NULL,
  `publication_year` text NOT NULL,
  `release_year` text NOT NULL,
  `citation` int(11) NOT NULL,
  `budget` int(11) NOT NULL,
  `abstract` text NOT NULL,
  `funding_source` text NOT NULL,
  `article_link` int(11) NOT NULL,
  `contract` mediumblob,
  `successpdf` longblob NOT NULL,
  `kpi_1` text,
  `kpi_1file` longblob,
  `kpi_2file` longblob,
  `kpi_2` text,
  `period` text NOT NULL,
  `quartile` text NOT NULL,
  `vision` int(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
