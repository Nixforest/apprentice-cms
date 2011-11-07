$$
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

$$
INSERT INTO `menu` (`menu_id`, `name`, `description`, `user_id`, `user_name`, `created_date`, `language`) VALUES
(1, 'Top Menu', '', 1, 'admin', '2010-08-31 10:30:22', 'en_US'),
(2, 'Menu ở đầu trang', '', 1, 'admin', '2010-08-31 11:24:54', 'vi_VN'),
(9, 'menu test 1', NULL, NULL, NULL, NULL, NULL);
$$


SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
$$
SET time_zone = "+00:00";

$$
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=196 ;

$$
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
(194, NULL, 9, 'item3', NULL, NULL, NULL, NULL),
(195, NULL, 9, 'item4', NULL, NULL, NULL, NULL);
$$