
<!DOCTYPE html>
<html lang="en" class="root">
  <?php
include("connection\connection.php");  //include connection file
error_reporting(0);  // using to hide undefine undex errors
session_start(); //start temp session until logout/browser closed
session_cache_limiter("private_no_expire");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

?>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bhok Lagyo</title>
    <link rel = "stylesheet" href = "src/components/styles/nav-styles.css"/>
    <link rel = "stylesheet" href="src/components/styles/footer-styles.css"/>
    <style>
    /* General Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* General Body Styles */
body {
  font-family: Arial, sans-serif;
  width: 100%;
  height: 100%;
  box-sizing: border-box;
  overflow-x: hidden;
  overflow-y: scroll;
}

/* Root Class for 100% Viewport Width and Height */
.root {
  width: 100vw;
  height: 100vh;
  overflow-x: hidden;
}

/* Header Styles */
header {
  background-image: url("src/img/component-img/landing-page-background.jpg");
  background-size: cover;
  background-repeat: no-repeat; /* Ensure the background image doesn't repeat */
  background-position: center; /* Center the background image */
  color: white;
  text-align: center;
  width: 100%;
  height: 70vh;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  position: relative;
}

header h1 {
  margin: 0;
  font-size: 3em;
}

header p {
  font-size: 1.5em;
  margin: 10px 0 20px 0;
}

header button {
  padding: 10px 20px;
  font-size: 1em;
  background-color: #ff5722;
  color: white;
  border: none;
  cursor: pointer;
}

header .search-container {
  margin-top: 20px;
}

header .search-container input {
  padding: 10px;
  font-size: 1em;
  width: 250px;
  border: none;
  border-radius: 5px;
}

