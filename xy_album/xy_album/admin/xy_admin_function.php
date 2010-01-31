<?php

//include_once( $plugin_dir . 'xy_album.js');

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
  update_option('album_folder_dir',$newpath);  
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
* 功能:创建相册form
* 作者:周永飞
* 输入参数：void
* 输出参数：void
* 日期:
*/
function xy_create_album()
{
?>
<form action= "admin.php?page=<?php echo XY_ALBUM_DIR?>/admin/xy_album_admin.php&amp;action_create_album=true&amp;allow_create_album=true" id="form_create_album" method="post" enctype="multipart/form-data"/>
    	<div>
     	<input type="text" name="album_name" id="form_album_name" size="26" value="请输入相册名" onFocus="if(value==defaultValue){value='';this.style.color='#000'}" onBlur="if(!value){value=defaultValue;this.style.color='#999'}" style="color:#999999" //>
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

	global $wpdb;
	$table2album = $wpdb->prefix . "xy_album";
	$album_names =  $wpdb->get_results( "SELECT album_name FROM $table2album" ); 
	foreach($album_names as $album_name){
		if($album_name->album_name == $_POST['album_name']){
			echo '<br />';
			echo "相册 ‘".$_POST['album_name']."’ 已经存在，请重新创建..";
			return;
		}	
	}
	  
	  if($_POST['album_name']=="请输入相册名"||$_POST['album_name']==""){
	  	echo'<br />';
	  	echo'<strong style="color:#ff0000;">创建失败</strong>:'	;
	  	echo"请输入相册名称";
	  	return;
	  }
	  
	  ($_POST['album_desc']=="请输入描述信息")? $album_desc = "这家伙很懒，什么也没有留下":$album_desc = $_POST['album_desc'];
	  
	  global $wpdb;
      global $current_user;        
      get_currentuserinfo();
	  $table2album = $wpdb->prefix . "xy_album";
	  $datetime = date("Y-n-d   H:i:s");
      $insert = "INSERT INTO " . $table2album .
            " (album_name,album_cover,album_intro,album_auther_ID, album_date) " .
            "VALUES ('" . $_POST['album_name'] . "','" .WP_PLUGIN_URL."/xy_album_".XY_ALBUM_VERSION."/default_cover.jpg"."','" . $album_desc ."','". $current_user->ID."','" . $datetime ."')";
      $results = $wpdb->query( $insert );
      echo'<br/>';
      //echo'创建相册‘'.$_POST['album_name'].'’成功';
      echo '创建相册'.'<strong style="color:#ff0000;">“'.$_POST['album_name'].'”</strong>:'.'成功';

}

/**
* 功能:生成缩略图(我使用的是按比例缩放到一定的像素大小)
* 作者:周永飞
* 输入参数：原始图的地址
* 输出参数：void
* 日期:2009-01-26 00:48
*/


