<?php
session_start();
require_once("config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>Linux Member Information</title>
		<meta http-equiv="Content-Type" content="text/html"/>
	</head>	
	<body>
	<script src="../js/function.js"></script>	
		<div align="right">
		欢迎&nbsp;<font color="red"><?php echo $_SESSION['user_name'];?></font>
		&nbsp;&nbsp;
		<?php
			date_default_timezone_set('UTC');		
			echo '今天是' . date('Y年m月d日');
		?>
		&nbsp;&nbsp;&nbsp;
		<input type="button" value="安全退出" 
			onclick="window.location.replace('login.php')"/>
		</div>
		<hr/>
		<span style="color: AA0000" id="updateResult"></span>
		<?php
			include("backstage.php");	
			// 调用JS中的goto函数将图像等比缩小后显示
			echo "<script type='text/javascript'>goto('" . $image_path ."');</script>"
		?>
		
		<h3>成员信息</h3>
		<form name="form2" action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="updateSettings"/>
			<table>
				<tr>
					<th>头像</th>
					<td><input type="file" name="my_img" onchange="goto(this.value)"/>
						<font color="red">小于512KB，尺寸不超过200*200像素</font>
						</td>
					<td rowspan="5"><img alt="image" id="showImg" /></td>
				</tr>
				<tr>
					<th>用户名</th>
					<td><input type="text" size="30" name="member_name" value="<?php echo $memberInfo['member_name'];?>" readonly="readonly"/>&nbsp;
					<font color="red">不能修改</font></td>
				</tr>
				<tr>
					<th>真实姓名</th>
					<td><input type="text" size="30"  name="member_nickname" 
						value="<?php echo $memberInfo['member_nickname'];?>"/></td>
				</tr>
				<tr>
					<th>Email</th>
					<td><input type="text" size="30"  name="member_email" 
						value="<?php echo $memberInfo['member_email'];?>"/></td>
				</tr>
				<tr>
					<th>Blog</th>
					<td><input type="text" size="30"  name="member_blog" 
						value="<?php echo $memberInfo['member_blog'];?>"/></td>
				</tr>
				<tr>
					<th>Rss Url</th>
					<td><input type="text"  size="30" name="member_rss_url" 
						value="<?php echo $memberInfo['member_rss_url'];?>"/></td>
				</tr>
				<tr>
					<th>QQ</th>
					<td><input type="text"  size="30" name="member_QQ"
						value="<?php echo $memberInfo['member_QQ'];?>"/></td>
				</tr>
				<tr>
					<th>手机</th>
					<td><input type="text" size="30"  name="member_mobile"
						value="<?php echo $memberInfo['member_mobile'];?>"/></td>
				</tr>
				<tr>
					<th>专业</th>
					<td><input type="text"  size="30" name="member_major"
						value="<?php echo $memberInfo['member_major'];?>"/></td>
				</tr>
				<tr>
					<th>密码</th>
					<td><input type="password" size="30" name="member_pwd" 
						value="<?php echo $memberInfo['member_pwd'];?>"/></td>
				</tr>
				<tr>
					<th>确认密码</th>
					<td><input type="password" size="30" name="member_pwd_confirm"/>&nbsp;
					<font color="red">不修改密码此项不填</font>	
					</td>
				</tr>
				<tr>
					<td colspan="2"><input type="button" value="提交更改" onclick="check()"/></td>
				</tr>
			</table>
		</form>
	</body>
</html>