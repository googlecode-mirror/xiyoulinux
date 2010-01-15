<?php
   session_start();   
   require_once "top.php";
   require_once "conn.php";
   $op=$_GET["op"];
   if($op=="A_notice"){
      $query="select * from xy_notice order by notice_date desc";
   }elseif($op=="A_lecture"){
      $query="select * from xy_lecture order by lecture_date desc ";
   }else{
	  $query="select * from xy_notice order by notice_date desc limit 0,10";
   }  
   $info=mysql_query($query);
   $contentarr=array();
   while($result=mysql_fetch_array($info,MYSQL_ASSOC)){
   $contentarr[]=$result;
   }

?>
<div id="content">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10%"  style="BORDER-RIGHT: #d2d2d2 1px solid; BORDER-TOP: #d2d2d2 1px solid" vAlign=top width=180 height="100%">
	  <table cellSpacing=0 cellPadding=4 width="100%" align=center  border=0>
	    <tr><td colspan=3 background="images/menu_top.gif">&nbsp;</td></tr>
		<tr><td>&nbsp;</td><td colSpan=2 align ="left">
       <STRONG style="FONT-SIZE: 16px; COLOR: #0066cc">内容分类：</STRONG></td></tr>
		<tr><td>&nbsp;</td><td align=right width="16%"><IMG src="images/arrow4.gif"></td><td align ="left"><a href="xy_Notice_Lecture.php?op=A_notice" >公告</a></td></tr>
        <tr><td>&nbsp;</td><td align=right width="16%"><IMG src="images/arrow4.gif"></td><td align ="left"><a href="xy_Notice_Lecture.php?op=A_lecture">讲座</a></td></tr>
		</table>
		</td>
		<?php 
	 if($op=="A_notice"){ ?>
		  <td width="90%" align="center" valign="top"><div align="left" style="FONT-SIZE: 14px; COLOR: #0066cc"><br />
            &nbsp;您所在的位置:公告讲座</a>&gt;所有公告 <br><br>
        </div>
        <table width="90%" border="0" cellpadding="4" cellspacing="0" >
        <tr><td width="60%" align="left"><strong>标题</strong></td><td width="40%"><strong>发布时间</strong></td></tr>
		<?php
		foreach($contentarr as $content){ ?>	
		<tr>
        <td align="left"><img src='images/xg.gif' align='absmiddle' /><a href="view.php?nid=<?php echo($content[notice_ID]); ?>" ><?php echo($content[notice_title]); ?></a><hr size="1" style="border-bottom: 1px dotted #cccccc"></td>
        <td><?php echo($content[notice_date]); ?><hr size="1" style="border-bottom: 1px dotted #cccccc"></td>
        </tr>
		<?php }
    }elseif($op=="A_lecture"){ ?>
       <td width="90%" align="center" valign="top"><div align="left" style="FONT-SIZE: 14px; COLOR: #0066cc"><br />
        &nbsp;您所在的位置:公告讲座</a>&gt;全部讲座 <br />
        <br />
      </div>
        <table width="90%" border="0" cellpadding="4" cellspacing="0" >
         <tr><td width="40%" align="left"><strong>标题</strong></td><td width="20%"><strong>时间</strong></td><td width="20%"><strong>地点</strong></td><td width="20%"><strong>主讲</strong></td>
        </tr>
		<?php
		foreach($contentarr as $content){ ?>	
		<tr>
        <td align="left"><img src='images/xg.gif' align='absmiddle' /><a href="view.php?lid=<?php echo($content[lecture_ID]); ?>" ><?php echo($content[lecture_title]); ?></a><hr size="1" style="border-bottom: 1px dotted #cccccc"></td>
        <td><?php echo($content[lecture_date]); ?><hr size="1" style="border-bottom: 1px dotted #cccccc"></td>
		<td><?php echo($content[lecture_place]); ?><hr size="1" style="border-bottom: 1px dotted #cccccc"></td>
		<td><?php echo($content[lecture_lecturer]); ?><hr size="1" style="border-bottom: 1px dotted #cccccc"></td>
        </tr>
		<?php } 		
   }else{ ?>

      <td width="90%" align="center" valign="top"><div align="left" style="FONT-SIZE: 14px; COLOR: #0066cc"><br />
        &nbsp;您所在的位置:公告讲座</a>&gt;最新公告 <br />
        <br />
      </div>
        <table width="90%" border="0" cellpadding="4" cellspacing="0" >
         <tr><td width="60%" align="left"><strong>标题</strong></td><td width="40%"><strong>发布时间</strong></td>
        </tr>
		<?php
		foreach($contentarr as $content){ ?>	
		<tr>
        <td align="left"><img src='images/xg.gif' align='absmiddle' /><a href="view.php?nid=<?php echo($content[notice_ID]); ?>" ><?php echo($content[notice_title]); ?></a><hr size="1" style="border-bottom: 1px dotted #cccccc"></td>
        <td><?php echo($content[notice_date]); ?><hr size="1" style="border-bottom: 1px dotted #cccccc"></td>
        </tr>
		<?php } 
	} ?>

      </table><br />
	  </td>
    </tr>
  </table>
</div>

<?php
require_once "foot.php";
?>
