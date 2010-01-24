-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2010 年 01 月 24 日 03:47
-- 服务器版本: 5.1.41
-- PHP 版本: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `xiyoulinux`
--

-- --------------------------------------------------------

--
-- 表的结构 `xy_member`
--

CREATE TABLE IF NOT EXISTS `xy_member` (
  `member_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `member_category_ID` bigint(20) unsigned DEFAULT '0',
  `member_name` varchar(20) NOT NULL DEFAULT '',
  `member_nickname` varchar(255) DEFAULT '',
  `member_email` varchar(255) DEFAULT '',
  `member_blog` varchar(255) DEFAULT '',
  `member_rss_url` varchar(255) DEFAULT '',
  `member_QQ` varchar(255) DEFAULT '',
  `member_mobile` varchar(255) DEFAULT '',
  `member_major` varchar(255) DEFAULT '',
  `member_pwd` varchar(20) NOT NULL DEFAULT '00000000',
  `member_image` varchar(255) NOT NULL DEFAULT 'get_bloginfo(\\''wpurl\\'') . \\''/wp-content/plugins/member_management/image/default.jpg\\''',
  PRIMARY KEY (`member_ID`),
  UNIQUE KEY `member_name` (`member_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `xy_member`
--

INSERT INTO `xy_member` (`member_ID`, `member_category_ID`, `member_name`, `member_nickname`, `member_email`, `member_blog`, `member_rss_url`, `member_QQ`, `member_mobile`, `member_major`, `member_pwd`, `member_image`) VALUES
(1, 0, 'ybmmwjl@163.com', '独舞秋魂', 'johnson.wei.056@gmail.com', '', '', '464963032', '15029239473', '计算机科学与技术', 'abcd', 'http://localhost/member_info_management/image/ybmmwjl@163.com.jpg'),
(2, 0, 'example@163.com', '独舞秋魂', 'johnson.wei.056@gmail.com', '没有', '', '464963032', '15029239473', '计算机科学与技术', '00000000', 'http://localhost/member_info_management/image/example@163.com.jpg'),
(3, 0, 'example1@163.com', '独舞秋魂', 'johnson.wei.056@gmail.com', '没有', '', '464963032', '15029239473', '计算机科学与技术', '00000000', 'http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),
(4, 0, 'example11@163.com', '独舞秋魂', 'johnson.wei.056@gmail.com', '没有', '', '464963032', '15029239473', '计算机科学与技术', '00000000', 'http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),
(5, 0, 'example22@163.com', '独舞秋魂', 'johnson.wei.056@gmail.com', '没有', '', '464963032', '15029239473', '计算机科学与技术', '00000000', 'http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),
(6, 0, 'example222@163.com', '独舞秋魂', 'johnson.wei.056@gmail.com', '没有', '', '464963032', '15029239473', '计算机科学与技术', '00000000', 'http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),
(7, 0, 'example111@163.com', '独舞秋魂', 'johnson.wei.056@gmail.com', '没有', '', '464963032', '15029239473', '计算机科学与技术', '00000000', 'http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),
(8, 0, 'example123@163.com', '独舞秋魂', 'johnson.wei.056@gmail.com', '没有', '', '464963032', '15029239473', '计算机科学与技术', '00000000', 'http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),
(9, 0, 'example321@163.com', '独舞秋魂', 'johnson.wei.056@gmail.com', '没有', '', '464963032', '15029239473', '计算机科学与技术', '00000000', 'http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),
(10, 0, 'examplea@163.com', '独舞秋魂', 'johnson.wei.056@gmail.com', '没有', '', '464963032', '15029239473', '计算机科学与技术', '00000000', 'http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg'),
(11, 0, 'example222d@163.com', '独舞秋魂', 'johnson.wei.056@gmail.com', '没有', '', '464963032', '15029239473', '计算机科学与技术', '00000000', '/wp-content/plugins/member_management/image/default.jpg'),
(12, 0, 'exampleddd@163.com', '独舞秋魂', 'johnson.wei.056@gmail.com', '没有', '', '464963032', '15029239473', '计算机科学与技术', '00000000', '/wp-content/plugins/member_management/image/default.jpg'),
(13, 0, 'exampleas@163.com', '独舞秋魂', 'johnson.wei.056@gmail.com', '没有', '', '464963032', '15029239473', '计算机科学与技术', '00000000', '/wp-content/plugins/member_management/image/default.jpg'),
(14, 0, 'example100@163.com', '独舞秋魂', 'johnson.wei.056@gmail.com', '没有', '', '464963032', '15029239473', '计算机科学与技术', '00000000', '/wp-content/plugins/member_management/image/default.jpg'),
(15, 0, 'example101@163.com', '独舞秋魂', 'johnson.wei.056@gmail.com', '没有', '', '464963032', '15029239473', '计算机科学与技术', '00000000', '/wp-content/plugins/member_management/image/default.jpg'),
(16, 0, 'example124@163.com', '独舞秋魂', 'johnson.wei.056@gmail.com', '没有', '', '464963032', '15029239473', '计算机科学与技术', '00000000', '/wp-content/plugins/member_management/image/default.jpg'),
(17, 0, 'example125@163.com', '独舞秋魂', 'johnson.wei.056@gmail.com', '没有', '', '464963032', '15029239473', '计算机科学与技术', '00000000', '/wp-content/plugins/member_management/image/default.jpg'),
(18, 0, 'example102@163.com', '独舞秋魂', 'johnson.wei.056@gmail.com', '没有', '', '464963032', '15029239473', '计算机科学与技术', '00000000', '/wp-content/plugins/member_management/image/default.jpg'),
(19, 0, 'example103@163.com', '独舞秋魂', 'johnson.wei.056@gmail.com', '没有', '', '464963032', '15029239473', '计算机科学与技术', '00000000', '/wp-content/plugins/member_management/image/default.jpg'),
(20, 0, 'example104@163.com', '独舞秋魂', 'johnson.wei.056@gmail.com', '没有', '', '464963032', '15029239473', '计算机科学与技术', '00000000', '/wp-content/plugins/member_management/image/default.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
