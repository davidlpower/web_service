-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 18, 2012 at 11:42 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webservice`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_current_data`
--
CREATE TABLE IF NOT EXISTS `view_current_data` (
`id` int(11)
,`date` datetime
,`temperature` decimal(64,2)
,`humidity` decimal(64,2)
);
-- --------------------------------------------------------

--
-- Table structure for table `view_daily_average`
--

CREATE VIEW `webservice`.`view_daily_average` AS select `webservice`.`webservice_temperature`.`date` AS `date`,avg(`webservice`.`webservice_temperature`.`temperature`) AS `Average_Temp`,min(`webservice`.`webservice_temperature`.`temperature`) AS `Lowest_Temp`,max(`webservice`.`webservice_temperature`.`temperature`) AS `Higest_Temp`,avg(`webservice`.`webservice_temperature`.`humidity`) AS `Average_Hum`,min(`webservice`.`webservice_temperature`.`humidity`) AS `Lowest_Hum`,max(`webservice`.`webservice_temperature`.`humidity`) AS `Higest_Hum` from `webservice`.`webservice_temperature` group by dayofmonth(`webservice`.`webservice_temperature`.`date`);

-- --------------------------------------------------------

--
-- Table structure for table `view_hourly_average`
--

CREATE VIEW `webservice`.`view_hourly_average` AS select `webservice`.`webservice_temperature`.`date` AS `date`,avg(`webservice`.`webservice_temperature`.`temperature`) AS `Average_Temp`,min(`webservice`.`webservice_temperature`.`temperature`) AS `Lowest_Temp`,max(`webservice`.`webservice_temperature`.`temperature`) AS `Higest_Temp`,avg(`webservice`.`webservice_temperature`.`humidity`) AS `Average_Hum`,min(`webservice`.`webservice_temperature`.`humidity`) AS `Lowest_Hum`,max(`webservice`.`webservice_temperature`.`humidity`) AS `Higest_Hum` from `webservice`.`webservice_temperature` group by hour(`webservice`.`webservice_temperature`.`date`);

-- --------------------------------------------------------

--
-- Table structure for table `view_overall_average`
--

CREATE VIEW `webservice`.`view_overall_average` AS select avg(`webservice`.`webservice_temperature`.`temperature`) AS `Average_Temp`,min(`webservice`.`webservice_temperature`.`temperature`) AS `Lowest_Temp`,max(`webservice`.`webservice_temperature`.`temperature`) AS `Higest_Temp`,avg(`webservice`.`webservice_temperature`.`humidity`) AS `Average_Hum`,min(`webservice`.`webservice_temperature`.`humidity`) AS `Lowest_Hum`,max(`webservice`.`webservice_temperature`.`humidity`) AS `Higest_Hum` from `webservice`.`webservice_temperature`;

-- --------------------------------------------------------

--
-- Table structure for table `webservice_devices`
--

CREATE TABLE IF NOT EXISTS `webservice_devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device_id` varchar(255) NOT NULL,
  `allowed` tinyint(1) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `webservice_temperature`
--

CREATE TABLE IF NOT EXISTS `webservice_temperature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `temperature` decimal(64,2) NOT NULL,
  `humidity` decimal(64,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1546 ;

-- --------------------------------------------------------

--
-- Structure for view `view_current_data`
--
DROP TABLE IF EXISTS `view_current_data`;

CREATE VIEW `view_current_data` AS select `webservice_temperature`.`id` AS `id`,`webservice_temperature`.`date` AS `date`,`webservice_temperature`.`temperature` AS `temperature`,`webservice_temperature`.`humidity` AS `humidity` from `webservice_temperature` where `webservice_temperature`.`id` in (select max(`webservice_temperature`.`id`) AS `MAX(id)` from `webservice_temperature`);
