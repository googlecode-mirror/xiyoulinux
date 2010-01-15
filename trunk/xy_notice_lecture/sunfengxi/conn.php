<?php
$connection = mysql_connect ("localhost","root","suninrain");//主义修改
mysql_select_db ("xiyoulinux");
//mysql_select_db ("cms");
mysql_query("SET NAMES utf8"); 
if(!$connection){
	echo "<script>alert('数据库连接失败,请联系管理员');</script>";
}
?>

