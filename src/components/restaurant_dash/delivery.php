<!DOCTYPE html>
<html lang="en" class="root">
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
    <title>Delivery</title>
<style>
/* Main container styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.root {
    width: 100vw;
    height: 100vh;
    overflow-x: hidden;
}

header{
    width: 100%;
    height :10%
}
body {
    width: 100%;
    height: 100%;
    font-family: Arial, sans-serif;
    background-color: white;
}

.container {
    max-width: 800px;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}
main{
    display: flex;
   justify-content: center;
   flex-direction: column;
    margin-top: 50px;
    margin-bottom: 50px;
    align-items: center;
}
/* Order styles */
.order {
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    transition: scale 0.3s ease;
}
.order:hover{
    scale: 1.1;
}
.order-header {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    flex-direction:column;
}

.order-header h2 {
    color: #555;
}

.order-details {
    margin-bottom: 10px;
}

.order-items {
    list-style-type: none;
    padding: 0;
}

.order-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
}

.cancel-button {
    background-color: #FF5722;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
}

.cancel-button:hover {
    background-color: #E64A19;
}
.confirm-button {
    background-color: darkgreen;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
}

.confirm-button:hover {
    background-color: green;
}

.reason-dropdown {
    margin-left: 10px;
    padding: 6px;
    border-radius: 4px;
    border: 1px solid #ccc;
}

.order-total {
    font-weight: bold;
    text-align: right;
}
.order-link {
    font-size:25px;
    margin-bottom: 10px;
    color:blue;
}
.order-link a{
    color:blue;
}
.order-link a:hover{
    color:#FF7527;
    cursor: pointer;
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
            <a href="../../components/login/index.html"><img src="../../img/component-img/logo.png" alt="Logo"></a>
        </div>
        <div class="toggle-button" id="navbar-toggle">&#9776;</div>
        <ul class="menu" id="navbar-links">
            <li><a href="order.php">Orders</a></li>
          <li><a href="menulist.php">Menu List</a></li>
            <li><a href="delivery.php">Delivery</a></li>
            <li><a href="restaurantsetting.php">Setting</a></li>
            <li><a href="">Signout</a></li>
        </ul>
    </nav>
</header>
<main>
    <div class="container">
        <h1>Today's Orders</h1>
        <div class="order" id="order">
            <div class="order-header">
                <p class="order-link"><a href="orderStatus.php">Order #12345</a></p>
                <p><strong>Total:</strong> 850.00</p>
            </div>
        </div>
        <div class="order" id="order2">
            <div class="order-header">
               <p class="order-link">  <a href="orderStatus.php">Order #54321</a></p>
                <p><strong>Total:</strong> 650.00</p>
            </div>
        </div>
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
<!--logic gar ki when to cancel a mail goes telling the order is cancel for the selcted reason-->
</body>

</html>
