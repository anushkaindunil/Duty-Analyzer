<?php

  $con = mysql_connect("localhost","root","") or die(mysql_error());

  mysql_select_db("ucsc",$con) or die(mysql_error());

  $sql = "SELECT * FROM users";

  $query = mysql_query($sql) or die(mysql_error());



?>
<html>
<head>
  <title>Table_modify</title>
  <style>

    table, th, td { 
        border: 1px solid black;/*Add boder*/
        border-collapse: collapse;
        
    }
    th, td {
        padding: 10px;
    }


    table {
      border-spacing: 5px;
    }
    table {
      text-align: center;
    }

    /*table#t01 {
      width: 100%; 
      background-color: #f1f1c1;
    }*/
    
table#t01 tr:nth-child(even) {
    background-color: #eee;
}
table#t01 tr:nth-child(odd) {
   background-color:#fff;
}
table#t01 th  { /* chenge <th> row */
    background-color: black;/*row background colour*/
    color: blue; /*row letter colour*/
}

</style>
</head>

<body>

<table id="t01"  width="80%" >
  <tr>
    <th>ID</th>  
    <th>First_name</th>
    <th>Last_name</th>
    <th>Select</th>

  </tr>

  <?php while($row = mysql_fetch_array($query)){ ?>

  <tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['fname']; ?></td>
    <td><?php echo $row['lname']; ?></td>
    <td><input type="radio" ></td>
   

  </tr>

  <?php } ?>
  
<table>

</body>

</html>