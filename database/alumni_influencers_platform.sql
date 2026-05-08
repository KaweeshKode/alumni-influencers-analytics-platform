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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumni_profiles`
--

LOCK TABLES `alumni_profiles` WRITE;
/*!40000 ALTER TABLE `alumni_profiles` DISABLE KEYS */;
INSERT INTO `alumni_profiles` VALUES (1,3,'0711111111','1999-04-12',2023,'Software Engineer','WSO2','Software Engineering','Colombo','Sri Lanka','Full-stack software engineer specialising in backend APIs and cloud services.','https://www.linkedin.com/in/amal-perera',NULL,'2026-05-07 14:59:06','2026-05-07 14:59:06'),(2,4,'0712222222','1998-08-20',2024,'Cybersecurity Analyst','Aion Cybersecurity','Cybersecurity','Colombo','Sri Lanka','Security analyst working on SOC monitoring, incident response, and vulnerability management.','https://www.linkedin.com/in/nimal-silva',NULL,'2026-05-07 14:59:06','2026-05-07 14:59:06'),(3,5,'0713333333','2000-01-15',2025,'Data Analyst','Dialog Axiata','Data Analytics','Kandy','Sri Lanka','Data analyst focused on dashboards, business intelligence, and customer analytics.','https://www.linkedin.com/in/ruwani-jayasinghe',NULL,'2026-05-07 14:59:06','2026-05-07 14:59:06'),(4,6,'0714444444','1997-11-03',2022,'Cloud Engineer','IFS','Cloud Computing','Galle','Sri Lanka','Cloud engineer working with containerised deployments and DevOps automation.','https://www.linkedin.com/in/kasun-fernando',NULL,'2026-05-07 14:59:06','2026-05-07 14:59:06'),(5,7,'0715555555','2001-02-18',2026,'UX Designer','Sysco LABS','UI/UX Design','Colombo','Sri Lanka','UX designer interested in user research, product design, and design systems.','https://www.linkedin.com/in/isuru-gunasekara',NULL,'2026-05-07 14:59:06','2026-05-07 14:59:06'),(6,8,'0716666666','1999-06-25',2024,'Business Analyst','Virtusa','Business Analysis','Gampaha','Sri Lanka','Business analyst bridging stakeholders, development teams, and software delivery.','https://www.linkedin.com/in/thilini-ekanayake',NULL,'2026-05-07 14:59:06','2026-05-07 14:59:06'),(7,9,'0717777777','1998-12-09',2023,'QA Automation Engineer','99x','Quality Assurance','Matara','Sri Lanka','QA automation engineer experienced in Selenium, API testing, and CI pipelines.','https://www.linkedin.com/in/dilshan-rathnayake',NULL,'2026-05-07 14:59:06','2026-05-07 14:59:06'),(8,10,'0718888888','2000-09-30',2025,'Machine Learning Engineer','Axiata Digital Labs','Artificial Intelligence','Jaffna','Sri Lanka','Machine learning engineer building predictive models and analytics prototypes.','https://www.linkedin.com/in/kavindi-wijesinghe',NULL,'2026-05-07 14:59:06','2026-05-07 14:59:06');
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
INSERT INTO `api_clients` VALUES (1,'Mobile AR App','mobile_ar_app','Client application for retrieving the Alumni Influencer of the Day.',1,'2026-05-07 15:07:47'),(2,'Analytics Dashboard','analytics_dashboard','Client application for alumni analytics and dashboard data.',1,'2026-05-07 15:07:47');
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
INSERT INTO `api_tokens` VALUES (1,1,1,'Demo Mobile AR Token','demo_mobile_','310f532e350966a93f243f58bf7511ff198311a01c8fffc396bca87941fe270f','[\"read:alumni_of_day\"]','2026-05-07 11:44:30','2026-08-05 15:07:58',NULL,1,'2026-05-07 15:07:58'),(2,1,2,'Demo Analytics Dashboard Token','demo_analyti','cb5e9f242c6372bfa0923bd1234e9b2a4e203f54be4cba9aea1bd9dd75ef16cb','[\"read:alumni\", \"read:analytics\"]','2026-05-07 11:46:11','2026-08-05 15:07:58',NULL,1,'2026-05-07 15:07:58');
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
INSERT INTO `api_usage_logs` VALUES (1,1,1,1,'http://localhost/practice/cw/index.php/api/featured-today','GET','127.0.0.1','PostmanRuntime Demo',200,'2026-05-07 15:11:14'),(2,2,2,1,'http://localhost/practice/cw/index.php/api/alumni','GET','127.0.0.1','PostmanRuntime Demo',200,'2026-05-07 15:11:14'),(3,2,2,1,'http://localhost/practice/cw/index.php/api/analytics-summary','GET','127.0.0.1','PostmanRuntime Demo',200,'2026-05-07 15:11:14'),(4,1,1,1,'http://localhost/practice/cw/index.php/api/analytics-summary','GET','127.0.0.1','PostmanRuntime Demo',403,'2026-05-07 15:11:14'),(5,2,2,1,'http://localhost/practice/cw/index.php/api/featured-today','GET','::1','PostmanRuntime/7.54.0',403,'2026-05-07 15:14:08'),(6,1,1,1,'http://localhost/practice/cw/index.php/api/featured-today','GET','::1','PostmanRuntime/7.54.0',200,'2026-05-07 15:14:30'),(7,2,2,1,'http://localhost/practice/cw/index.php/api/analytics-summary','GET','::1','PostmanRuntime/7.54.0',200,'2026-05-07 15:16:11'),(8,1,1,1,'http://localhost/practice/cw/index.php/api/analytics-summary','GET','::1','PostmanRuntime/7.54.0',403,'2026-05-07 15:16:24');
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
INSERT INTO `bid_notifications` VALUES (1,3,5,'winner','Congratulations! You won the featured alumni slot for today.',0,'2026-05-07 15:10:59'),(2,4,5,'loser','Your bid was not selected for today’s featured alumni slot.',0,'2026-05-07 15:10:59'),(3,3,6,'status_update','You are currently not winning tomorrow’s featured slot.',0,'2026-05-07 15:10:59'),(4,5,6,'status_update','You are currently winning tomorrow’s featured slot.',0,'2026-05-07 15:10:59'),(5,6,6,'status_update','You have reached the monthly featured limit for this month.',0,'2026-05-07 15:10:59');
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
INSERT INTO `bids` VALUES (1,5,3,150.00,'won','2026-05-07 15:10:50','2026-05-07 15:10:50'),(2,5,4,120.00,'lost','2026-05-07 15:10:50','2026-05-07 15:10:50'),(3,6,3,110.00,'losing','2026-05-07 15:10:50','2026-05-07 15:10:50'),(4,6,5,140.00,'winning','2026-05-07 15:10:50','2026-05-07 15:10:50');
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
INSERT INTO `ci_sessions` VALUES ('67cjkk9nq281daahhs7p9oq4q7iuu2ho','127.0.0.1',1778147579,_binary '__ci_last_regenerate|i:1778147534;user_id|s:1:\"2\";user_email|s:16:\"client@iit.ac.lk\";user_name|s:17:\"University Client\";user_role|s:6:\"client\";logged_in|b:1;'),('rvqbn6qntgilme6km24ivaife35m312b','::1',1778147184,_binary '__ci_last_regenerate|i:1778147048;');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_verification_tokens`
--

