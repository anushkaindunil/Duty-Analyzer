<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<link href="UserReg.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="common.css">


</head>

<body>
<?php
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

$query1=$conn -> query("SELECT id,fname,lname,uname,email,gender,position,dateOFbirth,address,contact FROM users");
echo "<table border='1' style='width:100%'><tr><td bgcolor='silver'>UserID</td><td bgcolor='silver'>FName</td><td bgcolor='silver'>LName</td><td bgcolor='silver'>UName</td><td bgcolor='silver'>E_mail</td><td bgcolor='silver'>Gender</td><td bgcolor='silver'>Position</td><td bgcolor='silver'>DateOfBirth</td><td bgcolor='silver'>Address</td><td bgcolor='silver'>ContactNo</td><td bgcolor='silver'></td><td bgcolor='silver'></td>";
while($query2= $query1->fetch_array(MYSQLI_BOTH))
{
echo "<tr><td>".$query2['id']."</td>";
echo "<td>".$query2['fname']."</td>";
echo "<td>".$query2['lname']."</td>";
echo "<td>".$query2['uname']."</td>";
echo "<td>".$query2['email']."</td>";
echo "<td>".$query2['gender']."</td>";
echo "<td>".$query2['position']."</td>";
echo "<td>".$query2['dateOFbirth']."</td>";
echo "<td>".$query2['address']."</td>";
echo "<td>".$query2['contact']."</td>";

echo "<td><a href='edit.php?id=".$query2['id']."'>Edit</a></td>";
echo "<td><a href='Delete.php?id=".$query2['id']."'>Delete</a></td><tr>";
}
$conn->close();
?>
</ol>
</table>
</body>
</html>