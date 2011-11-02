$$

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

$$

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

$$

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

$$

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

$$