/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50524
Source Host           : 127.0.0.1:3306
Source Database       : phone

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2017-02-22 19:00:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `user_cart`
-- ----------------------------
DROP TABLE IF EXISTS `user_cart`;
CREATE TABLE `user_cart` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `good_id` int(11) unsigned DEFAULT NULL COMMENT '商品id',
  `good_name` varchar(100) DEFAULT NULL COMMENT '商品名称',
  `good_pic` varchar(100) DEFAULT NULL COMMENT '商品图片',
  `sort_id` int(11) DEFAULT NULL COMMENT '分类id',
  `sorts` varchar(100) DEFAULT NULL COMMENT '分类详情',
  `number` int(11) DEFAULT NULL COMMENT '数量',
  `price` int(11) DEFAULT NULL COMMENT '商品价格',
  `add_time` datetime DEFAULT NULL COMMENT '添加时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `userId` (`user_id`,`good_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='购物车表';

-- ----------------------------
-- Records of user_cart
-- ----------------------------
