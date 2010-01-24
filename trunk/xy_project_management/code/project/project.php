<?php include("project-function.php")?>
<script type="text/javascript" src="../wp-content/plugins/project/project-javascript.js"></script>
<?php if($_GET["show"]=="edit"){?>
<div class="wrap">
	<?php screen_icon(); ?>
	<h2><?php echo "修改项目" ?></h2>
	<form name="addProject" action="admin.php?page=project&action=edit&project_id=<?php echo $_GET['project_id']?>" method="post" enctype="multipart/form-data">
	<?php 
	global $wpdb;
	$row = $wpdb->get_row("SELECT * FROM xy_project WHERE project_ID =".$_GET["project_id"]);
	include("edit-project-form.php");
	?>
	</form>
</div>
<?php }else{?>
<div class=wrap>
	<?php screen_icon(); ?>
	<h2><?php echo "项目管理" ?>&nbsp;<a href="admin.php?page=addProject" class="button add-new-h2"><?php echo "添加项目" ?></a></h2>
	
	<?php 
	if(isset($_GET['action'])){
		$action=$_GET['action'];
		switch ($action){
			case "remove":
				project_remove($_GET['project_id']);
				break;
			case "edit":
				project_edit($_GET["project_id"],$_POST,$_FILES);
				break;
			case "all":
				project_all($_POST);
				break;
		}
	}
	?>
	<form method="get" action="admin.php">
	<p class="search-box">
	<input type="hidden" name="page" value="project"/>
	<input type="text" id="post-search-input" name="tag" value="<?php the_search_query(); ?>" />
	<input type="submit" value="<?php echo "搜索项目"; ?>" class="button" />
	</p>
	</form>
	<div class="alignleft actions"">
		<select name='m'>
		<option value='0' selected="selected">过滤1</option>
		<option value='0'>过滤1</option>
		<option value='0'>过滤1</option>
		</select>
		<select name='m'>
		<option value='0' selected="selected">过滤2</option>
		<option value='0'>过滤2</option>
		<option value='0'>过滤2</option>
		</select>
		<input type="submit" id="post-query-submit" value="过滤" class="button-secondary" />
	</div>
	<form name="all" action="admin.php?page=project&action=all" method="post">
	<table class="widefat post fixed" cellspacing="0">
		<thead>
		<tr>
	<?php print_project_column(); ?>
		</tr>
		</thead>
	
		<tfoot>
		<tr>
	<?php print_project_column(); ?>
		</tr>
		</tfoot>
	
		<tbody>
	<?php project_rows($_GET["tag"]); ?>
		</tbody>
	</table>
	<div class="alignleft actions">
			<?php print_all_check()?>
	</div>
	 </form>
</div>
<?php }?>