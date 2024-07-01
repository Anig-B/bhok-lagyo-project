<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="styles.css" />
    <link
      rel="icon"
      href="../../img/component-img/foodDelivery.jpg"
      sizes="any"
    />
    <!-- <script>
      function validateForm(event) {
        event.preventDefault();
        const password = document.getElementById("password").value;
        const confirmPassword =
          document.getElementById("confirm-password").value;

        if (password !== confirmPassword) {
          alert("Passwords do not match. Please try again.");
          return false;
        } else {
          alert("Passwords match. Form submitted.");
          document.getElementById("reset-password-form").submit(); // Uncomment to actually submit the form
        }
      }
    </script> -->
  </head>
  <body>
    <?php
     include '../../../connection/connection.php';
      error_reporting(0); // hide undefine index errors
      session_start();
 if (isset($_POST)) {
  //assigning form value to variables
$email = $_GET['email'];
$password = md5($_POST['password']);
$confirm_password = md5($_POST['confirm-password']);
if(!empty($_POST))   // if records were not empty
 {
  if($password != $confirm_password){  //matching passwords
    $message = "Password do not match"."<br/>.<br/>";
}
  elseif(strlen($password) < 10)  //password length
  {
      $message = "Password must be greater or equals to 10"."<br/>.<br/>";
  }
    else{ 
      $stmt = $db->prepare("UPDATE users SET password = ? WHERE email = ?");
      $stmt->bind_param("ss", $password, $email);
      
      // Check if the statement was prepared successfully
      if ($stmt) {
          $stmt->execute();
          $stmt->close();
      } else {
          // Handle the error
          echo "Error preparing statement: " . $db->error;
      }
      $success = "Password Changed Sucessfully.! <p>You will be redirected in <span id='counter'>5</span> second(s).</p>
														<script type='text/javascript'>
														function countdown() {
															var i = document.getElementById('counter');
															if (parseInt(i.innerHTML)<=0) {
																location.href = 'login.php';
															}
															i.innerHTML = parseInt(i.innerHTML)-1;
														}
														setInterval(function(){ countdown(); },1000);
														</script>'";
		
		session_abort();
		 header("refresh:5;url=../login/index.php");
      //header to login page
      }

  }
}
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
        <h1>Enter New Password:</h1>
        <span style="color:red;"><?php echo $message; ?></span> 
        <span style="color:green;"><?php echo $success; ?></span> 
        <form action ='' method="post" id="reset-password-form" >
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required />
          <label for="confirm-password">Confirm Password:</label>
          <input
            type="password"
            id="confirm-password"
            name="confirm-password"
            required
          />
          
          <button type="submit">Submit</button>
        </form>
      </div>
    </div>
  </body>
</html>