LOCK TABLES `email_verification_tokens` WRITE;
/*!40000 ALTER TABLE `email_verification_tokens` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `featured_alumni`
--

LOCK TABLES `featured_alumni` WRITE;
/*!40000 ALTER TABLE `featured_alumni` DISABLE KEYS */;
INSERT INTO `featured_alumni` VALUES (1,6,1,'2026-05-03','2026-05-07 15:10:55'),(2,6,2,'2026-05-04','2026-05-07 15:10:55'),(3,6,3,'2026-05-05','2026-05-07 15:10:55'),(4,4,4,'2026-05-06','2026-05-07 15:10:55'),(5,3,5,'2026-05-07','2026-05-07 15:10:55');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `featured_slots`
--

LOCK TABLES `featured_slots` WRITE;
/*!40000 ALTER TABLE `featured_slots` DISABLE KEYS */;
INSERT INTO `featured_slots` VALUES (1,'2026-05-03','awarded',6,NULL,'2026-05-03 15:03:01','2026-05-07 15:03:01','2026-05-07 15:03:01'),(2,'2026-05-04','awarded',6,NULL,'2026-05-04 15:03:01','2026-05-07 15:03:01','2026-05-07 15:03:01'),(3,'2026-05-05','awarded',6,NULL,'2026-05-05 15:03:01','2026-05-07 15:03:01','2026-05-07 15:03:01'),(4,'2026-05-06','awarded',4,NULL,'2026-05-06 15:03:01','2026-05-07 15:03:01','2026-05-07 15:03:01'),(5,'2026-05-07','awarded',3,1,'2026-05-07 15:03:01','2026-05-07 15:03:01','2026-05-07 15:03:01'),(6,'2026-05-08','open',NULL,NULL,NULL,'2026-05-07 15:03:01','2026-05-07 15:03:01');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_audit_logs`
--

LOCK TABLES `login_audit_logs` WRITE;
/*!40000 ALTER TABLE `login_audit_logs` DISABLE KEYS */;
INSERT INTO `login_audit_logs` VALUES (1,1,'developer@iit.ac.lk','127.0.0.1','Demo Browser','success',NULL,'2026-05-07 15:11:10'),(2,2,'client@iit.ac.lk','127.0.0.1','Demo Browser','success',NULL,'2026-05-07 15:11:10'),(3,3,'amal.perera@iit.ac.lk','127.0.0.1','Demo Browser','success',NULL,'2026-05-07 15:11:10'),(4,NULL,'wrong@gmail.com','127.0.0.1','Demo Browser','failed','Email not found','2026-05-07 15:11:10'),(5,1,'developer@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-07 15:18:48'),(6,2,'client@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','failed','Wrong password','2026-05-07 15:22:04'),(7,2,'client@iit.ac.lk','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0','success',NULL,'2026-05-07 15:22:14');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_certifications`
--

