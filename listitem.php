<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Swyftshare</title>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>
<link href="css/listitemstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
if(isset($_POST["submit"])) {
    $file_name = $_FILES["fileToUpload"]["name"];
    $file_type = $_FILES["fileToUpload"]["type"];
    $file_size = $_FILES["fileToUpload"]["size"];
    $file_tmp_name = $_FILES["fileToUpload"]["tmp_name"];
    $target_dir = "images/";
    $target_file = $target_dir . basename($file_name);
    $uploadOK = 0;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    if ($file_name == "") {
        echo "<script>alert('Please Select an Image');</script>";
        exit();
    } else {
        move_uploaded_file($file_tmp_name, $target_file);
        $uploadOK = 1;
    }

    if ($uploadOK == 1) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "swyftshare";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO item (title, price, category, description, imgpath, zipcode, poster)
            VALUES ('$_POST[title]', '$_POST[price]', '$_POST[category]', '$_POST[description]', '$target_file', '$_POST[zipcode]', '$_SESSION[uname]')";
        if ($conn->query($sql) == TRUE) {
            echo "<script>
                alert('You have listed your item successfully!');
                window.location = 'index.php';
            </script>";
        } else {
            echo "<script>
                var sql = '<?php echo $sql; ?>';
                var connError = '<?php echo $conn->error; ?>';
                alert('Error: ' + sql + '\n' + connError);
            </script>";
        }

        $conn->close();
    }
}
?>
<?php include "nav.php";?>
<?php include "sidemenu.php";?>
<div class="display">
<div class="content">
    <div class="box-listitem">
        <h3>List an Item</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"  enctype="multipart/form-data">
            Item Title<br>
            <input type="text" name="title" size="58"><br><br>
            Price $<br>
            <input type="text" name="price" size="58"><br><br>
            <select name="category">
                <option value="default">-Select Category-</option>
                <option value="Electronics">Electronics</option>
                <option value="Automotives">Automotives</option>
                <option value="Books">Books</option>
                <option value="Home & Garden">Home & Garden</option>
                <option value="Fashion">Fashion</option>
                <option value="Outdoors">Outdoors</option>
            </select><br><br>
            Upload Picture<br>
            <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
            Description<br>
            <textarea name="description" rows="6" cols="52"></textarea><br><br>
            Zipcode<br>
            <input type="text" name="zipcode" size="58"><br><br>
            <input type="submit" name="submit" value="List Item!">
        </form>
        <p>By listing an item, you agree to Airtonics.com's <a href="#">Terms of Use</a> and <a href="#">Privacy Notice</a>.</p>
    </div>
</div>
<?php include "footer.php";?>
</div>
<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>