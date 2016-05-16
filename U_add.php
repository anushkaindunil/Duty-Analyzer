<html>
<?php
session_start();
$tid=$_SESSION['name'];
$task=$tid." "."task";
$_SESSION['name']=$tid;
?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("add_bottom").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("add_bottom").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","getuser.php?q="+str,true);
        xmlhttp.send();
    }
}
/////
$(document).ready(function(){
    $("#submited").click(function(){
        $("#all").toggle(900);
    });
});

</script>
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
<link href="u_add.css" type="text/css" rel="stylesheet" />
</head>

<body>

<div id="top_common">
<div id="arrow"><table><tr><td><a href="ProjReg.php"><img src="img/h2.png"></a></td><td id="Header_topic">Add Users to :  <?php echo  $task;?></td><td align="right"><button><a href="logout.php">LOGOUT</a></button></td></tr></table></div>
</div>
<ol class="breadcrumb">
    <li><a href="main_manager.php">Home</a></li>
    <li><a href="ProjReg.php">Project Register</a></li>
    <li><a href="Add_user.php">Add Task</a></li>
    <li class="active">Add Users</li>
           
  </ol>
<div id="all">   
<div id="pop">
  <table><tr><td><p><font size="5px">Position :</font></p></td><td><select name="users" onchange="showUser(this.value)"><option></option><option>Project Manager</option><option>Developer</option><option>Business Analyst (BA)</option><option>Quality Assuarance (QA)</option></select></td></tr></table>

</div>
<table><tr><td>Image</td><td>Name</td><td>Progress</td><td>Time Remaining</td><td>Assigned</td></tr></table>
<form action=""method="POST">
<div id="l_one">
<div id="add_bottom">


</div>
</div>
</div>
<input type="submit" name="submit" value="submit" id="submit"/></form>

<button id="submited">show/hide Task</button><form action="" method="POST">



<div id="hidde">
<table><tr><td>Task ID</td><td>Employee Name</td><td>Employee Position</td></tr></table>
<hr>
<?php 
function taskTime($y){
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

mysql_connect ("localhost","root","");
mysql_select_db("ucsc");
$query1=mysql_query("SELECT * FROM task_allocation WHERE task_id='$tid' ");
if(mysql_num_rows($query1)>0){
while($query2 = mysql_fetch_array($query1))
{
    $tsk= $query2['task_id'];
    $emp= $query2['emp_id'];
    $emps=trim($emp);
    $query3=mysql_query("SELECT * FROM users WHERE id='$emps'");
    $row = mysql_fetch_array($query3);
    $fname=$row['fname'];
    $lname=$row['lname'];
    $position=$row['position'];
    
    ?>
<form action=""method="POST">
<table><tr><td><?php echo $tsk;?></td><td><?php echo $fname." ".$lname ;?></td><td><?php echo $position;?></td><td></td><td><button id="delete" name="deleteAllocateEmployees" value='<?php echo $emp;?>' onclick="return confirm('Are you sure?')" >DELETE</button></td></tr></table></form>
<hr>
<?php
}
echo "<button id=\"subm\" name=\"subm\">Finish work</button>";
}
if(isset($_POST['subm'])){
   $pro= substr($tid, 0, 5);
    $query4=mysql_query("SELECT * FROM project WHERE pro_id='$pro' ");
    $query5=mysql_query("SELECT * FROM task_allocation WHERE task_id='$tid' ");
    $query6=mysql_query("SELECT * FROM tasks WHERE task_id='$tid' ");
    $rows5 = mysql_fetch_array($query5);
    $rows6 = mysql_fetch_array($query6);
    $num_rows=mysql_num_rows($query5);
    $allocate_tm=$rows6['task_time']*3600;
    $allocate=$allocate_tm/$num_rows;
    $allocate_time=taskTime($allocate);
    //echo $allocate_time;

    $query7=mysql_query("UPDATE task_allocation SET task_time='$allocate_time' WHERE task_id='$tid' ");
    
  $rows = mysql_fetch_array($query4);
   $_SESSION['prname']=$rows['pr_name'];
   ?>
<script type="text/javascript">

window.location.href="finishpro.php";
//window.open('index.php');
</script>
<?php
  
    //echo $pro;
}
?>
</div>
<?php

if(isset($_POST['submit'])){//to run PHP script on submit
if(!empty($_POST['check_list'])){
// Loop to store and display values of individual checked checkbox.
    foreach($_POST['check_list'] as $select){
        $tid=trim($tid);
        $selected=trim($select);
        mysql_query("INSERT INTO `task_allocation` (`task_id`,`emp_id`,`task_time`, `finish_time`) VALUES ('$tid','$selected','0','0')") or die(mysql_error());
    }
}
?>
<script type="text/javascript">

window.location.href="U_add.php";
//window.open('index.php');
</script>
<?php
}

if (isset($_POST['deleteAllocateEmployees'])) {

    $emp_Id = $_POST['deleteAllocateEmployees'];
    mysql_query("DELETE FROM task_allocation WHERE emp_id = '$emp_Id' AND task_id = '$tid'");
    ?>
<script type="text/javascript">

window.location.href="U_add.php";
//window.open('index.php');
</script>
<?php

}
?>

</body>
</html>