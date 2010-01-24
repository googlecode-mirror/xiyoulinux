<?php


/**
 * xy_create_gallery_folder()
 * creates a new gallery folder on demand 
 * 
 * @param mixed $folder
 * @return void
 * @since 0.15.0
 */
function xy_create_gallery_folder( $folder ) {
  global $plugin_dir, $xy_album_options; 
  $newpath = ABSPATH . $folder;
  update_option($album_folder_dir,$newpath);
  $directory_made = xy_make_directory( $newpath );
  $message = ( $directory_made ) ? __('Folder created successfully', $xy_text_domain) : __('XY_album Gallery cannot create folder: maybe it already exists or have bad permissions', $xy_text_domain);
  xy_options_message( $message, $message);
}

/**
 * xy_make_directory()
 * 
 * @param mixed $path
 * @return
 */
function xy_make_directory($path) {
	if (@mkdir($path, 0777)){
	  $stat = stat( dirname($path) );
    $perms = $stat['mode'] & 0000777;
    @chmod( $path, $perms ); 
		return true;
	} else {
		return false;
	}
}

/**
 * xy_options_message()
 * Displays a message in the Admin screen
 * 
 * @since 0.15.0
 * @return void
 */
function xy_options_message( $message, $success=true ) {
  if ( $success ) {
	?>  
	<div id="message" class="updated fade">
		<p><?php echo $message; ?></p>
	</div>

	<?php
  } else {
  ?>
  <div id="message" class="error">
    <p><?php echo $message; ?></p>
  </div>
  <?php  
  }
}

/**
 * xy_file_manage()
 * update the informations of the file
 * 
 * @
 * @return void
 */

function xy_file_manage(){

echo"<h1>该部分内容正在开发中，敬请期待，谢谢</h1>"
?>

<?php
}

/**
 * xy_file_load()
 * before upload file
 * 
 * @
 * @return void
 */

function xy_file_load(){
global $wpdb;
$table2album = $wpdb->prefix . "xy_album";
$results = $wpdb->query("SELECT * from $table2album ");
echo '<br />';
if($results==0){
?>
<strong style='color:#ff0000;'><?php _e( 'WARNING', $xy_text_domain ); ?></strong>: <?php _e( '还没有相册', $xy_text_domain ); ?>:	
<?php	
}
?>
<br />
<a href="admin.php?page=xy_album/xy_album_admin.php&amp;allow_create_album=true">创建相册</a>
<br />
<br />

	<!--上载新照片-->
   	<form action= "admin.php?page=xy_album/xy_album_admin.php&amp;action_file_upload=true" id="form_upload" method="post" enctype="multipart/form-data"/>
    	<div>
     	<input type="file" name="file" id="form_upload_name" readonly="" />
     	<input type="hidden" name="directory" id="form_upload_directory" value=""/>
     	<br /></br>
     	<!--下面是显示描述文本框，有灰色提示语言功能-->
     	<input type="text" name="description" id="form_file_desc" size="26" value="请输入描述信息" onFocus="if(value==defaultValue){value='';this.style.color='#000'}" onBlur="if(!value){value=defaultValue;this.style.color='#999'}" style="color:#999999" />
     	<br />
     	<input type="text" name="tags" id="form_file_tags" size="26"/>
     	<br />
     	<input type="submit" value="确定" id="form_upload_submit" />
     	<input type="reset" value="重置" id="form_upload_reset" />
    	</div>
   	</form>
<?php
}


/**
 * file_upload()
 * upload file
 * 
 * @
 * @return void
 * @
 */
function file_upload(){
// make sure we have all expected parameters
echo '<br />';
global $wpdb;

$target = get_option($album_folder_dir);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 5000000))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "返回错误代码: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    if (file_exists($target . $_FILES["file"]["name"]))
      {
      echo "在 ".$target." 中 “".$_FILES["file"]["name"] . "“ 已经存在，请重新命名 ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      $target . $_FILES["file"]["name"]);
      echo "保存在了: " . $target. $_FILES["file"]["name"];
      //在数据库中保存信息
      global $current_user;        
      get_currentuserinfo();
	  $table2photo = $wpdb->prefix . "xy_photo";
	  $datetime = date("Y-n-d   H:i:s");
      $insert = "INSERT INTO " . $table2photo .
            " (photo_url, photo_intro,photo_auther_ID, photo_date,photo_tag) " .
            "VALUES ('" . get_option($album_folder_dir).$_POST['file'] . "','" . $_POST['description'] ."','". $current_user->ID."','" . $datetime ."','".$_POST['tags']. "')";
      $results = $wpdb->query( $insert );
      
      }
    }
  }
else
  {
  echo "无效文件";
  }
}


/**
 * xy_create_album()
 * before creates a new album
 * 
 * @
 * @return void
 * @
 */
function xy_create_album()
{
?>
<form action= "admin.php?page=xy_album/xy_album_admin.php&amp;action_create_album=true" id="form_create_album" method="post" enctype="multipart/form-data"/>
    	<div>
     	<input type="text" name="album_name" id="form_album_name" value="请输入相册名(覆盖当前文字)" />
     	<br /></br>
     	<input type="text" name="album_desc" id="form_album_desc" size="26" value="请输入描述信息" onFocus="if(value==defaultValue){value='';this.style.color='#000'}" onBlur="if(!value){value=defaultValue;this.style.color='#999'}" style="color:#999999" />
     	<br />
     	<input type="submit" value="确定" id="form_upload_submit" />
     	<input type="reset" value="重置" id="form_upload_reset" />
    	</div>
   	</form>
<?php
}

/**
 * create_album()
 * creates a new album
 * 
 * @
 * @return void
 * @
 */

function create_album(){
	  if($_POST['album_name']=="请输入相册名(覆盖当前文字)"||$_POST['album_name']==""){
	  	echo'<br />';
	  	echo"请输入相册名称";
	  	return;
	  }
	  global $wpdb;
      global $current_user;        
      get_currentuserinfo();
	  $table2album = $wpdb->prefix . "xy_album";
	  $datetime = date("Y-n-d   H:i:s");
      $insert = "INSERT INTO " . $table2album .
            " (album_name, album_intro,album_auther_ID, album_date) " .
            "VALUES ('" . $_POST['album_name'] . "','" . $_POST['album_desc'] ."','". $current_user->ID."','" . $datetime ."')";
      $results = $wpdb->query( $insert );
      echo'<br/>';
      echo'创建相册‘'.$_POST['album_name'].'’成功';

}
?>