LOCK TABLES `profile_certifications` WRITE;
/*!40000 ALTER TABLE `profile_certifications` DISABLE KEYS */;
INSERT INTO `profile_certifications` VALUES (1,1,'AWS Cloud Practitioner','Amazon Web Services','https://aws.amazon.com/certification/','2024-03-10','2026-05-07 14:59:59','2026-05-07 14:59:59'),(2,2,'Cisco CyberOps Associate','Cisco','https://www.cisco.com/site/us/en/learn/training-certifications/certifications/cyberops/index.html','2024-04-12','2026-05-07 14:59:59','2026-05-07 14:59:59'),(3,3,'Google Data Analytics Certificate','Google','https://grow.google/certificates/data-analytics/','2025-02-20','2026-05-07 14:59:59','2026-05-07 14:59:59'),(4,4,'Microsoft Azure Fundamentals','Microsoft','https://learn.microsoft.com/en-us/credentials/certifications/azure-fundamentals/','2023-11-05','2026-05-07 14:59:59','2026-05-07 14:59:59'),(5,5,'Google UX Design Certificate','Google','https://grow.google/certificates/ux-design/','2025-05-18','2026-05-07 14:59:59','2026-05-07 14:59:59'),(6,6,'Professional Scrum Master I','Scrum.org','https://www.scrum.org/assessments/professional-scrum-master-i-certification','2024-06-02','2026-05-07 14:59:59','2026-05-07 14:59:59'),(7,7,'ISTQB Foundation Level','ISTQB','https://www.istqb.org/certifications/certified-tester-foundation-level','2023-09-14','2026-05-07 14:59:59','2026-05-07 14:59:59'),(8,8,'TensorFlow Developer Certificate','TensorFlow','https://www.tensorflow.org/certificate','2025-01-28','2026-05-07 14:59:59','2026-05-07 14:59:59'),(9,1,'Docker Certified Associate','Docker','https://www.docker.com/certification/','2024-09-19','2026-05-07 14:59:59','2026-05-07 14:59:59'),(10,4,'AWS Solutions Architect Associate','Amazon Web Services','https://aws.amazon.com/certification/','2024-08-01','2026-05-07 14:59:59','2026-05-07 14:59:59');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_degrees`
--

LOCK TABLES `profile_degrees` WRITE;
/*!40000 ALTER TABLE `profile_degrees` DISABLE KEYS */;
INSERT INTO `profile_degrees` VALUES (1,1,'BSc Computer Science','IIT / University of Westminster','https://www.westminster.ac.uk/computer-science','2023-07-15','2026-05-07 14:59:38','2026-05-07 14:59:38'),(2,2,'BSc Cyber Security','IIT / University of Westminster','https://www.westminster.ac.uk/cyber-security','2024-07-15','2026-05-07 14:59:38','2026-05-07 14:59:38'),(3,3,'BSc Data Science and Analytics','IIT / University of Westminster','https://www.westminster.ac.uk/data-science','2025-07-15','2026-05-07 14:59:38','2026-05-07 14:59:38'),(4,4,'BEng Software Engineering','IIT / University of Westminster','https://www.westminster.ac.uk/software-engineering','2022-07-15','2026-05-07 14:59:38','2026-05-07 14:59:38'),(5,5,'BSc Computer Science','IIT / University of Westminster','https://www.westminster.ac.uk/computer-science','2026-07-15','2026-05-07 14:59:38','2026-05-07 14:59:38'),(6,6,'BSc Business Information Systems','IIT / University of Westminster','https://www.westminster.ac.uk/business-information-systems','2024-07-15','2026-05-07 14:59:38','2026-05-07 14:59:38'),(7,7,'BEng Software Engineering','IIT / University of Westminster','https://www.westminster.ac.uk/software-engineering','2023-07-15','2026-05-07 14:59:38','2026-05-07 14:59:38'),(8,8,'BSc Data Science and Analytics','IIT / University of Westminster','https://www.westminster.ac.uk/data-science','2025-07-15','2026-05-07 14:59:38','2026-05-07 14:59:38');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_employment_history`
--

