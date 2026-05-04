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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumni_profiles`
--

LOCK TABLES `alumni_profiles` WRITE;
/*!40000 ALTER TABLE `alumni_profiles` DISABLE KEYS */;
INSERT INTO `alumni_profiles` VALUES (1,1,'0764852249','1999-07-31',2026,'Software Engineer','IFS','IT','Kalutara','Sri Lanka','Height is 5ft.','https://www.linkedin.com/pulse/fake-linkedin-profiles-paul-simiyu','b900a95788ac9f41aff3d5817585022a.png','2026-03-31 16:42:36','2026-03-31 16:45:02');
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
INSERT INTO `api_clients` VALUES (1,'Analytics Dashboard','analytics_dashboard','University analytics dashboard client',1,'2026-04-05 07:50:24'),(2,'Mobile AR App','mobile_ar_app','Mobile AR application client',1,'2026-04-05 07:50:24');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api_tokens`
--

LOCK TABLES `api_tokens` WRITE;
/*!40000 ALTER TABLE `api_tokens` DISABLE KEYS */;
INSERT INTO `api_tokens` VALUES (1,1,1,'testing','f5fc4c9d4cde','80705334ea018bead93d22f6e7310807194da6e1205dba4b1e70723e91af9f15','[\"read:alumni\", \"read:analytics\"]','2026-04-05 06:57:59','2026-07-04 05:15:22',NULL,1,'2026-04-05 08:45:22'),(2,1,2,'mobile test','4cd5078ee93c','514776598fc4802a481972d058a8cb497385e843ff358baa1e5bdf96c151fa52','[\"read:alumni_of_day\"]','2026-04-05 06:49:47','2026-07-04 05:43:13','2026-04-05 06:57:08',0,'2026-04-05 09:13:13');
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api_usage_logs`
--

LOCK TABLES `api_usage_logs` WRITE;
/*!40000 ALTER TABLE `api_usage_logs` DISABLE KEYS */;
INSERT INTO `api_usage_logs` VALUES (1,2,2,1,'http://localhost/practice/cw/index.php/api/featured-today','GET','::1','PostmanRuntime/7.52.0',404,'2026-04-05 09:28:38'),(2,2,2,1,'http://localhost/practice/cw/index.php/api/featured-today','GET','::1','PostmanRuntime/7.52.0',404,'2026-04-05 09:28:58'),(3,2,2,1,'http://localhost/practice/cw/index.php/api/featured-today','GET','::1','PostmanRuntime/7.52.0',404,'2026-04-05 09:39:18'),(4,2,2,1,'http://localhost/practice/cw/index.php/Api/featured-today','GET','::1','PostmanRuntime/7.52.0',404,'2026-04-05 09:45:41'),(5,2,2,1,'http://localhost/practice/cw/index.php/Api/featured-today','GET','::1','PostmanRuntime/7.52.0',404,'2026-04-05 09:45:43'),(6,2,2,1,'http://localhost/practice/cw/index.php/api/featured-today','GET','::1','PostmanRuntime/7.52.0',404,'2026-04-05 09:45:50'),(7,1,1,1,'http://localhost/practice/cw/index.php/api/alumni','GET','::1','PostmanRuntime/7.52.0',200,'2026-04-05 09:48:22'),(8,1,1,1,'http://localhost/practice/cw/index.php/api/alumni','GET','::1','PostmanRuntime/7.52.0',200,'2026-04-05 09:48:34'),(9,2,2,1,'http://localhost/practice/cw/index.php/api/featured-today','GET','::1','PostmanRuntime/7.52.0',404,'2026-04-05 09:48:45'),(10,2,2,1,'http://localhost/practice/cw/index.php/Api/featured_today','GET','::1','PostmanRuntime/7.52.0',404,'2026-04-05 09:55:47'),(11,2,2,1,'http://localhost/practice/cw/index.php/api/featured-today','GET','::1','PostmanRuntime/7.52.0',404,'2026-04-05 10:03:07'),(12,1,1,1,'http://localhost/practice/cw/index.php/api/alumni','GET','::1','PostmanRuntime/7.52.0',200,'2026-04-05 10:03:26'),(13,1,1,1,'http://localhost/practice/cw/index.php/api/analytics-summary','GET','::1','PostmanRuntime/7.52.0',200,'2026-04-05 10:08:31'),(14,2,2,1,'http://localhost/practice/cw/index.php/api/featured-today','GET','::1','PostmanRuntime/7.52.0',404,'2026-04-05 10:19:47'),(15,2,2,1,'http://localhost/practice/cw/index.php/api/alumni','GET','::1','PostmanRuntime/7.52.0',403,'2026-04-05 10:26:21'),(16,1,1,1,'http://localhost/practice/cw/index.php/api/featured-today','GET','::1','PostmanRuntime/7.52.0',403,'2026-04-05 10:26:36'),(17,1,1,1,'http://localhost/practice/cw/index.php/api/alumni','GET','::1','PostmanRuntime/7.52.0',200,'2026-04-05 10:27:55'),(18,1,1,1,'http://localhost/practice/cw/index.php/api/analytics-summary','GET','::1','PostmanRuntime/7.52.0',200,'2026-04-05 10:27:59');
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bid_notifications`
--

