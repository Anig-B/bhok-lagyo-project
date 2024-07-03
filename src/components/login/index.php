<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css" />
    <link rel="icon" href=../../img/component-img/foodDelivery.jpg sizes="any">
    <style>* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Inria serif;
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

/* Responsive Design */
@media (max-width: 768px) {
  .login-container {
    background-image: none;
  }
}
</style>
  </head>
  <body>
  <?php
   include '../../../connection/connection.php';
  error_reporting(0); // hide undefine index errors
session_start();
session_cache_limiter("private_no_expire");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

   


    if (isset($_POST)) {
      //assigning form value to variables
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(!empty($_POST))   // if records were not empty
     {
        $result = mysqli_query($db, "SELECT * from users where email ='" . $email . "' AND password='".md5($password)."' " );
        $result2 = mysqli_query($db,"SELECT * from restaurant where r_email ='" . $email . "' AND admin_codes='".$password."'");
        $row=mysqli_fetch_array($result);
        $row1 = mysqli_fetch_array($result2);
	
        if(is_array($row))  // if matching records in the array & if everything is right
            {
              if($row['is_verified']==1){
                $_SESSION["user_id"] = $row['u_id']; // put user id into temp session
                header('location:../../../index.php'); // redirect to index.php page
              }
              else{
                $message = 'Email not Verified! Please check your mailbox and verify your email address.';
               }
                   
            }
            elseif (is_array($row1)){
              $_SESSION["r_id"] = $row1['r_id'];
              header('location: ../restaurant_dash/order.php');
            } 
        else
            {
             $message = "Invalid Username or Password!"; // throw error
            }
           
}}
        ?>
    <div class="login-container">
      <div class="login-form">
        <div>
          <a href="../../../index.php">
            <img
              src="../../img/component-img/bhoklagyoLogo.jpg"
              alt="Logo"
              class="logo"
            />
          </a>
        </div>
        <h1>Login</h1>
        <span style="color:red;"><?php echo $message; ?></span> 
        <span style="color:green;"><?php echo $success; ?></span>
        <form action="" method="post">
          <label for="email">Email Address:</label>
          <input type="email" id="email" name="email" required />
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required />
          <label for="checkbox" style=" display: inline-flex;}">
          Show Password<input type="checkbox" id="checkbox" onclick="showpassword()"> 
</label>
       
         
          <script>
function showpassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
          <a href="../forgotPassword/check_email.php" class="forgot-password"
            >Forget Password ?</a
          >
          
          <button type="submit">Login</button>
        </form>
        <p>
          Don't have account?
          <a href="../Sign-in/index.php" class="signup-link">SignUp</a>
        </p>
      </div>
    </div>
  </body>
</html>
