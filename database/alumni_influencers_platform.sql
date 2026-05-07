CREATE DATABASE  IF NOT EXISTS `alumni_influencers_platform` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `alumni_influencers_platform`;
-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: alumni_influencers_platform
-- ------------------------------------------------------
-- Server version	8.0.41

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alumni_profiles`
--

DROP TABLE IF EXISTS `alumni_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumni_profiles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `phone_number` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `graduation_year` year DEFAULT NULL,
  `current_job_title` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_company` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `industry_sector` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biography` text COLLATE utf8mb4_unicode_ci,
  `linkedin_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `fk_alumni_profile_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumni_profiles`
--

LOCK TABLES `alumni_profiles` WRITE;
/*!40000 ALTER TABLE `alumni_profiles` DISABLE KEYS */;
INSERT INTO `alumni_profiles` VALUES (1,2,'0768524489','2003-04-16',2026,'Intern','WSO2','IT','Kalutara','Sri lanka','I\'m a hero','https://www.linkedin.com/in/test-user','6426458b87c1c769789d8d03b8dac7e5.png','2026-05-04 15:40:26','2026-05-04 15:40:26'),(2,4,'0753504489','2026-05-20',2026,'SE','IFS','SE','Colombo','SL','dfqerqerbqeb','https://www.linkedin.com/in/test-user','1cb9b029bddd414b19955b26771887d5.png','2026-05-04 17:23:00','2026-05-04 17:23:00'),(3,3,'0761895577','2026-05-06',2025,'SE','WSO2','SE','gampaha','SL','qeirnponwpfeovnenverjv iierov2ner qerv ef vpe','https://www.linkedin.com/in/test-user','879b9c77530d0cffa2032a96efce6885.png','2026-05-04 17:25:25','2026-05-04 17:25:25');
/*!40000 ALTER TABLE `alumni_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `api_clients`
--

