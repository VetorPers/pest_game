# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 11.11.11.11 (MySQL 5.7.18-log)
# Database: pest
# Generation Time: 2019-08-17 11:30:32 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table admin_menu
# ------------------------------------------------------------

LOCK TABLES `admin_menu` WRITE;
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;

INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `permission`, `created_at`, `updated_at`)
VALUES
	(2,0,1,'Admin','fa-tasks','',NULL,NULL,'2019-08-14 11:03:29'),
	(3,2,2,'Users','fa-users','auth/users',NULL,NULL,'2019-08-14 11:03:29'),
	(4,2,3,'Roles','fa-user','auth/roles',NULL,NULL,'2019-08-14 11:03:29'),
	(5,2,4,'Permission','fa-ban','auth/permissions',NULL,NULL,'2019-08-14 11:03:29'),
	(6,2,5,'Menu','fa-bars','auth/menu',NULL,NULL,'2019-08-14 11:03:29'),
	(7,2,6,'Operation log','fa-history','auth/logs',NULL,NULL,'2019-08-14 11:03:29'),
	(8,0,8,'用户','fa-user-secret',NULL,NULL,'2019-08-13 18:04:27','2019-08-14 11:06:18'),
	(9,0,11,'题库','fa-credit-card',NULL,NULL,'2019-08-13 18:04:51','2019-08-14 11:06:18'),
	(10,9,13,'作答情况','fa-file-word-o','/records',NULL,'2019-08-13 18:25:17','2019-08-14 11:06:18'),
	(11,8,9,'用户列表','fa-user','/users',NULL,'2019-08-13 20:51:16','2019-08-14 11:06:18'),
	(12,9,12,'题目列表','fa-question-circle','/questions',NULL,'2019-08-13 20:52:51','2019-08-14 11:06:18'),
	(13,8,10,'班级列表','fa-graduation-cap','/grades',NULL,'2019-08-13 22:04:07','2019-08-14 11:06:18'),
	(15,0,7,'首页','fa-bar-chart','/charts',NULL,'2019-08-14 11:05:58','2019-08-14 11:06:18');

/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;
UNLOCK TABLES;




# Dump of table admin_permissions
# ------------------------------------------------------------

LOCK TABLES `admin_permissions` WRITE;
/*!40000 ALTER TABLE `admin_permissions` DISABLE KEYS */;

INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `created_at`, `updated_at`)
VALUES
	(1,'All permission','*','','*',NULL,NULL),
	(2,'Dashboard','dashboard','GET','/',NULL,NULL),
	(3,'Login','auth.login','','/auth/login\r\n/auth/logout',NULL,NULL),
	(4,'User setting','auth.setting','GET,PUT','/auth/setting',NULL,NULL),
	(5,'Auth management','auth.management','','/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs',NULL,NULL);

/*!40000 ALTER TABLE `admin_permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table admin_role_menu
# ------------------------------------------------------------

LOCK TABLES `admin_role_menu` WRITE;
/*!40000 ALTER TABLE `admin_role_menu` DISABLE KEYS */;

INSERT INTO `admin_role_menu` (`role_id`, `menu_id`, `created_at`, `updated_at`)
VALUES
	(1,2,NULL,NULL);

/*!40000 ALTER TABLE `admin_role_menu` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table admin_role_permissions
# ------------------------------------------------------------

LOCK TABLES `admin_role_permissions` WRITE;
/*!40000 ALTER TABLE `admin_role_permissions` DISABLE KEYS */;

INSERT INTO `admin_role_permissions` (`role_id`, `permission_id`, `created_at`, `updated_at`)
VALUES
	(1,1,NULL,NULL);

/*!40000 ALTER TABLE `admin_role_permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table admin_role_users
# ------------------------------------------------------------

LOCK TABLES `admin_role_users` WRITE;
/*!40000 ALTER TABLE `admin_role_users` DISABLE KEYS */;

INSERT INTO `admin_role_users` (`role_id`, `user_id`, `created_at`, `updated_at`)
VALUES
	(1,1,NULL,NULL);

/*!40000 ALTER TABLE `admin_role_users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table admin_roles
# ------------------------------------------------------------

LOCK TABLES `admin_roles` WRITE;
/*!40000 ALTER TABLE `admin_roles` DISABLE KEYS */;

INSERT INTO `admin_roles` (`id`, `name`, `slug`, `created_at`, `updated_at`)
VALUES
	(1,'Administrator','administrator','2019-08-13 18:03:29','2019-08-13 18:03:29');