function xy_create_thumb($filename)
    {
        $_old = array(get_option('album_folder_dir')); //旧文件目录
        $_new = array(get_option('album_folder_dir')."thumbs/"); //缩略图文件目录
        $img = str_replace($_old,$_new,$filename);
        if(!file_exists($img))
        {
        list($width, $height) = getimagesize($filename);
        $percent = 100/$width; //缩略图文件宽80象素
        $new_width = $width * $percent;
        $new_height = $height * $percent;
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
    $gonten= explode('.',$filestr);  	//用点号分隔文件名到数组
    $gonten = array_reverse($gonten);  //把上面数组倒序
    return $gonten[0]; 					//返回倒序数组的第一个值
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
<a href="admin.php?page=<?php echo XY_ALBUM_DIR?>/admin/xy_album_admin.php&amp;allow_create_album=true">创建相册</a>
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
	 name_input.size = 15;  
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
	 	 
	/*var s=document.getElementById("desc_input_id");
    s.onfocus=function(){if(value==defaultValue){value='';this.style.color='#000'}};
    s.onblur=function(){if(!value){value=defaultValue;this.style.color='#999'}};
    s.onkeydown=function(){    this.style="color:#999999";};
    div.appendChild(s);*/
	 	 
	 
	 /*var album_select = document.createElement("select");
	 album_select.id = "album_select";	 
	 album_select.name = "select_album[]";
	 album_select.size = 1; 
	 div.appendChild(album_select);
	 
	 //obj.options.length=0;
	 var obj=document.getElementById('album_select');
	 //obj.options.length=0;
	 obj.options[0]= new Option("first option", "1" );//.add(new Option("选择相册","2"));
	 obj.options[1]= new Option("second option", "2" );
	 //obj.options.add(new Option("我","1"));
	 //options[2]=obj.options.add(new Option("我","1"));
	 div.appendChild(obj);*/
	 
	 
	 
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

<form method="POST" id ="file_form" enctype="multipart/form-data" action="admin.php?page=<?php echo XY_ALBUM_DIR?>/admin/xy_album_admin.php&amp;allow_file_loading=true,&amp;action_file_upload=true">
<br />
<strong style='color:#ff0000;'>请选择图片：</strong>
<br />
<table border=1>
	<td>
		<tr><input type="file" size=15 name="img[]"/></tr>
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




/**
* 功能:这个函数用来测试使用
* 作者:周永飞
* 输入参数：
* 输出参数：
* 日期:2009-01-26 00:48
*/


function xy_test(){

echo'<br/><br/>'."这里是测试使用".'<br/><br/><br/>';
wp_register_script('myScript', dirname(__FILE__)."/xy_album.js");
//<script language='javascript' type='text/javascript' src='/xy_album.js' ></script>
?>


	<!<input type="button" value="Click me!" onclick="xy_print()" >
	<br />
<?php
wp_enqueue_script('myScript');
}

/**
* 功能:测试使用的
* 作者:周永飞
* 输入参数：void
* 输出参数：void
* 日期:
*/

function action_xy_test(){

}


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
	echo '没有相册，请先<a href="admin.php?page='.XY_ALBUM_DIR.'/admin/xy_album_admin.php&amp;allow_create_album=true">创建相册</a>，上传照片';
	}
	//time_nanosleep(0,500);  让脚本等待时间执行
	foreach($albums as $album){
?>
		<br />
		<br />
		编辑相册:<?php echo $album->album_name?>,
		<a href="admin.php?page=<?php echo XY_ALBUM_DIR;?>/admin/xy_album_admin.php&amp;show_photo_manager=true&amp;select_album=<?php echo $album->album_ID?>">查看相册
		<br />
		<br />
		<img src="<?php echo $album->album_cover?>" alt="不能显示"/> 
		<br />
		<br />		
		
		</a>

<form action= "admin.php?page=<?php echo XY_ALBUM_DIR?>/admin/xy_album_admin.php&amp;action_update_album=true&amp;show_album_manager=true" id="form_create_album" method="post" enctype="multipart/form-data"/>
    	
     	相册名称：<input type="text" name="album_name" id="form_album_name" size="26" value="<?php echo $album->album_name ?>"/>
     	<br />
     	相册描述：<input type="text" name="album_desc" id="form_album_desc" size="26" value="<?php echo $album->album_intro ?>" />
     	<br />
     	<input type="hidden" name="album_id" id="form_album_id"  value="<?php echo $album->album_ID ?>" />
     	<br />
     	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="submit" value="修改" id="form_upload_submit" />
     	<input type="reset" value="重置" id="form_upload_reset" />
    	
</form>		

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
	echo '该相册中没有照片，请先<a href="admin.php?page='.XY_ALBUM_DIR.'/admin/xy_album_admin.php&amp;allow_file_loading=true">上传照片</a>';
	}else{
	
	//echo $_GET['select_album'];
	//time_nanosleep(0,500);  让脚本等待时间执行
	$photos =  $wpdb->get_results( "SELECT * FROM $table2photo where photo_album=$select_album ");
	echo '<br/><br/>编辑相片:';
	foreach($photos as $photo){
	//echo $photo->photo_thumb_url;
?>
		<br />
		<br />
		<img src="<?php echo $photo->photo_thumb_url?>" alt="不能显示"/> 
		<br />
		<br />		
		</a>

<form action= "admin.php?page=<?php echo XY_ALBUM_DIR?>/admin/xy_album_admin.php&amp;action_update_photo=true&amp;show_album_manager=true" id="form_create_album" method="post" enctype="multipart/form-data"/>
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

    移动到:&nbsp&nbsp&nbsp&nbsp&nbsp<select size=1 name="select_album">
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
     	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="submit" value="修改" id="form_upload_submit" />
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
	
	//删除文件，目前实现的只是在数据库中删除记录
	if($_POST['del_photo']== "0"){
	
		//如果删除了相册封面，需要重新设置封面为默认封面

		if($current_cover==$_POST['photo_url']){
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
		
		$update = "update " . $table2album ." set album_cover='" . $_POST['photo_url'] . "' where album_ID=".$_POST['photo_album'].";";
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
	
	//如果跟新照片到不同的相册但是该相片是当前相册的封面，那么更新之前相册的封面到默认封面
	if(($current_cover==$_POST['photo_url'])&&(($_POST['photo_album']!=$select_album_ID)||($_POST['select_album']!="选择相册"))) {
		$update = "update " . $table2album ." set album_cover='" .WP_PLUGIN_URL."/xy_album_".XY_ALBUM_VERSION."/default_cover.jpg"."' where album_ID=".$_POST['photo_album'].";";
		$wpdb->query( $update);
	}
	
	  ($_POST['photo_desc']=="")? $photo_desc = "这家伙很懒，什么也没有留下":$photo_desc = $_POST['photo_desc'];
      $update = "update " . $table2photo ." set photo_intro='" . $photo_desc . "',photo_tag='". $_POST['photo_tags'] ."',photo_album='". $select_album_ID."' where photo_ID='".$_POST['photo_id']."';";
      $results = $wpdb->query( $update);
      echo'<br/>';
      //echo '更新相册'.'<strong style="color:#ff0000;">“'.$_POST['album_name'].'”</strong>:'.'成功';
}

/**
* 功能:得到照片的名称
* 作者:周永飞
* 输入参数：照片的url
* 输出参数：文件名
* 日期:2009-01-26 00:48
*/
function get_file_name($filestr){
    $gonten= explode('/',$filestr);  	//用点号分隔文件名到数组
    $gonten = array_reverse($gonten);  //把上面数组倒序
    return $gonten[0]; 					//返回倒序数组的第一个值
}
?>
