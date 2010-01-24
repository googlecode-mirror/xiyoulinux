<?php
if (!isset($_SESSION['user_name'])) { // 防止用户使用get方式提交
	echo "<script>window.location.replace('login.php')</script>";
}
require_once("config.php");
include("image_upload.php");
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
			$result = mysql_query("select * from xy_member where member_name = '" . $_POST['member_name'] . "'");
			$row = mysql_fetch_array($result);
			if ($row['member_pwd'] != $_POST['member_pwd']) { // 密码被修改
				if ($_POST['member_pwd'] == $_POST['member_pwd_confirm']) {
					$devMemberInfo['member_pwd'] = $_POST['member_pwd'];
					$pwd_through = 1;
				} else {
					$pwd_through = 0;
					$devMemberInfo['member_pwd'] = $row['member_pwd'];	
				}
			} else {
				$pwd_through = 1;
				$devMemberInfo['member_pwd'] = $row['member_pwd'];	
			}
			$sql = "update xy_member set member_nickname = '" . $devMemberInfo['member_nickname'] .
					"', member_email = '" . $devMemberInfo['member_email'] . "', member_blog = '" . $devMemberInfo['member_blog'] .
					"', member_rss_url = '" . $devMemberInfo['member_rss_url'] . "', member_QQ = '" . $devMemberInfo['member_QQ'] .
					"', member_mobile = '" . $devMemberInfo['member_mobile'] . "', member_major = '" . $devMemberInfo['member_major'] .
					"', member_pwd = '" . $devMemberInfo['member_pwd'] . "' where member_name = '" . $devMemberInfo['member_name'] . "'";
			$flag = mysql_query($sql);
			if ($flag) {
				if (!$pwd_through) {
					echo "<script>document.getElementById('updateResult').innerHTML='两次密码不一致!'</script>";
				} else {
					echo "<script>document.getElementById('updateResult').innerHTML='更新已保存!'</script>";
				}
			} else {
				echo "<script>document.getElementById('updateResult').innerHTML='更新异常!'</script>";
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
$con = mysql_connect($server, $userName, $password);
if (!$con) {
	die('数据库连接失败！' . '<br />');
}
mysql_query("set names 'utf8'");
mysql_select_db("xiyoulinux", $con);
$memberInfo = $dl_memberInfo->getMemberInfo();
mysql_close($con);
?>