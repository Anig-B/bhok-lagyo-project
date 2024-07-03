<!DOCTYPE html>
<html lang="en" class="root">
<?php
 include '../../../connection/connection.php';
//error_reporting(0); // hide undefine index errors
session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Profile</title>
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

.overlay {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  z-index: 1000;
}

form label {
  display: block;
  margin-top: 10px;
  color: #000000;
}

.order-details {
  margin-bottom: 10px;
  padding: 10px;
  border-radius: 10px;
  background-color: #ff7f22;
  color: #ffffff;
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
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    </head>
<body>
<div class="profile-container">
    <div class="inner-sidebar">
        <h2>Profile Menu</h2>
        <ul>
            <li><button class="inner-sidebar-btn" onclick="showSection('profileSection')">Profile</button></li>
            <li><button class="inner-sidebar-btn" onclick="showSection('settingsSection')">Settings</button></li>
            <li><button class="inner-sidebar-btn" onclick="showSection('orderSection')">Orders</button></li>
            <li><button class="inner-sidebar-btn" onclick="logout()">Logout</button></li>
        </ul>
    </div>
    <div class="content">
        <a class="logo-container" href="../../../index.php">
            <img src="../../img/component-img/bhoklagyoLogo.jpg" class="logo" alt="logo">
        </a>
        <div id="profileSection" class="section">
            <div class="profile-header">
                <?php
                $u_id = $_SESSION["user_id"];
                $sql ="SELECT * FROM users where u_id ='$u_id' ";
              $result = mysqli_query($db,$sql);
                $row=mysqli_fetch_array($result);
                if(is_array($row))  // if matching records in the array & if everything is right
                {
                    if (is_null($row['u_img'])) {
                   echo' <img src="../../img/user_profile/default.png" alt="profile" class="client-img">';
                  }
                  else{
                    echo'<img src="../../../'.htmlspecialchars($row['u_img']).'" alt = "'.$row['f_name'].'" class="client-img"/>';
                   }
                 echo '<h1>'.$row['f_name'].' '.$row['l_name'].'</h1>
                <p>'.$row['email'].'</p>
                <p>+977 '.$row['contact'].'</p>';     
                }

                 ?>
                <!-- <img src="../../img/clientImg/client1.jpeg" alt="Logo" class="client-img"> -->
               
            </div>
        </div>
        <div id="settingsSection" class="section" style="display: none;">
        <?php
echo '<h2>Edit Profile</h2>
<form method="post" id="editProfileForm" enctype="multipart/form-data">
    <label for="name">First Name:</label>
    <input type="text" id="name" name="f_name" value="'.htmlspecialchars($row['f_name']).'">
     <label for="name">Last Name:</label>
    <input type="text" id="name" name="l_name" value="'.htmlspecialchars($row['l_name']).'">
    <label for="phone">Phone number:</label>
    <input type="text" id="phone" name="phone" value="+977 '.htmlspecialchars($row['contact']).'">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="'.htmlspecialchars($row['email']).'">
    <label for="image">Image:</label>
    <input type="file" id="image" name="image" value = "'.htmlspecialchars($row['u_img']).'">
    <div class="btn-container"><button type="submit" name="update" class="btn">Save</button></div>
</form>';

if (isset($_POST['update'])) {
    // Retrieve the submitted form data
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = $_FILES['image']['name'];
        $upload_dir = 'src/img/user_profile/'; // Adjust the upload directory as needed
        $image_path = $upload_dir . $image_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    } else {
        $image_path = $row['u_img']; // Use the existing image if no new image is uploaded
    }
    // Remove the "+977 " prefix from the phone number if present
    if (strpos($phone, '+977 ') === 0) {
        $phone = substr($phone, 5);
    }

    // Handle the file upload if a file was uploaded
    

    // Prepare the update query using prepared statements to prevent SQL injection
    $stmt = $db->prepare('UPDATE users SET f_name = ?,l_name=?, contact = ?, email = ?, u_img = ? WHERE u_id = ?');
    $stmt->bind_param('sssssi', $f_name,$l_name, $phone, $email, $image_path, $row['u_id']);
    $stmt->execute();

    // Close the statement
    $stmt->close();
    header("Location:index.php");
}
?>

        </div>
        <div id="orderSection" class="section" style="display: none;">
            <h2>Order History:</h2>
            <ol id="orderHistoryList"><?php  
            $query = "SELECT * from orders where u_id = '$u_id'";
            $result = mysqli_query($db,$query);
           
          
            while($rows=mysqli_fetch_array($result)){
                $o_id = $rows['o_id'];
                $r_id = $rows['r_id'];
                $query2= "SELECT * from order_details where o_id = '$o_id'";
                $result2 = mysqli_query($db,$query2);
                while($row1=mysqli_fetch_array($result2)){
               
                $location = $row1['location'];
                $food_detail=$row1['food'];
                $total = $row1['total'];
                $query3 ="SELECT * from restaurant where r_id = '$r_id'";
                $result3 = mysqli_query($db,$query3);
                while($row2=mysqli_fetch_array($result3)){
                    $r_name = $row2['r_name'];
                    $r_contact = $row2['r_contact'];
echo " <li class='order-details'>
                    <p> Order ID: <strong> $o_id </strong> </p>
                    <p>Restaurant Name:<strong>$r_name</strong> </p>
                    <p>Contact:<strong>0$r_contact</strong> </p>
                    <p>Delivery Location:<strong>$location</strong> </p>
                    <p>Status:<strong>Cooking</strong> </p>
                    <div class='order-items'>
                        <p>Purchased Item: <strong>$food_detail</strong></p>
                    </div>
                    <p>Total:<strong> $total</strong></p>
                </li>";
                }} }
             ?>
               
                <!-- <li class="order-details">
                    <p>Restaurant Name:<strong>Anig's kitchen</strong> </p>
                    <p>Contact:<strong>09876345</strong> </p>
                    <p>Delivery Location:<strong>lakeside, pkr</strong> </p>
                    <p>Delivery Driver Name:<strong>Ram</strong> </p>
                    <p>Status:<strong>Cooking</strong> </p>
                    <div class="order-items">
                        <p>1 x Burger = 300.00</p>
                        <p>2 x Pizza = 420.00</p>
                    </div>
                    <p>Total: 720.00</p>
                </li>
                <li class="order-details">
                    <p>Restaurant Name:<strong>Anig's kitchen</strong> </p>
                    <p>Contact:<strong>09876345</strong> </p>
                    <p>Delivery Location:<strong>lakeside, pkr</strong> </p>
                    <p>Delivery Driver Name:<strong>Ram</strong> </p>
                    <p>Status:<strong>Cooking</strong> </p>
                    <div class="order-items">
                        <p>1 x Burger = 300.00</p>
                        <p>2 x Pizza = 420.00</p>
                    </div>
                    <p>Total: 720.00</p>
                </li> -->
            </ol>
        </div>
    </div>
</div>
<div id="overlay" class="overlay"></div>
<!-- <script src="script.js"></script> -->
<script>function showSection(sectionId) {
  document.querySelectorAll(".section").forEach((section) => {
    section.style.display = "none";
  });
  document.getElementById(sectionId).style.display = "block";
}

function logout() {
  document.getElementById("overlay").style.display = "block";
  alert("Logging out...");
  document.getElementById("overlay").style.display = "none";
}
</script>
</body>
</html>