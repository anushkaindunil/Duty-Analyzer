<?php
session_start();
$fname = $_SESSION["fname"];
$id= $_SESSION['id'];

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="common.css">
<title>Display Record</title>
<link href="display_record.css" type="text/css" rel="stylesheet" />
<link href="view.css" type="text/css" rel="stylesheet" />
</head>

<script language="JavaScript">

$(document).ready(function(){
    $("#p1").click(function(){
        $("#p1").css("background-color", "white");
        $("#p2").css("background-color", "#00cccc");
        $("#p3").css("background-color", "#00cccc");
    });
});
$(document).ready(function(){
    $("#p2").click(function(){
        $("#p1").css("background-color", "#00cccc");
        $("#p2").css("background-color", "white");
        $("#p3").css("background-color", "#00cccc");
    });
});
$(document).ready(function(){
    $("#p3").click(function(){
        $("#p1").css("background-color", "#00cccc");
        $("#p2").css("background-color", "#00cccc");
        $("#p3").css("background-color", "white");
    });
});

function setVisibility(id, visibility) {
    document.getElementById(id).style.display = visibility;
}

var clsStopwatch = function () {

var startAt = 0;
var lapTime = 0;

var now = function () {
    return (new Date()).getTime();
};

this.start = function () {
    startAt = startAt ? startAt : now();
};

this.stop = function () {
    lapTime = startAt ? lapTime + now() - startAt : lapTime;
    startAt = 0;
};

this.time = function () {
    return lapTime + (startAt ? now() - startAt : 0);
};
};

var x = new clsStopwatch();
var $time;
var clocktimer;

function pad(num, size){
var s = "0000" + num;
return s.substr(s.length - size);
}

function formatTime(time) {
var h = m = s = ms = 0;
var newTime = '';

m = Math.floor(time / (60 * 1000));
time = time % (60 * 1000);
s = Math.floor(time / 1000);
ms = time % 1000;

newTime = pad(h, 2) + ':' + pad(m, 2) + ':' + pad(s, 2);
return newTime;
}

function show() {
$time = document.getElementById('time');
update();
}

function update() {
$time.innerHTML = formatTime(x.time());
}

function start() {
clocktimer = setInterval("update()", 1);
x.start();
}

function stop() {
x.stop();
document.getElementById('counter').value = formatTime(x.time());
clearInterval(clocktimer);

}
</script>

<body onload="show();">

<div>
<div id="top_common">
<div id="arrow"><table><tr><td><a href="main_manager.php"><img src="img/h2.png"></a></td><td id="header_topic" align="left"><p id="pos"><font color="white" size="4"><?php echo " HI ".$_SESSION["fname"]." "; ?></font></p></td><td align="right"><button><a href="logout.php">LOGOUT</a></button></td></tr></table></div>
</div>  
<div id="head">
        <table >
            <tr></tr>               
        </table>
    </div>  
<div id="arrows"><td><button id="p1" onclick="setVisibility('layer1', 'inline');setVisibility('layer2', 'none');setVisibility('layer3', 'none');setColor(this);">CURRENT WORKLOAD</button></td><td><button id="p2" onclick="setVisibility('layer1', 'none');setVisibility('layer2', 'inline');setVisibility('layer3', 'none');setColor(this);">PROFILE</button></td><td><button id="p3" onclick="setVisibility('layer1', 'none');setVisibility('layer2', 'none');setVisibility('layer3', 'inline');setColor(this);">COMPLETE WORKLOAD</button></td></div>
</div>


<div id="layer2">
  <?php
  $link = mysql_connect('localhost', 'root', ''); 
if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
}

//connect to the database
mysql_select_db('ucsc'); 


$query = mysql_query("SELECT * FROM users WHERE id = '$id'");

//fetch the results / convert results into an array

    WHILE($row = mysql_fetch_array($query)){
      $name = $row["fname"];
      $lname = $row["lname"];
      $email = $row["email"];
      $dob = $row["dateOFbirth"];
      $address = $row["address"];
      $contact = $row["contact"];
      $path = $row['profilePic'];
      $position = $row['position'];
    }
  ?> 
  <table >
    <tr height="40px"></tr>
<tr><td id="color"><label>Profile Picture     :</label></td><td><label><img src= <?php echo $path;?> width='150' height='150'/></label>  </td></tr> 
<tr><td id="color"><label>First Name     :</label></td><td><label><?php echo $name; ?></label>  </td></tr>
<tr><td id="color"><label>Last Name      :</label></td><td> <label><?php echo $lname; ?></label> </td></tr>
<tr><td id="color"><label>Email          :</label> </td><td><label><?php echo $email; ?></label></td> 

