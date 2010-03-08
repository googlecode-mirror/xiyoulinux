<?php header("Content-Type: text/html; charset=utf-8");?>
<?php include('project_function.php');?>
<div>
	<h2><?php echo "编辑项目" ?></h2>
	<?php 
		if(isset($_POST["project_name"])&&$_POST["project_name"]!="")
		{
			project_edit($_POST, $_FILES);
		}
	?>
	<form name="project_edit" action="" method="post" enctype="multipart/form-data">
		<?php 
			global $wpdb;
			$table_name = 'xy_project';
			
			$select_sql = "SELECT * FROM " . $table_name . " WHERE project_ID = ".$_GET["project_id"];
			//echo $select_sql;
			$row = $wpdb->get_row($select_sql);
			//echo $row->project_name;
			include("project_form.php");
		?>
	</form>
</div>
