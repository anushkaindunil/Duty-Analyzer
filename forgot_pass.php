<?php
session_start();
$servername = "localhost";
$usernam = "root";
$password = "";
$dbname = "ucsc";

// Create connection
$conn = mysqli_connect($servername, $usernam, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "
	<form action='forgot_pass.php' method ='POST'>
		Enter your username:<br><input name='username' type='text'><p>
		Enter your Email   :<br><input name='email' type='text'><p>
		<input name='submit' type='submit' value='Submit'>
	</form>
";

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	echo "$username";
	echo "$email";

	$sql = "SELECT * FROM users WHERE uname='$username'";
	$result = mysqli_query($conn, $sql);

	@$numrow = mysqli_num_rows($result);
	echo "$numrow";

	if ($numrow != 0) {
		while ($row = mysqli_fetch_assoc($result)) {
				$db_email = $row['email'];
		}
		if ($email == $db_email) {
			$code = rand(10000,99999);

			$to = $db_email;
			$subject = "Password Reset";
			$body = "
				This is an automated email. Please do not reply to this email.
				Click the link below or paste it into your browser.
				http://localhost/s/forgot_pass.php?passreset=$code&uname=$username
			";

			$headers = "From: anushkaindunil92@gmail.com";

			$sql2 = "UPDATE users SET passreset='$code' WHERE uname='$username'";
			mysqli_query($conn, $sql2);

			$send=mail("anushkaindunil92@gmail.com", $subject, $body, $headers);

			if ($send) {
				echo "yes";
			}else{
				echo "No";
			}

		}else{
			echo "Email is incorrect";
		}	
	}else{
		echo "That username doesn't exist";
	}
}

?>