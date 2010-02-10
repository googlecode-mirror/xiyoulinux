<?php

$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

//这块得改数据库的名字
mysql_select_db("xy_zhou", $con);

$result = mysql_query("SELECT * FROM wp_xy_json");

while($row = mysql_fetch_array($result))
  {
  echo $row['album_json'];
  echo "<br />";
  }

mysql_close($con);

?>

