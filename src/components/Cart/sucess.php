<?php 
session_start();
error_reporting(0);
include '../../../connection/connection.php';
$o_id = $_GET['oid'];
$amt = $_GET['amt'];
$ref_id = $_GET['refId'];
$r_id= $_SESSION['cart_id'];
$u_id = $_SESSION['user_id'];
$location = $_SESSION['location'];
$order = $_SESSION['order'];
$grand_total = $_SESSION['grand_total'];
$sql = "INSERT INTO orders VALUES ('$o_id','$r_id','$u_id')";
mysqli_query($db, $sql);

// Check if the cartData cookie is set
if (isset($_COOKIE['cartData'])) {
    // Decode the JSON data stored in the cookie
    $cartData = json_decode($_COOKIE['cartData'], true);

    // Check for JSON decoding errors
    if (json_last_error() === JSON_ERROR_NONE) {
        $cartArray = []; // Initialize an array to store cart data

        // Iterate through the cart data and display each item
        foreach ($cartData as $item) {
            $name = htmlspecialchars($item['name']);
            $quantity = intval($item['quantity']);
            $price = floatval($item['price']);
            $total = floatval($item['total']);
            $food_detail .= $quantity . '*' . $name . '=' . $total . "\n";
        }
    }
    mysqli_query($db ,"INSERT INTO order_details VALUES ('$o_id','$location','$order','$grand_total','$food_detail')");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #141A26; 
            color: white; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }
        .success-message {
            background-color: #ff7f22; 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            opacity: 0;
            animation: fadeInOut 3s forwards;
        }
        @keyframes fadeInOut {
            0% { opacity: 0; }
            20% { opacity: 1; }
            80% { opacity: 1; }
            100% { opacity: 0; }
        }
    </style>
</head>
<body>
    <div class="success-message">
        <h1>Success!</h1>
        <p>Your action was completed successfully.</p>
        <p>Redirecting to the landing page in 3 seconds...</p>
    </div>
 
    <script>
        setTimeout(function() {
            window.location.href = '../../../index.php'; 
        }, 3000);
    </script>
</body>
</html>