<html>
<?php
$conn=new mysqli("localhost","root","","ucsc");
if($conn->connection_error){
    die("conecion error:".$conn->connection_error);
}
?>
<head>
<link rel="stylesheet" type="text/css" href="common.css">
<title>Display Record</title>
<link href="display_record.css" type="text/css" rel="stylesheet" />
<link href="u_view.css" type="text/css" rel="stylesheet" />
<link href="view.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="top_common">
<div id="arrow"><table><tr><td><a href="main_manager.php"><img src="img/h2.png"></a></td><td align="right"><button><a href="logout.php">LOGOUT</a></button></td></tr></table></div>
</div>	
    

<table >
<tr><td id="color"><label>First Name     :</label></td><td><label></label>  </td></tr>
<tr><td id="color"><label>Last Name      :</label></td><td> <label></label> </td></tr>
<tr><td id="color"><label>Email          :</label> </td><td><label></label></td></tr>
<tr><td id="color"><label>Date of Birth  :</label></td><td>
<label></label></td></tr>
<tr><td id="color"><label>Address        :</label> </td><td><label></label></td></tr>
<tr><td id="color"><label>Contact No     :</label> </td><td><label></label></td></tr>
</table> 
<div id="u_bottom">
<table><tr><td>Projects : </td><td><select name="owner"><?php 
   $sql="SELECT * FROM  WHERE " ;

$query1=$conn -> query("SELECT * FROM employee");
echo "<table border='1' style='width:100%'><tr><td bgcolor='silver'>empID</td><td bgcolor='silver'>CustomerName</td><td bgcolor='silver'>Address</td><td bgcolor='silver'>ContactNo</td><td bgcolor='silver'>E_mail</td><td bgcolor='silver'>Date</td><td bgcolor='silver'>Suggestions</td><td bgcolor='silver'>Complaints</td><td bgcolor='silver'></td><td bgcolor='silver'></td>";
while($query2= $query1->fetch_array(MYSQLI_BOTH))
{
echo "<tr><td>".$query2['CustomerID']."</td>";
echo "<td>".$query2['CustomerName']."</td>";
echo "<td>".$query2['Address']."</td>";
echo "<td>".$query2['ContactNo']."</td>";
echo "<td>".$query2['E_mail']."</td>";
echo "<td>".$query2['Date']."</td>";
echo "<td>".$query2['Suggestions']."</td>";
echo "<td>"$query2['Complaints']."</td>";
echo "<td><a href='edit.php?id=".$query2['CustomerID']."'>Edit</a></td>";
echo "<td><a href='Delete.php?id=".$query2['CustomerID']."'>Delete</a></td><tr>";
}
$conn->close();

?></select></td></tr></table>
</div>

<body>
</html>