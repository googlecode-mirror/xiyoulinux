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
s




?>
