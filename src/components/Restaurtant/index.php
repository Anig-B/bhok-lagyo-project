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
    <title>Restaurant</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/nav-styles.css">
    <link rel="stylesheet" href="../styles/footer-styles.css">
    <style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.root {
    width: 100vw;
    height: 100vh;
    overflow-x: hidden;
}

body {
    width: 100%;
    height: 100%;
    font-family: Inria serif;
    background-color: white;
}

.top-selling-foods {
    text-align: center;
}

.top-selling-foods h2 {
    margin-bottom: 30px;
    font-size: 24px;
    color: #333;
}

.food-grid {
    width: 100%;
    background-color: #1a1a2e;
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
    padding: 20px;
}

.food-item {
    padding: 10px;
    text-align: center;
    color: white;
}

.food-item img {
    max-width: 100%;
    border-radius: 8px;
}

.food-item p {
    margin-top: 10px;
    font-size: 16px;
}


@media (min-width: 576px) {
    .food-grid {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 480px) {
    .view-restaurants {
        padding: 30px 10px;
    }

    .view-restaurants h1 {
        font-size: 20px;
    }

    .view-restaurants-container {
        flex-direction: column;
        justify-content: center;
        gap: 50px;
        align-items: center;
    }

    .view-restaurants-item {
        width: 100%;
    }

        .step-section {
            flex-direction: column;
            align-items: center;
            padding-top: 50px;
            padding-bottom: 20px;
        }

        .step-section div {
            text-align: center;
            margin-bottom: 20px;
        }

        .step-section img {
            max-width: 80px;
            margin-bottom: 10px;  }

        .step-section span {
            font-size: 14px;
        }


}


@media (min-width: 768px) {
    .food-grid {
        grid-template-columns: repeat(3, 1fr);
    }
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
    max-width: 100px;
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

.view-restaurants {
    width: 100%;
    background-color: #1a1a2e;
    text-align: center;
    padding: 40px 20px;
    border: 1px solid #ccc;
}

.view-restaurants h1 {
    margin-bottom: 20px;
    font-size: 24px;
    color: white;
}

.view-restaurants-container {
    display: flex;
    justify-content: center;
    gap: 50px;
}

.view-restaurants-item {
    background: white;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    width: 150px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.view-restaurants-item .stars {
    font-size: 20px;
    color: #f39c12;
    margin-bottom: 10px;
}

.view-restaurants-item button {
    background-color: #3498db;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

.view-restaurants-item button:hover {
    background-color: #2980b9;
}

.step-section {
    display: flex;
    width: 100%;
    justify-content: space-evenly;
    padding-top: 125px;
    padding-bottom: 2%;
}

.step-section div {
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
}

.step-section img {
    max-width: 100px;
    margin-bottom: 10px;
}

   </style>
    <link rel="icon" href=../../img/component-img/foodDelivery.jpg sizes="any">
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
									
                                    echo  '<li class="nav-item"><a href="../Profile/index.php" >Profile</a> </li>';
                                    echo  '<li class="nav-item"><a href="../Cart/index.php" >My Cart</a> </li>';
									echo  '<li class="nav-item"><a href="../login/logout.php">Logout</a> </li>';
							}

						?>
      </ul>
    </nav>
</header>

<div class="step-section">
    <div>
        <img src="../../img/useless/2.1.png" alt="Choose a restaurant">
        <span>Choose a restaurant</span>
    </div>
    <div>
        <img src="../../img/useless/3.png" alt="Choose a tasty food">
        <span>Choose a tasty food</span>
    </div>
    <div>
        <img src="../../img/useless/2.png" alt="Delivery">
        <span>Delivery</span>
    </div>
</div>
<!-- event listener for button -->
<script>
window.onload = function(){
    document.getElementsByName("rating").onclick = function(){
        document.getElementsByName("rating")[0].value = this.value;
        document.forms.myform.submit();
        console.log('rating');
    }
};
</script>
<form method="post">
<section class="view-restaurants" id="view-restaurants">
    <h1>View restaurant based on stars</h1>
    <!-- <input type="hidden" name="postvar" value="" /> -->
    <div class="view-restaurants-container">
        <div class="view-restaurants-item">
            <span style="color: red;">★★★★★</span>
            <button type = 'submit' name='rating' value = '5'> View restaurant</button>
        </div>
        <div class="view-restaurants-item">
            <span style="color: red;">★★★★☆</span>
            <button type = 'submit' name ='rating' value ='4'> View restaurant</button>
        </div>
        <div class="view-restaurants-item">
            <span style="color: red;">★★★☆☆</span>
            <button type = 'submit' name ='rating' value="3"> View restaurant</button>
        </div>
    </div>
</section>
</form>
<section class="featured-restaurants" id="featured-restaurants">
    <h2>Featured Restaurants</h2>
    <div class="restaurant-grid">
        
         <?php 
    $result1=mysqli_query($db, "SELECT * from restaurant WHERE r_ratings='5'" );
    $result2=mysqli_query($db, "SELECT * from restaurant WHERE r_ratings='4'" );
    $result3=mysqli_query($db, "SELECT * from restaurant WHERE r_ratings='3'" );
    $default = mysqli_query($db, "SELECT * from restaurant" );
    if(isset($_POST['rating'])) 
    {
        $rating = $_POST['rating']; 
    } 
   
   switch($rating){
    case 3: $default = $result3;
    break;
    case 4: $default = $result2;
    break;
    case 5: $default = $result1;
    break;
    default: $default;
   }
   
    while($rows=mysqli_fetch_array($default))
     {echo '
   
        <div class="restaurant-item">
            <img src="../../../'.htmlspecialchars($rows['r_img']).'" alt = "'.$rows['r_name'].'"/>
            <div class="restaurant-info">
                <h3>'.$rows['r_name'].'</h3>
                <p>'.$rows['r_address'].'</p>
                <h5>✔ Min️: Rs. 299 &nbsp;🛵: 30 mins</h5>';
                if(!empty($_SESSION["user_id"])) // if user is  login
							{
                $address = "../ViewMenu/index.php";
                echo'
                <button type="submit" name="restaurant" onclick="redirectToPage(\'' . $address . '\', ' . $rows['r_id'] .')">View menu</button>
            </div>
        </div>
    ';}
        else{
          $address = "../login/index.php";
          global $res_id;
          $res_id = $rows['r_id'];
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
    <script>
    console.log(<?= json_encode($rating); ?>);
</script>
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
            <p>📧 bhoklagyo90@gmail.com</p>
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
    <script src="script.js"></script>
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
     >