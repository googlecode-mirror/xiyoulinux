<?php
   session_start();
   $op=$_GET["op"];
  
   require_once "conn.php";
    if($op=="d_notice"){
	   $nid=$_GET["nid"];
	   $query="delete from xy_notice where notice_ID='$nid'";
       $info=mysql_query($query);
	   if($info){
          echo "<script language=\"javascript\">alert('删除成功');location.href=\"admin.php?op=m_notice\";</script>";
	      exit();
       }else{
	      echo "<script language=\"javascript\">alert('删除不成功');location.href=\"admin.php?op=m_notice\";</script>";
	      exit(); 
	   }
    }elseif($op=="d_lecture"){
	   $lid=$_GET["lid"];
	   $query="delete from xy_lecture where lecture_ID='$lid'";
       $info=mysql_query($query);
	   if($info){
           echo "<script language=\"javascript\">alert('删除成功');location.href=\"admin.php?op=m_lecture\";</script>";
	       exit();
		}else{
		   echo "<script language=\"javascript\">alert('删除不成功');location.href=\"admin.php?op=m_lecture\";</script>";
	       exit();
		}
	  
    }elseif($op=="e_notice"){
		$nid=$_GET["nid"];
		$notice_title=$_POST["notice_title"];
		$notice_content=$_POST["notice_content"];
		$notice_tag=$_POST["notice_tag"];
		$notice_date=strftime("%Y-%m-%d %H:%M:%S");
	
		if(!$notice_title||!$notice_content){
		echo "<script language=\"javascript\">alert('标题或内容未填');location.href=\"admin.php?op=notice\";</script>";
		exit();
        }
         $query="update xy_notice set notice_title='$notice_title',notice_content='$notice_content',notice_date='$notice_date',notice_tag='$notice_tag'  where notice_ID='$nid'";
         $info=mysql_query($query);

         if($info){ 
	         echo "<script language=\"javascript\">alert('修改成功');location.href=\"admin.php?op=m_notice\";</script>";
		     exit();
         }else{
			 echo "<script language=\"javascript\">alert('修改不成功');location.href=\"admin.php?op=m_notice\";</script>";
		     exit();
		 }
	  
		  
	}elseif($op=="e_lecture"){
		 $action=$_GET["action"];
		$lid=$_GET["lid"];
		
		$lecture_title=$_POST["lecture_title"];
	    $lecture_date=$_POST["lecture_date"];
        $lecture_place=$_POST["lecture_place"];
        $lecture_lecturer=$_POST["lecture_lecturer"];
        $lecture_tag=$_POST["lecture_tag"];
        $lecture_note_url=$_POST["lecture_note_url"];
		$lecture_intro=$_POST["lecture_intro"];
		$lecture_conclusion=$_POST["lecture_conclusion"];
		$notice_date=strftime("%Y-%m-%d %H:%M:%S");
		if(!$lecture_title||!$lecture_intro){
		echo "<script language=\"javascript\">alert('标题或内容未填');location.href=\"admin.php?op=lecture\";</script>";
		exit();
        }
		if(!$lecture_place||!$lecture_date){
		echo "<script language=\"javascript\">alert('时间或地点未填');location.href=\"admin.php?op=lecture\";</script>";
		exit();
        }
		
         $query="update xy_lecture set lecture_title='$lecture_title',lecture_lecturer='$lecture_lecturer',lecture_auther_ID='$lecture_auther_ID',lecture_intro='$lecture_intro',lecture_place='$lecture_place',lecture_date='$lecture_date',lecture_note_url='$lecture_note_url',lecture_tag='$lecture_tag',lecture_conclusion='$lecture_conclusion' where lecture_ID='$lid'";
		                                                                                                 
         $info=mysql_query($query);

         if($info){ 
	         echo "<script language=\"javascript\">alert('修改成功');location.href=\"admin.php?op=m_lecture\";</script>";
		     exit();
         }else{
			 echo "<script language=\"javascript\">alert('修改不成功');location.href=\"admin.php?op=m_lecture\";</script>";
		     exit();
		 }
		  
	}elseif($op=="notice"){
		$notice_title=$_POST["notice_title"];
		$notice_content=$_POST["notice_content"];
		$notice_tag=$_POST["notice_tag"];
		$notice_date=strftime("%Y-%m-%d %H:%M:%S");
	
		if(!$notice_title||!$notice_content){
		echo "<script language=\"javascript\">alert('标题或内容未填');location.href=\"admin.php?op=notice\";</script>";
		exit();
        }
         $query="insert into xy_notice (notice_title,notice_content,notice_date,notice_auther_ID,notice_tag) values( '$notice_title','$notice_content','$notice_date','sunfengxi','$notice_tag')";
         $info=mysql_query($query);

         if($info){ 
	         echo "<script language=\"javascript\">alert('发布成功');location.href=\"admin.php?op=m_notice\";</script>";
		     exit();
         }else{
			 echo "<script language=\"javascript\">alert('发布不成功');location.href=\"admin.php?op=m_notice\";</script>";
		     exit();
		 }
		  	  
	}elseif($op=="lecture"){
		$lecture_title=$_POST["lecture_title"];
	    $lecture_date=$_POST["lecture_date"];
        $lecture_place=$_POST["lecture_place"];
        $lecture_lecturer=$_POST["lecture_lecturer"];
        $lecture_tag=$_POST["lecture_tag"];
        $lecture_note_url=$_POST["lecture_note_url"];
		$lecture_intro=$_POST["lecture_intro"];
		$lecture_conclusion=$_POST["lecture_conclusion"];
		$notice_date=strftime("%Y-%m-%d %H:%M:%S");
		
		 $action=$_GET["action"];
		if(!$lecture_title||!$lecture_intro){
		echo "<script language=\"javascript\">alert('标题或内容未填');location.href=\"admin.php?op=lecture\";</script>";
		exit();
        }
		if(!$lecture_place||!$lecture_date){
		echo "<script language=\"javascript\">alert('时间或地点未填');location.href=\"admin.php?op=lecture\";</script>";
		exit();
        }
         $query="insert into xy_lecture (lecture_title,lecture_lecturer,lecture_auther_ID,lecture_intro,lecture_place,lecture_date,lecture_note_url,lecture_tag,lecture_conclusion) values( '$lecture_title','$lecture_lecturer','','$lecture_intro','$lecture_place','$lecture_date','$lecture_note_url','$lecture_tag','$lecture_conclusion')";
         $info=mysql_query($query);
		 $query2="insert into xy_notice (notice_title,notice_content,notice_date,notice_auther_ID,notice_tag) values( '$lecture_title','$lecture_intro','$notice_date','sunfengxi','$lecture_tag')";
         $info2=mysql_query($query2);

         if($info&&$info2){ 
	         echo "<script language=\"javascript\">alert('发布成功');location.href=\"admin.php?op=m_lecture\";</script>";
		     exit();
         }else{
			 echo "<script language=\"javascript\">alert('发布不成功');location.href=\"admin.php?op=m_lecture\";</script>";
		     exit();
		 }
		
		
		
		  
		  
	}
 ?>
