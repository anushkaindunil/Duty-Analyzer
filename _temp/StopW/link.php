
<?php
define('DB_NAME', 'dbname');
define('DB_USER', 'user');
define('DB_PASSWORD', 'pass');
define('DB_HOST', 'host');

$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

if (!$link) { die('could not connect: ' . mysql_error()); }

$db_selected = mysql_select_db(DB_NAME, $link);

if (!$db_selected) { die('can not use ' . DB_NAME . ': ' . mysql_error()); }

$sql="INSERT INTO game (name, company, email, time) VALUES
    ('".$_POST['name']."','".$_POST['company']."','".$_POST['email']."','".$_POST['time']."')";

if (!mysql_query($sql)) { die('Error: ' . mysql_error()); }

mysql_close();

?>