-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2017 at 11:55 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `attachment_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_name` varchar(100) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `assessment`
--

CREATE TABLE IF NOT EXISTS `assessment` (
  `assessment_no` int(254) NOT NULL AUTO_INCREMENT,
  `student_reg_number` varchar(100) NOT NULL COMMENT 'Made unique to ensure no student is assessed twice',
  `department_id` int(100) NOT NULL,
  `date_of_assessment` date NOT NULL,
  `staff_id` varchar(100) NOT NULL,
  `points_awarded` int(100) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY (`assessment_no`),
  UNIQUE KEY `assessment_no` (`assessment_no`),
  UNIQUE KEY `student_reg_number` (`student_reg_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `assessment`
--

INSERT INTO `assessment` (`assessment_no`, `student_reg_number`, `department_id`, `date_of_assessment`, `staff_id`, `points_awarded`, `comments`) VALUES
(1, 'st302/2200/13', 3, '2017-05-05', 'R12', 60, 'good'),
(2, 'ct35/878/34', 1, '2017-04-05', 's3122', 54, 'Not soo well, Confortable and easy to adapt and highly industrious.'),
(3, 'ct201/0062/13', 1, '0000-00-00', 'st4', 43, 'good boy');

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('lecturer', '10', 1496066492),
('lecturer', '12', 1496129049),
('lecturer', '9', 1497083890),
('permision_admin', '13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, NULL, NULL),
('/admin/*', 2, NULL, NULL, NULL, NULL, NULL),
('lecturer', 1, 'Lecturers can only view Assessment details of students', NULL, NULL, 1496066405, 1496066405),
('permision_admin', 2, 'permision to add set up/modify permissions,roles', NULL, NULL, NULL, NULL),
('sys_admin', 1, 'can do anything on the entire system', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `counties`
--

CREATE TABLE IF NOT EXISTS `counties` (
  `county_id` int(11) NOT NULL AUTO_INCREMENT,
  `county_name` varchar(100) NOT NULL,
  PRIMARY KEY (`county_id`),
  UNIQUE KEY `county_name` (`county_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `counties`
--

INSERT INTO `counties` (`county_id`, `county_name`) VALUES
(13, 'Baringo'),
(14, 'Bomet'),
(15, 'Bungoma'),
(16, 'Elgeyo Marakwet County'),
(17, 'Embu'),
(18, 'Garrissa'),
(19, 'Homabay'),
(2, 'Kakamega'),
(1, 'Kiambu'),
(9, 'Kisumu'),
(8, 'Kwale'),
(6, 'Machakos'),
(7, 'Makueni'),
(11, 'MArsabit'),
(3, 'Meru'),
(5, 'Nairobi'),
(10, 'Taita TAveta'),
(4, 'Tharaka Nithi'),
(12, 'Wajir');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(100) NOT NULL,
  `faculty_id` int(100) NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `faculty_id`) VALUES
(1, 'IT', 15),
(2, 'BBIT', 15),
(3, 'statistics', 17),
(4, 'commerce', 17);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `department_name` varchar(100) NOT NULL,
  `department_id` int(10) NOT NULL AUTO_INCREMENT,
  `faculty_id` int(100) NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE IF NOT EXISTS `faculties` (
  `faculty_name` varchar(100) NOT NULL,
  `faculty_id` int(100) NOT NULL AUTO_INCREMENT,
  `faculty_initials` varchar(10) NOT NULL,
  PRIMARY KEY (`faculty_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`faculty_name`, `faculty_id`, `faculty_initials`) VALUES
('School of Health Sciences', 1, 'shs'),
('school of MAths', 14, 'f'),
('School of Computing and informatics', 15, 'SCI'),
('School of Pure and Applied Mathematics', 16, 'SPAM'),
('School of business', 17, 'SB'),
('School of Agriculture', 18, 'SA');

-- --------------------------------------------------------

--
-- Table structure for table `log_book`
--

CREATE TABLE IF NOT EXISTS `log_book` (
  `user_id` int(11) NOT NULL COMMENT 'asociated user id on user table',
  `student_reg_no` varchar(20) NOT NULL,
  `week_number` enum('1','2','3','4','5','6','7','8','9','10','12') NOT NULL,
  `date_to` date NOT NULL,
  `day` enum('Monday','Tuesday','Wednesday','Thursday','Friday') NOT NULL,
  `tasks_done` text NOT NULL,
  `record_no` int(254) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`record_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `log_book`
--

INSERT INTO `log_book` (`user_id`, `student_reg_no`, `week_number`, `date_to`, `day`, `tasks_done`, `record_no`) VALUES
(4, 'ct201/0060/13', '1', '2017-05-05', 'Thursday', 'Web site update \r\nSystem scan\r\n', 1),
(4, 'ct201/0060/13', '1', '2017-05-05', 'Friday', 'Network configuration.\r\nSoftware installaion', 2),
(8, 'bit201/4450/13', '1', '2017-07-04', 'Monday', 'Orientation', 3),
(8, 'bit201/4450/13', '1', '2017-07-04', 'Tuesday', 'Setting up boardroom. 2. Sertting up wireless router. Installing anti virus', 4),
(5, 'ct201/0061/13', '1', '2017-02-05', 'Monday', '1.netsh wlan configuration', 5),
(5, 'ct201/0061/13', '3', '2017-02-06', 'Wednesday', 'any', 6),
(5, 'ct201/0061/13', '4', '2017-07-06', 'Tuesday', 'anything', 7),
(18, 'AW304/500/13', '1', '2017-06-16', 'Monday', 'rj 45 install 1', 8),
(18, 'AW304/500/13', '1', '2017-06-16', 'Tuesday', 'flight control', 9),
(18, 'AW304/500/13', '2', '2017-06-23', 'Tuesday', 'port links to', 10);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1476133433),
('m130524_201442_init', 1476133543);

-- --------------------------------------------------------

--
-- Table structure for table `staff_details`
--

CREATE TABLE IF NOT EXISTS `staff_details` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'associated user id in user table',
  `staff_id` varchar(100) NOT NULL COMMENT 'staff id granted by the school',
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `department_id` int(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` int(10) NOT NULL,
  `county_id` int(20) NOT NULL,
  `no_of_students_allocated` int(100) NOT NULL DEFAULT '0',
  `max_allocated` enum('yes','no','','') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`staff_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `staff_details`
--

INSERT INTO `staff_details` (`user_id`, `staff_id`, `first_name`, `middle_name`, `last_name`, `department_id`, `email`, `phone_number`, `county_id`, `no_of_students_allocated`, `max_allocated`) VALUES
(1, 'R12', 'samuel', 'shammir', 'sammy', 15, 'shammir@gmail.com', 700092094, 13, 0, 'no'),
(3, 's3122', 'joe', 'denge', 'kam', 17, 'kam@gmail.com', 98665, 15, 0, 'no'),
(4, 'st3', 'edwin', 'washington', 'ceo', 17, 'ceo@maos.com', 984523, 16, 0, 'no'),
(5, 'st4', 'peter ', 'keneth', 'sonko', 15, 'sonko@gmail.com', 789234543, 5, 0, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `student_attachment_details`
--

CREATE TABLE IF NOT EXISTS `student_attachment_details` (
  `createdBy` int(11) NOT NULL,
  `reg_no` varchar(20) NOT NULL,
  `county_attached` enum('Kiambu','Nairobi','Kitui','Mombasa','Nyeri','Meru','Embu','Makueni','Taita Taveta','Machakos','Mandera','Garissa','Nakuru','Nyamira','kakamega','Migori') NOT NULL,
  `closest_town` varchar(100) NOT NULL,
  `company_attached` varchar(100) NOT NULL,
  `company_phone_number` int(11) NOT NULL,
  `is_assessed` enum('yes','no','','') NOT NULL DEFAULT 'no',
  `location_description` text NOT NULL,
  `department_id` int(11) NOT NULL,
  `allocated_staff_id` varchar(200) DEFAULT 'no',
  PRIMARY KEY (`reg_no`),
  UNIQUE KEY `user_id` (`createdBy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_attachment_details`
--

INSERT INTO `student_attachment_details` (`createdBy`, `reg_no`, `county_attached`, `closest_town`, `company_attached`, `company_phone_number`, `is_assessed`, `location_description`, `department_id`, `allocated_staff_id`) VALUES
(18, 'AW304/500/13', 'Kiambu', 'sddc', 'seacom technologies', 9890, 'no', 'nbnmbn', 4, 'no'),
(8, 'bit201/4450/13', 'Kitui', 'mshipie', 'Fibre business Consultants', 20547896, 'no', 'e', 1, 'no'),
(14, 'bs201/1001/13', 'Nairobi', 'dsd', 'asas', 4343, 'no', 'xzczx', 3, 'no'),
(15, 'bs205/0016/13', 'Nairobi', 'Limuru', 'BAta', 2145687, 'no', 'located anywhere', 1, 'no'),
(4, 'ct201/0060/13', 'Nairobi', 'Westlands', 'IBM', 2147483647, 'no', '', 0, 'no'),
(6, 'ct201/0062/13', 'Mombasa', 'Mtwapa', 'Overseas fibre company', 448579652, 'yes', '', 1, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `student_reg_details`
--

CREATE TABLE IF NOT EXISTS `student_reg_details` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `department_id` int(100) NOT NULL,
  `reg_no` varchar(100) NOT NULL,
  `phone_number` int(100) NOT NULL,
  `year_of_study` enum('one','two','three','four') NOT NULL,
  `current_semester` enum('1','2') NOT NULL,
  `course` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `student_reg_details`
--

INSERT INTO `student_reg_details` (`user_id`, `first_name`, `middle_name`, `last_name`, `department_id`, `reg_no`, `phone_number`, `year_of_study`, `current_semester`, `course`, `email`) VALUES
(1, 'ken', 'ken', '0', 1, 'ct201/0062/13', 0, 'three', '2', 'bcs', 'ken@gmail.com'),
(2, 'Nuria', 'oasis', 'Njambi', 3, 'sc34/9989/14', 700876544, 'three', '2', 'bcom', 'nuria@gmail.com'),
(3, 'lewis', 'murimi', 'denge', 3, 'st302/2200/13', 900587456, 'one', '2', 'bcom', 'murimi@gmail.com'),
(4, 'felo', 'm', 'n', 3, 'vcr4/5677/13', 722584723, 'two', '1', 'bbit', 'nm@gmail.com'),
(5, 'felo', 'n', 'e', 1, 'ct35/878/34', 54678, 'three', '2', 'bcs', 'e@gmail.com'),
(6, 'kadenge', 'james ', 'mwangi', 1, 'bit201/4450/13', 700876544, 'one', '2', 'BBIT', 'kadenge@gmail.com'),
(7, 'henry', 'burii', 'bar', 3, 'bs201/1001/13', 700092093, 'three', '2', 'Bcom', 'henry@gmail.com'),
(8, 'henry', 'burii', 'bar', 3, 'bs201/1001/13', 700092093, 'three', '2', 'Bcom', 'henry@gmail.com'),
(9, 'Anne', 'mbithe ', 'kaunda', 1, 'bs205/0016/13', 7074121, 'four', '2', 'BBIT', 'anne@gmail.com'),
(10, 'Anne', 'mbithe ', 'kaunda', 1, 'bs205/0016/13', 7074121, 'four', '2', 'BBIT', 'anne@gmail.com'),
(11, 'LEWIS', 'MURIMI', 'IRERI', 1, 'CT203/0025/13', 702387347, 'two', '2', 'BIT', 'lmurimi93@gmail.com'),
(12, 'LEWIS', 'MURIMI', 'IRERI', 1, 'CT203/0025/13', 702387347, 'two', '2', 'BIT', 'lmurimi93@gmail.com'),
(13, 'Tony ', 'Braxron', 'wangai', 2, 'AG310/0039/14', 987645, 'four', '2', 'BCS', 'tony@gmail.com'),
(14, 'Brenda', 'fasi', 'south', 4, 'AW304/500/13', 340256, 'four', '2', 'bpsm', 'bree@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_id` int(100) NOT NULL COMMENT 'This is the id generated when the user registers',
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'to students, the username is the reg_number while the staff the username is the staff id',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `reg_id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(4, 0, 'ct201/0060/13', 'uRAXY5p_Hjx-JA4ikMpW7PBEMv3p4uRF', '$2y$13$lDgoxJJ8./04dbIeGbmVQ./nxW4y28eZ8K4SPG8TZ1PiQdh2azz86', NULL, 'kungusamuel90@gmail.com', 10, 1491312919, 1491312919),
(5, 0, 'ct201/0061/13', '5GZ9koFoHn_PPVIScrNFmOfb5d8fNUGh', '$2y$13$yuL8f8CS84pu8hyk3mA0EObxI3t5Rn.CRelg7TJyFj56ufkIEIXGO', NULL, 'maria@gmail.com', 10, 1491317818, 1491317818),
(6, 0, 'ct201/0062/13', 'fhF9fJ_vIeDtSE3nVabrXHfSUVKx-wHi', '$2y$13$S3dVIKKeykDS8RpRhLwmpuNbGq0JXcxgXhyIekt5q2j44LNul0t7u', NULL, 'ken@gmail.com', 10, 1491318038, 1491318038),
(7, 0, 'ct35/878/34', 'RffcAxEBHpRHh-rzfMGla8DF1uuKnqBg', '$2y$13$NJmS9MyePcnScpFjojEGNef7Fo83WexWBvtJEypRERtHCqD03xrO.', NULL, 'e@gmail.com', 10, 1492512534, 1492512534),
(8, 0, 'bit201/4450/13', 'y8B6fF2f3udkVhiGeD00AlxwSIEqgTOH', '$2y$13$.0zpEflDLYtEnkicflpOsuxDjnb3ChPRP0o5kpLHWvDQ8okFgDJ.a', NULL, 'kadenge@gmail.com', 10, 1492512960, 1492512960),
(9, 0, 'R12', 'XzYZPEM9qxdPyJCjSRFvWv32tEYIhhKN', '$2y$13$3Zevq6I5ZlAIvh.xY9z6setQ/BicpfNHlQb4TN0KEWbnllUuH2lpW', NULL, 'shammir@gmail.com', 10, 1495870869, 1495870869),
(10, 0, 's3122', 'ySpXveKbZoBXe2rDqU6FrflL6xsLiJMF', '$2y$13$twD.UnqjaUetIZTCwxxv.ODRv.5Hhnv7/sn.sGXVO./9CJWegN.xm', NULL, 'kam@gmail.com', 10, 1495876490, 1495876490),
(11, 0, 'st3', 'oq6SpHJePCfUi1UVD_HnA-Ywe-txvxf8', '$2y$13$VorJUIZXLEu1KXtauT8dd.FVDRNinZEPdfyENAsuABFFxIqHHkd2W', NULL, 'ceo@maos.com', 10, 1495894900, 1495894900),
(12, 0, 'st4', 'hvAbvic9mF0raYLrigXpXSyeP8cs2OXx', '$2y$13$/tmuLM1Cc8Fh.w3pvbTktOLYZHMl2EPwikenliQnLaQrb6DjrKYum', NULL, 'sonko@gmail.com', 10, 1495894980, 1495894980),
(13, 0, 'admin', 'TOCdKpqejX82duj_AslxO6au1PA0fcvp', '$2y$13$p2T1gFMA4AaXwrxZqIeZIuu.mJRhU5Oa.LHKKf1nGXVRc05KcFjhq', NULL, 'admin@gmail.com', 10, 1496053538, 1496053538),
(14, 0, 'bs201/1001/13', 'kvorsNzxAMa_LIXSY1TEpNTMpvzaPo_i', '$2y$13$TD/nwYWrj89bJtyFsjbBl.SmI8Iolj13NSUc1kclAGJ3b17KhZptW', NULL, 'henry@gmail.com', 10, 1496129800, 1496129800),
(15, 0, 'bs205/0016/13', 'pk7F5vmPriskJmdCyvf8we1aybJbqBf0', '$2y$13$IBuldiYN4xU6e0KiR6ZftuHq/LVBbh8srlLpGJSBUEh6YuHFTjh2e', NULL, 'anne@gmail.com', 10, 1496137266, 1496137266),
(16, 0, 'CT203/0025/13', 'wYyUgqf3sHl4D_ec1-DRum_38wUYiUu7', '$2y$13$jkShz4OCL8UExaJ0m6QCn.a9iAZaa3ucPdKlCxKRmA7p0bUKXx0l2', NULL, 'lmurimi93@gmail.com', 10, 1497084566, 1497084566),
(17, 0, 'AG310/0039/14', 'tP2itrdDVEjFuJXPOUQ8z4kT8_YIuyx4', '$2y$13$/FyJ3qeHbi4TGGKXmTV1juJQ88RiJyI92wOeGzGOPu68pOILMMqNq', NULL, 'tony@gmail.com', 10, 1497208098, 1497208098),
(18, 0, 'AW304/500/13', 'bjIzjzJS9-gZdwSN4Y5v1XTrlbOjLom9', '$2y$13$gnyQqkabJ2Omvoidn5aJ6OzRN4IXRe84MevlNCt/EbIA1TjSHB2Am', NULL, 'bree@gmail.com', 10, 1497208516, 1497208516);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `faculty_rship` FOREIGN KEY (`department_id`) REFERENCES `faculties` (`faculty_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
