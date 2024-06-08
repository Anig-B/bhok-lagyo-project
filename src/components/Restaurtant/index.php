<!DOCTYPE html>
<html lang="en" class="root">
    <?php
     include '../../../connection/connection.php';
     error_reporting(0); // hide undefine index errors
   session_start();
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Selling Foods</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href=../../img/component-img/foodDelivery.jpg sizes="any">
</head>
<body>
<header>
<nav>
      <div class="logo">
          <img src="..\..\..\src\img\useless\logo.png" alt="Logo"/>
      </div>
      <div class="toggle-button" id="navbar-toggle">&#9776;</div>
      <ul class="menu" id="navbar-links">
        <li class="nav-item"><a href="../../../index.php">Home</a></li>
        <li class="nav-item">
          <a href="index.php">Restaurant</a>
        </li>
        
							<?php
						if(empty($_SESSION["user_id"])) // if user is not login
							{
								echo '<li class="nav-item"><a href="../login/index.php">Login</a> </li>
							  <li class="nav-item"><a href="../Sign-in/index.php">signup</a> </li>';
							}
						else
							{
									//if user is login
									
									echo  '<li class="nav-item"><a href="your_orders.php" >Your Orders</a> </li>';
									echo  '<li class="nav-item"><a href="../login/logout.php">Logout</a> </li>';
							}

						?>
      </ul>
    </nav>
</header>

<div class="step-section">
    <div>
        <img src="../../img/useless/1.png" alt="Choose a restaurant">
        <span>Choose a restaurant</span>
    </div>
    <div>
        <img src="../../img/useless/2.png" alt="Choose a tasty food">
        <span>Choose a tasty food</span>
    </div>
    <div>
        <img src="../../img/useless/3.png" alt="Delivery">
        <span>Delivery</span>
    </div>
</div>
<section class="view-restaurants" id="view-restaurants">
    <h1>View restaurant based on stars</h1>
    <div class="view-restaurants-container">
        <div class="view-restaurants-item">
            <span style="color: red;">★★★★★</span>
            <button> View restaurant</button>
        </div>
        <div class="view-restaurants-item">
            <span style="color: red;">★★★★☆</span>
            <button> View restaurant</button>
        </div>
        <div class="view-restaurants-item">
            <span style="color: red;">★★★☆☆</span>
            <button> View restaurant</button>
        </div>
    </div>
</section>
<section class="featured-restaurants" id="featured-restaurants">
    <h2>Featured Restaurants</h2>
    <div class="restaurant-grid">
    <?php 
     $result = mysqli_query($db, "SELECT * from restaurant" );
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
<section class="top-selling-foods">
    <h2>Top selling foods</h2>
    <div class="food-grid">
        <div class="food-item">
            <img src="../../img/top-selling/food6.png" alt="Pizza">
            <p>Pizza</p>
        </div>
        <div class="food-item">
            <img src="../../img/top-selling/food5.png" alt="Burger">
            <p>Burger</p>
        </div>
        <div class="food-item">
            <img src="../../img/top-selling/food4.png" alt="Biryani">
            <p>Biryani</p>
        </div>
        <div class="food-item">
            <img src="../../img/top-selling/food3.png" alt="Pasta">
            <p>Pasta</p>
        </div>
        <div class="food-item">
            <img src="../../img/top-selling/food1.png" alt="Khaja Set">
            <p>Khaja Set</p>
        </div>
        <div class="food-item">
            <img src="../../img/top-selling/food2.png" alt="Sandwich">
            <p>Sandwich</p>
        </div>
    </div>
</section>
<footer>
    <div class="footer-container">
        <div class="footer-img">
            <img src="../../img/component-img/mobile-screen.jpg" alt="Mobile App">
        </div>
        <div class="footer-content">
            <h2>Best Food Ordering Web</h2>
            <p>Now you can order food pretty much wherever you are thanks to the free easy-to-use Bhok Lagyo App.</p>
            <div class="button-container">
                <button style="background-color: blue; color: white;">Login</button>
                <button style="background-color: green; color: white;">Signup</button>
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
                <img src="../../img/social-icon-img/instagramLogo.jpg" alt="Instagram">
                <img src="../../img/social-icon-img/facebookLogo.jpg" alt="Facebook">
            </span>
        </div>
    </div>
    <div class="bottom-bar">
        <p>Powered by: UMA Team</p>
    </div>
</footer>
</body>
</html>

<!-- <div class="restaurant-item">
           <img src="../../img/restaurant-img/aroma.jpg" alt="Aroma Cafe">
             <div class="restaurant-info">
                 <h3>Aroma Cafe</h3>
                <p>Chiplaydhunga, Pokhara</p>
                 <h5>✔ Min️: Rs. 299 &nbsp;🛵: 30 mins</h5>
                 <button> View menu </button>
             </div>
         </div> -->