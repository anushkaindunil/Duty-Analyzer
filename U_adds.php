<html>
<?php
session_start();
$tid=$_SESSION['name'];
$task=$tid." "."task"

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

<link rel="stylesheet" type="text/css" href="common.css">
<title>Display Record</title>
<link href="display_record.css" type="text/css" rel="stylesheet" />
<link href="u_add.css" type="text/css" rel="stylesheet" />
</head>

<body>

<div id="top_common">
<div id="arrow"><table><tr><td><a href="project_manager.php"><img src="img/h2.png"></a></td><td id="Header_topic">Add Users to :  <?php echo  $task;?></td><td align="right"><button><a href="index.php">LOGOUT</a></button></td></tr></table></div>
</div>

<div id="all">   
<div id="pop">
  <table><tr><td><p><font size="5px">Position :</font></p></td><td><select name="users" onchange="showUser(this.value)"><option></option><option>Developer</option><option>Business Analyst (BA)</option><option>Quality Assuarance (QA)</option></select></td></tr></table>

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
<table><tr><td>Task ID</td><td>Employee ID</td><td>Employee Position</td></tr></table>
<?php 
mysql_connect ("localhost","root","");
mysql_select_db("ucsc");
$query1=mysql_query("SELECT * FROM task_allocation WHERE task_id='$tid' ");
if(mysql_num_rows($query1)>0){
while($query2 = mysql_fetch_array($query1))
{
    $tsk= $query2['task_id'];
    $emp= $query2['emp_id'];
  $query3=mysql_query("SELECT * FROM users WHERE id=$emp ");
  $row = mysql_fetch_array($query3);
  
    
    
    ?>
<form action=""method="POST">
<table><tr><td><?php echo $tsk;?></td><td><?php echo $emp;?></td><td><?php echo $row['position'];?></td><td></td><td><button id="delete" name="deleteAllocateEmployees" value='<?php echo $emp;?>' onclick="return confirm('Are you sure?')" >DELETE</button></td></tr></table></form>
<hr>
<?php
}
echo "<button id=\"subm\" name=\"subm\">Finish work</button>";
}
if(isset($_POST['subm'])){
    $pro= substr($tid, 0, 5);
    $query4=mysql_query("SELECT * FROM project WHERE pro_id='$pro' ");
  $rows = mysql_fetch_array($query4);
   $_SESSION['prname']=$rows['pr_name'];
  header('Location: finishpro.php'); 
    //echo $pro;
}
?>
</div>
<?php

if(isset($_POST['submit'])){//to run PHP script on submit
if(!empty($_POST['check_list'])){
// Loop to store and display values of individual checked checkbox.
    foreach($_POST['check_list'] as $selected){
        mysql_query("INSERT INTO `task_allocation` (`emp_id`, `pro_id`,`task_id`,`task_name`) VALUES ('$selected','0','$tid','0')") or die(mysql_error());
    }
}
header('Location: U_add.php');
}

if (isset($_POST['deleteAllocateEmployees'])) {

    $emp_Id = $_POST['deleteAllocateEmployees'];
    mysql_query("DELETE FROM task_allocation WHERE emp_id = '$emp_Id' AND task_id = '$tid'");
    header('Location: U_add.php');
}
?>

</body>
</html>