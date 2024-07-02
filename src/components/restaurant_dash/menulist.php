<!DOCTYPE html>
<html lang="en" class="root">
      <?php
 include '../../../connection/connection.php';  //include connection file
error_reporting(0);  // using to hide undefine undex errors
session_start(); //start temp session until logout/browser closed
session_cache_limiter("private_no_expire");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Menu Management</title>
    <style>
     * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.menu-management-container {
    margin: 100px auto;
    width: 80%;
    background-color: #2E3B4E;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    color: white;
}

.menu-management-container h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #FF7527;
}
.button-container{
    background: white; display: flex;
    align-content: center;
    justify-content: center;
    padding: 1%;
    border-radius: 10px;
}
.add-item-button {
    display: block;
    padding: 10px 20px;
    background-color: #FF7527;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.add-item-button:hover {
    background-color: #e06b23;
}

.menu-table {
    width: 100%;
    border-collapse: collapse;
}

.menu-table th, .menu-table td {
    padding: 10px;
    text-align: center;
}

.menu-table th {
    background-color: #3A4C63;
}

.menu-table td {
    background-color: #2E3B4E;
}

.menu-table img {
    width: 50px;
    height: auto;
    border-radius: 4px;
}

.menu-table button {
    padding: 5px 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.menu-table .edit {
    background-color: #FF7527;
    color: white;
}

.menu-table .edit:hover {
    background-color: #e06b23;
}

.menu-table .delete {
    background-color: #e74c3c;
    color: white;
}

.menu-table .delete:hover {
    background-color: #c0392b;
}
</style>
    <link rel="stylesheet" href="../styles/nav-styles.css">
    <link rel="stylesheet" href="../styles/footer-styles.css">
    <link rel="icon" href="../../img/component-img/foodDelivery.jpg" sizes="any">
</head>
<body>
<header>
<nav>
        <div class="logo">
          <a href="order.php">
          <img src="../../img/useless/logo.png" alt="Logo"/></a>
        </div>
        <div class="toggle-button" id="navbar-toggle">&#9776;</div>
        <ul class="menu" id="navbar-links">
          <?php
          if(isset($_SESSION['r_id'])){
            echo'
          <li><a href="order.php">Orders</a></li>
          <li><a href="menulist.php">Menu List</a></li>
          <li><a href="delivery.php">Delivery</a></li>
            <li><a href="restaurantsetting.php">Setting</a></li>
          <li><a href="../login/logout.php">Signout</a></li>';}
          else {
            header('location: ../../../index.php');
          };?>
        </ul>
      </nav>
</header>

<main>
    <div class="menu-management-container">
        <h1>Admin Menu Management</h1>
        <table class="menu-table">
            <thead>
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="menu-items">
            <tr>
                <td><div contenteditable>Thali</div></td>
                <td>Rs. 850</td>
                <td><img src="../../img/special-img/thali.jpg" alt="Thali"></td>
                <td>
                    <button class="edit">
                        <a href="editmenu.php" style="color: white;text-decoration: none">Edit</a>
                        </button>
                    <button class="delete">Delete</button>
                </td>
            </tr>
            <tr>
                <td>Burger</td>
                <td>Rs. 200</td>
                <td><img src="../../img/special-img/fastfood.jpg" alt="Burger"></td>
                <td>
                    <button class="edit">
                        <a href="editmenu.php" style="color: white;text-decoration: none">Edit</a>
                    </button>                    <button class="delete">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="button-container" >
        <button class="add-item-button">
            <a href="Addmenu.php" style="color: white;text-decoration: none">Add New Item</a>
        </button>
        </div>
    </div>
</main>
<footer>
    <div class="footer-content-white" style="background:  #FF7527">
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
<script src="../../js/nav.script.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuItems = document.querySelector('#menu-items');

        menuItems.addEventListener('click', (event) => {
            if (event.target.classList.contains('delete')) {
                if (confirm('Are you sure you want to delete this item?')) {
                    const row = event.target.closest('tr');
                    row.remove();
                }
            }
        });
    });
</script>
</body>
</html>
