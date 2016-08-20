/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : daily_expeniture

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-08-19 02:48:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `expenditure`
-- ----------------------------
DROP TABLE IF EXISTS `expenditure`;
CREATE TABLE `expenditure` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `date_time` date NOT NULL,
  `to_from` char(4) NOT NULL DEFAULT 'to',
  `qty` int(11) NOT NULL DEFAULT '0',
  `notes` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of expenditure
-- ----------------------------
INSERT INTO `expenditure` VALUES ('1', '1', '1', '2016-08-15', 'to', '7', '');
INSERT INTO `expenditure` VALUES ('2', '1', '8', '2016-08-17', 'from', '700', null);
INSERT INTO `expenditure` VALUES ('4', '1', '8', '2016-08-08', 'to', '9', ',nkj ljkk');

-- ----------------------------
-- Table structure for `expenditure_category`
-- ----------------------------
DROP TABLE IF EXISTS `expenditure_category`;
CREATE TABLE `expenditure_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `notes` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of expenditure_category
-- ----------------------------
INSERT INTO `expenditure_category` VALUES ('1', '1', 'food', 'food');
INSERT INTO `expenditure_category` VALUES ('3', '1', 'transport', 'transport');
INSERT INTO `expenditure_category` VALUES ('4', '1', 'dresses', 'dresses and wears');
INSERT INTO `expenditure_category` VALUES ('5', '1', 'mobile', 'mobile\'s bills');
INSERT INTO `expenditure_category` VALUES ('6', '1', 'letters', 'letters');
INSERT INTO `expenditure_category` VALUES ('7', '1', 'internet', '');
INSERT INTO `expenditure_category` VALUES ('8', '1', 'medicine', '');
INSERT INTO `expenditure_category` VALUES ('9', '1', 'electric', '');
INSERT INTO `expenditure_category` VALUES ('10', '1', 'education', '');
INSERT INTO `expenditure_category` VALUES ('11', '1', 'gifts', '');
INSERT INTO `expenditure_category` VALUES ('12', '1', 'others', '');
INSERT INTO `expenditure_category` VALUES ('13', '1', 'kostenneben', '');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `notes` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'abd', 'abd', '123', '1', null);
INSERT INTO `users` VALUES ('2', 'abdoun79@gmail.com', 'abdoun79@gmail.com', '1314', '1', null);
