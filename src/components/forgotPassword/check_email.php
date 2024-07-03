<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
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
background-color: #1a1a2e;
}

.login-container {
display: flex;
justify-content: center;
align-items: center;
height: 100vh;
background-color: #121824;
}

.login-form {
background-color: rgba(255, 255, 255, 0.9);
padding: 20px;
border-radius: 8px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
max-width: 400px;
width: 100%;
text-align: center;
}

.login-form .logo {
max-width: 100px;
margin-bottom: 20px;
}

.login-form h1 {
margin-bottom: 20px;
color: #333;
}

.login-form label {
display: block;
text-align: left;
margin-bottom: 5px;
color: #333;
}

.login-form input {
width: 100%;
padding: 10px;
margin-bottom: 20px;
border: 1px solid #ddd;
border-radius: 5px;
}

.login-form .forgot-password {
display: block;
margin-bottom: 20px;
color: #0066cc;
text-decoration: none;
}

.login-form button {
background-color: #0000ff;
color: white;
padding: 10px 20px;
border: none;
border-radius: 5px;
cursor: pointer;
font-size: 16px;
}

.login-form button:hover {
background-color: #0000cc;
}

.login-form p {
margin-top: 20px;
color: #333;
}

.login-form .signup-link {
color: #00ff00;
text-decoration: none;
font-weight: bold;
}

.login-form .signup-link:hover {
text-decoration: underline;
}

@media (max-width: 768px) {
.login-container {
background-image: none;
}
}


    </style>
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
