<!DOCTYPE html>
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
<script type="text/javascript">

function myFunction() {
    alert("okay");
    //document.getElementById("demo").innerHTML = x;
}

</script>
<link href="view.css" type="text/css" rel="stylesheet" />

</head>
<body>
<style type="text/css">
table td{
  width: 300px;
  height: 30px;
  background-color: #66c2ff;
}
</style>
<?php
session_start();
$empid=$_SESSION['empid'];
$link = mysql_connect('localhost', 'root', ''); 

if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
}
//connect to the database
mysql_select_db('ucsc'); 
$query = mysql_query("SELECT * FROM users WHERE id = '$empid'");
$lname = $email = $dob = $address = $contact = $id = "";
 while($row = mysql_fetch_array($query)) {
      $id = $row["id"];
      $name = $row["fname"];
      $lname = $row["lname"];
      $email = $row["email"];
      $dob = $row["dateOFbirth"];
      $address = $row["address"];
      $contact = $row["contact"];
      $path = $row['profilePic'];
      $position=$row['position'];
    }

  if (isset($_POST['submit'])) {
    header('Location:user_view.php');
  }
?>
<ol class="breadcrumb">
    <li><a href="main_manager.php">Home</a></li>
    <li><a href="user_view.php">User View</a></li>
    <li><a href="edit.php">User Edit</a></li>
    <li class="active">Finish Edit</li>
           
  </ol>
<table align="center" >
<tr><td id="color"><label>Profile Picture     :</label></td><td><label><img src= <?php echo $path;?> width='80' height='80'/></label>  </td></tr> 
<tr><td id="color"><label>First Name     :</label></td><td><label><?php echo $name; ?></label>  </td></tr>
<tr><td id="color"><label>Last Name      :</label></td><td> <label><?php echo $lname; ?></label> </td></tr>
<tr><td id="color"><label>Email          :</label> </td><td><label><?php echo $email; ?></label></td> 

</tr>
<tr><td id="color"><label>Date of Birth  :</label></td><td>
<label><?php echo $dob; ?></label></td></tr>
<tr><td id="color"><label>Address        :</label> </td><td><label><?php echo $address; ?></label></td></tr>
<tr><td id="color"><label>Contact No     :</label> </td><td><label><?php echo $contact; ?>
</label></td></tr>
<tr><td id="color"><label>POSITION    :</label> </td><td><label><?php echo $position; ?>
</label></td></tr>
<tr><td><form action=""method="POST"><input type="submit" name="submit" value="FINISH"></form>
</td><td></td></tr>
</table>   

</body>
</html>