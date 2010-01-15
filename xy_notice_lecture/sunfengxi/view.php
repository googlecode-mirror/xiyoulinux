<?php
   session_start();
   require_once "top.php";
   require_once "conn.php";
   $nid=$_GET["nid"];
   $lid=$_GET["lid"];
   //得到发布信息内容
   if($nid){
     $query="select * from xy_notice where notice_ID='$nid'";
   }elseif($lid){
	 $query="select * from xy_lecture where lecture_ID='$lid'"; 
   }
   $info=mysql_query($query);
   $contentarr=array();
   if(!($content=mysql_fetch_array($info,MYSQL_ASSOC))){ ?>
	<script language="javascript"> alert("内容不存在"); location.href="xy_Notice_Lecture.php?"; </script>
	<?php exit();
    }
?>
<div id="content">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10%"  style="BORDER-RIGHT: #d2d2d2 1px solid; BORDER-TOP: #d2d2d2 1px solid" vAlign=top width=180 height="100%">
	  <table cellSpacing=0 cellPadding=4 width="100%" align=center  border=0>
	    <tr><td colspan=3 background="images/menu_top.gif">&nbsp;</td></tr>
		<tr><td>&nbsp;</td><td colSpan=2 align ="left"><STRONG style="FONT-SIZE: 16px; COLOR: #0066cc">内容分类：</STRONG></td></tr>
		<tr><td>&nbsp;</td><td align=right width="16%"><IMG src="images/arrow4.gif"></td><td align ="left"><a href="xy_Notice_Lecture.php?op=A_notice" >公告</a></td></tr>
        <tr><td>&nbsp;</td><td align=right width="16%"><IMG src="images/arrow4.gif"></td><td align ="left"><a href="xy_Notice_Lecture.php?op=A_lecture">讲座</a></td></tr>
		</table>
		</td>
		<?php 
	 if($nid){ ?>
	  <td width="90%" align="center" valign="top"><div align="left" style="FONT-SIZE: 14px; COLOR: #0066cc"><br>
        &nbsp;您所在的位置:公告讲座&gt;公告&gt;<a href="view.php?nid=<?php echo $content[notice_ID]?>"><?php echo $content[notice_title]?></a>&gt;正文<br><br><br></div> 
	   <table width="90%" border="0" cellpadding="4" cellspacing="0" >
	   <tr><td><h2 align="center"><?php echo $content[notice_title]?></h2>
        <p align="center">发表时间:<?php echo $content[notice_date]?></p><p><?php echo $content[notice_content]?></p>
         </td></tr>
		<?php }elseif($lid){ ?>
		 <td width="90%" align="center" valign="top"><div align="left" style="FONT-SIZE: 14px; COLOR: #0066cc"><br>
        &nbsp;您所在的位置:公告讲座&gt;讲座&gt;<a href="view.php?lid=<?php echo $content[lecture_ID]?>"><?php echo $content[lecture_title]?></a>&gt;正文<br><br><br></div> 
	   <table width="90%" border="0" cellpadding="4" cellspacing="0" >
	   <tr><td><h2 align="center"><?php echo $content[lecture_title]?></h2>
	   <p align="center">讲座时间:<?php echo $content[lecture_date]?></p>
	   <p align="center">讲座地点:<?php echo $content[lecture_place]?></p>
	   <p align="center">演讲人:<?php echo $content[lecture_lecturer]?></p>
	   <p align="center">内容简介:<?php echo $content[lecture_intro]?></p>
       </td></tr>
	<?php }?>
		
      </table></td>
    </tr>
  </table>
</div>

<?php
require_once "foot.php";
?>
