<!DOCTYPE html>
<html lang="en" class="root">
<?php
include '../../../connection/connection.php';  // Include connection file
error_reporting(0);  // Using to hide undefined index errors
session_start(); // Start temp session until logout/browser closed
session_cache_limiter("private_no_expire");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <style>
    /* General Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Inria serif;

    }
 
    /* General Body Styles */
    body {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #141a26;
        overflow-y: scroll;
    }
 
    .root {
        width: 100vw;
        height: 100vh;
        overflow-x: hidden;
        overflow-y: scroll;
    }
 
    .profile-container {
        display: flex;
        flex-direction: column;
        background-color: #f0f0f0;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 90%;
        max-width: 800px;
        margin: 20px;
        overflow: auto;
    }
 
    .inner-sidebar {
        flex: 1;
        margin-bottom: 20px;
        background-color: #ff7f22;
        padding: 10px;
        border-radius: 10px;
    }
 
    .inner-sidebar h2 {
        margin-bottom: 20px;
        font-size: 20px;
        color: #ffffff;
        text-align: center;
    }
 
    .logo-container {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
    }
 
    .logo {
        height: 100px;
        aspect-ratio: 4/3;
    }
 
    .inner-sidebar ul {
        list-style-type: none;
        padding: 0;
    }
 
    .inner-sidebar-btn {
        display: block;
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        background-color: white;
        color: #2c2f33;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        text-align: center;
        transition: scale 0.3s ease;
    }
 
    .inner-sidebar-btn:hover {
        filter: drop-shadow(#ffffff 1px 1px 6px);
        scale: 1.1;
    }
 
    .content {
        padding: 20px;
        border-radius: 10px;
        background-color: #ffffff;
        overflow-y: auto;
        height: 100%;
        max-height: 80vh;
    }
 
    .profile-header {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 5px;
    }
 
    .client-img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin-bottom: 10px;
        filter: drop-shadow(black 1px 1px 5px);
    }
 
    h1 {
        font-size: 24px;
        margin-bottom: 5px;
        color: #000000;
    }
    h2 {
        margin-bottom: 10px;
    }
    p {
        font-size: 16px;
        margin-bottom: 1px;
        color: black;
    }
 
    .btn-container {
        width: calc(100% - 20px);
        display: flex;
        justify-content: flex-end;
    }
 
    .btn {
        display: block;
        width: 100%;
        max-width: 150px;
        padding: 10px;
        background-color: #ff7f22;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }
 
    .btn:hover {
        background-color: #e6731c;
    }
 
    form label {
        display: block;
        margin-top: 10px;
        color: #000000;
    }
 
    form input {
        width: calc(100% - 20px);
        padding: 8px;
        margin-top: 5px;
        margin-bottom: 10px;
        border: 1px solid #cccccc;
        border-radius: 5px;
    }
 
    ul {
        list-style-type: none;
        padding: 0;
    }
 
    ul li {
        padding: 10px;
    }
 
    .section {
        display: none;
    }
 
    #profileSection {
        display: block;
    }
 
    @media (min-width: 600px) {
        .profile-container {
            flex-direction: row;
        }
 
        .inner-sidebar {
            margin-right: 5%;
            margin-bottom: 0;
        }
 
        .content {
            padding: 5%;
            flex: 3;
        }
    }
    </style>
