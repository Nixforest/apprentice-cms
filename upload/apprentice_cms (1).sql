-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 05, 2012 at 04:33 AM
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
-- Table structure for table `admin_module`
--

CREATE TABLE IF NOT EXISTS `admin_module` (
  `module_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `thumbnail` text,
  `author` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `version` varchar(20) DEFAULT NULL,
  `license` text,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `admin_module`
--

INSERT INTO `admin_module` (`module_id`, `name`, `description`, `thumbnail`, `author`, `email`, `version`, `license`) VALUES
(1, 'admin', 'Admin Module. A core module is installed first when setup CMS.', NULL, 'Apprentice CMS Team', 'Nixforest21991920@gmail.com', '1.0.0', 'free'),
(2, 'modulemanager', 'Manager Modules', NULL, 'Apprentice CMS Team', 'Nixforest21991920@gmail.com', '1.0.0', 'free'),
(3, 'default', 'Default Module', NULL, 'Apprentice CMS Team', 'Nixforest21991920@gmail.com', '1.0.0', 'free'),
(5, 'comment', 'This module is used to post a comment for a news', '', 'buingochuy', 'huyuit@gmail.com', '1.0.0', 'free'),
(8, 'menu', 'Menu module. This module manages menu items in website', '', 'Apprentice CMS Team', 'Nixforest21991920@gmail.com', '1.0.0', 'free'),
(10, 'news', 'Core module. This module will be installed at the first time you install website', '', 'Apprentice CMS Team', 'apprenticePM@gmail.com', '1.0.0', 'free');

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
(22, 'client', 'Client', 1),
(24, 'admin', 'Admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `news_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `activate_date` datetime DEFAULT NULL,
  `ordering` int(11) DEFAULT '0',
  `depth` int(11) DEFAULT '0',
  `reply_to` int(11) DEFAULT '0',
  PRIMARY KEY (`comment_id`),
  KEY `idx_lastest` (`news_id`,`is_active`,`ordering`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `title`, `content`, `full_name`, `email`, `user_id`, `user_name`, `news_id`, `created_date`, `is_active`, `activate_date`, `ordering`, `depth`, `reply_to`) VALUES
(3, '', 'sdfsdf', 'sdfsdf', 'ssdf@gmail.com', NULL, NULL, 0, '2011-11-02 14:58:23', 1, '2011-11-02 14:58:23', 0, 0, 0),
(4, 'XXX', 'lksdjglkdsgjklsjflksdjfodsajflkasdnfkdasahnf\r\n', 'Nixforest', 'Nixforest21991920@gmail.com', NULL, NULL, 0, '2011-11-06 16:31:28', 1, '2011-11-06 16:31:28', 0, 0, 0),
(5, 'dsklfj', 'Hello', 'Nixforest', 'Nixforest21991920@gmail.com', NULL, NULL, 6, '2011-11-10 18:16:09', 1, '2012-01-01 14:44:31', 0, 0, 0);

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
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `language` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `name`, `description`, `user_id`, `user_name`, `created_date`, `language`) VALUES
(1, 'Top Menu', '', 1, 'admin', '2010-08-31 10:30:22', 'en_US'),
(2, 'Menu ở đầu trang', '', 1, 'admin', '2010-08-31 11:24:54', 'vi_VN'),
(10, 'menu1', NULL, NULL, NULL, NULL, NULL),
(11, 'menu1', NULL, NULL, NULL, NULL, NULL),
(12, 'menu1', NULL, NULL, NULL, NULL, NULL),
(13, 'menu1', NULL, NULL, NULL, NULL, NULL),
(14, 'menu1', NULL, NULL, NULL, NULL, NULL),
(15, 'menu1', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_item`
--

CREATE TABLE IF NOT EXISTS `menu_item` (
  `menu_item_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `label` varchar(200) DEFAULT NULL,
  `link` text,
  `left_id` int(11) DEFAULT NULL,
  `right_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=208 ;

--
-- Dumping data for table `menu_item`
--

INSERT INTO `menu_item` (`menu_item_id`, `item_id`, `menu_id`, `label`, `link`, `left_id`, `right_id`, `parent_id`) VALUES
(28, 1, 2, 'Trang Chủ', '/tomatocms/index.php/vi_VN/', 1, 2, 0),
(29, 2, 2, 'Việt Nam', '#', 3, 28, 0),
(30, 3, 2, 'Địa điểm', '/tomatocms/index.php/vi_VN/news/category/view/13/', 4, 11, 2),
(31, 4, 2, 'Hà Nội', '/tomatocms/index.php/vi_VN/news/category/view/14/', 5, 6, 3),
(32, 5, 2, 'Huế', '/tomatocms/index.php/vi_VN/news/category/view/15/', 7, 8, 3),
(33, 6, 2, 'TP Hồ Chí Minh', '/tomatocms/index.php/vi_VN/news/category/view/16/', 9, 10, 3),
(34, 7, 2, 'Ẩm thực', '/tomatocms/index.php/vi_VN/news/category/view/17/', 12, 19, 2),
(35, 8, 2, 'Phở', '/tomatocms/index.php/vi_VN/news/category/view/18/', 13, 14, 7),
(36, 9, 2, 'Cơm', '/tomatocms/index.php/vi_VN/news/category/view/19/', 15, 16, 7),
(37, 10, 2, 'Bánh Chưng', '/tomatocms/index.php/vi_VN/news/category/view/20/', 17, 18, 7),
(38, 11, 2, 'Lễ Hội', '/tomatocms/index.php/vi_VN/news/category/view/21/', 20, 27, 2),
(39, 12, 2, 'Tết Âm Lịch', '/tomatocms/index.php/vi_VN/news/category/view/22/', 21, 22, 11),
(40, 13, 2, 'Giỗ Tổ Hùng Vương', '/tomatocms/index.php/vi_VN/news/category/view/23/', 23, 24, 11),
(41, 14, 2, 'Tết Trung Thu', '/tomatocms/index.php/vi_VN/news/category/view/24/', 25, 26, 11),
(173, 1, 1, 'Home', '/tomatocms/index.php/en_US/', 1, 2, 0),
(174, 14, 1, 'Vietnam', '#', 3, 30, 0),
(175, 3, 1, 'Hanoi', '/tomatocms/index.php/en_US/news/category/view/4/', 4, 5, 14),
(176, 4, 1, 'Hue', '/tomatocms/index.php/en_US/news/category/view/5/', 6, 7, 14),
(177, 5, 1, 'Ho Chi Minh City', '/tomatocms/index.php/en_US/news/category/view/6/', 8, 9, 14),
(178, 19, 1, 'cde', 'abc.com', 10, 11, 14),
(179, 20, 1, 'Da Lat', '/tomatocms/index.php/news/article/view/1/21/', 12, 13, 14),
(180, 6, 1, 'Cuisine', '/tomatocms/index.php/en_US/news/category/view/2/', 14, 21, 14),
(181, 7, 1, 'Ph?', '/tomatocms/index.php/en_US/news/category/view/7/', 15, 16, 6),
(182, 8, 1, 'Rice', '/tomatocms/index.php/en_US/news/category/view/8/', 17, 18, 6),
(183, 9, 1, 'Banh Chung', '/tomatocms/index.php/en_US/news/category/view/9/', 19, 20, 6),
(184, 10, 1, 'Holiday', '/tomatocms/index.php/en_US/news/category/view/3/', 22, 29, 14),
(185, 11, 1, 'Tet', '/tomatocms/index.php/en_US/news/category/view/10/', 23, 24, 10),
(186, 12, 1, 'Hung Kings'' Temple Festival', '/tomatocms/index.php/en_US/news/category/view/11/', 25, 26, 10),
(187, 13, 1, 'Mid-Autumn Festival', '/tomatocms/index.php/en_US/news/category/view/12/', 27, 28, 10),
(188, 15, 1, 'Trang ch?', '/tomatocms/index.php/', 31, 32, 0),
(196, NULL, 10, 'item3', NULL, NULL, NULL, NULL),
(197, NULL, 10, 'item4', NULL, NULL, NULL, NULL),
(198, NULL, 11, 'item3', NULL, NULL, NULL, NULL),
(199, NULL, 11, 'item4', NULL, NULL, NULL, NULL),
(200, NULL, 12, 'item3', NULL, NULL, NULL, NULL),
(201, NULL, 12, 'item4', NULL, NULL, NULL, NULL),
(202, NULL, 13, 'item3', NULL, NULL, NULL, NULL),
(203, NULL, 13, 'item4', NULL, NULL, NULL, NULL),
(204, NULL, 14, 'item3', NULL, NULL, NULL, NULL),
(205, NULL, 14, 'item4', NULL, NULL, NULL, NULL),
(206, NULL, 15, 'item3', NULL, NULL, NULL, NULL),
(207, NULL, 15, 'item4', NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `modulemanager`
--

INSERT INTO `modulemanager` (`module_id`, `name`, `description`, `thumbnail`, `author`, `email`, `version`, `license`) VALUES
(1, 'modulemanager', 'Manager Modules', '', 'Nixforest', 'Nixforest21991920@gmail.com', '1.0.0', 'free'),
(2, 'default', 'Default module', '', 'Nixforest', 'Nixforest21991920@gmail.com', '1.0.0', 'free'),
(4, 'contact', 'Contact module.', '', 'Nixforest', 'Nixforest21991920@gmail.com', '1.0.0', 'free');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `news_article`
--

INSERT INTO `news_article` (`article_id`, `category_id`, `title`, `description`, `content`, `author`, `image`, `status`, `num_views`, `created_date`, `created_user_id`, `created_user_name`, `updated_date`, `updated_user_id`, `updated_user_name`, `activate_user_id`, `activate_user_name`, `activate_date`, `allow_comment`, `num_comments`, `is_hot`, `ordering`, `language`) VALUES
(3, NULL, 'Title 3', 'Description 4', 'Content 1', 'Author 1', 'no image', 'inactive', 0, '2010-08-31 15:43:45', 1, 'admin', '2010-08-31 15:43:45', 1, 'admin', 1, 'admin', '2010-08-31 15:43:45', 0, 0, 0, 0, 'vi-VN'),
(4, NULL, 'Title 4', '<img src="image/smile/1.gif">Description 4', 'Content 1', 'Author 1', 'no image', 'inactive', 0, '2010-08-31 15:43:45', 1, 'admin', '2010-08-31 15:43:45', 1, 'admin', 1, 'admin', '2010-08-31 15:43:45', NULL, 0, NULL, 0, 'vi-VN'),
(5, NULL, '', '<img src="image/smile/1.gif">', '<img src="image/smile/4.gif">', '', NULL, 'active', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL),
(6, NULL, 'Tin tức tổng hợp', 'ádfsadfsadf<img src="http://localhost/Apprentice_CMS/public/js/image/smile/6.gif"><div id="-chrome-auto-translate-plugin-dialog" style="opacity: 1 !important; background-image: initial !important; background-attachment: initial !important; background-origin: initial !important; background-clip: initial !important; background-color: transparent !important; padding-top: 0px !important; padding-right: 0px !important; padding-bottom: 0px !important; padding-left: 0px !important; margin-top: 0px !important; margin-right: 0px !important; margin-bottom: 0px !important; margin-left: 0px !important; position: absolute !important; top: 0px; left: 0px; overflow-x: visible !important; overflow-y: visible !important; z-index: 999999 !important; text-align: left !important; display: none; background-position: initial initial !important; background-repeat: initial initial !important; "><div style="max-width: 300px !important;color: #fafafa !important;opacity: 0.8 !important;border-color: #000000 !important;border-width: 0px !important;-webkit-border-radius: 10px !important;background-color: #363636 !important;font-size: 16px !important;padding: 8px !important;overflow: visible !important;background-image: -webkit-gradient(linear, left top, right bottom, color-stop(0%, #000), color-stop(50%, #363636), color-stop(100%, #000));z-index: 999999 !important;text-align: left  !important;"><div class="translate"></div><div class="additional"></div></div><img src="http://www.google.com/uds/css/small-logo.png" onclick="document.location.href=''http://translate.google.com/'';" style="position: absolute !important; z-index: -1 !important; right: 1px !important; top: -20px !important; cursor: pointer !important;-webkit-border-radius: 20px; background-color: rgba(200, 200, 200, 0.3) !important; padding: 3px 5px 0 !important; margin: 0 !important;"></div>', '', 'nixforest', NULL, 'inactive', 0, '2011-11-10 18:05:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `page_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `parent_id` int(11) DEFAULT '0',
  `num_views` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `language` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`page_id`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
(1, 'list', 'Add a privilege', 'admin', 'privilege', 0),
(2, 'list', 'View role', 'admin', 'role', 0),
(3, 'submit', 'Add new role', 'admin', 'role', 0),
(4, 'permission', 'Permiss role', 'admin', 'role', 1),
(5, 'list', 'View module', 'admin', 'module', 0),
(6, 'add', 'Add a user', 'admin', 'user', 0),
(7, 'edit', 'Edit a user', 'admin', 'user', 0),
(8, 'index', 'View user', 'admin', 'user', 0),
(9, 'index', 'View comment', 'comment', 'admin', 0),
(10, 'list', 'List a comment', 'comment', 'admin', 0),
(11, 'edit', 'Edit a comment', 'comment', 'admin', 0),
(12, 'add', 'Add article', 'news', 'article', 0),
(13, 'edit', 'Edit acticle', 'news', 'article', 0),
(14, 'index', 'View template', 'admin', 'template', 0),
(15, 'list', 'List template', 'admin', 'template', 0),
(16, 'index', 'View menu', 'menu', 'index', 0),
(17, 'add', 'Add a menu', 'menu', 'index', 0),
(18, 'delete', 'Delete a menu', 'menu', 'index', 0),
(19, 'new', 'New page', 'page', 'page', 0),
(20, 'list', 'List page', 'page', 'page', 0),
(21, 'edit', 'Edit page', 'page', 'page', 0),
(22, 'list', 'List article', 'news', 'article', 0),
(23, 'view', 'View article', 'news', 'article', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=166 ;

--
-- Dumping data for table `rule`
--

INSERT INTO `rule` (`rule_id`, `object_id`, `object_type`, `privilege_id`, `allow`) VALUES
(106, 22, 'role', 5, 1),
(143, 24, 'role', 2, 1),
(145, 24, 'role', 3, 1),
(146, 24, 'role', 1, 1),
(147, 24, 'role', 6, 1),
(148, 24, 'role', 7, 1),
(149, 24, 'role', 8, 1),
(150, 24, 'role', 14, 1),
(151, 24, 'role', 15, 1),
(152, 24, 'role', 16, 1),
(153, 24, 'role', 17, 1),
(154, 24, 'role', 18, 1),
(155, 24, 'role', 9, 1),
(156, 24, 'role', 10, 1),
(157, 24, 'role', 11, 1),
(158, 24, 'role', 19, 1),
(159, 24, 'role', 20, 1),
(160, 24, 'role', 21, 1),
(162, 24, 'role', 13, 1),
(163, 24, 'role', 22, 1),
(164, 24, 'role', 23, 1),
(165, 24, 'role', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
