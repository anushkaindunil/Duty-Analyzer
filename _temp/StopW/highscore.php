
<?php
define('DB_NAME', 'ucsc');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

if (!$link) { die('could not connect: ' . mysql_error()); }

$db_selected = mysql_select_db(DB_NAME, $link);

if (!$db_selected) { die('can not use ' . DB_NAME . ': ' . mysql_error()); }
print_r($_POST);
$sql="INSERT INTO time (name, company, email, c_time) VALUES
    ('".$_POST['name']."','".$_POST['company']."','".$_POST['email']."','".$_POST['counter']."')";

if (!mysql_query($sql)) { die('Error: ' . mysql_error()); }

mysql_close();

?>