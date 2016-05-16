<html>
<?php
session_start();
$pro_name=$_SESSION['prname'];

$link = mysql_connect('localhost', 'root', ''); 

if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
}
//connect to the database
mysql_select_db('ucsc'); 

$query2 = mysql_query("SELECT pro_id FROM project WHERE pr_name='$pro_name'");
$rows2 = mysql_fetch_array($query2);
$proId= $rows2['pro_id'];


  

    $query3 = mysql_query("SELECT * FROM project WHERE pro_id ='$proId'");
    $rows3 = mysql_fetch_array($query3);
    if (isset($_POST['add_task'])) {
       $_SESSION['pro_id']=$rows3['pro_id'];
       header('location:Add_user.php');
    }

?>
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
<head>


<link rel="stylesheet" type="text/css" href="common.css">
<title>Display Record</title>
<link href="display_record.css" type="text/css" rel="stylesheet" />
<link href="u_add.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="top_common">
<div id="arrow"><table><tr><td><a href="project_view.php"><img src="img/h2.png"></a></td><td id="Header_topic">Details of Project :  <?php echo $pro_name;?></td><td align="right"><button><a href="logout.php">LOGOUT</a></button></td></tr></table></div>
</div>
<ol class="breadcrumb">
    <li><a href="main_manager.php">Home</a></li>
    <li><a href="ProjReg.php">Project Register</a></li>
    <li><a href="Add_user.php">Add Task</a></li>
    <li><a href="U_add.php">Add Users</a></li>
    <li class="active">Project Details</li>
           
  </ol>
<div id="mid"></div>
  <div id="hover">

<table >
<tr><td id="color"><label>Project Name       :</label></td><td><label><?php echo $rows3['pr_name']; ?></label>  </td></tr> 
<tr><td id="color"><label>Project Description:</label></td><td><label><?php echo $rows3['pr_description']; ?></label>  </td></tr>
<tr><td id="color"><label>Client Name        :</label></td><td> <label><?php echo $rows3['cl_fulname']; ?></label> </td></tr>
<tr><td id="color"><label>Client Contact     :</label> </td><td><label><?php echo $rows3['cl_contact']; ?></label></td> </tr>
<tr><td id="color"><label>Client Email       :</label> </td><td><label><?php echo $rows3['cl_mail']; ?></label></td> </tr>
<tr></tr>
<tr height="30px"></tr></table>
<table >
 <tr><td >Task ID</td><td>Task Name</td><td>Employee ID</td><td>Employee Name</td></tr> 

<?php
$query = mysql_query("SELECT * FROM tasks WHERE pro_id='$proId'");
while($row =mysql_fetch_array($query)) {
  $tid=$row['task_id'];
  $tid=trim($tid);
  $sql = mysql_query("SELECT * FROM task_allocation WHERE task_id='$tid'");
  while($row0 =mysql_fetch_array($sql)){
    $empid=$row0['emp_id'];
    $sql1 = mysql_query("SELECT * FROM users WHERE id='$empid'");
    $row1 =mysql_fetch_array($sql1);
  ?>

<tr><td ><?php echo $row['task_id']; ?></td><td><?php echo $row['task_name']; ?></td><td><?php echo $row0['emp_id']; ?></td><td><?php echo $row1['fname']."   ".$row1['lname']; ?></td></tr> 
<?php
}
}
echo "<tr height=\"20px\"></tr>";
echo "<tr><td><a href='editProjects.php?id=".$proId."'> <button class='AnuButton'>Edit</button></a></td>";
?>
 
</table>
  </div>  
  
<body>
</html>