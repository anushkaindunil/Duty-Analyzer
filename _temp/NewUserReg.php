
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="view.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<link href="UserReg.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="common.css">

<body bgcolor="#CCCCCC">

<table  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="1345" height="20"><label>
      <div align="center" class="aa">User Registration Form</div>
    </label>
    <div align="center" class="aa">&nbsp;</div></td>
  </tr>
  <tr>
    <td width="1345" height="80" bgcolor="#40669F"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="672" height="80"><img src="img/h2.png" width="40" height="40" align="baseline" /></td>
        <td width="673" height="80"><form id="form1" name="form1" method="post" action="">
          <div align="right">
            <input type="submit" name="btnLogout" id="btnLogout" value="Log out" />
          </div>
        </form></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="1345" height="100"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="5" height="100">&nbsp;</td>
        <td width="1340" height="100"><form id="form2" name="form2" method="post" action="">
          <span id="sprytextfield1">
            <label for="txtFirstName"><br />
              First Name:</label>
            <input name="txtFirstName" type="text" id="txtFirstName" value="" />
            <br />
            <span class="textfieldRequiredMsg">A value is required.</span></span>
          <p><span id="sprytextfield2">
            <label for="txtLastName">Last Name:</label>
            <input type="text" name="txtLastName" id="txtLastName" />
         
        
            <span class="textfieldRequiredMsg">A value is required.</span></span></p>
          <p><span id="sprytextfield3">
            <label for="txtUserName">User Name:</label>
            <input name="txtUserName" type="text" id="txtUserName" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></p>
        </form></td>
   
      </tr>
    </table></td>
  </tr>
  <tr>

  </tr>
  <tr>
        <form id="profileForm" class="form-horizontal">
            <div class="form-group">
                <label class="col-xs-3 control-label">Birthday</label>
                <div class="col-xs-4">
                    <input type="text" class="form-control" name="birthday" placeholder="YYYY/MM/DD" />
                </div>
            </div>
        </form>
        
<script>
$(document).ready(function() {
    $('#profileForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            birthday: {
                validators: {
                    date: {
                        format: 'YYYY/MM/DD',
                        message: 'The value is not a valid date'
                    }
                }
            }
        }
    });
});
</script>

  </tr>
</table>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
</script>

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
<tr><td>Male  :<input type="radio" name="gender" value="male"  />Female:<input type="radio" name="gender"  value="female" /></td></tr>
<tr><td></td><td></td></tr>
<tr><td>Email 	 :</td><td><input type="text" name="email" size="60"  style="height:30px;" required/></td></tr>
<tr><td>Confirm email	:</td><td><input type="text" name="cemail" size="60"  style="height:30px;"/></td></tr>
<tr><td>Date of birth	:</td><td><input type="text" name="dateOFbirth" size="60"  style="height:30px;" /></td></tr>
<tr><td>Position		:</td><td><select name="position"><option></option><option>Main manager</option><option>Project manager</option><option>Team leader</option><option>Team member</option></select></td></tr>
<tr><td>Address 		:</td><td><input type="text" name="address" size="60"  style="height:30px;"/></td></tr>
<tr><td>Contact no 		:</td><td><input type="text" name="contact" size="60"  style="height:30px;"/></td></tr>
<tr><td>Password 		:</td><td><input type="password" name="password" size="60"  style="height:30px;"/></td></tr>
<tr><td>Confirm password:</td><td><input type="password" name="cpassword" size="60"  style="height:30px;"/></a></td></tr>

<tr><td></td><td><input type="submit" value="Register" name="submit" id="button" onclick="phonenumber(document.add.tel);"/></td></tr>




</form>
</div>

EOT;

echo $form;

}



?>


</body>
</html>
