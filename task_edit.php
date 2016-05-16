<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<link href="UserReg.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="common.css">


</head>

<body img src="img/h2.png">
<?php
$form =<<<EOT
<div id="top_common">
<div id="arrow"><table><tr><td><a href="ProjReg.php"><img src="img/h2.png"></a></td><td align="right"><button><a href="logout.php">LOGOUT</a></button></td></tr></table></div>
</div>
<div id="table">
<form action="UserReg.php" method="POST">

<table>

</form>
</div>

EOT;

echo $form;
session_start();
$pro_id=$_SESSION['pid'];

error_reporting(E_ALL);
	ini_set('display_errors', 'On');
	
	$servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "ucsc";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

$query1=$conn -> query("SELECT pro_id,task_id,task_name,task_time FROM tasks WHERE pro_id='$pro_id' ");

echo "<table border='1' style='width:100%'><tr><td bgcolor='silver'>Pro_ID</td><td bgcolor='silver'>Task ID</td><td bgcolor='silver'>Task Name</td><td bgcolor='silver'>Define Time</td><td bgcolor='silver'></td><td bgcolor='silver'></td>";
while($query2= $query1->fetch_array(MYSQLI_BOTH))
{
echo "<tr><td>".$query2['pro_id']."</td>";
echo "<td>".$query2['task_id']."</td>";
echo "<td>".$query2['task_name']."</td>";
echo "<td>".$query2['task_time']."</td>";


echo "<td><a href='edit.php?id=".$query2['pro_id']."'>Edit</a></td>";
echo "<td><a href='Delete.php?id=".$query2['pro_id']."'>Delete</a></td><tr>";
}
$conn->close();
?>
</ol>
</table>
</body>
</html>