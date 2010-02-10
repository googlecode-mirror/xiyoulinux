<div class="wrap">
<div id="icon-edit" class="icon32"><br /></div><h2>相册管理</h2></div>
</div>

<br><br>

<?php

include_once( $plugin_dir . 'xy_admin_function.php');

/**
* 功能:相册管理，首先是展示每个相册，以相册封面的形式展示，封面后面包括相册编辑和相册查看
* 作者:周永飞
* 输入参数：void
* 输出参数：void
* 日期:
*/

function show_album_manage(){
	global $wpdb;
	$table2album = $wpdb->prefix . "xy_album";
	$albums =  $wpdb->get_results( "SELECT * FROM $table2album");
	if($wpdb->query("SELECT * from $table2album ")==0){
	echo "<br /><br />";
	echo '没有相册，请先<a href="admin.php?page='.XY_ALBUM_DIR.'/admin/xy_create_album.php&amp;allow_create_album=true">创建相册</a>，上传照片';
	}
	//time_nanosleep(0,500);  让脚本等待时间执行	
	
	echo"<br />";
	foreach($albums as $album){
?>

<hr width="500" align="left">

<table >
	<td>
		编辑相册:<input type="text" size="6" readonly="" style="color:#FF0000" value="<?php echo $album->album_name ?>"/>
		<a href="admin.php?page=<?php echo XY_ALBUM_DIR;?>/admin/xy_album_manage.php&amp;show_photo_manager=true&amp;select_album=<?php echo $album->album_ID?>">查看照片
		<br />
		<br/>
		<img border=2 src="<?php echo $album->album_cover?>" alt="不能显示"/>
		<br />
		<br />	
		</a>			
	</td>
	
	<td>
	<form action= "admin.php?page=<?php echo XY_ALBUM_DIR?>/admin/xy_album_manage.php&amp;action_update_album=true" id="form_create_album" method="post" enctype="multipart/form-data"/>
		<br />
		<!<br />
	
		
     	相册名称：<input type="text" name="album_name" id="form_album_name" size="26" value="<?php echo $album->album_name ?>"/>
     	<br  />
     	相册描述：<input type="text" name="album_desc" id="form_album_desc" size="26" value="<?php echo $album->album_intro ?>" />
     	<input type="hidden" name="album_id" id="form_album_id"  value="<?php echo $album->album_ID ?>" />
     	<br />
     	<br />
     	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
     	<input type="submit" value="修改" id="form_upload_submit" />
     	<input type="reset" value="重置" id="form_upload_reset" />
     
	
	</form>	
	</td>
</table> 	
<hr width="500" align="left">

<?php
	}
}

/**
* 功能:对相册信息进行更新
* 作者:周永飞
* 输入参数：void
* 输出参数：void
* 日期:
*/

function xy_update_album(){
	
	  ($_POST['album_desc']=="")? $album_desc = "这家伙很懒，什么也没有留下":$album_desc = $_POST['album_desc'];
	  
	  global $wpdb;
	  $table2album = $wpdb->prefix . "xy_album";
	  
	$album_names =  $wpdb->get_results( "SELECT album_name FROM $table2album" ); 
	foreach($album_names as $album_name){
		if($album_name->album_name == $_POST['album_name']){
			echo '<br />';
			echo "相册 ‘".$_POST['album_name']."’ 已经存在，请重新命名..";
			return;
		}	
	}
	  
      $update = "update " . $table2album ." set album_name='" . $_POST['album_name'] . "',album_intro='". $album_desc ."' where album_ID=".$_POST['album_id'].";";
      $results = $wpdb->query( $update);
      echo'<br/>';
      echo '更新相册'.'<strong style="color:#ff0000;">“'.$_POST['album_name'].'”</strong>:'.'成功';
}

/**
* 功能:对相册下的照片进行展示
* 作者:周永飞
* 输入参数：void
* 输出参数：void
* 日期:
*/

