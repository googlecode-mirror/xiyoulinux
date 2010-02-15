<?php header("Content-Type: text/html; charset=utf-8");?>
<?php 
/*
 * File Name: project_list.php
 * Description:	项目列表前台展示
 */
 
include_once('project_config.php');
include_once('utils/project_api.php');

$page_size = 3;

if(isset($_GET['page'])) {
	$current_page = intval($_GET['page']);
}
else {
	$current_page = 1;
}
//echo "current_page: ".$current_page;
$project_rs = get_project_list();
$project_count = count($project_rs);
//echo "<br>project_count: ".$project_count;

// 打印表头
function print_project_head() {
	echo "<th>项目</th><th>管理者</th><th>成员</th><th>开始日期</th><th>截止日期</th><th>标签</th>";
}

// 打印本页数据
function print_project_rows($project_count, $page_size, $current_page, $project_rs) {
	if ($project_count<$page_size) {
		for($i=0; $i<=$project_count-1; $i++) {
			print_single_row($project_rs[$i]);
		}
	}
	else {
		if($project_count<$current_page*$page_size) {
			$last_count = $project_count - 1;
		}
		else {
			$last_count = $current_page*$page_size-1;
		}
		//echo "<br>last_count: ".$last_count;
		for($i=($current_page-1)*$page_size; $i<=$last_count; $i++) {
			print_single_row($project_rs[$i]);
		}
	}
}

// 打印表尾
function print_project_foot($project_count, $page_size) {
	require_once('utils/page.class.php');
	
	$page=new page(array('total'=>$project_count, 'perpage'=>$page_size));
	//echo '<div id="project_page">'.$page->show(7).'</div>';
	echo $page->show(7);
	//echo project_info_path;
}
?>

<?php 
// 打印单行数据
function print_single_row($single_project) {
?>
<div id="project">
	<div class="project_list">
		<div class="project_content">
			<div class="project_title">
				<div class="project_title_side"><img src="images/project_title_01.gif"></div>
				<div class="project_title_text">
				<a href='project_show.php?project=<?php $single_project->print_project_id();?>'><span><?php $single_project->print_project_name();?></span></a><a href=<?php $single_project->print_project_download();?>><img src="images/project_title_06.gif"></a>
				</div>
				<div class="project_title_side"><img src="images/project_title_02.gif"></div>
			</div>
			<div class="project_info">
				<p><?php $single_project->print_project_intro();?></p>
			</div>
			<div class="project_link">
				<a href="#"><img src="images/project_title_04.gif"></a><a href="#">linux</a> <a href="#">embed</a><a href="#">http server</a><a href="#">lightlevel</a>
			</div>
		</div>
		<div class="project_pic"><img src=<?php project_info_path.$single_project->print_project_pic();?>></div>
	</div>
</div>
<?php
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/sub_style.css" rel="stylesheet" type="text/css" />
		<script src="js/function.js" type="text/javascript"></script>
		<title>xiyoulinux</title>
	</head>
	<body>
		<div id="page">
			<?php require('head.php');?>
		    <div id="content">
		       <?php print_project_rows($project_count, $page_size, $current_page, $project_rs);?>
		       <div id="project_page">
		        <?php print_project_foot($project_count, $page_size);?>
		       </div>
			</div>
		</div>
		<?php require("foot.php")?>
	</body>
</html>
