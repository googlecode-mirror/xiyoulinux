-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2010 年 01 月 20 日 14:56
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
  PRIMARY KEY (`member_ID`),
  UNIQUE KEY `member_name` (`member_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `xy_member`
--

INSERT INTO `xy_member` (`member_ID`, `member_category_ID`, `member_name`, `member_nickname`, `member_email`, `member_blog`, `member_rss_url`, `member_QQ`, `member_mobile`, `member_major`, `member_pwd`) VALUES
(1, 0, 'ybmmwjl@163.com', '独舞秋魂', '', '', '', '464963032', '15029239473', '计算机科学与技术', 'aaa'),
(2, 0, 'example@163.com', '赫拉克勒斯', '', '', '', '', '', '', '00000000'),
(3, 0, 'example1@163.com', '阿喀琉斯', '', '', '', '', '', '', '00000000'),
(4, 0, 'example11@163.com', '珀留斯', '', '', '', '', '', '', '00000000'),
(5, 0, 'example22@163.com', '阿波罗', '', '', '', '', '', '', '00000000'),
(6, 0, 'example222@163.com', '波塞冬', '', '', '', '', '', '', '00000000'),
(7, 0, 'example111@163.com', '宙斯', '', '', '', '', '', '', '00000000'),
(8, 0, 'example123@163.com', '哈德斯', '', '', '', '', '', '', '00000000'),
(9, 0, 'example321@163.com', '阿瑞斯', '', '', '', '', '', '', '00000000'),
(10, 0, 'examplea@163.com', '珀耳塞福捏', '', '', '', '', '', '', '00000000'),
(11, 0, 'example222d@163.com', '维纳斯', '', '', '', '', '', '', '00000000'),
(12, 0, 'exampleddd@163.com', '忒修斯', '', '', '', '', '', '', '00000000'),
(13, 0, 'exampleas@163.com', '赫克托耳', '', '', '', '', '', '', '00000000'),
(14, 0, 'example100@163.com', '埃阿斯', '', '', '', '', '', '', '00000000'),
(15, 0, 'example101@163.com', '盖亚', '', '', '', '', '', '', '00000000'),
(16, 0, 'example124@163.com', '赫拉', '', '', '', '', '', '', '00000000'),
(17, 0, 'example125@163.com', '雅典娜', '', '', '', '', '', '', '00000000'),
(18, 0, 'example102@163.com', '乌拉诺斯', '', '', '', '', '', '', '00000000'),
(19, 0, 'example103@163.com', '狄俄莫德斯', '', '', '', '', '', '', '00000000'),
(20, 0, 'example104@163.com', '普罗米修斯', '', '', '', '', '', '', '00000000');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
