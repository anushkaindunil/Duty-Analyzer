<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  	<link rel="stylesheet" href="/resources/demos/style.css">
	<link href="UserReg.css" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="common.css">

</head>
<link rel="stylesheet" type="text/css" href="mainmanager.css">
<body>

<script> 
$(document).ready(function(){
    $("#c").click(function(){
        $("#a").slideToggle("slow");
		$("#b").hide("slow");
    });
});
$(document).ready(function(){
    $("#d").click(function(){
        $("#b").slideToggle("slow");
		$("#a").hide("slow");
    });
});
</script>


</head>
<body>
<?php
 session_start();
$emp_id=$_SESSION['id'];
$_SESSION['id']=$emp_id;
$fname=$_SESSION["fname"];
$_SESSION["fname"]=$fname;
?>
<div id="top_common">
<div id="arrow"><table><tr><td id="header_topic"><p id="pos"><font size="4"><?php echo "User :- ".$_SESSION["fname"]." "; ?></font></p></td><td width="300px"> <p id="pos"><font size="3" color="black"><?php echo " Position :- ".$_SESSION["pos"]." "; ?></font></p> </td><td align="right"><button><a href="index.php">LOGOUT</a></button></td></tr></table></div>
</div>

<div id="top" align="center">
<img src="img/top.png" width="100%" height="35%"/>
</div>
<br>
	<div id="head" align="center">
		<table >
			<tr><td id="header_topic"><p id="pos"><font size="5"></font></p></td><td> <p id="pos"><font size="5"></font></p> </td></tr>		
			<tr><td><a href="user_views.php" id="c"><img src="img/b1.png"></a></td><td><a href="task_add_view.php" id="d">
			<img src="img/b2.png"></a></td><td><a href="progress.php"><img src="img/b3.png"></a></td></tr>
		
		</table>
	</div><br>
<div id="end"></div>
	
</body>
</html>
