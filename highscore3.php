
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ucsc";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$pi = $_SESSION['project_id'];
$ti = $_SESSION['task_id'];

if(isset($_POST['submit'])){
	$sql = "SELECT finish_time FROM tasks WHERE pro_id='$pi' and task_id='$ti'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
	        $x = $row["finish_time"];
	        $time1 = strtotime($x) + strtotime($_POST['counter']) - strtotime('00:00:00');
	        $time1 = date('H:i:s',$time1);
	        $sql2 = "UPDATE tasks SET finish_time ='$time1' WHERE pro_id='$pi' and task_id='$ti'";
			mysqli_query($conn, $sql2); 
	    }
	} else {
	    echo "0 results";
	}
}

?>
<script type="text/javascript">
    window.location.href="progress.php";
</script>