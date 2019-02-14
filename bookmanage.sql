/*
 Navicat Premium Data Transfer

 Source Server         : 10.211.55.4
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : 10.211.55.4
 Source Database       : test

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : utf-8

 Date: 02/14/2019 19:22:44 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `book_cate_info`
-- ----------------------------
DROP TABLE IF EXISTS `book_cate_info`;
CREATE TABLE `book_cate_info` (
  `cate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(30) NOT NULL DEFAULT '' COMMENT '出版社名称',
  `cate_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 屏蔽 2 正常',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`cate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `book_cate_info`
-- ----------------------------
BEGIN;
INSERT INTO `book_cate_info` VALUES ('1', '体育类', '2', '2019-01-19 23:17:09', '2019-01-19 23:27:53'), ('2', '人文科学类', '2', '2019-02-14 10:28:45', '2019-02-14 10:28:45'), ('3', '计算机类', '2', '2019-01-19 23:18:11', '2019-01-20 11:25:55'), ('4', '数学类', '2', '2019-02-14 10:31:17', '2019-02-14 10:31:17'), ('5', '思想品德类', '2', '2019-02-14 10:31:42', '2019-02-14 10:31:42');
COMMIT;

-- ----------------------------
--  Table structure for `book_info`
-- ----------------------------
DROP TABLE IF EXISTS `book_info`;
CREATE TABLE `book_info` (
  `book_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `book_cert` int(32) unsigned NOT NULL DEFAULT '0' COMMENT '图书编号',
  `book_name` varchar(32) NOT NULL DEFAULT '' COMMENT '图书名称',
  `book_cate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '图书类别',
  `book_public` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '出版社',
  `book_place` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '书架位置',
  `book_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '图书库存',
  `book_now_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '图书实时库存',
  `book_total_out` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '借出总次数',
  `book_status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '图书状态 1 屏蔽 2 正常',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `book_info`
-- ----------------------------
BEGIN;
INSERT INTO `book_info` VALUES ('4', '2019020345', '计算机组成原理', '3', '5', '1', '10', '9', '1', '2', '2019-02-14 11:42:54', '2019-02-14 10:40:58'), ('5', '2019020346', '汇编语言', '3', '6', '2', '15', '14', '1', '2', '2019-02-14 11:33:27', '2019-02-14 10:50:24'), ('6', '2019020347', '离散数学', '4', '3', '2', '20', '19', '1', '2', '2019-02-14 11:32:59', '2019-02-14 10:50:56'), ('7', '2019020348', '线性代数', '4', '3', '2', '10', '9', '1', '2', '2019-02-14 11:32:42', '2019-02-14 10:51:47'), ('8', '2019020349', '中国近代史纲要', '2', '1', '2', '20', '19', '1', '2', '2019-02-14 11:32:20', '2019-02-14 10:55:33'), ('9', '2019020350', '大学英语', '2', '4', '2', '30', '30', '0', '2', '2019-02-14 14:24:09', '2019-02-14 14:23:53'), ('10', '2019020351', 'C程序设计', '3', '6', '2', '30', '30', '0', '2', '2019-02-14 14:22:17', '2019-02-14 10:53:21'), ('11', '2019020352', '数据库原理', '3', '6', '2', '15', '13', '2', '2', '2019-02-14 11:32:05', '2019-02-14 10:53:47'), ('12', '2019020353', '毛泽东思想和中国特色社会主义理论体概论', '5', '3', '2', '25', '25', '0', '2', '2019-02-14 10:54:31', '2019-02-14 10:54:31'), ('13', '2019020354', '嵌入式linux系统开发', '3', '5', '2', '10', '10', '0', '2', '2019-02-14 10:55:02', '2019-02-14 10:55:02'), ('14', '2019020355', '思想道德修养和法律基础', '5', '3', '3', '10', '10', '0', '2', '2019-02-14 10:56:14', '2019-02-14 10:56:14'), ('15', '2019020356', '大学体育与健康', '1', '3', '1', '5', '2', '8', '2', '2019-02-14 14:26:31', '2019-02-14 10:57:28');
COMMIT;

-- ----------------------------
--  Table structure for `book_lend_info`
-- ----------------------------
DROP TABLE IF EXISTS `book_lend_info`;
CREATE TABLE `book_lend_info` (
  `lend_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `book_cert` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '图书编号',
  `user_name` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户编号',
  `lend_status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1 未归还 2 已归还',
  `expired_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '到期时间',
  `created_day` varchar(10) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '归还时间',
  PRIMARY KEY (`lend_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `book_lend_info`
-- ----------------------------
BEGIN;
INSERT INTO `book_lend_info` VALUES ('12', '2019020356', '2019001005', '2', '2019-03-16 11:28:28', '2019-02-11', '2019-02-14 11:28:28', '2019-02-14 11:28:28'), ('13', '2019020352', '2019001004', '1', '2019-02-24 11:31:40', '2019-02-11', '2019-02-14 11:31:40', '2019-02-14 11:31:40'), ('14', '2019020352', '2019001003', '1', '2019-03-01 11:32:05', '2019-02-11', '2019-02-14 11:32:05', '2019-02-14 11:32:05'), ('15', '2019020349', '2019001002', '1', '2019-02-24 11:32:20', '2019-02-11', '2019-02-14 11:32:20', '2019-02-14 11:32:20'), ('16', '2019020348', '2019001002', '1', '2019-02-24 11:32:42', '2019-02-12', '2019-02-14 11:32:42', '2019-02-14 11:32:42'), ('17', '2019020347', '2019001002', '1', '2019-02-24 11:32:59', '2019-02-12', '2019-02-14 11:32:59', '2019-02-14 11:32:59'), ('18', '2019020346', '2019001001', '1', '2019-02-24 11:33:27', '2019-02-13', '2019-02-14 11:33:27', '2019-02-14 11:33:27'), ('19', '2019020356', '2019001003', '1', '2019-03-01 11:36:36', '2019-02-13', '2019-02-14 11:36:36', '2019-02-14 11:36:36'), ('20', '2019020356', '2019001005', '1', '2019-03-01 11:37:18', '2019-02-14', '2019-02-14 11:37:18', '2019-02-14 11:37:18'), ('21', '2019020356', '2019001004', '1', '2019-02-13 11:37:37', '2019-02-14', '2019-02-14 11:37:37', '2019-02-14 11:37:37'), ('22', '2019020356', '2019001004', '1', '2019-02-24 11:37:53', '2019-02-15', '2019-02-14 11:37:53', '2019-02-14 11:37:53'), ('23', '2019020356', '2019001003', '2', '2019-03-16 11:38:12', '2019-02-16', '2019-02-14 11:38:12', '2019-02-14 11:38:12'), ('24', '2019020345', '2019001003', '1', '2019-03-01 11:42:54', '2019-02-17', '2019-02-14 11:42:54', '2019-02-14 11:42:54');
COMMIT;

-- ----------------------------
--  Table structure for `book_place_info`
-- ----------------------------
DROP TABLE IF EXISTS `book_place_info`;
CREATE TABLE `book_place_info` (
  `place_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `place_name` varchar(30) NOT NULL DEFAULT '' COMMENT '出版社名称',
  `place_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 屏蔽 2 正常',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`place_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `book_place_info`
-- ----------------------------
BEGIN;
INSERT INTO `book_place_info` VALUES ('1', '左C-3', '2', '2019-01-19 23:17:09', '2019-01-20 11:41:35'), ('2', '右B-2', '2', '2019-01-19 23:17:58', '2019-01-20 11:41:23'), ('3', '左A-1', '2', '2019-01-19 23:18:11', '2019-02-02 21:05:39');
COMMIT;

-- ----------------------------
--  Table structure for `public_info`
-- ----------------------------
DROP TABLE IF EXISTS `public_info`;
CREATE TABLE `public_info` (
  `public_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `public_name` varchar(30) NOT NULL DEFAULT '' COMMENT '出版社名称',
  `public_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 屏蔽 2 正常',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`public_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `public_info`
-- ----------------------------
BEGIN;
INSERT INTO `public_info` VALUES ('1', '人民出版社', '2', '2019-01-19 23:17:09', '2019-01-19 23:17:09'), ('2', '财富出版社', '2', '2019-01-19 23:17:58', '2019-01-19 23:17:58'), ('3', '人民教育出版社', '2', '2019-02-14 10:35:53', '2019-02-14 10:35:53'), ('4', '北京大学出版社', '2', '2019-02-14 10:36:03', '2019-02-14 10:36:03'), ('5', '清华大学出版社', '2', '2019-02-14 10:36:16', '2019-02-14 10:36:16'), ('6', '哈工大出版社', '2', '2019-02-14 10:36:45', '2019-02-14 10:36:45');
COMMIT;

-- ----------------------------
--  Table structure for `site_info`
-- ----------------------------
DROP TABLE IF EXISTS `site_info`;
CREATE TABLE `site_info` (
  `site_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_name` varchar(60) NOT NULL DEFAULT '' COMMENT '系统名称',
  `site_time` varchar(100) NOT NULL DEFAULT '' COMMENT '开放时间',
  `site_user` varchar(60) NOT NULL DEFAULT '' COMMENT '负责人',
  `site_tel` varchar(30) NOT NULL DEFAULT '' COMMENT '联系方式',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `site_info`
-- ----------------------------
BEGIN;
INSERT INTO `site_info` VALUES ('1', '临沂大学图书管理系统', '8:00:16:00', '皮蛋', '010-1019101011', '2019-02-14 16:36:51', '2019-02-14 16:36:51');
COMMIT;

-- ----------------------------
--  Table structure for `user_cate_info`
-- ----------------------------
DROP TABLE IF EXISTS `user_cate_info`;
CREATE TABLE `user_cate_info` (
  `cate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(30) NOT NULL DEFAULT '' COMMENT '名称',
  `limit_day` int(10) unsigned NOT NULL DEFAULT '10' COMMENT '借出归还时间',
  `limit_num` int(10) NOT NULL DEFAULT '1' COMMENT '一次借出书数量',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`cate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `user_cate_info`
-- ----------------------------
BEGIN;
INSERT INTO `user_cate_info` VALUES ('1', '教师', '15', '5', '2019-02-14 11:26:53', '2019-02-14 11:26:53'), ('2', '学生', '10', '3', '2019-02-14 11:26:11', '2019-02-14 11:26:11');
COMMIT;

-- ----------------------------
--  Table structure for `user_info`
-- ----------------------------
DROP TABLE IF EXISTS `user_info`;
CREATE TABLE `user_info` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` int(10) NOT NULL COMMENT '账号',
  `user_nickname` varchar(30) NOT NULL DEFAULT '' COMMENT '姓名',
  `user_pass` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `user_email` varchar(30) NOT NULL DEFAULT '' COMMENT '用户邮箱',
  `user_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '用户类型 1 普通用户 2 管理员',
  `user_cate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户身份',
  `last_ip` varchar(30) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `last_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后登录时间',
  `user_status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1 屏蔽 2 正常',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `user_info`
-- ----------------------------
BEGIN;
INSERT INTO `user_info` VALUES ('1', '1111111', '沈从文', '21232f297a57a5a743894a0e4a801fc3', '1638824607@qq.com', '2', '2', '10.211.55.2', '2019-02-14 17:02:28', '2', '2019-01-19 18:16:59', '2019-02-14 17:02:28'), ('2', '2019001001', '王一天', '', '', '1', '2', '', '2019-02-14 11:03:13', '2', '2019-01-19 22:13:36', '2019-02-14 11:03:13'), ('3', '2019001002', '毛一发', 'e10adc3949ba59abbe56e057f20f883e', '', '1', '2', '', '2019-02-14 10:58:31', '2', '2019-01-19 22:15:31', '2019-02-14 10:58:31'), ('4', '2019001003', '李一腾', 'e10adc3949ba59abbe56e057f20f883e', '', '1', '1', '', '2019-02-14 11:02:56', '2', '2019-02-14 11:02:56', '2019-02-14 11:02:56'), ('5', '2019001004', '谢一谢', 'e10adc3949ba59abbe56e057f20f883e', '', '1', '2', '10.211.55.2', '2019-02-14 18:56:03', '2', '2019-02-14 11:03:47', '2019-02-14 18:56:03'), ('6', '2019001005', '张一山', '57d3743c3199afcba4b75aa53ad3c0d3', '1638824607@qq.com', '1', '1', '10.211.55.2', '2019-02-14 19:13:45', '2', '2019-02-14 11:04:37', '2019-02-14 19:13:45'), ('7', '2222222', '沈从学', 'e10adc3949ba59abbe56e057f20f883e', '', '2', '0', '', '2019-02-14 11:27:44', '2', '2019-02-14 11:27:44', '2019-02-14 11:27:44');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
