<div class="wrap">
<div id="icon-link-manager" class="icon32"><br /></div><h2>照片上传</h2></div>
</div>

<?php

include_once( $plugin_dir . 'xy_admin_function.php');

/**
* 功能:文件上传form
* 作者:周永飞
* 输入参数：void
* 输出参数：void
* 日期:
*/

function xy_file_load(){
global $wpdb;
$table2album = $wpdb->prefix . "xy_album";
$results = $wpdb->query("SELECT * from $table2album ");
echo '<br />';
if($results==0){
?>
<strong style='color:#ff0000;'><?php _e( 'WARNING', $xy_text_domain ); ?></strong>: <?php _e( '还没有相册', $xy_text_domain ); ?>:	
<a href="admin.php?page=<?php echo XY_ALBUM_DIR?>/admin/xy_create_album.php">创建相册</a>
<?php	
}
?>
<script type="text/javascript">
function addimg(){	 

	 //包含所有文件域的DIV
	 var div = document.getElementById('imgs');
	 
	 //文件域
	 var name_input = document.createElement("input");
	 name_input.name = "img[]";
	 name_input.type = 'file';
	 name_input.size = 30; 
	 div.appendChild(name_input);
	 

	 var desc_input = document.createElement("input");
	 desc_input.name = "desc[]";
	 desc_input.id = "desc_input_id";
	 desc_input.type = 'text';
	 desc_input.size = 15;
	 desc_input.title = "请输入描述信息";	 
	 div.appendChild(desc_input);
	 
	 var tags_input = document.createElement("input");
	 tags_input.name = "tag[]";
	 tags_input.id = "desc_input_id";
	 tags_input.type = 'text';
	 tags_input.size = 15;
	 tags_input.title = "请输入关键字";	 
	 div.appendChild(tags_input);
	 
	 //删除按钮
	 var button = document.createElement("a");
	 button.href = "javascript:;";
	 button.innerHTML = '删除';
	 div.appendChild(button);
	 //换行
	 var br = document.createElement("br");
	 div.appendChild(br);
	 //在按钮上增加删除的事件
	 button.onclick = function(){
		  name_input.parentNode.removeChild(name_input);
		  desc_input.parentNode.removeChild(desc_input);
		  tags_input.parentNode.removeChild(tags_input);
		  //album_select.parentNode.removeChild(album_select);
		  this.parentNode.removeChild(this);
		  br.parentNode.removeChild(br);
	 }
}
</script>

<form method="POST" id ="file_form" enctype="multipart/form-data" action="admin.php?page=<?php echo XY_ALBUM_DIR?>/admin/xy_upload_photo.php&amp;action_file_upload=true">
<br /><br /><br /><br />
<strong style='color:#ff0000;'>请选择图片：</strong>
<br />
<table border=1>
	<td>
		<tr><input type="file" size=30 name="img[]" readonly=""/></tr>
		<tr><input type="text" size=15 name="desc[]" value="请输入描述信息" onFocus="if(value==defaultValue){value='';this.style.color='#000'}" onBlur="if(!value){value=defaultValue;this.style.color='#999'}" style="color:#999999"/></tr>
		<tr><input type="text" size=15 name="tag[]" value="请输入关键字" onFocus="if(value==defaultValue){value='';this.style.color='#000'}" onBlur="if(!value){value=defaultValue;this.style.color='#999'}" style="color:#999999"/></tr>

	</td>
	<div id="imgs"></div>
	<br/>
	<input type="button" onclick="addimg()" value="继续添加"/>
	<select size=1 name="select_album">
		<option selected>选择相册
		<?php
			//$table2album = $wpdb->prefix . "xy_album";
			$album_names =  $wpdb->get_results( "SELECT album_name FROM $table2album" ); 
			foreach($album_names as $album_name){
			echo '<option>'.$album_name->album_name;
			}
		?>
	</select>
	<br />
	<br />
	<input type="submit" value="确定" id="form_upload_submit" />
	<input type="reset" value="重置" id="form_upload_reset" />
</table>
</form>

<?php
}


