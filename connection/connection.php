<?php
// main connection file for both admin & frontend
$servername = "localhost"; //server
$username = "root"; //username
$password = ""; //password
$dbname = "bhoklagyo";  //database

// Create connection
global $db;
$db = mysqli_connect($servername, $username, $password, $dbname); // connecting 
// Check connection
if (!$db) {       //checking connection to DB	
    die("Connection failed: " . mysqli_connect_error());
}