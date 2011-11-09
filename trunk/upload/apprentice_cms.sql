-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 09, 2011 at 02:53 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `apprentice_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_role`
--

CREATE TABLE IF NOT EXISTS `admin_role` (
  `role_id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` varchar(255) NOT NULL,
  `locked` tinyint(4) NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `admin_role`
--

INSERT INTO `admin_role` (`role_id`, `name`, `description`, `locked`) VALUES
(22, 'client', 'Client', 0),
(24, 'admin', 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `core_user`
--

CREATE TABLE IF NOT EXISTS `core_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` tinyint(4) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `created_date` datetime DEFAULT NULL,
  `logged_in_date` datetime DEFAULT NULL,
  `is_online` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=92 ;

--
-- Dumping data for table `core_user`
--

INSERT INTO `core_user` (`user_id`, `role_id`, `user_name`, `password`, `full_name`, `email`, `is_active`, `created_date`, `logged_in_date`, `is_online`) VALUES
(90, 22, 'nam', '202cb962ac59075b964b07152d234b70', 'nam', 'qcong@gmail.com', 0, NULL, NULL, 0),
(91, 24, 'cong', '3de6a8f9608ddd4ba89f97b36d7587d6', 'cong', 'qcong@gmail.com', 0, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `news_article`
--

CREATE TABLE IF NOT EXISTS `news_article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` smallint(6) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `content` mediumtext,
  `author` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('deleted','draft','inactive','active') DEFAULT 'inactive',
  `num_views` int(11) DEFAULT '0',
  `created_date` datetime DEFAULT NULL,
  `created_user_id` int(11) DEFAULT NULL,
  `created_user_name` varchar(255) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_user_id` int(11) DEFAULT NULL,
  `updated_user_name` varchar(255) DEFAULT NULL,
  `activate_user_id` int(11) DEFAULT NULL,
  `activate_user_name` varchar(50) DEFAULT NULL,
  `activate_date` datetime DEFAULT NULL,
  `allow_comment` tinyint(4) DEFAULT NULL,
  `num_comments` int(11) DEFAULT '0',
  `is_hot` tinyint(4) DEFAULT '0',
  `ordering` int(11) DEFAULT '0',
  `language` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`article_id`),
  KEY `idx_latest` (`status`,`activate_date`),
  KEY `idx_latest_category` (`category_id`,`status`,`activate_date`),
  KEY `idx_most_commented` (`category_id`,`status`,`num_comments`),
  KEY `idx_most_viewed` (`category_id`,`status`,`num_views`),
  KEY `idx_most_viewed_2` (`status`,`num_views`),
  KEY `idx_created_user` (`created_user_id`,`article_id`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `news_article`
--

INSERT INTO `news_article` (`article_id`, `category_id`, `title`, `description`, `content`, `author`, `image`, `status`, `num_views`, `created_date`, `created_user_id`, `created_user_name`, `updated_date`, `updated_user_id`, `updated_user_name`, `activate_user_id`, `activate_user_name`, `activate_date`, `allow_comment`, `num_comments`, `is_hot`, `ordering`, `language`) VALUES
(3, NULL, 'Title 3', 'Description 4', 'Content 1', 'Author 1', 'no image', 'inactive', 0, '2010-08-31 15:43:45', 1, 'admin', '2010-08-31 15:43:45', 1, 'admin', 1, 'admin', '2010-08-31 15:43:45', 0, 0, 0, 0, 'vi-VN'),
(4, NULL, 'Title 4', '<img src="image/smile/1.gif">Description 4', 'Content 1', 'Author 1', 'no image', 'inactive', 0, '2010-08-31 15:43:45', 1, 'admin', '2010-08-31 15:43:45', 1, 'admin', 1, 'admin', '2010-08-31 15:43:45', NULL, 0, NULL, 0, 'vi-VN'),
(5, NULL, '', '<img src="image/smile/1.gif">', '<img src="image/smile/4.gif">', '', NULL, 'active', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE IF NOT EXISTS `privilege` (
  `privilege_id` int(100) NOT NULL,
  `action_name` varchar(150) NOT NULL,
  `description` varchar(200) NOT NULL,
  `module_name` varchar(50) NOT NULL,
  `controller_name` varchar(50) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`privilege_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`privilege_id`, `action_name`, `description`, `module_name`, `controller_name`, `isDeleted`) VALUES
(1, 'add', 'Add a page', 'admin', 'page', 0),
(2, 'edit', 'Edit a page', 'admin', 'page', 1),
(3, 'delete', 'Delete a page', 'admin', 'page', 0),
(4, 'list', 'View page list', 'admin', 'page', 1),
(5, 'add', 'Add a module', 'admin', 'module', 0),
(6, 'add', 'Add a banner', 'ad', 'banner', 0),
(7, 'delete', 'Delete a banner', 'ad', 'banner', 0),
(8, 'list', 'View banner list', 'ad', 'banner', 0),
(9, 'delete', 'Delete a comment', 'comment', 'comment', 1),
(10, 'edit', 'Edit a comment', 'comment', 'comment', 1),
(11, 'add', 'Add new acticle', 'news', 'add', 0),
(12, 'delete', 'Delete acticle', 'news', 'delete', 0),
(13, 'edit', 'Edit acticle', 'news', 'edit', 0),
(14, 'list', 'View role', 'admin', 'role', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rule`
--

CREATE TABLE IF NOT EXISTS `rule` (
  `rule_id` int(100) NOT NULL AUTO_INCREMENT,
  `object_id` int(100) NOT NULL,
  `object_type` varchar(150) NOT NULL,
  `privilege_id` int(100) NOT NULL,
  `allow` tinyint(1) NOT NULL,
  PRIMARY KEY (`rule_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=108 ;

--
-- Dumping data for table `rule`
--

INSERT INTO `rule` (`rule_id`, `object_id`, `object_type`, `privilege_id`, `allow`) VALUES
(106, 22, 'role', 5, 1),
(107, 24, 'role', 14, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