/*!40000 ALTER TABLE `admin_roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table admin_user_permissions
# ------------------------------------------------------------



# Dump of table admin_users
# ------------------------------------------------------------

LOCK TABLES `admin_users` WRITE;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;

INSERT INTO `admin_users` (`id`, `username`, `password`, `name`, `avatar`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'admin','$2y$10$nHghNzb8kgntTQNFgIVgCuA3iHzBmt32kpxEppIWuuNrse4pcU8l.','Administrator',NULL,'Pdo3mKqcwPLulkwVjOTSlRAALePpnuSveoXdOKHNyGeNOuU66pl0taJ2dMds','2019-08-13 18:03:29','2019-08-13 18:03:29');

/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table answers
# ------------------------------------------------------------

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;

INSERT INTO `answers` (`id`, `question_id`, `title`, `img`, `is_right`, `created_at`, `updated_at`)
VALUES
	(1,1,'《金陵记》',NULL,1,'2019-08-13 17:52:03','2019-08-13 17:52:03'),
	(2,1,'《石头记》',NULL,0,'2019-08-13 17:52:03','2019-08-13 17:52:03'),
	(3,1,'《西厢记》',NULL,0,'2019-08-13 17:52:03','2019-08-13 17:52:03'),
	(4,1,'《紫钗记》',NULL,0,'2019-08-13 17:52:03','2019-08-13 17:52:03'),
	(5,2,'泰山',NULL,1,'2019-08-13 17:52:03','2019-08-13 17:52:03'),
	(6,2,'华山',NULL,1,'2019-08-13 17:52:03','2019-08-13 17:52:03'),
	(7,2,'嵩山',NULL,1,'2019-08-13 17:52:03','2019-08-13 17:52:03'),
	(8,2,'黄山',NULL,0,'2019-08-13 17:52:03','2019-08-13 17:52:03'),
	(9,3,'《金陵记》',NULL,1,'2019-08-13 20:39:09','2019-08-13 20:39:09'),
	(10,3,'《石头记》',NULL,0,'2019-08-13 20:39:09','2019-08-13 20:39:09'),
	(11,3,'《西厢记》',NULL,0,'2019-08-13 20:39:09','2019-08-13 20:39:09'),
	(12,3,'《紫钗记》',NULL,0,'2019-08-13 20:39:09','2019-08-13 20:39:09'),
	(13,4,'泰山',NULL,1,'2019-08-13 20:39:09','2019-08-13 20:39:09'),
	(14,4,'华山',NULL,1,'2019-08-13 20:39:09','2019-08-13 20:39:09'),
	(15,4,'嵩山',NULL,1,'2019-08-13 20:39:09','2019-08-13 20:39:09'),
	(16,4,'黄山',NULL,0,'2019-08-13 20:39:09','2019-08-13 20:39:09'),
	(17,7,'《金陵记》',NULL,1,'2019-08-13 22:13:46','2019-08-13 22:13:46'),
	(18,7,'《石头记》',NULL,0,'2019-08-13 22:13:46','2019-08-13 22:13:46'),
	(19,7,'《西厢记》',NULL,0,'2019-08-13 22:13:46','2019-08-13 22:13:46'),
	(20,7,'《紫钗记》',NULL,0,'2019-08-13 22:13:46','2019-08-13 22:13:46'),
	(21,8,'泰山',NULL,1,'2019-08-13 22:13:46','2019-08-13 22:13:46'),
	(22,8,'华山',NULL,1,'2019-08-13 22:13:46','2019-08-13 22:13:46'),
	(23,8,'嵩山',NULL,1,'2019-08-13 22:13:46','2019-08-13 22:13:46'),
	(24,8,'黄山',NULL,0,'2019-08-13 22:13:46','2019-08-13 22:13:46'),
	(25,9,'《金陵记》',NULL,1,'2019-08-15 22:53:40','2019-08-15 22:53:40'),
	(26,9,'《石头记》',NULL,0,'2019-08-15 22:53:40','2019-08-15 22:53:40'),
	(27,9,'《西厢记》',NULL,0,'2019-08-15 22:53:40','2019-08-15 22:53:40'),
	(28,9,'《紫钗记》',NULL,0,'2019-08-15 22:53:40','2019-08-15 22:53:40'),
	(29,10,'泰山',NULL,1,'2019-08-15 22:53:40','2019-08-15 22:53:40'),
	(30,10,'华山',NULL,1,'2019-08-15 22:53:40','2019-08-15 22:53:40'),
	(31,10,'嵩山',NULL,1,'2019-08-15 22:53:40','2019-08-15 22:53:40'),
	(32,10,'黄山',NULL,0,'2019-08-15 22:53:40','2019-08-15 22:53:40');

/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table grades
# ------------------------------------------------------------

LOCK TABLES `grades` WRITE;
/*!40000 ALTER TABLE `grades` DISABLE KEYS */;

INSERT INTO `grades` (`id`, `name`, `created_at`, `updated_at`)
VALUES
	(1,'一年级','2019-08-13 17:52:03','2019-08-13 17:52:03'),
	(2,'二年级','2019-08-13 17:52:03','2019-08-13 17:52:03'),
	(5,'五年级','2019-08-15 21:45:29','2019-08-15 21:45:29');

