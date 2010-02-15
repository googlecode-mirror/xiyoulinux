<?php header("Content-Type: text/html; charset=utf-8");?>
<?php 
/*
 * File Name: project_show.php
 * Description:	项目前台展示
 */
 
include_once('project_config.php');
include_once('utils/project_api.php');

if(isset($_GET['project'])) {
	$project_id = intval($_GET['project']);
}
else {
	echo "oh, no";
}

$myproject = new Project($project_id);

if($myproject->get_project_allow()==0) {
	$myproject->print_project_name();
	echo "<br/>";
	$myproject->print_project_member();
	echo "<br/>";
	$myproject->print_project_start_date();
	echo "<br/>";
	$myproject->print_project_finish_date();
	echo "<br/>";
	$myproject->print_project_intro();
	echo "<br/>";
	$myproject->print_project_pic();
	echo "<br/>";
	$myproject->print_project_doc();
	echo "<br/>";
	$myproject->print_project_url();
	echo "<br/>";
	$myproject->print_project_download();
	echo "<br/>";
	$myproject->print_project_rss();
	echo "<br/>";
	$myproject->print_project_auther_ID();
	echo "<br/>";
	$myproject->print_project_tag();
	echo "<br/>";
	$myproject->print_project_allow();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/sub_style.css" rel="stylesheet" type="text/css" />
		<link href="css/project_style.css" rel="stylesheet" type="text/css" />
		<title>xiyoulinux</title>
	</head>
	<body>
		<div id="page">
			<?php require('head.php');?>
		    <div id="content">
		       <div id="project">
		       		<div class="project_single">
		                <div class="single_pic"><img src=<?php $myproject->print_project_pic();?>></div>
		                <div class="single_text">
		                    <span><?php $myproject->print_project_intro();?></span>
		                    <a href=<?php $myproject->print_project_download();?>><div id="single_download">test</div></a>
		                </div>
		            </div>
		            <div class="project_single">
		                <div class="single_pic">
		                	<div id="single_intro_top"></div>
		                    <div id="single_intro_content">
		                    	<div id="single_intro_title">项目简介</div>
		                        <div id="single_intro_text">
		                        	<table cellspacing="0">
		                            	<tr>
		                                	<td width="80">创建者</td>
		                                    <td><?php $myproject->print_project_member();?></td>
		                                </tr>
		                                <tr>
		                                	<td>成员</td>
		                                    <td><?php $myproject->print_project_member();?></td>
		                                </tr>
		                                <tr>
		                                	<td>创建日期</td>
		                                    <td><?php $myproject->print_project_start_date();?></td>
		                                </tr>
		                                <tr>
		                                	<td>结束日期</td>
		                                    <td><?php $myproject->print_project_finish_date();?></td>
		                                </tr>
		                                <tr>
		                                	<td>文档</td>
		                                    <td><?php $myproject->print_project_doc();?></td>
		                                </tr>
		                                <tr>
		                                	<td>地址</td>
		                                    <td><?php $myproject->print_project_url();?></td>
		                                </tr>
		                                <tr>
		                                	<td>标签</td>
		                                    <td><?php $myproject->print_project_tag();?></td>
		                                </tr>
		                            </table>
		                        </div>
		                    </div>
		                    <div id="single_intro_botttom">
		                    	<div class="single_intro_side"><img src="images/project_single_05.gif"></div>
		                        <div id="single_intro_line"></div>
		                        <div class="single_intro_side"><img src="images/project_single_06.gif"></div>
		                    </div>
		                </div>
		                <div class="single_text">
		                	<div id="single_update_top"></div>
		                    <div id="single_update_content">
		                    	<div id="single_update_title">
		                        	<span>xiyou linux update</span>
		                            <img src="images/project_single_08.gif">
		                        </div>
		                        <div id="single_update_text">
		                        	<ul>
		                            	<li>r198: update api,更新test.php文件，删除yfile.php<br>
		                                    committed by Helight<br>
		                                    posted 21 days ago <br>
		                                 </li>
		                                 <li>r198: update api,更新test.php文件，删除yfile.php<br>
		                                    committed by Helight<br>
		                                    posted 21 days ago <br>
		                                 </li>
		                                 <li>r198: update api,更新test.php文件，删除yfile.php<br>
		                                    committed by Helight<br>
		                                    posted 21 days ago <br>
		                                 </li>
		                                 <li>r198: update api,更新test.php文件，删除yfile.php<br>
		                                    committed by Helight<br>
		                                    posted 21 days ago <br>
		                                 </li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div id="single_update_botttom">
		                    	<div class="single_intro_side"><img src="images/project_single_05.gif"></div>
		                        <div id="single_update_line"></div>
		                        <div class="single_intro_side"><img src="images/project_single_06.gif"></div>
		                    </div>
		                </div>
		            </div>
		            <div id="single_about">
		            	<div id="single_about_title">
		                	<div class="project_title_side"><img src="images/project_title_01.gif"></div>
		                    <div id="single_about_text">相关项目</div>
		                    <div class="project_title_side"><img src="images/project_title_02.gif"></div>
		                </div>
		                <div id="single_about_pic">
		                	<ul>
		                	<li><a href="#"><img src="images/project_single_09.gif"></a></li>
		                    <li><a href="#"><img src="images/project_single_09.gif" /></a></li>
		                    <li><a href="#"><img src="images/project_single_09.gif"></a></li>
		                    <li><a href="#"><img src="images/project_single_09.gif"></a></li>
		                   </ul>
		                </div>
		            </div>
		       </div>  
			</div>
		</div>
		<?php require("foot.php")?>
	</body>
</html>
