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
  session_start();//Aluth peli 1
  $_SESSION['name'] = $pr_name;//Aluth peli 2
  if (mysql_query($sql) === TRUE) {
        header("location:p_view.php");
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
<script>
var strEmplt="Please fill this field";
var str2="Only words are allowed here";
var str3="Please choose a Gender";
var str4="Please enter a valid email address";

function checkValidPName(field) {
  var result1=strEmplt.fontcolor("red");
  var result2=str2.fontcolor("red");

    if (field.value == ''){
        document.getElementById("pnameid").innerHTML=result1;
    }else if(!isNaN(field.value)){
      document.getElementById("pnameid").innerHTML=result2;
    }else{
      document.getElementById("pnameid").innerHTML="";
    }
}

function checkValidClName(field) {
  var result1=strEmplt.fontcolor("red");
  var result2=str2.fontcolor("red");

    if (field.value == ''){
        document.getElementById("clnameid").innerHTML=result1;
    }else if(!isNaN(field.value)){
      document.getElementById("clnameid").innerHTML=result2;
    }else{
      document.getElementById("clnameid").innerHTML="";
    }
}

var x = "";
function checkValidEmail(field) {

  var result1=strEmplt.fontcolor("red");
  var result2=str4.fontcolor("red");
    var email = document.getElementById('email');
    x = field.value;
    var filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(field.value == ''){
      document.getElementById("email").innerHTML=result1;
    }else if (!filter.test(field.value)) {
      document.getElementById("email").innerHTML=result2;
  }else{
    document.getElementById("email").innerHTML="";  
  }
}

  function phonenumber(field){  
    var str5="Please enter a valid mobile number";
    var result=str5.fontcolor("red");
    var result2 = strEmplt.fontcolor("red");
    var phoneno = /^\d{10}$/;  

    if(field.value == ''){
        document.getElementById("contact").innerHTML=result2;

    }else if (field.value.match(phoneno)) {
        document.getElementById("contact").innerHTML="";

    }else{
        document.getElementById("contact").innerHTML=result; 
    }
  }
</script>
  <?php
$form =<<<EOT
<div id="top_common">
<div id="arrow"><table><tr><td><a href="p_view.php"><img src="img/h2.png"></a></td><td align="right"><button><a href="index.php">LOGOUT</a></button></td></tr></table></div>
</div>
<ol class="breadcrumb">
    <li><a href="main_manager.php">Home</a></li>
     <li><a href="project_view.php">Project View</a></li>
     <li><a href="p_view.php">Project Details</a></li>
    <li class="active">Project Edit</li>
           
  </ol>
<div id="table">
<form action="UserReg.php" method="POST">

<table>

</form>
</div>

EOT;

echo $form;
?>
	<form name="Update project" role="form" align = "left" method="post" action="editProject.php">
		<legend><font face="Times New Romans"><h3>Update Project Details</h3></font></legend>

		<div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">

                          <div class="form-group" align = "left">

                          <div class="form-group" align = "left">
    <label for="inputId" class="col-md-3 control-label">
                                Project ID
         </label> <div class="col-md-6">
                                <input type="inputId" class="form-control" name = "id" value="<?php echo $query2['pro_id']; ?>" readonly="readonly"/>
                    </div><div class="col-md-3"></div>
         </div>

<br><br><br>

    <div class="form-group" align = "left">
    	<label for="inputName" class="col-md-3 control-label">
                                Project Name
         </label> <div class="col-md-6">
                                <input type="inputName" class="form-control" id="inputName" name = "pr_name" value="<?php echo $query2['pr_name']; ?>" onblur="checkValidPName(this);"/>
                    </div><div class="col-md-3" id="pnameid"></div>
         </div>
         <br><br>


         <div class="form-group" align = "left">
    	<label for="inputName" class="col-md-3 control-label">
                                Project Description
         </label> <div class="col-md-6">
                                <input type="inputName" class="form-control" id="inputName" name = "pr_description" value="<?php echo $query2['pr_description']; ?>" />
                    </div><div class="col-md-3"></div>
         </div>
         <br><br>


         <div class="form-group" align = "left">
     <label for="inputName" class="col-md-3 control-label">
                                Client Name 
         </label> <div class="col-md-6">
                                <input type="inputName" class="form-control" name = "cl_fulname" value="<?php echo $query2['cl_fulname']; ?>" onblur="checkValidClName(this);"/>
                    </div><div class="col-md-3" id="clnameid"></div>
          </div>
          <br><br>

          <div class="form-group" align = "left">
          <label for="inputName" class="col-md-3 control-label">
                              Client Contact
          </label> <div class="col-md-6">
                     <input type="inputName" class="form-control" name = "cl_contact" value="<?php echo $query2['cl_contact']; ?>" onblur="phonenumber(this);"/>
                            </div><div class="col-md-3" id="contact"></div>
           </div>
           
            <br><br>


          <div class="form-group" align = "left">
          <label for="inputEmail" class="col-md-3 control-label">
                              Client E-mail
          </label> <div class="col-md-6">
                     <input type="inputEmail" class="form-control" name = "cl_mail" value="<?php echo $query2['cl_mail']; ?>" onblur="checkValidEmail(this);"/>
                            </div><div class="col-md-3" id="email"></div>
           </div>
           
            <br><br>


           <div class="form-group" align = "left">
                            <label for="inputDate" class="col-md-3 control-label">
                              Start Date
                            </label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" id="inputDate" name = "start_date" value="<?php echo $query2['start_date']; ?>"/>
                            </div><div class="col-md-3"></div>
                          </div>
                           <br><br>

           <div class="form-group" align = "left">
                            <label for="inputDate" class="col-md-3 control-label">
                              End Date
                            </label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" id="inputDate" name = "finished_date" value="<?php echo $query2['finished_date']; ?>"/>
                            </div><div class="col-md-3"></div>
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






	 
	
			

		

	
