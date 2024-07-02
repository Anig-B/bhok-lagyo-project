
<?php

if(isset($_POST['add-to-cart'])){
  
// Check if the cartData cookie is set
if (isset($_COOKIE['cartData'])) {
    // Decode the JSON data stored in the cookie
    $cartData = json_decode($_COOKIE['cartData'], true);

    // Check for JSON decoding errors
    if (json_last_error() === JSON_ERROR_NONE) {
        echo "<h2>Cart Items</h2><ul>";
        // Iterate through the cart data and display each item
        foreach ($cartData as $item) {
            $name = htmlspecialchars($item['name']);
            $quantity = intval($item['quantity']);
            $price = floatval($item['price']);
            $total = floatval($item['total']);
            $message= "<li>$quantity x $name - Rs. $total</li>";
        }
        echo "</ul>";
    } else {
        $message= "Error decoding JSON: " . json_last_error_msg();
    }
} else {
     $message = "Cart is empty.";
}}
?>
<!DOCTYPE html>
<html lang="en" class="root">
  <?php
 include '../../../connection/connection.php';
//  include '../../../index.php';
error_reporting(0); // hide undefine index errors
session_start();
session_cache_limiter("private_no_expire");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
   ?>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order Menu</title>
    <link rel="icon" href="../../img/component-img/foodDelivery.jpg" sizes="any" />
    <link rel="stylesheet" href="styles.css" /> 
    <link rel="stylesheet" href="../styles/nav-styles.css" />
    <link rel="stylesheet" href="../styles/footer-styles.css" />
   
  </head>
  <body>
    <header>
      <nav>
        <div class="logo">
          <a href="../../../index.php"
            ><img src="../../img/useless/logo.png" alt="Logo"
          /></a>
        </div>
        <div class="toggle-button" id="navbar-toggle">&#9776;</div>
        <ul class="menu" id="navbar-links">
          <li class="nav-item"><a href="../../../index.php">Home</a></li>
          <li class="nav-item">
            <a href="../Restaurtant/index.php">Restaurant</a>
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
									echo  '<li class = "nav-item"><a href="../Cart/index.php">My Cart</a></li>';
									echo  '<li class="nav-item"><a href="../login/logout.php">Logout</a> </li>';
							}?>
        </ul>
      </nav>
    </header>
    <main>
      <div class="step-section">
        <div>
        <a href="../Restaurtant/index.php"><img src="../../img/useless/1.png" alt="Choose a restaurant" /></a>
          <span>Choose a restaurant</span>
        </div>
        <div>
          <img src="../../img/useless/active2.png" alt="Choose a tasty food" />
          <span>Choose a tasty food</span>
        </div>
        <div>
          <img src="../../img/useless/2.png" alt="Delivery" />
          <span>Delivery</span>
        </div>
      </div>
      <hr />
      <section class="restaurant-container">
        <div class="restaurant-item">
        <?php
        $user_id = intval($_SESSION["user_id"]);
              if(isset($_GET)){
                $r_id =  $_GET['r_id'];
                $r_id = htmlspecialchars($r_id);
              }
              //session variable to acess cart
              $_SESSION['cart_id']=$r_id;
              $result = mysqli_query($db, "SELECT * from restaurant WHERE r_id = $r_id" );
              while($rows=mysqli_fetch_array($result)){   
        echo ' <img src="../../../'.htmlspecialchars($rows['r_img']).'" alt = "'.$rows['r_name'].'"/>
          <div class="restaurant-info">
            
            <h3>'.$rows['r_name'].'</h3>
            <p>'.$rows['r_address'].'</p>
            <h5>
              ✔ Min️: Rs. 299 &nbsp;🛵: 30 mins &nbsp;
              <span style="color: red">★★★★☆</span>
            </h5>
          </div>';}
        ?> </div>
      </section>
      <hr />
      <section class="food-menu">
        <h1><u>Food Menu</u></h1>
        <div class="menu-items">
          <?php
          
          $query = mysqli_query($db, "SELECT * from dishes WHERE r_id = $r_id" );
          while($row=mysqli_fetch_array($query)){ 
           echo '
          <div class="menu-item" data-name='.$row['d_name'].' data-price = '.$row['d_price'].'>
           <img src="../../../'.htmlspecialchars($row['d_image']).'" alt = "'.$row['d_name'].'"/>
            <h3>'.$row['d_name'].'</h3>
            <p>Rs.'.$row['d_price'].'</p>
            <div class="quantity-controls">
              <button class="minus-btn">-</button>
              <span class="quantity">0</span>
              <button class="add-btn">+</button>
            </div>
            <div class="description">
              '.$row['description'].'
            </div></div>';}?>
        
        </div>
      </section>
      <section
        style="background: #ff7f22; padding: 3%"
        class="cart-summary"
        id="my-cart"
      >
        <h2>
          <u><?php echo'<a
              href="../Cart/index.php"
              style="text-decoration: none; color: white"
              >'?>My Cart</a
            ></u>
        </h2>
        <ul class="cart-items" required>
          <!-- Cart items will be dynamically inserted here -->
        </ul>
        <div class="totals">
          <p>Subtotal: <span>Rs. </span><span id="subtotal">0</span></p>
          <p>Delivery: <span>Rs. </span><span id="delivery">100</span></p>
          <p>Total: <span>Rs. </span><span id="total">100</span></p>
          <p><?php echo $message;?></p>
          <div style="display: flex; justify-content: flex-end">
          <button type="submit" name="add-to-cart">
  <a href='../Cart/index.php?r_id=<?php echo $r_id; ?>' style="text-decoration: none; color: white">
    Add to cart
  </a>
</button>
            </button>
          </div>
        </div>
      </section>
    </main>
    <footer>
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
              src="../../img/social-icon-img/instagramLogo.jpg"
              alt="Instagram"
            />
            <img
              src="../../img/social-icon-img/facebookLogo.jpg"
              alt="Facebook"
            />
          </span>
        </div>
      </div>
      <div class="bottom-bar">
        <p>Powered by: UMA Team</p>
      </div>
    </footer>
    <script src="script.js"></script>
    <script src="../../js/script.js"></script>
  </body>
</html>
