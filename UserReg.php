<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<link href="UserReg.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="common.css">

</head>
<body>
	<script>
function phonenumber(inputtxt)  
{  
  var phoneno = /^\d{10}$/;  
  if(inputtxt.value.match(phoneno))  
  {  
      return true;  
  }  
  else  
  {  
     alert("Not a valid Phone Number");  
     return false;  
  }  
  }  


	</script>
<center><h1>User Registration Form</h1></center>


<?php

mysql_connect ("localhost","root","");
mysql_select_db("ucsc");

if(isset($_POST['submit'])){

	

	
	$email1 = $_POST['email'];
	$email2 = $_POST['cemail'];
	$pass1  = $_POST['password'];
	$pass2  = $_POST['cpassword'];
	
	if($email1 == $email2){
		
		if($pass1 == $pass2){
			
			$fname = mysql_escape_string($_POST['fname']);
			$lname = mysql_escape_string($_POST['lname']);
			$uname = mysql_escape_string($_POST['uname']);
			$email1 = mysql_escape_string($_POST['email']);
			$email2 = mysql_escape_string($_POST['cemail']);
			$pass1 = mysql_escape_string($_POST['password']);
			$pass2 = mysql_escape_string($_POST['cpassword']);
			$gender = mysql_escape_string($_POST['gender']);
			$position = mysql_escape_string($_POST['position']);
			$dateOFbirth = mysql_escape_string($_POST['dateOFbirth']);
			$address = mysql_escape_string($_POST['address']);
			$contact = mysql_escape_string($_POST['contact']);
			
			
			
			//$pass1 = md5($pass1);
			
			 mysql_query("INSERT INTO `users` (`id`,`fname`,`lname`,`uname`,`email`,`password`,`gender`,`position`,`dateOFbirth`,`address`,`contact`) VALUES (NULL,'$fname','$lname','$uname','$email1','$pass1','$gender','$position','$dateOFbirth ','$address','$contact' )") or die(mysql_error());
			 mysql_query("INSERT INTO `login` (`username`,`password`,`position`) VALUES ('$uname','$pass1','$position' )") or die(mysql_error());
		
		}else{
			echo "Sorry. your password do not match <br />";
			exit();
		}

		
		print "Records added to the database";
		
	}else{
		echo"Sorry email not match";
	}
	
	

	

}else{

$form =<<<EOT
<div id="top_common">
<div id="arrow"><table><tr><td><a href="main_manager.php"><img src="img/h2.png"></a></td><td align="right"><button><a href="logout.php">LOGOUT</a></button></td></tr></table></div>
</div>
<div id="table">
<form action="UserReg.php" method="POST">

<table>
<tr><td>First name:</td><td><input type="text" name="fname" size="60"  style="height:30px;"/></td></tr>
<tr><td>Last name :</td><td><input type="text" name="lname" size="60"  style="height:30px;"/></td></tr>
<tr><td>User name :</td><td><input type="text" name="uname" size="60"  style="height:30px;"/></td></tr>
<tr><td><h3>Gender<h3></td><td></td></tr>
<tr><td>Male  :<input type="checkbox" name="gender" value="male"  />Female:<input type="checkbox" name="gender"  value="female" /></td></tr>
<tr><td></td><td></td></tr>
<tr><td>Email 	 :</td><td><input type="email" name="email" size="60"  style="height:30px;" required/></td></tr>
<tr><td>Confirm email	:</td><td><input type="email" name="cemail" size="60"  style="height:30px;"/></td></tr>
<tr><td>Date of birth	:</td><td><input type="date" placeholder = "YYYY/MM/DD"name="dateOFbirth" size="60"  style="height:30px;" /></td></tr>
<tr><td>Position		:</td><td><select name="position"><option></option><option>Main manager</option><option>Project manager</option><option>Team leader</option><option>Team member</option></select></td></tr>
<tr><td>Address 		:</td><td><input type="text" name="address" size="60"  style="height:30px;"/></td></tr>
<tr><td>Contact no 		:</td><td><input type="tel" name="contact" size="60"  style="height:30px;"/></td></tr>
<tr><td>Password 		:</td><td><input type="password" name="password" size="60"  style="height:30px;"/></td></tr>
<tr><td>Confirm password:</td><td><input type="password" name="cpassword" size="60"  style="height:30px;"/></a></td></tr>

<tr><td></td><td><input type="submit" value="Register" name="submit" id="button" onclick="phonenumber(document.add.tel);"/></td></tr>




</form>
</div>

EOT;

echo $form;

}



?>
</div>
</div>
</body>
</html>


