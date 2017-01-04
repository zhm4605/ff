/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50524
Source Host           : 127.0.0.1:3306
Source Database       : phone

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2017-01-04 17:06:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT '' COMMENT '用户名',
  `nickname` varchar(50) DEFAULT NULL COMMENT '用户昵称',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `identifier` varchar(32) DEFAULT NULL COMMENT '用户唯一标识',
  `token` varchar(32) DEFAULT NULL,
  `timeout` datetime DEFAULT NULL COMMENT '过期时间',
  `lock` tinyint(1) DEFAULT '0' COMMENT '锁定、禁止登录',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1男,2女,0未知,9 未说明的性别',
  `mobile` char(32) DEFAULT '' COMMENT '手机号码',
  `roleId` tinyint(1) DEFAULT NULL COMMENT '角色id（0超级管理员 1管理员）',
  `lastDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后登录时间',
  `lastIp` char(15) NOT NULL DEFAULT '' COMMENT '上次登录ip',
  `loginNum` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '登陆次数',
  PRIMARY KEY (`id`),
  KEY `username` (`name`),
  KEY `mobile` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='管理员表';

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'zhm', null, '', null, null, null, '1', '0', '', null, '0000-00-00 00:00:00', '', '0');
