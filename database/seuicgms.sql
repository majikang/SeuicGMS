/*
Navicat MySQL Data Transfer

Source Server         : homestead
Source Server Version : 50709
Source Host           : 127.0.0.1:33060
Source Database       : seuicgms

Target Server Type    : MYSQL
Target Server Version : 50709
File Encoding         : 65001

Date: 2016-09-08 12:12:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for datarules
-- ----------------------------
DROP TABLE IF EXISTS `datarules`;
CREATE TABLE `datarules` (
  `role_id` int(11) NOT NULL,
  `rules` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of datarules
-- ----------------------------
INSERT INTO `datarules` VALUES ('1', '{\"depart\":{\"column\":\"id\",\"where\":\"in\",\"rule\":[1,2,3,6,7,9,8,10,4,5]}}');
INSERT INTO `datarules` VALUES ('2', '{\"depart\":{\"column\":\"id\",\"where\":\"in\",\"rule\":[1,2,3,6,7,9,8,10,4,5]}}');

-- ----------------------------
-- Table structure for departments
-- ----------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pid` tinyint(1) NOT NULL,
  `path` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort` tinyint(1) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of departments
-- ----------------------------
INSERT INTO `departments` VALUES ('1', '江苏东大集成', '江苏东大集成', '0', '0,1', '0', '1');
INSERT INTO `departments` VALUES ('2', '金融与通信事业部', '金融与通信事业部', '1', '0,1,2', '0', '1');
INSERT INTO `departments` VALUES ('3', '研发部', '研发部', '2', '0,1,2,3', '0', '1');
INSERT INTO `departments` VALUES ('4', '市场部', '市场部', '2', '0,1,2,4', '0', '1');
INSERT INTO `departments` VALUES ('5', '客服部', '客服部', '2', '0,1,2,5', '0', '1');
INSERT INTO `departments` VALUES ('6', '产品管理部', '产品管理部', '3', '0,1,2,3,6', '0', '1');
INSERT INTO `departments` VALUES ('7', '系统研发部', '系统研发部', '3', '0,1,2,3,7', '0', '1');
INSERT INTO `departments` VALUES ('8', '产品研发部', '产品研发部', '3', '0,1,2,3,8', '0', '1');
INSERT INTO `departments` VALUES ('9', '前端组', '前端组', '7', '0,1,2,3,7,9', '0', '1');
INSERT INTO `departments` VALUES ('10', '硬件组', '硬件组', '8', '0,1,2,3,8,10', '0', '1');
INSERT INTO `departments` VALUES ('11', '新建的测试部门', '新建的测试部门', '1', '0,1,11', '0', '0');

-- ----------------------------
-- Table structure for files
-- ----------------------------
DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `original_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `save_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `save_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `md5` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sha1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `url` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of files
-- ----------------------------
INSERT INTO `files` VALUES ('4', 'DJOTAMS功能需求说明.doc', 'e9777c3acca7b9b3c06ab12b613472bbec7935b2.doc', '2016-09-02/47e1956ecc6f5d4d73f34a09a4d16b5e961ab1af/e9777c3acca7b9b3c06ab12b613472bbec7935b2.doc', 'doc', 'application/msword', '244736', '8b9c04f337e1f8f29af6547e9e747376', '3fb42b9a57ca29d21de99aea6268d0edeba68503', '1', '2016-09-05 09:06:29', '2016-09-05 09:06:29', 'uploads/2016-09-02/47e1956ecc6f5d4d73f34a09a4d16b5e961ab1af/e9777c3acca7b9b3c06ab12b613472bbec7935b2.doc');
INSERT INTO `files` VALUES ('7', 'laravel优化v1.0.2.docx', '571d43fd55caa2633f6b076795ad74970100e3a8.docx', '2016-09-02/47e1956ecc6f5d4d73f34a09a4d16b5e961ab1af/571d43fd55caa2633f6b076795ad74970100e3a8.docx', 'docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '138334', 'fbb4b2f958e903a95ed70007b5234b13', '9601344b9414432937bc34cb7dc881591225865d', '1', '2016-09-08 08:59:56', '2016-09-08 08:59:56', 'uploads/2016-09-02/47e1956ecc6f5d4d73f34a09a4d16b5e961ab1af/571d43fd55caa2633f6b076795ad74970100e3a8.docx');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2016_06_08_151154_entrust_setup_tables', '1');
INSERT INTO `migrations` VALUES ('2016_07_08_101128_create_files_table', '1');
INSERT INTO `migrations` VALUES ('2016_09_01_160342_create_datarules_table', '1');
INSERT INTO `migrations` VALUES ('2016_09_01_160342_create_departments_table', '1');

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
INSERT INTO `permission_role` VALUES ('1', '1');
INSERT INTO `permission_role` VALUES ('2', '1');
INSERT INTO `permission_role` VALUES ('3', '1');
INSERT INTO `permission_role` VALUES ('4', '1');
INSERT INTO `permission_role` VALUES ('5', '1');
INSERT INTO `permission_role` VALUES ('6', '1');
INSERT INTO `permission_role` VALUES ('7', '1');
INSERT INTO `permission_role` VALUES ('8', '1');
INSERT INTO `permission_role` VALUES ('9', '1');
INSERT INTO `permission_role` VALUES ('14', '1');
INSERT INTO `permission_role` VALUES ('15', '1');
INSERT INTO `permission_role` VALUES ('16', '1');
INSERT INTO `permission_role` VALUES ('17', '1');
INSERT INTO `permission_role` VALUES ('18', '1');
INSERT INTO `permission_role` VALUES ('19', '1');
INSERT INTO `permission_role` VALUES ('20', '1');
INSERT INTO `permission_role` VALUES ('21', '1');
INSERT INTO `permission_role` VALUES ('22', '1');
INSERT INTO `permission_role` VALUES ('23', '1');
INSERT INTO `permission_role` VALUES ('24', '1');
INSERT INTO `permission_role` VALUES ('25', '1');
INSERT INTO `permission_role` VALUES ('26', '1');
INSERT INTO `permission_role` VALUES ('27', '1');
INSERT INTO `permission_role` VALUES ('28', '1');
INSERT INTO `permission_role` VALUES ('29', '1');
INSERT INTO `permission_role` VALUES ('30', '1');
INSERT INTO `permission_role` VALUES ('31', '1');
INSERT INTO `permission_role` VALUES ('32', '1');
INSERT INTO `permission_role` VALUES ('33', '1');
INSERT INTO `permission_role` VALUES ('34', '1');
INSERT INTO `permission_role` VALUES ('35', '1');
INSERT INTO `permission_role` VALUES ('36', '1');
INSERT INTO `permission_role` VALUES ('37', '1');
INSERT INTO `permission_role` VALUES ('38', '1');
INSERT INTO `permission_role` VALUES ('1', '2');
INSERT INTO `permission_role` VALUES ('2', '2');
INSERT INTO `permission_role` VALUES ('3', '2');
INSERT INTO `permission_role` VALUES ('4', '2');
INSERT INTO `permission_role` VALUES ('5', '2');
INSERT INTO `permission_role` VALUES ('6', '2');
INSERT INTO `permission_role` VALUES ('7', '2');
INSERT INTO `permission_role` VALUES ('8', '2');
INSERT INTO `permission_role` VALUES ('9', '2');
INSERT INTO `permission_role` VALUES ('14', '2');
INSERT INTO `permission_role` VALUES ('15', '2');
INSERT INTO `permission_role` VALUES ('16', '2');
INSERT INTO `permission_role` VALUES ('17', '2');
INSERT INTO `permission_role` VALUES ('18', '2');
INSERT INTO `permission_role` VALUES ('19', '2');
INSERT INTO `permission_role` VALUES ('20', '2');
INSERT INTO `permission_role` VALUES ('21', '2');
INSERT INTO `permission_role` VALUES ('22', '2');
INSERT INTO `permission_role` VALUES ('23', '2');
INSERT INTO `permission_role` VALUES ('24', '2');
INSERT INTO `permission_role` VALUES ('25', '2');
INSERT INTO `permission_role` VALUES ('26', '2');
INSERT INTO `permission_role` VALUES ('27', '2');
INSERT INTO `permission_role` VALUES ('28', '2');
INSERT INTO `permission_role` VALUES ('29', '2');
INSERT INTO `permission_role` VALUES ('30', '2');
INSERT INTO `permission_role` VALUES ('31', '2');
INSERT INTO `permission_role` VALUES ('32', '2');
INSERT INTO `permission_role` VALUES ('33', '2');
INSERT INTO `permission_role` VALUES ('34', '2');
INSERT INTO `permission_role` VALUES ('35', '2');
INSERT INTO `permission_role` VALUES ('36', '2');
INSERT INTO `permission_role` VALUES ('37', '2');
INSERT INTO `permission_role` VALUES ('38', '2');
INSERT INTO `permission_role` VALUES ('1', '3');
INSERT INTO `permission_role` VALUES ('2', '3');
INSERT INTO `permission_role` VALUES ('5', '3');
INSERT INTO `permission_role` VALUES ('14', '3');
INSERT INTO `permission_role` VALUES ('15', '3');
INSERT INTO `permission_role` VALUES ('16', '3');

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `icon` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_menu` tinyint(1) NOT NULL DEFAULT '0',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `sort` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('1', '0', '', 'system', 'backend.index.index', '后台首页', 'backend.index.index', '0', '后台首页', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('2', '0', 'fa fa-desktop', 'system', 'system', '系统管理', 'system', '1', '系统管理', '1', '1', '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('3', '0', 'fa fa-users', 'system', '#', '组织管理', '#', '1', '组织管理', '1', '2', '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('4', '2', 'fa fa-info', 'log', 'log-viewer::logs.list', '日志管理', 'log-viewer::logs.list', '1', '日志管理', '1', '12', '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('5', '2', 'fa fa-file', 'file', 'backend.file.index', '文件管理', 'backend.file.index', '1', '文件管理', '1', '13', '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('6', '3', 'fa fa-user', 'user', 'backend.user.index', '用户管理', 'backend.user.index', '1', '用户管理', '1', '21', '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('7', '3', ' fa fa-sitemap', 'depart', 'backend.depart.index', '部门管理', 'backend.depart.index', '1', '部门管理', '1', '22', '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('8', '3', 'fa fa-user-secret', 'role', 'backend.role.index', '角色管理', 'backend.role.index', '1', '角色管理', '1', '23', '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('9', '3', 'fa fa-keyboard-o', 'permission', 'backend.permission.index', '权限管理', 'backend.permission.index', '1', '权限管理', '1', '24', '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('10', '4', '', 'log', 'log.showByLevel', '日志等级', 'Arcanedev\\LogViewer\\Http\\Controllers\\LogViewerController@showByLevel', '0', '日志等级', '0', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('11', '4', '', 'log', 'log.show', '显示日志', 'Arcanedev\\LogViewer\\Http\\Controllers\\LogViewerController@show', '0', '显示日志', '0', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('12', '4', '', 'log', 'log.download', '下载日志', 'Arcanedev\\LogViewer\\Http\\Controllers\\LogViewerController@download', '0', '下载日志', '0', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('13', '4', '', 'log', 'log.delete', '删除日志', 'Arcanedev\\LogViewer\\Http\\Controllers\\LogViewerController@delete', '0', '删除日志', '0', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('14', '5', '', 'file', 'backend.file.upload', '文件上传', 'backend.file.upload', '0', '文件上传', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('15', '5', '', 'file', 'backend.file.download', '文件下载', 'backend.file.download', '0', '文件下载', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('16', '5', '', 'file', 'backend.file.destroy', '删除文件', 'backend.file.destroy', '0', '删除文件', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('17', '6', '', 'user', 'backend.user.create', '新建用户信息', 'backend.user.create', '0', '新建用户信息', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('18', '6', '', 'user', 'backend.user.store', '保存用户信息', 'backend.user.store', '0', '保存用户信息', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('19', '6', '', 'user', 'backend.user.edit', '编辑用户信息', 'backend.user.edit', '0', '编辑用户信息', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('20', '6', '', 'user', 'backend.user.update', '修改用户信息', 'backend.user.update', '0', '修改用户信息', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('21', '6', '', 'user', 'backend.user.destroy', '删除用户信息', 'backend.user.destroy', '0', '删除用户信息', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('22', '6', '', 'user', 'backend.user.search', '搜索用户信息', 'backend.user.search', '0', '搜索用户信息', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('23', '7', '', 'depart', 'backend.depart.store', '保存部门信息', 'backend.depart.store', '0', '保存部门信息', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('24', '7', '', 'depart', 'backend.depart.edit', '编辑部门信息', 'backend.depart.edit', '0', '编辑部门信息', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('25', '7', '', 'depart', 'backend.depart.update', '更新部门信息', 'backend.depart.update', '0', '更新部门信息', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('26', '7', '', 'depart', 'backend.depart.destroy', '删除部门信息', 'backend.depart.destroy', '0', '删除部门信息', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('27', '8', '', 'role', 'backend.role.edit', '编辑角色', 'backend.role.edit', '0', '编辑角色', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('28', '8', '', 'role', 'backend.role.store', '保存角色', 'backend.role.store', '0', '保存角色', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('29', '8', '', 'role', 'backend.role.update', '修改角色', 'backend.role.update', '0', '修改角色', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('30', '8', '', 'role', 'backend.role.destroy', '删除角色', 'backend.role.destroy', '0', '删除角色', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('31', '8', '', 'role', 'backend.role.permission', '操作权限列表', 'backend.role.permission', '0', '操作权限列表', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('32', '8', '', 'role', 'backend.role.associate.permission', '关联操作权限', 'backend.role.associate.permission', '0', '关联操作权限', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('33', '8', '', 'role', 'backend.role.datarule', '数据权限列表', 'backend.role.datarule', '0', '数据权限列表', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('34', '8', '', 'role', 'backend.role.associate.datarule', '关联数据权限', 'backend.role.associate.datarule', '0', '关联数据权限', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('35', '9', '', 'permission', 'backend.permission.edit', '编辑权限', 'backend.permission.edit', '0', '权限关联操作', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('36', '9', '', 'permission', 'backend.permission.store', '保存权限', 'backend.permission.store', '0', '保存权限', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('37', '9', '', 'permission', 'backend.permission.update', '修改权限', 'backend.permission.update', '0', '修改权限', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');
INSERT INTO `permissions` VALUES ('38', '9', '', 'permission', 'backend.permission.destroy', '删除权限', 'backend.permission.destroy', '0', '删除权限', '1', null, '1970-01-01 00:00:01', '1970-01-01 00:00:01');

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES ('3', '1');
INSERT INTO `role_user` VALUES ('5', '2');
INSERT INTO `role_user` VALUES ('6', '2');
INSERT INTO `role_user` VALUES ('7', '2');
INSERT INTO `role_user` VALUES ('8', '2');
INSERT INTO `role_user` VALUES ('9', '2');
INSERT INTO `role_user` VALUES ('10', '2');
INSERT INTO `role_user` VALUES ('10', '3');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'superadmin', '超级管理员', '拥有所有的权限', '2016-06-08 16:00:58', '2016-08-23 15:38:19');
INSERT INTO `roles` VALUES ('2', 'normaladmin', '普通管理员', '拥有绝大多数的权限', '2016-06-08 16:01:02', '2016-06-12 16:12:21');
INSERT INTO `roles` VALUES ('3', 'tourist', '游客', '游客', '2016-06-20 13:40:03', '2016-06-20 13:40:03');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `is_super_admin` tinyint(1) NOT NULL,
  `dep_id` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastlogintime` datetime DEFAULT NULL,
  `lastloginip` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `depart` (`dep_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('3', 'Admin', 'admin@qq.com', '$2y$10$.DjKQiKxfvN.g2raBEIJqu7VAGa9rTKzBqQPb6eoFf9jIOX3OrOhO', '1', '2', 'wcrTdOnMk7zYmumHzE5rBqN7VhQ8ExudiXnoCn4asShiMm6kfaLkLH67LUlX', '2016-09-08 08:58:38', '192.168.200.1', '2016-05-19 09:52:51', '2016-09-06 10:53:55');
INSERT INTO `users` VALUES ('5', 'mjk', 'mjk@qq.com', '$2y$10$hzSNJz2lZ.mAAXgHfr/Q5.Uoiz9wTjZLhjEx6j7Lf0GMDL4Lfl/de', '0', '2', '', '2016-09-02 12:45:43', '192.168.200.1', '2016-08-08 13:18:32', '2016-08-31 15:46:24');
INSERT INTO `users` VALUES ('6', 'test1', 'test1@qq.com', '$2y$10$luyNHacVc0q6PB9D68qdyOI4BOTCVdHaiaZroJQChECR9HTAlHmUq', '0', '6', null, null, null, '2016-09-08 09:01:10', '2016-09-08 09:01:10');
INSERT INTO `users` VALUES ('7', '1', '10307440@qq.com', '$2y$10$JZHpx/mVwVYzO9xVoTTMkOmPx./QsNom6sZSwuJNErX6PWGwD2B0C', '0', '7', null, null, null, '2016-09-08 09:09:30', '2016-09-08 09:09:30');
INSERT INTO `users` VALUES ('8', '1', '1@qq.com', '$2y$10$8oL0gVFh.Q2ACIIZbCiV8eOCAJwUl00qgpjElAJjO0qftJZhwiKny', '0', '8', null, null, null, '2016-09-08 09:13:37', '2016-09-08 09:13:37');
INSERT INTO `users` VALUES ('9', 'winner', '2@qq.com', '$2y$10$fZK8r4Je6kb.4KUuKAWPRONk/lSjAg3MrwgTNAR0MHNWK2sc1CLV.', '0', '3', null, null, null, '2016-09-08 09:23:39', '2016-09-08 09:23:39');
INSERT INTO `users` VALUES ('10', '11', '111@qq.com', '$2y$10$VAzCz7G0bjvb3AgoZNvLU.44eoKeMAC8uRsAOXJJjnrkpQr202tVm', '0', '4', null, null, null, '2016-09-08 09:35:53', '2016-09-08 09:54:48');
