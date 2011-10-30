-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 30, 2011 at 05:15 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=85 ;

--
-- Dumping data for table `core_user`
--

INSERT INTO `core_user` (`user_id`, `role_id`, `user_name`, `password`, `full_name`, `email`, `is_active`, `created_date`, `logged_in_date`, `is_online`) VALUES
(81, 5, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'Administrtor', 'admin@gmail.com', 1, NULL, NULL, 0),
(82, 5, 'khoa', '202cb962ac59075b964b07152d234b70', 'Cù Duy Khoa', 'dkhoa47@gmail.com', 0, NULL, NULL, 0),
(83, 5, 'hotvip', '202cb962ac59075b964b07152d234b70', 'hot_vip', 'hotvip@gmail.com', 0, NULL, NULL, 0),
(84, 4, 'zend', '202cb962ac59075b964b07152d234b70', 'zend framework', 'zend@gmail.com', 0, NULL, NULL, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
