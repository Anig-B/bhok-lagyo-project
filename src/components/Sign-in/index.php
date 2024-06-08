<!DOCTYPE html>
<html lang="en">
<?php
 include '../../../connection/connection.php';
 error_reporting(0); // hide undefine index errors
session_start();
if (isset($_POST))  // if records were not empty
{
  $user_details = array($firstname = $_POST["firstname"], $lastname = $_POST['lastname'], $contact = $_POST['contact'], $email = $_POST['email'], $password = $_POST['password']);
   
  //check email if already present or not 
    $check_email = mysqli_query($db, "SELECT email from users where email ='" . $user_details[3] . "' ");
    if (mysqli_num_rows($check_email) > 0) {
        $message = "Email Already Exist"."<br/>.<br/>";
       
    } 
elseif($_POST['password'] != $_POST['confirm-password']){  //matching passwords
        $message = "Password do not match"."<br/>.<br/>";
 }
 elseif(strlen($_POST['password']) < 10)  //password length
 {
     $message = "Password must be greater or equals to 10"."<br/>.<br/>";
 }
 elseif(strlen($_POST['contact']) < 10)  //contact length
 {
     $message = "invalid phone number!"."<br/>.<br/>";
 }
 elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // Validate email address
 {
        $message = "Invalid email address please type a valid email!"."<br/>.<br/>";
 }

    else {
         //insertion of user_details
        $sql = "INSERT INTO users(f_name,l_name,contact,email,password) VALUES('" . $user_details[0] . "','" . $user_details[1] . "','" . $user_details[2] . "','" . $user_details[3] . "','" . md5($user_details[4]) . "')";
        mysqli_query($db, $sql);
        $success = "Account Created successfully!<p>You will be redirected in <span id='counter'>5</span> second(s).</p>
														<script type='text/javascript'>
														function countdown() {
															var i = document.getElementById('counter');
															if (parseInt(i.innerHTML)<=0) {
																location.href = '../login/index.php';
															}
															i.innerHTML = parseInt(i.innerHTML)-1;
														}
														setInterval(function(){ countdown(); },1000);
														</script>'";
		
        //header to login page
        header('refresh:5,url=../login/index.php');


    }
}?>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign-in</title>
    <link rel="stylesheet" href="styles.css" />
    <link rel="icon" href=../../img/component-img/foodDelivery.jpg sizes="any">
  </head>
  <body>
    <div class="sign-in-container">
      <div class="sign-in-form">
        <div>
          <a href="..\..\..\index.php">
            <img
              src="../../img/component-img/bhoklagyoLogo.jpg"
              alt="Logo"
              class="logo"
            />
          </a>
        </div>
        <h1>Sign in</h1>
        <form action="" method="post">
          <div class="form-row">
            <div class="form-group">
              <label for="firstname">First Name:</label>
              <input type="text" id="firstname" name="firstname" required />
            </div>
            <div class="form-group">
              <label for="lastname">Last Name:</label>
              <input type="text" id="lastname" name="lastname" required />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="contact">Contact no. :</label>
              <input type="text" id="contact" name="contact" required />
            </div>
            <div class="form-group">
              <label for="email">Email Address:</label>
              <input type="email" id="email" name="email" required />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" id="password" name="password" required />
            </div>
            <div class="form-group">
              <label for="confirm-password">Confirm password:</label>
              <input
                type="password"
                id="confirm-password"
                name="confirm-password"
                required
              />
            </div>
          </div>
					  <span style="color:red;"><?php echo $message; ?></span>
					   <span style="color:green;"><?php echo $success; ?></span>
          <button type="submit">Sign in</button>
        </form>
        <p>
          Already have account ?
          <a href="../login/index.php" class="signup-link">Login</a>
        </p>
      </div>
    </div>
  </body>
</html>
