<?php header("Content-Type: text/html; charset=utf-8");?>
<div>
	<div class="stuffbox">
		<h3><label><?php echo "名称" ?></label></h3>
		<div class="inside">
			<input type="text" name="project_name" size="30" tabindex="1" value="<?php echo isset($row) ? esc_attr($row->project_name) : ''; ?>" id="link_project_name" />
			<p><?php 'Example: xiyoulinux web'; ?></p>
		</div>
	</div>
	
	<div class="stuffbox">
		<h3><label><?php echo "管理者" ?></label></h3>
		<div class="inside">
			<input type="text" name="project_manager" size="30" class="code" tabindex="1" value="<?php echo isset($row) ? esc_attr($row->project_manager) : ''; ?>" id="link_project_manager" />
		    <p><?php 'Example: Lucien xin'; ?></p>
		</div>
	</div>
	
	<div class="stuffbox">
		<h3><label><?php echo "成员" ?></label></h3>
		<div class="inside">
			<input type="text" name="project_member" size="30" tabindex="1" value="<?php echo isset($row) ? esc_attr($row->project_member) : ''; ?>" id="link_project_member" />
		    <p><?php 'Example: xinlong,weijianglong,liyang'; ?></p>
		</div>
	</div>
	
	<div class="stuffbox">
		<h3><label><?php echo "项目简介" ?></label></h3>
		<div class="inside">
			<input type="text" name="project_intro" size="30" tabindex="1" value="<?php echo isset($row) ? esc_attr($row->project_intro) : ''; ?>" id="link_project_intro" />
		    <p><?php 'Example: This is a web project with php&&mysql...'; ?></p>
		</div>
	</div>
	
	<div class="stuffbox">
		<h3><label><?php echo "项目图片" ?></label></h3>
		<div class="inside">
			<input type="file" name="file" size="30" style="width:300px;" tabindex="1" id="img" onChange="reflush()"/>
			<input type="hidden" name="project_pic" value="<?php echo isset($row) ? esc_attr($row->project_pic) : ''; ?>"/>
			<img id="photo" src="<?php echo isset($row) ? esc_attr($row->project_pic) : ''; ?>"/>
		</div>
	</div>
	
	<div class="stuffbox">
		<h3><label><?php echo "开始日期" ?></label></h3>
		<div class="inside">
			<input type="text" name="project_start_date" size="30" tabindex="1" value="<?php echo isset($row) ? esc_attr($row->project_start_date) : ''; ?>" id="link_project_start_date" />
		    <p><?php 'Example: 2010-1-1'; ?></p>
		</div>
	</div>
	
	<div class="stuffbox">
		<h3><label><?php echo "结束日期" ?></label></h3>
		<div class="inside">
			<input type="text" name="project_finish_date" size="30" tabindex="1" value="<?php echo isset($row) ? esc_attr($row->project_finish_date) : ''; ?>" id="link_project_finish_date" />
		    <p><?php 'Example: 2020-1-1'; ?></p>
		</div>
	</div>
	
	<div class="stuffbox">
		<h3><label><?php echo "项目文档" ?></label></h3>
		<div class="inside">
			<input type="text" name="project_doc" size="30" tabindex="1" value="<?php echo isset($row) ? esc_attr($row->project_doc) : ''; ?>" id="link_project_doc" />
		    <p><?php 'Example: <code>http://code.google.com/p/xiyoulinux/</code> &#8212; don&#8217;t forget the <code>http://</code>'; ?></p>
		</div>
	</div>
	
	<div class="stuffbox">
		<h3><label><?php echo "项目地址" ?></label></h3>
		<div class="inside">
			<input type="text" name="project_url" size="30" tabindex="1" value="<?php echo isset($row) ? esc_attr($row->project_url) : ''; ?>" id="link_project_url" />
		    <p><?php 'Example: <code>http://code.google.com/p/xiyoulinux/</code> &#8212; don&#8217;t forget the <code>http://</code>'; ?></p>
		</div>
	</div>
	
	<div class="stuffbox">
		<h3><label><?php echo "项目标签" ?></label></h3>
		<div class="inside">
			<input type="text" name="project_tag" size="30" tabindex="1" value="<?php echo isset($row) ? esc_attr($row->project_tag) : ''; ?>" id="link_project_tag" />
		    <p><?php 'Example: xiyoulinux'; ?></p>
		</div>
	</div>
	
	<div class="stuffbox">
		<h3><label><?php echo "项目创建者" ?></label></h3>
		<div class="inside">
			<input type="text" name="project_auther_ID" size="30" tabindex="1" value="<?php echo isset($row) ? esc_attr($row->project_auther_ID) : ''; ?>" id="link_project_auther_ID" />
		    <p><?php 'Example: Lucien xin'; ?></p>
		</div>
	</div>
	
	<div class="submit">
		<input type="submit" class="button-primary" name="submit" value="提交 " />
	</div>
</div>
