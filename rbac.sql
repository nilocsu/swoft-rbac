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
-- Dumping data for table `t_log`
--

LOCK TABLES `t_log` WRITE;
/*!40000 ALTER TABLE `t_log` DISABLE KEYS */;
INSERT INTO `t_log` VALUES (1842,'admin','新增菜单/按钮',0,'App\\Admin\\Controller\\MenuController->addMenu','{\"menuName\":\"test\",\"perms\":\"test\",\"parentId\":128,\"icon\":\"\",\"sort\":0,\"type\":1,\"path\":\"\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-28 13:44:58','2019-10-28 13:44:58'),(1843,'admin','删除菜单/按钮',0,'App\\Admin\\Controller\\MenuController->deleteMenus','{\"ids\":[143]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-28 13:47:22','2019-10-28 13:47:22'),(1844,'admin','新增菜单/按钮',25,'App\\Admin\\Controller\\MenuController->addMenu','{\"menuName\":\"test\",\"perms\":\"test\",\"parentId\":128,\"icon\":\"\",\"sort\":0,\"type\":1,\"path\":\"\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-28 13:51:09','2019-10-28 13:51:09'),(1845,'admin','新增菜单/按钮',54,'App\\Admin\\Controller\\MenuController->addMenu()','{\"menuName\":\"test1\",\"perms\":\"test:view1\",\"parentId\":128,\"icon\":\"\",\"sort\":0,\"type\":1,\"path\":\"\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-28 22:09:16','2019-10-28 22:09:16'),(1846,'admin','删除菜单/按钮',42,'App\\Admin\\Controller\\MenuController->deleteMenus()','{\"ids\":[113]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-28 22:54:31','2019-10-28 22:54:31'),(1847,'admin','删除菜单/按钮',98,'App\\Admin\\Controller\\MenuController->deleteMenus()','{\"ids\":[81,82,83]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-28 22:54:57','2019-10-28 22:54:57'),(1848,'admin','删除菜单/按钮',96,'App\\Admin\\Controller\\MenuController->deleteMenus()','{\"ids\":[101,109,110,138]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-28 22:55:09','2019-10-28 22:55:09'),(1849,'admin','删除菜单/按钮',13,'App\\Admin\\Controller\\MenuController->deleteMenus()','{\"ids\":[144]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-28 22:55:15','2019-10-28 22:55:15'),(1850,'admin','删除菜单/按钮',14,'App\\Admin\\Controller\\MenuController->deleteMenus()','{\"ids\":[145]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-28 22:55:17','2019-10-28 22:55:17'),(1851,'admin','删除系统日志',86,'App\\Admin\\Controller\\LogController->delete()','{\"ids\":[1839]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 06:05:21','2019-10-29 06:05:21'),(1852,'admin','删除系统日志',25,'App\\Admin\\Controller\\LogController->delete()','{\"ids\":[1840]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 06:06:00','2019-10-29 06:06:00'),(1853,'admin','删除系统日志',10,'App\\Admin\\Controller\\LogController->delete()','{\"ids\":[1841]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 06:06:22','2019-10-29 06:06:22'),(1854,'admin','新增菜单/按钮',283,'App\\Admin\\Controller\\MenuController->addMenu()','{\"menuName\":\"Redis\\u76d1\\u63a7\",\"path\":\"monitor\\/redisInfo\",\"component\":\"monitor\\/redis-info\",\"icon\":\"line-chart\",\"parentId\":2,\"sort\":3,\"type\":0,\"perms\":\"\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 09:37:09','2019-10-29 09:37:09'),(1855,'admin','修改菜单/按钮',24,'App\\Admin\\Controller\\MenuController->updateMenu()','{\"id\":146,\"parentId\":2,\"menuName\":\"Redis\\u76d1\\u63a7\",\"path\":\"monitor\\/redisInfo\",\"component\":\"monitor\\/redis-info\",\"perms\":\"\",\"icon\":\"line-chart\",\"type\":\"0\",\"sort\":\"2\",\"createdAt\":\"2019-10-29 17:37:09\",\"updatedAt\":\"2019-10-29 17:37:09\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 09:38:00','2019-10-29 09:38:00'),(1856,'admin','修改菜单/按钮',311,'App\\Admin\\Controller\\MenuController->updateMenu()','{\"id\":146,\"parentId\":2,\"menuName\":\"Redis\\u76d1\\u63a7\",\"path\":\"\\/monitor\\/redisInfo\",\"component\":\"monitor\\/redis-info\",\"perms\":\"\",\"icon\":\"line-chart\",\"type\":\"0\",\"sort\":2,\"createdAt\":\"2019-10-29 17:37:09\",\"updatedAt\":\"2019-10-29 17:38:00\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 12:15:01','2019-10-29 12:15:01'),(1857,'admin','删除菜单/按钮',420,'App\\Admin\\Controller\\MenuController->deleteMenus()','{\"ids\":[128,129]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 13:06:12','2019-10-29 13:06:12'),(1858,'admin','删除菜单/按钮',70,'App\\Admin\\Controller\\MenuController->deleteMenus()','{\"ids\":[136]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 13:06:26','2019-10-29 13:06:26'),(1859,'admin','修改菜单/按钮',8,'App\\Admin\\Controller\\MenuController->updateMenu()','{\"id\":10,\"parentId\":2,\"menuName\":\"\\u7cfb\\u7edf\\u65e5\\u5fd7\",\"path\":\"\\/monitor\\/systemlog\",\"component\":\"monitor\\/system-log\",\"perms\":\"log:view\",\"icon\":\"clock-o\",\"type\":\"0\",\"sort\":2,\"createdAt\":\"2017-12-27 17:00:50\",\"updatedAt\":\"2018-04-25 09:02:18\",\"children\":[{\"id\":24,\"parentId\":10,\"menuName\":\"\\u5220\\u9664\\u65e5\\u5fd7\",\"path\":\"\",\"component\":\"\",\"perms\":\"log:delete\",\"icon\":\"\",\"type\":\"1\",\"sort\":0,\"createdAt\":\"2017-12-27 17:11:45\",\"updatedAt\":\"\"}]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 13:06:52','2019-10-29 13:06:52'),(1860,'admin','修改菜单/按钮',12,'App\\Admin\\Controller\\MenuController->updateMenu()','{\"id\":122,\"parentId\":2,\"menuName\":\"\\u7cfb\\u7edf\\u4fe1\\u606f\",\"path\":\"\\/monitor\\/system\",\"component\":\"EmptyPageView\",\"perms\":\"\",\"icon\":\"cogs\",\"type\":\"0\",\"sort\":5,\"createdAt\":\"2019-01-18 02:31:48\",\"updatedAt\":\"2019-01-18 02:39:46\",\"children\":[{\"id\":127,\"parentId\":122,\"menuName\":\"\\u670d\\u52a1\\u5668\\u4fe1\\u606f\",\"path\":\"\\/monitor\\/system\\/info\",\"component\":\"monitor\\/SystemInfo\",\"perms\":\"\",\"icon\":\"\",\"type\":\"0\",\"sort\":3,\"createdAt\":\"2019-01-21 07:53:43\",\"updatedAt\":\"2019-01-21 07:57:00\"}]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 13:08:07','2019-10-29 13:08:07'),(1861,'admin','修改菜单/按钮',23,'App\\Admin\\Controller\\MenuController->updateMenu()','{\"id\":127,\"parentId\":122,\"menuName\":\"\\u670d\\u52a1\\u5668\\u4fe1\\u606f\",\"path\":\"\\/monitor\\/system\\/info\",\"component\":\"monitor\\/SystemInfo\",\"perms\":\"\",\"icon\":\"info-circle\",\"type\":\"0\",\"sort\":3,\"createdAt\":\"2019-01-21 07:53:43\",\"updatedAt\":\"2019-01-21 07:57:00\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 13:08:23','2019-10-29 13:08:23'),(1864,'admin','删除系统日志',22,'App\\Admin\\Controller\\LogController->delete()','{\"ids\":[1863]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 13:46:55','2019-10-29 13:46:55'),(1865,'admin','删除系统日志',14,'App\\Admin\\Controller\\LogController->delete()','{\"ids\":[1862]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 13:47:00','2019-10-29 13:47:00'),(1866,'admin','修改菜单/按钮',15,'App\\Admin\\Controller\\MenuController->updateMenu()','{\"id\":58,\"parentId\":0,\"menuName\":\"\\u7f51\\u7edc\\u8d44\\u6e90\",\"path\":\"\\/web\",\"component\":\"PageView\",\"perms\":\"\",\"icon\":\"internet-explorer\",\"type\":\"0\",\"sort\":4,\"createdAt\":\"2018-01-12 15:28:48\",\"updatedAt\":\"2018-01-22 19:49:26\",\"children\":null}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 13:52:32','2019-10-29 13:52:32'),(1867,'admin','新增菜单/按钮',30,'App\\Admin\\Controller\\MenuController->addMenu()','{\"menuName\":\"\\u540e\\u7aef\\u8def\\u7531\",\"path\":\"\\/monitor\\/route-trace\",\"component\":\"\\/monitor\\/route-trace\",\"icon\":\"calendar-minus-o\",\"parentId\":2,\"sort\":4,\"type\":0,\"perms\":\"\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 13:56:18','2019-10-29 13:56:18'),(1868,'admin','修改菜单/按钮',20,'App\\Admin\\Controller\\MenuController->updateMenu()','{\"id\":147,\"parentId\":2,\"menuName\":\"\\u540e\\u7aef\\u8def\\u7531\",\"path\":\"\\/monitor\\/route-trace\",\"component\":\"monitor\\/route-trace\",\"perms\":\"\",\"icon\":\"calendar-minus-o\",\"type\":\"0\",\"sort\":4,\"createdAt\":\"2019-10-29 21:56:18\",\"updatedAt\":\"2019-10-29 21:56:18\",\"children\":null}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 14:05:05','2019-10-29 14:05:05'),(1869,'admin','修改菜单/按钮',12,'App\\Admin\\Controller\\MenuController->updateMenu()','{\"id\":147,\"parentId\":2,\"menuName\":\"\\u540e\\u7aef\\u8def\\u7531\",\"path\":\"\\/monitor\\/routeTrace\",\"component\":\"monitor\\/route-trace\",\"perms\":\"\",\"icon\":\"calendar-minus-o\",\"type\":\"0\",\"sort\":4,\"createdAt\":\"2019-10-29 21:56:18\",\"updatedAt\":\"2019-10-29 22:05:05\",\"children\":null}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 14:09:35','2019-10-29 14:09:35'),(1870,'admin','修改菜单/按钮',27,'App\\Admin\\Controller\\MenuController->updateMenu()','{\"id\":147,\"parentId\":2,\"menuName\":\"\\u7cfb\\u7edf\\u8def\\u7531\",\"path\":\"\\/monitor\\/routeTrace\",\"component\":\"monitor\\/route-trace\",\"perms\":\"\",\"icon\":\"calendar-minus-o\",\"type\":\"0\",\"sort\":4,\"createdAt\":\"2019-10-29 21:56:18\",\"updatedAt\":\"2019-10-29 22:09:35\",\"children\":null}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 14:22:02','2019-10-29 14:22:02'),(1871,'admin','获取路由',1,'App\\Admin\\Common\\Controller\\RouteController->httpRoutes()','[]','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 14:23:40','2019-10-29 14:23:40'),(1872,'admin','获取路由',9,'App\\Admin\\Common\\Controller\\RouteController->httpRoutes()','[]','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 14:24:04','2019-10-29 14:24:04'),(1873,'admin','获取路由',4,'App\\Admin\\Common\\Controller\\RouteController->httpRoutes()','[]','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 14:24:22','2019-10-29 14:24:22'),(1874,'admin','获取路由',9,'App\\Admin\\Common\\Controller\\RouteController->httpRoutes()','[]','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 14:26:17','2019-10-29 14:26:17'),(1875,'admin','获取路由',3,'App\\Admin\\Common\\Controller\\RouteController->httpRoutes()','[]','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 14:26:46','2019-10-29 14:26:46'),(1876,'admin','获取路由',7,'App\\Admin\\Common\\Controller\\RouteController->httpRoutes()','[]','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 14:30:04','2019-10-29 14:30:04'),(1877,'admin','获取路由',3,'App\\Admin\\Common\\Controller\\RouteController->httpRoutes()','[]','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 14:30:53','2019-10-29 14:30:53'),(1878,'admin','获取路由',4,'App\\Admin\\Common\\Controller\\RouteController->httpRoutes()','[]','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 14:32:59','2019-10-29 14:32:59'),(1879,'admin','获取路由',6,'App\\Admin\\Common\\Controller\\RouteController->httpRoutes()','[]','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-29 14:34:07','2019-10-29 14:34:07'),(1880,'admin','获取路由',33,'App\\Admin\\Common\\Controller\\RouteController->httpRoutes()','[]','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-30 02:01:55','2019-10-30 02:01:55'),(1881,'admin','删除菜单/按钮',37,'App\\Admin\\Controller\\MenuController->deleteMenus()','{\"ids\":[131]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-30 10:11:23','2019-10-30 10:11:23'),(1882,'admin','新增菜单/按钮',20,'App\\Admin\\Controller\\MenuController->addMenu()','{\"menuName\":\"\\u65b0\\u589e\\u7528\\u6237\\u89d2\\u8272\",\"perms\":\"user:role:add\",\"parentId\":4,\"icon\":\"\",\"sort\":0,\"type\":1,\"path\":\"\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-30 10:13:24','2019-10-30 10:13:24'),(1883,'admin','新增菜单/按钮',18,'App\\Admin\\Controller\\MenuController->addMenu()','{\"menuName\":\"\\u5220\\u9664\\u7528\\u6237\\u89d2\\u8272\",\"perms\":\"user:role:delete\",\"parentId\":4,\"icon\":\"\",\"sort\":0,\"type\":1,\"path\":\"\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-30 10:14:15','2019-10-30 10:14:15'),(1884,'admin','新增菜单/按钮',12,'App\\Admin\\Controller\\MenuController->addMenu()','{\"menuName\":\"\\u65b0\\u589e\\u89d2\\u8272\\u83dc\\u5355\",\"perms\":\"role:menu:add\",\"parentId\":3,\"icon\":\"\",\"sort\":0,\"type\":1,\"path\":\"\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-30 10:14:51','2019-10-30 10:14:51'),(1885,'admin','删除菜单/按钮',25,'App\\Admin\\Controller\\MenuController->deleteMenus()','{\"ids\":[130]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-30 10:14:57','2019-10-30 10:14:57'),(1886,'admin','修改菜单/按钮',13,'App\\Admin\\Controller\\MenuController->updateMenu()','{\"id\":150,\"parentId\":4,\"menuName\":\"\\u65b0\\u589e\\u89d2\\u8272\\u83dc\\u5355\",\"path\":\"\",\"component\":\"\",\"perms\":\"role:menu:add\",\"icon\":\"\",\"type\":\"1\",\"sort\":0,\"createdAt\":\"2019-10-30 18:14:51\",\"updatedAt\":\"2019-10-30 18:14:51\",\"children\":null}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-30 10:15:03','2019-10-30 10:15:03'),(1887,'admin','新增菜单/按钮',19,'App\\Admin\\Controller\\MenuController->addMenu()','{\"menuName\":\"\\u5220\\u9664\\u89d2\\u8272\\u83dc\\u5355\",\"perms\":\"role:menu:delete\",\"parentId\":4,\"icon\":\"\",\"sort\":0,\"type\":1,\"path\":\"\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-30 10:15:47','2019-10-30 10:15:47'),(1888,'admin','新增菜单/按钮',12,'App\\Admin\\Controller\\MenuController->addMenu()','{\"menuName\":\"\\u67e5\\u770b\\u89d2\\u8272\\u7528\\u6237\\u5217\\u8868\",\"perms\":\"role:user:view\",\"parentId\":3,\"icon\":\"\",\"sort\":0,\"type\":1,\"path\":\"\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-30 10:17:21','2019-10-30 10:17:21'),(1889,'admin','修改菜单/按钮',23,'App\\Admin\\Controller\\MenuController->updateMenu()','{\"id\":152,\"parentId\":4,\"menuName\":\"\\u89d2\\u8272\\u7528\\u6237\\u5217\\u8868\",\"path\":\"\",\"component\":\"\",\"perms\":\"role:user:view\",\"icon\":\"\",\"type\":\"1\",\"sort\":0,\"createdAt\":\"2019-10-30 18:17:21\",\"updatedAt\":\"2019-10-30 18:17:21\",\"children\":null}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-30 10:17:40','2019-10-30 10:17:40'),(1890,'admin','新增菜单/按钮',16,'App\\Admin\\Controller\\MenuController->addMenu()','{\"menuName\":\"\\u89d2\\u8272\\u83dc\\u5355\\u5217\\u8868\",\"perms\":\"role:menu:view\",\"parentId\":4,\"icon\":\"\",\"sort\":0,\"type\":1,\"path\":\"\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-30 10:35:39','2019-10-30 10:35:39'),(1891,'admin','修改菜单/按钮',20,'App\\Admin\\Controller\\MenuController->updateMenu()','{\"id\":5,\"parentId\":1,\"menuName\":\"\\u83dc\\u5355\\u7ba1\\u7406\",\"name\":\"MenuPage\",\"path\":\"\\/system\\/menu\",\"component\":\"system\\/menu\",\"perms\":\"menu:view\",\"icon\":\"list-ul\",\"type\":\"0\",\"sort\":3,\"createdAt\":\"2017-12-27 16:48:57\",\"updatedAt\":\"2019-10-27 22:40:31\",\"children\":null}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-31 02:50:39','2019-10-31 02:50:39'),(1892,'admin','修改菜单/按钮',10,'App\\Admin\\Controller\\MenuController->updateMenu()','{\"id\":4,\"parentId\":1,\"menuName\":\"\\u89d2\\u8272\\u7ba1\\u7406\",\"name\":\"UserPage\",\"path\":\"\\/system\\/role\",\"component\":\"system\\/role\",\"perms\":\"role:view\",\"icon\":\"group\",\"type\":\"0\",\"sort\":2,\"createdAt\":\"2017-12-27 16:48:09\",\"updatedAt\":\"2019-10-27 22:38:05\",\"children\":null}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-31 02:50:56','2019-10-31 02:50:56'),(1893,'admin','修改菜单/按钮',17,'App\\Admin\\Controller\\MenuController->updateMenu()','{\"id\":4,\"parentId\":1,\"menuName\":\"\\u89d2\\u8272\\u7ba1\\u7406\",\"name\":\"RolePage\",\"path\":\"\\/system\\/role\",\"component\":\"system\\/role\",\"perms\":\"role:view\",\"icon\":\"group\",\"type\":\"0\",\"sort\":2,\"createdAt\":\"2017-12-27 16:48:09\",\"updatedAt\":\"2019-10-31 10:50:56\",\"children\":null}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-31 02:51:17','2019-10-31 02:51:17'),(1894,'admin','修改菜单/按钮',18,'App\\Admin\\Controller\\MenuController->updateMenu()','{\"id\":1,\"parentId\":0,\"menuName\":\"\\u7cfb\\u7edf\\u7ba1\\u7406\",\"name\":\"system\",\"path\":\"\\/system\",\"component\":\"PageView\",\"perms\":\"\",\"icon\":\"cogs\",\"type\":\"0\",\"sort\":1,\"createdAt\":\"2017-12-27 16:39:07\",\"updatedAt\":\"2019-10-29 21:08:59\",\"children\":null}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-31 02:52:23','2019-10-31 02:52:23'),(1895,'admin','修改菜单/按钮',12,'App\\Admin\\Controller\\MenuController->updateMenu()','{\"id\":3,\"parentId\":1,\"menuName\":\"\\u7528\\u6237\\u7ba1\\u7406\",\"name\":\"UserPage\",\"path\":\"\\/system\\/user\",\"component\":\"system\\/user\",\"perms\":\"user:view\",\"icon\":\"user\",\"type\":\"0\",\"sort\":1,\"createdAt\":\"2017-12-27 16:47:13\",\"updatedAt\":\"2019-10-27 22:37:45\",\"children\":null}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-31 02:53:04','2019-10-31 02:53:04'),(1896,'admin','修改菜单/按钮',24,'App\\Admin\\Controller\\MenuController->updateMenu()','{\"id\":2,\"parentId\":0,\"menuName\":\"\\u7cfb\\u7edf\\u76d1\\u63a7\",\"name\":\"monitor\",\"path\":\"\\/monitor\",\"component\":\"PageView\",\"perms\":\"\",\"icon\":\"dashboard\",\"type\":\"0\",\"sort\":2,\"createdAt\":\"2017-12-27 16:45:51\",\"updatedAt\":\"2019-01-23 06:27:12\",\"children\":null}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-31 03:27:30','2019-10-31 03:27:30'),(1897,'admin','新增菜单/按钮',15,'App\\Admin\\Controller\\MenuController->addMenu()','{\"menuName\":\"\\u767b\\u5f55\\u65e5\\u5fd7\",\"path\":\"\\/monitor\\/loginLog\",\"name\":\"LoginLog\",\"component\":\"monitor\\/login-log\",\"icon\":\"clock-o\",\"parentId\":1,\"sort\":4,\"type\":0,\"perms\":\"\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-31 13:11:08','2019-10-31 13:11:08'),(1898,'admin','修改菜单/按钮',26,'App\\Admin\\Controller\\MenuController->updateMenu()','{\"id\":154,\"parentId\":2,\"menuName\":\"\\u767b\\u5f55\\u65e5\\u5fd7\",\"name\":\"LoginLog\",\"path\":\"\\/monitor\\/loginLog\",\"component\":\"monitor\\/login-log\",\"perms\":\"\",\"icon\":\"clock-o\",\"type\":\"0\",\"sort\":\"3\",\"createdAt\":\"2019-10-31 21:11:08\",\"updatedAt\":\"2019-10-31 21:11:08\",\"children\":null}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-31 13:13:41','2019-10-31 13:13:41'),(1899,'admin','修改菜单/按钮',26,'App\\Admin\\Controller\\MenuController->updateMenu()','{\"id\":154,\"parentId\":0,\"menuName\":\"\\u767b\\u5f55\\u65e5\\u5fd7\",\"name\":\"LoginLog\",\"path\":\"\\/monitor\\/loginLog\",\"component\":\"monitor\\/login-log\",\"perms\":\"\",\"icon\":\"clock-o\",\"type\":\"0\",\"sort\":3,\"createdAt\":\"2019-10-31 21:11:08\",\"updatedAt\":\"2019-10-31 21:13:41\",\"children\":null}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-31 13:14:45','2019-10-31 13:14:45'),(1900,'admin','修改菜单/按钮',20,'App\\Admin\\Controller\\MenuController->updateMenu()','{\"id\":154,\"parentId\":2,\"menuName\":\"\\u767b\\u5f55\\u65e5\\u5fd7\",\"name\":\"LoginLog\",\"path\":\"\\/monitor\\/loginLog\",\"component\":\"monitor\\/login-log\",\"perms\":\"\",\"icon\":\"clock-o\",\"type\":\"0\",\"sort\":3,\"createdAt\":\"2019-10-31 21:11:08\",\"updatedAt\":\"2019-10-31 21:14:45\",\"children\":null}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-31 13:16:09','2019-10-31 13:16:09'),(1901,'admin','删除系统日志',11,'App\\Admin\\Controller\\LogController->delete()','{\"ids\":[15]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-31 13:38:09','2019-10-31 13:38:09'),(1902,'admin','删除系统日志',6,'App\\Admin\\Controller\\LogController->delete()','{\"ids\":[1]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-31 13:38:24','2019-10-31 13:38:24'),(1903,'admin','删除系统日志',6,'App\\Admin\\Controller\\LogController->delete()','{\"ids\":[15]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-10-31 13:39:03','2019-10-31 13:39:03'),(1904,'admin','修改菜单/按钮',30,'App\\Admin\\Controller\\MenuController->updateMenu()','{\"id\":154,\"parentId\":2,\"menuName\":\"\\u767b\\u5f55\\u65e5\\u5fd7\",\"name\":\"LoginLog\",\"path\":\"\\/monitor\\/loginLog\",\"component\":\"monitor\\/login-log\",\"perms\":\"loginlog:view\",\"icon\":\"clock-o\",\"type\":\"0\",\"sort\":3,\"createdAt\":\"2019-10-31 21:11:08\",\"updatedAt\":\"2019-10-31 21:16:09\",\"children\":null}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-01 02:37:47','2019-11-01 02:37:47'),(1905,'admin','新增菜单/按钮',16,'App\\Admin\\Controller\\MenuController->addMenu()','{\"menuName\":\"\\u5220\\u9664\\u767b\\u5f55\\u65e5\\u5fd7\",\"perms\":\"loginlog:delete\",\"parentId\":154,\"icon\":\"\",\"sort\":0,\"type\":1,\"path\":\"\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-01 02:38:20','2019-11-01 02:38:20'),(1906,'admin','删除登录日志',18,'App\\Admin\\Controller\\LoginLogController->loginLogDelete()','{\"ids\":[17]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-01 02:39:36','2019-11-01 02:39:36'),(1907,'test','方法一',0,'App\\Http\\Controller\\TestController->methodOne()','[]','127.0.0.1','','2019-11-01 13:09:24','2019-11-01 13:09:24'),(1908,'test','方法一',201,'App\\Http\\Controller\\TestController->methodOne()','[]','127.0.0.1','','2019-11-01 13:20:41','2019-11-01 13:20:41'),(1909,'test','方法一',0,'App\\Http\\Controller\\TestController->methodOne()','[]','127.0.0.1','','2019-11-01 13:38:12','2019-11-01 13:38:12'),(1910,'test','方法一',0,'App\\Http\\Controller\\TestController->methodOne()','{}','127.0.0.1','','2019-11-01 13:39:12','2019-11-01 13:39:12'),(1911,'test','方法一',0,'App\\Http\\Controller\\TestController->methodOne()','{\"swoftRouterHandler\":[1,\"\\/test\\/one\",{}]}','127.0.0.1','','2019-11-01 13:41:02','2019-11-01 13:41:02'),(1912,'test','方法一',0,'App\\Http\\Controller\\TestController->methodOne()','{\"swoftRouterHandler\":[1,\"\\/test\\/one\",{}]}','127.0.0.1','','2019-11-01 13:41:22','2019-11-01 13:41:22'),(1913,'test','方法一',0,'App\\Http\\Controller\\TestController->methodOne()','{\"body\":\"323\",\"type\":\"test1\"}','127.0.0.1','','2019-11-01 13:42:35','2019-11-01 13:42:35'),(1914,'test','方法一',0,'App\\Http\\Controller\\TestController->methodOne()','{\"type\":\"test1\"}','127.0.0.1','','2019-11-01 13:42:47','2019-11-01 13:42:47'),(1915,'test','方法二',200,'App\\Http\\Controller\\TestController->methodTwo()','[]','127.0.0.1','','2019-11-01 13:43:56','2019-11-01 13:43:56'),(1916,'admin','删除菜单/按钮',115,'App\\Admin\\Controller\\MenuController->deleteMenus()','{\"ids\":[58,59,61]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-01 23:35:44','2019-11-01 23:35:44'),(1917,'admin','新增部门',295,'App\\Admin\\Controller\\DeptController->addDept()','[]','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-05 15:10:45','2019-11-05 15:10:45'),(1918,'admin','新增部门',23,'App\\Admin\\Controller\\DeptController->addDept()','[]','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-05 15:11:23','2019-11-05 15:11:23'),(1919,'admin','新增部门',25,'App\\Admin\\Controller\\DeptController->addDept()','{\"id\":\"\",\"parentId\":0,\"deptName\":\"\\u6d4b\\u8bd5\",\"orderNum\":\"9\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-05 15:12:07','2019-11-05 15:12:07'),(1920,'admin','更新部门',27,'App\\Admin\\Controller\\DeptController->updateDept()','{\"id\":11,\"parentId\":0,\"deptName\":\"\\u6d4b\\u8bd51\",\"orderNum\":9,\"createdAt\":\"2019-11-05 23:12:07\",\"updatedAt\":\"2019-11-05 23:12:07\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-05 15:20:24','2019-11-05 15:20:24'),(1921,'admin','更新部门',24,'App\\Admin\\Controller\\DeptController->updateDept()','{\"id\":11,\"parentId\":0,\"deptName\":\"\\u6d4b\\u8bd512\",\"orderNum\":9,\"createdAt\":\"2019-11-05 23:12:07\",\"updatedAt\":\"2019-11-05 23:12:07\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-05 15:20:30','2019-11-05 15:20:30'),(1922,'admin','删除部门',13,'App\\Admin\\Controller\\DeptController->deleteMenus()','{\"ids\":[11]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-07 13:43:06','2019-11-07 13:43:06'),(1923,'admin','新增部门',13,'App\\Admin\\Controller\\DeptController->addDept()','{\"id\":0,\"parentId\":0,\"deptName\":\"\\u6d4b\\u8bd52\",\"orderNum\":\"10\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-07 13:43:41','2019-11-07 13:43:41'),(1924,'admin','新增部门',15,'App\\Admin\\Controller\\DeptController->addDept()','{\"id\":0,\"parentId\":12,\"deptName\":\"\\u6d4b\\u8bd521\",\"orderNum\":\"1\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-07 13:43:52','2019-11-07 13:43:52'),(1925,'admin','删除部门',12,'App\\Admin\\Controller\\DeptController->deleteMenus()','{\"ids\":[12,13]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-07 13:43:57','2019-11-07 13:43:57'),(1926,'admin','删除菜单/按钮',53,'App\\Admin\\Controller\\MenuController->deleteMenus()','{\"ids\":[121]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-08 06:24:56','2019-11-08 06:24:56'),(1927,'admin','删除菜单/按钮',26,'App\\Admin\\Controller\\MenuController->deleteMenus()','{\"ids\":[121]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-08 06:26:58','2019-11-08 06:26:58'),(1928,'admin','删除菜单/按钮',35,'App\\Admin\\Controller\\MenuController->deleteMenus()','{\"ids\":[121]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-08 06:28:01','2019-11-08 06:28:01'),(1929,'admin','删除菜单/按钮',60,'App\\Admin\\Controller\\MenuController->deleteMenus()','{\"ids\":[121]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-08 06:28:45','2019-11-08 06:28:45'),(1930,'admin','更新用户',438,'App\\Admin\\Controller\\AdministratorController->updateUser()','{\"username\":\"test3\",\"realName\":\"test3\",\"deptId\":6,\"email\":\"321234@qq.com\",\"mobile\":\"18157227207\",\"status\":1,\"sex\":2,\"description\":\"\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-08 08:14:13','2019-11-08 08:14:13'),(1931,'admin','更新用户',11,'App\\Admin\\Controller\\AdministratorController->updateUser()','{\"username\":\"admin\",\"realName\":\"admin\",\"deptId\":1,\"email\":\"1346233126@qq.com\",\"mobile\":\"13455533233\",\"status\":1,\"sex\":2,\"description\":\"\\u6211\\u662f\\u5e05\\u6bd4\\u4f5c\\u8005\\u3002\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-08 14:37:20','2019-11-08 14:37:20'),(1932,'admin','更新用户',19,'App\\Admin\\Controller\\AdministratorController->updateUser()','{\"username\":\"scott\",\"realName\":\"swoft\",\"deptId\":6,\"email\":\"swoft@qq.com\",\"mobile\":\"15134627380\",\"status\":1,\"sex\":0,\"description\":\"\\u6211\\u662fswoft\\uff0c\\u55ef\\u55ef\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-08 14:37:37','2019-11-08 14:37:37'),(1933,'admin','修改菜单/按钮',25,'App\\Admin\\Controller\\MenuController->updateMenu()','{\"id\":127,\"parentId\":122,\"menuName\":\"\\u670d\\u52a1\\u5668\\u4fe1\\u606f\",\"name\":\"SystemInfo\",\"path\":\"\\/monitor\\/system\\/info\",\"component\":\"monitor\\/system-info\",\"perms\":\"\",\"icon\":\"info-circle\",\"type\":\"0\",\"sort\":3,\"createdAt\":\"2019-01-21 07:53:43\",\"updatedAt\":\"2019-10-29 21:08:23\",\"children\":null}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-08 14:56:55','2019-11-08 14:56:55'),(1934,'admin','修改菜单/按钮',11,'App\\Admin\\Controller\\MenuController->updateMenu()','{\"id\":127,\"parentId\":122,\"menuName\":\"\\u670d\\u52a1\\u5668\\u4fe1\\u606f\",\"name\":\"Info\",\"path\":\"\\/monitor\\/system\\/info\",\"component\":\"monitor\\/system-info\",\"perms\":\"\",\"icon\":\"info-circle\",\"type\":\"0\",\"sort\":3,\"createdAt\":\"2019-01-21 07:53:43\",\"updatedAt\":\"2019-11-08 22:56:55\",\"children\":null}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-08 15:03:43','2019-11-08 15:03:43'),(1935,'admin','更新用户',78,'App\\Admin\\Controller\\AdministratorController->updateUser()','{\"username\":\"test3\",\"realName\":\"test3\",\"deptId\":6,\"email\":\"321234@qq.com\",\"mobile\":\"13426389892\",\"status\":1,\"sex\":2,\"description\":\"\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-09 07:46:56','2019-11-09 07:46:56'),(1936,'admin','更新用户',24,'App\\Admin\\Controller\\AdministratorController->updateUser()','{\"username\":\"test\",\"realName\":\"test\",\"deptId\":6,\"email\":\"123@qq.com\",\"mobile\":\"13426389892\",\"status\":1,\"sex\":0,\"description\":\"\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-09 07:47:05','2019-11-09 07:47:05'),(1937,'admin','更新用户',24,'App\\Admin\\Controller\\AdministratorController->updateUser()','{\"username\":\"scott\",\"realName\":\"swoft\",\"deptId\":6,\"email\":\"swoft@qq.com\",\"mobile\":\"13426389892\",\"status\":1,\"sex\":0,\"description\":\"\\u6211\\u662fswoft\\uff0c\\u55ef\\u55ef\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-09 07:47:13','2019-11-09 07:47:13'),(1938,'admin','更新用户',12,'App\\Admin\\Controller\\AdministratorController->updateUser()','{\"username\":\"admin\",\"realName\":\"admin\",\"deptId\":1,\"email\":\"1346233126@qq.com\",\"mobile\":\"13426389892\",\"status\":1,\"sex\":2,\"description\":\"\\u6211\\u662f\\u5e05\\u6bd4\\u4f5c\\u8005\\u3002\"}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-09 07:47:17','2019-11-09 07:47:17'),(1939,'admin','删除菜单/按钮',40,'App\\Admin\\Controller\\MenuController->deleteMenus()','{\"ids\":[147]}','127.0.0.1','0|0|0|内网IP|内网IP','2019-11-13 12:44:33','2019-11-13 12:44:33');
/*!40000 ALTER TABLE `t_log` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `t_login_log`
--

LOCK TABLES `t_login_log` WRITE;
/*!40000 ALTER TABLE `t_login_log` DISABLE KEYS */;
INSERT INTO `t_login_log` VALUES (1,'admin','2019-10-28 05:53:10','2019-10-28 05:53:10','0|0|0|内网IP|内网IP','127.0.0.1'),(2,'admin','2019-10-28 08:22:25','2019-10-28 08:22:25','0|0|0|内网IP|内网IP','127.0.0.1'),(3,'admin','2019-10-28 14:30:16','2019-10-28 14:30:16','0|0|0|内网IP|内网IP','127.0.0.1'),(4,'admin','2019-10-29 06:43:52','2019-10-29 06:43:52','0|0|0|内网IP|内网IP','127.0.0.1'),(5,'admin','2019-10-29 10:29:56','2019-10-29 10:29:56','0|0|0|内网IP|内网IP','127.0.0.1'),(6,'admin','2019-10-29 14:30:46','2019-10-29 14:30:46','0|0|0|内网IP|内网IP','127.0.0.1'),(7,'scott','2019-10-30 09:56:18','2019-10-30 09:56:18','0|0|0|内网IP|内网IP','127.0.0.1'),(8,'admin','2019-10-30 10:10:52','2019-10-30 10:10:52','0|0|0|内网IP|内网IP','127.0.0.1'),(9,'scott','2019-10-30 10:44:11','2019-10-30 10:44:11','0|0|0|内网IP|内网IP','127.0.0.1'),(10,'test','2019-10-30 23:39:59','2019-10-30 23:39:59','0|0|0|内网IP|内网IP','127.0.0.1'),(11,'admin','2019-10-30 23:43:56','2019-10-30 23:43:56','0|0|0|内网IP|内网IP','127.0.0.1'),(12,'admin','2019-10-31 02:48:33','2019-10-31 02:48:33','0|0|0|内网IP|内网IP','127.0.0.1'),(13,'admin','2019-10-31 07:13:27','2019-10-31 07:13:27','0|0|0|内网IP|内网IP','127.0.0.1'),(14,'admin','2019-10-31 13:08:27','2019-10-31 13:08:27','0|0|0|内网IP|内网IP','127.0.0.1'),(16,'admin','2019-10-31 13:51:04','2019-10-31 13:51:04','0|0|0|内网IP|内网IP','127.0.0.1'),(18,'admin','2019-11-01 09:04:45','2019-11-01 09:04:45','0|0|0|内网IP|内网IP','127.0.0.1'),(19,'admin','2019-11-01 09:05:14','2019-11-01 09:05:14','0|0|0|内网IP|内网IP','127.0.0.1'),(20,'admin','2019-11-01 09:05:29','2019-11-01 09:05:29','0|0|0|内网IP|内网IP','127.0.0.1'),(21,'admin','2019-11-01 09:06:50','2019-11-01 09:06:50','0|0|0|内网IP|内网IP','127.0.0.1'),(22,'admin','2019-11-01 09:08:31','2019-11-01 09:08:31','0|0|0|内网IP|内网IP','127.0.0.1'),(23,'admin','2019-11-01 09:08:39','2019-11-01 09:08:39','0|0|0|内网IP|内网IP','127.0.0.1'),(24,'admin','2019-11-02 10:36:59','2019-11-02 10:36:59','0|0|0|内网IP|内网IP','127.0.0.1'),(25,'admin','2019-11-05 13:31:57','2019-11-05 13:31:57','0|0|0|内网IP|内网IP','127.0.0.1'),(26,'admin','2019-11-07 12:52:26','2019-11-07 12:52:26','0|0|0|内网IP|内网IP','127.0.0.1'),(27,'admin','2019-11-07 14:00:07','2019-11-07 14:00:07','0|0|0|内网IP|内网IP','127.0.0.1'),(28,'admin','2019-11-07 14:00:57','2019-11-07 14:00:57','0|0|0|内网IP|内网IP','127.0.0.1'),(29,'admin','2019-11-08 14:36:35','2019-11-08 14:36:35','0|0|0|内网IP|内网IP','127.0.0.1'),(30,'admin','2019-11-09 14:49:14','2019-11-09 14:49:14','0|0|0|内网IP|内网IP','127.0.0.1'),(31,'admin','2019-11-09 14:50:41','2019-11-09 14:50:41','0|0|0|内网IP|内网IP','127.0.0.1'),(32,'admin','2019-11-09 14:52:08','2019-11-09 14:52:08','0|0|0|内网IP|内网IP','127.0.0.1'),(33,'admin','2019-11-09 15:12:19','2019-11-09 15:12:19','0|0|0|内网IP|内网IP','127.0.0.1'),(34,'admin','2019-11-09 15:13:12','2019-11-09 15:13:12','0|0|0|内网IP|内网IP','127.0.0.1'),(35,'admin','2019-11-11 03:01:59','2019-11-11 03:01:59','0|0|0|内网IP|内网IP','127.0.0.1'),(36,'admin','2019-11-12 13:53:55','2019-11-12 13:53:55','0|0|0|内网IP|内网IP','127.0.0.1'),(37,'admin','2019-11-13 12:44:12','2019-11-13 12:44:12','0|0|0|内网IP|内网IP','127.0.0.1');
/*!40000 ALTER TABLE `t_login_log` ENABLE KEYS */;
UNLOCK TABLES;

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
