<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="styles.css" />
    <link rel="icon" href=../../img/component-img/foodDelivery.jpg sizes="any">
  </head>
  <body>
  <?php
   include '../../../connection/connection.php';
  error_reporting(0); // hide undefine index errors
session_start();
 //Including connection to server
   


    if (isset($_POST)) {
      //assigning form value to variables
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(!empty($_POST))   // if records were not empty
     {
        $result = mysqli_query($db, "SELECT * from users where email ='" . $email . "' AND password='".md5($password)."' " );
        $row=mysqli_fetch_array($result);
	
        if(is_array($row))  // if matching records in the array & if everything is right
            {
                    $_SESSION["user_id"] = $row['u_id']; // put user id into temp session
                      header('location:../../../index.php'); // redirect to index.php page
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
          <input type = "checkbox" onclick="showpassword()">showpassword
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
          <a href="../forgotPassword/index.html" class="forgot-password"
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
