<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Log in to Swyftshare</title>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>
<link href="css/loginstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
$uname = "";
$pword = "";
$unameErr = "";
$pwordErr = "";
$invalid = "";

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
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

if (isset($_POST["submit"]) && $unameErr == "" && $pwordErr == "") {
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "swyftshare";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT password
		FROM user
		WHERE username = '$uname'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	if (password_verify($pword, $row["password"])) {
		session_start();
		$_SESSION["uname"] = $uname;
		echo "<script>window.location = 'index.php';</script>";
	} else {
		$invalid = "Username or Password is incorrect";
	}

	$conn->close();
}
?>
<?php include "nav.php";?>
<?php include "sidemenu.php";?>
<div class="display">
<div class="content">
	<div class="box-login">
    	<h3>Log in</h3>
		<p style="color:red;">
			<?php
			if ($unameErr != "") {
				echo "* $unameErr<br>";
			}
			if ($pwordErr != "") {
				echo "* $pwordErr<br>";
			}
			if ($invalid != "") {
				echo "* $invalid<br>";
			}
			?>
		</p>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        	Username<br>
            <input type="text" name="uname" value="<?php echo $uname; ?>" size="58"><br><br>
            Password<br>
            <input type="password" name="pword" size="58"><br><br>
            <input type="submit" name="submit" value="Log in">
    	</form>
        <p>
        	<a href="#" onclick="forgot()">Forgot Password?</a><br>
        	<a href="#" onclick="forgot()">Forgot Username?</a>
        </p>
        <p>By signing in, you agree to Airtonics.com's <a href="#">Terms of Use</a> and <a href="#">Privacy Notice</a>.</p>
    </div>
</div>
<?php include "footer.php";?>
</div>
<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script src="js/main.js"></script>
<script>
	var forgot = function() {
		alert("That's too bad :[ Make another account!");
	}
</script>
</body>
</html>
