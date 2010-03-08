<?php header("Content-Type: text/html; charset=utf-8");?>
<?php
	include_once('../project_config.php');
	//echo project_path;
	require_once(project_info_path.'/../wordpress/wp-config.php');
?>
<?php
	function project_check($post, $file)
	{
		//验证
		if(!checkdate($post['project_start_date']))
		{
			$post['project_start_date'] = date("Y-m-d");
		}
		if(!checkdate($post['project_finish_date']))
		{
			$post['project_finish_date'] = date("Y-m-d");
		}
		if(!is_numeric($post['project_auther_ID']))
		{
			$post['project_auther_ID'] = 0;
		}
		
		if($file["file"]["name"]!="")
		{
			$post['project_pic'] = "/project_images/".$file['file']['name'];
			if(file_exists('../wp-content/plugins/project_management/project_images/'.$file['file']['name']))
			{
				echo "this pic already in project_images!";
			}
			else
			{
				move_uploaded_file($file['file']['tmp_name'], '../wp-content/plugins/project_management/project_images/'.$file['file']['name']);
			}
		}
		
		$row = array('project_name' => $post['project_name'], 
					'project_manager' => $post['project_manager'],
					'project_member' => $post['project_member'],
					'project_start_date' => $post['project_start_date'],
					'project_finish_date' => $post['project_finish_date'],
					'project_intro' => $post['project_intro'],
					'project_pic' => $post['project_pic'],
					'project_doc' => $post['project_doc'],
					'project_url' => $post['project_url'],
					'project_auther_ID' => $post['project_auther_ID'],
					'project_tag' => $post['project_tag']
					);
		return $row;
	}
	
	function project_remove($project_id)
	{
		global $wpdb;
		$table_name = 'xy_project';
		
		$wpdb->query("DELETE FROM " . $table_name . " WHERE project_ID = $project_id");
	}
	
	function project_edit($project_id, $post, $file)
	{
		global $wpdb;
		$table_name = 'xy_project';
		
		$row = project_check($post, $file);
		
		$wpdb->update($table_name, $row, array('project_ID' => $project_id));
	}
	
	function project_add($post, $file)
	{
		global $wpdb;
		$table_name = 'xy_project';
		
		$row = project_check($post, $file);

		$wpdb->insert("xy_project", $row);
	}
?>
