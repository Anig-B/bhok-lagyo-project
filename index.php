
<!DOCTYPE html>
<html lang="en" class="root">
  <?php
include("connection\connection.php");  //include connection file
error_reporting(0);  // using to hide undefine undex errors
session_start(); //start temp session until logout/browser closed
?>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bhok Lagyo</title>
    <link rel="stylesheet" href="styles.css" />
    <link
      rel="icon"
      href="src\img\component-img\foodDelivery.jpg"
      sizes="any"
    />
  </head>
  <body>
    <nav>
      <div class="logo">
        <a href="src/components/login/index.php"
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
									
									echo  '<li class="nav-item"><a href="your_orders.php" >Your Orders</a> </li>';
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
      <button>Track My Orders</button>
      <div class="search-container">
        <input type="text" placeholder="Search Restaurant or Foods..." />
        <button>Search</button>
      </div>
    </header>
    <!-- Special item display -->
    <section class="specials" id="specials">
      <h2>Today's Special</h2>
      <div class="specials-grid">
        <div class="special-item">
          <img src="src/img/special-img/desert.jpg" alt="Special 1" />
          <p>Special Food</p>
        </div>
        <div class="special-item">
          <img src="src/img/special-img/fastfood.jpg" alt="Special 2" />
          <p>Special Food</p>
        </div>
        <div class="special-item">
          <img src="src/img/special-img/thali.jpg" alt="Special 3" />
          <p>Special Food</p>
        </div>
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
            <img src="data:image/jpg;base64,'.base64_encode($rows['r_img']).'" height = 100 width = 100/>
            <div class="restaurant-info">
                <h3>'.$rows['r_name'].'</h3>
                <p>'.$rows['r_address'].'</p>
                <h5>✔ Min️: Rs. 299 &nbsp;🛵: 30 mins</h5>
                <button> View menu </button>
            </div>
        </div>
    
    ';}
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
            <button style="background-color: blue; color: white">Login</button>
            <button style="background-color: green; color: white">
              Signup
            </button>
          </div>
        </div>
      </div>
      <div class="footer-content-white">
        <div class="contact-info">
          <h3>Need Help?</h3>
          <p>📞 +977 9846098780</p>
          <p>📧 Bhoklagyo@gmail.com</p>
        </div>
        <div class="about-info">
          <h3>About us</h3>
          <p>Contact us</p>
          <p>Privacy policy</p>
        </div>
      </div>
      <div class="footer-content-white">
        <div class="social-links">
          <p>© Bhok Lagyo</p>
          <p>Follow us:</p>
          <span>
            <img
              src="src/img/social-icon-img/instagramLogo.jpg"
              alt="Instagram"
            />
            <img
              src="src/img/social-icon-img/facebookLogo.jpg"
              alt="facebook"
            />
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
