<?php
session_start();
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

<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">

<link rel="stylesheet" type="text/css" href="common.css">
<title>Display Record</title>
<link href="display_record.css" type="text/css" rel="stylesheet" />
<link href="view.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="top_common">
<div id="arrow"><table><tr><td><a href="main_manager.php"><img src="img/h2.png"></a></td><td id="header_topic">Project Discription View</td><td align="right"><button><a href="index.php">LOGOUT</a></button></td></tr></table></div>
</div>
<ol class="breadcrumb">
    <li><a href="main_manager.php">Home</a></li>
    <li class="active">Project View</li>
           
  </ol>
<div id="sure">
<table>
<tr>
<td>Project Name</td><td>Client Name</td><td>Project Progress</td><td>Remaining Time</td>
</tr>
</table>
</div>	
<?php
//connect to the server
$link = mysql_connect('localhost', 'root', ''); 
if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
}

//connect to the database
mysql_select_db('ucsc'); 

$query = mysql_query("SELECT * FROM project");

        WHILE($rows = mysql_fetch_array($query)):
        
            $prname= $rows['pr_name'];//1111111111
            $clname=$rows['cl_fulname'];//2222222222

            $pro_id = $rows['pro_id'];
            $query2 = mysql_query("SELECT * FROM tasks WHERE pro_id = '$pro_id'");

            $total1 = 0;
            $total2 = 0;//ok333333333333333333
            while(@$rows2 = mysql_fetch_array($query2)){
                $total2 = $total2 + convertTOsecond($rows2['task_time']);

                $task_id = $rows2['task_id'];
                $query3 = mysql_query("SELECT * FROM task_allocation WHERE task_id = '$task_id'");

                while(@$rows3 = mysql_fetch_array($query3)){
                    $total1 = $total1 + convertTOsecond($rows3['finish_time']);//44444444
                }
            }
  
            $remainTime = remainingTime($total1, $total2);
            $proProgress = getProgressBar($total1, $total2);

        ?>
        
        <table id="sures">
        <tr><td ><form action="" method="POST"><button id='padd' name="submit" value="<?php echo $prname;?>"><table><tr><td><?php echo $prname;?></td><td><?php echo $clname;?></td><td><meter value=<?php echo $proProgress;?> min="0" max="100"></meter></td><td><?php echo $remainTime;?></td></tr></td></table></button></form>
      </td></tr>
       
        </table>
    	
        <?php

        endwhile;

if (isset($_POST['submit'])) {
    
    $_SESSION['name']=$_POST['submit'];
    ?>
<script type="text/javascript">
//alert("Login successfully");
window.location.href="p_view.php";
//window.open('team_leader.php');
</script>
<?php
}
?>


<body>
</html>