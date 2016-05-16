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
	    die("Connection failed: ". $conn->connect_error);
	}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	
	$id=$_GET['id'];
}

$sql="DELETE FROM users WHERE id ='$id'";

if ($conn->query($sql) === TRUE) {
	    header("location:user_view.php");

}

?>







	 
	
			

		

	
