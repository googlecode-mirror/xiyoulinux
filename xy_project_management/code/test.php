<html>
	<head>
		<title>search all</title>
	</head>
	<body>
		<h2 align=center>
		Below is all data
		</h2>
		<?php
			$db = MySQL_connect("localhost", "root");
			MySQL_select_db("mysite", $db);
			$result = MySQL_qurey("select * from user", $db);
			
			echo "geshi"
			
			while ($myrow = MySQL_fetch_row($result))
			{
				print "data"
			}
			
			echo "</table>\n";
		?>
	</body>
</html>
