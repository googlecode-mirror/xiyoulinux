<?php 
/*
 * File Name: project_show.php
 * Description:	项目前台展示
 */
 
include_once('project_config.php');
include_once('utils/project_api.php');

$myproject = new Project(1);

if($myproject->print_project_allow()==1) {
	$myproject->print_project_name();
	echo "<br/>";
	$myproject->print_project_manager();
	echo "<br/>";
	$myproject->print_project_member();
	echo "<br/>";
	$myproject->print_project_start_date();
	echo "<br/>";
	$myproject->print_project_finish_date();
	echo "<br/>";
	$myproject->print_project_intro();
	echo "<br/>";
	$myproject->print_project_pic();
	echo "<br/>";
	$myproject->print_project_doc();
	echo "<br/>";
	$myproject->print_project_url();
	echo "<br/>";
	$myproject->print_project_download();
	echo "<br/>";
	$myproject->print_project_rss();
	echo "<br/>";
	$myproject->print_project_auther_ID();
	echo "<br/>";
	$myproject->print_project_tag();
	echo "<br/>";
	$myproject->print_project_allow();
}
?>
