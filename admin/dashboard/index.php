<!DOCTYPE html>
<html lang="en">
    <?php
     include '../../connection/connection.php';
     error_reporting(0); // hide undefine index errors
    session_start();
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
session_cache_limiter("private_no_expire")
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <!-- <link rel="stylesheet" href="styles.css" /> -->
    <link rel="icon" href=..\..\src\img\component-img\foodDelivery.jpg sizes="any">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<div class="container">
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h2>Admin Panel</h2>
            <button id="toggle-btn" class="toggle-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <ul class="sidebar-menu">
            <li><a href="#dashboard"><i class="fas fa-tachometer-alt"></i> &nbsp Dashboard</a></li>
            <li><a href="#orders"><i class="fas fa-box"></i> &nbsp Order</a></li>
            <!-- <li><a href="#products"><i class="fas fa-hamburger"> </i> &nbsp Product</a></li> -->
            <li><a href="#users"><i class="fas fa-users"></i> &nbsp User</a></li>
            <li><a href='#restaurants'><i class="fas fa-utensils"></i>&nbsp Restaurant</a></li>
            <li><a href="..\index.php"><i class="fas fa-cog"></i> &nbsp Logout</a></li>
            <li><a href="#add-restaurant"><i class="fas fa-utensils"></i> Add Restaurant</a></li>
        </ul>
    </aside>
    <main class="main-content" id="main-content">
        <section id="dashboard">
            <h1><u>Dashboard</u></h1>
            <div class="report">
                <canvas id="ordersChart"></canvas>
            </div>
            <div class="report">
                <canvas id="revenueChart"></canvas>
            </div>
            <!-- <div class="top-items">
                <h1><u>Top Selling Items</u></h1>
                <ul>
                    <li>Burger</li>
                    <li>Pizza</li>
                    <li>Pasta</li>
                </ul>
            </div> -->
            <!-- <div class="top-restaurants">
            <ul>
            <h1><u>Top Restaurants</u></h1>
    
                //  $result = mysqli_query($db, "SELECT r_name from restaurant" );
                //  while($rows=mysqli_fetch_array($result))
                // echo"
               
                
                //     <li>'".$rows['r_name']."'</li>
             
                // ";
                </ul>
            </div> -->
        </section>
        <section id="orders">
            <h1><u>Orders</u></h1>
            <table>
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Order Details</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = mysqli_query($db,"SELECT * from orders");
                    while($rows=mysqli_fetch_array($sql)){
                       $u_id =$rows['u_id'];
                       $o_id = $rows['o_id'];
                        $result = mysqli_query($db, "SELECT * from users where u_id =$u_id " );
                        $result2 = mysqli_query($db, "SELECT * from order_details where o_id =$o_id " );
                        while($row=mysqli_fetch_array($result)){
                            while($row2=mysqli_fetch_array($result2)){
                        echo'
                        <tr>
                            <td>'.$rows['o_id'].'</td>
                            <td>'.$row['f_name'].'</td>
                            <td>'.$row2['food'].'</td>
                        </tr>';
                  }  }}?>
                   
                </tbody>
            </table>
        </section>
       

         <section id="users">            <!--  User details view section -->
            <h1><u>Users</u></h1>
            <table>
                <thead>
                <tr>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                </tr>
                </thead>
                <tbody>
                                    <!--dynamic user data fetch php-->
                    <?php
                      $result = mysqli_query($db, "SELECT u_id,f_name,l_name,email,contact from users" );
                      while($rows=mysqli_fetch_array($result))
                    echo"
                 <tr>
                    <td>".$rows['u_id']."</td>
                    <td>".$rows['f_name']."</td>
                    <td>".$rows['l_name']."</td>
                    <td>".$rows['email']."</td>
                    <td>".$rows['contact']."</td>
                     </tr>"
                    ?>
                      </tbody>
            </table>
        </section>

  <section id="restaurants">            <!--  Restaurant details view section -->
            <h1><u>Restaurant</u></h1>
            <table>
                <thead>
                <tr>
                    <th>Restaurant ID</th>
                    <th> Name</th>
                    <th>Adress</th>
                    <!-- <th>Email</th> -->
                    <th>Contact</th>
                </tr>
                </thead>
                <tbody>
                                    <!--dynamic user data fetch php-->
                    <?php
                      $result = mysqli_query($db, "SELECT r_id,r_name,r_address,r_contact from restaurant" );
                      while($rows=mysqli_fetch_array($result))
                    echo"
                 <tr>
                    <td>".$rows['r_id']."</td>
                    <td>".$rows['r_name']."</td>
                    <td>".$rows['r_address']."</td>
                <!-- <td>".$rows['email']."</td>-->
                    <td>".$rows['r_contact']."</td>
                     </tr>"
                    ?>
               
                </tbody>
            </table>
        </section>
        <section id="add-restaurant">
            <?php
            if (isset($_POST))  // if records were not empty
            {
              $restaurant_details = array($r_name = $_POST["r_name"], $r_address = $_POST['r_address'], $contact = $_POST['contact'],$img=$_POST['r_img'], $o_hrs = $_POST['o_hrs'], $c_hrs = $_POST['c_hrs'],$o_days = $_POST['o_days']);
               
              //check email if already present or not 
                $check_name = mysqli_query($db, "SELECT r_name from restaurant WHERE r_name ='" . $restaurant_details[0] . "' ");
                if (mysqli_num_rows($check_name) > 0) {
                    $message = "Name Already Exist"."<br/>.<br/>";
                   
                } 
             elseif(strlen($_POST['contact']) < 10)  //contact length
             {
                 $message = "invalid phone number!"."<br/>.<br/>";
             }
                else {
                     //insertion of restaurant_details
                    $sql = "INSERT INTO restaurant(r_name,r_address,r_contact,r_img, r_openingHrs,r_closingHrs,r_openingDays) VALUES('" . $restaurant_details[0] . "','" . $restaurant_details[1] . "','" . $restaurant_details[2] . "','src/img/restaurant-img/".$restaurant_details[3]. "','" . $restaurant_details[4] . "','" . $restaurant_details[5] . "','" . $restaurant_details[6] . "')";
                    mysqli_query($db, $sql);
                    $success = "Restaurant Added Succesfully</br>";
                    session_destroy();
                    header('refresh:5 url=../index.php');
                }
            }?>
        <div class="sign-in-container">
      <div class="sign-in-form">
        <h1>Add Restaurant</h1>
        <form action="" method="post">
          <div class="form-row">
            <div class="form-group">
              <label for="r_name">Name:</label>
              <input type="text" id="r_name" name="r_name" required />
            </div>
            <div class="form-group">
              <label for="r_address">Address:</label>
              <input type="text" id="r_address" name="r_address" required />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="contact">Contact no. :</label>
              <input type="text" id="contact" name="contact" required />
            </div>
            <div class="form-group">
              <label for="r_img">Select Image:</label>
              <input type="file" id="r_img" name="r_img" required />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="o_hrs">Opening Hours:</label>
              <input type="text" id="o_hrs" name="o_hrs" required />
            </div>
            <div class="form-group">
              <label for="o_hrs">Closing Hours:</label>
              <input type="text" id="c_hrs" name="c_hrs" required />
            </div>
            <div class="form-group">
              <label for="o_days">Opening days:</label>
              <input type="text" id="o_days" name="o_days" required />
            </div>
          </div>
          
				 <span style="color:red;"><?php if(!empty($_POST)){ echo $message;} ?></span>
				<span style="color:green;"><?php echo $success; ?></span>
          <button type="submit">Add Restaurant</button>
        </form>
      </div>
    </div>
        </section>
    </main>
    <button id="toggle-btn-closed" class="toggle-btn-closed">
        <i class="fas fa-bars"></i>
    </button>
</div>
<script src="script.js"></script>
</body>
</html>
