<?php
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
}
?>

<!DOCTYPE html>
<html lang="en" class = "root">
<?php
     include '../../../connection/connection.php';
     error_reporting(0); // hide undefine index errors
   session_start();
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="icon" href=../../img/component-img/foodDelivery.jpg sizes="any">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../styles/nav-styles.css">
    <link rel="stylesheet" href="../styles/footer-styles.css">
    <link rel="icon" href="../../img/component-img/foodDelivery.jpg" sizes="any">
    <!-- <style>
    * {
         font-family: Inria serif;
         margin: 0;
        padding: 0;
        box-sizing: border-box;
}

body {
 
  background-color: #f4f4f4;
}

main {
  display: flex;
  justify-content: center;
}

.cart-container {
  margin-top: 10%;
  margin-bottom: 5%;
  width: 80%;
  background-color: #141a26;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  color: white;
}
.restaurant-container {
  padding: 2%;
}
.cart-container h1 {
  text-align: center;
  margin-bottom: 20px;
  color: #ff7527;
}

.restaurant-name {
  background-color: #ff7527;
  color: white;
  padding: 10px;
  border-radius: 4px;
  text-align: center;
  margin-bottom: 20px;
}

.cart-table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
  overflow-x: auto;
}

.cart-table th,
.cart-table td {
  padding: 12px 15px;
  text-align: center;
  border-bottom: 1px solid #3a4c63;
}

.cart-table th {
  background-color: #3a4c63;
  color: white;
}

.cart-table td {
  background-color: #2e3b4e;
  color: white;
}

.cart-table img {
  width: 50px;
  height: auto;
  margin-right: 10px;
  vertical-align: middle;
}

.cart-table input {
  width: 50px;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  text-align: center;
  font-size: 14px;
}

.cart-table tfoot {
  font-weight: bold;
}

.cart-buttons {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin-top: 20px;
  align-items: center;
}

.cart-buttons .continue,
.cart-buttons .checkout {
  background-color: #ff7527;
  color: white;
  border: none;
  padding: 12px 24px;
  border-radius: 4px;
  cursor: pointer;
  font-size: 14px;
  transition: background-color 0.3s ease;
}

.cart-buttons .continue:hover,
.cart-buttons .checkout:hover {
  background-color: #e06b23;
}

.payment-section,
.location-section {
  margin-top: 20px;
  background-color: #ff7527;
  padding: 15px;
  border-radius: 4px;
}

.payment-section label,
.location-section label {
  display: block;
  margin-bottom: 10px;
  color: #141a26;
}

.payment-section select,
.location-section input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: white;
  color: #2e3b4e;
}

