-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 28, 2023 at 01:01 PM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `small_projects`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_ids`
--

DROP TABLE IF EXISTS `client_ids`;
CREATE TABLE IF NOT EXISTS `client_ids` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` varchar(200) NOT NULL,
  `client_id_location_id` int DEFAULT NULL,
  `main_project_id` int NOT NULL,
  `sub_project_id` int NOT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_ip` varchar(200) DEFAULT NULL,
  `modify_by` int DEFAULT NULL,
  `modify_at` timestamp NULL DEFAULT NULL,
  `modify_ip` varchar(200) DEFAULT NULL,
  `deleted_by` int DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_ip` varchar(200) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `client_id_delete` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `client_ids`
--

INSERT INTO `client_ids` (`id`, `client_id`, `client_id_location_id`, `main_project_id`, `sub_project_id`, `created_by`, `created_at`, `created_ip`, `modify_by`, `modify_at`, `modify_ip`, `deleted_by`, `deleted_at`, `deleted_ip`, `active`, `client_id_delete`) VALUES
(3, 'asdasd@asd.asd', 0, 3, 7, 4, '2023-08-29 17:00:58', '', 0, NULL, '', 0, NULL, '', 1, 1),
(4, 'dsadsa@dsa.ds', 0, 3, 7, 4, '2023-08-29 17:01:16', '', 0, NULL, '', 0, NULL, '', 1, 1),
(5, 'karthik@gmail.com', 0, 3, 7, 4, '2023-08-29 17:01:11', '', 0, NULL, '', 0, NULL, '', 1, 1),
(6, 'project1@sub.task1', NULL, 1, 8, 4, '2023-08-30 16:28:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(7, 'project1@subtas.k1', NULL, 1, 8, 4, '2023-08-30 16:28:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(8, 'adadad@asdaf.fdas', NULL, 1, 9, 4, '2023-08-30 19:27:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(9, 'asdad@fsdf.asdf', NULL, 1, 9, 4, '2023-08-30 19:27:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(10, 'asdasd@sd.sd', NULL, 1, 9, 4, '2023-08-30 19:27:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(11, 'lion@asd.com', NULL, 4, 10, 4, '2023-08-31 15:03:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(12, 'lion2@asd.com', NULL, 4, 10, 4, '2023-08-31 15:03:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(13, 'lion999@gmail.com', NULL, 4, 11, 4, '2023-08-31 15:06:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(14, 'raj@gmail.com', NULL, 3, 12, 1, '2023-09-26 11:06:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(15, 'sam@yopmail.com', NULL, 4, 14, 1, '2023-09-27 12:56:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `location_id` int NOT NULL AUTO_INCREMENT,
  `locationt_name` varchar(200) NOT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_ip` varchar(200) DEFAULT NULL,
  `modify_by` int DEFAULT NULL,
  `modify_at` timestamp NULL DEFAULT NULL,
  `modify_ip` varchar(200) DEFAULT NULL,
  `deleted_by` int DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_ip` varchar(200) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `location_delete` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `locationt_name`, `created_by`, `created_at`, `created_ip`, `modify_by`, `modify_at`, `modify_ip`, `deleted_by`, `deleted_at`, `deleted_ip`, `active`, `location_delete`) VALUES
(1, 'Vellore', 0, '2023-08-31 15:19:36', '', 0, NULL, '', 0, NULL, '', 1, 1),
(2, 'Bangalore', 0, '2023-08-31 15:19:28', '', 0, NULL, '', 0, NULL, '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `project_id` int NOT NULL AUTO_INCREMENT,
  `project_name` varchar(200) NOT NULL,
  `project_description` text NOT NULL,
  `user_id` int NOT NULL,
  `location_id` int NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_ip` varchar(200) NOT NULL,
  `modify_by` int NOT NULL,
  `modify_at` timestamp NULL DEFAULT NULL,
  `modify_ip` varchar(200) NOT NULL,
  `deleted_by` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_ip` varchar(200) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `project_delete` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_name`, `project_description`, `user_id`, `location_id`, `created_by`, `created_at`, `created_ip`, `modify_by`, `modify_at`, `modify_ip`, `deleted_by`, `deleted_at`, `deleted_ip`, `active`, `project_delete`) VALUES
(1, 'Project1', 'Project1', 1, 1, 1, '2023-08-28 14:00:22', '', 0, NULL, '', 0, NULL, '', 1, 1),
(2, 'Project2', 'Project2', 1, 1, 1, '2023-08-28 12:20:27', '', 0, NULL, '', 0, NULL, '', 1, 1),
(3, 'new-project', '', 2, 1, 4, '2023-08-29 17:36:58', '', 0, NULL, '', 0, NULL, '', 1, 1),
(4, 'lion-trading', '', 2, 1, 4, '2023-08-31 14:59:43', '', 0, NULL, '', 0, NULL, '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_project`
--

DROP TABLE IF EXISTS `sub_project`;
CREATE TABLE IF NOT EXISTS `sub_project` (
  `sub_project_id` int NOT NULL AUTO_INCREMENT,
  `sub_project_name` varchar(200) NOT NULL,
  `sub_project_description` text NOT NULL,
  `sub_project_user_id` int NOT NULL,
  `sub_project_location_id` int NOT NULL,
  `main_project_id` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_ip` varchar(200) DEFAULT NULL,
  `modify_by` int DEFAULT NULL,
  `modify_at` timestamp NULL DEFAULT NULL,
  `modify_ip` varchar(200) DEFAULT NULL,
  `deleted_by` int DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_ip` varchar(200) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `sub_project_delete` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`sub_project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sub_project`
--

INSERT INTO `sub_project` (`sub_project_id`, `sub_project_name`, `sub_project_description`, `sub_project_user_id`, `sub_project_location_id`, `main_project_id`, `status`, `created_by`, `created_at`, `created_ip`, `modify_by`, `modify_at`, `modify_ip`, `deleted_by`, `deleted_at`, `deleted_ip`, `active`, `sub_project_delete`) VALUES
(1, 'sub-project-1', '', 0, 0, 1, 1, NULL, '2023-08-28 10:58:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(2, 'sub-project-3', '', 0, 0, 1, 1, NULL, '2023-08-28 10:58:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(3, 'sub-project-101', '', 0, 0, 2, 1, NULL, '2023-08-28 10:59:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(4, 'lksdfd', '', 0, 0, 1, 1, 4, '2023-08-29 15:58:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(5, 'a-sdsa d', '', 0, 0, 2, 1, 4, '2023-08-29 16:04:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(6, 'new-sub-project 1', '', 0, 0, 1, 1, 4, '2023-08-29 17:12:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1),
(7, 'new-sproject', '', 0, 0, 3, 1, 4, '2023-08-29 16:35:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(8, 'sub-task-1', '', 0, 0, 1, 1, 4, '2023-08-30 16:28:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(9, 'newnewnew', '', 0, 0, 1, 1, 4, '2023-08-30 19:27:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(10, 'lion123', '', 0, 0, 4, 1, 4, '2023-08-31 15:03:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(11, 'Lion999', '', 0, 0, 4, 1, 4, '2023-08-31 15:06:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(12, 'testing', '', 0, 0, 3, 1, 1, '2023-09-26 11:06:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(13, 'new sub project', '', 0, 0, 4, 1, 1, '2023-09-26 13:17:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(14, 'samsang', '', 0, 0, 4, 1, 1, '2023-09-27 12:56:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_role_id` int NOT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_ip` varchar(200) DEFAULT NULL,
  `modify_by` int DEFAULT NULL,
  `modify_at` timestamp NULL DEFAULT NULL,
  `modify_ip` varchar(200) DEFAULT NULL,
  `deleted_by` int DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_ip` varchar(200) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_delete` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_id`, `user_name`, `user_password`, `user_role_id`, `created_by`, `created_at`, `created_ip`, `modify_by`, `modify_at`, `modify_ip`, `deleted_by`, `deleted_at`, `deleted_ip`, `active`, `user_delete`) VALUES
(1, 'id1', 'admin', 'e10adc3hnv949b19dl4a59abbe56e057f20f883e', 1, NULL, '2023-09-28 13:00:13', '', 0, NULL, '', 0, NULL, '', 1, 1),
(2, 'userid1', 'user', 'e10adc3hnv949b19dl4a59abbe56e057f20f883e', 2, NULL, '2023-09-28 13:00:26', '', 0, NULL, '', 0, NULL, '', 1, 1),
(3, 'sdfdsfsdf', 'adminadsas', 'e10adc3hnv949b19dl4a59abbe56e057f20f883e', 3, 1, '2023-09-28 13:00:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(4, 'appu123', 'appu', 'e10adc3hnv949b19dl4a59abbe56e057f20f883e', 1, 1, '2023-09-28 13:00:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(5, 'asda', 'appus', 'e10adc3hnv949b19dl4a59abbe56e057f20f883e', 3, 4, '2023-09-28 13:00:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(6, 'client123', 'client123', 'e10adc3hnv949b19dl4a59abbe56e057f20f883e', 3, 4, '2023-09-28 13:00:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(7, 'new-coder', 'new-coder', 'e10adc3hnv949b19dl4a59abbe56e057f20f883e', 3, 4, '2023-09-28 13:00:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(8, 'dhanraj', 'dhanraj', 'e10adc3hnv949b19dl4a59abbe56e057f20f883e', 1, 4, '2023-09-28 13:00:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(9, 'raaj001', 'Rajkumar', 'e10adc3hnv949b19dl4a59abbe56e057f20f883e', 1, 1, '2023-09-28 13:00:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(10, 'iohhh', 'iohhhhh', 'e10adc3hnv949b19dl4a59abbe56e057f20f883e', 2, 1, '2023-09-28 13:00:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(11, 'sam001', 'samsug', 'e10adc3hnv949b19dl4a59abbe56e057f20f883e', 3, 1, '2023-09-28 13:00:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(12, 'Test01', 'TestingRaj', 'e10adc3hnv949b19dl4a59abbe56e057f20f883e', 2, 1, '2023-09-28 12:58:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_client`
--

DROP TABLE IF EXISTS `user_client`;
CREATE TABLE IF NOT EXISTS `user_client` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `client_ids_id` int NOT NULL,
  `main_project_id` int NOT NULL,
  `sub_project_id` int NOT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_ip` varchar(200) DEFAULT NULL,
  `modify_by` int DEFAULT NULL,
  `modify_at` timestamp NULL DEFAULT NULL,
  `modify_ip` varchar(200) DEFAULT NULL,
  `deleted_by` int DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_ip` varchar(200) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_client_delete` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_client`
--

INSERT INTO `user_client` (`id`, `user_id`, `client_ids_id`, `main_project_id`, `sub_project_id`, `created_by`, `created_at`, `created_ip`, `modify_by`, `modify_at`, `modify_ip`, `deleted_by`, `deleted_at`, `deleted_ip`, `active`, `user_client_delete`) VALUES
(2, 5, 6, 1, 8, 4, '2023-08-30 19:10:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(3, 6, 6, 1, 8, 4, '2023-08-30 19:04:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1),
(4, 5, 7, 1, 8, 4, '2023-08-30 19:10:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(5, 5, 3, 3, 7, 4, '2023-08-30 19:11:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(6, 6, 3, 3, 7, 4, '2023-08-30 19:11:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(7, 5, 8, 1, 9, 4, '2023-08-30 19:29:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(8, 6, 8, 1, 9, 4, '2023-08-30 19:29:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(9, 7, 8, 1, 9, 4, '2023-08-30 19:29:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(10, 5, 9, 1, 9, 4, '2023-08-30 19:29:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(11, 6, 9, 1, 9, 4, '2023-08-30 19:29:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(12, 7, 9, 1, 9, 4, '2023-08-31 04:05:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1),
(13, 5, 10, 1, 9, 4, '2023-08-31 04:06:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(14, 6, 10, 1, 9, 4, '2023-08-31 04:05:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1),
(15, 7, 10, 1, 9, 4, '2023-08-31 04:06:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(16, 6, 11, 4, 10, 4, '2023-08-31 15:11:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1),
(17, 7, 11, 4, 10, 4, '2023-08-31 15:11:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(18, 5, 12, 4, 10, 4, '2023-08-31 15:12:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(19, 6, 12, 4, 10, 4, '2023-08-31 15:12:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(20, 6, 14, 3, 12, 1, '2023-09-26 11:14:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(21, 6, 13, 4, 11, 1, '2023-09-26 11:15:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(22, 11, 15, 4, 14, 1, '2023-09-27 12:57:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `user_role_id` int NOT NULL AUTO_INCREMENT,
  `user_role_name` varchar(200) NOT NULL,
  `user_role_description` text,
  `user_role_permission` text,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_ip` varchar(200) DEFAULT NULL,
  `modify_by` int DEFAULT NULL,
  `modify_at` timestamp NULL DEFAULT NULL,
  `modify_ip` varchar(200) DEFAULT NULL,
  `deleted_by` int DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_ip` varchar(200) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_role_delete` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_role_id`, `user_role_name`, `user_role_description`, `user_role_permission`, `created_by`, `created_at`, `created_ip`, `modify_by`, `modify_at`, `modify_ip`, `deleted_by`, `deleted_at`, `deleted_ip`, `active`, `user_role_delete`) VALUES
(1, 'Admin', NULL, '0', NULL, '2023-08-26 17:23:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(2, 'TL', 'Team Lead', '1', NULL, '2023-08-26 17:23:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(3, 'Coder', NULL, '2', NULL, '2023-08-26 17:23:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_work`
--

DROP TABLE IF EXISTS `user_work`;
CREATE TABLE IF NOT EXISTS `user_work` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `work_date` int NOT NULL,
  `project_id` int NOT NULL,
  `sub_project_id` int NOT NULL,
  `tl_name` varchar(250) NOT NULL,
  `chart_id` int NOT NULL,
  `total_page` int NOT NULL,
  `total_docs` int NOT NULL,
  `total_icd` int NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1',
  `created_by` int NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_work`
--

INSERT INTO `user_work` (`id`, `user_id`, `work_date`, `project_id`, `sub_project_id`, `tl_name`, `chart_id`, `total_page`, `total_docs`, `total_icd`, `active`, `created_by`, `created_at`) VALUES
(1, 5, 28, 3, 7, 'user', 1234, 3214, 85214, 2563, b'1', 5, '2023-09-28 16:49:47'),
(2, 5, 28, 3, 7, 'user', 1234, 3214, 85214, 2563, b'1', 5, '2023-09-28 16:50:01');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
