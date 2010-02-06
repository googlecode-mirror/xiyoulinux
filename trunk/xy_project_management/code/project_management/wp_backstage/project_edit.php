<?php include('project_function.php')?>
<script type="text/javascript" src="../utils/project_javascript.js"></script>
<div class="wrap">
	<?php screen_icon(); ?>
	<h2><?php echo "编辑项目" ?></h2>
	<form name="project_edit" action="admin.php?page=project&action=edit&project_id=<?php echo $_GET['project_id']?>" method="post" enctype="multipart/form-data">
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
