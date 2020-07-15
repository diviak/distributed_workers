-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `distributed_worker` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `distributed_worker`;

DROP TABLE IF EXISTS `sites`;
CREATE TABLE `sites` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(244) NOT NULL,
  `status` enum('NEW','PROCESSING','DONE','ERROR') NOT NULL,
  `http_code` varchar(244) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE USER 'distributed_worker'@'%' IDENTIFIED BY 'secret';
GRANT ALL PRIVILEGES ON `distributed\_worker`.* TO 'distributed_worker'@'%';
