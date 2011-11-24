$$
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

$$
INSERT INTO `page` (`page_id`, `name`,`description`, `content`, `parent_id`, `num_views`, `created_date`, `modified_date`, `user_id`, `language`) VALUES
(1, 'ABC', 'XYZ', 'TVU', 0, 0, '2011-11-03 19:26:38', NULL, 1, 'en_US');
$$