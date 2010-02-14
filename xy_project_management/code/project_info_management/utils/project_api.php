<?php 
/*
 * File Name: project_api.php
 * Description:	项目API函数集
 */
//echo "before project_api";
include_once('../project_config.php');
//echo project_path;
require_once(project_info_path.'/../wordpress/wp-config.php');

// for print project's feed
function print_feed($myfeed='http://code.google.com/feeds/p/xiyoulinux/updates/basic', $feedtitle='西邮Linux小组网站更新', $shownumber = '3'){
	require_once (ABSPATH . WPINC . '/rss-functions.php');
	
	$rss = @fetch_rss($myfeed);
	if(isset($rss->items) && 0 != count($rss->items)) {
		echo '<h3>' . $feedtitle . '</h3><ul>';
		$rss->items = array_slice($rss->items, 0, $shownumber);
		foreach ($rss->items as $item) {
			$title = $item['title'];
			$title_url = $item['link'];
			echo "<br>TITLE: ".$title;
			//echo "<br>URL: ".$title_url;
			//echo "<li><a href=$url>$title</a></li>";
			//echo $item['description'];
		}
	}
	echo "</ul>";
}
//print_feed();

// for get project list
function get_project_list() {
	global $wpdb;
	$table_name = 'xy_project';
	
	$select_sql = "SELECT project_ID FROM " . $table_name . " WHERE project_allow = 1";
	$results = $wpdb->get_results($select_sql);
	//echo $select_sql;
	$project_list = array();

	foreach($results as $itemp) {
		//echo $itemp->project_ID." ";
		$myprojecttemp = new Project($itemp->project_ID);
		//$myprojecttemp->print_project_name();
		array_push($project_list, $myprojecttemp);
	}
	return $project_list;
}
//get_project_list();

// for single project
class Project {
	private $project_id = "0";
	private $project_name = "test";
	//private $project_manager = "test";
	private $project_member = "test";
	private $project_start_date = "2010-01-01";
	private $project_finish_date = "2010-01-01";
	private $project_intro = "test";
	private $project_pic = "test";
	private $project_doc = "test";
	private $project_url = "test";
	private $project_download = "test";
	private $project_rss = "test";
	private $project_auther_ID = 1;
	private $project_tag = "test";
	private $project_allow = 0;
	
	//构造
	function __construct($id) {
		global $wpdb;
		$table_name = 'xy_project';
		
		$select_sql = "SELECT * FROM " . $table_name . " WHERE project_ID = ".$id;
		$row = $wpdb->get_row($select_sql);
		$this->project_id = $id;
		//echo $this->project_id;
		$this->project_name = $row->project_name;
		//echo $this->project_name;
		//$this->project_manager = $row->project_manager;
		$this->project_member = $row->project_member;
		$this->project_start_date = $row->project_start_date;
		$this->project_finish_date = $row->project_finish_date;
		$this->project_intro = $row->project_intro;
		$this->project_pic = $row->project_pic;
		$this->project_doc = $row->project_doc;
		$this->project_url = $row->project_url;
		$this->project_download = $row->project_download;
		$this->project_rss = $row->project_rss;
		$this->project_auther_ID = $row->project_auther_ID;
		$this->project_tag = $row->project_tag;
		$this->project_allow = $row->project_allow;
	}
	//显示项目ID
	public function print_project_id() {
	
		echo $this->project_id;
	}
	//显示项目名称
	public function print_project_name() {
	
		echo $this->project_name;
	}
	//显示项目管理者
	//public function print_project_manager() {
		
	//	echo $this->project_manager;
	//}
	//显示项目成员
	public function print_project_member() {
		
		echo $this->project_member;
	}
	//显示项目开始日期
	public function print_project_start_date() {
		
		echo $this->project_start_date;
	}
	//显示项目结束日期
	public function print_project_finish_date() {
		
		echo $this->project_finish_date;
	}
	//显示项目简介
	public function print_project_intro() {
		
		echo $this->project_intro;
	}
	//显示项目截图
	public function print_project_pic() {
		
		echo $this->project_pic;
	}
	//显示项目文档
	public function print_project_doc() {
		
		echo $this->project_doc;
	}
	//显示项目地址
	public function print_project_url() {
		
		echo $this->project_url;
	}
	//显示项目下载地址
	public function print_project_download() {
		
		echo $this->project_download;
	}
	//显示项目更新
	public function print_project_rss() {
		//echo $this->project_rss;
		print_feed($this->project_rss, $this->project_name, 5);
	}
	//获取项目创建者ID
	public function print_project_auther_ID() {
		
		return $this->project_auther_ID;
	}
	//显示项目标签
	public function print_project_tag() {
		
		echo $this->project_tag;
	}
	//获取项目审核
	public function get_project_allow() {
		
		return $this->project_allow;
	}
}
//$myproject = new Project(1);
//$myproject->print_project_name();
//echo "after project_api";
?>
