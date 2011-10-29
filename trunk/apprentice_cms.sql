-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 18, 2011 at 06:53 PM
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
-- Table structure for table `modulemanager`
--

CREATE TABLE IF NOT EXISTS `modulemanager` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `thumbnail` text NOT NULL,
  `author` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `version` varchar(10) NOT NULL,
  `license` varchar(10) NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modulemanager`
--

INSERT INTO `modulemanager` (`module_id`, `name`, `description`, `thumbnail`, `author`, `email`, `version`, `license`) VALUES
(1, 'Module Manager', 'Manager Modules', '', 'Nixforest', 'Nixforest21991920@gmail.com', '1.0.0', 'free'),
(2, 'default', 'Default module', '', 'Nixforest', 'Nixforest21991920@gmail.com', '1.0.0', 'free');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

---
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `news_article`
--

INSERT INTO `news_article` (`article_id`, `title`, `description`, `content`, `author`, `image`, `status`, 
`num_views`, `created_date`, `created_user_id`, `created_user_name`, `updated_date`, `updated_user_id`, 
`updated_user_name`, `activate_user_id`, `activate_user_name`,
 `activate_date`, `allow_comment`, `num_comments`, `is_hot`, `ordering`, `language`) VALUES
 
(1,'Title 1','Description 1','Content 1','Author 1','no image','active',0,'2010-08-31 15:43:45',1,'admin','2010-08-31 15:43:45',
1,'admin',1,'admin','2010-08-31 15:43:45',0,0,0,0,'vi-VN'),
(2,'Title 2','Description 2','Content 1','Author 1','no image','active',0,'2010-08-31 15:43:45',1,'admin','2010-08-31 15:43:45',
1,'admin',1,'admin','2010-08-31 15:43:45',0,0,0,0,'vi-VN'),
(3,'Title 3','Description 4','Content 1','Author 1','no image','active',0,'2010-08-31 15:43:45',1,'admin','2010-08-31 15:43:45',
1,'admin',1,'admin','2010-08-31 15:43:45',0,0,0,0,'vi-VN'),
(4,'Title 4','Description 4','Content 1','Author 1','no image','active',0,'2010-08-31 15:43:45',1,'admin','2010-08-31 15:43:45',
1,'admin',1,'admin','2010-08-31 15:43:45',0,0,0,0,'vi-VN');