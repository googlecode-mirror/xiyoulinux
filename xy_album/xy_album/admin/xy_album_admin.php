<?php

include_once( $plugin_dir . 'xy_admin_function.php');
include_once( dirname(dirname(__FILE__)) . '/xy_album_config.php');

$folder_uri = "wp-content/xy-album/";
update_option('gallery_folder',$folder_uri);

?>


<?php


if (isset($_GET['create_folder'])) {
   xy_create_gallery_folder($_GET['create_folder']); 
   //同时创建一个存放缩略图的目录 
   xy_create_gallery_folder($_GET['create_folder']."thumbs"); 
}  

xy_build_admin_form();


/**
* 功能:建立管理form
* 作者:周永飞
* 输入参数：void
* 输出参数：void
* 日期:
*/
function xy_build_admin_form() {
  global $xy_text_domain, $plugin_dir;

  if ( current_user_can('manage_options') ) {
    
  ?>

    
    <div class="wrap">
 	
    		<div id="icon-upload" class="icon32"><br /></div><h2>西邮 linux相册管理  <?php echo XY_ALBUM_VERSION?></h2></div>

          <!-- Main Gallery Options -->
            
            <br />
              <tr>
                <th><label for="gallery_folder">&nbsp<?php _e('你的相册路径：', $xy_text_domain); ?></label></th>
                <td>
                  <?php
                    $xy_gallery_folder = get_option('gallery_folder');												
                  ?>
                  <input name="gallery_folder" id="gallery_folder" value="<?php echo $xy_gallery_folder ?>" size=20 class="code" type="text" readonly="" /> <br />
                  <?php
                            if (!(file_exists(ABSPATH.get_option('gallery_folder')))) {
                  ?>
                            <div>
                            <br />
                              <strong style='color:#ff0000;'><?php _e( 'WARNING', $xy_text_domain ); ?></strong>: <?php _e( '不存在这样的存放相片的目录', $xy_text_domain ); ?>:
                              <code><?php _e(get_option('gallery_folder'), $xy_text_domain); ?></code><br />                   
								<a href="admin.php?page=<?php echo XY_ALBUM_DIR?>/admin/xy_album_admin.php&amp;create_folder=<?php echo get_option('gallery_folder') ?>">为我创建这个目录</a>                             
                            </div>
                  <?php
                          }
                  ?>
                </td>
              </tr> 
              <br />
              
    <div class="wrap">
    	<h4>欢迎使用西邮linux相册管理后台，在这里您可以：&nbsp&nbsp&nbsp&nbsp&nbsp<a href="admin.php?page=<?php echo XY_ALBUM_DIR?>/admin/xy_create_album.php">创建相册</a>           
                <a href="admin.php?page=<?php echo XY_ALBUM_DIR?>/admin/xy_upload_photo.php">上传照片</a>
                <a href="admin.php?page=<?php echo XY_ALBUM_DIR?>/admin/xy_album_manage.php">管理相册</a>
     </div>      
    <?php
    
    } else { ?>
    <div class="wrap">
    	<h2>西邮linux相册 选项</h2>
    	<div id="message" class="error fade">
        <p><?php echo __(" It seems like you don't have permission to change XY_album Gallery's Options", $xy_text_domain); ?></p>
    	</div>	
    </div>
    <?php
  }
}


?>







