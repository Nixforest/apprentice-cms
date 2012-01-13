-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 05, 2012 at 02:24 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `news_article`
--

INSERT INTO `news_article` (`article_id`, `category_id`, `title`, `description`, `content`, `author`, `image`, `status`, `num_views`, `created_date`, `created_user_id`, `created_user_name`, `updated_date`, `updated_user_id`, `updated_user_name`, `activate_user_id`, `activate_user_name`, `activate_date`, `allow_comment`, `num_comments`, `is_hot`, `ordering`, `language`) VALUES
(7, NULL, 'tin giao thong', 'bo cong an', '\r\n             \r\n		<div>\r\n        <div class="block">\r\n            - Đây là quy định của ngành, Hà Nội đã áp dụng được mấy năm qua, đã giáo dục tốt cho cán bộ chiến sĩ. Vừa rồi, công an Hà Nội đã kiểm tra chặt chẽ, uốn nắn một số cán bộ chiến sĩ, anh em đã chấp hành rất tốt.<br />\r\n\r\n            Chúng tôi chưa thống kê đã xử lý bao nhiêu trường hợp, song qua theo dõi thấy có hiệu quả, ngăn chặn được nhiều hiện tượng tiêu cực. Nói chung là không có trường hợp vi phạm lớn lắm.\r\n\r\n        </div>\r\n        \r\n\r\n        <div class="block">\r\n\r\n            <i>- Việc giám sát cảnh sát giao thông sẽ như thế nào?</i>\r\n\r\n\r\n        </div>   \r\n\r\n        <div class="block">\r\n\r\n            - Sẽ không phải khám người cảnh sát giao thông. Trong quá trình thực hiện, có sự giám sát của đồng chí đồng đội và có quy trình giám sát qua tổ đội. Một tổ đội đi kiểm tra, yêu cầu cảnh sát xuất trình kế hoạch công tác, sau đó yêu cầu cảnh sát tự giác xuất trình đồ dùng cá nhân.           \r\n\r\n        </div>        \r\n\r\n        <div class="block">\r\n\r\n            <i>- Nếu cảnh sát cố tình để tiền mặt ở chỗ khác mà không mang theo người, việc phát hiện sẽ như thế nào?</i>\r\n\r\n        </div>\r\n\r\n        \r\n\r\n        <div class="block">\r\n\r\n            - Cái đó chúng tôi chưa phát hiện được.\r\n\r\n        </div>\r\n        \r\n\r\n        <div class="block">\r\n\r\n           <div class="img">\r\n\r\n                <img src="/Apprentice_CMS/public/images/canh-11.jpg" /><br />\r\n\r\n                <p>Cảnh sát không được đeo kính đen khi làm nhiệm vụ. Ảnh: Hà Anh.</p>\r\n</div>\r\n           \r\n\r\n        </div>     \r\n\r\n        <div class="block">\r\n\r\n\r\n            <i>- Tại sao ngành công an phải áp dụng quy định cấm mang tiền theo người không quá 100.000 đồng?</i>\r\n\r\n\r\n        </div>\r\n        \r\n\r\n        <div class="block">\r\n\r\n            - Quy định cảnh sát đi làm nhiệm vụ không được mang tiền quá 100.000 đồng để dễ kiểm soát khi có kiểm tra đặc biệt của ngành, dễ bắt lỗi và quy trách nhiệm của anh em. Giải pháp này là quy trình quy phạm của ngành. Lãnh đạo công an thành phố cương quyết triển khai.<br />\r\n\r\n            \r\n\r\n            Quy định này đã áp dụng được mấy năm gần đây. Sau khi có nhiều bài báo nói về tiêu cực của cảnh sát giao thông, chúng tôi tính toán về mặt xây dựng lực lượng thì phải có các biện pháp phòng ngừa, giáo dục chính trị tư tưởng và có quy trình quy phạm để ngăn chặn. Trong thời gian ngắn gần đây, anh em không có vi phạm lớn.\r\n\r\n\r\n        </div>\r\n\r\n        <div class="block">\r\n\r\n            <i>- Hiện có nhiều cảnh sát giao thông vẫn đeo kính đen và mục đích chỉ bắt người xử phạt chứ không hướng dẫn tổ chức giao thông, ông nghĩ sao về việc này?</i>\r\n      \r\n\r\n        </div>\r\n       \r\n\r\n        <div class="block">\r\n\r\n\r\n            - Các điểm, nút đều có bố trí cảnh sát giao thông theo nhiệm vụ, có kiểm tra của lãnh đạo. Các đồng chí như vậy được uốn nắn kịp thời.<br />\r\n\r\n\r\n\r\n            Riêng việc cảnh sát đeo kính đen thì chúng tôi đã xin ý kiến của lãnh đạo Bộ. Nếu Bộ cho phép thì cảnh sát giao thông sẽ được thực hiện trong thời điểm trời nóng, nắng gay gắt. Với thời tiết Việt Nam, chúng tôi đã phải tăng thêm áo mưa, trang bị mũ cứng cho cảnh sát giao thông, người dân cũng rất đồng tình, chia sẻ.\r\n\r\n\r\n        </div>\r\n		</div>\r\n\r\n', 'an vu', NULL, 'inactive', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL);
