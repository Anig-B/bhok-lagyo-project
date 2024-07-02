<?php
session_start();
error_reporting(0);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the selected payment mode
    $paymentMode = $_POST['payment-mode'];
    $_SESSION['location'] = $_POST['location'];
   $_SESSION['order'] = $_POST['order'];
   $_SESSION['grand_total'] = $_POST['grand_total'];
    $grand_total = $_POST['grand_total'];
$random = rand(1000,3000);

    // Calculate total, delivery charge, and grand total
    // $total = $_SESSION['cart_total'];

    if ($paymentMode == 'esewa') {
        // Redirect to eSewa payment
        echo '<form id="esewa-form" action="https://uat.esewa.com.np/epay/main" method="POST">
                <input value="' . $grand_total . '" name="tAmt" type="hidden">
                <input value="' . $grand_total . '" name="amt" type="hidden">
                <input value="0" name="txAmt" type="hidden">
                <input value="0" name="psc" type="hidden">
                <input value="0" name="pdc" type="hidden">
                <input value="epay_payment" name="scd" type="hidden">
                <input value="'.$random.'" name="pid" type="hidden">
                <input value="http://localhost/bhoklagyo/src/components/Cart/sucess.php" type="hidden" name="su">
                <input value="http://localhost/bhoklagyo/src/components/Cart/index.php" type="hidden" name="fu">
              </form>
              <script type="text/javascript">
                document.getElementById("esewa-form").submit();
              </script>';
    } elseif ($paymentMode == 'cod') {
        // Handle Cash On Delivery
        // Save the order details in the database
        // Redirect to a success page
        header('Location: index.php');
        exit;
    }
}
