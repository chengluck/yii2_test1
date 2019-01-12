/*
Navicat MySQL Data Transfer

Source Server         : test
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : advanced

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-01-12 10:56:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_assignment
-- ----------------------------
INSERT INTO `auth_assignment` VALUES ('gii管理', '2', '1545534712');
INSERT INTO `auth_assignment` VALUES ('博客管理', '1', '1545470626');
INSERT INTO `auth_assignment` VALUES ('博客管理', '2', '1545469355');
INSERT INTO `auth_assignment` VALUES ('栏目管理', '2', '1545535262');
INSERT INTO `auth_assignment` VALUES ('测试自定义主题模板', '2', '1545553636');
INSERT INTO `auth_assignment` VALUES ('管理员', '2', '1545470333');

-- ----------------------------
-- Table structure for auth_item
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_item
-- ----------------------------
INSERT INTO `auth_item` VALUES ('/admin/*', '2', null, null, null, '1545469518', '1545469518');
INSERT INTO `auth_item` VALUES ('/admin/assignment/index', '2', null, null, null, '1545535589', '1545535589');
INSERT INTO `auth_item` VALUES ('/admin/debug', '2', null, null, null, '1546048694', '1546048694');
INSERT INTO `auth_item` VALUES ('/admin/menu/*', '2', null, null, null, '1545533676', '1545533676');
INSERT INTO `auth_item` VALUES ('/admin/menu/index', '2', null, null, null, '1545533501', '1545533501');
INSERT INTO `auth_item` VALUES ('/admin/menu/view', '2', null, null, null, '1545533727', '1545533727');
INSERT INTO `auth_item` VALUES ('/blog-backend/create', '2', null, null, null, '1545464093', '1545464093');
INSERT INTO `auth_item` VALUES ('/blog-backend/delete', '2', null, null, null, '1545462561', '1545462561');
INSERT INTO `auth_item` VALUES ('/blog-backend/index', '2', '博客列表', null, null, '1545362121', '1545362121');
INSERT INTO `auth_item` VALUES ('/blog-backend/update', '2', null, null, null, '1545462561', '1545462561');
INSERT INTO `auth_item` VALUES ('/blog-backend/validate-form/*', '2', null, null, null, '1546068142', '1546068142');
INSERT INTO `auth_item` VALUES ('/blog-backend/view', '2', null, null, null, '1545462561', '1545462561');
INSERT INTO `auth_item` VALUES ('/category-backend/*', '2', null, null, null, '1545535130', '1545535130');
INSERT INTO `auth_item` VALUES ('/category-backend/index', '2', null, null, null, '1545535362', '1545535362');
INSERT INTO `auth_item` VALUES ('/debug/*', '2', null, null, null, '1546048740', '1546048740');
INSERT INTO `auth_item` VALUES ('/event-test/index', '2', null, null, null, '1546399666', '1546399666');
INSERT INTO `auth_item` VALUES ('/gii/*', '2', null, null, null, '1545534604', '1545534604');
INSERT INTO `auth_item` VALUES ('/test-backend/*', '2', null, null, null, '1545553531', '1545553531');
INSERT INTO `auth_item` VALUES ('/test-backend/index', '2', null, null, null, '1545553691', '1545553691');
INSERT INTO `auth_item` VALUES ('gii管理', '1', null, null, null, '1545534672', '1545534672');
INSERT INTO `auth_item` VALUES ('博客管理', '1', null, null, null, '1545362121', '1545362121');
INSERT INTO `auth_item` VALUES ('权限管理', '2', null, null, null, '1545469680', '1545469680');
INSERT INTO `auth_item` VALUES ('栏目管理', '1', null, null, null, '1545535068', '1545535236');
INSERT INTO `auth_item` VALUES ('测试自定义主题模板', '1', null, null, null, '1545553601', '1545553662');
INSERT INTO `auth_item` VALUES ('管理员', '1', null, null, null, '1545470140', '1545470140');

-- ----------------------------
-- Table structure for auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_item_child
-- ----------------------------
INSERT INTO `auth_item_child` VALUES ('权限管理', '/admin/*');
INSERT INTO `auth_item_child` VALUES ('博客管理', '/blog-backend/create');
INSERT INTO `auth_item_child` VALUES ('博客管理', '/blog-backend/delete');
INSERT INTO `auth_item_child` VALUES ('博客管理', '/blog-backend/index');
INSERT INTO `auth_item_child` VALUES ('博客管理', '/blog-backend/update');
INSERT INTO `auth_item_child` VALUES ('管理员', '/blog-backend/validate-form/*');
INSERT INTO `auth_item_child` VALUES ('博客管理', '/blog-backend/view');
INSERT INTO `auth_item_child` VALUES ('栏目管理', '/category-backend/*');
INSERT INTO `auth_item_child` VALUES ('管理员', '/debug/*');
INSERT INTO `auth_item_child` VALUES ('管理员', '/event-test/index');
INSERT INTO `auth_item_child` VALUES ('gii管理', '/gii/*');
INSERT INTO `auth_item_child` VALUES ('测试自定义主题模板', '/test-backend/*');
INSERT INTO `auth_item_child` VALUES ('管理员', '博客管理');
INSERT INTO `auth_item_child` VALUES ('管理员', '权限管理');

-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_rule
-- ----------------------------

-- ----------------------------
-- Table structure for blog
-- ----------------------------
DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `is_delete` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否删除 1未删除 2已删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog
-- ----------------------------
INSERT INTO `blog` VALUES ('1', '标题', '内容', '1');
INSERT INTO `blog` VALUES ('3', '标题3', '内容3', '1');

-- ----------------------------
-- Table structure for blog_category
-- ----------------------------
DROP TABLE IF EXISTS `blog_category`;
CREATE TABLE `blog_category` (
  `blog_id` int(11) NOT NULL COMMENT '文章ID',
  `category_id` int(11) NOT NULL COMMENT '栏目ID',
  KEY `blog_id` (`blog_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章-栏目关联表';

-- ----------------------------
-- Records of blog_category
-- ----------------------------
INSERT INTO `blog_category` VALUES ('1', '4');
INSERT INTO `blog_category` VALUES ('3', '3');
INSERT INTO `blog_category` VALUES ('3', '4');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '栏目ID',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '栏目名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='栏目表';

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('3', '111');
INSERT INTO `category` VALUES ('4', '111');
INSERT INTO `category` VALUES ('5', '222');

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('1', '11111');
INSERT INTO `goods` VALUES ('2', '22222');
INSERT INTO `goods` VALUES ('3', '333');
INSERT INTO `goods` VALUES ('4', '444');
INSERT INTO `goods` VALUES ('5', '555');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(256) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '权限管理', null, '/admin/assignment/index', '0', null);
INSERT INTO `menu` VALUES ('2', '菜单', null, '/admin/menu/index', '1', null);
INSERT INTO `menu` VALUES ('3', '栏目管理', null, '/category-backend/index', null, null);
INSERT INTO `menu` VALUES ('4', '自定义主题模板', null, '/test-backend/index', null, null);

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1544938034');
INSERT INTO `migration` VALUES ('m130524_201442_init', '1544938042');
INSERT INTO `migration` VALUES ('m181216_052912_create_blog_table', '1544938298');
INSERT INTO `migration` VALUES ('m140506_102106_rbac_init', '1545360178');
INSERT INTO `migration` VALUES ('m170907_052038_rbac_add_index_on_auth_assignment_user_id', '1545360178');

-- ----------------------------
-- Table structure for test
-- ----------------------------
DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of test
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------

-- ----------------------------
-- Table structure for user_backend
-- ----------------------------
DROP TABLE IF EXISTS `user_backend`;
CREATE TABLE `user_backend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_backend
-- ----------------------------
INSERT INTO `user_backend` VALUES ('1', 'test1', 'Etf0ymVhVatgo7ZaOQgCAAw6jRAvwp5Z', '$2y$13$tjMmzGZAtQRxjMNPbDcLG.AHjzUHOtMif3VwA1zTVWIPaRYy3qEPu', 'test@163.com', '2018-12-19 07:44:11', '2018-12-19 07:44:11');
INSERT INTO `user_backend` VALUES ('2', 'test2', 'YSY3KW8axTZtnlAnCvlcqL1Q0A3D_rrP', '$2y$13$1PSHgIk11kyZYjzRMtiO/esNi66LQVrDxFSJ8CKaUrznoOMNY2som', 'test2@163.com', '2018-12-19 10:02:19', '2018-12-19 10:02:19');