LOCK TABLES `profile_employment_history` WRITE;
/*!40000 ALTER TABLE `profile_employment_history` DISABLE KEYS */;
INSERT INTO `profile_employment_history` VALUES (1,1,'Software Engineer','WSO2','2023-08-01',NULL,1,'Develops REST APIs and backend services for enterprise platforms.','2026-05-07 15:00:34','2026-05-07 15:00:34'),(2,2,'Cybersecurity Analyst','Aion Cybersecurity','2024-08-01',NULL,1,'Monitors SOC alerts and supports vulnerability assessments.','2026-05-07 15:00:34','2026-05-07 15:00:34'),(3,3,'Data Analyst','Dialog Axiata','2025-08-01',NULL,1,'Builds dashboards and customer analytics reports.','2026-05-07 15:00:34','2026-05-07 15:00:34'),(4,4,'Cloud Engineer','IFS','2022-09-01',NULL,1,'Maintains cloud infrastructure, containers, and deployment automation.','2026-05-07 15:00:34','2026-05-07 15:00:34'),(5,5,'UX Design Intern','Sysco LABS','2026-01-10',NULL,1,'Supports user research, wireframing, and interface design.','2026-05-07 15:00:34','2026-05-07 15:00:34'),(6,6,'Business Analyst','Virtusa','2024-09-01',NULL,1,'Works with stakeholders to document requirements and user stories.','2026-05-07 15:00:34','2026-05-07 15:00:34'),(7,7,'QA Automation Engineer','99x','2023-09-01',NULL,1,'Automates regression testing and API testing workflows.','2026-05-07 15:00:34','2026-05-07 15:00:34'),(8,8,'Machine Learning Engineer','Axiata Digital Labs','2025-09-01',NULL,1,'Builds predictive models and analytics prototypes.','2026-05-07 15:00:34','2026-05-07 15:00:34');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_licences`
--

LOCK TABLES `profile_licences` WRITE;
/*!40000 ALTER TABLE `profile_licences` DISABLE KEYS */;
INSERT INTO `profile_licences` VALUES (1,2,'Certified Ethical Hacker Preparation Licence','EC-Council','https://www.eccouncil.org/','2024-05-01','2026-05-07 15:00:04','2026-05-07 15:00:04'),(2,4,'Azure Administrator Associate Preparation Licence','Microsoft','https://learn.microsoft.com/','2024-04-18','2026-05-07 15:00:04','2026-05-07 15:00:04'),(3,6,'Business Analysis Practitioner Licence','BCS','https://www.bcs.org/','2024-07-22','2026-05-07 15:00:04','2026-05-07 15:00:04'),(4,7,'Software Testing Practitioner Licence','ISTQB','https://www.istqb.org/','2023-10-20','2026-05-07 15:00:04','2026-05-07 15:00:04'),(5,8,'AI Engineering Practitioner Licence','IBM SkillsBuild','https://skillsbuild.org/','2025-03-12','2026-05-07 15:00:04','2026-05-07 15:00:04');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_short_courses`
--

