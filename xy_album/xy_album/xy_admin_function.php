<?php


/**
* 功能:创建目录下的文件夹
* 作者:周永飞
* 输入参数：void
* 输出参数：void
* 日期:
*/
function xy_create_gallery_folder( $folder ) {
  global $plugin_dir, $xy_album_options; 
  $newpath = ABSPATH . $folder;
  $directory_made = xy_make_directory( $newpath );
  //创建缩略图目录的时候不用打印成功信息
  if($folder == get_option('gallery_folder')."thumbs") return;
  update_option($album_folder_dir,$newpath);  
  $message = ( $directory_made ) ? __('Folder created successfully', $xy_text_domain) : __('XY_album Gallery cannot create folder: maybe it already exists or have bad permissions', $xy_text_domain);
  xy_options_message( $message, $message);
}

/**
* 功能:创建目录
* 作者:周永飞
* 输入参数：void
* 输出参数：void
* 日期:
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
* 功能:信息打印
* 作者:周永飞
* 输入参数：void
* 输出参数：void
* 日期:
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
* 功能:文件管理
* 作者:周永飞
* 输入参数：void
* 输出参数：void
* 日期:
*/

function xy_file_manage(){
echo "<h1>正在开发中，敬请期待</h1>";

?>

<?php
}


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
<?php	
}
?>
<br />
<a href="admin.php?page=xy_album/xy_album_admin.php&amp;allow_create_album=true">创建相册</a>
<br />
<br />

	<!--上载新照片-->
   	<form action= "admin.php?page=xy_album/xy_album_admin.php&amp;action_file_upload=true,&amp;allow_file_loading=true" id="form_upload" method="post" enctype="multipart/form-data"/>	
   		<table border="1">
    	<div>
     	<input type="file" name="file" id="form_upload_name" readonly="" />
     	<input type="hidden" name="directory" id="form_upload_directory" value=""/>
     	<br/>
     	<!--下面是显示描述文本框，有灰色提示语言功能-->
     	<input type="text" name="description" id="form_file_desc" size="26" value="请输入描述信息" onFocus="if(value==defaultValue){value='';this.style.color='#000'}" onBlur="if(!value){value=defaultValue;this.style.color='#999'}" style="color:#999999" />
     	<br />
     	<select size=1 name="select_album">
		<option selected>选择相册
		<?php
			$album_names =  $wpdb->get_results( "SELECT album_name FROM $table2album" ); 
			foreach($album_names as $album_name){
			echo '<option>'.$album_name->album_name;
			}
		?>
		</select>
		<br />
     	<input type="text" name="tags" id="form_file_tags" size="26"value="请输入关键字" onFocus="if(value==defaultValue){value='';this.style.color='#000'}" onBlur="if(!value){value=defaultValue;this.style.color='#999'}" style="color:#999999"/>
     	<br />
     	<input type="submit" value="确定" id="form_upload_submit" />
     	<input type="reset" value="重置" id="form_upload_reset" />
    	</div>
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
// make sure we have all expected parameters
echo '<br />';
global $wpdb;
$select_album = $_POST['select_album'];
$table2album = $wpdb->prefix . "xy_album";
$album_IDs =  $wpdb->get_results( "SELECT album_ID FROM $table2album where album_name = '$select_album'" ); 
foreach($album_IDs as $album_ID){
$select_album_ID =  $album_ID->album_ID;
}
$target = get_option($album_folder_dir);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_POST['select_album'] != "选择相册")
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
      $file = get_option($album_folder_dir).$_FILES["file"]["name"];
	  xy_create_thumb($file);
      echo '上传<strong style="color:#ff0000;">成功</strong>，保存在了: ' . $target. $_FILES["file"]["name"];
      //在数据库中保存信息
      global $current_user;        
      get_currentuserinfo();
	  $table2photo = $wpdb->prefix . "xy_photo";
	  $datetime = date("Y-n-d   H:i:s");
      $insert = "INSERT INTO " . $table2photo .
            " (photo_url,photo_album,photo_thumb_url, photo_intro,photo_auther_ID, photo_date,photo_tag) " .
            "VALUES ('" . get_option($album_folder_dir).$_POST['file'] ."','".$select_album_ID. "','".get_option($album_folder_dir)."thumbs/".$_POST['file'] ."','". $_POST['description'] ."','". $current_user->ID."','" . $datetime ."','".$_POST['tags']. "')";
      $results = $wpdb->query( $insert );
      
      }
    }
  }
else
  {
  echo'<strong style="color:#ff0000;">无效文件</strong>:'	;
  echo "请检查文件是否选择，相册是否选择，文件大小不能大于5M！！";
  }
}


/**
* 功能:创建相册form
* 作者:周永飞
* 输入参数：void
* 输出参数：void
* 日期:
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
* 功能:创建相册
* 作者:周永飞
* 输入参数：void
* 输出参数：void
* 日期:
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

/**
* 功能:生成缩略图
* 作者:周永飞
* 输入参数：原始图的地址
* 输出参数：void
* 日期:2009-01-26 00:48
*/


function xy_create_thumb($filename)
    {
        $_old = array(get_option($album_folder_dir)); //旧文件目录
        $_new = array(get_option($album_folder_dir)."thumbs/"); //缩略图文件目录
        $img = str_replace($_old,$_new,$filename);
        if(!file_exists($img))
        {
        list($width, $height) = getimagesize($filename);
        $percent = 180/$width; //缩略图文件宽180象素
        $new_width = $width * $percent;
        $new_height = $height * $percent;
		//switch (substr($file, strrpos($file, '.') + 1)){
        $image_p = imagecreatetruecolor($new_width, $new_height);
        if(get_file_exten($filename)=="gif"){
        	$image = imagecreatefromgif($filename);
        }
        if((get_file_exten($filename)=="jpg")||(get_file_exten($filestr)=="jpeg")){
        	$image = imagecreatefromjpeg($filename);
        }
        if(get_file_exten($filename)=="png"){
        	$image = imagecreatefrompng($filename);
        }
        //$image = imagecreatefromgif($filename);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        imagejpeg($image_p, $img);
        }
    }


/**
* 功能:得到文件后缀名
* 作者:周永飞
* 输入参数：文件名
* 输出参数：文件后缀名
* 日期:2009-01-26 00:48
*/
function get_file_exten($filestr){
    $gonten= explode('.',$filestr);  //用点号分隔文件名到数组
    $gonten = array_reverse($gonten);  //把上面数组倒序
    return $gonten[0]; //返回倒序数组的第一个值
}

?>
