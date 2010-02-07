<?php include("project_function.php")?>
<script type="text/javascript" src="../wp-content/plugins/project_management/utils/project_javascript.js"></script>
<div class="wrap">
	<div id="icon-plugins" class="icon32"><br /></div>
	<h2><?php echo "项目管理" ?>&nbsp;<a href="admin.php?page=project_add" class="button add-new-h2"><?php echo "添加项目" ?></a></h2>
	<?php 
		if(isset($_GET['action'])){
			$action=$_GET['action'];
			switch ($action){
				case "remove":
					project_remove($_GET['project_id']);
					break;
				case "edit":
					project_edit($_GET["project_id"], $_POST,$_FILES);
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
	<form name="all" action="admin.php?page=project&action=all" method="post">
		<table class="widefat post fixed" cellspacing="0">
			<thead>
				<tr>
					<?php print_project_column(); ?>
				</tr>
			</thead>		
			<tbody>
				<?php project_rows($_GET["tag"]); ?>
			</tbody>
			<tfoot>
				<tr>
					<?php //print_project_column2(); ?>
				</tr>
			</tfoot>
		</table>
		<div class="alignleft actions">
				<?php print_all_check()?>
		</div>
	 </form>
</div>

