-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 30, 2011 at 04:26 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `apprentice_cms`
--

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
(13, 'edit', 'Edit acticle', 'news', 'edit', 0);
