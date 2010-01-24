<?php 
	session_start();
	unset($_SESSION['user_name']);
	require_once("config.php");
?>
<html>
	<head>
		<title>成员登陆</title>
	<script src="../js/function.js"></script>
	</head>
	<body>
		<form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post" name="form1">
			<table>
				<tr>
					<td>用户名</td>
					<td><input type="text" name="user_name" value="<?php echo $_POST['user_name'];?>"/></td>
					<td><font color="red"><span id="user_name_error"></span></font></td>
				</tr>
				<tr>
					<td>密码</td>
					<td><input type="password" name="user_pwd"/></td>
					<td><font color="red"><span id="user_pwd_error"></span></font></td>
				</tr>
				<tr>
					<td colspan="2"><input type="button" onclick="checkForm()" value="登录"/></td>
				</tr>
			</table>
		</form>
		<?php
			if (isset($_POST['user_name']) && isset($_POST['user_pwd'])) {
				$con = mysql_connect($server, $userName, $password);
				if (!$con) {
					die("数据库连接失败！");
				}
				mysql_query("set names utf8");
				mysql_select_db("xiyoulinux", $con);
				$result = mysql_query("select * from xy_member where member_name = '"
					 . $_POST['user_name'] . "'");
				if (mysql_num_rows($result)) { // 如果用户记录存在
					$row = mysql_fetch_array($result);					
					if ($_POST['user_pwd'] == $row['member_pwd']) { // 比较密码是否相同
						$_SESSION['user_name'] = $_POST['user_name']; // 注册用户
						echo "<script>window.location.replace('member_info.php');</script>"; 
					} else { // 密码错误
						echo "<script>document.getElementById('user_pwd_error').innerHTML='Wrong Password';</script>";
					}
				} else { // 非法用户
					echo "<script>document.getElementById('user_name_error').innerHTML='User does not exist!';</script>";
				}
				mysql_close($con);
			}
		?>
	</body>
</html>