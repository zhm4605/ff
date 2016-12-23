/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50524
Source Host           : 127.0.0.1:3306
Source Database       : phone

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2016-12-23 15:19:38
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
  `lock` tinyint(1) DEFAULT '0' COMMENT '锁定、禁止登录',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1男,2女,0未知,9 未说明的性别',
  `mobile` char(32) DEFAULT '' COMMENT '手机号码',
  `roleId` tinyint(1) DEFAULT NULL COMMENT '角色id（0超级管理员 1管理员）',
  `lastDate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `lastIp` char(15) NOT NULL DEFAULT '' COMMENT '上次登录ip',
  `loginNum` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '登陆次数',
  PRIMARY KEY (`id`),
  KEY `username` (`name`),
  KEY `mobile` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='管理员表';

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'zhm', null, '', '1', '0', '', null, '0', '', '0');

-- ----------------------------
-- Table structure for `good`
-- ----------------------------
DROP TABLE IF EXISTS `good`;
CREATE TABLE `good` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '名称（50个字以内）',
  `description` text COMMENT '描述',
  `priceO` int(11) unsigned DEFAULT NULL COMMENT '原价',
  `priceMin` int(11) unsigned DEFAULT NULL COMMENT '最低现价（不同种类价格不同）',
  `priceMax` int(11) DEFAULT NULL COMMENT '最高价',
  `putawayTime` datetime DEFAULT NULL COMMENT '上架时间',
  `sorts` varchar(100) DEFAULT NULL COMMENT '分类（颜色:红色,白色;尺寸:4.7,5.1）',
  `picUrl` varchar(100) DEFAULT NULL COMMENT '主图地址 图片（1~10张）',
  `remain` smallint(4) unsigned DEFAULT NULL COMMENT '库存',
  `collect` int(11) unsigned DEFAULT NULL COMMENT '收藏量',
  `hot` int(11) unsigned DEFAULT '0' COMMENT '浏览次数',
  `lock` tinyint(1) DEFAULT '0' COMMENT '是否锁定',
  `updateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品表';

-- ----------------------------
-- Records of good
-- ----------------------------

-- ----------------------------
-- Table structure for `good_pic`
-- ----------------------------
DROP TABLE IF EXISTS `good_pic`;
CREATE TABLE `good_pic` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goodId` int(11) NOT NULL COMMENT '商品id',
  `name` varchar(20) DEFAULT NULL COMMENT '图片名称（10个字以内）',
  `url` varchar(100) DEFAULT NULL COMMENT '图片地址',
  `updateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品图片表';

-- ----------------------------
-- Records of good_pic
-- ----------------------------

-- ----------------------------
-- Table structure for `good_sort`
-- ----------------------------
DROP TABLE IF EXISTS `good_sort`;
CREATE TABLE `good_sort` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goodId` int(11) unsigned DEFAULT NULL COMMENT '商品id',
  `sorts` varchar(100) DEFAULT NULL COMMENT '类别',
  `remain` int(11) unsigned DEFAULT '0' COMMENT '库存',
  `price` int(11) unsigned DEFAULT NULL COMMENT '价格',
  `picId` int(11) unsigned DEFAULT NULL COMMENT '图片id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品分类表';

-- ----------------------------
-- Records of good_sort
-- ----------------------------

-- ----------------------------
-- Table structure for `label`
-- ----------------------------
DROP TABLE IF EXISTS `label`;
CREATE TABLE `label` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL COMMENT '标签名称（10字以内）',
  `desciption` varchar(100) DEFAULT NULL COMMENT '标签描述（50字以内）',
  `updateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='标签表';

-- ----------------------------
-- Records of label
-- ----------------------------

-- ----------------------------
-- Table structure for `slide`
-- ----------------------------
DROP TABLE IF EXISTS `slide`;
CREATE TABLE `slide` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL COMMENT '图片名称（10字以内）',
  `picUrl` varchar(100) DEFAULT NULL COMMENT '轮播图地址',
  `lock` tinyint(1) unsigned DEFAULT NULL COMMENT '是否锁定',
  `updateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='轮播图';

-- ----------------------------
-- Records of slide
-- ----------------------------

-- ----------------------------
-- Table structure for `sorts`
-- ----------------------------
DROP TABLE IF EXISTS `sorts`;
CREATE TABLE `sorts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL COMMENT '分类名称（10字内）',
  `description` varchar(100) DEFAULT NULL COMMENT '分类描述（50字以内）',
  `parentId` int(11) DEFAULT NULL COMMENT '父分类id',
  `level` tinyint(1) DEFAULT '0' COMMENT '级别',
  `order` smallint(2) DEFAULT '0' COMMENT '排序',
  `updateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分类表';

-- ----------------------------
-- Records of sorts
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `password` varchar(100) DEFAULT NULL COMMENT '密码(6~12个字符)',
  `lock` tinyint(1) DEFAULT '0' COMMENT '锁定、禁止登录',
  `sex` tinyint(4) DEFAULT '0' COMMENT '1男,2女,0未知,9 未说明的性别',
  `mobile` char(32) DEFAULT '' COMMENT '手机号码',
  `lastDate` datetime DEFAULT NULL COMMENT '最后登录时间',
  `lastIp` char(15) DEFAULT '' COMMENT '上次登录ip',
  `registerTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  `loginNum` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '登陆次数',
  PRIMARY KEY (`id`),
  KEY `username` (`name`),
  KEY `mobile` (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户表';

-- ----------------------------
-- Records of user
-- ----------------------------

-- ----------------------------
-- Table structure for `user_cart`
-- ----------------------------
DROP TABLE IF EXISTS `user_cart`;
CREATE TABLE `user_cart` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `goodId` int(11) unsigned DEFAULT NULL COMMENT '商品id',
  `updateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`,`goodId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='购物车表';

-- ----------------------------
-- Records of user_cart
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
