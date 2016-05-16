<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
   
<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("one").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("one").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","getuser_view.php?q="+str,true);
        xmlhttp.send();
    }
}
//
function showU(str) {
    if (str == "") {
        document.getElementById("two").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("two").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","mm_uview.php?r="+str,true);
        xmlhttp.send();
    }
}

</script>

<link rel="stylesheet" type="text/css" href="common.css">
<title>Display Record</title>
<link href="display_record.css" type="text/css" rel="stylesheet" />
<link href="u_view.css" type="text/css" rel="stylesheet" />
<link href="view.css" type="text/css" rel="stylesheet" />
</head>
<body>
  <div>
<div id="top_common">
<div id="arrow"><table><tr><td><a href="main_manager.php"><img src="img/h2.png"></a></td><td id="Header_topic">Users Details</td><td align="right"><button><a href="index.php">LOGOUT</a></button></td></tr></table></div>
</div>
<ol class="breadcrumb">
    <li><a href="main_manager.php">Home</a></li>
    <li class="active">Users View</li>
           
  </ol>
<table><tr height="60px"><td width="350px"><font size="5px">Position :</font></td><td><select name="users" onchange="showUser(this.value)"><option></option><option>Project Manager</option><option>Developer</option><option>Business Analyst (BA)</option><option>Quality Assuarance (QA)</option></select></td></tr>
</table>
</div>
<div>
<div id="one" > 

</div>
<div id="two" >


</div>
</div>
<body>
</html>