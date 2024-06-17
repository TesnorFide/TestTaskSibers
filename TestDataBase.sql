-- MySQL dump 10.13  Distrib 5.7.27-30, for Linux (x86_64)
--
-- Host: localhost    Database: u2239489_test
-- ------------------------------------------------------
-- Server version	5.7.27-30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*!50717 SELECT COUNT(*) INTO @rocksdb_has_p_s_session_variables FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'performance_schema' AND TABLE_NAME = 'session_variables' */;
/*!50717 SET @rocksdb_get_is_supported = IF (@rocksdb_has_p_s_session_variables, 'SELECT COUNT(*) INTO @rocksdb_is_supported FROM performance_schema.session_variables WHERE VARIABLE_NAME=\'rocksdb_bulk_load\'', 'SELECT 0') */;
/*!50717 PREPARE s FROM @rocksdb_get_is_supported */;
/*!50717 EXECUTE s */;
/*!50717 DEALLOCATE PREPARE s */;
/*!50717 SET @rocksdb_enable_bulk_load = IF (@rocksdb_is_supported, 'SET SESSION rocksdb_bulk_load = 1', 'SET @rocksdb_dummy_bulk_load = 0') */;
/*!50717 PREPARE s FROM @rocksdb_enable_bulk_load */;
/*!50717 EXECUTE s */;
/*!50717 DEALLOCATE PREPARE s */;

--
-- Table structure for table `userSibers`
--

DROP TABLE IF EXISTS `userSibers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userSibers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` text NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL,
  `lastname` text NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `dob` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`(20))
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userSibers`
--

LOCK TABLES `userSibers` WRITE;
/*!40000 ALTER TABLE `userSibers` DISABLE KEYS */;
INSERT INTO `userSibers` VALUES (0,'admin','12345','John','Cena',0,'1977-04-23'),(49,'login612','password695','name833','lastname83',0,'2024-06-18'),(50,'login991','password476','name971','lastname911',1,'2024-06-18'),(51,'login262','password421','name318','lastname292',1,'2024-06-18'),(52,'login355','password660','name302','lastname774',0,'2024-06-18'),(53,'login548','password862','name39','lastname453',1,'2024-06-18'),(54,'login274','password252','name810','lastname617',1,'2024-06-18'),(55,'login694','password186','name664','lastname756',1,'2024-06-18'),(56,'login486','password904','name865','lastname552',0,'2024-06-18'),(57,'login989','password990','name852','lastname73',0,'2024-06-18'),(58,'login285','password715','name608','lastname171',1,'2024-06-18'),(59,'login879','password324','name743','lastname60',1,'2024-06-18'),(60,'login350','password10','name131','lastname773',0,'2024-06-18'),(61,'login710','password650','name689','lastname221',0,'2024-06-18'),(62,'login826','password29','name950','lastname37',1,'2024-06-18'),(63,'login905','password903','name866','lastname339',1,'2024-06-18'),(64,'login862','password464','name983','lastname404',1,'2024-06-18'),(65,'login838','password397','name564','lastname188',1,'2024-06-18'),(66,'login684','password929','name763','lastname509',0,'2024-06-18'),(67,'login16','password175','name875','lastname745',0,'2024-06-18'),(68,'login182','password196','name618','lastname966',0,'2024-06-18'),(69,'login666','password297','name671','lastname239',1,'2024-06-18'),(70,'login443','password34','name559','lastname647',0,'2024-06-18'),(71,'login77','password468','name95','lastname515',1,'2024-06-18'),(72,'login824','password205','name571','lastname275',1,'2024-06-18');
/*!40000 ALTER TABLE `userSibers` ENABLE KEYS */;
UNLOCK TABLES;
/*!50112 SET @disable_bulk_load = IF (@is_rocksdb_supported, 'SET SESSION rocksdb_bulk_load = @old_rocksdb_bulk_load', 'SET @dummy_rocksdb_bulk_load = 0') */;
/*!50112 PREPARE s FROM @disable_bulk_load */;
/*!50112 EXECUTE s */;
/*!50112 DEALLOCATE PREPARE s */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-17 23:17:48
