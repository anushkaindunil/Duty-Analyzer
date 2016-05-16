<?php

  $con = mysql_connect("localhost","root","") or die(mysql_error());

  mysql_select_db("ucsc",$con) or die(mysql_error());

  $sql = "SELECT p_val FROM `pro`WHERE Id = '4'";/*We get p_val from pro table where id is 3*/
  $query = mysql_query($sql) or die(mysql_error());/*This is a object like a data but we cannnot access this.*/

  $result = mysql_fetch_assoc($query);/*now we get that value to array and can use it*/

  //echo "<progress max='100' value='" . $result['p_val'] . "'></progress>";/*this is value of array $result['p_val']*/
?>
<html>

<head>


<link rel="stylesheet" type="text/css" href="view.css">

</head>

<body>
<div id="Pro">
Time allocation:

<progress value= <?php echo $result['p_val'] ?> max="100">
</progress>

</div>
</body>
</html>