LOCK TABLES `bid_notifications` WRITE;
/*!40000 ALTER TABLE `bid_notifications` DISABLE KEYS */;
INSERT INTO `bid_notifications` VALUES (1,1,1,'status_update','You are currently winning this slot.',0,'2026-04-04 10:06:28'),(2,1,1,'status_update','You are currently winning this slot.',0,'2026-04-04 10:07:48'),(3,2,1,'status_update','You are currently losing this slot.',0,'2026-04-04 11:55:29'),(4,2,1,'status_update','You are currently losing this slot.',0,'2026-04-04 11:55:56'),(5,2,1,'status_update','You are currently winning this slot.',0,'2026-04-04 11:56:12'),(6,1,1,'status_update','You are currently winning this slot.',0,'2026-04-04 11:56:47'),(7,2,1,'status_update','You are currently losing this slot.',0,'2026-04-04 11:56:54'),(8,2,1,'status_update','You are currently losing this slot.',0,'2026-04-04 13:07:37'),(9,1,1,'winner','Congratulations! You won the featured alumni slot for 2026-04-04.',0,'2026-04-04 14:13:52'),(10,2,1,'loser','Your bid was not selected for the featured alumni slot on 2026-04-04.',0,'2026-04-04 14:13:52'),(11,1,1,'status_update','You are currently winning this slot.',0,'2026-04-04 14:30:27'),(12,2,1,'status_update','You are currently losing this slot.',0,'2026-04-04 14:30:39'),(13,1,1,'status_update','You are currently winning this slot.',0,'2026-04-04 16:11:01'),(14,2,1,'status_update','You are currently winning this slot.',0,'2026-04-04 16:11:24'),(15,2,1,'winner','Congratulations! You won the featured alumni slot for 2026-04-04.',0,'2026-04-04 16:11:43'),(16,1,1,'loser','Your bid was not selected for the featured alumni slot on 2026-04-04.',0,'2026-04-04 16:11:43');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bids`
--

LOCK TABLES `bids` WRITE;
/*!40000 ALTER TABLE `bids` DISABLE KEYS */;
INSERT INTO `bids` VALUES (3,1,1,100.00,'lost','2026-04-04 16:11:01','2026-04-04 16:11:43'),(4,1,2,150.00,'won','2026-04-04 16:11:24','2026-04-04 16:11:43');
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
INSERT INTO `ci_sessions` VALUES ('cs7f19chdafevetnmkaoghv4p36a6k89','127.0.0.1',1775366247,_binary '__ci_last_regenerate|i:1775366246;user_id|s:1:\"1\";user_email|s:15:\"kamal@iit.ac.lk\";user_name|s:12:\"Kamal Kumara\";logged_in|b:1;'),('dghj76bogq5gm5tbq1cgbou0qanj31v7','::1',1775365079,_binary '__ci_last_regenerate|i:1775364981;'),('farmlrcpbh8pd1lvc613122gs7ojt64k','127.0.0.1',1775358978,_binary '__ci_last_regenerate|i:1775358968;user_id|s:1:\"2\";user_email|s:17:\"ravindu@iit.ac.lk\";user_name|s:18:\"Ravindu Nidarshana\";logged_in|b:1;'),('g1bvi9drv3gqdeopn6fe7qoo2hd78gsd','127.0.0.1',1777389708,_binary '__ci_last_regenerate|i:1777389687;'),('ltsm8q1gr30tlrnl23ell0rqbq57rbcl','127.0.0.1',1775409364,_binary '__ci_last_regenerate|i:1775409364;'),('ngfc70p6ol3980nus0len59ssm8l45in','127.0.0.1',1775409357,_binary '__ci_last_regenerate|i:1775409354;');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_verification_tokens`
--

LOCK TABLES `email_verification_tokens` WRITE;
/*!40000 ALTER TABLE `email_verification_tokens` DISABLE KEYS */;
INSERT INTO `email_verification_tokens` VALUES (1,1,'3c5f4425d9354e3d009d18b2ff957823fd1cc1db0e4b7c93e8a61b781bbd53fe','2026-04-01 10:42:31','2026-03-31 10:46:24','2026-03-31 14:12:31'),(2,2,'907d22b258ddf61985a3d819d7a8090594c8bb4076eb42f46391ef3c01dc6a8b','2026-04-05 08:24:17','2026-04-04 08:24:24','2026-04-04 11:54:17');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `featured_alumni`
--

LOCK TABLES `featured_alumni` WRITE;
/*!40000 ALTER TABLE `featured_alumni` DISABLE KEYS */;
INSERT INTO `featured_alumni` VALUES (2,2,1,'2026-04-04','2026-04-04 16:11:43');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `featured_slots`
--

