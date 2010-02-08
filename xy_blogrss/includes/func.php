<?php
	include "./includes/lastRSS.php"; 
	$rss2 = new lastRSS;
	$rss2->cache_dir = './temp';
	$rss2->cache_time = 1200; 

function show_top()
{
?>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>西邮RSS阅读</title>
	<link rel="stylesheet" type="text/css" href="css/css.css">
	<link href="css/sub_style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/toggleElements.css" />
	<script type="text/javascript" src="js/jquery.toggleElements.pack.js"></script>
	<script type="text/javascript" src="js/jquery-1.2.1.js"></script>
	<script type="text/javascript" src="js/ddaccordion.js"></script>
	<script type="text/javascript" src="js/function.js" ></script>
	<script type="text/javascript" src="js/jquery.toggleElements.pack.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('div.toggler1').toggleElements( );
});
	
ddaccordion.init({
        headerclass: "list_title", 
        contentclass: "hide_menu", 
        revealtype: "click", 
        mouseoverdelay: 100, 
        collapseprev: true, 
        defaultexpanded: [0],
        onemustopen: false, 
        animatedefault: false, 
        persiststate: true, 
        toggleclass: ["", "openheader"], 
        togglehtml: ["prefix", "", ""], 
        animatespeed: "fast",
        oninit:function(headers, expandedindices){ 
                //do nothing
        },
        onopenclose:function(header, index, state, isuseractivated){ 
                //do nothing
        }
})
	
</script>
</head>
<?php
}
?>

<!-- function ShowOneRSS($url) -->
<?php
function ShowOneRSS($url) {
	global $rss2;
	
	if (!$url) {
		$url="http://zhwen.org/xlog/feed";
	}
	if (($rs = $rss2->get($url)) && ($url != '')) {
	echo "<div id=\"blog_user\">";
	echo "<span id=\"blog_user\"><a target='_blank' ";
	echo "href='".$rs[link]."' id='titleSourceLink'>".$rs[title]."</a></span>";
	echo "<span id=\"blog_user\">".$rs[description]."</span>";
	echo "</div>";

	echo "<div id=\"blog_text\">";
	echo "<div id=\"blog_type\">";
	echo "<div id=\"h4\">显示：<b><a href=\"#\">显示全部</a></b>&nbsp;&nbsp;<span><a href=\"#\">分享此订阅</a></span></div>";
	echo "<div id=\"h5\">标题模式&nbsp;&nbsp;</div>";
	echo "</div>";
	echo "<div id=\"blog_article\">";	//<!-- begin show rss-->
	foreach ($rs['items'] as $item) {
	//<!-- one item -->	
	echo "<div class=\"toggler1\" title=".$item[title].">";
	echo "<div class=\"rsscontent\">";
	echo "<div class='rtitle'><a target='_blank' title='到原网页查看全文' ";
	echo "href='".$item[link]."'>".$item[title]."<img src='images/icon_go.gif' border=0></a>";
	echo "<span class='stat'> 作者：helight 发表时间：Time</span></div>";
	echo "<div style=\"text-align:left;\"><br>";		
		$out = strtr($item[description], array('<![CDATA['=>'', ']]>'=>''));
		echo "<div>".$out."</div>";
	echo "</div><br>";
	echo "<div class=\"addrssto\">加入收藏其他</div>";
	echo "</div>";
	echo "</div>";				//<!-- end one item -->
	} 
	echo "</div><div id=\"blog_bottom\"></div></div>";		//<!-- end show rss-->
	} else {
		echo "<li>Sorry, no items found in the RSS file :-(</li>"; 
	}
}
?>
<!-- end of function -->
