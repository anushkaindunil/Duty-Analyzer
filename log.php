<?php
if($_POST['username']=='' || $_POST['password']==''){
?>
<script type="text/javascript">
window.alert("Enter valid username and password");
window.location.href="index.php";
//window.open('index.php');
</script>
<?php

}
else
 {
if($_POST){
	//if(isset($_POST['login']) && $_POST['username'] && $_POST['password']){
		$db="ucsc";
		$username = $_POST["username"];
    	$password = md5($_POST["password"]);
		//$username=mysql_real_escape_string($_POST['username']);
		//$password=mysql_real_escape_string($_POST['password']);

		$connection = @mysql_connect("localhost","root","") or die("Couldn't make connection.");;
		
			if($connection){
				$selection = mysql_select_db($db)or die("Couldn't select database");

				
					if($selection){
						$query = "SELECT * FROM users WHERE uname='" . $_POST["username"] . "' AND password='". $password."'";
						$query1 = "SELECT position,id FROM users WHERE uname='" . $_POST["username"] . "' AND password='". $password."'";
						$sql="SELECT lname FROM users WHERE uname='" . $_POST["username"] . "' AND password='". $password."'";
						$mysql_query = mysql_query($query);
						$mysql_query1 = mysql_query($query1);
						$name=mysql_query($sql);
						//or trigger_error(mysql_error().$sql);
						//$row  = mysql_fetch_array($mysql_query);
						$row1 = mysql_fetch_array($mysql_query1);
					

						session_start();
						$_SESSION["fname"]= $_POST["username"];
						$_SESSION['pos'] = $row1['position'];
						$_SESSION['id'] = $row1['id'];

						if(mysql_num_rows($mysql_query)>0){
							$_SESSION['username'] = $username;
							//$_SESSION['position']= $mysql_query1;
							
							if($row1['position']=="Developer"){
							
?>
<script type="text/javascript">
//alert("Login successfully");
window.location.href="Developer.php";
//window.open('main_manager.php');
</script>
<?php
}
elseif($row1['position']=="team leader"){
							
?>
<script type="text/javascript">
//alert("Login successfully");
window.location.href="team_lead.php";
//window.open('team_leader.php');
</script>
<?php
}
elseif($row1['position']=="Main Manager"){
							
?>
<script type="text/javascript">
//alert("Login successfully");
window.location.href="main_manager.php";
//window.open('team_leader.php');
</script>
<?php

}
elseif($row1['position']=="Project Manager"){
							
?>
<script type="text/javascript">
//alert("Login successfully");
window.location.href="project_manager.php";
//window.open('team_leader.php');
</script>
<?php
}
}						else{

						?>
<script type="text/javascript">
window.alert("Invalid username or password");
window.location.href="index.php";
//window.open('index.php');
</script>
<?php
				}		
					}
					//echo "";
			}
			//echo "";
	//
		}
}

?>