DROP TABLE IF EXISTS `api_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `api_clients` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `client_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `client_slug` (`client_slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api_clients`
--

LOCK TABLES `api_clients` WRITE;
/*!40000 ALTER TABLE `api_clients` DISABLE KEYS */;
INSERT INTO `api_clients` VALUES (1,'Mobile AR App','mobile_ar_app','Client application for retrieving the Alumni Influencer of the Day.',1,'2026-05-06 11:23:29'),(2,'Analytics Dashboard','analytics_dashboard','Client application for alumni analytics and dashboard data.',1,'2026-05-06 11:23:29');
/*!40000 ALTER TABLE `api_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `api_tokens`
--

DROP TABLE IF EXISTS `api_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `api_tokens` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `client_id` int unsigned NOT NULL,
  `token_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token_prefix` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token_hash` char(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scopes` json NOT NULL,
  `last_used_at` datetime DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  `revoked_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_token_hash` (`token_hash`),
  KEY `idx_api_tokens_user` (`user_id`),
  KEY `idx_api_tokens_client` (`client_id`),
  KEY `idx_api_tokens_active` (`is_active`),
  KEY `idx_api_tokens_prefix` (`token_prefix`),
  CONSTRAINT `fk_api_tokens_client` FOREIGN KEY (`client_id`) REFERENCES `api_clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_api_tokens_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api_tokens`
--

LOCK TABLES `api_tokens` WRITE;
/*!40000 ALTER TABLE `api_tokens` DISABLE KEYS */;
INSERT INTO `api_tokens` VALUES (1,1,1,'AR App Token','e15dfb4a4a6a','2b8af82f85dd1abb3566f6dce1fdff627a19e14544f2944f4ae303d9ab23266d','[\"read:alumni_of_day\"]','2026-05-06 08:11:50','2026-08-04 07:57:41','2026-05-06 08:13:48',0,'2026-05-06 11:27:41'),(2,1,2,'Test Analytics','504455a5f9ee','2a1bbf23781d35abb45b79d5e7872279a6218fbe328253503f160e6bd47aa23f','[\"read:alumni\", \"read:analytics\"]','2026-05-06 10:36:33','2026-08-04 10:33:05',NULL,1,'2026-05-06 14:03:05'),(3,1,1,'Test Analy. for Mobile AR','51d8a14aab9a','c5c5967eab2d5d8492a26fe4980de1ee5fba4f3e859b0f05aab048c477a5502d','[\"read:alumni_of_day\"]','2026-05-06 10:36:23','2026-08-04 10:35:48',NULL,1,'2026-05-06 14:05:48');
/*!40000 ALTER TABLE `api_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `api_usage_logs`
--

DROP TABLE IF EXISTS `api_usage_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `api_usage_logs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `token_id` int unsigned NOT NULL,
  `client_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `endpoint` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response_code` int NOT NULL,
  `requested_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_api_usage_logs_token` (`token_id`),
  KEY `idx_api_usage_logs_client` (`client_id`),
  KEY `idx_api_usage_logs_user` (`user_id`),
  KEY `idx_api_usage_logs_requested_at` (`requested_at`),
  CONSTRAINT `fk_api_usage_logs_client` FOREIGN KEY (`client_id`) REFERENCES `api_clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_api_usage_logs_token` FOREIGN KEY (`token_id`) REFERENCES `api_tokens` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_api_usage_logs_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api_usage_logs`
--

LOCK TABLES `api_usage_logs` WRITE;
/*!40000 ALTER TABLE `api_usage_logs` DISABLE KEYS */;
INSERT INTO `api_usage_logs` VALUES (1,1,1,1,'http://localhost/practice/cw/index.php/api/featured-today','GET','::1','PostmanRuntime/7.54.0',404,'2026-05-06 11:30:43'),(2,1,1,1,'http://localhost/practice/cw/index.php/api/featured-today','GET','::1','PostmanRuntime/7.54.0',200,'2026-05-06 11:41:50'),(3,2,2,1,'http://localhost/practice/cw/index.php/api/analytics-summary','GET','::1','PostmanRuntime/7.54.0',200,'2026-05-06 14:04:04'),(4,2,2,1,'http://localhost/practice/cw/index.php/api/analytics-charts','GET','::1','PostmanRuntime/7.54.0',200,'2026-05-06 14:04:35'),(5,3,1,1,'http://localhost/practice/cw/index.php/api/featured-today','GET','::1','PostmanRuntime/7.54.0',200,'2026-05-06 14:06:23'),(6,2,2,1,'http://localhost/practice/cw/index.php/api/analytics-summary','GET','::1','PostmanRuntime/7.54.0',200,'2026-05-06 14:06:33'),(7,3,1,1,'http://localhost/practice/cw/index.php/api/analytics-summary','GET','::1','PostmanRuntime/7.54.0',403,'2026-05-06 14:06:40'),(8,3,1,1,'http://localhost/practice/cw/index.php/api/analytics-charts','GET','::1','PostmanRuntime/7.54.0',403,'2026-05-06 14:06:54');
/*!40000 ALTER TABLE `api_usage_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bid_notifications`
--

DROP TABLE IF EXISTS `bid_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bid_notifications` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `slot_id` int unsigned NOT NULL,
  `notification_type` enum('status_update','winner','loser') COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_bid_notifications_user` (`user_id`),
  KEY `fk_bid_notifications_slot` (`slot_id`),
  CONSTRAINT `fk_bid_notifications_slot` FOREIGN KEY (`slot_id`) REFERENCES `featured_slots` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_bid_notifications_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bid_notifications`
--

LOCK TABLES `bid_notifications` WRITE;
/*!40000 ALTER TABLE `bid_notifications` DISABLE KEYS */;
INSERT INTO `bid_notifications` VALUES (1,3,1,'status_update','You are currently winning this slot.',0,'2026-05-04 17:27:39'),(2,4,1,'status_update','You are currently winning this slot.',0,'2026-05-04 17:31:16'),(3,4,1,'status_update','You are currently winning this slot.',0,'2026-05-04 17:32:20'),(4,4,1,'loser','Your bid was not selected for the featured alumni slot on 2026-05-04.',0,'2026-05-04 17:49:55'),(5,3,1,'winner','Congratulations! You won the featured alumni slot for 2026-05-04.',0,'2026-05-04 17:49:55');
/*!40000 ALTER TABLE `bid_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bids`
--

DROP TABLE IF EXISTS `bids`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bids` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `slot_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `bid_amount` decimal(10,2) NOT NULL,
  `bid_status` enum('winning','losing','won','lost') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'losing',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_slot_user` (`slot_id`,`user_id`),
  KEY `fk_bids_user` (`user_id`),
  CONSTRAINT `fk_bids_slot` FOREIGN KEY (`slot_id`) REFERENCES `featured_slots` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_bids_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bids`
--

LOCK TABLES `bids` WRITE;
/*!40000 ALTER TABLE `bids` DISABLE KEYS */;
INSERT INTO `bids` VALUES (1,1,3,100.00,'won','2026-05-04 17:27:39','2026-05-04 17:49:55'),(2,1,4,200.00,'lost','2026-05-04 17:31:16','2026-05-04 17:49:55');
/*!40000 ALTER TABLE `bids` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ci_sessions` (
  `id` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` int unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ci_sessions`
--

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` VALUES ('nmmhuo8rsoce492p1sslk4vjjr3r8ret','127.0.0.1',1778094027,_binary '__ci_last_regenerate|i:1778094026;user_id|s:1:\"1\";user_email|s:15:\"test1@iit.ac.lk\";user_name|s:11:\"test1 test1\";user_role|s:9:\"developer\";logged_in|b:1;'),('poqnoeej6nmuvhq2mburvqmke7js9659','127.0.0.1',1778096699,_binary '__ci_last_regenerate|i:1778096614;user_id|s:1:\"2\";user_email|s:26:\"gajindu.20220183@iit.ac.lk\";user_name|s:19:\"gajindu kaweeshwara\";user_role|s:7:\"alumnus\";logged_in|b:1;');
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_verification_tokens`
--

DROP TABLE IF EXISTS `email_verification_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_verification_tokens` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `token_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` datetime NOT NULL,
  `used_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_email_verification_user` (`user_id`),
  KEY `idx_email_verification_expires` (`expires_at`),
  CONSTRAINT `fk_email_verification_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_verification_tokens`
--

LOCK TABLES `email_verification_tokens` WRITE;
/*!40000 ALTER TABLE `email_verification_tokens` DISABLE KEYS */;
INSERT INTO `email_verification_tokens` VALUES (1,1,'1975c0a221e27765aa300b1d316620f2117aef44769e67b33945a3c7b1855cd1','2026-05-05 09:10:24','2026-05-04 09:13:04','2026-05-04 12:40:24'),(2,2,'db85426185310f969ff4538b3e94caa922fdbc25425943b54dbfb08ee285498e','2026-05-05 11:40:51','2026-05-04 11:41:20','2026-05-04 15:10:51'),(3,3,'5b03adb5105e6e3b7e71807df882168a78e65878ebafa6f09134c13f7fe00b5f','2026-05-05 12:51:48','2026-05-04 13:01:46','2026-05-04 16:21:48'),(4,4,'a196e4f3a84e27e49ad3013e45bb76ea457d8a6fbd1be0dad838dccbc99b610d','2026-05-05 13:09:02','2026-05-04 13:09:55','2026-05-04 16:39:02'),(5,5,'705addbc86dc4c79413697d8292b1057dbda9526f7b5699387aa9bddc4b4a997','2026-05-07 09:34:58','2026-05-06 09:35:51','2026-05-06 13:04:58');
/*!40000 ALTER TABLE `email_verification_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `featured_alumni`
--

DROP TABLE IF EXISTS `featured_alumni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `featured_alumni` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `slot_id` int unsigned NOT NULL,
  `feature_date` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_feature_date` (`feature_date`),
  UNIQUE KEY `unique_slot_id` (`slot_id`),
  KEY `fk_featured_alumni_user` (`user_id`),
  CONSTRAINT `fk_featured_alumni_slot` FOREIGN KEY (`slot_id`) REFERENCES `featured_slots` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_featured_alumni_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `featured_alumni`
--

LOCK TABLES `featured_alumni` WRITE;
/*!40000 ALTER TABLE `featured_alumni` DISABLE KEYS */;
INSERT INTO `featured_alumni` VALUES (16,4,1,'2026-05-04','2026-05-04 17:45:32'),(17,4,2,'2026-05-03','2026-05-04 17:45:32'),(18,4,3,'2026-05-02','2026-05-04 17:45:32'),(19,3,4,'2026-05-06','2026-05-06 11:36:15');
/*!40000 ALTER TABLE `featured_alumni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `featured_slots`
--

DROP TABLE IF EXISTS `featured_slots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `featured_slots` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `slot_date` date NOT NULL,
  `status` enum('open','closed','awarded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `winner_user_id` int unsigned DEFAULT NULL,
  `winning_bid_id` int unsigned DEFAULT NULL,
  `awarded_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slot_date` (`slot_date`),
  KEY `fk_featured_slots_winner_user` (`winner_user_id`),
  CONSTRAINT `fk_featured_slots_winner_user` FOREIGN KEY (`winner_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `featured_slots`
--

LOCK TABLES `featured_slots` WRITE;
/*!40000 ALTER TABLE `featured_slots` DISABLE KEYS */;
INSERT INTO `featured_slots` VALUES (1,'2026-05-04','awarded',3,1,'2026-05-04 14:19:55','2026-05-04 15:17:29','2026-05-04 17:49:55'),(2,'2026-05-03','awarded',NULL,NULL,NULL,'2026-05-04 17:44:10','2026-05-04 17:44:10'),(3,'2026-05-02','awarded',NULL,NULL,NULL,'2026-05-04 17:44:10','2026-05-04 17:44:10'),(4,'2026-05-06','awarded',3,NULL,'2026-05-06 11:36:04','2026-05-06 11:36:04','2026-05-06 11:36:04');
/*!40000 ALTER TABLE `featured_slots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_audit_logs`
--

DROP TABLE IF EXISTS `login_audit_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login_audit_logs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `email_attempted` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `login_status` enum('success','failed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `failure_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_login_audit_user` (`user_id`),
  KEY `idx_login_audit_created` (`created_at`),
  CONSTRAINT `fk_login_audit_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_audit_logs`
--

LOCK TABLES `login_audit_logs` WRITE;
/*!40000 ALTER TABLE `login_audit_logs` DISABLE KEYS */;
INSERT INTO `login_audit_logs` VALUES (1,2,'gajindu.20220183@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-04 15:11:57'),(2,2,'gajindu.20220183@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-04 15:16:04'),(3,3,'alumni1@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-04 16:32:22'),(4,4,'alumni2@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-04 16:40:37'),(5,3,'alumni1@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-04 17:24:13'),(6,4,'alumni2@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-04 17:31:04'),(7,1,'test1@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','failed','Wrong password','2026-05-04 18:01:50'),(8,1,'test1@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','failed','Wrong password','2026-05-04 18:02:05'),(9,1,'test1@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-04 18:03:09'),(10,1,'test1@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-04 20:42:46'),(11,1,'test1@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-06 11:13:59'),(12,2,'gajindu.20220183@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-06 11:14:52'),(13,2,'gajindu.20220183@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-06 11:26:48'),(14,NULL,'client@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','failed','Email not found','2026-05-06 13:04:34'),(15,5,'client@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-06 13:06:10'),(16,5,'client@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-06 13:17:26'),(17,3,'alumni1@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-06 13:18:29'),(18,5,'client@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-06 13:20:21'),(19,2,'gajindu.20220183@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-06 13:28:02'),(20,1,'test1@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-06 14:02:11'),(21,2,'gajindu.20220183@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-06 18:50:54'),(22,1,'test1@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-06 18:51:57'),(23,5,'client@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-06 18:52:28'),(24,1,'test1@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-06 19:05:30'),(25,5,'client@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-06 19:06:05'),(26,2,'gajindu.20220183@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-06 19:06:31'),(27,2,'gajindu.20220183@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-06 19:30:28'),(28,1,'test1@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-06 19:34:55'),(29,2,'gajindu.20220183@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-06 22:39:09'),(30,1,'test1@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-06 22:41:41'),(31,2,'gajindu.20220183@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-07 00:30:42'),(32,1,'test1@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-07 00:31:31'),(33,5,'client@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-07 00:31:54'),(34,5,'client@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-07 00:36:43'),(35,2,'gajindu.20220183@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-07 00:51:06');
/*!40000 ALTER TABLE `login_audit_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `token_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` datetime NOT NULL,
  `used_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_password_reset_user` (`user_id`),
  KEY `idx_password_reset_expires` (`expires_at`),
  CONSTRAINT `fk_password_reset_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
INSERT INTO `password_reset_tokens` VALUES (1,2,'c5da934bfeafe195baa0c3e1e22dd05aee1b54463b19d10279febf1a8b4536c3','2026-05-04 12:45:07','2026-05-04 11:45:42','2026-05-04 15:15:07'),(2,1,'7cdc7189b5018ae62a13a9a4a06ac015b16b38669493631d03f81d03a19296fb','2026-05-04 15:32:20','2026-05-04 14:32:48','2026-05-04 18:02:20');
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_certifications`
--

DROP TABLE IF EXISTS `profile_certifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile_certifications` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` int unsigned NOT NULL,
  `certification_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completion_date` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_profile_certification_profile` (`profile_id`),
  CONSTRAINT `fk_profile_certification_profile` FOREIGN KEY (`profile_id`) REFERENCES `alumni_profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_certifications`
--

LOCK TABLES `profile_certifications` WRITE;
/*!40000 ALTER TABLE `profile_certifications` DISABLE KEYS */;
INSERT INTO `profile_certifications` VALUES (2,1,'AWS Cloud Practitioner','Amazon Web Services','https://aws.amazon.com/certification/','2025-08-01','2026-05-06 15:29:35','2026-05-06 15:29:35'),(3,2,'Google Data Analytics Certificate','Google','https://grow.google/certificates/data-analytics/','2025-09-01','2026-05-06 15:29:35','2026-05-06 15:29:35'),(4,3,'AWS Cloud Practitioner','Amazon Web Services','https://aws.amazon.com/certification/','2025-10-01','2026-05-06 15:29:35','2026-05-06 15:29:35');
/*!40000 ALTER TABLE `profile_certifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_degrees`
--

DROP TABLE IF EXISTS `profile_degrees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile_degrees` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` int unsigned NOT NULL,
  `degree_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `university_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `official_degree_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completion_date` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_profile_degree_profile` (`profile_id`),
  CONSTRAINT `fk_profile_degree_profile` FOREIGN KEY (`profile_id`) REFERENCES `alumni_profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_degrees`
--

LOCK TABLES `profile_degrees` WRITE;
/*!40000 ALTER TABLE `profile_degrees` DISABLE KEYS */;
INSERT INTO `profile_degrees` VALUES (1,1,'BSc Computer Science','IIT / University of Westminster','https://www.westminster.ac.uk/computer-science','2026-05-13','2026-05-04 15:43:57','2026-05-04 15:43:57');
/*!40000 ALTER TABLE `profile_degrees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_employment_history`
--

DROP TABLE IF EXISTS `profile_employment_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile_employment_history` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` int unsigned NOT NULL,
  `job_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `is_current_job` tinyint(1) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_profile_employment_profile` (`profile_id`),
  CONSTRAINT `fk_profile_employment_profile` FOREIGN KEY (`profile_id`) REFERENCES `alumni_profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_employment_history`
--

LOCK TABLES `profile_employment_history` WRITE;
/*!40000 ALTER TABLE `profile_employment_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `profile_employment_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_licences`
--

DROP TABLE IF EXISTS `profile_licences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile_licences` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` int unsigned NOT NULL,
  `licence_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `awarding_body` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `awarding_body_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completion_date` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_profile_licence_profile` (`profile_id`),
  CONSTRAINT `fk_profile_licence_profile` FOREIGN KEY (`profile_id`) REFERENCES `alumni_profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_licences`
--

LOCK TABLES `profile_licences` WRITE;
/*!40000 ALTER TABLE `profile_licences` DISABLE KEYS */;
/*!40000 ALTER TABLE `profile_licences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_short_courses`
--

DROP TABLE IF EXISTS `profile_short_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile_short_courses` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` int unsigned NOT NULL,
  `course_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completion_date` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_profile_short_course_profile` (`profile_id`),
  CONSTRAINT `fk_profile_short_course_profile` FOREIGN KEY (`profile_id`) REFERENCES `alumni_profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_short_courses`
--

LOCK TABLES `profile_short_courses` WRITE;
/*!40000 ALTER TABLE `profile_short_courses` DISABLE KEYS */;
INSERT INTO `profile_short_courses` VALUES (2,1,'Docker Fundamentals','Coursera','https://www.coursera.org/','2025-07-01','2026-05-06 15:29:48','2026-05-06 15:29:48'),(3,2,'React Basics','Meta','https://www.coursera.org/','2025-08-01','2026-05-06 15:29:48','2026-05-06 15:29:48'),(4,3,'Docker Fundamentals','Coursera','https://www.coursera.org/','2025-09-01','2026-05-06 15:29:48','2026-05-06 15:29:48');
/*!40000 ALTER TABLE `profile_short_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `university_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('alumnus','developer','client') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'alumnus',
  `is_email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `account_status` enum('active','inactive','suspended') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `last_login_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `university_email` (`university_email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'test1@iit.ac.lk','$2y$10$khUal5ZVBx1qoxn./MC9QOFlZ6dOD4N9KVr3VYNtHXMRzTCzjna7a','test1','test1','developer',1,'active','2026-05-06 21:01:31','2026-05-04 12:40:24','2026-05-07 00:31:31'),(2,'gajindu.20220183@iit.ac.lk','$2y$10$C1ndIBpRRbpiobJiHpemP.lhSvNn/6YW51dt8WbD5o1NKP7vDQUQu','gajindu','kaweeshwara','alumnus',1,'active','2026-05-06 21:21:06','2026-05-04 15:10:51','2026-05-07 00:51:06'),(3,'alumni1@iit.ac.lk','$2y$10$bRQRoqREgIjWUM05vc2EDuI4bNHrAiGeZZDSpUwBsQLKxdATsho92','alumni1','alum','alumnus',1,'active','2026-05-06 09:48:29','2026-05-04 16:21:48','2026-05-06 13:18:29'),(4,'alumni2@iit.ac.lk','$2y$10$hT0ctIB0lHYQkc8YiIiJoOPypqJu5rQii7zRAMDUHk/Xb1C77pC0e','alumni2','alum','alumnus',1,'active','2026-05-04 14:01:04','2026-05-04 16:39:02','2026-05-04 17:31:04'),(5,'client@iit.ac.lk','$2y$10$lnM9lCwKfApcWVbY5avBvumvb3Xm5ufrA3dJPclqw8d8d/hOegxzW','client','cl','client',1,'active','2026-05-06 21:06:43','2026-05-06 13:04:58','2026-05-07 00:36:43');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-07  8:53:47
