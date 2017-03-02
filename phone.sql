/*
Navicat MySQL Data Transfer

Source Server         : lsmz
Source Server Version : 50617
Source Host           : 127.0.0.1:3306
Source Database       : phone

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2017-03-02 19:23:27
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
  `password_wrong_count` tinyint(2) DEFAULT '0' COMMENT '密码错误次数，错误三次锁定',
  `lock` tinyint(1) DEFAULT '0' COMMENT '锁定、禁止登录',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1男,2女,0未知,9 未说明的性别',
  `mobile` char(32) DEFAULT '' COMMENT '手机号码',
  `roleId` tinyint(1) DEFAULT NULL COMMENT '角色id（0超级管理员 1管理员）',
  `last_login_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后登录时间',
  `last_ip` char(15) NOT NULL DEFAULT '' COMMENT '上次登录ip',
  `login_count` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '登陆次数',
  PRIMARY KEY (`id`),
  KEY `username` (`name`),
  KEY `mobile` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='管理员表';

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'zhm', null, '789c270c828211b6deae4df8d856d253', '130ad95504f1f020a310bd3a695590a3', 'faa2bf9196ce8fb0d088a0f269ad9b44', '2017-02-27 20:42:05', '1', '0', '0', '', null, '2017-02-20 20:42:05', '127.0.0.1', '19');

-- ----------------------------
-- Table structure for `good`
-- ----------------------------
DROP TABLE IF EXISTS `good`;
CREATE TABLE `good` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '名称（50个字以内）',
  `description` text COMMENT '描述',
  `price_origin` float(11,2) unsigned DEFAULT NULL COMMENT '原价',
  `price_min` float(11,2) unsigned DEFAULT NULL COMMENT '最低现价（不同种类价格不同）',
  `price_max` float(11,2) DEFAULT NULL COMMENT '最高价',
  `putaway_time` datetime DEFAULT NULL COMMENT '上架时间',
  `sorts` text COMMENT '分类（颜色:红色,白色;尺寸:4.7,5.1）',
  `pic_url` varchar(100) DEFAULT NULL COMMENT '主图地址 图片（1~10张）',
  `remain` smallint(4) unsigned DEFAULT NULL COMMENT '库存',
  `collect` int(11) unsigned DEFAULT NULL COMMENT '收藏量',
  `hot` int(11) unsigned DEFAULT '0' COMMENT '浏览次数',
  `lock` tinyint(1) DEFAULT '0' COMMENT '是否锁定',
  `rate` float(11,2) DEFAULT NULL COMMENT '人民兑欧元汇率',
  `category` varchar(20) DEFAULT NULL COMMENT '类别/型号',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='商品表';

-- ----------------------------
-- Records of good
-- ----------------------------
INSERT INTO `good` VALUES ('8', 'Apple iPhone 7 (A1660) 32G 玫瑰金色 移动联通电信4G手机', '<p>zz</p>', '5199.00', '5199.00', '5199.00', '2017-02-12 19:15:52', 'a:1:{i:0;a:5:{s:2:\"id\";s:2:\"15\";s:4:\"name\";s:6:\"尺寸\";s:8:\"children\";a:2:{i:0;a:4:{s:2:\"id\";s:2:\"16\";s:4:\"name\";s:6:\"4.7寸\";s:5:\"value\";s:2:\"16\";s:5:\"label\";s:6:\"4.7寸\";}i:1;a:4:{s:2:\"id\";s:2:\"17\";s:4:\"name\";s:6:\"5.1寸\";s:5:\"value\";s:2:\"17\";s:5:\"label\";s:6:\"5.1寸\";}}s:5:\"value\";s:2:\"15\";s:5:\"label\";s:6:\"尺寸\";}}', '/upload/20170212/191529_498.jpg', '20', null, '0', '0', null, null, '2017-02-14 21:03:38');
INSERT INTO `good` VALUES ('9', '乐视(Letv) 乐Max X900+ 蓝宝石版移动联通电信4G手机 粉色 128GB', '<p>zz</p>', '1899.00', '1899.00', null, '2017-02-01 21:15:05', null, '/upload/20170212/191442_385.jpg', '10', null, '0', '0', null, null, '2017-02-14 21:15:10');
INSERT INTO `good` VALUES ('10', '荣耀8 4GB+32GB 全网通4G手机 珠光白', null, '2199.00', '3299.00', '3299.00', '2017-02-01 21:15:55', 'a:1:{i:0;a:5:{s:2:\"id\";s:1:\"6\";s:4:\"name\";s:6:\"颜色\";s:8:\"children\";a:2:{i:0;a:4:{s:2:\"id\";s:2:\"12\";s:4:\"name\";s:6:\"红色\";s:5:\"value\";s:2:\"12\";s:5:\"label\";s:6:\"红色\";}i:1;a:4:{s:2:\"id\";s:2:\"14\";s:4:\"name\";s:6:\"黑色\";s:5:\"value\";s:2:\"14\";s:5:\"label\";s:6:\"黑色\";}}s:5:\"value\";s:1:\"6\";s:5:\"label\";s:6:\"颜色\";}}', '/upload/20170214/211607_670.jpg', '20', null, '0', '0', null, null, '2017-02-14 21:16:40');
INSERT INTO `good` VALUES ('11', 'OPPO R9s 全网通4G+64G 双卡双待手机 玫瑰金', null, '2799.00', '2799.00', '2899.00', '2017-02-02 12:09:28', 'a:1:{i:0;a:5:{s:2:\"id\";s:1:\"6\";s:4:\"name\";s:6:\"颜色\";s:8:\"children\";a:3:{i:0;a:4:{s:2:\"id\";s:2:\"12\";s:4:\"name\";s:6:\"红色\";s:5:\"value\";s:2:\"12\";s:5:\"label\";s:6:\"红色\";}i:1;a:4:{s:2:\"id\";s:2:\"14\";s:4:\"name\";s:6:\"黑色\";s:5:\"value\";s:2:\"14\";s:5:\"label\";s:6:\"黑色\";}i:2;a:4:{s:2:\"id\";s:2:\"18\";s:4:\"name\";s:6:\"金色\";s:5:\"value\";s:2:\"18\";s:5:\"label\";s:6:\"金色\";}}s:5:\"value\";s:1:\"6\";s:5:\"label\";s:6:\"颜色\";}}', '/upload/20170212/121040_648.jpg', '30', null, '0', '0', null, null, '2017-02-14 21:15:40');
INSERT INTO `good` VALUES ('12', '努比亚(nubia)【6+64GB】Z11 （百合金）移动联通电信4G手机 双卡双待', null, '3199.00', '3199.00', null, '2017-02-18 10:14:06', null, '/upload/20170218/101404_494.jpg', '20', null, '0', '0', null, '19,26', '2017-02-19 20:51:00');
INSERT INTO `good` VALUES ('14', '小米5 全网通 高配版 3GB内存 64GB ROM 白色 移动联通电信4G手机', null, null, null, null, '2017-02-18 11:23:11', null, '/upload/20170218/112249_178.jpg', null, null, '0', '0', null, null, '2017-02-18 12:03:19');
INSERT INTO `good` VALUES ('15', 'ggg', null, '0.00', '0.00', null, '2017-02-18 11:26:19', null, '/upload/20170218/114832_141.jpg', '0', null, '0', '0', null, '5,7', '2017-02-18 20:11:13');

-- ----------------------------
-- Table structure for `good_bin`
-- ----------------------------
DROP TABLE IF EXISTS `good_bin`;
CREATE TABLE `good_bin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '名称（50个字以内）',
  `description` text COMMENT '描述',
  `price_origin` int(11) unsigned DEFAULT NULL COMMENT '原价',
  `price_min` int(11) unsigned DEFAULT NULL COMMENT '最低现价（不同种类价格不同）',
  `price_max` int(11) DEFAULT NULL COMMENT '最高价',
  `putaway_time` datetime DEFAULT NULL COMMENT '上架时间',
  `sorts` varchar(100) DEFAULT NULL COMMENT '分类（颜色:红色,白色;尺寸:4.7,5.1）',
  `pic_url` varchar(100) DEFAULT NULL COMMENT '主图地址 图片（1~10张）',
  `remain` smallint(4) unsigned DEFAULT NULL COMMENT '库存',
  `collect` int(11) unsigned DEFAULT NULL COMMENT '收藏量',
  `hot` int(11) unsigned DEFAULT '0' COMMENT '浏览次数',
  `lock` tinyint(1) DEFAULT '0' COMMENT '是否锁定',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='商品表回收站';

-- ----------------------------
-- Records of good_bin
-- ----------------------------
INSERT INTO `good_bin` VALUES ('1', 'iphone7', null, '15', '10', null, '2017-02-22 10:50:26', null, null, '10', null, '0', '0', '2017-02-02 11:28:18');
INSERT INTO `good_bin` VALUES ('2', 'iphone7', '<p>fg</p>', '11', '10', null, '2017-02-22 10:50:26', 'a:2:{i:0;a:5:{s:2:\"id\";s:2:\"15\";s:4:\"name\";s:6:\"尺寸\";s:8:\"children\";a:2:{i:0;a:4:{s:2:\"id\";s:2:\"16\";s', null, '10', null, '0', '1', '2017-02-12 10:29:43');
INSERT INTO `good_bin` VALUES ('3', 'iphone7', null, '20', '10', null, '2017-02-22 10:50:26', null, null, '10', null, '0', '0', '2017-02-02 11:27:43');
INSERT INTO `good_bin` VALUES ('4', 'iphone7', null, '20', '10', null, '2017-02-22 10:50:26', null, null, '10', null, '0', '0', '2017-02-02 11:25:51');
INSERT INTO `good_bin` VALUES ('5', 'iphone7', null, '10', '10', null, '2017-02-10 11:20:08', null, null, '10', null, '0', '0', '2017-02-02 11:20:16');
INSERT INTO `good_bin` VALUES ('6', 'iphone7', null, '10', '10', null, '2017-02-22 10:50:26', null, null, '10', null, '0', '0', '2017-02-02 11:12:53');

-- ----------------------------
-- Table structure for `good_pic`
-- ----------------------------
DROP TABLE IF EXISTS `good_pic`;
CREATE TABLE `good_pic` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` int(11) NOT NULL COMMENT '商品id',
  `name` varchar(20) DEFAULT NULL COMMENT '图片名称（10个字以内）',
  `url` varchar(100) DEFAULT NULL COMMENT '图片地址',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='商品图片表';

-- ----------------------------
-- Records of good_pic
-- ----------------------------
INSERT INTO `good_pic` VALUES ('4', '11', null, '/upload/20170212/121040_648.jpg', '2017-02-12 12:10:40');
INSERT INTO `good_pic` VALUES ('5', '9', null, '/upload/20170212/191442_385.jpg', '2017-02-12 19:14:42');
INSERT INTO `good_pic` VALUES ('6', '8', null, '/upload/20170212/191529_498.jpg', '2017-02-12 19:15:30');
INSERT INTO `good_pic` VALUES ('7', '10', null, '/upload/20170214/211607_670.jpg', '2017-02-14 21:16:07');
INSERT INTO `good_pic` VALUES ('8', '10', null, '/upload/20170218/101151_879.jpg', '2017-02-18 10:11:51');
INSERT INTO `good_pic` VALUES ('9', '12', null, '/upload/20170218/101404_494.jpg', '2017-02-18 10:14:06');
INSERT INTO `good_pic` VALUES ('10', '12', null, '/upload/20170218/111750_867.jpg', '2017-02-18 11:17:50');
INSERT INTO `good_pic` VALUES ('12', '14', null, '/upload/20170218/112249_178.jpg', '2017-02-18 11:23:11');
INSERT INTO `good_pic` VALUES ('14', '15', null, '/upload/20170218/114832_141.jpg', '2017-02-18 11:48:33');
INSERT INTO `good_pic` VALUES ('16', '15', null, '/upload/20170218/120109_568.jpg', '2017-02-18 12:01:09');
INSERT INTO `good_pic` VALUES ('17', '14', null, '/upload/20170218/120319_473.jpg', '2017-02-18 12:03:19');

-- ----------------------------
-- Table structure for `good_pic_bin`
-- ----------------------------
DROP TABLE IF EXISTS `good_pic_bin`;
CREATE TABLE `good_pic_bin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` int(11) NOT NULL COMMENT '商品id',
  `name` varchar(20) DEFAULT NULL COMMENT '图片名称（10个字以内）',
  `url` varchar(100) DEFAULT NULL COMMENT '图片地址',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='商品图片表回收站';

-- ----------------------------
-- Records of good_pic_bin
-- ----------------------------
INSERT INTO `good_pic_bin` VALUES ('1', '4', null, '/upload/20170212/111320_333.jpg', '2017-02-12 11:13:20');

-- ----------------------------
-- Table structure for `good_sort`
-- ----------------------------
DROP TABLE IF EXISTS `good_sort`;
CREATE TABLE `good_sort` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` int(11) unsigned DEFAULT NULL COMMENT '商品id',
  `sorts` varchar(250) DEFAULT NULL COMMENT '类别',
  `remain` int(11) unsigned DEFAULT '0' COMMENT '库存',
  `price` float(2,0) unsigned DEFAULT NULL COMMENT '价格',
  `pic_id` int(11) unsigned DEFAULT NULL COMMENT '图片id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='商品分类表';

-- ----------------------------
-- Records of good_sort
-- ----------------------------
INSERT INTO `good_sort` VALUES ('16', '11', 'a:1:{i:6;a:4:{s:2:\"id\";s:2:\"12\";s:4:\"name\";s:6:\"红色\";s:5:\"value\";s:2:\"12\";s:5:\"label\";s:6:\"红色\";}}', '10', '99', '0');
INSERT INTO `good_sort` VALUES ('17', '11', 'a:1:{i:6;a:4:{s:2:\"id\";s:2:\"14\";s:4:\"name\";s:6:\"黑色\";s:5:\"value\";s:2:\"14\";s:5:\"label\";s:6:\"黑色\";}}', '10', '99', '0');
INSERT INTO `good_sort` VALUES ('18', '11', 'a:1:{i:6;a:4:{s:2:\"id\";s:2:\"18\";s:4:\"name\";s:6:\"金色\";s:5:\"value\";s:2:\"18\";s:5:\"label\";s:6:\"金色\";}}', '10', '99', '0');
INSERT INTO `good_sort` VALUES ('24', '10', 'a:1:{i:6;a:4:{s:2:\"id\";s:2:\"12\";s:4:\"name\";s:6:\"红色\";s:5:\"value\";s:2:\"12\";s:5:\"label\";s:6:\"红色\";}}', '10', '99', '0');
INSERT INTO `good_sort` VALUES ('25', '10', 'a:1:{i:6;a:4:{s:2:\"id\";s:2:\"14\";s:4:\"name\";s:6:\"黑色\";s:5:\"value\";s:2:\"14\";s:5:\"label\";s:6:\"黑色\";}}', '10', '99', '0');
INSERT INTO `good_sort` VALUES ('26', '8', 'a:1:{i:15;a:4:{s:2:\"id\";s:2:\"16\";s:4:\"name\";s:6:\"4.7寸\";s:5:\"value\";s:2:\"16\";s:5:\"label\";s:6:\"4.7寸\";}}', '10', '99', null);
INSERT INTO `good_sort` VALUES ('27', '8', 'a:1:{i:15;a:4:{s:2:\"id\";s:2:\"17\";s:4:\"name\";s:6:\"5.1寸\";s:5:\"value\";s:2:\"17\";s:5:\"label\";s:6:\"5.1寸\";}}', '10', '99', null);

-- ----------------------------
-- Table structure for `good_sort_bin`
-- ----------------------------
DROP TABLE IF EXISTS `good_sort_bin`;
CREATE TABLE `good_sort_bin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` int(11) unsigned DEFAULT NULL COMMENT '商品id',
  `sorts` varchar(100) DEFAULT NULL COMMENT '类别',
  `remain` int(11) unsigned DEFAULT '0' COMMENT '库存',
  `price` int(11) unsigned DEFAULT NULL COMMENT '价格',
  `pic_id` int(11) unsigned DEFAULT NULL COMMENT '图片id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='商品分类表回收站';

-- ----------------------------
-- Records of good_sort_bin
-- ----------------------------
INSERT INTO `good_sort_bin` VALUES ('1', '1', '1:2;3:4', '0', '10', null);
INSERT INTO `good_sort_bin` VALUES ('2', '1', 'a:2:{i:6;a:4:{s:2:\"id\";s:2:\"12\";s:4:\"name\";s:6:\"红色\";s:5:\"value\";s:2:\"12\";s:5:\"label\";s:6:\"红色\";}i:15;', '100', '0', '0');
INSERT INTO `good_sort_bin` VALUES ('3', '1', 'a:2:{i:6;a:4:{s:2:\"id\";s:2:\"14\";s:4:\"name\";s:6:\"黑色\";s:5:\"value\";s:2:\"14\";s:5:\"label\";s:6:\"黑色\";}i:15;', '100', '0', '0');
INSERT INTO `good_sort_bin` VALUES ('4', '1', 'a:2:{i:6;a:4:{s:2:\"id\";s:2:\"12\";s:4:\"name\";s:6:\"红色\";s:5:\"value\";s:2:\"12\";s:5:\"label\";s:6:\"红色\";}i:15;', '0', '0', '0');
INSERT INTO `good_sort_bin` VALUES ('5', '1', 'a:2:{i:6;a:4:{s:2:\"id\";s:2:\"14\";s:4:\"name\";s:6:\"黑色\";s:5:\"value\";s:2:\"14\";s:5:\"label\";s:6:\"黑色\";}i:15;', '0', '0', '0');
INSERT INTO `good_sort_bin` VALUES ('6', '16', 'a:1:{i:15;a:4:{s:2:\"id\";s:2:\"16\";s:4:\"name\";s:6:\"4.7寸\";s:5:\"value\";s:2:\"16\";s:5:\"label\";s:6:\"4.7寸\";}', '10', '99', '0');

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
  `parent_id` int(11) DEFAULT NULL COMMENT '父分类id',
  `parent_ids` varchar(20) DEFAULT NULL,
  `level` tinyint(1) DEFAULT '0' COMMENT '级别',
  `order_id` smallint(2) DEFAULT '0' COMMENT '排序',
  `filter_condition` tinyint(1) DEFAULT NULL COMMENT '作为筛选条件',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='分类表';

-- ----------------------------
-- Records of sorts
-- ----------------------------
INSERT INTO `sorts` VALUES ('5', '品牌', null, '0', '', '0', '0', '0', '2017-02-19 09:45:18');
INSERT INTO `sorts` VALUES ('6', '颜色', '', '0', '', '0', '0', null, '2017-02-18 19:28:54');
INSERT INTO `sorts` VALUES ('7', '苹果', null, '5', '5', '1', '0', null, '2017-02-18 19:22:45');
INSERT INTO `sorts` VALUES ('8', '三星', '', '5', '5', '1', '0', null, '2017-02-18 19:22:47');
INSERT INTO `sorts` VALUES ('9', '华为', '', '5', '5', '1', '0', null, '2017-02-18 19:22:48');
INSERT INTO `sorts` VALUES ('10', '小米', '', '5', '5', '1', '0', null, '2017-02-18 19:22:48');
INSERT INTO `sorts` VALUES ('11', '诺基亚', '', '5', '5', '1', '0', null, '2017-02-18 19:22:49');
INSERT INTO `sorts` VALUES ('12', '红色', '', '6', '6', '1', '0', null, '2017-02-18 19:22:55');
INSERT INTO `sorts` VALUES ('14', '黑色', '', '6', '6', '1', '0', null, '2017-02-18 19:22:56');
INSERT INTO `sorts` VALUES ('15', '尺寸', null, '0', '', '0', '0', null, '2017-02-18 19:28:59');
INSERT INTO `sorts` VALUES ('16', '4.7寸', null, '15', '15', '1', '0', null, '2017-02-18 19:23:04');
INSERT INTO `sorts` VALUES ('17', '5.1寸', null, '15', '15', '1', '0', null, '2017-02-18 19:23:06');
INSERT INTO `sorts` VALUES ('18', '金色', null, '6', '6', '1', '0', null, '2017-02-18 19:23:14');
INSERT INTO `sorts` VALUES ('19', '手机配件', null, '0', null, '0', '0', '1', '2017-02-19 09:45:23');
INSERT INTO `sorts` VALUES ('20', '手机零部件', '', '0', null, '0', '0', '1', '2017-02-19 09:45:24');
INSERT INTO `sorts` VALUES ('21', '电脑配件', '', '0', null, '0', '0', '1', '2017-02-19 09:45:25');
INSERT INTO `sorts` VALUES ('22', 'g', null, '5', '5', '1', '0', null, '2017-02-18 19:42:23');
INSERT INTO `sorts` VALUES ('25', 'iphone7', null, '7', '5,7', '2', '0', null, '2017-02-18 21:10:05');
INSERT INTO `sorts` VALUES ('26', '充电器', null, '19', '19', '1', '0', null, '2017-02-19 09:45:45');
INSERT INTO `sorts` VALUES ('27', '屏幕', null, '19', '19', '1', '0', null, '2017-02-19 09:47:06');
INSERT INTO `sorts` VALUES ('28', 'iphone', '', '20', '20', '1', '0', null, '2017-02-19 09:49:14');
INSERT INTO `sorts` VALUES ('29', 'Samsung', '', '20', '20', '1', '0', null, '2017-02-19 09:50:11');
INSERT INTO `sorts` VALUES ('30', 'iphone7', '', '28', '20,28', '2', '0', null, '2017-02-19 09:53:15');
INSERT INTO `sorts` VALUES ('31', 'iphone6', '', '28', '20,28', '2', '0', null, '2017-02-19 09:53:24');

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
INSERT INTO `user` VALUES ('2', '460569137@qq.com', '130ad95504f1f020a310bd3a695590a3', '9f149bd85e825cd7da4fbdf0631982cf', 'zhm', '789c270c828211b6deae4df8d856d253', '0', '0', '0', '18768122041', '2017-03-01 16:35:42', '127.0.0.1', '2017-02-22 19:35:32', '14', '2017-03-01 16:35:42');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='购物车表';

-- ----------------------------
-- Records of user_cart
-- ----------------------------
INSERT INTO `user_cart` VALUES ('1', '2', null, null, null, null, null, null, null, '2017-03-01 16:31:39', '2017-03-01 16:31:39');
INSERT INTO `user_cart` VALUES ('2', '2', null, null, null, null, null, null, null, '2017-03-01 16:34:47', '2017-03-01 16:34:47');
INSERT INTO `user_cart` VALUES ('3', '2', null, null, null, null, null, null, null, '2017-03-01 16:35:54', '2017-03-01 16:35:54');

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
-- Function structure for `GET_FIRST_PINYIN_CHAR`
-- ----------------------------
DROP FUNCTION IF EXISTS `GET_FIRST_PINYIN_CHAR`;
DELIMITER ;;
CREATE DEFINER=`lsmz`@`127.0.0.1` FUNCTION `GET_FIRST_PINYIN_CHAR`(PARAM VARCHAR(255)) RETURNS varchar(2) CHARSET utf8
BEGIN
    DECLARE V_RETURN VARCHAR(255);
    DECLARE V_FIRST_CHAR VARCHAR(2);
    SET V_FIRST_CHAR = UPPER(LEFT(PARAM,1));
    SET V_RETURN = V_FIRST_CHAR;
    IF LENGTH( V_FIRST_CHAR) <> CHARACTER_LENGTH( V_FIRST_CHAR ) THEN
    SET V_RETURN = ELT(INTERVAL(CONV(HEX(LEFT(CONVERT(PARAM USING gbk),1)),16,10),
        0xB0A1,0xB0C5,0xB2C1,0xB4EE,0xB6EA,0xB7A2,0xB8C1,0xB9FE,0xBBF7,
        0xBFA6,0xC0AC,0xC2E8,0xC4C3,0xC5B6,0xC5BE,0xC6DA,0xC8BB,
        0xC8F6,0xCBFA,0xCDDA,0xCEF4,0xD1B9,0xD4D1),
    'A','B','C','D','E','F','G','H','J','K','L','M','N','O','P','Q','R','S','T','W','X','Y','Z');
    END IF;
    RETURN V_RETURN;
END
;;
DELIMITER ;
