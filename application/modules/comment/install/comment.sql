$$
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `comment`
--
$$
INSERT INTO `comment` (`comment_id`, `title`, `content`, `full_name`, `email`, `user_id`, `user_name`, `news_id`, `created_date`, `is_active`, `activate_date`, `ordering`, `depth`, `reply_to`) VALUES
(1, 'Hello', 'Chao ca nha nhe. Lam quen di.', 'bui ngoc huy', 'huylamtheo@yahoo.com', NULL, NULL, 1, '2011-10-31 22:17:37', 0, NULL, 1, 0, 0),
(2, 'Hi', 'Welcome to Apprentice_CMS.', 'bui ngoc huy', 'huyuit@gmail.com', NULL, NULL, 1, '2011-11-01 20:08:41', 0, NULL, 2, 0, 0);
$$