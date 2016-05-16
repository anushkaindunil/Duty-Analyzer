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
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<link rel="stylesheet" href="/resources/demos/style.css">
	<link href="UserReg.css" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="common.css">

	<script type="text/javascript">
            var monthtext = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            
            function populatedropdown(dayfield, monthfield, yearfield) {
                var today = new Date()
                var dayfield = document.getElementById(dayfield)
                var monthfield = document.getElementById(monthfield)
                var yearfield = document.getElementById(yearfield)

                for (var i = 0; i < 31; i++)
                        dayfield.options[i] = new Option(i + 1, i+1)
                dayfield.options[today.getDate()] = new Option(today.getDate(), today.getDate(), true, true) //select today's day
                for (var m = 0; m < 12; m++)
                        monthfield.options[m] = new Option(monthtext[m], monthtext[m])
                monthfield.options[today.getMonth()] = new Option(monthtext[today.getMonth()], monthtext[today.getMonth()], true, true) //select today's month
                var thisyear = today.getFullYear()
                for (var y = 0; y < 100; y++) {
                        yearfield.options[y] = new Option(thisyear, thisyear)
                        thisyear -= 1
                }
                yearfield.options[0] = new Option(today.getFullYear(), today.getFullYear(), true, true) //select today's year   
            }
	</script>

<style type="text/css">
p{
    color: red;
}

</style>
</head>

<body>
<script>

var strEmplt="Please fill this field";
var str2 ="Only words are allowed here";
var str3 ="Please choose a Gender";
var str4 ="Please enter a valid email address";

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