LOCK TABLES `featured_slots` WRITE;
/*!40000 ALTER TABLE `featured_slots` DISABLE KEYS */;
INSERT INTO `featured_slots` VALUES (1,'2026-04-04','awarded',2,4,'2026-04-04 12:41:43','2026-04-04 10:06:17','2026-04-04 16:11:43');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_audit_logs`
--

LOCK TABLES `login_audit_logs` WRITE;
/*!40000 ALTER TABLE `login_audit_logs` DISABLE KEYS */;
INSERT INTO `login_audit_logs` VALUES (1,1,'kamal@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0','success',NULL,'2026-03-31 14:22:35'),(2,1,'kamal@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0','failed','Wrong password','2026-03-31 14:23:13'),(3,1,'kamal@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0','success',NULL,'2026-03-31 14:23:33'),(4,1,'kamal@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0','failed','Wrong password','2026-03-31 14:26:27'),(5,1,'kamal@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0','success',NULL,'2026-03-31 14:26:33'),(6,1,'kamal@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0','success',NULL,'2026-03-31 14:36:28'),(7,1,'kamal@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0','success',NULL,'2026-03-31 16:40:47'),(8,1,'kamal@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0','success',NULL,'2026-04-04 09:45:09'),(9,2,'ravindu@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0','success',NULL,'2026-04-04 11:54:48'),(10,1,'kamal@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0','success',NULL,'2026-04-05 07:57:12'),(11,2,'ravindu@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0','success',NULL,'2026-04-05 07:57:32');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
INSERT INTO `password_reset_tokens` VALUES (1,1,'6f38157bfcb97359a828c944614b88be1c0152cd869d470d9f244411e4e607de','2026-03-31 11:55:12','2026-03-31 10:55:51','2026-03-31 14:25:12');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_certifications`
--

LOCK TABLES `profile_certifications` WRITE;
/*!40000 ALTER TABLE `profile_certifications` DISABLE KEYS */;
INSERT INTO `profile_certifications` VALUES (1,1,'AWS','AWC Classroom','https://aws-certificates.com','2026-03-18','2026-03-31 18:15:22','2026-03-31 18:15:22'),(2,1,'Azure','Azure Classroom','https://azure-certificate.com','2026-02-22','2026-03-31 18:16:03','2026-03-31 18:16:14');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_degrees`
--

LOCK TABLES `profile_degrees` WRITE;
/*!40000 ALTER TABLE `profile_degrees` DISABLE KEYS */;
INSERT INTO `profile_degrees` VALUES (1,1,'CS','UOW','https://www.uow-cs-details.com','2024-03-13','2026-03-31 17:17:41','2026-03-31 17:17:41'),(2,1,'SE','UOW','https://www.uow-se-details.com','2020-05-21','2026-03-31 17:18:31','2026-03-31 17:18:31');
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
INSERT INTO `profile_employment_history` VALUES (1,1,'Intern Software Engineer','SimplyFy Labs LK','2025-02-10','2025-07-31',0,'Work as a Mobile Developer | React Native','2026-03-31 18:20:36','2026-03-31 18:20:36');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_licences`
--

LOCK TABLES `profile_licences` WRITE;
/*!40000 ALTER TABLE `profile_licences` DISABLE KEYS */;
INSERT INTO `profile_licences` VALUES (1,1,'Ethical Hacker','Cisco','http://cisco-ehc.com','2025-10-14','2026-03-31 18:18:10','2026-03-31 18:18:10'),(2,1,'IT Essentials','Cisco','http://cisco-itessen.com','2025-10-22','2026-03-31 18:18:42','2026-03-31 18:18:42');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_short_courses`
--

LOCK TABLES `profile_short_courses` WRITE;
/*!40000 ALTER TABLE `profile_short_courses` DISABLE KEYS */;
INSERT INTO `profile_short_courses` VALUES (1,1,'Full Stack Development','iCET','http://icet-full-stack-dev.com','2025-07-30','2026-03-31 18:19:27','2026-03-31 18:19:27');
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
  `is_email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `account_status` enum('active','inactive','suspended') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `last_login_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `university_email` (`university_email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'kamal@iit.ac.lk','$2y$10$ai24uNE0DKuVcm4y66bnfu2l8GbOc5NT2DWJQqbgcgkmyIOIx8dJm','Kamal','Kumara',1,'active','2026-04-05 04:27:12','2026-03-31 14:12:31','2026-04-05 07:57:12'),(2,'ravindu@iit.ac.lk','$2y$10$0cJ88PN5gLptXKk3jfCsp.hZpjmLs66517DPcTyfpGNPythUr1l6i','Ravindu','Nidarshana',1,'active','2026-04-05 04:27:32','2026-04-04 11:54:17','2026-04-05 07:57:32');
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

-- Dump completed on 2026-05-04  9:40:47
