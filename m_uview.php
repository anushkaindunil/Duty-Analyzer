<!DOCTYPE html>
<html>
<head>
<link href="view.css" type="text/css" rel="stylesheet" />

</head>
<body>
<?php
$r= strval($_GET['r']);
if (!defined('SERVERNAME')) define('SERVERNAME', 'localhost');
    if (!defined('USERNAME')) define('USERNAME', 'root');
    if (!defined('PASSWORD')) define('PASSWORD', '');
    if (!defined('DBNAME')) define('DBNAME', 'ucsc');

    $con = new mysqli(SERVERNAME, USERNAME, PASSWORD, 'ucsc');

if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");
$sql = "SELECT * FROM users WHERE fname = '".$r."'";

$result = mysqli_query($con,$sql);
$lname = $email = $dob = $address = $contact = $id = "";

 while($row = mysqli_fetch_array($result)) {
      $id = $row["id"];
      $name = $row["fname"];
      $lname = $row["lname"];
      $email = $row["email"];
      $dob = $row["dateOFbirth"];
      $address = $row["address"];
      $contact = $row["contact"];
      $path = $row['profilePic'];
       $position=$row['position'];
    }

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
<table >
<tr><td id="color"><label>Profile Picture     :</label></td><td><label><img src= <?php echo $path;?> width='80' height='80'/></label>  </td></tr> 
<tr><td id="color"><label>First Name     :</label></td><td><label><?php echo $name; ?></label>  </td></tr>
<tr><td id="color"><label>Last Name      :</label></td><td> <label><?php echo $lname; ?></label> </td></tr>
<tr><td id="color"><label>Email          :</label> </td><td><label><?php echo $email; ?></label></td> 

</tr>
<tr><td id="color"><label>Date of Birth  :</label></td><td>
<label><?php echo $dob; ?></label></td></tr>
<tr><td id="color"><label>Address        :</label> </td><td><label><?php echo $address; ?></label></td></tr>
<tr><td id="color"><label>Contact No     :</label> </td><td><label><?php echo $contact; ?>
</label></td></tr>
<?php
  echo "<tr><td><a href='edits.php?id=".$id."'><button class='AnuButton'>Edit</button></a></td>";
?>
</table> 
<?php
if ($position=="Business Analyst (BA)" OR $position=="Quality Assuarance (QA)" ) {

} else {
  ?>
    
    <table border = 1>
  <tr>
    <td width="200px">Project Name</td>
    <td width="200px">Task Name</td>
    <td width="200px">Progress</td>
    <td width="200px">Percentage % </td>
    <td width="200px">Remaining Time</td>
  </tr>

<?php
$sql2 = "SELECT * FROM task_allocation WHERE emp_id = '$id'";
$result2 = mysqli_query($con,$sql2);

while($row2 = mysqli_fetch_array($result2)){
  $task_id = $row2['task_id'];//task id from task_allocation table
  $finish_time = convertTOsecond($row2['finish_time']); //employee finish time from task_allocation table
  $task_time = convertTOsecond($row2['task_time']);//employee task time from task_allocation table

  $sql3 = "SELECT * FROM tasks WHERE task_id = '$task_id'";
  $result3 = mysqli_query($con,$sql3);
  @$row3 = mysqli_fetch_array($result3);

  $pro_id = $row3['pro_id'];// from tasks table
  $task_name = $row3['task_name'];// from tasks table

  $sql4 = "SELECT * FROM project WHERE pro_id = '$pro_id'";
  $result4 = mysqli_query($con,$sql4);
  @$row4 = mysqli_fetch_array($result4);

  $pr_name = $row4['pr_name']; //from project table

  $x = getProgressBar($finish_time, $task_time);
  $y = remainingTime($finish_time, $task_time);

  echo '<tr id="padd" width="900px">';
  echo '<td>'.$pr_name.'</td>';
  echo '<td>'.$task_name.'</td>';//ok
  echo '<td>';
    ?><progress max='100' value=<?php echo $x;?> ></progress><?php
  echo '</td>';
  echo '<td>'.$x.'</td>';                 //ok
  echo '<td>'.$y.'</td>';         //ok
  echo '</tr>';

}   
?>
</table>
<?php
}
mysqli_close($con);
?>
</body>
</html>