<?php
session_start();
 //Including connection to server
    include '../../../connection/connection.php';
   global $db;
   if (!$db) {
    die("Database connection failed");
}
//assigning form value to variables
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (isset($_POST)) {
        $check = mysqli_query($db, "SELECT * from users where email ='" . $email . "' AND password='".md5($password)."' " );
        if(mysqli_num_rows($check)==1){
            header('location:../../../index.html');

        }
        else
            echo "Wrong email & password";
        
    }
   