function checkValidGender(field) {
    var r = document.getElementsByName("genderid");
    var c = 0
    var result1=str3.fontcolor("red");

    for(var i=0; i < r.length; i++){
       if(c[i].checked) {
          c = i; }
    }
    if (!empty(field.value)) {
        document.getElementById("genderid").innerHTML="";
    }else{
    	document.getElementById("genderid").innerHTML=result1;
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

function checkValidEmailC(field) {
    var str5="Your email do not match";
	var result1=strEmplt.fontcolor("red");
	var result2=str4.fontcolor("red");
    var email = document.getElementById('cemail');
    var result5=str5.fontcolor("red");

    var filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(field.value == ''){
    	document.getElementById("cemail").innerHTML=result1;
    }else if (!filter.test(field.value)) {
    	document.getElementById("cemail").innerHTML=result2;
	}else if(x != field.value){
        document.getElementById("cemail").innerHTML=result5;
    }else{
		document.getElementById("cemail").innerHTML="";	
	}
}
//--------------------- ADD BIRTHDAY VALIDATION ----------------------------------
function checkPosition(field) {
	var str5="Please choose a position";
	var result=str5.fontcolor("red");
    if (field.value == '') {
        document.getElementById("position").innerHTML=result;
    }else{
    	document.getElementById("position").innerHTML="";
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

var y = "";
function checkValidPassword(field) {
	var result=strEmplt.fontcolor("red");
    y = field.value;

    if (field.value == '') {
        document.getElementById("password").innerHTML=result;
    }else{
    	document.getElementById("password").innerHTML="";
    }
}

function checkValidCPassword(field) {
    var str5="Your Password do not match";
    var result=strEmplt.fontcolor("red");
    var result5=str5.fontcolor("red");
    if (field.value == '') {
        document.getElementById("cpassword").innerHTML=result;
    }else if(y != field.value){
        document.getElementById("cpassword").innerHTML=result5;
    }else{
        document.getElementById("cpassword").innerHTML="";
    }
}

</script>

<?php

mysql_connect ("localhost","root","");
    mysql_select_db("ucsc");
    $query1=mysql_query("SELECT * FROM users");
    $emp_id="";
    $emp="";
WHILE($rows = mysql_fetch_array($query1)){
        $emp_id=$rows['id'];
}
$emp=substr($emp_id,-4);
$emp=$emp+1;

if ($emp<10) {
    $id="emp_000".$emp;
}elseif ($emp<100) {
   $id="emp_00".$emp;
}elseif ($emp<1000) {
   $id="emp_0".$emp;
}elseif ($emp<10000) {
    $id="emp_".$emp;
}else{
    echo "Emp ID out of bound plz refresh DATABASE>>>";
}
$form =<<<EOT
<div id="top_common">
<div id="arrow"><table><tr><td><a href="main_manager.php"><img src="img/h2.png"></a></td><td id="header_topic">New Users Registration</td><td align="right"><button name="logout"><a href="index.php">LOGOUT</a></button></td></tr></table></div>
</div>
<ol class="breadcrumb">
    <li><a href="main_manager.php">Home</a></li>
    <li class="active">User Register</li>
           
  </ol>

<div id="table">
<form action="thankyou.php" method="POST" enctype="multipart/form-data">
<br>
<table >			
        <tr><td align="right">Employee ID</td><td><br><input type="text" name="empid" size="60" value="$id" style="height:30px;" readonly="readonly"></td></tr>
		<tr><td align="right">First Name</td><td><br><input type="text" name="fname" size="60"  style="height:30px;" onblur="checkValidFName(this);"></td><td id="fnameid" width="200px"><p>*</p></td></tr>
		<tr><td align="right">Last Name</td><td><br><input type="text" name="lname" size="60"  style="height:30px;" onblur="checkValidLName(this);"></td><td id="lnameid" width="100px"><p>*</p></td></tr>
		<tr><td align="right">User Name</td><td><br><input type="text" name="uname" size="60"  style="height:30px;" onblur="checkValidUName(this);"></td><td id="unameid" width="100px"><p>*</p></td></tr>
		<tr><td align="right">Profile Picture</td><td><br><input type="file" name="profilePic" id="profilePic" size="60"  style="height:30px;" ></td><td width="100px"></td></tr>
        <tr><td align="right">Gender<p>*</p></td><td><br><input type="radio" name="gender" value="Female" onblur="checkValidGender(this);">Female<br><input type="radio" name="gender" value="Male" onblur="checkValidGender(this);" checked="checked">Male</td><td id="genderid"></td></tr>
		<tr><td align="right">E-mail address</td><td><br><input type="email" name="email" size="60"  style="height:30px;" onblur="checkValidEmail(this);"></td><td id="email" width="100px"></td</td><p>*</p></td></tr>
		<tr><td align="right">Confirm E-mail</td><td><br><input type="email" name="cemail" size="60"  style="height:30px;"onblur="checkValidEmailC(this);" ></td><td id="cemail" width="100px"><p>*</p></td></tr>
		
        <tr><td align="right">Date of Birth</td><td><br>
            <select name="dateOFYear" id="yeardropdown"></select> 
            <select name="dateOFMonth" id="monthdropdown"></select>
            <select name="dateOFDay" id="daydropdown"></select> 

            <script type="text/javascript" name="dateOFbirth">
                window.onload = function() {         
                    populatedropdown("daydropdown", "monthdropdown", "yeardropdown")
                }
            </script>
           <br><br>
        </td><td id="dateid" width="100px"></td></tr>
		

		<tr><td align="right">Position</td><td><br>
	   <select name="position" onblur="checkPosition(this);"><option></option><option>Project Manager</option><option>Developer</option><option>Business Analyst (BA)</option><option>Quality Assuarance (QA)</option></select>
	   <br><br>		
		</td><td id="position" width="100px"><p>*</p></td></tr>
		
		<tr><td align="right">Address</td><td><br><input type="text" name="address" size="60"  style="height:30px;"></td><td id="empty4" width="100px"></td></tr>
		<tr><td align="right">Contact No</td><td><br><input type="text" name="contact" size="60"  style="height:30px;"onblur="phonenumber(this);" required></td><td id="contact" width="100px"><p>*</p></td></tr>
		<tr><td align="right">Password</td><td><br><input type="password" name="password" size="60"  style="height:30px;" onblur="checkValidPassword(this);" ></td><td id="password" width="100px"><p>*</p></td></tr>
		<tr><td align="right">Confirm Password</td><td><br><input type="password" name="cpassword" size="60"  style="height:30px;"onblur="checkValidCPassword(this);"></td><td id="cpassword" width="100px"><p>*</p></td></tr>

		<tr><td align="right"></td><td><input type="submit" id="button" name="submit" value="submit" onclick=""></p>
			
</table>
</form>
</div>

EOT;

echo $form;

?>

</body>
</html>

