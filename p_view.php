<html>
<?php
session_start();
$pro_name=$_SESSION['name'];
$pro_name=(string)$pro_name;

$link = mysql_connect('localhost', 'root', ''); 

if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
}
//connect to the database
mysql_select_db('ucsc'); 

$query2 = mysql_query("SELECT pro_id FROM project WHERE pr_name='$pro_name'");
$rows2 = mysql_fetch_array($query2);
$proId= $rows2['pro_id'];
$_SESSION['pro_id']=$proId;
$query = mysql_query("SELECT * FROM tasks WHERE pro_id='$proId'");
  

    $query3 = mysql_query("SELECT * FROM project WHERE pro_id ='$proId'");
    $rows3 = mysql_fetch_array($query3);

?>
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

<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("add_bottom").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("add_bottom").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","getproject.php?q="+str,true);
        xmlhttp.send();
    }
}
///////////////////
$(document).ready(function(){
    $("#arrow").click(function(){
        $("#hover").show(1000);
    });
});

$(document).ready(function(){
    $("#arw").click(function(){
        $("#hover").hide(1000);
    });
});
</script>

<link rel="stylesheet" type="text/css" href="common.css">
<title>Display Record</title>
<link href="display_record.css" type="text/css" rel="stylesheet" />
<link href="u_add.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="top_common">
<div id="arrow"><table><tr><td><a href="main_manager.php"><img src="img/h2.png"></a></td><td id="Header_topic">Details of Project :  <?php echo $pro_name;?></td><td align="right"><button><a href="index.php">LOGOUT</a></button></td></tr></table></div>
</div>
<ol class="breadcrumb">
    <li><a href="main_manager.php">Home</a></li>
     <li><a href="project_view.php">Project View</a></li>
    <li class="active">Project Details</li>
           
  </ol>

  <div id="hover">

<table >
<tr><td id="color"><label>Project Name       :</label></td><td><label><?php echo $rows3['pr_name']; ?></label>  </td></tr> 
<tr><td id="color"><label>Project Description:</label></td><td><label><?php echo $rows3['pr_description']; ?></label>  </td></tr>
<tr><td id="color"><label>Client Name        :</label></td><td> <label><?php echo $rows3['cl_fulname']; ?></label> </td></tr>
<tr><td id="color"><label>Client Contact     :</label> </td><td><label><?php echo $rows3['cl_contact']; ?></label></td> </tr>
<tr><td id="color"><label>Client Email       :</label> </td><td><label><?php echo $rows3['cl_mail']; ?></label></td> </tr>
<tr><td id="color"><label>Start Date         :</label> </td><td><label><?php echo $rows3['start_date']; ?></label></td></tr>
<tr><td id="color"><label>End Date           :</label> </td><td><label><?php echo $rows3['finished_date']; ?></label></td></tr>
<tr></tr></table>

<?php
echo "<tr><td><a href='editProject.php?id=".$proId."'> <button class='AnuButton'>Edit</button></a></td>";
echo "<td><a href='taskAddToProject.php'> <button class='AnuButton'>Add Tasks</button> </a></td></tr>";

?>

  </div>  
  <div id="tp_cmmn">
<div id="arw"><table><tr><td id="Header_topic" align="left">Users Progress of Project :  <?php echo $pro_name;?></td></tr></table></div>
</div>

<div id="pop">
  <table><tr><td><p><font size="5px">Task Name :</font></p></td><td><select name="position" onchange="showUser(this.value)"><option></option><?php   WHILE($row = mysql_fetch_array($query)){ $prname=$row['task_name']?> <option><?php echo $prname;?></option><?php }?></select></td></tr>
  </table>
</div>

<table><tr><td>Employee Name</td><td>Position</td><td><center>Progress</center></td><td><center>Remaining Time</center></td></tr></table>

<div id="add_bottom">
</div>
<body>
</html>