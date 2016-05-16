<?php
session_start();
error_reporting(E_ALL);
	ini_set('display_errors', 'On');
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ucsc";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: ". $conn->connect_error);
	}
if($_SERVER['REQUEST_METHOD'] == 'GET'){
	
	$id=$_GET['id'];
	//echo $id;
}
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$id = $_POST['id'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $uname = $_POST['uname'];
  $email = $_POST['email1'];
  
  $position = $_POST['position'];
  $dateOFbirth = $_POST['dateOFbirth'];
  $address = $_POST['address'];
  $contact = $_POST['contact'];

$sql="UPDATE users 
SET  id='$id', fname='$fname', lname='$lname',uname='$uname',email='$email', position= '$position',dateOFbirth='$dateOFbirth',address='$address', contact= '$contact' WHERE 
id='$id'";
if ($conn->query($sql) === TRUE) {
  $_SESSION['empid']=$id ;
	    header("location:edit_view.php");

}
}
$query1=$conn->query("SELECT * from users WHERE id='$id'");
$query2=$query1->fetch_array(MYSQLI_BOTH);
$conn->close();
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

function checkValidFName(field) {
  var result1=strEmplt.fontcolor("red");
  var result2=str2.fontcolor("red");

    if (field.value == ''){
        document.getElementById("fnameid").innerHTML=result1;
    }else if(!isNaN(field.value)){
      document.getElementById("fnameid").innerHTML=result2;
    }else{
      document.getElementById("fnameid").innerHTML="";
    }
}

function checkValidLName(field) {
  var result1=strEmplt.fontcolor("red");
  var result2=str2.fontcolor("red");

    if (field.value == ''){
        document.getElementById("lnameid").innerHTML=result1;
    }else if(!isNaN(field.value)){
      document.getElementById("lnameid").innerHTML=result2;
    }else{
      document.getElementById("lnameid").innerHTML="";
    }
}
function checkValidUName(field) {
  var result1=strEmplt.fontcolor("red");
  var result2=str2.fontcolor("red");

    if (field.value == ''){
        document.getElementById("unameid").innerHTML=result1;
    }else if(!isNaN(field.value)){
      document.getElementById("unameid").innerHTML=result2;
    }else{
      document.getElementById("unameid").innerHTML="";
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
<div id="arrow"><table><tr><td><a href="main_manager.php"><img src="img/h2.png"></a></td><td align="right"><button><a href="index.php">LOGOUT</a></button></td></tr></table></div>
</div>
<ol class="breadcrumb">
    <li><a href="main_manager.php">Home</a></li>
    <li><a href="user_view.php">User View</a></li>
    <li class="active">User Edit</li>
           
  </ol>
<div id="table">
<form action="UserReg.php" method="POST">

<table>

</form>
</div>

EOT;

echo $form;
?>
	<form name="Update employee" role="form" align = "left" method="post" action="edit.php">
		<legend><font face="Times New Romans"><h3>Update Employee Details</h3></font></legend>
		<div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">

                          <div class="form-group" align = "left">

                          <div class="form-group" align = "left">
    <label for="inputId" class="col-md-3 control-label">
                                Employee ID
         </label> <div class="col-md-6">
                                <input type="inputId" class="form-control" id="inputId" name = "id" value="<?php echo $query2['id']; ?>" readonly="readonly"/>
                    </div><div class="col-md-3"></div>
         </div>

<br><br><br>

    <div class="form-group" align = "left">
    	<label for="inputName" class="col-md-3 control-label">
                                First Name
         </label> <div class="col-md-6">
                                <input type="inputName" class="form-control" name = "fname" value="<?php echo $query2['fname']; ?>" onblur="checkValidFName(this);"/>
                    </div><div class="col-md-3" id="fnameid"></div>
         </div>
         <br><br>


         <div class="form-group" align = "left">
    	<label for="inputName" class="col-md-3 control-label">
                                Last Name
         </label> <div class="col-md-6">
                                <input type="inputName" class="form-control" name = "lname" value="<?php echo $query2['lname']; ?>" onblur="checkValidLName(this);"/>
                    </div><div class="col-md-3" id="lnameid"></div>
         </div>
         <br><br>


         <div class="form-group" align = "left">
     <label for="inputName" class="col-md-3 control-label">
                                User Name 
         </label> <div class="col-md-6">
                                <input type="inputName" class="form-control" name = "uname" value="<?php echo $query2['uname']; ?>" onblur="checkValidUName(this);"/>
                    </div><div class="col-md-3" id="unameid"></div>
          </div>
          <br><br>



          <div class="form-group" align = "left">
          <label for="inputEmail" class="col-md-3 control-label">
                              E-mail
          </label> <div class="col-md-6">
                     <input type="inputEmail" class="form-control" name = "email1" value="<?php echo $query2['email']; ?>" onblur="checkValidEmail(this);"/>
                            </div><div class="col-md-3" id="email"></div>
           </div>
           
            <br><br>


           <div class="form-group" align = "left">
                            <label for="inputDate" class="col-md-3 control-label">
                              Date of Birth
                            </label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" id="inputDate" name = "dateOFbirth" value="<?php echo $query2['dateOFbirth']; ?>"/>
                            </div>
                          </div>
                           <br><br>


                         <div class="form-group" align = "left">
                            <label for="inputposition" class="col-md-3 control-label">
                              Position 
                            </label>
                            <div class="col-md-6">
                                 
                            <select name="position"><option><?php echo $query2['position'];?></option><option>Project Manager</option><option>Developer</option><option>Business Analyst (BA)</option><option>Quality Assuarance (QA)</option></select>
                            
                            </div>
                             <br><br>

      <div class="form-group" align = "left">
               <label for="inputAdd" class="col-md-3 control-label">
                   Address
                </label><div class="col-md-6">
                                <input type="inputAdd" class="form-control" id="inputAdd" name = "address" value="<?php echo $query2['address']; ?>"/>
              </div>
               </div>
                <br><br>


               <div class="form-group" align = "left">
            <label for="tel" class="col-md-3 control-label">
                    Contact No
            </label><div class="col-md-6">
                   <input type="tel" class="form-control" name = "contact" value="<?php echo $query2['contact']; ?>" onblur="phonenumber(this);"/>
                            </div></div><div class="col-md-3" id="contact"></div>
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