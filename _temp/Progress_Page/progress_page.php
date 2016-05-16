<html>
<head>
<link rel="stylesheet" type="text/css" href="common.css">
<title>Display Record</title>
<link href="display_record.css" type="text/css" rel="stylesheet" />
<link href="view.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="top_common">
<div id="arrow"><table><tr><td><a href="main_manager.php"><img src="img/h2.png"></a></td><td align="right"><button><a href="logout.php">LOGOUT</a></button></td></tr></table></div>
</div>  
<?php
//connect to the server
$link = mysql_connect('localhost', 'root', ''); 
if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
}

//connect to the database
mysql_select_db('ucsc'); 

//query the database
$query = mysql_query("SELECT * FROM users");

//fetch the results / convert results into an array

        WHILE($rows = mysql_fetch_array($query)):
        
            $name = $rows['fname'];
           
          
        ?>
        <center>
        <table>
        <tr><td><a href="#"><div id="padd"><?php echo "$name"; ?></div></a></tr></td>
       
        </table>
        </center>
        <?php

        endwhile;
?>


<body>
</html>