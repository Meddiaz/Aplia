-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `Hotels`;
CREATE TABLE `Hotels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `city` varchar(255) CHARACTER SET utf8 NOT NULL,
  `rooms` int(11) unsigned NOT NULL,
  `price` float unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `Hotels` (`id`, `name`, `city`, `rooms`, `price`) VALUES
(1,	'Sovgot Hotell',	'Skien',	15,	199.99),
(2,	'Fjon Hotel',	'Skien',	20,	256.12),
(3,	'Sjøfjell Hotell',	'Porsgrunn',	40,	100.1),
(4,	'Scandalic Hotel',	'Berlin',	64,	130),
(5,	'Sørvis Hotell',	'Porsgrunn',	100,	66.6),
(6,	'Bacon Hotel',	'Skien',	123,	321),
(7,	'Luxus Motel',	'Berlin',	5,	9999.9),
(8,	'Scandalic Hotel',	'Porsgrunn',	9,	99999);

DROP TABLE IF EXISTS `Reservations`;
CREATE TABLE `Reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forename` varchar(255) CHARACTER SET utf8 NOT NULL,
  `surname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8 NOT NULL,
  `email` varchar(320) CHARACTER SET utf8 NOT NULL,
  `hotelid` int(11) NOT NULL,
  `arrival` date NOT NULL,
  `departure` date NOT NULL,
  `rooms` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- 2020-04-26 19:42:04
