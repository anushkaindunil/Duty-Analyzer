<?php

function convertTOsecond($myTime){//myTime = 05:30:00
    $a = (string)$myTime;
    $time_a = explode(":",$a);
    $sec_a =$time_a[0]*3600 + $time_a[1]*60 +$time_a[2];
    $ret_a = (double)$sec_a;
    return $ret_a;
}
function secondToHourFormat($y){
    //$y = $LargeTime - $smallTime;//5048
    if($y >0){
        $H = (int)($y / 3600);
        $remMIN = $y - ($H * 3600);
        $M = (int)($remMIN / 60);
        $S = $remMIN - ($M * 60);
        return ($H.":".date('s',$M).":".date('s',$S));
    }else{
        return ("00:00:00");  
    }
}
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
$emp_id = $_SESSION['id'];

if(isset($_POST['submit'])){
	$sql = "SELECT finish_time FROM task_allocation WHERE emp_id='$emp_id' and task_id='$ti'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
	        $x = convertTOsecond($row["finish_time"]);//db value
	        $y = convertTOsecond($_POST['counter']);
	        $time = $x + $y;

	        $time1 = secondToHourFormat($time);
	        $sql2 = "UPDATE task_allocation SET finish_time ='$time1' WHERE emp_id='$emp_id' and task_id='$ti'";
			mysqli_query($conn, $sql2); 
	    }
	} else {
	    echo "0 results";
	}
}

?>
<script type="text/javascript">
    window.location.href="Developer.php";
</script>