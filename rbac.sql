-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: role
-- ------------------------------------------------------
-- Server version	5.7.21-1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `t_dept`
--

DROP TABLE IF EXISTS `t_dept`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_dept` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '部门ID',
  `parent_id` bigint(20) NOT NULL COMMENT '上级部门ID',
  `dept_name` varchar(100) NOT NULL COMMENT '部门名称',
  `order_num` double(20,0) DEFAULT NULL COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_dept`
--

LOCK TABLES `t_dept` WRITE;
/*!40000 ALTER TABLE `t_dept` DISABLE KEYS */;
INSERT INTO `t_dept` VALUES (1,0,'开发部',1,'2019-06-14 12:56:41',NULL),(2,1,'开发一部',1,'2019-06-14 12:58:46',NULL),(3,1,'开发二部',2,'2019-06-14 12:58:56',NULL),(4,0,'采购部',2,'2019-06-14 12:59:56',NULL),(5,0,'财务部',3,'2019-06-14 13:00:08',NULL),(6,0,'销售部',4,'2019-06-14 13:00:15',NULL),(7,0,'工程部',5,'2019-06-14 13:00:42',NULL),(8,0,'行政部',6,'2019-06-14 13:00:49',NULL),(9,0,'人力资源部',8,'2019-06-14 13:01:14','2019-06-14 13:01:34'),(10,0,'系统部',7,'2019-06-14 13:01:31',NULL);
/*!40000 ALTER TABLE `t_dept` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_log`
--

DROP TABLE IF EXISTS `t_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '日志ID',
  `username` varchar(50) DEFAULT NULL COMMENT '操作用户',
  `operation` text COMMENT '操作内容',
  `time` decimal(11,0) DEFAULT NULL COMMENT '耗时',
  `method` text COMMENT '操作方法',
  `params` text COMMENT '方法参数',
  `ip` varchar(64) DEFAULT NULL COMMENT '操作者IP',
  `location` varchar(50) DEFAULT NULL COMMENT '操作地点',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1940 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `t_login_log`
--

DROP TABLE IF EXISTS `t_login_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_login_log` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL COMMENT '用户名',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL COMMENT '登录地点',
  `ip` varchar(100) DEFAULT NULL COMMENT 'IP地址',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `t_menu`
--

DROP TABLE IF EXISTS `t_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_menu` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '菜单/按钮ID',
  `parent_id` bigint(20) NOT NULL COMMENT '上级菜单ID',
  `menu_name` varchar(50) NOT NULL COMMENT '菜单/按钮名称',
  `name` varchar(50) DEFAULT NULL COMMENT '对应组件name',
  `path` varchar(255) DEFAULT NULL COMMENT '对应路由path',
  `component` varchar(255) DEFAULT NULL COMMENT '对应路由组件component',
  `perms` varchar(50) DEFAULT NULL COMMENT '权限标识',
  `icon` varchar(50) DEFAULT NULL COMMENT '图标',
  `type` char(2) NOT NULL COMMENT '类型 0菜单 1按钮',
  `sort` double(20,0) DEFAULT NULL COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_menu`
--

LOCK TABLES `t_menu` WRITE;
/*!40000 ALTER TABLE `t_menu` DISABLE KEYS */;
INSERT INTO `t_menu` VALUES (1,0,'系统管理','system','/system','PageView',NULL,'cogs','0',1,'2017-12-27 08:39:07','2019-10-31 02:52:23'),(2,0,'系统监控','monitor','/monitor','PageView',NULL,'dashboard','0',2,'2017-12-27 08:45:51','2019-10-31 03:27:30'),(3,1,'用户管理','UserPage','/system/user','system/user','user:view','user','0',1,'2017-12-27 08:47:13','2019-10-31 02:53:04'),(4,1,'角色管理','RolePage','/system/role','system/role','role:view','group','0',2,'2017-12-27 08:48:09','2019-10-31 02:51:17'),(5,1,'菜单管理','MenuPage','/system/menu','system/menu','menu:view','list-ul','0',3,'2017-12-27 08:48:57','2019-10-31 02:50:39'),(6,1,'部门管理',NULL,'/system/dept','system/dept','dept:view','address-book','0',4,'2017-12-27 08:57:33','2019-10-27 14:41:39'),(10,2,'系统日志',NULL,'/monitor/systemlog','monitor/system-log','log:view','clock-o','0',2,'2017-12-27 09:00:50','2019-10-29 13:06:52'),(11,3,'新增用户',NULL,'','','user:add',NULL,'1',NULL,'2017-12-27 09:02:58',NULL),(12,3,'修改用户',NULL,'','','user:update',NULL,'1',NULL,'2017-12-27 09:04:07',NULL),(13,3,'删除用户',NULL,'','','user:delete',NULL,'1',NULL,'2017-12-27 09:04:58',NULL),(14,4,'新增角色',NULL,'','','role:add',NULL,'1',NULL,'2017-12-27 09:06:38',NULL),(15,4,'修改角色',NULL,'','','role:update',NULL,'1',NULL,'2017-12-27 09:06:38',NULL),(16,4,'删除角色',NULL,'','','role:delete',NULL,'1',NULL,'2017-12-27 09:06:38',NULL),(17,5,'新增菜单',NULL,'','','menu:add',NULL,'1',NULL,'2017-12-27 09:08:02',NULL),(18,5,'修改菜单',NULL,'','','menu:update',NULL,'1',NULL,'2017-12-27 09:08:02',NULL),(19,5,'删除菜单',NULL,'','','menu:delete',NULL,'1',NULL,'2017-12-27 09:08:02',NULL),(20,6,'新增部门',NULL,'','','dept:add',NULL,'1',NULL,'2017-12-27 09:09:24',NULL),(21,6,'修改部门',NULL,'','','dept:update',NULL,'1',NULL,'2017-12-27 09:09:24',NULL),(22,6,'删除部门',NULL,'','','dept:delete',NULL,'1',NULL,'2017-12-27 09:09:24',NULL),(24,10,'删除日志',NULL,'','','log:delete',NULL,'1',NULL,'2017-12-27 09:11:45',NULL),(122,2,'系统信息',NULL,'/monitor/system','EmptyPageView',NULL,'cogs','0',5,'2019-01-17 18:31:48','2019-10-29 13:08:07'),(127,122,'服务器信息','Info','/monitor/system/info','monitor/system-info',NULL,'info-circle','0',3,'2019-01-20 23:53:43','2019-11-08 15:03:43'),(132,5,'导出Excel',NULL,NULL,NULL,'menu:export',NULL,'1',NULL,'2019-01-22 22:36:05',NULL),(133,6,'导出Excel',NULL,NULL,NULL,'dept:export',NULL,'1',NULL,'2019-01-22 22:36:25',NULL),(135,3,'密码重置',NULL,NULL,NULL,'user:reset',NULL,'1',NULL,'2019-01-22 22:37:00',NULL),(146,2,'Redis监控',NULL,'/monitor/redisInfo','monitor/redis-info','','line-chart','0',2,'2019-10-29 09:37:09','2019-10-29 12:15:01'),(148,4,'新增用户角色',NULL,NULL,NULL,'user:role:add',NULL,'1',0,'2019-10-30 10:13:24','2019-10-30 10:13:24'),(149,4,'删除用户角色',NULL,NULL,NULL,'user:role:delete',NULL,'1',0,'2019-10-30 10:14:15','2019-10-30 10:14:15'),(150,4,'新增角色菜单',NULL,NULL,NULL,'role:menu:add',NULL,'1',0,'2019-10-30 10:14:51','2019-10-30 10:15:03'),(151,4,'删除角色菜单',NULL,NULL,NULL,'role:menu:delete',NULL,'1',0,'2019-10-30 10:15:47','2019-10-30 10:15:47'),(152,4,'角色用户列表',NULL,NULL,NULL,'role:user:view',NULL,'1',0,'2019-10-30 10:17:21','2019-10-30 10:17:40'),(153,4,'角色菜单列表',NULL,NULL,NULL,'role:menu:view',NULL,'1',0,'2019-10-30 10:35:39','2019-10-30 10:35:39'),(154,2,'登录日志','LoginLog','/monitor/loginLog','monitor/login-log','loginlog:view','clock-o','0',3,'2019-10-31 13:11:08','2019-11-01 02:37:47'),(155,154,'删除登录日志',NULL,NULL,NULL,'loginlog:delete',NULL,'1',0,'2019-11-01 02:38:20','2019-11-01 02:38:20');
/*!40000 ALTER TABLE `t_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_role`
--

DROP TABLE IF EXISTS `t_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_role` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `name` varchar(10) NOT NULL COMMENT '角色名称',
  `remark` varchar(100) DEFAULT NULL COMMENT '角色描述',
  `perms` varchar(50) DEFAULT NULL COMMENT '权限标识',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_role`
--

LOCK TABLES `t_role` WRITE;
/*!40000 ALTER TABLE `t_role` DISABLE KEYS */;
INSERT INTO `t_role` VALUES (1,'管理员','管理员','manage','2017-12-27 08:23:11','2019-01-22 22:45:29'),(2,'注册用户','可查看，新增，导出','check','2019-01-04 06:11:28','2019-01-22 23:37:08'),(72,'普通用户','只可查看，好可怜哦！','look','2019-01-22 23:33:20','2019-10-27 09:16:02');
/*!40000 ALTER TABLE `t_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_role_menu`
--

DROP TABLE IF EXISTS `t_role_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_role_menu` (
  `role_id` bigint(20) NOT NULL,
  `menu_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_role_menu`
--

LOCK TABLES `t_role_menu` WRITE;
/*!40000 ALTER TABLE `t_role_menu` DISABLE KEYS */;
INSERT INTO `t_role_menu` VALUES (72,1),(72,4),(72,14),(72,15),(72,16),(72,2),(72,10),(72,24),(2,1),(2,3),(2,4),(2,14),(2,5),(2,17),(2,18),(2,19),(2,6),(2,2),(2,10),(2,122),(2,127),(1,1),(1,3),(1,11),(1,12),(1,13),(1,135),(1,4),(1,14),(1,15),(1,16),(1,148),(1,149),(1,150),(1,151),(1,152),(1,153),(1,5),(1,17),(1,18),(1,19),(1,132),(1,6),(1,20),(1,21),(1,22),(1,133),(1,2),(1,10),(1,24),(1,122),(1,127),(1,146),(1,154),(1,155);
/*!40000 ALTER TABLE `t_role_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_user`
--

DROP TABLE IF EXISTS `t_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_user` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `real_name` varchar(50) NOT NULL COMMENT '姓名',
  `password` varchar(128) NOT NULL COMMENT '密码',
  `dept_id` bigint(20) DEFAULT NULL COMMENT '部门ID',
  `email` varchar(128) DEFAULT NULL COMMENT '邮箱',
  `mobile` varchar(20) DEFAULT NULL COMMENT '联系电话',
  `status` char(1) NOT NULL COMMENT '状态 0锁定 1有效',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login_time` datetime DEFAULT NULL COMMENT '最近访问时间',
  `sex` char(1) DEFAULT NULL COMMENT '性别 0男 1女 2保密',
  `description` varchar(100) DEFAULT NULL COMMENT '描述',
  `avatar` varchar(100) DEFAULT NULL COMMENT '用户头像',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_user`
--

LOCK TABLES `t_user` WRITE;
/*!40000 ALTER TABLE `t_user` DISABLE KEYS */;
INSERT INTO `t_user` VALUES (1,'admin','admin','f531a91035f47e86018f9acffdec08d2',1,'1346233126@qq.com','13426389892','1','2017-12-27 07:47:19','2019-11-13 12:44:12','2019-11-13 20:44:12','2','我是帅比作者。','ubnKSIfAJTxIgXOKlciN.png'),(2,'scott','swoft','7b44a5363e3fd52435beb472e1d2b91f',6,'swoft@qq.com','13426389892','1','2017-12-29 08:16:39','2019-11-09 07:47:13','2019-10-30 18:44:11','0','我是swoft，嗯嗯','jZUIxmJycoymBprLOUbT.png'),(12,'jack','jack','552649f10640385d0728a80a4242893e',6,'jack@hotmail.com',NULL,'1','2019-01-22 23:34:05','2019-10-25 23:49:57','2019-10-26 07:49:57','0',NULL,'default.jpg'),(16,'test','test','94f860c4bbfeb2f49c84e321fdda4b07',6,'123@qq.com','13426389892','1','2019-10-25 01:47:30','2019-11-09 07:47:05','2019-10-31 07:39:59','0',NULL,NULL),(20,'test3','test3','94f860c4bbfeb2f49c84e321fdda4b07',6,'321234@qq.com','13426389892','1','2019-10-27 10:24:47','2019-11-09 07:46:56',NULL,'2',NULL,NULL);
/*!40000 ALTER TABLE `t_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_user_role`
--

DROP TABLE IF EXISTS `t_user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_user_role` (
  `user_id` bigint(20) NOT NULL COMMENT '用户ID',
  `role_id` bigint(20) NOT NULL COMMENT '角色ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_user_role`
--

LOCK TABLES `t_user_role` WRITE;
/*!40000 ALTER TABLE `t_user_role` DISABLE KEYS */;
INSERT INTO `t_user_role` VALUES (2,2),(12,72),(1,1);
/*!40000 ALTER TABLE `t_user_role` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-28 17:38:38