.cart-table .delete-item {
  background-color: #ff5555;
  color: white;
  border: none;
  padding: 8px 16px;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.cart-table .delete-item:hover {
  background-color: #ff3333;
}

@media (max-width: 768px) {
  .cart-container {
    width: 90%;
    padding: 15px;
    margin-top: 20%;
  }

  .cart-table input {
    width: 40px;
    padding: 6px;
  }

  .cart-buttons .continue,
  .cart-buttons .checkout {
    padding: 10px 20px;
    flex: 1 1 100%;
    margin: 5px 0;
  }

  .payment-section,
  .location-section {
    margin-top: 10px;
  }
}

@media (max-width: 480px) {
  .cart-container {
    margin-top: 30%;
  }

  .cart-table,
  .cart-table thead,
  .cart-table tbody,
  .cart-table th,
  .cart-table td,
  .cart-table tr {
    display: block;
  }

  .cart-table thead tr {
    position: absolute;
    top: -9999px;
    left: -9999px;
  }

  .cart-table tr {
    border: 1px solid #3a4c63;
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 8px;
    background-color: #2e3b4e;
  }

  .cart-table td {
    border: none;
    position: relative;
    padding-left: 50%;
    text-align: left;
  }

  .cart-table td::before {
    position: absolute;
    top: 50%;
    left: 10px;
    width: 45%;
    padding-right: 10px;
    white-space: nowrap;
    transform: translateY(-50%);
    content: attr(data-label);
    color: #ff7527;
    font-weight: bold;
  }

  .cart-table td img {
    display: inline-block;
    width: 40px;
  }

  .cart-table td input {
    width: 35px;
    padding: 5px;
  }

  .cart-buttons .continue,
  .cart-buttons .checkout {
    padding: 8px 16px;
    font-size: 12px;
  }

  .payment-section select,
  .location-section input {
    padding: 8px;
    font-size: 14px;
  }

  .cart-table tfoot {
    display: block;
    margin-top: 10px;
    padding: 10px;
    border-radius: 8px;
    background-color: #2e3b4e;
  }

  .cart-table tfoot tr {
    display: block;
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 8px;
    background-color: #2e3b4e;
  }

  .cart-table tfoot td {
    display: block;
    position: relative;
    padding-left: 50%;
    text-align: left;
  }

  .cart-table tfoot td:before {
    position: absolute;
    top: 0;
    left: 0;
    width: 45%;
    padding-right: 10px;
    white-space: nowrap;
    transform: none;
    content: attr(data-label);
    color: #ff7527;
    font-weight: bold;
  }
}
</style> -->
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
          <a href="../Restaurant/index.php">Restaurant</a>
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
									
                                    echo  '<li class="nav-item"><a href="../Profile/index.php" >Profile</a> </li>';
                                    echo  '<li class="nav-item"><a href="../Cart/index.php" >My Cart</a> </li>';
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
            <?php $r_id = $_GET['r_id'];
            if(!isset($r_id)){
               $r_id= $_SESSION['cart_id'];
            }
            $sql = mysqli_query($db, "SELECT * from restaurant where r_id = $r_id");
          $rows =mysqli_fetch_array($sql);
            if(is_array($rows)){
            echo' 
           <p class="restaurant-name">'.$rows['r_name'].'</p>';}?>
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
            <?php 
if (isset($_COOKIE['cartData'])) {
    foreach ($cartData as $item) {
        $name = mysqli_real_escape_string($db, $item['name']);
        $query = "SELECT d_image FROM dishes WHERE d_name = '$name'";
        $result = mysqli_query($db, $query);

        // Fetching and displaying the image
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $total += $item['total'];
                echo '
                <tr>
                    <td data-label="Item">
                        <img src="../../../' . htmlspecialchars($row['d_image']) . '" alt="' . htmlspecialchars($row['d_name']) . '"/>
                        ' . htmlspecialchars($item['name']) . '
                    </td>
                    <td data-label="Quantity">' . intval($item['quantity']) . '</td>
                    <td data-label="Price">Rs. ' . floatval($item['price']) . '</td>
                    <td data-label="Subtotal">Rs. ' . floatval($item['total']) . '</td>
                    <td data-label="Action"><button class="delete-item" data-name="' . htmlspecialchars($item['name']) . '">Delete</button></td>
                </tr>';
            }
        }
    }
}
?>

               
            <!-- <tr>
                <td data-label="Item">
                    <img src="../../img/special-img/fastfood.jpg" alt="Burger">
                    Burger
                </td>
                <td data-label="Quantity"><input type="number" value="2" min="1"></td>
                <td data-label="Price">Rs. 200</td>
                <td data-label="Subtotal">Rs. 400</td>
                <td data-label="Action"><button class="delete-item">Delete</button></td>
            </tr> -->
            </tbody>
            <tfoot>
                <?php 
                $sum = $total-$item['total'];
                $d_charge = 100;
                $grand_total = $sum+$d_charge;
                echo '
            <tr>
                <td colspan="3">Total</td>
                <td id="subtotal">Rs. '.$sum.'</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3">Delivery Charge</td>
                <td id="delivery-1">Rs. '.$d_charge.'</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3">Grand Total</td>
                <td id="total-1">Rs. '.$grand_total.'</td>
                <td></td>
            </tr>'?>
            </tfoot>
        </table>
        <form action="checkout.php" method="post">
        <div class="payment">
                <label for="payment-mode">Payment mode:</label>
                <select id="payment-mode-1" name="payment-mode" required="required">
                    <option value="cod">Cash On Delivery</option>
                    <option value="esewa">Esewa Payment</option>
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

        <?php
                $sum = $total - $item['total'];
                $d_charge = 100;
                $grand_total = $sum + $d_charge;
                echo '<input type="hidden" name="grand_total" value="' . $grand_total . '">';
                ?>
        <div class="cart-buttons">
                <div class="button-wrapper">
                    <button class="checkout" name="checkout">Checkout</button>
                </div>
            </div>
            </form>
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

<script>document.addEventListener("DOMContentLoaded", function () {
  const deleteButtons = document.querySelectorAll(".delete-item");

  // Function to get a cookie
  function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(";");
    for (let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) === " ") c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }

  // Function to set a cookie
  function setCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    const expires = "expires=" + date.toUTCString();
    document.cookie =
      name + "=" + JSON.stringify(value) + ";" + expires + ";path=/";
  }

  // Function to update the cart cookie
  function updateCartCookie(cartData) {
    setCookie("cartData", cartData, 1);
  }

  // Event listener for delete buttons
  deleteButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const row = button.closest("tr");
      const itemName = button.getAttribute("data-name");

      // Remove the row from the table
      row.parentNode.removeChild(row);

      // Update the cart data in the cookie
      const cartData = JSON.parse(getCookie("cartData")) || [];
      const updatedCartData = cartData.filter((item) => item.name !== itemName);
      updateCartCookie(updatedCartData);

      // Update the displayed subtotal and total (optional)
      let subtotal = 0;
      updatedCartData.forEach((item) => {
        subtotal += item.total;
      });
      document.getElementById("subtotal").textContent = "Rs. " + subtotal;
      const deliveryCharge = 100; // example delivery charge
      document.getElementById("total-1").textContent =
        "Rs. " + (subtotal + deliveryCharge);
    });
  });
});
</script>
<script src="../../js/script.js"></script>
</body>
</html>
