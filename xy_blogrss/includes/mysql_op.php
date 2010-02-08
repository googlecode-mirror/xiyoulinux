<?php
/*
 * 数据库地址: localhost
 * 用户名： root
 * 密码： root
 * 数据库表：
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE IF NOT EXISTS `xy_category` (
  `category_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_type` varchar(255) DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `category_order` int(11) unsigned DEFAULT NULL,
  `catetory_display` int(11) DEFAULT '1',
  PRIMARY KEY (`category_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

CREATE TABLE IF NOT EXISTS `xy_member` (
  `member_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `member_category_ID` bigint(20) unsigned DEFAULT '0',
  `member_login_name` varchar(255) NOT NULL DEFAULT '',
  `member_real_name` varchar(255) DEFAULT '该成员尚未添加',
  `member_blog` varchar(255) DEFAULT '',
  `member_rss_url` varchar(255) DEFAULT '',
  `member_show_rss` char(1) DEFAULT 'N',
  `member_QQ` varchar(255) DEFAULT '',
  `member_mobile` varchar(255) DEFAULT '',
  `member_major` varchar(255) DEFAULT '',
  `member_pwd` varchar(255) NOT NULL DEFAULT '00000000',
  `member_image` varchar(255) NOT NULL DEFAULT 'http://localhost/wordpress/wp-content/plugins/member_management/image/default.jpg',
  PRIMARY KEY (`member_ID`),
  UNIQUE KEY `member_name` (`member_login_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

 */
$hostip = "localhost";
$user = "root";
$passwd = "root";
$db_name = "xiyoulinux";

/*
	$conn = mysql_connect("localhost","root","root")or die("connect err:".MySql_error());
	echo "链接MySql数据库成功！";
	mysql_select_db("rssreader");
	$Sql = "select category,link,title from xyreader";
	$result = mysql_query($Sql, $conn);
	while($row = mysql_fetch_array($result)) {
		echo $row["link"];
	}
	mysql_close($conn);
*/
/*
 * 数据库操作
 */
function show_list() {
	/*
	 *各个年级记录人数的标记 
	 */
	$c4 = 0;
	$c5 = 0;
	$c6 = 0;
	$c7 = 0;

	$conn = mysql_connect("localhost","root","root")or die("connect err:".MySql_error());
//	$conn = mysql_connect($hostip,$user,$passwd)or die("connect err:".MySql_error());
	if($conn) {
		mysql_select_db("xiyoulinux");		//此处需要修改数据库名称
		$sql = "select xy_member.member_blog,xy_member.member_rss_url,xy_category.category_name from xy_category,xy_member where xy_member.member_category_ID=xy_category.category_ID and xy_member.member_rss_url!=''";
		//$sql = "select category,link,title from xyreader";
		$result = mysql_query($sql, $conn);
		while($row = mysql_fetch_array($result)) {
			//echo $row[0];
			//echo $row[1];
			//echo $row[2];
			if($row[2] == 07) {
				$category7title[$c7] = $row[0];
				$category7link[$c7] = $row[1];
				$c7++; 
			}
			else if($row[2] == 06) {
				$category6title[$c6] = $row[0];
				$category6link[$c6] = $row[1];
				$c6++; 
			}
			else if($row[2] == 05) {
				$category5title[$c5] = $row[0];
				$category5link[$c5] = $row[1];
				$c5++;
			}
			else if($row[2] <= 04) {
				$category4title[$c4] = $row[0];
				$category4link[$c4] = $row[1];
				$c4++; 
			}
		}
	}
	else {
		echo "数据库链接失败！";
	}
	mysql_close($conn);
/*
 *数据查询结束，开始数据显示
 */
echo "<ul id=\"nav\">";
	echo "<li class=\"current\">";
	echo "<a href=\"#\"><img src=\"images/sub_list_03.gif\"><div class=\"text_seclect\">07级成员博客</div></a>";
	echo "<ul>";
	for($i = 0; $i < $c7; $i++) {
		echo "<li><a href='?feed_url=".$category7link[$i]."' title='".$category7title[$i]."' onmouseover='hover1(this.style)' onmouseout='hout1(this.style)'>";
		echo "<strong>".$category7title[$i]."</strong><img src=\"images/sub_list_04.gif\"></a></li>";
	}
	echo "</ul></li>";
	
	echo "<li class=\"current\">";
	echo "<a href=\"#\"><img src=\"images/sub_list_03.gif\"><div class=\"text_seclect\">06级成员博客</div></a>";
	echo "<ul>";
	for($i = 0; $i < $c6; $i++) {
		echo "<li><a title='".$category6title[$i]."' href='?feed_url=".$category6link[$i]."' onmouseover='hover1(this.style)' onmouseout='hout1(this.style)'>";
		echo "<strong>".$category6title[$i]."</strong></a></li>";
	}
	echo "</ul></li>";

	echo "<li class=\"current\">";
	echo "<a href=\"#\"><img src=\"images/sub_list_03.gif\"><div class=\"text_seclect\">05级成员博客</div></a>";
	echo "<ul>";
	for($i = 0; $i < $c5; $i++) {
		echo "<li><a title='".$category5title[$i]."' href='?feed_url=".$category5link[$i]."' onmouseover='hover1(this.style)' onmouseout='hout1(this.style)'>";
		echo "<strong>".$category5title[$i]."</strong></a></li>";
	}
	echo "</ul></li>";

	echo "<li class=\"current\">";
	echo "<a href=\"#\"><img src=\"images/sub_list_03.gif\"><div class=\"text_seclect\">04级成员博客</div></a>";
	echo "<ul>";
	for($i = 0; $i < $c4; $i++) {
		echo "<li><a title='".$category4title[$i]."' href='?feed_url=".$category4link[$i]."' onmouseover='hover1(this.style)' onmouseout='hout1(this.style)'>";
		echo "<strong>".$category4title[$i]."</strong></a></li>";
	}
	echo "</ul></li>";
echo "</ul>";
}
?>

