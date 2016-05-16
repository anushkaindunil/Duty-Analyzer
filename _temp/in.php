
<html>
    
<head>
    
    <link href="index.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="common.css">  
    <style>
    .error {color: red;}
    </style>
	<script type="text/javascript">
            var monthtext = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];

            function populatedropdown(dayfield, monthfield, yearfield) {
                var today = new Date()
                var dayfield = document.getElementById(dayfield)
                var monthfield = document.getElementById(monthfield)
                var yearfield = document.getElementById(yearfield)

                for (var i = 0; i < 32; i++)
                        dayfield.options[i] = new Option(i, i + 1)
                dayfield.options[today.getDate()] = new Option(today.getDate(), today.getDate(), true, true) //select today's day
                for (var m = 0; m < 12; m++)
                        monthfield.options[m] = new Option(monthtext[m], monthtext[m])
                monthfield.options[today.getMonth()] = new Option(monthtext[today.getMonth()], monthtext[today.getMonth()], true, true) //select today's month
                var thisyear = today.getFullYear()
                for (var y = 0; y < 100; y++) {
                        yearfield.options[y] = new Option(thisyear, thisyear)
                        thisyear -= 1
                }
                yearfield.options[0] = new Option(today.getFullYear(), today.getFullYear(), true, true) //select today's year
            }
	</script>

</head>

<body>

<?php
mysql_connect ("localhost","root","");
mysql_select_db("ucsc");

// define variables and set to empty values
$fnameErr = $lnameErr = $unameErr = $genderErr = $emailErr = $cemailErr = $contactErr = $passwordErr = $cpasswordErr =  "";
$fname = $lname = $uname = $gender = $email = $cemail = $dateOFbirth = $position = $address = $contact = $password = $cpassword = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["fname"])) {
     $fnameErr = "First Name is required";
   } else {
     $fname = test_input($_POST["fname"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
       $fnameErr = "Only letters and white space allowed";
     }
   }
   if (empty($_POST["lname"])) {
     $lnameErr = "Last Name is required";
   } else {
     $lname = test_input($_POST["lname"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
       $lnameErr = "Only letters and white space allowed";
     }
   }
   if (empty($_POST["uname"])) {
     $unameErr = "User Name is required";
   } else {
     $uname = test_input($_POST["uname"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$uname)) {
       $unameErr = "Only letters and white space allowed";
     }
   }
   if (empty($_POST["gender"])) {
     $genderErr = "Gender is required";
   } else {
     $gender = test_input($_POST["gender"]);
   }
   
    if($_POST["email"] == $_POST["cemail"]){
        if (empty($_POST["email"])) {
          $emailErr = "Email is required";
        } else {
          $email = test_input($_POST["email"]);
          // check if e-mail address is well-formed
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
          }
        }
        if (empty($_POST["cemail"])) {
          $cemailErr = "Email is required";
        } else {
          $cemail = test_input($_POST["cemail"]);
          // check if e-mail address is well-formed
          if (!filter_var($cemail, FILTER_VALIDATE_EMAIL)) {
            $cemailErr = "Invalid email format";
          }
        }
    }else{
        $cemailErr = "Emails are different";   
    }
   
   $dateOFbirth = test_input($_POST["dateOFbirth"]);
   $position = test_input($_POST["position"]);
   $address = test_input($_POST["address"]);
   
   if (empty($_POST["contact"])) {
     $contactErr = "Contact is required";
   } else {
     $contact = test_input($_POST["contact"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[0-9]*$/",$contact)) {
       $contactErr = "Only numbers are allowed";
     }
   }
    if($_POST["password"] == $_POST["cpassword"]){
        if (empty($_POST["password"])) {
          $passwordErr = "Password is required";
        }elseif (strlen($password) > 5) {
          $passwordErr = "Password should greater than 5 characters";   
        }
         else {
          $password = test_input($_POST["password"]); 
          $password = md5($password);
        } 
        if (empty($_POST["cpassword"])) {
          $cpasswordErr = "Password is required";
        }elseif (strlen($cpassword) > 5) {
          $cpasswordErr = "Password should greater than 5 characters";   
        }
         else {
          $cpassword = test_input($_POST["cpassword"]); 
          $cpassword = md5($cpassword);
        }
    }else{
        $cpasswordErr = "Passwords are different"; 
    }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
mysql_query("INSERT INTO `users` (`id`,`fname`,`lname`,`uname`,`email`,`password`,`gender`,`position`,`dateOFbirth`,`address`,`contact`) VALUES (NULL,'$fname','$lname','$uname','$email','$password','$gender','$position','$dateOFbirth ','$address','$contact' )") or die(mysql_error());
			
?>

<h2>User Registration Form</h2>
<p><span class="error">* required field.</span></p>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    
   First Name: <input type="text" name="fname" value="<?php echo $fname;?>">
   <span class="error">* <?php echo $fnameErr;?></span>
   <br><br>
   Last Name: <input type="text" name="lname" value="<?php echo $lname;?>">
   <span class="error">* <?php echo $lnameErr;?></span>
   <br><br>
   User Name: <input type="text" name="uname" value="<?php echo $uname;?>">
   <span class="error">* <?php echo $unameErr;?></span>
   <br><br>
   Gender:
   <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?>  value="female">Female
   <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?>  value="male">Male
   <span class="error">* <?php echo $genderErr;?></span>
   <br><br>
   E-mail: <input type="email" name="email" value="<?php echo $email;?>">
   <span class="error">* <?php echo $emailErr;?></span>
   <br><br>
   Confirm e-mail: <input type="email" name="cemail" value="<?php echo $cemail;?>">
   <span class="error">* <?php echo $cemailErr;?></span>
   <br><br>
   Date of Birth:
    <select id="daydropdown"></select> <select id="monthdropdown"></select><select id="yeardropdown"></select> 
        <script type="text/javascript" name="dateOFbirth">
            window.onload = function() {
                populatedropdown("yeardropdown", "monthdropdown", "daydropdown")
            }
        </script>
   <br><br>
   Position: <select name="position" value="<?php echo $position;?>"><option></option><option>Main manager</option><option>Project manager</option><option>Team leader</option><option>Team member</option></select>
   <br><br>
   Address: <input type="text" name="address" value="<?php echo $address;?>">
   <br><br>
   Contact No: <input type="tel" name="contact" value="<?php echo $contact;?>">
   <span class="error">* <?php echo $contactErr;?></span>
   <br><br>
   Password: <input type="password" name="password" value="<?php echo $password;?>">
   <span class="error"><?php echo $passwordErr;?></span>
   <br><br>
   Confirm Password: <input type="password" name="cpassword" value="<?php echo $cpassword;?>">
   <span class="error"><?php echo $cpasswordErr;?></span>
   <br><br>
   
   <input type="submit" name="submit" value="Submit">
</form>





</body>
</html>