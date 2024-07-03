<!DOCTYPE html>
<html lang="en">
<?php
include '../../../connection/connection.php';  //include connection file
error_reporting(0);  // using to hide undefined index errors
session_start(); //start temp session until logout/browser closed
session_cache_limiter("private_no_expire");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
 
if (!isset($_SESSION['r_id'])) {
    header('location: ../../../index.php');
    exit;
}
?>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Menu Items</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
<style>
* {
    margin: 0;
    padding: 0;
    font-family: Inria serif;
    box-sizing: border-box;
}
body {
    background-color: #f4f4f4;
}
main {
    display: flex;
    justify-content: center;
}
.container {
    margin-top: 100px;
    margin-bottom: 50px;
    width: 80%;
    background-color: #2E3B4E;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    color: white;
}
.container h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #FF7527;
}
form {
    display: flex;
    flex-direction: column;
}
label {
    margin-bottom: 8px;
    font-weight: bold;
}
input[type="text"], input[type="number"], textarea {
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
}
input[type="file"] {
    margin-top: 8px;
}
button {
    padding: 10px 20px;
    background-color: #FF7527;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 10px;
    width: fit-content;
    transition: background-color 0.3s ease;
}
button:hover {
    background-color: #e06b23;
}
</style>
<link rel="stylesheet" href="../styles/nav-styles.css">
<link rel="stylesheet" href="../styles/footer-styles.css">
<link rel="icon" href=../../img/component-img/foodDelivery.jpg sizes="any">
</head>
<body>
<header>
<nav>
<div class="logo">
<a href="order.php">
<img src="..\..\..\src\img\useless\logo.png" alt="Logo"/></a>
</div>
<div class="toggle-button" id="navbar-toggle">&#9776;</div>
<ul class="menu" id="navbar-links">
<?php
          if(isset($_SESSION['r_id'])){
            echo'
<li><a href="order.php">Orders</a></li>
<li><a href="menulist.php">Menu List</a></li>
<li><a href="delivery.php">Delivery</a></li>
<li><a href="restaurantsetting.php">Setting</a></li>
<li><a href="../login/logout.php">Signout</a></li>';}
          else {
            header('location: ../../../index.php');
          };?>
</ul>
</nav>
</header>
<main>
<div class="container">
<?php
        $d_name = $_GET['c'];
        $r_id = $_SESSION['r_id'];
        $sql = "SELECT * FROM dishes WHERE r_id = '$r_id' AND d_name = '$d_name'";
        $result = mysqli_query($db, $sql);
        if ($rows = mysqli_fetch_array($result)) {
            echo '<h1>Edit Menu Items</h1>
<form action="" method="post" id="menuForm" enctype="multipart/form-data">
<label for="itemName">Item Name:</label>
<input type="text" id="itemName" name="itemName" value ="' . $d_name . '" required>
<label for="itemDescription">Description:</label>
<textarea id="itemDescription" name="itemDescription" rows="4" required>' . $rows['description'] . '</textarea>
<label for="itemPrice">Price:</label>
<input type="number" id="itemPrice" name="itemPrice" min="0.01" step="0.01" value = "' . $rows['d_price'] . '" required>
<label for="image">Image:</label>
<input type="file" id="image" name="image">
<button type="submit" name="update">Update Item</button>
</form>';
        }
 
        if (isset($_POST['update'])) {
            $name = $db->real_escape_string($_POST['itemName']);
            $description = $db->real_escape_string($_POST['itemDescription']);
            $price = $db->real_escape_string($_POST['itemPrice']);
 
            // Handle image upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image_name = basename($_FILES['image']['name']);
                $upload_dir = 'src/img/special-img/'; // Adjust the upload directory as needed
                $image_path = $upload_dir . $image_name;
 
                // Check if the directory exists and create it if not
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
 
                if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                    // Update the database with the new image path
                    $stmt = $db->prepare('UPDATE dishes SET d_name = ?, d_price = ?, d_image = ?, description = ? WHERE d_id = ?');
                    $stmt->bind_param('ssssi', $name, $price, $image_path, $description, $rows['d_id']);
                    $stmt->execute();
                } else {
                    echo "Error uploading the file.";
                }
            } else {
                // No new image uploaded, use the existing image path
                $image_path = $rows['d_image'];
                $stmt = $db->prepare('UPDATE dishes SET d_name = ?, d_price = ?, d_image = ?, description = ? WHERE d_id = ?');
                $stmt->bind_param('ssssi', $name, $price, $image_path, $description, $rows['d_id']);
                $stmt->execute();
            }
 
            header('location: menulist.php');
            exit;
        }
        ?>
</div>
</main>
<footer>
<div class="footer-content-white" style="background:  #FF7527">
<div class="contact-info">
<h3>Need Help?</h3>
<p>📞 +977 9846098780</p>
<p>📧 Bhoklagyo@gmail.com</p>
</div>
<div class="about-info">
<h3>About us</h3>
<p>Contact us</p>
<p>Privacy policy</p>
</div>
</div>
<div class="footer-content-white">
<div class="social-links">
<p>© Bhok Lagyo</p>
<p>Follow us:</p>
<span>
<img src="../../img/social-icon-img/instagramLogo.jpg" alt="Instagram">
<img src="../../img/social-icon-img/facebookLogo.jpg" alt="facebook">
</span>
</div>
</div>
<div class="bottom-bar">
<p>Powered by: UMA Team</p>
</div>
</footer>
<script src="../../js/nav.script.js"></script>
</body>
</html>