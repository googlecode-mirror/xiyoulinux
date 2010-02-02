<?
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
<div class="wrap">
<div id="icon-tools" class="icon32"><br /></div><h2>创建相册</h2></div>
</div>

<br><br><br><br><br>

<form action= "admin.php?page=<?php echo XY_ALBUM_DIR?>/admin/xy_create_album.php&amp;action_create_album=true" id="form_create_album" method="post" enctype="multipart/form-data"/>
    	<div>
     	相册名：<input type="text" name="album_name" id="form_album_name" size="26" value="请输入相册名" onFocus="if(value==defaultValue){value='';this.style.color='#000'}" onBlur="if(!value){value=defaultValue;this.style.color='#999'}" style="color:#999999" //>
     	<br /></br>
     	描&nbsp&nbsp&nbsp述：<textarea rows=6 cols=20 name="album_desc" id="form_album_desc" size="26" value="请输入描述信息" onFocus="if(value==defaultValue){value='';this.style.color='#000'}" onBlur="if(!value){value=defaultValue;this.style.color='#999'}" style="color:#999999" >请输入描述信息</textarea>
     	<br />
     	<br />
     	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="submit" value="确定" id="form_upload_submit" />
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
xy_create_album();
if($_GET['action_create_album']==true){
	create_album();
}
?>
