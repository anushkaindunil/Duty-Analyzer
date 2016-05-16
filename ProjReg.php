<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  	<link rel="stylesheet" href="/resources/demos/style.css">
	<link href="UserReg.css" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="common.css">

<style type="text/css">
p{
    color: red;
}

</style>

<script>
var strEmplt="Please fill this field";
var str2="Only words are allowed here";
var str3="Please choose a Gender";
var str4="Please enter a valid email address";

function checkValidName(field) {
	var result1=strEmplt.fontcolor("red");
	var result2=str2.fontcolor("red");

    if (field.value == ''){
        document.getElementById("valid_name").innerHTML=result1;
    }else if(!isNaN(field.value)){
    	document.getElementById("valid_name").innerHTML=result2;
    }else{
    	document.getElementById("valid_name").innerHTML="";
    }
}

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

  function checkValidPName(field) {
	var result1=strEmplt.fontcolor("red");
	var result2=str2.fontcolor("red");

    if (field.value == ''){
        document.getElementById("valid_pname").innerHTML=result1;
    }else if(!isNaN(field.value)){
    	document.getElementById("valid_pname").innerHTML=result2;
    }else{
    	document.getElementById("valid_pname").innerHTML="";
    }
}

  var x="";
  var y="";
  function checkValidDateS(field) {
	 x = field.value;	
  }
  function checkValidDateE(field) {
    var strA="End date must be after Start date";
    var resultA=strA.fontcolor("red");

    y = field.value;
    
    if( (new Date(x).getTime() > new Date(y).getTime())){
      document.getElementById("finished_date").innerHTML=resultA;
    }else{
      document.getElementById("finished_date").innerHTML=""; 
    }
  }

</script>
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
</head>
<body>

<script>
$(document).ready(function(){
    $("#button").click(function(){
        $("#table").hide();
    });
}
$(function(){
  	$("#datepicker").datepicker();
  });
  $(function(){
  	$("#datepicker2").datepicker();
  });

</script>

<?php
@session_start();
mysql_connect ("localhost","root","");
mysql_select_db("ucsc");

$result = mysql_query("SELECT * FROM project");

$proid="";
WHILE($rows = mysql_fetch_array($result)){
    $proid=$rows['pro_id'];
}
$ids=substr( $proid,-4);
$id_pro=(int)$ids+1;
if ($id_pro<10) {
 $proid="P000".$id_pro;
}elseif ($id_pro<100) {
  $proid="P00".$id_pro;
}elseif ($id_pro<1000) {
  $proid="P0".$id_pro;
}elseif ($id_pro<10000) {
  $proid="P".$id_pro;
}else{
  echo "Out of Bound Project ID";
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

if(isset($_POST['submit'])){

  $cl_fulname = test_input($_POST['cl_fulname']);
  $cl_mail  = test_input($_POST['cl_mail']);
  $cl_contact  = test_input($_POST['cl_contact']);
  $pro_id  = test_input($_POST['pro_id']);
  $pr_name  = test_input($_POST['pr_name']);
  $pr_description  = test_input($_POST['pr_description']);
  $start_date  = test_input($_POST['start_date']);
  $finished_date  = test_input($_POST['finished_date']);


	$_SESSION['pro_id']=$proid;	
	$_SESSION['pro_name']=$pr_name;		
		mysql_query("INSERT INTO `project` (`cl_fulname`, `cl_mail`,`cl_contact`,`pro_id`,`pr_name`,`pr_description`,`start_date`,`finished_date`) VALUES ('$cl_fulname','$cl_mail','$cl_contact','$pro_id','$pr_name','$pr_description','$start_date','$finished_date')") or die(mysql_error());

?>
<script type="text/javascript">
alert("Project Register successfully");
window.location.href="Add_user.php";

</script>
<?php
}else{

$form =<<<EOT
<div id="top_common">
<div id="arrow"><table><tr><td><a href="main_manager.php"><img src="img/h2.png"></a></td><td id="header_topic"><font size="4">New Project Registration Form</font></td><td align="right"><button><a href="index.php">LOGOUT</a></button></td></tr></table></div>
</div>
<ol class="breadcrumb">
    <li><a href="main_manager.php">Home</a></li>
    <li class="active">Project Register</li>
           
  </ol>
<div id="table">
<form action="" method="POST">

<table >

		<tr><td align="right"><font color="blue">Client details</font></td><td><br><br><br>
		<tr><td align="right">Client Name</td><td><br><input type="text" name="cl_fulname" size="60"  style="height:30px;" onblur="checkValidName(this);"></td><td id="valid_name" width="100px"><p>*</p></td></tr>
		<tr><td align="right">E mail </td><td><br><input type="mail" name="cl_mail" size="60"  style="height:30px;" onblur="checkValidEmail(this);" required></td><td id="email" width="100px"><p>*</p></td></tr>
		<tr><td align="right">Contacts no</td><td><br><input type="text" name="cl_contact" size="30"  style="height:30px;"onblur="phonenumber(this);" ></td><td id="contact" width="100px"><p>*</p></td></tr>
		<tr><td align="right"><font color="blue">Project details</font></td><td><br><br><br>
		<tr><td align="right">Project ID</td><td><br><input type="text" name="pro_id" size="30" value="$proid" readonly="readonly" style="height:30px;"></td><td width="100px"></td></tr>
		<tr><td align="right">Project Name</td><td><br><input type="text" name="pr_name" size="60"  style="height:30px;"onblur="checkValidPName(this);"></td><td id="valid_pname" width="100px"><p>*</p></td></tr>
		<tr><td align="right">Project description</td><td><br><textarea rows="13" cols="90" name="pr_description" size="60" onblur="checkTextField6(this);" ></textarea></td><td id="empty6" width="100px"></td></tr>
		<tr><td align="right"><font color="blue">Duration</font></td><td><br>
		<tr><td align="right">Start date: </td><td><br><input type="date" id="datepicker" name="start_date" size="30" style="height:30px;" required width="100px" onblur="checkValidDateS(this);"></td><td id="start_date"><p>*</p></td></tr>
		<tr><td align="right">Finished date: </td><td><br><input type="date" id="datepicker2" name="finished_date" size="30" style="height:30px;" required width="100px" onblur="checkValidDateE(this);"></td><td id="finished_date"><p>*</p></td></tr> 
		</table>
		<table>
		<tr><td align="right"></td><td height="40px"><input type="submit" id="button" name="submit" value="submit" onclick="phonenumber(document.add.cl_contact);"></p>
		</tr>		
</table>

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