/**
* 功能:文件上传执行
* 作者:周永飞
* 输入参数：void
* 输出参数：void
* 日期:
*/
function file_upload(){
	$img_name = array();
	$img_type = array();
	$img_size = array();
	$img_tmp_name = array();
	$img_error = array();
	$img_desc = array();
	$img_tag = array();
	$i=0;
	foreach($_FILES["img"]["name"]as $array)
	{	
		$img_name[$i] = $array;
		$i++;
	}
	$i=0;
	foreach($_FILES["img"]["size"]as $array)
	{	
		$img_size[$i] = $array;
		$i++;
	}
	$i=0;
	foreach($_FILES["img"]["type"]as $array)
	{	
		$img_type[$i] = $array;
		$i++;
	}
	$i=0;
	foreach($_FILES["img"]["tmp_name"]as $array)
	{	
		$img_tmp_name[$i] = $array;
		$i++;
	}
	$i=0;
	foreach($_FILES["img"]["error"]as $array)
	{	
		$img_error[$i] = $array;
		$i++;
	}
	//echo $img_name[0]." ".$img_type[0];
	$i=0;
	foreach($_POST['desc'] as $array)
	{
		($array==""||$array=="请输入描述信息")?$img_desc[$i] = "这家伙很懒，什么也没有留下": $img_desc[$i] = $array;
		$i++;
	}
	$i=0;
	foreach($_POST['tag'] as $array)
	{
		($array==""||$array=="请输入关键字")?$img_tag[$i] = "": $img_tag[$i] = $array;
		$i++;
	}
	//foreach ($img_tag as $array)
	//{
	//	echo $array;
	//}
	//echo $img_tag[1];
	//echo $i;

	global $wpdb;
	$select_album = $_POST['select_album'];
	$table2album = $wpdb->prefix . "xy_album";
	$album_IDs =  $wpdb->get_results( "SELECT album_ID FROM $table2album where album_name = '$select_album'" ); 
	foreach($album_IDs as $album_ID){
		$select_album_ID =  $album_ID->album_ID;
	}
	echo "正在上传中，请稍等...";
	for($j=0;$j<$i;$j++)
	{
                $no = $j+1;
		$target = get_option('album_folder_dir');
		if ((($img_type[$j] == "image/gif")
		|| ($img_type[$j] == "image/jpeg")
		|| ($img_type[$j] == "image/jpg")
		|| ($img_type[$j] == "image/png"))
		&& ($_POST['select_album'] != "选择相册")
		&& ($img_size[$j] < 5000000))
		{
			  if ($img_error[$j] > 0)
			  {
			  		echo '<br />';
					echo "文件".$no."返回错误代码: " . $img_error[$j] . "<br />";
			  }
			  else
			  {
					if (file_exists($target . $img_name[$j]))
					{
					    echo '<br />';
					  	echo "文件”".$img_name[$j]."“在 ".$target." 中已经存在，请重新命名 ";
					  	
					}
					else
					{
					  move_uploaded_file($img_tmp_name[$j] , $target . $img_name[$j] );
					  $file = get_option('album_folder_dir').$img_name[$j] ;
					  xy_create_thumb($file);
					  echo '<br />';
					  echo '文件“'.$img_name[$j].'“上传<strong style="color:#ff0000;">成功</strong>，保存在了: ' . $target. $img_name[$j];
					  //在数据库中保存信息
					  global $current_user;        
					  get_currentuserinfo();
					  $table2photo = $wpdb->prefix . "xy_photo";
					  $datetime = date("Y-n-d   H:i:s");
					  $insert = "INSERT INTO " . $table2photo .
							" (photo_url,photo_album,photo_thumb_url, photo_intro,photo_auther_ID, photo_date,photo_tag) " .
							"VALUES ('" . WP_CONTENT_URL."/xy-album/".$img_name[$j]  ."','".$select_album_ID. "','".WP_CONTENT_URL."/xy-album/thumbs/".$img_name[$j]  ."','". $img_desc[$j]."','". $current_user->ID."','" . $datetime ."','".$img_tag[$j]. "')";
					  $results = $wpdb->query( $insert );					  
					}
			  }
		}
		else
		{
			  echo '<br />';			  
			  echo'<strong style="color:#ff0000;">无效文件</strong>:'	;
			  echo "请检查选项".$no."文件是否选择，相册是否选择";			  
		}
	}
}

xy_file_load();

if($_GET['action_file_upload']==true){
	file_upload();
}
?>
