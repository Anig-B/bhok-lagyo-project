<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="icon" href="../../img/component-img/foodDelivery.jpg" sizes="any">
</head>
<body>
    <?php 
    include '../../../connection/connection.php';
    include '../Function/mailFunction.php';
   error_reporting(0); // hide undefine index errors
 session_start();
 session_cache_limiter("private_no_expire");
 header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
 header("Cache-Control: post-check=0, pre-check=0", false);
 header("Pragma: no-cache");

    if (isset($_POST)) {
      //assigning form value to variables
    $email = $_POST['email'];
    if(!empty($_POST))   // if records were not empty
     {
        $result = mysqli_query($db, "SELECT email from users where email ='" . $email . "'" );
        $subject = 'Password Reset';
        $body = "If you didnt request for a password change please ignore this mail. <a href = 'http://localhost/bhoklagyo/src/components/forgotPassword/index.php?email=$email'>Click Here to change password</a>";
            $row=mysqli_fetch_array($result);
           
            if(is_array($row))  // if matching records in the array & if everything is right
            {
                sendMail($email,null,$subject,$body);
            }
            else{
                $message = 'Email not registered !! Please use registered Email address.';
            }
         //header to login page
        
 
}}
        ?>
<div class="login-container">
  <div class="login-form">
    <div>
      <a href="../../../index.php">
        <img src="../../img/component-img/bhoklagyoLogo.jpg" alt="Logo" class="logo">
      </a>
    </div>
    <h1>Forgot Password:</h1>
    <form action ="" method ="post" id="reset-password-form" >
      <label for="Email">Email:</label>
      <input type="text" id="email" name="email" placeholder="Enter your email address" required>
      <span style="color:red;"><?php echo $message; ?></span></br>
      <button type="submit">Submit</button>
    </form>
  </div>
</div>
</body>
</html>
