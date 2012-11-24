/*
 Navicat Premium Data Transfer

 Source Server         : Local Server
 Source Server Type    : MySQL
 Source Server Version : 50528
 Source Host           : localhost
 Source Database       : webservice

 Target Server Type    : MySQL
 Target Server Version : 50528
 File Encoding         : utf-8

 Date: 11/24/2012 11:47:06 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `webservice_devices`
-- ----------------------------
DROP TABLE IF EXISTS `webservice_devices`;
CREATE TABLE `webservice_devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device_id` varchar(255) NOT NULL,
  `allowed` tinyint(1) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `webservice_difference`
-- ----------------------------
DROP TABLE IF EXISTS `webservice_difference`;
CREATE TABLE `webservice_difference` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `average_temp` decimal(10,6) NOT NULL,
  `current_temp` decimal(10,2) NOT NULL,
  `difference` decimal(10,6) NOT NULL,
  `change` varchar(10) NOT NULL,
  `percentage_difference` decimal(10,10) NOT NULL,
  `stamp` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `webservice_temperature`
-- ----------------------------
DROP TABLE IF EXISTS `webservice_temperature`;
CREATE TABLE `webservice_temperature` (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `temperature` decimal(64,2) NOT NULL,
  `humidity` decimal(64,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26313 DEFAULT CHARSET=latin1;

-- ----------------------------
--  View structure for `view_current_data`
-- ----------------------------
DROP VIEW IF EXISTS `view_current_data`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_current_data` AS select `webservice_temperature`.`id` AS `id`,`webservice_temperature`.`date` AS `date`,`webservice_temperature`.`temperature` AS `temperature`,`webservice_temperature`.`humidity` AS `humidity` from `webservice_temperature` where `webservice_temperature`.`id` in (select max(`webservice_temperature`.`id`) AS `MAX(id)` from `webservice_temperature`);

-- ----------------------------
--  View structure for `view_daily_average`
-- ----------------------------
DROP VIEW IF EXISTS `view_daily_average`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_daily_average` AS select `webservice_temperature`.`id` AS `id`,`webservice_temperature`.`date` AS `date`,avg(`webservice_temperature`.`temperature`) AS `Average_Temp`,min(`webservice_temperature`.`temperature`) AS `Lowest_Temp`,max(`webservice_temperature`.`temperature`) AS `Higest_Temp`,avg(`webservice_temperature`.`humidity`) AS `Average_Hum`,min(`webservice_temperature`.`humidity`) AS `Lowest_Hum`,max(`webservice_temperature`.`humidity`) AS `Higest_Hum` from `webservice_temperature` group by dayofmonth(`webservice_temperature`.`date`);

-- ----------------------------
--  View structure for `view_day_breakdown`
-- ----------------------------
DROP VIEW IF EXISTS `view_day_breakdown`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_day_breakdown` AS select `view_day_hourly_average`.`id` AS `id`,`view_day_hourly_average`.`date` AS `date`,`view_day_hourly_average`.`Average_Temp` AS `Average_Temp`,`view_day_hourly_average`.`Lowest_Temp` AS `Lowest_Temp`,`view_day_hourly_average`.`Higest_Temp` AS `Higest_Temp`,`view_day_hourly_average`.`Average_Hum` AS `Average_Hum`,`view_day_hourly_average`.`Lowest_Hum` AS `Lowest_Hum`,`view_day_hourly_average`.`Higest_Hum` AS `Higest_Hum` from `view_day_hourly_average` where (cast(`view_day_hourly_average`.`date` as date) = cast(now() as date));

-- ----------------------------
--  View structure for `view_day_hourly_average`
-- ----------------------------
DROP VIEW IF EXISTS `view_day_hourly_average`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_day_hourly_average` AS select `webservice_temperature`.`id` AS `id`,`webservice_temperature`.`date` AS `date`,avg(`webservice_temperature`.`temperature`) AS `Average_Temp`,min(`webservice_temperature`.`temperature`) AS `Lowest_Temp`,max(`webservice_temperature`.`temperature`) AS `Higest_Temp`,avg(`webservice_temperature`.`humidity`) AS `Average_Hum`,min(`webservice_temperature`.`humidity`) AS `Lowest_Hum`,max(`webservice_temperature`.`humidity`) AS `Higest_Hum` from `webservice_temperature` group by hour(`webservice_temperature`.`date`),dayofmonth(`webservice_temperature`.`date`) order by dayofmonth(`webservice_temperature`.`date`);

-- ----------------------------
--  View structure for `view_hourly_average`
-- ----------------------------
DROP VIEW IF EXISTS `view_hourly_average`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_hourly_average` AS select `webservice_temperature`.`id` AS `id`,`webservice_temperature`.`date` AS `date`,avg(`webservice_temperature`.`temperature`) AS `Average_Temp`,min(`webservice_temperature`.`temperature`) AS `Lowest_Temp`,max(`webservice_temperature`.`temperature`) AS `Higest_Temp`,avg(`webservice_temperature`.`humidity`) AS `Average_Hum`,min(`webservice_temperature`.`humidity`) AS `Lowest_Hum`,max(`webservice_temperature`.`humidity`) AS `Higest_Hum` from `webservice_temperature` group by dayofmonth(`webservice_temperature`.`date`),hour(`webservice_temperature`.`date`);

-- ----------------------------
--  View structure for `view_last_10_readings`
-- ----------------------------
DROP VIEW IF EXISTS `view_last_10_readings`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_last_10_readings` AS select `webservice_temperature`.`id` AS `id`,`webservice_temperature`.`date` AS `date`,avg(`webservice_temperature`.`temperature`) AS `temperature`,avg(`webservice_temperature`.`humidity`) AS `humidity` from `webservice_temperature` group by dayofmonth(`webservice_temperature`.`date`),hour(`webservice_temperature`.`date`),minute(`webservice_temperature`.`date`) order by `webservice_temperature`.`id` desc limit 10;

-- ----------------------------
--  View structure for `view_overall_average`
-- ----------------------------
DROP VIEW IF EXISTS `view_overall_average`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_overall_average` AS select avg(`webservice_temperature`.`temperature`) AS `Average_Temp`,min(`webservice_temperature`.`temperature`) AS `Lowest_Temp`,max(`webservice_temperature`.`temperature`) AS `Higest_Temp`,avg(`webservice_temperature`.`humidity`) AS `Average_Hum`,min(`webservice_temperature`.`humidity`) AS `Lowest_Hum`,max(`webservice_temperature`.`humidity`) AS `Higest_Hum` from `webservice_temperature`;

-- ----------------------------
--  View structure for `view_percentage_difference`
-- ----------------------------
DROP VIEW IF EXISTS `view_percentage_difference`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_percentage_difference` AS select avg(`a`.`temperature`) AS `average_temp`,`b`.`temperature` AS `current_temp`,(`b`.`temperature` - avg(`a`.`temperature`)) AS `difference`,if(((`b`.`temperature` - avg(`a`.`temperature`)) >= 0),'Positive','Negitive') AS `Change`,(((`b`.`temperature` - avg(`a`.`temperature`)) / avg(`a`.`temperature`)) * 100) AS `percentage_difference` from (`view_last_10_readings` `a` join `view_current_data` `b`);

-- ----------------------------
--  Procedure structure for `StoreDifference`
-- ----------------------------
DROP PROCEDURE IF EXISTS `StoreDifference`;
delimiter ;;
CREATE DEFINER=`webservice`@`localhost` PROCEDURE `StoreDifference`()
BEGIN
	INSERT INTO webservice_difference (`webservice_difference`.`average_temp`,`webservice_difference`.`current_temp`,`webservice_difference`.`difference`,`webservice_difference`.`change`,`webservice_difference`.`percentage_difference`, stamp) 
SELECT
		*,NOW()
	FROM
		view_percentage_difference;
END
 ;;
delimiter ;

-- ----------------------------
--  Event structure for `Automation`
-- ----------------------------
DROP EVENT IF EXISTS `Automation`;
delimiter ;;
CREATE DEFINER=`webservice`@`localhost` EVENT `Automation` ON SCHEDULE EVERY 10 MINUTE STARTS '2012-11-24 10:55:03' ON COMPLETION NOT PRESERVE ENABLE DO CALL StoreDifference()
 ;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
