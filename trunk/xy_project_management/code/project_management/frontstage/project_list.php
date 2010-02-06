<?php 
/*
 * File Name: project_list.php
 * Description:	项目列表前台展示
 */
include('../wp-content/plugins/project_management/utils/project_api.php');

$page_size = 2;

if(isset($_GET['PB_page'])) {
	$current_page = intval($_GET['PB_page']);
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
	echo "<th>项目</th><th>管理者</th><th>成员</th><th>开始日期</th><th>截止日期</th><th>标签</th><th>操作</th>";
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

// 打印单行数据
function print_single_row($single_project) {
	echo "<tr><td>";
	echo $single_project->print_project_name()."</td><td>";
	echo $single_project->print_project_manager()."</td><td>";
	echo $single_project->print_project_member()."</td><td>";
	echo $single_project->print_project_start_date()."</td><td>";
	echo $single_project->print_project_finish_date()."</td><td>";
	echo $single_project->print_project_tag()."</td><td>";
	echo "<a href='admin.php?page=project_list&project_id=" . $single_project->print_project_id() . "'>编辑</a>|";
	echo "<a href='admin.php?page=project&action=remove&project_id=" . $single_project->print_project_id() . "'>删除</a></td>";
	echo "</tr>";
}

// 打印表尾
function print_project_foot($project_count, $page_size) {
	require_once('../wp-content/plugins/project_management/utils/page.class.php');
	
	$page=new page(array('total'=>$project_count, 'perpage'=>$page_size));
	echo '<br>'.$page->show();
}
?>

<div class="wrap">
	<table class="widefat post fixed" cellspacing="0">
		<thead>
			<tr><?php print_project_head();?></tr>
		</thead>		
		<tbody>
			<?php print_project_rows($project_count, $page_size, $current_page, $project_rs);?>
		</tbody>
		<tfoot>
			<tr><?php print_project_foot($project_count, $page_size);?></tr>
		</tfoot>
	</table>
</div>
