<!DOCTYPE html>
<html lang="en">
<?php
 include '../../../connection/connection.php';  //include connection file
error_reporting(0);  // using to hide undefine undex errors
session_start(); //start temp session until logout/browser closed
session_cache_limiter("private_no_expire");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu Items</title>
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
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
    <link rel="icon" href="../../img/component-img/foodDelivery.jpg" sizes="any">
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
        <h1>Edit Menu Items</h1>
        <form id="menuForm" >
            <label for="itemName">Item Name:</label>
            <input type="text" id="itemName" name="itemName" required>

            <label for="itemDescription">Description:</label>
            <textarea id="itemDescription" name="itemDescription" rows="4" required></textarea>

            <label for="itemPrice">Price:</label>
            <input type="number" id="itemPrice" name="itemPrice" min="0.01" step="0.01" required>

            <label for="itemImage">Image:</label>
            <input type="file" id="itemImage" name="itemImage" accept="image/*" required>

            <button type="submit">Update Item</button>
        </form>
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