header .search-container button {
  padding: 10px;
  font-size: 1em;
  background-color: #ff5722;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

/* Specials Section */
.specials {
  text-align: center;
  padding: 50px 20px;
}

.specials h2 {
  font-size: 2em;
  margin-bottom: 20px;
}

.specials-grid {
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
}

.special-item {
  margin: 20px;
  text-align: center;
}

.special-item img {
  max-width: 350px;
  aspect-ratio: 4/3;
  object-fit: cover;
}

/* How It Works Section */
.how-it-works {
  width: 100%;
  aspect-ratio: 16/9;
}

.how-it-works img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* Featured Restaurants Section */
.featured-restaurants {
  padding: 50px 20px;
  text-align: center;
}

.featured-restaurants h2 {
  font-size: 2em;
  margin-bottom: 20px;
}

.restaurant-grid {
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
}

.restaurant-item {
  margin: 20px;
  text-align: center;
  border: 1px solid #ccc;
  padding: 20px;
  border-radius: 10px;
  width: 300px; /* Fixed width for consistency */
}

.restaurant-item img {
  max-width: 150px;
  aspect-ratio: 3/2;
  object-fit: cover;
}

.restaurant-info {
  text-align: left;
  display: flex;
  flex-direction: column;
  gap: 10px;

}

.restaurant-info button {
  padding: 10px 20px;
  font-size: 1em;
  background-color: #ff5722;
  color: white;
  border: none;
  cursor: pointer;
}

/* Responsive Header Background */
@media (max-width: 768px) {
  header {
    height: 50vh;
    background-size: cover; /* Ensure the background image covers the header area */
  }

  header h1 {
    font-size: 2em;
  }

  header p {
    font-size: 1em;
  }

  header .search-container input {
    width: 200px;
  }
  .button-container {
    display: flex;
    flex-direction: column;
  }
}

   </style>
    
    <link
      rel="icon"
      href="src\img\component-img\foodDelivery.jpg"
      sizes="any"
    />
  </head>
  <body>
    <!-- Navigation bar -->
    <nav>
      <div class="logo">
        <a href="index.php"
          ><img src="src/img/useless/logo.png" alt="Logo"
        /></a>
      </div>
      <div class="toggle-button" id="navbar-toggle">&#9776;</div>
      <ul class="menu" id="navbar-links">
        <li class="nav-item"><a href="index.php">Home</a></li>
        <li class="nav-item">
          <a href="src/components/Restaurtant/index.php">Restaurant</a>
        </li>
        
							<?php
						if(empty($_SESSION["user_id"])) // if user is not login
							{
								echo '<li class="nav-item"><a href="src/components/login/index.php">Login</a> </li>
							  <li class="nav-item"><a href="src/components/Sign-in/index.php">signup</a> </li>';
							}
						else
							{
									//if user is login
									echo  '<li class="nav-item"><a href="src/components/Profile/index.php" >Profile</a> </li>';
									echo  '<li class="nav-item"><a href="src/components/Cart/index.php" >My Cart</a> </li>';
									echo  '<li class="nav-item"><a href="src/components/login/logout.php">Logout</a> </li>';
							}

						?>
        <!-- <li><a href="#my-cart">My Cart</a></li>
        <li><a href="src/components/login/index.html">Login</a></li>
        <li><a href="src/components/Sign-in/index.html">SignUp</a></li> -->
      </ul>
    </nav>

    <header>
      <h1>Bhok Lagyo</h1>
      <p>"Khane haina tw?"</p>
      <!-- <button>Track My Orders</button> -->
      <div class="search-container">
        <form method="post">
        <input name="search" type="text" placeholder="Search Restaurants..." required />
        <button type="submit" name = "search_button">Search</button>
        </form>
        <!-- php if search button is pressed -->
         <?php
         if(isset($_POST["search_button"])){
          $str = $_POST["search"];
          $query = mysqli_query($db,"SELECT * FROM restaurant WHERE r_name = '$str' ");
          $row=mysqli_fetch_array($query);
          if(!isset($row)){
            echo '<p>No Results Found</p>';
          }} 
          
         ?>
         
    
      </div>
    </header>
    <!-- Special item display -->
    <section class="specials" id="specials">
    <?php

      if(is_array($row))  // if matching records in the array & if everything is right
      {$address = 'src/components/ViewMenu/index.php';
          $search_item =
             '<h3>Search results for: '.$str.'</h3><div class="search-item">
               <div class="restaurant-item">
          <img src= "'.htmlspecialchars($row['r_img']).'" alt = "'.$row['r_name'].'"/>
          <div class="restaurant-info">
              <h3>'.$row['r_name'].'</h3>
              <p>'.$row['r_address'].'</p>
              <h5>✔ Min️: Rs. 299 &nbsp;🛵: 30 mins</h5>
               <button type="submit" name="restaurant" onclick="redirectToPage(\'' . $address . '\', ' . $row['r_id'] .')">View menu</button>
          </div>
      </div>
      
  '; 
 echo '<script type="text/javascript">
    function redirectToPage(address,id){
        window.location.href = address + "?r_id=" + id;
    }
  </script>';}

  if(isset($search_item)){
    echo $search_item;
    
  }
      else{
echo "<h2>Today's Special</h2>
      <div class='specials-grid'>";
      $sql = mysqli_query($db,'SELECT d_name,d_image FROM dishes LIMIT 3 ');
      while($rows=mysqli_fetch_array($sql))  // if matching records in the array & if everything is right
    {
      echo'
        <div class="special-item">
           <img src="'.htmlspecialchars($rows['d_image']).'" alt = "'.$rows['d_name'].'"/>
          <p>'.$rows['d_name'].'</p>
        </div> ';}}
      ?>
      </div>
    </section>
    <!-- how it works img -->
    <section class="how-it-works">
      <img src="src/img/component-img/how-it-works.jpg" alt="how-it-works" />
    </section>
    <!-- featured restaurant display -->
    <section class="featured-restaurants" id="featured-restaurants">
      <h2>Featured Restaurants</h2>
      <div class="restaurant-grid">
      <?php 
     $result = mysqli_query($db, "SELECT * from restaurant LIMIT 3" );
    while($rows=mysqli_fetch_array($result))
     {echo '
   
        <div class="restaurant-item">
            <img src="'.htmlspecialchars($rows['r_img']).'" alt = "'.$rows['r_name'].'"/>
            <div class="restaurant-info">
                <h3>'.$rows['r_name'].'</h3>
                <p>'.$rows['r_address'].'</p>
                <h5>✔ Min️: Rs. 299 &nbsp;🛵: 30 mins</h5>';
                
                if(!empty($_SESSION["user_id"])) // if user is not login
							{
                $address = "src/components/ViewMenu/index.php";
                echo'
                 <button type="submit"  name="restaurant" onclick="redirectToPage(\'' . $address . '\', '. $rows['r_id'].')">View menu</button>
            </div>
        </div>
    ';}
        else{
          $address = "src/components/login/index.php";
          echo'
          <button type="submit" name="restaurant" onclick="redirectToPage(\'' . $address . '\', ' . $rows['r_id'] .')">View menu</button>
            </div>
     </div>';
        }    
    echo '<script type="text/javascript">
    function redirectToPage(address,id){
       window.location.href = address + "?r_id=" + id;
        console.log('.$rows['r_id'].');
    }
  </script>';}
 

?>
      </div>
    </section>
    <footer>
      <div class="footer-container">
        <div class="footer-img">
          <img src="src/img/component-img/mobile-screen.jpg" alt="Mobile App" />
        </div>
        <div class="footer-content">
          <h2>Best Food Ordering Web</h2>
          <p>
            Now you can order food pretty much wherever you are thanks to the
            free easy-to-use Bhok Lagyo App.
          </p>
          <div class="button-container">
            <button onclick="location.href='src/components/login/index.php'" style="background-color: blue; color: white">Login</button>
            <button onclick="location.href='src/components/Sign-in/index.php'" style="background-color: green; color: white">
              Signup
            </button>
          </div>
        </div>
      </div>
      <div class="footer-content-white">
        <div class="contact-info">
          <h3>Need Help?</h3>
          <a href = "tel:+977 9846098780" style="color: black; text-decoration: none" target="_blank">
          <p>📞 +977 9846098780</p></a>
          <a  href = "https://mail.google.com/mail/?view=cm&fs=1&to= Bhoklagyo@gmail.com" style="color: black; text-decoration: none" target="_blank">
          <p>📧 Bhoklagyo@gmail.com</p>
          </a>
        </div>
        <div class="about-info">
          <h3>About us</h3>
          <a  href = "https://mail.google.com/mail/?view=cm&fs=1&to= Bhoklagyo@gmail.com" style="color: black; text-decoration: none" target="_blank">
          <p>Contact Us</p>
          </a>
          <p>Privacy policy</p>
        </div>
      </div>
      <div class="footer-content-white">
        <div class="social-links">
          <p>© Bhok Lagyo</p>
          <p>Follow us:</p>
          <span>
            <a href = ''>
            <img
              src="src/img/social-icon-img/instagramLogo.jpg"
              alt="Instagram"
            />
            </a>
            <a href = ''>
            <img
              src="src/img/social-icon-img/facebookLogo.jpg"
              alt="facebook"
            />
            </a>
          </span>
        </div>
      </div>
      <div class="bottom-bar">
        <p>Powered by: UMA Team</p>
      </div>
    </footer>
    <script src="script.js"></script>

  </body>
</html>
