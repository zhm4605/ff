/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : phone

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-12-18 20:46:20
*/

SET FOREIGN_KEY_CHECKS=0;

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
  `collect` int(11) unsigned DEFAULT NULL COMMENT '收藏量',
  `hot` int(11) unsigned DEFAULT '0' COMMENT '浏览次数',
  `lock` enum('0','1') DEFAULT '0' COMMENT '是否锁定',
  `updateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='商品表';

-- ----------------------------
-- Records of good
-- ----------------------------
INSERT INTO `good` VALUES ('1', '品牌', null, '0', '0', null, null, null, null, null, '0', '0', '2016-12-18 19:46:51');
INSERT INTO `good` VALUES ('2', '苹果', null, '1', '1', null, null, null, null, null, '0', '0', '2016-12-18 19:47:12');
INSERT INTO `good` VALUES ('3', '三星', null, '1', '1', null, null, null, null, null, '0', '0', '2016-12-18 19:47:31');
INSERT INTO `good` VALUES ('4', '颜色', null, '0', '0', null, null, null, null, null, '0', '0', '2016-12-18 19:47:43');
INSERT INTO `good` VALUES ('5', '白色', null, '4', '1', null, null, null, null, null, '0', '0', '2016-12-18 19:47:53');
INSERT INTO `good` VALUES ('6', '黑色', null, '4', '1', null, null, null, null, null, '0', '0', '2016-12-18 19:48:05');

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
-- Table structure for `sort`
-- ----------------------------
DROP TABLE IF EXISTS `sort`;
CREATE TABLE `sort` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL COMMENT '名称（10个字以内）',
  `description` varchar(200) DEFAULT NULL COMMENT '描述（100字以内）',
  `parentId` int(11) unsigned DEFAULT '0',
  `level` tinyint(2) unsigned DEFAULT '0',
  `updateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='分类表';

-- ----------------------------
-- Records of sort
-- ----------------------------
INSERT INTO `sort` VALUES ('1', '品牌', null, '0', '0', '2016-12-18 19:46:51');
INSERT INTO `sort` VALUES ('2', '苹果', null, '1', '1', '2016-12-18 19:47:12');
INSERT INTO `sort` VALUES ('3', '三星', null, '1', '1', '2016-12-18 19:47:31');
INSERT INTO `sort` VALUES ('4', '颜色', null, '0', '0', '2016-12-18 19:47:43');
INSERT INTO `sort` VALUES ('5', '白色', null, '4', '1', '2016-12-18 19:47:53');
INSERT INTO `sort` VALUES ('6', '黑色', null, '4', '1', '2016-12-18 19:48:05');