</tr>
<tr><td id="color"><label>Date of Birth  :</label></td><td>
<label><?php echo $dob; ?></label></td></tr>
<tr><td id="color"><label>Address        :</label> </td><td><label><?php echo $address; ?></label></td></tr>
<tr><td id="color"><label>Contact No     :</label> </td><td><label><?php echo $contact; ?>
</label></td></tr>
<tr height="30px"></tr>
<?php
echo "<tr><td><a href='pro_edit.php?id=".$id."'><img src='img/btnEdit.png' width='80' height='25'/></a></td>";

?>
</table>  
</div>
<div id="layer1">
<div id="sure">
<table>
<tr>
<td>Project Name</td><td>Task Name</td><td>Task Progress</td><td>Remaining Time</td>
</tr>
</table>
</div>
<div id="hidden">
<?php

$id = $_SESSION['id'];//218
$query = mysql_query("SELECT * FROM task_allocation WHERE emp_id = '$id'");
$buttonValueToArray = array();
$i = 0;
//fetch the results / convert results into an array
        
        WHILE($rows = mysql_fetch_array($query)):

            $task_time = convertTOsecond($rows['task_time']);
            $finish_time = convertTOsecond($rows['finish_time']);

            if($finish_time < $task_time){

                $task_id= $rows['task_id'];   
                //==============================
                $query3 = mysql_query("SELECT * FROM tasks WHERE task_id = '$task_id'");
                $rows3 = mysql_fetch_array($query3);
                $prID = $rows3['pro_id'];
                $tskName = $rows3['task_name'];
                $query1 = mysql_query("SELECT * FROM project WHERE pro_id = '$prID'");
                $rows4 = mysql_fetch_array($query1);
                $proName= $rows4['pr_name'];

                //=============================
              
                $x = getProgressBar($finish_time, $task_time);
                $y = remainingTime($finish_time, $task_time);
                $buttonValueToArray[$i] = $prID;
                $buttonValueToArray[$i+1] = $task_id;
            
        ?>
        
        <table id="sures">
        <tr><td ><form method="post"><button name='btntask' id='padd' title="Click to start Stop watch for task"   value="<?php echo $i;?>"><table>
            <tr><td><?php echo $proName;?></td><td><?php echo $tskName;?></td><td> 
                <meter value=<?php echo $x;?> min="0" max="100"></meter></td>
                <td><?php echo $y;?></td></tr></td></table></button></form>
      </td>
  </tr>      
        </table>
        
        <?php
        $i = $i + 2;
        }
        endwhile;


?>
</div>

<div id="layer">
<div id="inter_layer" align="center">
<?php 
if(isset($_POST['btntask'])){

        ?>
        <script type="text/javascript">
        setVisibility('hidden', 'none');
        setVisibility('layer', 'inline');
        </script>
        
        <?php
        $tt = $_POST['btntask'];   
    }
?>
<form action="highscore2.php" method="post"/>

    Project id:<label><?php $_SESSION['project_id']= @$buttonValueToArray[$tt]; echo @$buttonValueToArray[$tt];?></label></br>
    Task id:<label><?php $_SESSION['task_id']= @$buttonValueToArray[$tt+1]; echo @$buttonValueToArray[$tt+1];?></label></br>
    Time:<span id="time"></span><br/>

    <input type="button" value="start" onclick="start();">
    <input type="button" value="stop" onclick="stop();">
    <input type="submit" name="submit" value="Submit" >
    <input type="hidden" value="" id="counter" name="counter" /><!--get counter of stpwtc!-->
    <br/><br/>
</form>
</div>
</div>
 </div>
 <div id="layer3"> 
  <table border = 1>
  <tr>
    <td width="200px">Project Name</td>
    <td width="200px">Task Name</td>
    <td width="200px">Client Name</td>
  </tr>
  <?php
$query6 = mysql_query("SELECT * FROM task_allocation WHERE emp_id = '$id'");

while(@$row6 = mysql_fetch_array($query6)){

    $task_time = convertTOsecond($row6['task_time']);
    $finish_time = convertTOsecond($row6['finish_time']);
    $task_id= $row6['task_id'];   

    //==============================
    $query7 = mysql_query("SELECT * FROM tasks WHERE task_id = '$task_id'");
    $rows7 = mysql_fetch_array($query7);
    $prID = $rows7['pro_id'];
    $tskName = $rows7['task_name'];
    $query8 = mysql_query("SELECT * FROM project WHERE pro_id = '$prID'");
    $rows9 = mysql_fetch_array($query8);
    $proName= $rows9['pr_name'];
    $clientName = $rows9['cl_fulname'];

    if ($finish_time >= $task_time) {
        echo '<tr id="padd" width="900px">';
        echo '<td>'.$proName.'</td>';
        echo '<td>'.$tskName.'</td>';
        echo '<td>'.$clientName.'</td>';                    
        echo '</tr>';    
    }
}   
?>
</table>
 </div>
</body>
</html>