<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Register with Swyftshare</title>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>
<link href="css/registerstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
$uname = "";
$pword = "";
$email = "";
$phonenumber = "";
$unameErr = "";
$pwordErr = "";
$emailErr = "";
$phonenumberErr = "";
$required = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["uname"])) {
    	$unameErr = "Username is required";
	} else {
    	$uname = test_input($_POST["uname"]);
	}
	if (empty($_POST["pword"])) {
		$pwordErr = "Password is required";
	} else {
    	$pword = test_input($_POST["pword"]);
	}
	if (empty($_POST["email"])) {
    	$emailErr = "Email is required";
	} else {
    	$email = test_input($_POST["email"]);
    	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    		$emailErr = "Invalid email format"; 
		}
	}
	if (empty($_POST["phonenumber"])) {
    	$phonenumberErr = "";
	} else {
    	$phonenumber = test_input($_POST["phonenumber"]);
	}
}
if ($unameErr != "" || $pwordErr != "" || $emailErr != "" || $phonenumberErr != "") {
	$required = "* required field.";
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

if (isset($_POST["submit"]) && $unameErr == "" && $pwordErr == "" && $emailErr == "" && $phonenumberErr == "") {
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "swyftshare";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$passwordhash = password_hash($pword, PASSWORD_DEFAULT);
	password_verify($pword, $passwordhash);

	$sql = "INSERT INTO user (username, password, email, phone_number)
		VALUES ('$uname', '$passwordhash', '$email', '$phonenumber')";
	if ($conn->query($sql) == TRUE) {
	    echo "<script>
	    	alert('You have been registered successfully!');
	    	window.location = 'login.php';
	    </script>";
	} else {
		echo "Error: $sql<br>$conn->error";
	}

	$conn->close();
}
?>
<?php include "nav.php";?>
<?php include "sidemenu.php";?>
<div class="display">
<div class="content">
	<div class="box-register">
    	<h3>Register</h3>
   		<p style="color:red;"><?php
   			echo $required;
   		?></p>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        	Username <span style="color:red; font-weight:normal;">* <?php echo $unameErr; ?></span><br>
            <input type="text" name="uname" size="58"><br><br>
            Password <span style="color:red; font-weight:normal;">* <?php echo $pwordErr; ?></span><br>
            <input type="password" name="pword" size="58"><br><br>
            Confirm Password<br>
            <input type="password" name="pwordagain" size="58"><br><br>
            Email <span style="color:red; font-weight:normal;">* <?php echo $emailErr; ?></span><br>
            <input type="text" name="email" size="58"><br><br>
            Confirm Email<br>
            <input type="text" name="emailagain" size="58"><br><br>
            Mobile Phone Number (optional)<br>
            <input type="text" name="phonenumber" size="58"><br><br>
            <input type="submit" name="submit" value="Register">
    	</form>
        <p>By creating an account, you agree to Airtonics.com's <a href="#">Terms of Use</a> and <a href="#">Privacy Notice</a>.</p>
    </div>
</div>
<?php include "footer.php";?>
</div>
<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
