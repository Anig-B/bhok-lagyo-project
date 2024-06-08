<!DOCTYPE html>
<html lang="en">
<?php
 include '../../connection/connection.php';
 error_reporting(0); // hide undefine index errors
session_start();
if (isset($_POST))  // if records were not empty
{
  $restaurant_details = array($r_name = $_POST["r_name"], $r_address = $_POST['r_address'], $contact = $_POST['contact'],$img=$_POST['r_img'], $o_hrs = $_POST['o_hrs'], $c_hrs = $_POST['c_hrs'],$o_days = $_POST['o_days']);
   
  //check email if already present or not 
    $check_name = mysqli_query($db, "SELECT r_name from restaurant WHERE r_name ='" . $restaurant_details[0] . "' ");
    if (mysqli_num_rows($check_name) > 0) {
        $message = "Name Already Exist"."<br/>.<br/>";
       
    } 
 elseif(strlen($_POST['contact']) < 10)  //contact length
 {
     $message = "invalid phone number!"."<br/>.<br/>";
 }
    else {
         //insertion of restaurant_details
        $sql = "INSERT INTO restaurant(r_name,r_address,r_contact,r_img, r_openingHrs,r_closingHrs,r_openingDays) VALUES('" . $restaurant_details[0] . "','" . $restaurant_details[1] . "','" . $restaurant_details[2] . "','" .$restaurant_details[3]. "','" . $restaurant_details[4] . "','" . $restaurant_details[5] . "','" . $restaurant_details[6] . "')";
        mysqli_query($db, $sql);
        $success = "Restaurant Added Succesfully</br>";
        session_destroy();
        header('refresh:5 url=../index.php');
    }
}?>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign-in</title>
    <link rel="stylesheet" href="styles.css" />
    <link rel="icon" href=..\..\src\img\component-img\foodDelivery.jpg sizes="any">
  </head>
  <body>
    <div class="sign-in-container">
      <div class="sign-in-form">
        <div>
            <img
              src="..\..\src\img\component-img\bhoklagyoLogo.jpg"
              alt="Logo"
              class="logo"
            />
        </div>
        <h1>Add Restaurant</h1>
        <form action="" method="post">
          <div class="form-row">
            <div class="form-group">
              <label for="r_name">Name:</label>
              <input type="text" id="r_name" name="r_name" required />
            </div>
            <div class="form-group">
              <label for="r_address">Address:</label>
              <input type="text" id="r_address" name="r_address" required />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="contact">Contact no. :</label>
              <input type="text" id="contact" name="contact" required />
            </div>
            <div class="form-group">
              <label for="r_img">Select Image:</label>
              <input type="file" id="r_img" name="r_img" required />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="o_hrs">Opening Hours:</label>
              <input type="text" id="o_hrs" name="o_hrs" required />
            </div>
            <div class="form-group">
              <label for="o_hrs">Closing Hours:</label>
              <input type="text" id="c_hrs" name="c_hrs" required />
            </div>
            <div class="form-group">
              <label for="o_days">Opening days:</label>
              <input type="text" id="o_days" name="o_days" required />
            </div>
          </div>
				 <span style="color:red;"><?php echo $message; ?></span>
				<span style="color:green;"><?php echo $success; ?></span>
          <button type="submit">Add Restaurant</button>
        </form>
      </div>
    </div>
  </body>
</html>
