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
    <title>Restaurant Profile</title>
    <link rel="stylesheet" href="../Profile/styles.css">
    <link rel="icon" href="../../img/component-img/foodDelivery.jpg" sizes="any">
</head>
<body>
<div class="profile-container">
    <div class="inner-sidebar">
        <h2>Profile Menu</h2>
        <ul>
            <li><button class="inner-sidebar-btn" onclick="showSection('profileSection')">Profile</button></li>
            <li><button class="inner-sidebar-btn" onclick="showSection('settingsSection')">Settings</button></li>
            <li><button class="inner-sidebar-btn" onclick="logout()">Logout</button></li>
        </ul>
    </div>
    <div class="content">
        <a class="logo-container" href="order.php">
            <img src="../../img/component-img/bhoklagyoLogo.jpg" class="logo" alt="logo">
        </a>
        <div id="profileSection" class="section" style="display: block;">
            <div class="profile-header">
                <img src="../../img/restaurant-img/aroma.jpg" alt="Logo" class="client-img">
                <h1>Aroma restaurant</h1>
                <p>Aromarestaurant@bhoklayo.com</p>
                <p>+977 9876543210</p>
            </div>
        </div>
        <div id="settingsSection" class="section" style="display: none;">
            <h2>Edit Profile</h2>
            <form id="editProfileForm">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="John Doe">
                <label for="phone">Contact no:</label>
                <input type="text" id="phone" name="phone" value="+977 9876543210">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="johndoe@example.com">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="Some Address">
                <label for="opening-hour">Opening hour:</label>
                <input type="text" id="opening-hour" name="opening-hour" value="10am">
                <label for="opening-days">Opening days:</label>
                <input type="text" id="opening-days" name="opening-days" value="Sun,Mon,Tues,Wed,Thurs,Fri">
                <label for="closing-hour">Closing hour:</label>
                <input type="text" id="closing-hour" name="closing-hour" value="8pm">
                <label for="itemImage">Image:</label>
                <input type="file" id="itemImage" name="itemImage" accept="image/*">
                <div class="btn-container"><button type="submit" class="btn">Save</button></div>
            </form>
        </div>
    </div>
</div>
<div id="overlay" class="overlay"></div>
<script src="../Profile/script.js"></script>
</body>

</html>
