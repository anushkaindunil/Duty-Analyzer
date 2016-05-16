<?php

session_start();
$id = $_SESSION['tsk_id'];

$conn = mysql_connect('localhost', 'root', ''); 
mysql_select_db('ucsc');
$sql = mysql_query("SELECT * FROM tasks WHERE task_id='$id'");
$query2 = mysql_fetch_array($sql);

$cc = $query2['task_time'].'<br>';
$cc = (integer)$cc;

?>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <link href="UserReg.css" type="text/css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="common.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

</head>
<body>
  <?php
$form =<<<EOT
<div id="top_common">
<div id="arrow"><table><tr><td><a href="main_manager.php"><img src="img/h2.png"></a></td><td align="right"><button><a href="index.php">LOGOUT</a></button></td></tr></table></div>
</div>
<div id="table">
<form action="UserReg.php" method="POST">
<table>
</form>
</div>
EOT;
echo $form;
?>

  <form name="Update project" role="form" align = "left" method="post" action="">
    <legend><font face="Times New Romans"><h3>Update Task Details</h3></font></legend>

    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <div class="form-group" align = "left">
                          <div class="form-group" align = "left">
    <label for="inputId" class="col-md-3 control-label">
                                Task ID
         </label> <div class="col-md-6">
                                <input type="inputId" class="form-control" name = "id" value="<?php echo $query2['task_id']; ?>" readonly="readonly"/>
                    </div><div class="col-md-3"></div>
         </div>

<br><br><br>

    <div class="form-group" align = "left">
      <label for="inputName" class="col-md-3 control-label">
                                Task Name
         </label> <div class="col-md-6">
                                <input type="inputName" class="form-control" id="inputName" name = "task_name" value="<?php echo $query2['task_name']; ?>"/>
                    </div><div class="col-md-3" id="pnameid"></div>
         </div>
         <br><br>

         <div class="form-group" align = "left">
      <label for="inputName" class="col-md-3 control-label">
                                Task Time
         </label> <div class="col-md-6">
                                <input type="number" min='01' class="form-control" id="inputName" name = "task_time" value="<?php echo $cc; ?>" />
                    </div><div class="col-md-3"></div>
         </div>
         <br><br><br>

    <div class="form-group" align = "right">
            <div class="col-sm-offset-2 col-sm-10">

    <button  class="btn btn-primary btn-md" name="tskUpdate">Update</button>
    </div>
        </div>
  </form>

  <?php
    if (isset($_POST['tskUpdate'])) {

      $task_name = $_POST['task_name'];
      $set = $_POST['task_time'].":00:00";
      $x = (string)$set;
      //$y = strtotime($x);
      $task_time = $x;

      mysql_query("UPDATE tasks SET  task_name='$task_name',task_time='$task_time'  WHERE task_id='$id'");
      header("location:Add_user.php");
      
    }
  ?>
  </body>
  </html>