function show_photo_manage(){

	global $wpdb;	
	$table2photo = $wpdb->prefix . "xy_photo";
	$select_album = $_GET['select_album'];
	
	if($wpdb->query("SELECT * from $table2photo where photo_album=$select_album ")==0){
	echo "<br /><br />";
	echo '该相册中没有照片，请先<a href="admin.php?page='.XY_ALBUM_DIR.'/admin/xy_upload_photo.php">上传照片</a>';
	}else{
	
	//echo $_GET['select_album'];
	//time_nanosleep(0,500);  让脚本等待时间执行
	$photos =  $wpdb->get_results( "SELECT * FROM $table2photo where photo_album=$select_album ");
	//echo '<br/><br/>编辑相片:';
	foreach($photos as $photo){
	$current_thumb_url = $photo->photo_thumb_url;
?>
		<br/><br/>编辑相片:<?php echo get_file_name($current_thumb_url)?>
		<a href="admin.php?page=<?php echo XY_ALBUM_DIR;?>/admin/xy_album_manage.php">返回相册</a>
		<br />
		<br />
		<img src="<?php echo $photo->photo_thumb_url?>" alt="不能显示"/> 
		<br />
		<br />		

<form action= "admin.php?page=<?php echo XY_ALBUM_DIR?>/admin/xy_album_manage.php&amp;action_update_photo=true&amp;show_album_manager=true" id="form_create_album" method="post" enctype="multipart/form-data"/>
    	<input type="checkbox" name="set_cover" value="0" style="cursor:hand"><a onclick="selectcheckbox()" style="cursor:hand">设为封面</a>
    	<input type="checkbox" name="del_photo" value="0" style="cursor:hand"><a onclick="selectcheckbox()" style="cursor:hand">删除照片</a>
    	<br />
    	<br />
     	相片介绍：<input type="text" name="photo_desc" id="form_photo_desc" size="26" value="<?php echo $photo->photo_intro ?>"/>
     	<br />
     	相片标签：<input type="text" name="photo_tags" id="form_photo_tags" size="26" value="<?php echo $photo->photo_tag ?>" />
     	<br />
     	<input type="hidden" name="photo_id" id="form_photo_id"  value="<?php echo $photo->photo_ID ?>" />
     	<input type="hidden" name="photo_url" id="form_photo_url"  value="<?php echo $photo->photo_url ?>" />
     	<input type="hidden" name="photo_thumb_url" id="form_photo_thumb_url"  value="<?php echo $photo->photo_thumb_url ?>" />
     	<input type="hidden" name="photo_album" id="form_photo_album"  value="<?php echo $photo->photo_album ?>" />

    移&nbsp动&nbsp到&nbsp&nbsp:&nbsp<select size=1 name="select_album">
		<option selected>选择相册
		<?php
			$table2album = $wpdb->prefix . "xy_album";
			$album_names =  $wpdb->get_results( "SELECT album_name FROM $table2album" ); 
			foreach($album_names as $album_name){
			echo '<option>'.$album_name->album_name;
			}
		?>
	</select>
	<br/>
	<br />
     	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="submit" value="修改" id="form_upload_submit" />
     	<input type="reset" value="重置" id="form_upload_reset" />
    	
</form>	

<?php
	}
	}
}

/**
* 功能:对选中照片信息进行修改
* 作者:周永飞
* 输入参数：void
* 输出参数：void
* 日期:
*/

function xy_update_photo(){

	global $wpdb;
	$table2album = $wpdb->prefix . "xy_album";
	$table2photo = $wpdb->prefix . "xy_photo";
	$update_album = $_POST['photo_album'];
	$album_covers = $wpdb->get_results("select album_cover from $table2album where album_ID=$update_album");
	foreach($album_covers as $album_cover)
		$current_cover=$album_cover->album_cover;
	
	if($_POST['del_photo']== "0"){
	
		//如果删除了相册封面，需要重新设置封面为默认封面
		if($current_cover==$_POST['photo_thumb_url']){
			$update = "update " . $table2album ." set album_cover='" .WP_PLUGIN_URL."/xy_album_".XY_ALBUM_VERSION."/default_cover.jpg"."' where album_ID=".$_POST['photo_album'].";";
			$wpdb->query( $update);
		}
			
		$delete = "DELETE FROM ". $table2photo ." WHERE photo_ID=".$_POST['photo_id'].";";
		$wpdb->query($delete);
		
		$imgurl = $_POST['photo_url'];
		$thumburl = $_POST['photo_thumb_url'];
		unlink(WP_CONTENT_DIR."/xy-album/".get_file_name($imgurl));
		unlink(WP_CONTENT_DIR."/xy-album/thumbs/".get_file_name($thumburl));
		return ;
	}
	
	if($_POST['set_cover'] == "0") {
		
		$update = "update " . $table2album ." set album_cover='" . $_POST['photo_thumb_url'] . "' where album_ID=".$_POST['photo_album'].";";
     	$results = $wpdb->query( $update);
	}

	if($_POST['select_album']=="选择相册") {$select_album_ID=$_POST['photo_album'];}
	else{
		$select_album = $_POST['select_album'];
		$album_IDs =  $wpdb->get_results( "SELECT album_ID FROM $table2album where album_name = '$select_album'" ); 
		foreach($album_IDs as $album_ID){
			$select_album_ID =  $album_ID->album_ID;
		}
	}	
	
	//如果更新照片到不同的相册但是该相片是当前相册的封面，那么更新之前相册的封面到默认封面
	if(($current_cover==$_POST['photo_thumb_url'])&&(($_POST['photo_album']!=$select_album_ID)||($_POST['select_album']!="选择相册"))) {
		$update = "update " . $table2album ." set album_cover='" .WP_PLUGIN_URL."/xy_album_".XY_ALBUM_VERSION."/default_cover.jpg"."' where album_ID=".$_POST['photo_album'].";";
		$wpdb->query( $update);
	}
	
	  ($_POST['photo_desc']=="")? $photo_desc = "这家伙很懒，什么也没有留下":$photo_desc = $_POST['photo_desc'];
      $update = "update " . $table2photo ." set photo_intro='" . $photo_desc . "',photo_tag='". $_POST['photo_tags'] ."',photo_album='". $select_album_ID."' where photo_ID='".$_POST['photo_id']."';";
      $results = $wpdb->query( $update);
      echo'<br/>';
      //echo '更新相册'.'<strong style="color:#ff0000;">“'.$_POST['album_name'].'”</strong>:'.'成功';
}




if($_GET['action_update_album']==true){
	xy_update_album();
}
if($_GET['action_update_photo']==true){
	xy_update_photo();
}
if($_GET['show_photo_manager']!=true){
	show_album_manage();
}
if($_GET['show_photo_manager']==true){
	show_photo_manage();
}
?>



