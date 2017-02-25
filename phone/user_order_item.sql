/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50524
Source Host           : 127.0.0.1:3306
Source Database       : phone

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2017-02-25 16:44:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `user_order_item`
-- ----------------------------
DROP TABLE IF EXISTS `user_order_item`;
CREATE TABLE `user_order_item` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `good_id` int(11) unsigned DEFAULT NULL COMMENT '商品id',
  `good_name` varchar(100) DEFAULT NULL COMMENT '商品名称',
  `good_pic` varchar(100) DEFAULT NULL COMMENT '商品图片',
  `sort_id` int(11) DEFAULT NULL COMMENT '分类id',
  `sorts` varchar(100) DEFAULT NULL COMMENT '分类详情',
  `number` int(11) DEFAULT NULL COMMENT '数量',
  `unit_price` int(11) DEFAULT NULL COMMENT '商品单价',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `userId` (`user_id`,`good_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单子表';

-- ----------------------------
-- Records of user_order_item
-- ----------------------------

-- ----------------------------
-- Table structure for `user_order`
-- ----------------------------
DROP TABLE IF EXISTS `user_order`;
CREATE TABLE `user_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(12) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `item_id` int(11) DEFAULT NULL COMMENT '订单子表id',
  `name` varchar(72) DEFAULT NULL COMMENT '收货人',
  `mobile` varchar(20) DEFAULT NULL COMMENT '联系电话',
  `address` int(11) DEFAULT NULL COMMENT '地址',
  `total_price` int(11) DEFAULT NULL COMMENT '总价',
  `state` tinyint(2) DEFAULT NULL COMMENT '订单状态(支付状态，发货状态)',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `user_id` (`user_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单主表';

-- ----------------------------
-- Records of user_order
-- ----------------------------

-- ----------------------------
-- Table structure for `user_collect`
-- ----------------------------
DROP TABLE IF EXISTS `user_collect`;
CREATE TABLE `user_collect` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `goodId` int(11) unsigned DEFAULT NULL COMMENT '商品id',
  `updateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`,`goodId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='收藏表';

-- ----------------------------
-- Records of user_collect
-- ----------------------------

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

-- ----------------------------
-- Table structure for `user_address`
-- ----------------------------
DROP TABLE IF EXISTS `user_address`;
CREATE TABLE `user_address` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `name` varchar(72) DEFAULT NULL COMMENT '收货人',
  `mobile` varchar(20) DEFAULT NULL,
  `areacode` varchar(20) DEFAULT NULL COMMENT '区域代码',
  `areaname` varchar(200) DEFAULT NULL COMMENT '区域名称',
  `areatext` text COMMENT '自定义区域',
  `add_time` datetime DEFAULT NULL COMMENT '添加时间',
  `defaut` tinyint(1) DEFAULT NULL COMMENT '默认地址',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `userId` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户地址表';

-- ----------------------------
-- Records of user_address
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `identifier` varchar(50) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `password` varchar(100) DEFAULT NULL COMMENT '密码(6~12个字符)',
  `password_wrong_count` int(11) DEFAULT '0' COMMENT '密码错误次数',
  `lock` tinyint(1) DEFAULT '0' COMMENT '锁定、禁止登录',
  `sex` tinyint(4) DEFAULT '0' COMMENT '1男,2女,0未知,9 未说明的性别',
  `mobile` varchar(20) DEFAULT NULL COMMENT '手机号码',
  `last_login_time` datetime DEFAULT NULL COMMENT '最后登录时间',
  `last_ip` char(15) DEFAULT '' COMMENT '上次登录ip',
  `register_time` datetime DEFAULT NULL COMMENT '注册时间',
  `login_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `identifier` (`identifier`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('2', '460569137@qq.com', '130ad95504f1f020a310bd3a695590a3', 'a6332ee1c97d026e998654c45fbfa64c', 'zhm', '789c270c828211b6deae4df8d856d253', '0', '0', '0', '18768122041', '2017-02-25 10:20:14', '127.0.0.1', '2017-02-22 19:35:32', '13', '2017-02-25 10:53:21');
