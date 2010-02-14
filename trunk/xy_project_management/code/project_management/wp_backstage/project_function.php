<?php 
	function print_all_check()
	{
?>
		<select name="all">
			<option value="noaction" selected="selected">批量动作</option>
			<option value="remove">删除</option>
		</select>
		<input type="submit" value="应用" name="doaction" id="doaction" class="button-secondary action" />
<?php
	}
?>

<?php
	function print_project_column()
	{
?>		<th width=""><input type="checkbox" name="chkAll" value="" onClick="check(this.form)">&nbsp;项目</th>
		<th>管理者</th>
		<th>成员</th>
		<th>开始日期</th>
		<th>截止日期</th>
		<th>标签</th>
		<th>操作</th>
<?php 
	}
?>

<?php
	function project_rows($get)
	{
		global $wpdb;
		//每页显示的条数
		$page_size=10;
		
		//Page for current page
		if(isset($_GET['Page']))
		{
			$Page=intval($_GET['Page']);
		}
		else{$Page=1;}
		
		if($get=="")
		{
			$myrows = $wpdb->get_results("SELECT * FROM xy_project", ARRAY_A);
		}
		else
		{
			$myrows = $wpdb->get_results("SELECT * FROM xy_project where project_tag like '%$get%'", ARRAY_A); 
		}
		//总条数
		$amount = count($myrows);
		
		//计算总页数
		if($amount)
		{
			if($amount<$page_size)
	   			{$page_count=1;}
	        elseif($amount%$page_size)
	            {$page_count=(int)($amount/$page_size)+1;}
	  		else
				{$page_count=$amount/$page_size;}
		}
		else
		{$page_count=0;}
		
		//获取当前页的记录
		if($amount)
		{
		        $a=($Page-1)*$page_size;
				$b=$page_size;
				if($get=="")
				{
					$myrows = $wpdb->get_results("select * from xy_project order by project_id limit $a,$b",ARRAY_A);
				}
				else
				{
					$myrows = $wpdb->get_results("select * from xy_project where project_tag like '%$get%' order by project_id limit $a,$b",ARRAY_A);
				}
		}
		if($myrows=="")
		{
			echo"<tr><td colspan='3'>没有项目</td></tr>";
		}else{
			foreach ($myrows as $myrow) {
				echo "<tr>
						<td>"."&nbsp;<input type='checkbox' name='chk[]' id='chk' value=".$myrow['project_ID'].">&nbsp;".$myrow["project_name"]."</td>
						<td>".$myrow["project_manager"]."</td>
						<td>".$myrow["project_manager"]."</td>
						<td>".$myrow["project_start_date"]."</td>
						<td>".$myrow["project_finish_date"]."</td>
						<td>".$myrow["project_tag"]."</td>
						<td><a href='admin.php?page=project_edit&project_id=".$myrow["project_ID"]."'>编辑</a>|<a href='admin.php?page=project&action=remove&project_id=".$myrow["project_ID"]."'>删除</a></tr>";
			}
			echo "<tr><td colspan='2'>";
			if($Page>1)                         
            {
            	echo "<a href=admin.php?page=project&Page=1&tag=".$get.">首页</a>|<a href=admin.php?page=project&&Page=".($Page-1)."&tag=".$get.">上一页</a>|";
            }else{echo "首页|上一页|";}
  			if($Page<$page_count)
            {
            	echo"|<a href=admin.php?page=project&Page=".($Page+1)."&tag=".$get.">下一页</a>|<a href=admin.php?page=project&&Page=".($page_count)."&tag=".$get.">尾页</a>";
            }else{echo "|下一页|尾页";}
                         echo "<td colspan='2'>第".$Page."页/"."共有".$page_count."页";echo "共有".$amount."条记录</td>";
            echo "</td></tr>";
		}
	}
?>

<?php 
	function project_remove($project_id)
	{
		global $wpdb;
		$table_name = 'xy_project';
		
		$wpdb->query("DELETE FROM " . $table_name . " WHERE project_ID = $project_id");
		echo "<div id='message' class='updated fade'><p><strong>己删除</strong></p></div>";
	}
?>

<?php
	function project_check($post, $file)
	{
		//验证
		if(!checkdate($post['project_start_date']))
		{
			$post['project_start_date'] = date("Y-m-d");
		}
		if(!checkdate($post['project_finish_date']))
		{
			$post['project_finish_date'] = date("Y-m-d");
		}
		if(!is_numeric($post['project_auther_ID']))
		{
			$post['project_auther_ID'] = 0;
		}
		
		if($file["file"]["name"]!="")
		{
			$post['project_pic'] = "/project_images/".$file['file']['name'];
			if(file_exists('../wp-content/plugins/project_management/project_images/'.$file['file']['name']))
			{
				echo "this pic already in project_images!";
			}
			else
			{
				move_uploaded_file($file['file']['tmp_name'], '../wp-content/plugins/project_management/project_images/'.$file['file']['name']);
			}
		}
		
		$row = array('project_name' => $post['project_name'], 
					'project_manager' => $post['project_manager'],
					'project_member' => $post['project_member'],
					'project_start_date' => $post['project_start_date'],
					'project_finish_date' => $post['project_finish_date'],
					'project_intro' => $post['project_intro'],
					'project_pic' => $post['project_pic'],
					'project_doc' => $post['project_doc'],
					'project_url' => $post['project_url'],
					'project_auther_ID' => $post['project_auther_ID'],
					'project_tag' => $post['project_tag']
					);
		return $row;
	}
?>

<?php
	function project_edit($project_id, $post, $file)
	{
		global $wpdb;
		$table_name = 'xy_project';
		
		$row = project_check($post, $file);
		
		$wpdb->update($table_name, $row, array('project_ID' => $project_id));
		echo "<div id='message' class='updated fade'><p><strong>己修改</strong></p></div>";
	}
?>

<?php 
	function project_add($post, $file)
	{
		global $wpdb;
		$table_name = 'xy_project';
		
		$row = project_check($post, $file);

		$wpdb->insert("xy_project", $row);
		
		echo "<div id='message' class='updated fade'><p><strong>项目己添加</strong></p></div>";
	}
?>

<?php 
	function project_all($post)
	{
		global $wpdb;
		$table_name = 'xy_project';
		
		if($post["all"]=="remove")
		{
			foreach($post['chk'] as $row)
			{
				$wpdb->query("DELETE FROM " . $table_name. " WHERE project_ID = $row");
				echo "<div id='message' class='updated fade'><p><strong>项目己删除</strong></p></div>";			
			}
		}
	}
?>
