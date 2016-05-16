<?php

mysql_connect('localhost', 'root', '');

mysql_select_db('ucsc');

$sql = "SELECT * FROM project1";

$records = mysql_query($sql);
?>

<html>
<head>

<title>Display Record</title>
<link href="display_record.css" type="text/css" rel="stylesheet" />
</head>

<body>
	

<center>
<?php
	$str = "";
	while($employee = mysql_fetch_assoc($records)){
		
		
		
		echo "<div style='padding:20px;'><a class='btn' href='testPage.php?name=" . $employee['fname']. "'>" . $employee['fname'] . "</a></div>";
		
		
		
		$str = $employee;
		
	}// end while
	
?>
</center>
<body>
</html>