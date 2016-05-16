<?php
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
<!DOCTYPE html>
<html>
<head>
<link href="u_add.css" type="text/css" rel="stylesheet" />
<link href="view.css" type="text/css" rel="stylesheet" />

</head>
<body>
<?php
$q = strval($_GET['q']);
if (!defined('SERVERNAME')) define('SERVERNAME', 'localhost');
    if (!defined('USERNAME')) define('USERNAME', 'root');
    if (!defined('PASSWORD')) define('PASSWORD', '');
    if (!defined('DBNAME')) define('DBNAME', 'ucsc');

    $con = new mysqli(SERVERNAME, USERNAME, PASSWORD, 'ucsc');

if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");

$q=trim($q);
$sqll="SELECT * FROM tasks WHERE task_name ='".$q."'";
$resultt = mysqli_query($con,$sqll);
$roww = mysqli_fetch_array($resultt);
$tsk_ID=$roww['task_id'];

$sql="SELECT * FROM users INNER JOIN task_allocation ON users.id=task_allocation.emp_id WHERE task_allocation.task_id='$tsk_ID'";
$result = mysqli_query($con,$sql);

echo "<table>";
while($row = mysqli_fetch_array($result)) {
    $name = $row['fname'];
    $pos = $row['position'];
    $finishTime = convertTOsecond($row['finish_time']);
    $taskTime = convertTOsecond($row['task_time']); 
    $remainTime = remainingTime($finishTime, $taskTime);
    $proProgress = getProgressBar($finishTime, $taskTime);  

    echo "<tr bgcolor='#e9e9e2' height='45'>";
    echo "<td>".$name."</td>";
    echo "<td>".$pos."</td>";
    echo "<td align='center'><progress value='$proProgress' min='0' max='100'></progress></td>";
    echo "<td><center>".$remainTime."</center></td>";
       
}
echo "<br>";
echo "</table>";
//mysqli_close($con);
?>
</body></html>