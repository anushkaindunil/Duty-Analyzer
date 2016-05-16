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
<link href="UserReg.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="common.css">

</head>
<script type="text/javascript">
function project(){

}
</script>
<body>

<?php

session_start();
$proid=$_SESSION['pro_id'];
$pro_name=$_SESSION['pro_name'];
$link = mysql_connect('localhost', 'root', ''); 
if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
}

//connect to the database
mysql_select_db('ucsc'); 

	
$query1 = mysql_query("SELECT * FROM tasks WHERE pro_id='$proid' ");

$taskid="";
$pro="";
WHILE($rows = mysql_fetch_array($query1)){
    $taskid=$rows['task_id'];
}
$ids=substr( $taskid,-2);
$id_task=(int)$ids+1;
if ($id_task<10) {
	$pro=$proid."_T0".$id_task;
}else{
	$pro=$proid."_T".$id_task;
}

	?>
<div id="top_common">
<div id="arrow"><table><tr><td><a href="main_manager.php"><img src="img/h2.png"></a></td><td id="Header_topic">Add task to :  <?php echo  $proid." -".$pro_name;?></td><td align="right"><button><a href="logout.php">LOGOUT</a></button></td></tr></table></div>
</div>
<div>
	<ol class="breadcrumb">
    <li><a href="main_manager.php">Home</a></li>
    <li><a href="ProjReg.php">Project Register</a></li>
    <li class="active">Add Task</li>
           
  </ol>
<div id="task">
<table><form action="" method="POST">

		<tr><td ><input type="hidden" name="pro_id" value="<?php echo $proid;?>" /></td></tr>
		</table>
		<table>
		<tr  height="100px"><td ><div id="inter">
			<table><tr>
				<td>Task_ID:</td>
				<td><input  name="task_id" type="text" value="<?php echo $pro; ?>" readonly="readonly" /></td>
				<td>Task_Name:</td>
				<td><input name="task_name" type="text" id="tnameid" required/></td>
				<td>Define Time(Days):</td>
				<td ><input type="number" name="hours" value="00" min="01" id="timeid" onblur="checkValidTime();"></td>
				<td align="right"><input type="submit" name="ADD" value="ADD" /></td>
			</tr></table>

		</div></td></tr></form>
		</table>
</div>
<table><tr><td width="320px" align="center">Task ID</td><td width="320px" align="center">Task Name</td><td width="320px" align="center">Allocate Time(Days)</td></tr></table>
</div>
<?php
$query1=mysql_query("SELECT * FROM tasks WHERE pro_id='$proid'");
if(mysql_num_rows($query1)>0){
while($query2 = mysql_fetch_array($query1))
{
	$tsk= $query2['task_id'];
	$tsk_time=$query2['task_time']/8;
	?>

<table><form action="" method="POST"><tr><td><button title="add usres to task" name="submit" id="taskin" value="<?php echo $tsk;?>" ><table><tr><td width="400px" align="center"><?php echo $query2['task_id'];?></td><td width="400px" align="center"><?php echo $query2['task_name'];?></td><td width="400px" align="center"><?php echo $tsk_time;?></td></tr></table></button></td><td><button id="edit" name="tskEdit" value='<?php echo $query2['task_id'];?>' >EDIT</button></td><td><button id="delete" name="tskDelete" value='<?php echo $query2['task_id'];?>' onclick="return confirm('Are you sure?')" >DELETE</button></td></tr></form></table>
<hr>
<?php
}
}


if(isset($_POST['ADD'])){
	
	
	$task_id = mysql_real_escape_string($_POST['task_id']);
	$task_name  = mysql_real_escape_string($_POST['task_name']);
	$pro_id = mysql_real_escape_string($_POST['pro_id']);
	$time=$_POST['hours']*8;
	$set =$time.":00:00";
    $x = $set;
    //$y = strtotime($x);
    $task_time = $x;
	//$task_time  = mysql_escape_string($_POST['task_time']);

	mysql_query("INSERT INTO `tasks` (`pro_id`,`task_id`, `task_name`,`task_time`) VALUES ('$pro_id','$task_id','$task_name','$task_time')") or die(mysql_error());
	//header("location:Add_user.php");
	?>
    <script type="text/javascript">
		window.location.href="Add_user.php";
	</script>
	<?php
}


if (isset($_POST['submit'])) {
    $_SESSION['name']=$_POST['submit'];
	//header("location:U_add.php");
	?>
    <script type="text/javascript">
		window.location.href="U_add.php";
	</script>
	<?php
}

if (isset($_POST['tskDelete'])) {
	$tskDeleteId = $_POST['tskDelete'];
	$query3 = mysql_query("DELETE FROM tasks WHERE task_id='$tskDeleteId'");
	//header("location:Add_user.php");
	?>
    <script type="text/javascript">
		window.location.href="Add_user.php";
	</script>
	<?php
}

if (isset($_POST['tskEdit'])) {
	$_SESSION['tsk_id'] = $_POST['tskEdit'];
	//header("location:editTask.php");
	?>
    <script type="text/javascript">
		window.location.href="editTask.php";
	</script>
	<?php	
}


?>

</div>
</body>
</html>