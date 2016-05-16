<?php
error_reporting(E_ALL);
	ini_set('display_errors', 'On');
  $conn = @mysql_connect('localhost', 'root', ''); 

  mysql_select_db('ucsc'); 

if($_SERVER['REQUEST_METHOD'] == 'GET'){
  $id=$_GET['id'];
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{

  $id = $_POST['id'];
  $pr_name = $_POST['pr_name'];
  $pr_description = $_POST['pr_description'];
  $cl_fulname = $_POST['cl_fulname'];
  $cl_contact = $_POST['cl_contact'];
  $cl_mail = $_POST['cl_mail'];
  $start_date = $_POST['start_date'];
  $finished_date = $_POST['finished_date'];


  $sql="UPDATE project 
  SET  pro_id='$id', pr_name='$pr_name', pr_description='$pr_description',cl_fulname='$cl_fulname',cl_contact='$cl_contact', cl_mail= '$cl_mail',start_date='$start_date',finished_date='$finished_date' WHERE pro_id='$id'";

  if (mysql_query($sql) === TRUE) {
    ?>
    <script type="text/javascript">
    alert("UPDATE successfully");
    window.location.href="finishpro.php";
  </script>
  <?php
       
  }
}

$sql = mysql_query("SELECT * FROM project WHERE pro_id='$id'");
$query2 = mysql_fetch_array($sql);
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
<body >
  <?php
$form =<<<EOT
<div id="top_common">
<div id="arrow"><table><tr><td><a href="main_manager.php"><img src="img/h2.png"></a></td><td align="right"><button><a href="index.php">LOGOUT</a></button></td></tr></table></div>
</div>
<ol class="breadcrumb">
    <li><a href="main_manager.php">Home</a></li>
    <li><a href="ProjReg.php">Project Register</a></li>
    <li><a href="Add_user.php">Add Task</a></li>
    <li><a href="U_add.php">Add Users</a></li>
    <li><a href="finishpro.php">Project Details</a></li>
    <li class="active">Project Edit</li>
           
  </ol>


EOT;

echo $form;
?>
	<form name="Update project" role="form" align = "center" method="post" action="">
		<legend><font face="Times New Romans"><h3>Update Project Details</h3></font></legend>

		<div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">

                          <div class="form-group" align = "left">

                          <div class="form-group" align = "center">
    <label for="inputId" class="col-md-4 control-label">
                                Project ID
         </label> <div class="col-md-8">
                                <input type="inputId" class="form-control" id="inputId" name = "id" value="<?php echo $query2['pro_id']; ?>" readonly="readonly"/>
                    </div>
         </div>

<br><br><br>

    <div class="form-group" align = "center">
    	<label for="inputName" class="col-md-4 control-label">
                                Project Name
         </label> <div class="col-md-8">
                                <input type="inputName" class="form-control" id="inputName" name = "pr_name" value="<?php echo $query2['pr_name']; ?>" />
                    </div>
         </div>
         <br><br>


         <div class="form-group" align = "center">
    	<label for="inputName" class="col-md-4 control-label">
                                Project Description
         </label> <div class="col-md-8">
                                <input type="inputName" class="form-control" id="inputName" name = "pr_description" value="<?php echo $query2['pr_description']; ?>" />
                    </div>
         </div>
         <br><br>


         <div class="form-group" align = "center">
     <label for="inputName" class="col-md-4 control-label">
                                Client Name 
         </label> <div class="col-md-8">
                                <input type="inputName" class="form-control" id="inputName" name = "cl_fulname" value="<?php echo $query2['cl_fulname']; ?>"/>
                    </div>
          </div>
          <br><br>

          <div class="form-group" align = "center">
          <label for="inputName" class="col-md-4 control-label">
                              Client Contact
          </label> <div class="col-md-8">
                     <input type="inputName" class="form-control" id="inputName" name = "cl_contact" value="<?php echo $query2['cl_contact']; ?>" />
                            </div>
           </div>
           
            <br><br>


          <div class="form-group" align = "center">
          <label for="inputEmail" class="col-md-4 control-label">
                              Client E-mail
          </label> <div class="col-md-8">
                     <input type="inputEmail" class="form-control" id="inputEmail" name = "cl_mail" value="<?php echo $query2['cl_mail']; ?>" />
                            </div>
           </div>
           
            <br><br>


           <div class="form-group" align = "center">
                            <label for="inputDate" class="col-md-4 control-label">
                              Start Date
                            </label>
                            <div class="col-md-8">
                                <input type="date" class="form-control" id="inputDate" name = "start_date" value="<?php echo $query2['start_date']; ?>"/>
                            </div>
                          </div>
                           <br><br>

           <div class="form-group" align = "center">
                            <label for="inputDate" class="col-md-4 control-label">
                              End Date
                            </label>
                            <div class="col-md-8">
                                <input type="date" class="form-control" id="inputDate" name = "finished_date" value="<?php echo $query2['finished_date']; ?>"/>
                            </div>
                          </div>
                           <br><br>

                          <br>
    <div class="form-group" align = "right">
                            <div class="col-sm-offset-2 col-sm-10">
    <button type="Submit" class="btn btn-primary btn-md">
                  Update
        </button>
    </div>
        </div>

  </form>
  </body>
  </html>






	 
	
			

		

	
