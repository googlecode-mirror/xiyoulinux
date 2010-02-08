<?php

function getFeed($feed_url) {
	
	$content = file_get_contents($feed_url);
	echo $content;
	$x = new SimpleXmlElement($content);
	
	echo "<ul id='test'>";
	
	foreach($x->channel->item as $entry) {
		echo "<li><h2>". $entry->title ."</h2>";
		echo "<div style='display:none'>".$entry->description."</div></li> ";
		}
	echo "</ul>";
}

function show_list()
{
	if ($rs = $rss->get("../xy_members.xml")) {
		//echo $rs[description]."<br><br>\n";
		echo "<div style='height: 560px;' id='subTree' class='scrolled accordion-body'>";
		foreach ($rs['items'] as $item) {
		
		echo "<ul class='subscribes'><li><a class='all-readed' title='".$item[title]."' href='#.$item[link].' >";
		echo "<strong><span class='title'>".$item[title]."</span></strong></a>";
		echo "</li></ul>";
		}
		if ($rs['items_count'] <= 0) {
			echo "<li>Sorry, no items found in the RSS file :-(</li>"; 
		}
		echo "</div>\n";
	}
	else {
		echo "Sorry: It's not possible to reach RSS file $url\n<br />";
		// you will probably hide this message in a live version
	}
}
?>
