<?php
session_start();


include '../../../connection/connection.php'; //databse connection
global $db;
if (!$db) {
    die("Database connection failed");
}

$user_details = array($firstname = $_POST["firstname"], $lastname = $_POST['lastname'], $contact = $_POST['contact'], $email = $_POST['email'], $password = $_POST['password']);
if (isset($_POST))  // if records were not empty
{
    //check email if already present or not 
    $check_email = mysqli_query($db, "SELECT email from users where email ='" . $user_details[3] . "' ");
    if (mysqli_num_rows($check_email) > 0) {
        $message = "Email Already Exist";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } 
elseif($_POST['password'] != $_POST['confirm-password']){  //matching passwords
        $message = "Password not match";
        echo "<script type='text/javascript'>alert('$message');</script>";
 }
 elseif(strlen($_POST['password']) < 10)  //password length
 {
     $message = "Password Must be >=10";
     echo "<script type='text/javascript'>alert('$message');</script>";
 }
 elseif(strlen($_POST['contact']) < 10)  //contact length
 {
     $message = "invalid phone number!";
     echo "<script type='text/javascript'>alert('$message');</script>";
 }
 elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // Validate email address
 {
        $message = "Invalid email address please type a valid email!";
        echo "<script type='text/javascript'>alert('$message');</script>";
 }

    else {
         //insertion of user_details
        $sql = "INSERT INTO users(f_name,l_name,contact,email,password) VALUES('" . $user_details[0] . "','" . $user_details[1] . "','" . $user_details[2] . "','" . $user_details[3] . "','" . md5($user_details[4]) . "')";
        mysqli_query($db, $sql);
        //header to login page
        header('refresh:0,url=../login/index.html');


    }
}
else {
    echo "form action is undefined";
}
