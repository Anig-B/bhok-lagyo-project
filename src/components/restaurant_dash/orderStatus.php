<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
 include '../../../connection/connection.php';  //include connection file
error_reporting(0);  // using to hide undefine undex errors
session_start(); //start temp session until logout/browser closed
session_cache_limiter("private_no_expire");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order Status</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="icon" href=../../img/component-img/foodDelivery.jpg sizes="any">

    <style>
    * {
    margin: 0;
    padding: 0;
    font-family: Inria serif;
    box-sizing: border-box;
}

body {
    background-color: #141A26;
    color: black;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
}

.container {
    max-width: 600px;
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin: 20px;
}
.order-item {
    padding-left: 10%;
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.order-header a {
    margin: 0;
    font-size: 25px;
    font-weight: bold ;
}

.order-details p {
    margin: 10px 0;
    color: black;
}

.order-details select,
.order-status {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

button {
    width: 100%;
    padding: 15px;
    background-color:#ff7f22 ;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 20px;
}

button:hover {
    background-color: #e06b23 ;
}

    </style>
    <link rel="stylesheet" href="../styles/nav-styles.css">
    <link rel="stylesheet" href="../styles/footer-styles.css">
  </head>
 <body>
<main>
    <div class="container">
        <div class="order-header">
            <?php
           $r_id = $_SESSION['r_id']; 
           $query = "SELECT * from orders where r_id = '$r_id'";
           $result = mysqli_query($db,$query);
          
           while($rows=mysqli_fetch_array($result)){
            $o_id = $rows['o_id'];
            $u_id = $rows['u_id'];
            $query2= "SELECT * from order_details where o_id = '$o_id' && status = 1";
            $result2 = mysqli_query($db,$query2);
            while($row1=mysqli_fetch_array($result2)){
           
            $location = $row1['location'];
            $food_detail=$row1['food'];
     
            $total = $row1['total'];
            $query3 ="SELECT * from users where u_id = '$u_id'";
            $result3 = mysqli_query($db,$query3);
            while($row2=mysqli_fetch_array($result3)){
                $u_name = $row2['f_name'];
                $contact = $row2['contact'];
            
                echo ' <a href="order.php">Order # '.$o_id.'</a>
            <select class="order-status">
                <option value="cooking">Being cooked</option>
                <option value="packing">Being packed</option>
                <option value="off-to-delivery">Off to deliver</option>
                <option value="delivered">Delivered</option>
            </select>
        </div> 
         <div class="order-details">
            <p><strong>Customer Name:</strong> '.$u_name.'</p>
            <p><strong>Contact:</strong> '.$contact.'</p>
            <p><strong>Delivery Location:</strong> '.$location.'</p>
            <p><strong>Delivery Driver Name:</strong>
                <select class="delivery-driver">
                    <option value="Ram">Ram</option>
                    <option value="Shyam">Shyam</option>
                    <option value="Dam">Dam</option>
                    <option value="Gam">Gam</option>
                </select>
            </p>
            <p><strong>Ordered Items:</strong></p>
            <ul class="order-item">
                <li>
                    <span>'.$food_detail.'</span>
                 
                </li>

            </ul>
            <p><strong>Total:</strong> '.$total.'</p>
        </div>'
        ;
            }}}
             ?>
           
       
           <button onclick="updateOrderStatus()">Save</button>

<script>
    function updateOrderStatus() {
        alert("Order Status has been updated");
        window.location.href = 'order.php';
    }
</script>
    </div>
</main>
</body>
</html>
