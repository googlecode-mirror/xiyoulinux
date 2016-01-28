### 技术成员 ###

预计使用的技术：动态语言：php；数据库：mysql；表现技术ajax,html,css等

负责人：周永飞

参与者：李阳，孙建刚

### 项目周期 ###

三周

### 预期目标 ###

一、用例需求：

管理人员（administrator）：登录网站后台并且有权限的管理员对相册和照片进行管理维护

浏览权限：所有人

（1）administrator可以建立相关的相册：
> administrator的相册有一张照片作为封面，相册信息包括描述，建立日期，作者，标签等，照片的相关信息保存在数据库中
（2）administrator可以上传照片到相册：
> adminstrator可以上传图片到指定相册，照片压缩存储（administrator在上传照片时系统自行处理格式转换，节省存储空间），添加的信息如作者，照片描述，拍摄日期等均保存在数据库中
（3）游客（visitor）可以浏览照片：
> 照片首先使用相册中每张照片的缩略图展示出来，点击后展示原始图片，还包括照片描述等相关信息，可以对照片进行评论

二、数据库设计：

（1）记录相册相关信息的表

> xy\_album表记录相册信息，相关字段 album\_ID(相册ID), album\_name(相册名称), album\_cover(相册封面), album\_intro(相册介绍), album\_date(相册日期)

（2）记录照片相关信息的表

> xy\_photo表记录照片的信息，相关字段：photo\_ID(照片ID),photo\_album(照片相册),photo\_url(照片地址),photo\_thumb\_url(照片缩略图地址),photo\_intro(照片介绍),photo\_date(照片日期),photo\_tag(照片标签)

三、表现层设计：

（1）需要一个页面展示所有相册，封面有相关的图片，相册下显示一些相册的信息，描述，创建日期等

（2）需要一个页面展示该相册的所有照片的缩略图，每张照片下面有简短的相片描述。

（3）需要一个页面展示原始照片，包括照片的详细描述，作者，拍摄日期等

### 项目进度 ###

目前实现的功能：

  1. 激活插件的同时在数据库中生成wp\_xy\_album和wp\_xy\_photo表单

> 2.在/wp-content/下生成xy-album文件夹，用于存放上传的照片

> 3.照片上传前如果没有相册，会提醒新建相册，也可以直接新建相册

> 4.上传照片（目前只是支持单张照片的上传，批量上传在后面的版本中将会实现）

> 5.照片和相册信息分别保存在数据库wp\_xy\_album和wp\_xy\_photo表中

> (工作进度详细参考项目更新日志 http://code.google.com/p/xiyoulinux/source/browse/trunk/xy_album/doc/readme.txt 谢谢)

### 任务分配 ###

周永飞：相册管理系统（插件）后台管理部分

> 任务包括：

> 相册和文件：

> 新建相册：new gallery

> 上传照片: upload images

> 批量上传: .zip文件上传(upload Zip-File)

> 相册管理：

> 相册信息管理：title，description，author

> 照片信息管理：ID，缩略图，title，description

> （相册中的信息管理是选择数据库还是xml保存，数据库管理起来方便些）

李阳：相册管理系统（插件）前台部分

> 包括：

> 相册展示:每一个相册都有一个封面,有相册描述，作者等的相关信息，这些可以由相片的ID从数据库中读取，或者是其他的方式获取，比如xml

> 相片缩略图:相册中所有的照片首先按照缩略图的形式展现。

> 相片查看：(是选择flash还是一个的静态显示)

孙建刚：

> 测试，每次有一个发行版本，孙建刚负责测试后台前台的相关动作，找出bug及时发布，以便发行下一版本前及时更正

> 相关bug可能出现在各个角落，因此，请负责这块的务必细心。

> 另外，孙建刚有空多了解下wordpress的plugin的开发这块，因为这块我虽然看了一些，但是不是很熟悉，你可以自己先写一些无关紧要的插件熟悉这个的开发过程，记录下来，供我们学习。