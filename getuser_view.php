<!DOCTYPE html>
<html>
<head>
<link href="view.css" type="text/css" rel="stylesheet" />

</head>
<body>
<?php
$q = strval($_GET['q']);
if (!defined('SERVERNAME')) define('SERVERNAME', 'localhost');
    if (!defined('USERNAME')) define('USERNAME', 'root');
    if (!defined('PASSWORD')) define('PASSWORD', '');
    if (!defined('DBNAME')) define('DBNAME', 'ucsc');

    $con = new mysqli(SERVERNAME, USERNAME, PASSWORD, 'ucsc');

if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM users WHERE position = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table>";
while($row = mysqli_fetch_array($result)) {
  $name=$row['fname'];
   $lname=$row['lname'];
    ?>
    <tr><td><button  id='paddin' name='submit' onclick="showU(this.value)" value = '<?php echo $name;?>'><?php echo $name." ".$lname;?></button></td>
    </tr>
    <?php
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>