<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href=..\src\img\component-img\foodDelivery.jpg sizes="any">
  </head>
  <body>
  <?php
   include '..\connection\connection.php';
  error_reporting(0); // hide undefine index errors
session_start();
 //Including connection to server
   


    if (isset($_POST)) {
     
      //assigning form value to variables
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(!empty($_POST))   // if records were not empty
     {
        $result = mysqli_query($db, "SELECT * from admin where admin_username ='" . $username . "' AND admin_password='".$password."' " );
        $row=mysqli_fetch_array($result);
	
        if(is_array($row))  // if matching records in the array & if everything is right
            {
                    $_SESSION["admin_id"] = $row['admin_id']; // put user id into temp session
                      header('location:dashboard\index.php'); // redirect to dashboard.php page
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
              src="../src/img/component-img/bhoklagyoLogo.jpg"
              alt="Logo"
              class="logo"
            />
          </a>
        </div>
        <h1>Admin Login</h1>
        <span style="color:red;"><?php echo $message; ?></span> 
        <span style="color:green;"><?php echo $success; ?></span>
        <form action="" method="post">
          <label for="username">username Address:</label>
          <input type="text" id="username" name="username" required />
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required />
          <!-- <a href="../forgotPassword/index.html" class="forgot-password"
            >Forget Password ?</a
          > -->
          <button type="submit">Login</button>
        </form>
        <!-- <p>
          Don't have account?
          <a href="../Sign-in/index.php" class="signup-link">SignUp</a>
        </p> -->
      </div>
    </div>
  </body>
</html>
