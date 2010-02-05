<?php 
/*
 * File Name: project_show.php
 * Description:	项目前台展示
 */
include('project_api.php');

$myproject = new Project(1);
//$myproject->print_project_name();



function get_myfeed($myfeed='http://code.google.com/feeds/p/xiyoulinux/updates/basic', $feedtitle='西邮Linux小组项目更新', $shownumber = '5'){
	require_once (ABSPATH . WPINC . '/rss-functions.php');
	$rss = @fetch_rss($myfeed);
	if(isset($rss->items) && 0 != count($rss->items)) {
		echo '<h3>' . $feedtitle . '</h3><ul>';
		$rss->items = array_slice($rss->items, 0, $shownumber);
		foreach ($rss->items as $item ) {
			$title = wp_specialchars($item['title']);
			$url = wp_filter_kses($item['link']);
			echo "<li><a href=$url>$title</a></li>";
			echo $item['description'];
		}
	}
	echo "</ul>";
}
?>
<?php get_myfeed(); ?>