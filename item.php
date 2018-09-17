<?php
session_start();
if (!isset($_SESSION["uname"])) {
    session_unset();
    session_destroy();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Swyftshare</title>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>
<link href="css/itemstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php include "nav.php";?>
<?php include "sidemenu.php";?>
<div class="display">
<div class="content">
    <?php
    $itemid = $_GET["id"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "swyftshare";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT title, price, description, zipcode, imgpath, poster
        FROM item
        WHERE id = '$itemid'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo "<div style='width:400px; height:400px; margin-left:15px; margin-top:30px; float: left; border:1px solid grey; background-image:url(\"" . $row["imgpath"] . "\"); background-size:contain; background-repeat:no-repeat; background-position:center;'></div>
    <div class='top-right'>
        <h3 style='margin:0;'>" . $row["title"] . "</h3>
        Posted by: <a href='#'>" . $row["poster"] . "</a><br>
        Price: $" . $row["price"] . "<br>
        ZIP Code: " . $row["zipcode"] .
        "<div class='button-rent'>
            <a href='#'>Rent</a>
        </div>
    </div>
    <div class='bottom'>
        <b>Product Description</b><br>" .
        $row["description"] .
    "</div>";

    $conn->close();
    ?>
</div>
</div>
<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
