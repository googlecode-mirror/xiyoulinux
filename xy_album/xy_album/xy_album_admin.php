<?php

include_once( $plugin_dir . 'xy_admin_function.php');
include_once( $plugin_dir . 'xy_album_config.php');

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
 	
    		<div id="icon-options-general" class="icon32"><br /></div><h2>西邮 linux相册管理  <?php echo XY_ALBUM_VERSION?></h2></div>

          <!-- Main Gallery Options -->
            
            <br />
              <tr>
                <th><label for="gallery_folder"><?php _e('你的相册路径：', $xy_text_domain); ?></label></th>
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
                              <strong style='color:#ff0000;'><?php _e( 'WARNING', $xy_text_domain ); ?></strong>: <?php _e( 'The specified gallery folder does not exist', $xy_text_domain ); ?>:
                              <code><?php _e(get_option('gallery_folder'), $xy_text_domain); ?></code><br />                   
								<a href="admin.php?page=<?php echo XY_ALBUM_DIR?>/xy_album_admin.php&amp;create_folder=<?php echo get_option('gallery_folder') ?>">为我创建这个目录</a>                             
                            </div>
                  <?php
                          }
                  ?>
                </td>
              </tr> 
              <br />
              
				<h4 /><a href="admin.php?page=<?php echo XY_ALBUM_DIR?>/xy_album_admin.php&amp;allow_create_album=true"><?php _e('创建相册', $xy_test); ?></a>
				<?php
				if($_GET['allow_create_album']==true){
				xy_create_album();
				}
				if($_GET['action_create_album']==true){
				create_album();
				}
                ?>              
			 <br />
                <h4 /><a href="admin.php?page=<?php echo XY_ALBUM_DIR?>/xy_album_admin.php&amp;allow_file_loading=true"><?php _e('照片上传', $xy_test); ?></a>
                <?php
                if($_GET['allow_file_loading']==true){
				xy_file_load();
				}
				if($_GET['action_file_upload']==true){
				file_upload();
				}?>

              <br />
                <h4 /><a href="admin.php?page=<?php echo XY_ALBUM_DIR?>/xy_album_admin.php&amp;allow_file_manager=true"><?php _e('照片管理', $xy_text_domain); ?></a>
                <?php
                if($_GET['allow_file_manager']==true){
				xy_file_manage();
				}
                ?>
                <!--测试页面-->
                <h4 /><a href="admin.php?page=<?php echo XY_ALBUM_DIR?>/xy_album_admin.php&amp;allow_test=true"><?php _e('测试用例', $xy_text_domain); ?></a>
                <?php
                if($_GET['allow_test']==true){
				xy_test();
				}
				if($_GET['action_allow_test']==true){
				action_xy_test();
				}
                ?>
           
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

for($i=0;$i<8;$i++){
	echo'<br />';
}
echo '<h1>继续开发中，敬请期待...<h1>'
?>