LOCK TABLES `profile_short_courses` WRITE;
/*!40000 ALTER TABLE `profile_short_courses` DISABLE KEYS */;
INSERT INTO `profile_short_courses` VALUES (1,1,'Docker Fundamentals','Coursera','https://www.coursera.org/','2024-01-12','2026-05-07 15:00:12','2026-05-07 15:00:12'),(2,1,'Laravel API Development','Udemy','https://www.udemy.com/','2024-02-16','2026-05-07 15:00:12','2026-05-07 15:00:12'),(3,2,'SOC Analyst Fundamentals','TryHackMe','https://tryhackme.com/','2024-02-22','2026-05-07 15:00:12','2026-05-07 15:00:12'),(4,3,'Power BI Dashboards','Microsoft Learn','https://learn.microsoft.com/','2025-04-01','2026-05-07 15:00:12','2026-05-07 15:00:12'),(5,3,'Python for Data Analysis','Coursera','https://www.coursera.org/','2024-12-10','2026-05-07 15:00:12','2026-05-07 15:00:12'),(6,4,'Kubernetes Basics','Google Cloud Skills Boost','https://www.cloudskillsboost.google/','2024-06-15','2026-05-07 15:00:12','2026-05-07 15:00:12'),(7,5,'Figma UI Design','Udemy','https://www.udemy.com/','2025-03-25','2026-05-07 15:00:12','2026-05-07 15:00:12'),(8,6,'Agile Requirements Engineering','LinkedIn Learning','https://www.linkedin.com/learning/','2024-05-13','2026-05-07 15:00:12','2026-05-07 15:00:12'),(9,7,'Selenium WebDriver Automation','Udemy','https://www.udemy.com/','2024-01-26','2026-05-07 15:00:12','2026-05-07 15:00:12'),(10,8,'Machine Learning with Python','Coursera','https://www.coursera.org/','2025-02-08','2026-05-07 15:00:12','2026-05-07 15:00:12'),(11,8,'MLOps Fundamentals','DataCamp','https://www.datacamp.com/','2025-05-05','2026-05-07 15:00:12','2026-05-07 15:00:12');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'developer@iit.ac.lk','$2y$12$i3cYsPCvVmOzhL.yl8ba9ujCjOvggrT6Pdagj7p6PRJYzjaLK2V0G','Dev','User','developer',1,'active','2026-05-07 11:48:48','2026-05-07 14:58:15','2026-05-07 15:18:48'),(2,'client@iit.ac.lk','$2y$12$i3cYsPCvVmOzhL.yl8ba9ujCjOvggrT6Pdagj7p6PRJYzjaLK2V0G','University','Client','client',1,'active','2026-05-07 11:52:14','2026-05-07 14:58:15','2026-05-07 15:22:14'),(3,'amal.perera@iit.ac.lk','$2y$12$i3cYsPCvVmOzhL.yl8ba9ujCjOvggrT6Pdagj7p6PRJYzjaLK2V0G','Amal','Perera','alumnus',1,'active',NULL,'2026-05-07 14:58:15','2026-05-07 14:58:15'),(4,'nimal.silva@iit.ac.lk','$2y$12$i3cYsPCvVmOzhL.yl8ba9ujCjOvggrT6Pdagj7p6PRJYzjaLK2V0G','Nimal','Silva','alumnus',1,'active',NULL,'2026-05-07 14:58:15','2026-05-07 14:58:15'),(5,'ruwani.jayasinghe@iit.ac.lk','$2y$12$i3cYsPCvVmOzhL.yl8ba9ujCjOvggrT6Pdagj7p6PRJYzjaLK2V0G','Ruwani','Jayasinghe','alumnus',1,'active',NULL,'2026-05-07 14:58:15','2026-05-07 14:58:15'),(6,'kasun.fernando@iit.ac.lk','$2y$12$i3cYsPCvVmOzhL.yl8ba9ujCjOvggrT6Pdagj7p6PRJYzjaLK2V0G','Kasun','Fernando','alumnus',1,'active',NULL,'2026-05-07 14:58:15','2026-05-07 14:58:15'),(7,'isuru.gunasekara@iit.ac.lk','$2y$12$i3cYsPCvVmOzhL.yl8ba9ujCjOvggrT6Pdagj7p6PRJYzjaLK2V0G','Isuru','Gunasekara','alumnus',1,'active',NULL,'2026-05-07 14:58:15','2026-05-07 14:58:15'),(8,'thilini.ekanayake@iit.ac.lk','$2y$12$i3cYsPCvVmOzhL.yl8ba9ujCjOvggrT6Pdagj7p6PRJYzjaLK2V0G','Thilini','Ekanayake','alumnus',1,'active',NULL,'2026-05-07 14:58:15','2026-05-07 14:58:15'),(9,'dilshan.rathnayake@iit.ac.lk','$2y$12$i3cYsPCvVmOzhL.yl8ba9ujCjOvggrT6Pdagj7p6PRJYzjaLK2V0G','Dilshan','Rathnayake','alumnus',1,'active',NULL,'2026-05-07 14:58:15','2026-05-07 14:58:15'),(10,'kavindi.wijesinghe@iit.ac.lk','$2y$12$i3cYsPCvVmOzhL.yl8ba9ujCjOvggrT6Pdagj7p6PRJYzjaLK2V0G','Kavindi','Wijesinghe','alumnus',1,'active',NULL,'2026-05-07 14:58:15','2026-05-07 14:58:15');
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

-- Dump completed on 2026-05-07 15:25:27
