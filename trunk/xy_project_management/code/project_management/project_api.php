<?php 
/*
 * File Name: project_api.php
 * Description:	项目API函数集
 */

class Project {
	private $project_name = "test";
	private $project_manager = "test";
	private $project_member = "test";
	private $project_start_date = "2010-01-01";
	private $project_finish_date = "2010-01-01";
	private $project_intro = "test";
	private $project_pic = "test";
	private $project_doc = "test";
	private $project_url = "test";
	private $project_auther_ID = 1;
	private $project_tag = "test";
	
	//构造
	function __construct($id) {
		global $wpdb;
		$table_name = 'xy_project';
		
		$select_sql = "SELECT * FROM " . $table_name . " WHERE project_ID = ".$id;
		$row = $wpdb->get_row($select_sql);
		
		$this->project_name = $row->project_name;
		echo $this->project_name;
		$this->project_manager = $row->project_manager;
		$this->project_member = $row->project_member;
		$this->project_start_date = $row->project_start_date;
		$this->project_finish_date = $row->project_finish_date;
		$this->project_intro = $row->project_intro;
		$this->project_pic = $row->project_pic;
		$this->project_doc = $row->project_doc;
		$this->project_url = $row->project_url;
		$this->project_auther_ID = $row->project_auther_ID;
		$this->project_tag = $row->project_tag;
	}
	
	public function testppp() {
		echo "testppp";
	}
	
	//显示项目名称
	public function print_project_name() {
		echo "test3";
		echo $this->project_name;
	}
	//显示项目管理者
	public function print_project_manager() {
		
		echo $this->project_manager;
	}
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
	//显示项目创建者
	public function print_project_auther_ID() {
		
		echo $this->project_auther_ID;
	}
	//显示项目标签
	public function print_project_tag() {
		
		echo $this->project_tag;
	}
}

$myproject = new Project(1);
echo " test2";
$myporject->testppp();
echo "test4";
?>
