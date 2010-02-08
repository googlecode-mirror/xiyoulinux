<?php
	include "./includes/func.php";
	include "./includes/mysql_op.php";
//	include "./includes/xml_op.php";
	$feed_url=$_GET['feed_url'];
?>
<!-- begin of RSS show -->
<?php
	show_top();
?>
<body>
<div id="page">
 <?php require('./includes/head.php');?>
<div id="content">
	<div id="sub_list">		<!-- begin of list show -->
<?php
	show_list();
?>
	<div id="space"></div>
	</div>				<!-- end of list show -->
	<div id="blog">			<!-- begin of contentWrapper -->
<?php
	ShowOneRSS($feed_url);
?>
	</div>				<!-- end of contentWrapper -->
</div>					<!-- end of mainwindow -->
</div>
<!-- begin of bottom show -->
   <?php require("./includes/foot.php")?>
</body>
</html>
