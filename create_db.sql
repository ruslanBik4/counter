/*
 Navicat MySQL Data Transfer

 Target Server Version : 50547
 File Encoding         : utf-8

 Date: 03/02/2016 23:26:31 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `count`
-- ----------------------------
DROP TABLE IF EXISTS `count`;
CREATE TABLE `count` (
  `id_ips_visitors` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_adress` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `views` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_ips_visitors`),
  KEY `ip_adress` (`ip_adress`,`date`),
  KEY `views` (`views`),
  KEY `date` (`date`) USING HASH
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `count`
-- ----------------------------
BEGIN;
INSERT INTO `count` VALUES ('1', '94.158.77.42', '2016-03-02', '8'), ('2', '94.158.77.142', '2016-03-02', '1'), ('3', '194.158.77.42', '2016-03-02', '1'), ('4', '194.158.77.142', '2016-03-02', '1'), ('5', '194.158.1.1', '2016-03-01', '1');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
