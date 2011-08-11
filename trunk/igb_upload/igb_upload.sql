-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.54-1ubuntu4


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema upload
--

CREATE DATABASE IF NOT EXISTS upload;
USE upload;

--
-- Definition of table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
  `file_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename` text NOT NULL,
  `extension` varchar(45) NOT NULL,
  `upload_date` varchar(45) NOT NULL,
  `secret_key` varchar(45) NOT NULL,
  `size` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `status` enum('COMPLETE','DELETED') NOT NULL,
  PRIMARY KEY (`file_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` (`file_id`,`filename`,`extension`,`upload_date`,`secret_key`,`size`,`user_id`,`group_id`,`status`) VALUES 
 (81,'CentOS5.6x86_64LiveCD.iso.md5sum.txt','','2011-08-10 11:20:45','AN18E9vHVU2KzYzHNKby1wkOs',63,3,0,''),
 (82,'CentOS5.6x86_64LiveCD.iso.md5sum.txt.asc','','2011-08-10 11:20:45','Hgee83Fq1UmqzGApIQm1EywN9',299,3,0,''),
 (83,'CentOS5.6x86_64LiveCD.iso.sha1sum.txt','','2011-08-10 11:20:45','G2noCnk7aJmj7tzT0KHha7tFx',71,3,0,'DELETED'),
 (84,'CentOS5.6x86_64LiveCD.iso.sha1sum.txt.asc','','2011-08-10 11:20:45','zriVwQEcxyKbuC1sLymBgQvcp',307,3,0,'DELETED'),
 (87,'CentOS5.6x86_64LiveCD.iso.md5sum.txt','','2011-08-10 11:23:39','405tFLIPHZFBikPOm0XKOXOmv',63,3,0,'DELETED'),
 (88,'CentOS5.6x86_64LiveCD.iso.md5sum.txt.asc','','2011-08-10 11:23:39','nQVDyKAvfXFRIiIwL9Z8ribw3',299,3,0,'DELETED'),
 (89,'CentOS5.6x86_64LiveCD.iso.sha1sum.txt','','2011-08-10 11:23:39','hhXZPlHSHVG3hd6PyoX4TvmUy',71,3,0,'DELETED'),
 (90,'CentOS5.6x86_64LiveCD.iso.sha1sum.txt.asc','','2011-07-10 11:23:39','KX596Qog9lLcB2rDk9Bf6QDkl',307,3,0,'DELETED'),
 (91,'CentOS5.6x86_64LiveCD.zip','','2011-08-10 11:23:54','UCyxRRmba9JrVdyIXMLvNo4tS',733669376,3,0,''),
 (92,'NIDAQ900f2.exe','','2011-08-10 11:48:47','1vcOESXEFm3bAXSOUrtMCW2os',1387364352,17,0,'DELETED'),
 (93,'en_windows_7_professional_x64_dvd_x1565805.part01.rar','','2011-08-10 11:49:09','TqTdqwTfwAX4JPlx3UgzxA623',100431872,17,0,'DELETED'),
 (94,'en_windows_7_professional_x64_dvd_x1565805.part02.rar','','2011-08-10 11:49:10','fhVQlHwWL8n4U7PekKLLT5o3u',100431872,17,0,'DELETED'),
 (95,'en_windows_7_professional_x64_dvd_x1565805.part03.rar','','2011-08-10 11:49:12','KYangVHWu5ZyzpZCvB30fpjCQ',100431872,17,0,'DELETED'),
 (96,'en_windows_7_professional_x64_dvd_x1565805.part04.rar','','2011-08-10 11:49:14','8Id2TNh8opVQEilXrY2K5aRPV',100431872,17,0,'DELETED'),
 (97,'en_windows_7_professional_x64_dvd_x1565805.part05.rar','','2011-08-10 11:49:16','vpRSvzW1SR2PGV8gUkR8hXlv3',100431872,17,0,'DELETED'),
 (98,'en_windows_7_professional_x64_dvd_x1565805.part06.rar','','2011-08-10 11:49:17','6I3kjjrIGCw0AqmBkZ19hzm5I',100431872,17,0,'DELETED'),
 (99,'en_windows_7_professional_x64_dvd_x1565805.part07.rar','','2011-08-10 11:49:19','J4BgxmkyqkN5LxtC7xnOuHp6I',100431872,17,0,'DELETED'),
 (100,'en_windows_7_professional_x64_dvd_x1565805.part08.rar','','2011-08-10 11:49:23','3e6pjX53B0StuhJwnik9dGr9s',100431872,17,0,'DELETED'),
 (101,'en_windows_7_professional_x64_dvd_x1565805.part09.rar','','2011-08-10 11:49:28','XfjyIZwpZwsHohkFUNKG8EupY',100431872,17,0,'DELETED'),
 (102,'en_windows_7_professional_x64_dvd_x1565805.part10.rar','','2011-08-10 11:49:31','LROGjaKc1yOdhogNaqJalcsph',100431872,17,0,'DELETED'),
 (103,'en_windows_7_professional_x64_dvd_x1565805.part11.rar','','2011-08-10 11:49:35','YULWo8hRbJ7e0c8HQfnozHWEV',100431872,17,0,'DELETED'),
 (104,'en_windows_7_professional_x64_dvd_x1565805.part12.rar','','2011-08-10 11:49:36','dMWscwaX71z3oH5q9TkqtHkxd',100431872,17,0,'DELETED'),
 (105,'en_windows_7_professional_x64_dvd_x1565805.part13.rar','','2011-08-10 11:49:38','CLS6DFHfOJozOmrgRGM6DXML5',100431872,17,0,'DELETED'),
 (106,'en_windows_7_professional_x64_dvd_x1565805.part14.rar','','2011-08-10 11:49:40','em2gH9vVRs0aUnfFFeGe1mD1e',100431872,17,0,'DELETED'),
 (107,'en_windows_7_professional_x64_dvd_x1565805.part15.rar','','2011-08-10 11:49:43','1R1euVbVG4MHQg82V3Wh2q1jy',100431872,17,0,'DELETED'),
 (108,'en_windows_7_professional_x64_dvd_x1565805.part16.rar','','2011-08-10 11:49:50','Ba2t4KTFdLYBb0ioZVZeP5xk4',100431872,17,0,'DELETED'),
 (109,'en_windows_7_professional_x64_dvd_x1565805.part17.rar','','2011-08-10 11:49:55','L8kMONkygeAljjGFt3jrSxBiC',100431872,17,0,'DELETED'),
 (110,'en_windows_7_professional_x64_dvd_x1565805.part18.rar','','2011-08-10 11:49:57','fT3A2Fg9O0jk0qkdqEIbTYREV',100431872,17,0,'DELETED'),
 (111,'en_windows_7_professional_x64_dvd_x1565805.part19.rar','','2011-08-10 11:49:59','oflgmoU3jhn1Sry4dRErCtS6u',100431872,17,0,'DELETED'),
 (112,'en_windows_7_professional_x64_dvd_x1565805.part20.rar','','2011-08-10 11:50:01','qFOAjCN3PovkQ7Fgd9LgvpKaZ',100431872,17,0,'DELETED'),
 (113,'en_windows_7_professional_x64_dvd_x1565805.part21.rar','','2011-08-10 11:50:02','VPiNIe9XlA88hGxj029hB8Drh',100431872,17,0,'DELETED'),
 (114,'en_windows_7_professional_x64_dvd_x1565805.part22.rar','','2011-08-10 11:50:06','uILN8Id35K7ZmVfpBuz1QoXKQ',100431872,17,0,'DELETED'),
 (115,'en_windows_7_professional_x64_dvd_x1565805.part23.rar','','2011-08-10 11:50:09','zjutH74DQwhWyNKDbAtOHiiwv',100431872,17,0,'DELETED'),
 (116,'en_windows_7_professional_x64_dvd_x1565805.part24.rar','','2011-08-10 11:50:16','orpGrHeabt5yU6wmZ9WyrgdbW',100431872,17,0,'DELETED'),
 (117,'en_windows_7_professional_x64_dvd_x1565805.part25.rar','','2011-08-10 11:50:20','KKxmVxD05JkpXZRLQlfR2zYkN',100431872,17,0,'DELETED'),
 (118,'en_windows_7_professional_x64_dvd_x1565805.part26.rar','','2011-08-10 11:50:22','EqCaHI1SRWDAwuTVHD7pXkS0i',100431872,17,0,'DELETED'),
 (119,'en_windows_7_professional_x64_dvd_x1565805.part27.rar','','2011-08-10 11:50:23','IIoTL3i3elPqSCfMSozguByZ2',100431872,17,0,'DELETED'),
 (120,'en_windows_7_professional_x64_dvd_x1565805.part28.rar','','2011-08-10 11:50:25','XzLLqqkWVKbR0QQerxnOG5ata',100431872,17,0,'DELETED'),
 (121,'en_windows_7_professional_x64_dvd_x1565805.part29.rar','','2011-08-10 11:50:27','gMedkUw25jlKrhG2PMn9PlAwD',100431872,17,0,'DELETED'),
 (122,'en_windows_7_professional_x64_dvd_x1565805.part30.rar','','2011-08-10 11:50:30','6IjyZoGgXq5LxcDKQRYUxv9zZ',100431872,17,0,'DELETED'),
 (123,'en_windows_7_professional_x64_dvd_x1565805.part01.rar','','2011-08-10 13:50:21','aXruleP3pd3WGNShTsLeLg8Q8',100431872,3,0,'DELETED'),
 (124,'en_windows_7_professional_x64_dvd_x1565805.part02.rar','','2011-08-10 13:50:22','TMgRrwxE5sssCmDCNavg06fmq',100431872,3,0,'DELETED'),
 (125,'en_windows_7_professional_x64_dvd_x1565805.part03.rar','','2011-08-10 13:50:24','fnZkPOVrw7SevGPARjmzkMqV9',100431872,3,0,'DELETED'),
 (126,'en_windows_7_professional_x64_dvd_x1565805.part04.rar','','2011-08-10 13:50:25','HjyeroyMr0ORIN4Q3UWcrzA08',100431872,3,0,'DELETED'),
 (127,'en_windows_7_professional_x64_dvd_x1565805.part05.rar','','2011-08-10 13:50:27','Tr2PWcRhRyXymn9PY0Y2eEx5v',100431872,3,0,'DELETED'),
 (128,'en_windows_7_professional_x64_dvd_x1565805.part01.rar','','2011-08-11 08:25:32','8Z58lfD1D0aAlr7ymPcFJvQBN',100431872,3,0,'COMPLETE'),
 (129,'en_windows_7_professional_x64_dvd_x1565805.part02.rar','','2011-08-11 08:25:33','3czUpnt8NNu6oMzJbTEVTv2Kk',100431872,3,0,'COMPLETE'),
 (130,'en_windows_7_professional_x64_dvd_x1565805.part03.rar','','2011-08-11 08:25:34','VmTnnGyjROmCSA9cAaKsHOItK',100431872,3,0,'COMPLETE'),
 (131,'en_windows_7_professional_x64_dvd_x1565805.part04.rar','','2011-08-11 08:25:36','OBbLtyVr4UJgIsfKGjbylGh7j',100431872,3,0,'COMPLETE'),
 (132,'en_windows_7_professional_x64_dvd_x1565805.part05.rar','','2011-08-11 08:25:37','UGLAyPkpXJcEDVmrD88MKQ6ZE',100431872,3,0,'COMPLETE'),
 (133,'en_windows_7_professional_x64_dvd_x1565805.part06.rar','','2011-08-11 08:25:39','B4RUcgCuCqPFXs4HGq44AILo9',100431872,3,0,'COMPLETE'),
 (134,'en_windows_7_professional_x64_dvd_x1565805.part07.rar','','2011-08-11 08:25:40','Pmm4PMYCdDJn5HtpXMLKcuplP',100431872,3,0,'COMPLETE'),
 (135,'en_windows_7_professional_x64_dvd_x1565805.part08.rar','','2011-08-11 08:25:43','zc9cq1h0rTR2QQI3nJ08Ii7On',100431872,3,0,'COMPLETE'),
 (136,'en_windows_7_professional_x64_dvd_x1565805.part09.rar','','2011-08-11 08:25:48','hkzeSWnc8KoY1iTWF8bye4oUn',100431872,3,0,'COMPLETE'),
 (137,'en_windows_7_professional_x64_dvd_x1565805.part10.rar','','2011-08-11 08:25:54','Ghp3uJaybWM34D71u1fKxo0vq',100431872,3,0,'COMPLETE'),
 (138,'en_windows_7_professional_x64_dvd_x1565805.part11.rar','','2011-08-11 08:25:55','W4rnCaif1blPph7zgeN7wETgR',100431872,3,0,'COMPLETE'),
 (139,'en_windows_7_professional_x64_dvd_x1565805.part12.rar','','2011-08-11 08:25:57','tjX0nhRIBv6AfnGRnni5wvS6F',100431872,3,0,'COMPLETE'),
 (140,'en_windows_7_professional_x64_dvd_x1565805.part13.rar','','2011-08-11 08:25:58','qRUbTcx0m6wkQEvwar0JOlMrb',100431872,3,0,'COMPLETE'),
 (141,'en_windows_7_professional_x64_dvd_x1565805.part14.rar','','2011-08-11 08:26:00','iGUL8Ir5rOaVDCwlyy3jXY5Qg',100431872,3,0,'COMPLETE'),
 (142,'en_windows_7_professional_x64_dvd_x1565805.part15.rar','','2011-08-11 08:26:03','7pd1i2txHtbKGUZrqHRwRo5YP',100431872,3,0,'COMPLETE'),
 (143,'en_windows_7_professional_x64_dvd_x1565805.part16.rar','','2011-08-11 08:26:08','MMI86kv962h3FrpiYm1nr7Z5I',100431872,3,0,'COMPLETE'),
 (144,'en_windows_7_professional_x64_dvd_x1565805.part17.rar','','2011-08-01 08:26:13','YOftcuX3YXOYvL5aStyX6wwti',100431872,3,0,'DELETED'),
 (145,'en_windows_7_professional_x64_dvd_x1565805.part18.rar','','2011-08-01 08:26:15','tpGQumf3id8NjycFu9tjNYaBF',100431872,3,0,'DELETED'),
 (146,'en_windows_7_professional_x64_dvd_x1565805.part19.rar','','2011-07-11 08:26:16','i8pwrn90pOqQAB89vaz5qNPQZ',100431872,3,0,'DELETED'),
 (147,'en_windows_7_professional_x64_dvd_x1565805.part20.rar','','2011-08-11 08:26:17','vISogbqFOrrKFOv4zBFKOkmY6',100431872,3,0,'COMPLETE'),
 (148,'debian6.0.1amd64CD1.iso','','2011-08-11 09:09:50','pEQ8RShvR8ruP5ZkfOREqa2Na',677023744,18,0,'COMPLETE'),
 (149,'hi.txt','','2011-08-11 09:10:35','qmEbP78oSFuYNGkizvTnbFen9',11,19,0,'COMPLETE'),
 (150,'WindowsXPSP3.iso','','2011-08-11 09:22:05','5cPE1ZiHPdXjXQEJlVapAp8yN',644022272,21,0,'COMPLETE');
/*!40000 ALTER TABLE `files` ENABLE KEYS */;


--
-- Definition of table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(45) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;


--
-- Definition of table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

/*!40000 ALTER TABLE `members` DISABLE KEYS */;
/*!40000 ALTER TABLE `members` ENABLE KEYS */;


--
-- Definition of table `upload_session`
--

DROP TABLE IF EXISTS `upload_session`;
CREATE TABLE `upload_session` (
  `upload_session_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `session_key` varchar(45) NOT NULL,
  `start_time` datetime NOT NULL,
  PRIMARY KEY (`upload_session_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upload_session`
--

/*!40000 ALTER TABLE `upload_session` DISABLE KEYS */;
INSERT INTO `upload_session` (`upload_session_id`,`user_id`,`session_key`,`start_time`) VALUES 
 (1,3,'LjVdDYddiDQOKIixODIxQBbQY','2011-08-09 10:44:24'),
 (2,3,'Zhbca7GV6HWrXlCMQUEWG3oIP','2011-08-09 13:11:59'),
 (3,3,'tP4eYpe6bBGG86VuYZ9jeRzm2','2011-08-09 13:27:40'),
 (4,3,'rlByi5GDZYfXGhVgQQIru3Z9H','2011-08-09 14:49:37'),
 (5,3,'hXfdGL3lmR08tLSiHMVhxWMhM','2011-08-09 14:51:41'),
 (6,16,'VQ4vwpqtfI36otSv7WtJdjPs5','2011-08-09 15:04:15'),
 (7,16,'ATpLVepKTIGo3fdzIgbJp9MOg','2011-08-09 15:04:26'),
 (8,3,'e7YMqialkb4suBIdRFoG6bXpU','2011-08-09 15:05:12'),
 (9,16,'L4X8dtj9y1jQQ2QiPrnoeTdvo','2011-08-09 15:38:52'),
 (10,16,'lX0uJCmNxQG3VDlx3ox9TDyBF','2011-08-09 15:48:10'),
 (11,3,'LmO9XIQPQ7iJ77vH6Hv238Am5','2011-08-09 15:54:36'),
 (12,16,'JofWiA4Snn4kiMxfYp4jpt1Yh','2011-08-09 15:56:05'),
 (13,16,'MTj6i0FKE9K3iCnCyNojlmY7I','2011-08-10 07:48:04'),
 (14,3,'dJ7ICTzULKRvNo6CQmiOalj8i','2011-08-10 10:27:35'),
 (15,3,'hXxq9Ij9kVM4VTMzvT8bqtjF9','2011-08-10 10:45:20'),
 (16,3,'7nyqSxyW9RuhvGsP2nKBNp5sZ','2011-08-10 10:47:40'),
 (17,17,'Q5JcQ8js4wIgCeluDadDionkm','2011-08-10 11:46:41'),
 (18,17,'I21yJpgwtVQfEpOHnwzueVurf','2011-08-10 11:47:22'),
 (19,17,'0l75CKI2uxUJ4s0KgRvkkxnIB','2011-08-10 11:47:33'),
 (20,3,'rFu0mISxws7ShXmh8Non2J22p','2011-08-10 12:12:21'),
 (21,17,'acqedLrj0ju8dHA5D0iobbtwJ','2011-08-10 13:08:29'),
 (22,3,'vNvt6DzpfLRrMm7KbtimIvdDR','2011-08-10 13:08:41'),
 (23,3,'N1BgMU4w33nd0nPwyndvHbeYn','2011-08-10 13:10:09'),
 (24,3,'ENkQwdzV86TrY7Ez7LbYQxZ1K','2011-08-10 13:39:54'),
 (25,3,'jZOJt2opVkXVgiMzZd8Bu3ccZ','2011-08-10 16:23:13'),
 (26,3,'Z4iv7BamNF8fl9H14Pg5XGQNG','2011-08-11 08:02:14'),
 (27,3,'llInGq0FNSp25URgte4yTsxeG','2011-08-11 08:47:22'),
 (28,3,'2NKEnu2DukmZXmZBKVUzAoSPO','2011-08-11 08:47:52'),
 (29,3,'iPaL0UCA2JE0n7wcsK4JNSvAt','2011-08-11 09:06:14'),
 (30,3,'YpZj3lsH11TC7xiPveuycHsdw','2011-08-11 09:06:33'),
 (31,3,'bPoXwLMHWO81krZPEAz3d2bLP','2011-08-11 09:07:29'),
 (32,3,'bKHiTvdx5AJczYrznPTzFeTn1','2011-08-11 09:08:09'),
 (33,18,'bTG5QLSayrNn7D8o6ij8n0Hkt','2011-08-11 09:08:48'),
 (34,19,'ZPswq6hiaH74LBjq1bMJV9Olw','2011-08-11 09:09:03'),
 (35,3,'XV7lMRksRfrcOlPdQzve7CB0L','2011-08-11 09:14:27'),
 (36,21,'kRlW3KzG3gkM7YMuRwIPdbWaO','2011-08-11 09:21:06'),
 (37,21,'zip5vzlETa0fvzPUwUGiZ0abS','2011-08-11 09:21:13');
/*!40000 ALTER TABLE `upload_session` ENABLE KEYS */;


--
-- Definition of table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `netid` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `user_type` enum('IGB','GUEST') NOT NULL,
  `location` varchar(45) NOT NULL,
  `created` datetime NOT NULL,
  `invite_key` varchar(45) NOT NULL,
  `user_host_id` int(10) unsigned NOT NULL,
  `full_name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `status` enum('CREATED','DELETED') NOT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`,`netid`,`email`,`user_type`,`location`,`created`,`invite_key`,`user_host_id`,`full_name`,`password`,`status`) VALUES 
 (3,'nevoband','','IGB','IGB','2011-07-26 09:47:53','',0,'Nevo Band','','CREATED'),
 (17,'nevoband@igb.uiuc.edu','nevoband@igb.uiuc.edu','GUEST','IGB','2011-08-10 11:45:46','',3,'Nevo Test','d8ea71c03ea59d5e92bce06191c20f8d7145bebb','CREATED'),
 (18,'dslater','','IGB','IGB','2011-08-11 09:08:48','',0,'David Slater','','CREATED'),
 (19,'crystala','','IGB','IGB','2011-08-11 09:09:03','',0,'Crystal Ahn','','CREATED'),
 (20,'crystala@illinois.edu','crystala@illinois.edu','GUEST','','2011-08-11 09:17:57','NiVJ4Hm4bznho8k1Cqgtz1y1Y',19,'Crystal Ahn','','CREATED'),
 (21,'crystala@igb.illinois.edu','crystala@igb.illinois.edu','GUEST','','2011-08-11 09:20:42','',19,'Crystal Ahn','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3','CREATED');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
