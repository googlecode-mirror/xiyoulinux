<?php
require_once("config.php");
if (isset($_FILES["my_img"])) {
	$type = $_FILES["my_img"]["type"];
	if (($type == "image/jpeg") || ($type == "image/pjpeg")) { // ie必须是pjpeg，firefox必须是jpeg，其他无要求
		$size = $_FILES["my_img"]["size"];
	    $dir = "../image";
		$newName = $_POST["member_name"] . ".jpg";	// 以用户名命名图片，这样图片就会唯一
		if (!is_dir($dir)) {
		    mkdir($dir); // Linux， Windows皆可.mode 在 Windows 下被忽略。自 PHP 4.2.0 起成为可选项。 
		    		     // 默认的 mode 是 0777，意味着最大可能的访问权。有关 mode 的更多信息请阅读 chmod() 页面。 
		}
		$newName = $dir . "/" . $newName;
		// 将图片的路径存入数据库
		$con = mysql_connect($server, $userName, $password);
		mysql_query("set name 'utf8'");
		mysql_select_db("xiyoulinux");
		move_uploaded_file($_FILES["my_img"]["tmp_name"], $newName);
		mysql_query("update xy_member set member_image = '" . $_SESSION['image_path'] . 
			"' where member_name = '" . $_SESSION['user_name'] . "'");
		mysql_close($con);
	}
}
?>