/*!40000 ALTER TABLE `grades` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2014_10_12_100000_create_password_resets_table',1),
	(3,'2016_01_04_173148_create_admin_tables',1),
	(4,'2019_06_02_060418_create_questions_table',1),
	(5,'2019_06_02_060848_create_answers_table',1),
	(6,'2019_06_02_061714_create_records_table',1),
	(7,'2019_06_02_061806_create_record_details_table',1),
	(8,'2019_08_13_173830_create_grades_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------



# Dump of table questions
# ------------------------------------------------------------

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;

INSERT INTO `questions` (`id`, `title`, `type`, `desc`, `img`, `level`, `created_at`, `updated_at`, `tree_sign`)
VALUES
	(1,'《红楼梦》是我国古代著名的长篇小说之一，它的别名是（）',1,'《红楼梦》，中国古典四大名著之首，清代作家曹雪芹创作的章回体长篇小说 ，又名《石头记》《金玉缘》',NULL,1,'2019-08-13 17:52:03','2019-08-13 17:52:03',1),
	(2,'我国有“三山五岳”之称，其中五岳包括以下哪座山？',2,'五岳指泰山、华山、衡山、嵩山、恒山',NULL,2,'2019-08-13 17:52:03','2019-08-13 17:52:03',1),
	(3,'《红楼梦》是我国古代著名的长篇小说之一，它的别名是（）',1,'《红楼梦》，中国古典四大名著之首，清代作家曹雪芹创作的章回体长篇小说 ，又名《石头记》《金玉缘》','2.jpg',1,'2019-08-13 20:39:09','2019-08-13 20:39:09',1),
	(4,'我国有“三山五岳”之称，其中五岳包括以下哪座山？',2,'五岳指泰山、华山、衡山、嵩山、恒山',NULL,2,'2019-08-13 20:39:09','2019-08-13 20:39:09',2),
	(7,'《红楼梦》是我国古代著名的长篇小说之一，它的别名是（）',1,'《红楼梦》，中国古典四大名著之首，清代作家曹雪芹创作的章回体长篇小说 ，又名《石头记》《金玉缘》','2.jpg',1,'2019-08-13 22:13:46','2019-08-13 22:13:46',1),
	(8,'我国有“三山五岳”之称，其中五岳包括以下哪座山？',2,'五岳指泰山、华山、衡山、嵩山、恒山',NULL,2,'2019-08-13 22:13:46','2019-08-13 22:13:46',2),
	(9,'《红楼梦》是我国古代著名的长篇小说之一，它的别名是（）',1,'《红楼梦》，中国古典四大名著之首，清代作家曹雪芹创作的章回体长篇小说 ，又名《石头记》《金玉缘》','2.jpg',1,'2019-08-15 22:53:40','2019-08-15 22:53:40',1),
	(10,'我国有“三山五岳”之称，其中五岳包括以下哪座山？',2,'五岳指泰山、华山、衡山、嵩山、恒山',NULL,2,'2019-08-15 22:53:40','2019-08-15 22:53:40',2);

/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table record_details
# ------------------------------------------------------------

LOCK TABLES `record_details` WRITE;
/*!40000 ALTER TABLE `record_details` DISABLE KEYS */;

INSERT INTO `record_details` (`id`, `record_id`, `user_id`, `question_id`, `answer_ids`, `created_at`, `updated_at`, `is_right`, `score`)
VALUES
	(1,1,1,1,'1','2019-08-13 18:14:56','2019-08-13 18:14:56',0,0),
	(2,1,1,2,'5;6','2019-08-13 18:14:56','2019-08-13 18:14:56',0,0),
	(3,2,1,1,'2','2019-08-13 18:14:56','2019-08-13 18:14:56',0,0),
	(4,2,1,2,'2','2019-08-13 18:14:56','2019-08-13 18:14:56',0,0);

/*!40000 ALTER TABLE `record_details` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table records
# ------------------------------------------------------------

LOCK TABLES `records` WRITE;
/*!40000 ALTER TABLE `records` DISABLE KEYS */;

INSERT INTO `records` (`id`, `user_id`, `score`, `created_at`, `updated_at`)
VALUES
	(1,1,80,'2019-08-13 18:14:56','2019-08-13 18:14:56'),
	(2,1,60,'2019-08-13 18:14:56','2019-08-13 18:14:56');

/*!40000 ALTER TABLE `records` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `number`, `grade_id`, `password`, `created_at`, `updated_at`)
VALUES
	(1,'vv','123','2','$2y$10$Aa2XmrCYh5esjqPjbmrNHOyUP2EfuIDARx024TSXhy3RYLsdPo5.G','2019-08-13 17:52:03','2019-08-13 18:14:56'),
	(5,'vtr','456','5','$2y$10$Aa2XmrCYh5esjqPjbmrNHOyUP2EfuIDARx024TSXhy3RYLsdPo5.G','2019-08-15 22:47:20','2019-08-15 22:47:20'),
	(7,'游客',NULL,NULL,'$2y$10$Aa2XmrCYh5esjqPjbmrNHOyUP2EfuIDARx024TSXhy3RYLsdPo5.G','2019-08-16 21:10:40','2019-08-16 21:10:40');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
