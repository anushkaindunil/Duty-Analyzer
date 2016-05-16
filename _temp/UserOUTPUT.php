<?php
$con=mysqli_connect("localhost","root","");
mysql_select_db("ucsc");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="SELECT fname,lname FROM users ORDER BY lname";

if ($result=mysqli_query($con,$sql))
  {
  // Get field information for all fields
  while ($fieldinfo=mysqli_fetch_field($result))
    {
    printf("Name: %s\n",$fieldinfo->name);
    printf("Table: %s\n",$fieldinfo->table);
    printf("max. Len: %d\n",$fieldinfo->max_length);
    }
  // Free result set
  mysqli_free_result($result);
}

mysqli_close($con);
?>
