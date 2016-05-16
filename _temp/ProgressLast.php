<?php
  $con = mysql_connect("localhost","root","") or die(mysql_error());

  mysql_select_db("ucsc",$con) or die(mysql_error());

  $sql = "SELECT p_val FROM `pro`WHERE Id = '3'";/*We get p_val from pro table where id is 3*/
  $query = mysql_query($sql) or die(mysql_error());/*This is a object like a data but we cannnot access this.*/

  $result = mysql_fetch_assoc($query);/*now we get that value to array and can use it*/

  //echo "<progress max='100' value='" . $result['p_val'] . "'></progress>";/*this is value of array $result['p_val']*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $result['p_val'] ?>%">
      <?php echo $result['p_val'] ?>
    </div>
  </div>
</div>

</body>
</html>
