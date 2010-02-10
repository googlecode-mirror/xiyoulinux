<?php
/*
Plugin Name: Project Management
Plugin URI: http://www.xiyoulinux.cn/
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
				project_manager varchar(255) DEFAULT NULL,
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
				PRIMARY KEY(project_ID)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
		
		//导入数据库操作文件
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($install_sql);
	    
	    //for init...
		$project_name = "Project Management";
		$project_manager = "SK";
		$project_member = "lucien, zhaogejuan, liuzhouping";
		$project_start_date = "2010-1-1";
		$project_finish_date = "2010-2-15";
		$project_intro = "manage linux group's project";
		$project_pic = "Project Management";
		$project_doc = "http://xiyoulinux.cn";
		$project_url = "http://code.google.com/p/xiyoulinux/";
		$project_download = "http://code.google.com/p/xiyoulinux/";
		$project_rss = "http://code.google.com/feeds/p/xiyoulinux/updates/basic";
		$project_auther_ID = 1;
		$project_tag = "project";
		
		$init_array = array('project_name' => $project_name, 
						'project_manager' => $project_manager,
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
						'project_tag' => $project_tag
						);

		$wpdb->insert($table_name, $init_array);

		//$insert_sql = "INSERT INTO " . $table_name . " (project_name, project_manager, project_info) " . "VALUES ('" . $project_name . "','" . $wpdb->escape($project_manager) . "','" . $wpdb->escape($project_info) . "')";
		
		//$results = $wpdb->query( $insert_sql );
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

//api for test show
function fn_project_show()
{
	//echo "show";
	include('frontstage/project_show.php');
}

//api for test list
function fn_project_list()
{
	//echo "list";
	include('frontstage/project_list.php');
}

// 在控制面板中添加控件
function project_dashboard_install() {
	if (function_exists('add_menu_page')) {
		add_menu_page('项目管理', '项目管理', 8, 'project', 'fn_project_index');
	}
	if (function_exists('add_submenu_page')) {
		add_submenu_page('project', '添加项目', '添加项目', 8, 'project_add', 'fn_project_add');
		add_submenu_page('project', '', '', 8, 'project_edit', 'fn_project_edit');
		add_submenu_page('project', '', '', 8, 'project_api', 'fn_project_api');
		add_submenu_page('project', '', '', 8, 'project_show', 'fn_project_show');
		add_submenu_page('project', '', '', 8, 'project_list', 'fn_project_list');
		
	}
}

//添加控件到主面板
add_action('admin_menu', 'project_dashboard_install');

/* EOF project_management.php */
?>
