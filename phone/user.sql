/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50524
Source Host           : 127.0.0.1:3306
Source Database       : phone

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2017-02-22 20:00:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `identifier` varchar(50) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL COMMENT '姓名',
  `password` varchar(100) DEFAULT NULL COMMENT '密码(6~12个字符)',
  `password_wrong_count` int(11) DEFAULT '0' COMMENT '密码错误次数',
  `lock` tinyint(1) DEFAULT '0' COMMENT '锁定、禁止登录',
  `sex` tinyint(4) DEFAULT '0' COMMENT '1男,2女,0未知,9 未说明的性别',
  `mobile` char(32) DEFAULT '' COMMENT '手机号码',
  `last_login_time` datetime DEFAULT NULL COMMENT '最后登录时间',
  `last_ip` char(15) DEFAULT '' COMMENT '上次登录ip',
  `register_time` datetime DEFAULT NULL COMMENT '注册时间',
  `login_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `username` (`nickname`),
  KEY `mobile` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('2', '460569137@qq.com', 'ee1a36c897c7f7943fa14db7afe8203c', '9098ec39e11fea6fd3335f4fdb0b6fbb', 'zhm', '789c270c828211b6deae4df8d856d253', '0', '0', '0', '', null, '', '2017-02-22 19:35:32', '0', '2017-02-22 19:35:32');
