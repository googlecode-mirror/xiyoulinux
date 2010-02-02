<?php
/*
Plugin Name: project_management
Plugin URI: http://www.xiyoulinux.cn/
Description: 项目管理
Version: 0.1
Author: SK
Author URI: http://www.xiyoulinux.cn/
*/

//定义数据库版本，以备后期升级
$project_db_version = "0.1";

//创建项目管理数据库表
function project_install() {
	global $wpdb;
	global $project_db_version;
	
	$table_name = $wpdb->prefix . "project";
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		$install_sql = "CREATE TABLE " . $table_name . " (
				project_ID bigint(20) unsigned NOT NULL AUTO_INCREMENT,
				project_name varchar(255) DEFAULT NULL,
				project_manager varchar(255) DEFAULT NULL,
				project_member varchar(255) DEFAULT NULL,
				project_start_date date DEFAULT NULL,
				project_finish_date date DEFAULT NULL,
				project_info text,
				project_pic varchar(255) DEFAULT NULL,
				project_doc varchar(255) DEFAULT NULL,
				project_url varchar(255) DEFAULT NULL,
				project_auther_ID bigint(20) unsigned DEFAULT NULL,
				project_tag varchar(255) DEFAULT NULL,
				PRIMARY KEY(project_ID)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
		
		//导入数据库操作文件		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($install_sql);
	
		$project_name = "SK";
		$project_manager = "SK";
		$project_info = "project_management";

		$insert_sql = "INSERT INTO " . $table_name . " (project_name, project_manager, project_info) " .
            "VALUES ('" . $project_name . "','" . $wpdb->escape($project_manager) . "','" . $wpdb->escape($project_info) . "')";

		$results = $wpdb->query( $insert_sql );
	}
}

//当激活插件时执行，添加数据库
register_activation_hook(__FILE__, 'project_install');

//index
function fn_project_index()
{
	include('../wp-content/plugins/project_management/project_index.php');
}

//add
function fn_project_add()
{
	include('../wp-content/plugins/project_management/project_add.php');
}

// 在控制面板中添加控件
function project_dashboard_install() {
	if (function_exists('add_menu_page')) {
		add_menu_page('项目管理', '项目管理', 8, 'project', 'fn_project_index');
	}
	if (function_exists('add_submenu_page')) {
		add_submenu_page('project', '添加项目', '添加项目', 8, 'project_add', 'fn_project_add');
	}
}

//添加控件到主面板
add_action('admin_menu', 'project_dashboard_install');

/* EOF project_management.php */
?>
