<!DOCTYPE html>
<html lang="en">
<?php
     include '../../../connection/connection.php';
     error_reporting(0); // hide undefine index errors
   session_start();
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="icon" href=../../img/component-img/foodDelivery.jpg sizes="any">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../styles/nav-styles.css">
    <link rel="stylesheet" href="../styles/footer-styles.css">
    <link rel="icon" href="../../img/component-img/foodDelivery.jpg" sizes="any">
</head>
<body>
<header>
<nav>
      <div class="logo">
          <img src="..\..\..\src\img\useless\logo.png" alt="Logo"/>
      </div>
      <!-- <div class="toggle-button" id="navbar-toggle">&#9776;</div> -->
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
									
									echo  '<li class = "nav-item"><a href="../Cart/index.php">My Cart</a></li>';
									echo  '<li class="nav-item"><a href="../login/logout.php">Logout</a> </li>';
							}

						?>
      </ul>
    </nav>
</header>
<main>
    <div class="cart-container">
        <h1>My Cart</h1>
        <div class="restaurant-container" >
           <p class="restaurant-name">Restaurant-1</p>
        <table class="cart-table">
            <thead>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td data-label="Item">
                    <img src="../../img/special-img/thali.jpg" alt="Thali">
                    Thali
                </td>
                <td data-label="Quantity"><input type="number" value="1" min="1"></td>
                <td data-label="Price">Rs. 850</td>
                <td data-label="Subtotal">Rs. 850</td>
                <td data-label="Action"><button class="delete-item">Delete</button></td>
            </tr>
            <tr>
                <td data-label="Item">
                    <img src="../../img/special-img/fastfood.jpg" alt="Burger">
                    Burger
                </td>
                <td data-label="Quantity"><input type="number" value="2" min="1"></td>
                <td data-label="Price">Rs. 200</td>
                <td data-label="Subtotal">Rs. 400</td>
                <td data-label="Action"><button class="delete-item">Delete</button></td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3">Total</td>
                <td id="subtotal">Rs. 1250</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3">Delivery Charge</td>
                <td id="delivery-1">Rs. 100</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3">Grand Total</td>
                <td id="total-1">Rs. 1350</td>
                <td></td>
            </tr>
            </tfoot>
        </table>

        <div class="payment">
            <label for="payment-mode">Payment mode:</label>
            <select id="payment-mode-1" name="payment-mode" required="required">
                <option>Cash On delivery</option>
                <option>Esewa payment</option>
            </select>
        </div>

        <div class="location-section">
            <label for="location">Location:</label>
            <input name="location" type="text" id="location-1" required="required" placeholder="Enter your delivery location"/>
        </div>
        <div class="location-section">
            <label for="order">Customise Order:</label>
            <input name="order" type="text" id="order-1"  placeholder="Enter your customization"/>
        </div>
        <div class="cart-buttons">
            <a href="../Restaurtant-View/index.html" class="continue">Continue Shopping</a>
            <div class="button-wrapper">
                <button class="checkout">Checkout</button>
            </div>
        </div>
        </div>
        <div class="restaurant-container" >
           <p class="restaurant-name">Restaurant-2</p>
        <table class="cart-table">
            <thead>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td data-label="Item">
                    <img src="../../img/special-img/thali.jpg" alt="Thali">
                    Thali
                </td>
                <td data-label="Quantity"><input type="number" value="1" min="1"></td>
                <td data-label="Price">Rs. 850</td>
                <td data-label="Subtotal">Rs. 850</td>
                <td data-label="Action"><button class="delete-item">Delete</button></td>
            </tr>
            <tr>
                <td data-label="Item">
                    <img src="../../img/special-img/fastfood.jpg" alt="Burger">
                    Burger
                </td>
                <td data-label="Quantity"><input type="number" value="2" min="1"></td>
                <td data-label="Price">Rs. 200</td>
                <td data-label="Subtotal">Rs. 400</td>
                <td data-label="Action"><button class="delete-item">Delete</button></td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3">Total</td>
                <td id="subtotal-1">Rs. 1250</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3">Delivery Charge</td>
                <td id="delivery">Rs. 100</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3">Grand Total</td>
                <td id="total">Rs. 1350</td>
                <td></td>
            </tr>
            </tfoot>
        </table>

        <div class="payment-section">
            <label for="payment-mode">Payment mode:</label>
            <select id="payment-mode" name="payment-mode" required="required">
                <option>Cash On delivery</option>
                <option>Esewa payment</option>
            </select>
        </div>

        <div class="location-section">
            <label for="location">Location:</label>
            <input name="location" type="text" id="location" required="required" placeholder="Enter your delivery location"/>
        </div>

        <div class="cart-buttons">
            <a href="../Restaurtant-View/index.html" class="continue">Continue Shopping</a>
            <div class="button-wrapper">
                <button class="checkout">Checkout</button>
            </div>
        </div>
        </div>
    </div>
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
                <img src="../../img/social-icon-img/instagramLogo.jpg" alt="Instagram">
                <img src="../../img/social-icon-img/facebookLogo.jpg" alt="facebook">
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