</head>
<body>
<div class="profile-container">
    <div class="inner-sidebar">
        <h2>Profile Menu</h2>
        <ul>
            <li><button class="inner-sidebar-btn" onclick="showSection('profileSection')">Profile</button></li>
            <li><button class="inner-sidebar-btn" onclick="showSection('settingsSection')">Settings</button></li>
            <a href = ../login/logout.php style = 'text-decoration: none'><li><button class="inner-sidebar-btn" onclick="logout()">Logout</button></li>
        </a></ul>
    </div>
    <div class="content">
        <a class="logo-container" href="order.php">
            <img src="../../img/component-img/bhoklagyoLogo.jpg" class="logo" alt="logo">
        </a>
        <div id="profileSection" class="section" style="display: block;">
            <div class="profile-header">
                <?php
                $r_id = $_SESSION["r_id"];
                $sql = "SELECT * FROM restaurant WHERE r_id = '$r_id'";
                $result = mysqli_query($db, $sql);
                $row = mysqli_fetch_array($result);
                if (is_array($row)) {
                    if (is_null($row['r_img'])) {
                        echo '<img src="../../img/restaurant_img/defaultrestaurant.png" alt="' . htmlspecialchars($row['r_name']) . '" class="client-img">';
                    } else {
                        echo '<img src="../../../' . htmlspecialchars($row['r_img']) . '" alt="' . htmlspecialchars($row['r_name']) . '" class="client-img">';
                    }
                    echo '<h1>' . htmlspecialchars($row['r_name']) . '</h1>
                          <p>' . htmlspecialchars($row['r_email']) . '</p>
                          <p>+977 ' . htmlspecialchars($row['r_contact']) . '</p>';
                }
                ?>
            </div>
        </div>
        <div id="settingsSection" class="section" style="display: none;">
           <?php
           echo '<h2>Edit Restaurant Profile</h2>
           <form method="post" id="editProfileForm" enctype="multipart/form-data">
                <label for="name">Name:</label>
                <input type="text" id="name" name="r_name" value="' . htmlspecialchars($row['r_name']) . '">
                <label for="phone">Contact no:</label>
                <input type="text" id="phone" name="r_contact" value="' . htmlspecialchars($row['r_contact']) . '">
                <label for="email">Email:</label>
                <input type="email" id="email" name="r_email" value="' . htmlspecialchars($row['r_email']) . '">
                <label for="address">Address:</label>
                <input type="text" id="address" name="r_address" value="' . htmlspecialchars($row['r_address']) . '">
                <label for="opening-hour">Opening hour:</label>
                <input type="text" id="opening-hour" name="r_openingHrs" value="' . htmlspecialchars($row['r_openingHrs']) . '">
                <label for="opening-days">Opening days:</label>
                <input type="text" id="opening-days" name="r_openingDays" value="' . htmlspecialchars($row['r_openingDays']) . '">
                <label for="closing-hour">Closing hour:</label>
                <input type="text" id="closing-hour" name="r_closingHrs" value="' . htmlspecialchars($row['r_closingHrs']) . '">
                <label for="restaurantimage">Image:</label>
                <input type="file" id="restaurantimage" name="restaurantimage">
                <div class="btn-container"><button type="submit" name="update" class="btn">Save</button></div>
           </form>';
           if (isset($_POST['update'])) {
                // Handle file upload
                $file = $_FILES['restaurantimage'];
                if ($file['size'] > 0 && $file['size'] <= 5000000) {
                    $allowed_extensions = ['jpg', 'jpeg', 'png'];
                    $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                    if (in_array($file_extension, $allowed_extensions)) {
                        $file_path = "src/img/restaurant-img/" . $file['name'];
                        if (move_uploaded_file($file['tmp_name'], "../../../" . $file_path)) {
                            $update_img = "UPDATE restaurant SET r_img = '$file_path' WHERE r_id = '$r_id'";
                            mysqli_query($db, $update_img);
 
                        } 
                    } 
                }
                // Update restaurant info
                $r_name = mysqli_real_escape_string($db, $_POST['r_name']);
                $r_contact = $_POST['r_contact'];
                // Remove the prefix if it exists
                if (strpos($r_contact, '+977') === 0) {
                    $r_contact = substr($r_contact, 5);
                }
                $r_contact = mysqli_real_escape_string($db, $r_contact);
                $r_email = mysqli_real_escape_string($db, $_POST['r_email']);
                $r_address = mysqli_real_escape_string($db, $_POST['r_address']);
                $r_openingHrs = mysqli_real_escape_string($db, $_POST['r_openingHrs']);
                $r_openingDays = mysqli_real_escape_string($db, $_POST['r_openingDays']);
                $r_closingHrs = mysqli_real_escape_string($db, $_POST['r_closingHrs']);
                $update_query = "UPDATE restaurant SET r_name='$r_name', r_contact='$r_contact', r_email='$r_email', r_address='$r_address', r_openingHrs='$r_openingHrs', r_openingDays='$r_openingDays', r_closingHrs='$r_closingHrs' WHERE r_id='$r_id'";
                if (mysqli_query($db, $update_query)) {
                    echo "<script>window.location.href = window.location.href;</script>";
                    exit;
                } else {
                    echo "<script>alert('Error updating profile');</script>";
                }
           }
           
           ?>
        </div>
    </div>
</div>
<div id="overlay" class="overlay"></div>
 
<script>
function showSection(sectionId) {
    document.querySelectorAll('.section').forEach(section => {
        section.style.display = 'none';
    });
    document.getElementById(sectionId).style.display = 'block';
}
function logout() {
  windows.location.href = 'logout.php';
}
</script>
</body>
</html>
 