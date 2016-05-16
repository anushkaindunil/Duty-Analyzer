<?php
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profilePic"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
    if(isset($_POST["submit"])) {
        $check = @getimagesize($_FILES["profilePic"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } 
    }
    if ($uploadOk == 1) {
        if(move_uploaded_file($_FILES["profilePic"]["tmp_name"], $target_file)) {
            $path = "uploads/".basename( $_FILES["profilePic"]["name"]);
        }
    }


	mysql_connect ("localhost","root","");
	mysql_select_db("ucsc");

	function test_input($data) {
	   $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	if(isset($_POST['submit'])){	

		$empid = test_input($_POST['empid']);
		$fname = test_input($_POST['fname']);
		$lname = test_input($_POST['lname']);
		$uname = test_input($_POST['uname']);

		$gender = test_input($_POST['gender']);
		$email = test_input($_POST['email']);
		$cemail = test_input($_POST['cemail']);
	    
		$dateOFYear = test_input($_POST['dateOFYear']);
	    $dateOFMonth = test_input($_POST['dateOFMonth']);
	    $dateOFDay = test_input($_POST['dateOFDay']);
	    
	    if($dateOFMonth == 'Jan'){
	        $dateOFMonth = '01';
	    }else if($dateOFMonth == 'Feb'){
	        $dateOFMonth = '02';
	    }else if($dateOFMonth == 'Mar'){
	        $dateOFMonth = '03';
	    }else if($dateOFMonth == 'Apr'){
	        $dateOFMonth = '04';
	    }else if($dateOFMonth == 'May'){
	        $dateOFMonth = '05';
	    }else if($dateOFMonth == 'Jun'){
	        $dateOFMonth = '06';
	    }else if($dateOFMonth == 'Jul'){
	        $dateOFMonth = '07';
	    }else if($dateOFMonth == 'Aug'){
	        $dateOFMonth = '08';
	    }else if($dateOFMonth == 'Sep'){
	        $dateOFMonth = '09';
	    }else if($dateOFMonth == 'Oct'){
	        $dateOFMonth = '10';
	    }else if($dateOFMonth == 'Nov'){
	        $dateOFMonth = '11';
	    }else if($dateOFMonth == 'Dec'){
	        $dateOFMonth = '12';
	    }

	    $set = $dateOFYear."-".$dateOFMonth."-".$dateOFDay;
	    $x = (string)$set;
	    $y = strtotime($x);
	    $dob = date("Y-m-d", $y);

		$position = test_input($_POST['position']);
		$address = test_input($_POST['address']);

		$contact = test_input($_POST['contact']);
		$$address = test_input($_POST['address']);
	
		$password = test_input($_POST['password']); 
		$pwd = md5($password);
		$cpassword = test_input($_POST['cpassword']);
	    $profilePic = $path;

		mysql_query("INSERT INTO `users` (`id`,`fname`,`lname`,`uname`,`profilePic`,`email`,`password`,`gender`,`position`,`dateOFbirth`,`address`,`contact`) VALUES ('$empid','$fname','$lname','$uname','$profilePic','$email','$pwd','$gender','$position','$dob ','$address','$contact' )") or die(mysql_error());
		
	}

?>

<script type="text/javascript">
	alert("User Register Successful...!!!");
	window.location.href="Reg_Final.php";
</script>

<html>
	<head>
		
	</head>
	<body>
		
	</body>
</html>