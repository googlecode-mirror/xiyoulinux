<?php
  session_start();
  require_once "top.php";
  ?>
      <div id="content">
      <table width="100%" border="1" cellspacing="1" cellpadding="1">
      <tr>
      <td width="10%"  style="BORDER-RIGHT: #d2d2d2 1px solid; BORDER-TOP: #d2d2d2 1px solid" vAlign=top width=180 height="100%">
	  <table cellSpacing=0 cellPadding=4 width="100%" align=center  border=0>
	    <tr><td colspan=3 background="images/menu_top.gif">&nbsp;</td></tr>
		<tr><td>&nbsp;</td><td colSpan=2 align ="left"><STRONG  style="FONT-SIZE: 16px; COLOR: #0066cc">内容分类：</STRONG></td></tr>
        <tr><td>&nbsp;</td><td align=right width="16%"><IMG src="images/arrow4.gif"></td><td align ="left"><a href="admin.php?op=m_notice" >公告管理</a></td></tr>
        <tr><td>&nbsp;</td><td align=right width="16%"><IMG src="images/arrow4.gif"></td><td align ="left"><a href="admin.php?op=m_lecture">讲座管理</a></td></tr>
        <tr><td>&nbsp;</td><td align=right width="16%"><IMG src="images/arrow4.gif"></td><td align ="left"><a href="admin.php?op=notice" >发布公告</a></td></tr>
		<tr><td>&nbsp;</td><td align=right width="16%"><IMG src="images/arrow4.gif"></td><td align ="left"><a href="admin.php?op=lecture">发布讲座</a></td></tr>
      </table>
      <td width="80%" align="center" valign="top"> 
   	   <?php
	   $op=$_GET["op"]; 
	   $lid=$_GET["lid"];
	   $nid=$_GET["nid"];
	  if($op=="m_notice"){
			require_once "conn.php";
			$query="select * from xy_notice";
			$info=mysql_query($query);
			$typearr=array();
			while($result=mysql_fetch_array($info,MYSQL_ASSOC)){
				$typearr[]=$result;
			}
	  ?>
	  <h4 color="red">公告管理<h4>
          
<table width="90%" border="2" cellspacing="1" cellpadding="0">
  <tr>
    <td width="40%" align="center">公告</td>
	<td width="30%" align="center">时间</td>
    <td width="30%" align="center">操作</td>
  </tr>
  <?php
	foreach($typearr as $type){
 ?>
		  <tr><td align="center"><?php echo($type[notice_title]); ?></td><td align="center"><?php echo($type[notice_date]); ?></td>
			<td align="center"><a href="admin.php?op=e_notice&nid=<?php echo($type[notice_ID]); ?>" >修改</a> &nbsp; &nbsp;
			 <a href="save.php?op=d_notice&nid=<?php echo($type[notice_ID]); ?>"  onClick="if(confirm('确定删除此公告?')){return true;}return false;">删除</a>  
		     </td></tr>
     <?php }  ?>
	
    </table>
    <br><br><br><br>
 
 <?php
	  
	  }elseif($op=="m_lecture"){
		  	require_once "conn.php";
			$query="select * from xy_lecture";
			$info=mysql_query($query);
			$contentarr=array();
			while($result=mysql_fetch_array($info,MYSQL_ASSOC)){
				$contentarr[]=$result;
			}
	  ?>	  
	   <h4 color="red">讲座管理:<h4>
<table width="90%" border="2" cellspacing="1" cellpadding="0">
  <tr>
    <td width="20%" align="center">标题</td>
	<td width="20%" align="center">演讲人</td>
	<td width="20%" align="center">时间</td>
	<td width="20%" align="center">地点</td>
    <td width="20%" align="center">操作</td>
  </tr>
  <?php
		  foreach($contentarr as $content){
			  ?>
	<tr><td align="center" ><?php echo($content[lecture_title]);?></td><td align="center"><?php echo($content[lecture_lecturer]);?></td><td align="center"><?php echo($content[lecture_date]);?></td><td align="center"><?php echo($content[lecture_place]);?></td>
         <td align="center"><input type="button" value="修改" onclick=if(confirm("确定修改?")){location="admin.php?op=e_lecture&lid=<?php echo($content[lecture_ID]);?>";}>&nbsp;
	       <input type="button" value="删除" onclick=if(confirm("确定删除此讲座?")){location="save.php?op=d_lecture&lid=<?php echo($content[lecture_ID]);?>";} />
	    </td>
    </tr>
	 <?php }?>
 </table><br><br><br><br>
 
 
 
 <?php
	  }elseif($op=="notice"){
		 require_once "conn.php";
		 ?>
		<h4 color="red">发布公告<h4>
  <br><form action="save.php?op=notice" method="post"><div align="center" width="90%">
  <table width="90%" border="2" cellspacing="1" cellpadding="1">
    <tr>
      <td width="15%">标题:</td>
      <td><input name="notice_title" type="text" id="subject" size="80"></td>
    </tr>
	 <tr>
      <td width="15%">标签:</td>
      <td><input name="notice_tag" type="text" id="subject2" size="80"></td>
    </tr>
    <tr>
      <td width="15%" valign="top">内容:</td>
      <td><textarea name="notice_content" cols="80" rows="20" id="message"></textarea></td>
    </tr>
  </table><br /><input type="submit" value="发表"/></form>

<?php
   

  }elseif($op=="lecture"){
		  	require_once "conn.php";
			
	?>
		<h4 color="red">发布讲座<h4>
  <br><form action="save.php?op=lecture&action=upFile" method="post"><div align="center" width="90%">
  <table width="90%" border="2" cellspacing="1" cellpadding="1">
    <tr>
      <td width="15%">标题:</td>
      <td><input name="lecture_title" type="text" id="subject" size="80"></td>
    </tr>
   
	<tr>
      <td width="15%">讲座时间:</td>
      <td><input name="lecture_date" type="text" id="subject" size="80"></td>
    </tr>
	<tr>
      <td width="15%">地点:</td>
      <td><input name="lecture_place" type="text" id="subject" size="80"></td>
    </tr>
	<tr>
      <td width="15%">主讲人:</td>
      <td><input name="lecture_lecturer" type="text" id="subject" size="80"></td>
    </tr>
	<tr>
      <td width="15%">标签:</td>
      <td><input name="lecture_tag" type="text" id="subject" size="80"></td>
    </tr>
	<tr>
      <td width="15%">URL:</td>  
	  <td ><input type="file" name="lecture_note_url" value="浏览" class="txt" id="subject" size="80"></td>
    </tr>	
	 <tr>
      <td width="15%" >内容:</td>
      <td><textarea name="lecture_intro" cols="80" rows="10" id="message"></textarea></td>
    </tr>
	<tr>
      <td width="15%">总结:</td>
    <td><textarea name="lecture_conclusion" cols="80" rows="10" id="message2"></textarea></td>
    </tr>
  </table><br><input type="submit" value="发表"/>
  </form>

<?php
}elseif($op=="e_notice"){
            
	        require_once "conn.php";
			$query="select * from xy_notice where notice_ID='$nid'";
			$info=mysql_query($query);
			if($content=mysql_fetch_array($info,MYSQL_ASSOC)){?>
		  <p>修改公告:<br>
  <br><form action="save.php?op=e_notice&nid=<?php echo $content[notice_ID]?>" method="post"><input type="hidden" name="cid" value="<?php echo $content[notice_ID];?>"/><div align="center" width="90%">
  <table width="90%" border="2" cellspacing="1" cellpadding="1">
    <tr>
      <td width="15%">标题:</td>
      <td><input name="notice_title" type="text" id="subject" size="80" value="<?php echo $content[notice_title]?>"></td>
    </tr>
	 <tr>
      <td width="15%">标签:</td>
      <td><input name="notice_tag" type="text" id="subject" size="80" value="<?php echo $content[notice_tag]?>" ></td>
    </tr>
    <tr>
      <td width="15%" valign="top">内容:</td>
      <td><textarea name="notice_content" cols="80" rows="20" id="message"><?php echo $content[notice_content]?></textarea></td>
    </tr>
  </table><br /><input type="submit" value="修改"/></form>
<?php
			}

}elseif($op=="e_lecture"){ 
	 
	      require_once "conn.php";
		    $query="select * from xy_lecture where lecture_ID='$lid'";
			$info=mysql_query($query);
			if($content=mysql_fetch_array($info,MYSQL_ASSOC)){ ?> 
		
	      <p>修改讲座:<br>
         <br><form action="save.php?op=e_lecture&lid=<?php echo $content[lecture_ID]?>&action=upFile" method="post"><input type="hidden" name="cid" value="<?php echo $content[lecture_ID];?>"/><div align="center" width="90%">
         <table width="90%" border="2" cellspacing="1" cellpadding="1">
		  <tr>
      <td width="15%">标题:</td>
      <td><input name="lecture_title" type="text" id="subject" size="80" value="<?php echo $content[lecture_title]?>"></td>
    </tr>
   
	<tr>
      <td width="15%">讲座时间:</td>
      <td><input name="lecture_date" type="text" id="subject" size="80" value="<?php echo $content[lecture_date]?>"></td>
    </tr>
	<tr>
      <td width="15%">地点:</td>
      <td><input name="lecture_place" type="text" id="subject" size="80" value="<?php echo $content[lecture_place]?>"></td>
    </tr>
	<tr>
      <td width="15%">主讲人:</td>
      <td><input name="lecture_lecturer" type="text" id="subject" size="80" value="<?php echo $content[lecture_lecturer]?>"></td>
    </tr>
	<tr>
      <td width="15%">标签:</td>
      <td><input name="lecture_tag" type="text" id="subject" size="80" value="<?php echo $content[lecture_tag]?>"></td>
    </tr>
	<tr>
      <td width="15%">URL:</td>
      <td><input name="lecture_note_url" type="text" id="subject" size="80" value="<?php echo $content[lecture_note_url]?>"></td>
    </tr>	
	 <tr>
      <td width="15%" >内容:</td>
      <td><textarea name="lecture_intro" cols="80" rows="10" id="subject" ><?php echo($content[lecture_intro]); ?></textarea></td>
    </tr>
	
	<tr>
      <td width="15%">总结:</td>
     <td><textarea name="lecture_conclusion" cols="80" rows="10" id="subject" ><?php echo $content[lecture_conclusion]?></textarea></td>
    </tr>
  
  </table><br /><input type="submit" value="修改"/></form>
<?php
		}

}else{
		  echo "<h1>欢迎进入公告后台管理!<h1>";
	  }
	  ?>
	 
	  </td>
    </tr>
  </table></div>
</div>

<?php
require_once "foot.php";
?>

