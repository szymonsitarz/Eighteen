<?php
include 'dbc.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$query = "SELECT orders.uid, users.username, users.email, orders.pid, products.name, orders.status, orders.date_time FROM orders INNER JOIN users ON orders.uid = users.uid INNER JOIN products ON orders.pid = products.pid ORDER BY  ";

/* Handling sorting for when a table heading column is clicked. */
if(!isset($_GET['orders_sort']))
    $query .=  "orders.date_time DESC";
else
{
    switch($_GET['orders_sort'])
    {
        case "uid":
            $query .=  "orders.uid";
            break;
        case "username":
            $query .=  "users.username";
            break;
        case "email":
            $query .=  "users.email";
            break;
        case "pid":
            $query .=  "orders.pid";
            break;
        case "status":
            $query .=  "orders.status";
            break;
        default:
            echo "THROW ERROR";
    }
}

$sth = $db->prepare($query);
$sth->execute();
$orders = $sth->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="userorderhistory.css">
<link rel="stylesheet" href="https://fonts.google.com/specimen/Roboto+Condensed">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
  
  
  <div class="bg-colour">
    <nav>
        <div class="logo 1">
         <img src="eighteen.png" alt="eighteen" width="80" height="90"
         div class="main-right">
       
        </div>
        <ul class="list-items">
            <li><a href="#" class="link">HOME</a></li>
            <li><a href="#" class="link">COLLECTIONS</a></li>
            <li><a href="#" class="link">CONTACT US</a></li>
            <li><a href="#" class="link">ABOUT US</a></li>
            
        </ul>
        <div class="nav-btns">
            <a href="#" class="btn-nav-i"><i class="fa fa-search"></i></a>
            <a href="#" class="btn-nav-i"><i class="fa fa-shopping-cart"></i></a>
            <a href="#" class="btn-nav-i"><i class="fa fa-user"></i></a>
            <a href="#" class="btn-nav-i"><i class="fa fa-heart"></i></a>
           
        </div>  
    </nav>
    <div class="main">
        <div class="social-media">
        <a href="#" class="s-btn"><i class="fa fa-facebook-f"></i></a>
        <a href="#" class="s-btn"><i class="fa fa-twitter"></i></a>
        <a href="#" class="s-btn"><i class="fa fa-instagram"></i></a>
      </div>
  </br>
  </br>
    <div class= "orderhistory-container">
      <div class="orderhistory-heading">
        <p>Order History</p>
      </div>
      </br>
      <table id="orderhistorytable">
        <tr>
        <th>Product ID</th>
        <th>Status</th>
        <th>Date & Time ordered </th>
      </tr>
      <tr>
        <td><?=$orders['pid'];?></td>
        <td><?=$orders['status'];?></td>
        <td><?=$orders['date_time'];?></td>
      </tr>
    </table>
    </div>
  </div>
  </div>
  </body>
  <div class="footer-container">
    <div class="footer">
      <div class="footer-heading footer-1">
        <h2>About Us</h2>
            <a href="#">Blog</a>
            <a href="#">Customers</a>
            <a href="#">Investors</a>
            <a href="#">Terms of Services</a>
      </div>

        <div class="footer-heading footer-2">
          <h2>Contact Us</h2>
            <a href="#">Careers</a>
            <a href="#">Support</a>
            <a href="#">Contact</a>
            <a href="#">Sponsorships</a>
        </div>

  <div class="footer-heading footer-3">
        <h2>Social Media </h2>
            <a href="#">Instagram</a>
            <a href="#">Facebook</a>
            <a href="#">Twitter</a>
      </div>

      <div class="footer-email-form">
        <h2>Join our newsletter subscription</h2>
        <input type="email" placeholder="your email address" id="footer-email">
        <input type="submit" value="Sign Up" id="footer-email-btn">
      </div>
    </div>
  </div>
</html>