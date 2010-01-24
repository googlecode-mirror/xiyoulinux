<?php
/*
Plugin Name: xy_album
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: this is a album-plgin for the web of the xiyoulinux,it has completed simply to upload photos,scan the photos,comment them.
Version: 0.1
Author: 周永飞,李阳,孙建刚
Author URI: http://URI_Of_The_Plugin_Author
*/

/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



function xy_add_feedburner_options_page() {
if (function_exists('add_menu_page')) {
$file="xy_album/xy_album_admin.php";
add_menu_page('xy_album', 'xy_album', 8, $file );
}
}

add_action('admin_menu', 'xy_add_feedburner_options_page'); 



$xy_albumdb_version = "1.0";

/**
 * xy_album_install ()
 * create database tables while installing the plugin 
 * 
 * @
 * @return void
 * @
 */

function xy_album_install () {
   global $wpdb;
   global $xy_albumdb_version;

   $table2album = $wpdb->prefix . "xy_album";
   $table2photo = $wpdb->prefix . "xy_photo";
   if(($wpdb->get_var("show tables like '$table2album'") != $table2album)&&($wpdb->get_var("show tables like '$table2photo'") != $table2photo)) {
      //相册ID，相册名称，相册封面，相册描述，相册作者，相册日期
      $sql2album = "CREATE TABLE " . $table2album . " (
  	`album_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  	`album_name` varchar(255) DEFAULT NULL,
  	`album_cover` varchar(255) DEFAULT NULL,
  	`album_intro` varchar(255) DEFAULT NULL,
  	`album_auther_ID` bigint(20) unsigned DEFAULT NULL,
  	`album_date` datetime DEFAULT NULL,
  	PRIMARY KEY (`album_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	//照片ID，所在相册，照片地址，缩略图地址，照片介绍，作者，日期，标签
      $sql2photo = "CREATE TABLE " . $table2photo . " (
  	`photo_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  	`photo_album` bigint(20) unsigned DEFAULT NULL,
  	`photo_url` varchar(255) DEFAULT NULL,
  	`photo_thumb_url` varchar(255) DEFAULT NULL,
  	`photo_intro` text,
  	`photo_auther_ID` bigint(20) unsigned DEFAULT NULL,
  	`photo_date` datetime DEFAULT NULL,
  	`photo_tag` varchar(255) DEFAULT NULL,
  	PRIMARY KEY (`photo_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql2album);
      dbDelta($sql2photo);

      /*$insert = "INSERT INTO " . $table_name .
            " (time, name, text) " .
            "VALUES ('" . time() . "','" . $wpdb->escape($welcome_name) . "','" . $wpdb->escape($welcome_text) . "')";

      $results = $wpdb->query( $insert );*/
 
      add_option("xy_albumdb_version", $xy_albumdb_version);

   }
}

register_activation_hook(__FILE__,'xy_album_install');  


?>
