<?php header("Content-Type: text/html; charset=utf-8");?>
<?php include('project_function.php');?>
<div>
	<h2><?php echo "添加项目" ?></h2>
	<?php 
		if(isset($_POST["project_name"])&&$_POST["project_name"]!="")
		{
			project_add($_POST, $_FILES);
		}
	?>
	<form name="project_add" action="" method="post" enctype="multipart/form-data">
		<?php include("project_form.php")?>
	</form>
</div>
