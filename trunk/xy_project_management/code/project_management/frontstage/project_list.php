<?php 
/*
 * File Name: project_list.php
 * Description:	项目列表前台展示
 */
$page_size = 2;
 
include('../wp-content/plugins/project_management/utils/project_api.php');

//$myproject = new Project(1);
//$myproject->print_project_name();
if(isset($_GET['PB_page'])) {
	$current_page = intval($_GET['PB_page']);
}
else {
	$current_page = 1;
}
echo "current_page: ".$current_page;
$project_rs = get_project_list();
$project_count = count($project_rs);
echo "<br>project_count: ".$project_count;
if ($project_count<$page_size) {
	//$page_count = 1;
	for($i=0; $i<=$project_count-1; $i++) {
		echo "<br>".$project_rs[$i]->print_project_name();
	}
}
else {
	if($project_count<$current_page*$page_size) {
		$last_count = $project_count - 1;
	}
	else {
		$last_count = $current_page*$page_size-1;
	}
	echo "<br>last_count: ".$last_count;
	for($i=($current_page-1)*$page_size; $i<=$last_count; $i++) {
		//echo "<br>".$i;
		echo "<br>";
		echo $project_rs[$i]->print_project_name();
		
	}
}

require_once('../wp-content/plugins/project_management/utils/page.class.php');

$page=new page(array('total'=>$project_count, 'perpage'=>$page_size));
echo '<br>'.$page->show();

?>
