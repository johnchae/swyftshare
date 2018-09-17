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
<link href="css/indexstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php include "nav.php";?>
<?php include "sidemenu.php";?>
<div class="display">
<div class="content">
    <div class="nav-content">
        <div class="for-rent"><a href="#">For Rent</a></div>
        <div class="requests"><a href="#">Requests</a></div>
        <div class="location">
            Sort by: <select>
                <option>Relevance</option>
                <option>Price</option>
                <option>Location</option>
                <option>Date Added</option>
            </select>
        </div>
        <div class="view">
            View: <select>
                <option>Gallery</option>
                <option>List</option>
            </select>
        </div>
    </div>
    <div class="view-item">
        <br>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "swyftshare";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT id, title, price, description, zipcode, imgpath, poster FROM item";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='item'>
                    <div class='itemimage' style='width:200px; height:200px; border:1px solid grey;'>
                        <a href='item.php?id=" . $row["id"] . "'><img src='" . $row["imgpath"] . "' style='max-width:100%; max-height:100%;'></a>
                    </div>
                    <a href='item.php?id=" . $row["id"] . "'>" . $row["title"] . "</a><br>
                    Price: $" . $row["price"] .
                "</div><br>";
            }
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
    </div>
</div>
</div>
<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
