<?php

include_once( dirname(__FILE__) . '/admin/xy_admin_function.php');

function createJson()
{
 
	global $wpdb;
	$table2album = $wpdb->prefix . "xy_album";
	$table2photo = $wpdb->prefix . "xy_photo";
	$albums =  $wpdb->get_results( "SELECT * FROM $table2album");
	$i = 0;
	$j = 0;
	foreach($albums as $album){
		$album_name[$i] = $album->album_name;
		$album_intro[$i] = $album->album_intro;
		$album_cover[$i] = $album->album_cover;
		$album_id = $album->album_ID;
		$photos =  $wpdb->get_results( "SELECT * FROM $table2photo where photo_album = $album_id");
		foreach($photos as $photo){
			$photo_name[$i][$j] = get_file_name($photo->photo_url);
			$photo_intro[$i][$j] = $photo->photo_intro;
			$photo_tag[$i][$j] = $photo->photo_tag;
			$photo_thumb_url[$i][$j] = $photo->photo_thumb_url;
			$photo_url[$i][$j] = $photo->photo_url;
			$j++;
		}
		$i++;
	}
	$albumJson = '[';
	for($k=0;$k<$i;$k++){
	$albumJson = $albumJson.'{ "album_name":"'.$album_name[$k].'","album_intro":"'.$album_intro[$k].'","album_cover":"'.$album_cover[$k].'","photo":[';
		for($m=0;$m<$j;$m++){
		if($photo_name[$k][$m]==""){ 
			$var = trim($albumJson);
			$len = strlen($var)-1;
			$str = $var{$len};
			//最后一个字符是逗号才去删除
			if($str==","){
				$albumJson = substr($albumJson,0,strlen($albumJson)-1);
				$flag=1;
			}
			continue;
		}
		$albumJson = $albumJson.'{ "photo_name":"'.$photo_name[$k][$m].'", "photo_intro":"'.$photo_intro[$k][$m].'", "photo_tag":"'.$photo_tag[$k][$m].'","photo_thumb_url":"'.$photo_thumb_url[$k][$m].'","photo_url":"'.$photo_url[$k][$m].'" }';
			if($m!=$j-1){
				$albumJson = $albumJson.',';
			}
			//echo $photo_name[$k][$m];
			
		}
		$albumJson = $albumJson.']}';
		if($k!=$i-1){
			$albumJson = $albumJson.',';
		}
		//echo "<br />";
	}
	$albumJson = $albumJson.']';
	return $albumJson;
}

	$json=createJson();
	  global $wpdb;
	  $table2json = $wpdb->prefix . "xy_json";
	$update = "update " . $table2json ." set album_json='".createJson()."';";
      $results = $wpdb->query( $update);

?>

