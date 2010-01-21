<?php
session_start();
?>
<html>
	<head>
		<title>Linux Member Information</title>
	</head>	
	<body>
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
			if (!isset($_SESSION['user_name'])) { // 防止用户使用get方式提交
				echo "<script>window.location.replace('login.php')</script>";
			}
			class MemberInfo {
				public function MemberInfo() {}
				// 获得成员信息
				function getMemberInfo() {
					$devMemberInfo;
					if (isset($_POST['updateSettings'])) { // 如果是提交
						$devMemberInfo['member_name'] = $_SESSION['user_name'];
						if (isset($_POST['member_nickname'])) {
							$devMemberInfo['member_nickname'] = $_POST['member_nickname'];
						}
						if (isset($_POST['member_email'])) {
							$devMemberInfo['member_email'] = $_POST['member_email'];
						}
						if (isset($_POST['member_blog'])) {
							$devMemberInfo['member_blog'] = $_POST['member_blog'];
						}
						if (isset($_POST['member_rss_url'])) {
							$devMemberInfo['member_rss_url'] = $_POST['member_rss_url'];
						}
						if (isset($_POST['member_QQ'])) {
							$devMemberInfo['member_QQ'] = $_POST['member_QQ'];
						}
						if (isset($_POST['member_mobile'])) {
							$devMemberInfo['member_mobile'] = $_POST['member_mobile'];
						}
						if (isset($_POST['member_major'])) {
							$devMemberInfo['member_major'] = $_POST['member_major'];
						}
						if (isset($_POST['member_pwd'])) {
							if (isset($_POST['member_pwd_confirm']) && $_POST['member_pwd'] == $_POST['member_pwd_confirm']) {
								$devMemberInfo['member_pwd'] = $_POST['member_pwd'];
								$sql = "update xy_member set member_nickname = '" . $devMemberInfo['member_nickname'] .
								"', member_email = '" . $devMemberInfo['member_email'] . "', member_blog = '" . $devMemberInfo['member_blog'] .
								"', member_rss_url = '" . $devMemberInfo['member_rss_url'] . "', member_QQ = '" . $devMemberInfo['member_QQ'] .
								 "', member_mobile = '" . $devMemberInfo['member_mobile'] . "', member_major = '" . $devMemberInfo['member_major'] .
								 "', member_pwd = '" . $devMemberInfo['member_pwd'] . "' where member_name = '" . $devMemberInfo['member_name'] .
								 "'";
								$flag = mysql_query($sql);
								if ($flag) {
									echo "<script>document.getElementById('updateResult').innerHTML='更新已保存!'</script>";
								} else {
									echo "<script>document.getElementById('updateResult').innerHTML='更新异常!'</script>";
								}
							} else {
								echo "<script>document.getElementById('updateResult').innerHTML='两次密码不一致!'</script>";
							}
						}
					} else { // 如果是刚登陆
						$tmpInfo = mysql_query("select * from xy_member where member_name = '" .
							$_SESSION['user_name'] . "'");
						if (mysql_num_rows($tmpInfo)) { // 如果记录存在
							$row = mysql_fetch_array($tmpInfo);
							foreach($row as $key => $value) {
								if ($key != 'member_ID') {
									$devMemberInfo[$key] = $value;
								}
							}
						} else { // 用户在地址栏内直接输入地址试图跳转到本页
							echo "<script>window.location.replace('login.php')</script>";
						}	
					}
					return $devMemberInfo;
				}
				
			}
			$dl_memberInfo = new MemberInfo(); // 实例化MemberInfo()
			// 连接数据库
			$con = mysql_connect('localhost', 'root', '');
			if (!$con) {
				die('数据库连接失败！' . '<br />');
			}
			mysql_query("set names 'utf8'");
			mysql_select_db("xiyoulinux", $con);
			$memberInfo = $dl_memberInfo->getMemberInfo();
			mysql_close($con);
		?>
		<h3>成员信息</h3>
		<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post">
			<table>
				<tr>
					<td>用户名</td>
					<td><?php echo $memberInfo['member_name'];?></td>
				</tr>
				<tr>
					<td>真实姓名</td>
					<td><input type="text" name="member_nickname" 
						value="<?php echo $memberInfo['member_nickname'];?>"/></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><input type="text" name="member_email" 
						value="<?php echo $memberInfo['member_email'];?>"/></td>
				</tr>
				<tr>
					<td>Blog</td>
					<td><input type="text" name="member_blog" 
						value="<?php echo $memberInfo['member_blog'];?>"/></td>
				</tr>
				<tr>
					<td>Rss Url</td>
					<td><input type="text" name="member_rss_url" 
						value="<?php echo $memberInfo['member_rss_url'];?>"/></td>
				</tr>
				<tr>
					<td>QQ</td>
					<td><input type="text" name="member_QQ"
						value="<?php echo $memberInfo['member_QQ'];?>"/></td>
				</tr>
				<tr>
					<td>手机</td>
					<td><input type="text" name="member_mobile"
						value="<?php echo $memberInfo['member_mobile'];?>"/></td>
				</tr>
				<tr>
					<td>专业</td>
					<td><input type="text" name="member_major"
						value="<?php echo $memberInfo['member_major'];?>"/></td>
				</tr>
				<tr>
					<td>密码</td>
					<td><input type="password" name="member_pwd"/></td>
				</tr>
				<tr>
					<td>确认密码</td>
					<td><input type="password" name="member_pwd_confirm"/></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="updateSettings" value="提交更改"/></td>
				</tr>
			</table>
		</form>
	</body>
</html>