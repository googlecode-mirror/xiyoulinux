<?php
/*
 * 如果改变服务器或者目录或者数据库，可能需要修改下列参数。
 */
 
// 数据库
$server = "localhost";
$userName = "root";
$password = "";

// 用户图片保存目录
// 注意此目录路径可以是物理路径，也可以是虚拟路径
$image_path = "http://localhost/member_info_management/image/" . $_SESSION['user_name'] . ".jpg";
// 将图片目录存入Session
$_SESSION['image_path'] = $image_path;
?>