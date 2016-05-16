<!DOCTYPE html>
<html>
<head>
<link href="u_add.css" type="text/css" rel="stylesheet" />

</head>
<body>

<?php
session_start();
$tsk_id = $_SESSION['name'];

function convertTOsecond($myTime){//myTime = 05:30:00
    $a = (string)$myTime;
    $time_a = explode(":",$a);
    $sec_a =$time_a[0]*3600 + $time_a[1]*60 +$time_a[2];
    $ret_a = (double)$sec_a;
    return $ret_a;
}

function getProgressBar($smallTime, $LargeTime){

    if ($LargeTime>0 && ($smallTime <= $LargeTime)) {
        $perceTask1 = (($smallTime / $LargeTime) * 100).' %';
        $pro_perceTask1 = (double)$perceTask1;
        return round($pro_perceTask1, 2);
    }else{
        return 100;
    }
}

function remainingTime($smallTime ,$LargeTime){
    $y = $LargeTime - $smallTime;//5048
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


?>

<?php
$q = strval($_GET['q']);

if (!defined('SERVERNAME')) define('SERVERNAME', 'localhost');
    if (!defined('USERNAME')) define('USERNAME', 'root');
    if (!defined('PASSWORD')) define('PASSWORD', '');
    if (!defined('DBNAME')) define('DBNAME', 'ucsc');

    $con = new mysqli(SERVERNAME, USERNAME, PASSWORD, 'ucsc');
//$con =new mysqli_connect('localhost','rootr','','ucsc');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");
$sql0="SELECT * FROM task_allocation WHERE  task_id = '$tsk_id'";
$result0 = mysqli_query($con,$sql0);
$rowcount=mysqli_num_rows($result0);
$sql="SELECT * FROM users WHERE position = '$q'";
$result= mysqli_query($con,$sql);
echo "<table>";

while($row0 = mysqli_fetch_array($result)) {
   $path = $row0['profilePic'];
    ?>
    <tr><td><img src= <?php echo $path;?> width='50' height='50'/></td><td><?php echo $row0['fname'];?></td>
      <td><?php

        $sql2 = "SELECT * FROM task_allocation WHERE emp_id = '".$row0['id']."'";
        $result2 = mysqli_query($con,$sql2);
        
        $total1 = 0;
        $total2 = 0;//ok333333333333333333
        while(@$rows2 = mysqli_fetch_array($result2)){
            $total2 = $total2 + convertTOsecond($rows2['finish_time']);
            $total1 = $total1 + convertTOsecond($rows2['task_time']);
        }

        $x = getProgressBar($total2, $total1);

        ?><progress max='100' value=<?php echo $x;?> ></progress><?php
        echo '<br>'.$x;?>
      </td>
      <td><?php echo remainingTime($total2, $total1);?></td>

      <td><input type="checkbox" name="check_list[]" value=" <?php echo $row0['id'];?> "></form></td>
    </tr>
<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>
    <?php

}
echo "</table>";



mysqli_close($con);
?>



</body></html>