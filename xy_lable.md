# 标签库管理 #

## 【技术成员】 ##

> 负责人：宋飞

> 参与者：招募中

## 【项目周期】 ##

> 预计15天

## 【项目目标】 ##

  * 用户可以按照标签分类查看内容
  * 用户可以根据标签中的关键字搜素（这里使用AJAX技术，根据已经输入的内容同步列出候选标签）
  * 网站具有一个标签使用热度排行榜

## 【数据库设计】 ##

> 这个是典型的多对多关系，一个内容（公告、项目、相片）可以对应多个标签，一个标签也可以对应多个内容，所以采用三个表来存储。

  * 内容
  * 标签
  * 书签和标签的关系

> 但是同时兼顾到效率，在表格中缓存了一些数据，避免多表联合查询。

### 标签表 ###

> 这个表用来存储所有的标签，每个标签一条记录，记录这个标签被引用的次数。

> 在删除内容（公告、项目、相片等）的时候，如果标签的引用次数小于1，则删除这个标签。

> 字段内容：

|**字段名**|**类型**|**说明**|**备注**|
|:------|:-----|:-----|:-----|
|tag\_ID|bigint(20)|标签ID号 |主键 非空 唯一 自增|
|tag\_name|varchar(255)|标签名字  |唯一    |
|tag\_count|int(11)|标签被引用的次数|      |


> 生成表的语句：

```
CREATE TABLE `xy_tag` (
  `tag_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(255) DEFAULT NULL,
  `tag_count` int(11) DEFAULT '0',
  PRIMARY KEY (`tag_ID`)
) 
```

### 标签目标关系表 ###

|**字段名**|**类型**|**说明**|**备注**|
|:------|:-----|:-----|:-----|
|relation\_ID|bigint(20)|关系ID号 |主键 非空 唯一 自增|
|relation\_type|varchar(255)|说明目标关系类型|      |
|relation\_tag\_ID|bigint(20)|标签ID号 |      |
|relation\_target\_ID|bigint(20)|目标对象ID号|      |

> 生成表的语句：

```
CREATE TABLE `xy_tag_relation` (
  `relation_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `relation_type` varchar(255) DEFAULT NULL,
  `relation_tag_ID` bigint(20) unsigned DEFAULT NULL,
  `relation_target_ID` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`relation_ID`)
)
```