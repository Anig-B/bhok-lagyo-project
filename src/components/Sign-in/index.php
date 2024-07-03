<!DOCTYPE html>
<html lang="en">
<?php
 include '../../../connection/connection.php';
 include '../Function/mailFunction.php';
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
 elseif(strlen($user_details[4]) < 10)  //password length
 {
     $message = "Password must be greater or equals to 10"."<br/>.<br/>";
 }
 elseif(strlen($user_details[2]) < 10)  //contact length
 {
     $message = " Invalid Phone Number!"."<br/>.<br/>";
 }
 elseif (!filter_var($user_details[3], FILTER_VALIDATE_EMAIL)) // Validate email address
 {
        $message = "Invalid email address please type a valid email!"."<br/>.<br/>";
 }

    else {
      $v_code = bin2hex(random_bytes(16));
         //insertion of user_details
        $sql = "INSERT INTO users(f_name,l_name,contact,email,password,verification_code,is_verified) VALUES('" . $user_details[0] . "','" . $user_details[1] . "','" . $user_details[2] . "','" . $user_details[3] . "','" . md5($user_details[4]) . "','$v_code','0')";
       $subject = 'Verify Your Email Address';
       $body = "Thanks for Registration! Click the link to verify email address <a href = 'http://localhost/bhoklagyo/src/components/login/verify.php?email=$email&v_code=$v_code'>Click Here</a>";
        if(mysqli_query($db, $sql) && sendMail($user_details[3],$v_code,$subject,$body)){
        $success = "Account created successfully! Please check your Gmail to verify your email address.";
        //header to login page
        }
        else{
          $message= 'Please provide a valid email-address';
        
        }

    }
}?>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign-in</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css" />
    <link rel="icon" href=../../img/component-img/foodDelivery.jpg sizes="any">
    <style>* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Inria serif;
}

body {
  background-color: #1a1a2e;
}

.sign-in-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #121824;
  padding: 20px; /* Space at the top and bottom */
}

.sign-in-form {
  background-color: rgba(255, 255, 255, 0.9);
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  max-width: 600px;
  width: 100%;
  text-align: center;
}

.sign-in-form .logo {
  max-width: 100px;
  margin-bottom: 20px;
}

.sign-in-form h1 {
  margin-bottom: 20px;
  color: #333;
}

.sign-in-form .form-row {
  display: grid;
  gap: 20px;
  margin-bottom: 20px;
  grid-template-columns: 1fr 1fr;
}

.sign-in-form .form-group {
  text-align: left;
}

.sign-in-form label {
  display: block;
  margin-bottom: 5px;
  color: #333;
}

.sign-in-form input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
}

.sign-in-form .forgot-password {
  display: block;
  margin-bottom: 20px;
  color: #0066cc;
  text-decoration: none;
}

.sign-in-form button {
  background-color: #0000ff;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}

.sign-in-form button:hover {
  background-color: #0000cc;
}

.sign-in-form p {
  margin-top: 20px;
  color: #333;
}

.sign-in-form .signup-link {
  color: #00ff00;
  text-decoration: none;
  font-weight: bold;
}

.sign-in-form .signup-link:hover {
  text-decoration: underline;
}
</style>
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
        <h1>Sign Up</h1>
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
					  <span style="color:red;"><?php if(!empty($_POST)){ echo $message;} ?></span>
					   <span style="color:green;"><?php echo $success.'</br>'; ?></span>
          <button type="submit">Sign up</button>
        </form>
        <p>
          Already have account ?
          <a href="../login/index.php" class="signup-link">Login</a>
        </p>
      </div>
    </div>
  </body>
</html>
