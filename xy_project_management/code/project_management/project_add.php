<?php include('project_function.php')?>
<script type="text/javascript" src="project_javascript.js"></script>
<div class="wrap">
	<?php screen_icon(); ?>
	<h2><?php echo "添加项目" ?></h2>
	<?php 
		if(isset($_POST["project_name"])&&$_POST["project_name"]!="")
		{
			project_add($_POST, $_FILES);
		}
	?>
	<form name="project_add" action="<?php $_SERVER['REQUEST_URI']?>" method="post" enctype="multipart/form-data">
		<?php include("project_form.php")?>
	</form>
</div>
