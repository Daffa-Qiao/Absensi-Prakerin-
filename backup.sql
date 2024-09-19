-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: ci4
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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

--
-- Table structure for table `absensi`
--

DROP TABLE IF EXISTS `absensi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `absensi` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nim_nis` varchar(25) NOT NULL,
  `jenis_user` varchar(100) DEFAULT NULL,
  `instansi_pendidikan` varchar(25) NOT NULL,
  `nama_instansi` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `checkin_time` varchar(25) NOT NULL,
  `checkout_time` varchar(25) DEFAULT NULL,
  `foto_profile` varchar(255) NOT NULL,
  `foto_absen` varchar(50) NOT NULL,
  `waktu_absen` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=925 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `absensi`
--

LOCK TABLES `absensi` WRITE;
/*!40000 ALTER TABLE `absensi` DISABLE KEYS */;
INSERT INTO `absensi` VALUES (918,'Bagoes Sholeh','','2214312221','Student','School','SMKN 1 KOTA BEKASI','Izin','asdad',NULL,'13:52',NULL,'profile.png','2024.07.25 - 13.56.34.jpeg','2024-07-25'),(920,'Daffa Reivan','','141141','Student','School','SMKN 1 KOTA BEKASI','Masuk','',NULL,'10:01',NULL,'profile.png','2024.09.09 - 10.01.41.jpeg','2024-09-09'),(921,'Bagoes Sholeh','','2214312221','Student','School','SMKN 1 KOTA BEKASI','Izin','pulang',NULL,'10:02',NULL,'profile.png','2024.09.09 - 10.03.02.jpeg','2024-09-09'),(922,'Bagoes Sholeh','','2214312221','Student','School','SMKN 1 KOTA BEKASI','Sakit','SAKIT PUSING',NULL,'10:42',NULL,'profile.png','2024.09.09 - 10.42.42.jpeg','2024-09-09'),(923,'Bagoes Sholeh','','2214312221','Student','School','SMKN 1 KOTA BEKASI','Alpa','cabut',NULL,'10:58',NULL,'profile.png','2024.09.09 - 10.58.36.jpeg','2024-09-09'),(924,'Bagoes Sholeh','','2214312221','Student','School','SMKN 1 KOTA BEKASI','Masuk','',NULL,'11:06',NULL,'profile.png','2024.09.09 - 11.06.43.jpeg','2024-09-09');
/*!40000 ALTER TABLE `absensi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instansi`
--

DROP TABLE IF EXISTS `instansi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instansi` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nama_instansi` varchar(255) NOT NULL,
  `foto_instansi` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instansi`
--

LOCK TABLES `instansi` WRITE;
/*!40000 ALTER TABLE `instansi` DISABLE KEYS */;
INSERT INTO `instansi` VALUES (1,'SMK BINA MANDIRI','2023.12.28 - 08.44.10.jpeg'),(2,'SMKN 2 JAKARTA','2023.12.28 - 08.44.44.jpeg'),(3,'UNIVERSITAS TERBUKA','2023.12.28 - 08.45.22.jpeg'),(4,'UNIVERSITAS BINA SARANA INFORMATIKA','2024.01.18 - 16.29.01.jpeg'),(5,'PERGURUAN TINGGI NEGARA KEMENHUB','2023.12.28 - 08.48.31.jpeg'),(6,'SMK TRIMULIA','2024.01.02 - 10.22.34.jpeg'),(7,'SMKN 2 JKT48','2024.01.02 - 12.48.18.jpeg'),(8,'UNIVERSITAS NEGERI JAKARTA','2024.01.18 - 16.26.48.jpeg'),(9,'UNIVERSITAS BINA NUSANTARA','2024.03.01 - 15.46.34.jpeg'),(10,'SMK MUHAMMADIYAH 4 JAKARTA','2024.03.01 - 15.48.36.jpeg');
/*!40000 ALTER TABLE `instansi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laporan`
--

DROP TABLE IF EXISTS `laporan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laporan` (
  `id_laporan` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nim_nis` varchar(25) NOT NULL,
  `jenis_user` varchar(100) DEFAULT NULL,
  `instansi_pendidikan` varchar(25) NOT NULL,
  `nama_instansi` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `kegiatan` text NOT NULL,
  `foto_profile` varchar(255) NOT NULL,
  `waktu_laporan` date NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `member_id` int(5) NOT NULL,
  PRIMARY KEY (`id_laporan`),
  KEY `userLaporan` (`member_id`),
  CONSTRAINT `userLaporan` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laporan`
--

LOCK TABLES `laporan` WRITE;
/*!40000 ALTER TABLE `laporan` DISABLE KEYS */;
/*!40000 ALTER TABLE `laporan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member` (
  `member_id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nim_nis` varchar(20) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Male','Female') NOT NULL,
  `jenis_user` varchar(100) DEFAULT NULL,
  `instansi_pendidikan` varchar(255) NOT NULL COMMENT 'Student/College Student',
  `nama_instansi` varchar(255) NOT NULL,
  `level` enum('Super Admin','Admin','User') DEFAULT 'User',
  `token` varchar(255) DEFAULT NULL,
  `is_verifikasi` enum('yes','no','pending') NOT NULL DEFAULT 'no',
  `tanggal_bergabung` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nama_pembimbing` varchar(255) NOT NULL,
  `no_pembimbing` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Good',
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES (39,'daffa.reivan','12345678','daffa.sweet100@gmail.com','Daffa Reivan','141141','085894861350','profile.png','Male','Student','School','SMKN 1 KOTA BEKASI','Super Admin',NULL,'yes','2024-07-15','2024-07-25 07:06:26','Chelsea Ramadhani','085714108993','Written Agreement'),(54,'bagoes','12345678','bagoessholehm.s.n@gmail.com','Bagoes Sholeh','2214312221','085714108993','profile.png','Male','Student','School','SMKN 1 KOTA BEKASI','Admin',NULL,'yes','2024-07-16','2024-07-25 08:14:41','Dela Chaerani','081290624643','Terminated'),(55,'celsi','12345678','chelsearamadhani@gmail.com','Chelsea Ramadhani','12222222','087872825833','profile.png','Female','Student','School','SMKD1','User',NULL,'yes','2024-07-16','2024-07-25 07:03:58','','','Written Agreement'),(56,'sdsjj','12345678','sssa@gmail.com','Nur Aini','2214312','081290624643','profile.png','Female','Student','School','SMK SSDD','User',NULL,'yes','2024-07-16','2024-07-16 04:17:16','','','Good'),(57,'sds','12345678','chelsearamadhani91@gmail.com','Chelsea Ramadhani','2214315','085714108997','profile.png','Female','Student','School','SMKN 1 KOTA BEKASI','User',NULL,'yes','2024-07-18','2024-07-25 07:04:25','','','Terminated'),(58,'','','','','','','','Male',NULL,'','','User',NULL,'no','2024-07-25','2024-07-25 06:29:59','','','Good');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trigger_insert` BEFORE INSERT ON `member` FOR EACH ROW BEGIN
	IF NEW.instansi_pendidikan = 'School' THEN
    	SET NEW.jenis_user = 'Student';
	ELSEIF NEW.instansi_pendidikan = 'University' THEN
    	SET NEW.jenis_user = 'College Student';
	END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `set_jenis_user_trigger` BEFORE UPDATE ON `member` FOR EACH ROW BEGIN
    IF NEW.instansi_pendidikan = 'School' THEN
        SET NEW.jenis_user = 'Student';
    ELSEIF NEW.instansi_pendidikan = 'University' THEN
        SET NEW.jenis_user = 'College Student';
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-19 14:59:40
