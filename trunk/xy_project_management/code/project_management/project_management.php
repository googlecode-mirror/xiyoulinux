<?php
/*
Plugin Name: Project Management
Plugin URI: http://code.google.com/p/xiyoulinux/
Description: 项目管理
Version: 0.2
Author: SK, LUCIEN
Author URI: http://www.xiyoulinux.cn/
*/

//定义数据库版本，以备后期升级
$project_db_version = "0.1";

//创建项目管理数据库表
function project_install() {
	global $wpdb;
	global $project_db_version;
	
	$table_name = "xy_project";
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		$install_sql = "CREATE TABLE " . $table_name . " (
				project_ID bigint(20) unsigned NOT NULL AUTO_INCREMENT,
				project_name varchar(255) DEFAULT NULL,
				project_member varchar(255) DEFAULT NULL,
				project_start_date date DEFAULT NULL,
				project_finish_date date DEFAULT NULL,
				project_intro text,
				project_pic varchar(255) DEFAULT NULL,
				project_doc varchar(255) DEFAULT NULL,
				project_url varchar(255) DEFAULT NULL,
				project_download varchar(255) DEFAULT NULL,
				project_rss varchar(255) DEFAULT NULL,
				project_auther_ID bigint(20) unsigned DEFAULT NULL,
				project_tag varchar(255) DEFAULT NULL,
				project_allow tinyint(1) DEFAULT 0,
				PRIMARY KEY(project_ID)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
		
		//导入数据库操作文件
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($install_sql);
	    
	    //for init...
		$project_name = "ZeroClipboard";
		$project_member = "test1, test2, test3, test4";
		$project_start_date = "2010-1-1";
		$project_finish_date = "2010-2-15";
		$project_intro = "在IE6时代，复制到剪贴板非常简单。但是如今Firefox等浏览器出于安全考虑，默认禁止直接访问剪贴板。对于某些必须具备访问剪贴板能力的网站，通过使用强大的Javascript和Flash文件，ZeroClipboard可以让你绕过浏览器的限制。";
		$project_pic = "ZeroClipboard.gif";
		$project_doc = "http://code.google.com/p/zeroclipboard/";
		$project_url = "http://code.google.com/p/zeroclipboard/";
		$project_download = "http://zeroclipboard.googlecode.com/files/zeroclipboard-1.0.5.tar.gz";
		$project_rss = "http://code.google.com/feeds/p/zeroclipboard/updates/basic";
		$project_auther_ID = 0;
		$project_tag = "project, clipboard";
		$project_allow = 1;
		
		$init_array = array('project_name' => $project_name, 
						'project_member' => $project_member,
						'project_start_date' => $project_start_date,
						'project_finish_date' => $project_finish_date,
						'project_intro' => $project_intro,
						'project_pic' => $project_pic,
						'project_doc' => $project_doc,
						'project_url' => $project_url,
						'project_download' => $project_download,
						'project_rss' => $project_rss,
						'project_auther_ID' => $project_auther_ID,
						'project_tag' => $project_tag,
						'project_allow' => $project_allow,
						);

		$wpdb->insert($table_name, $init_array);
	}
}

//当激活插件时执行，添加数据库
register_activation_hook(__FILE__, 'project_install');

//index
function fn_project_index()
{
	include('wp_backstage/project_index.php');
	//include('project_config.php');
}

//add
function fn_project_add()
{
	include('wp_backstage/project_add.php');
}

//edit
function fn_project_edit()
{
	include('wp_backstage/project_edit.php');
}

//api for test
function fn_project_api()
{
	include('utils/project_api.php');
}

// 在控制面板中添加控件
function project_dashboard_install() {
	if (function_exists('add_menu_page')) {
		add_menu_page('项目管理', '项目管理', 8, 'project', 'fn_project_index');
	}
	if (function_exists('add_submenu_page')) {
		add_submenu_page('project', '添加项目', '添加项目', 8, 'project_add', 'fn_project_add');
		add_submenu_page('project', '', '', 8, 'project_edit', 'fn_project_edit');
		//add_submenu_page('project', '', '', 8, 'project_api', 'fn_project_api');
		
	}
}

//添加控件到主面板
add_action('admin_menu', 'project_dashboard_install');

/* EOF project_management.php */
?>
