<?php
/* session_start();
require("functions.php");

if (isset($_SESSION['username'])) {   
    header("Location: index.php"); 
}
*/
include 'dbc.php';
$pone= $db->prepare("SELECT * From users WHERE id='1'"); 
$pone->execute(); 
$result=$pone->fetch(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="account.css">
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
        <div class="details-container">
            </br>
            </br>
            <p class="heading">Account Details</p>
            
            </br>
            <div class="first-name">
                <p>First Name:</p>
                <p><?=$result['firstname'];?></p>
            </div>
            </br>
            <div class="last-name">
                <p>Last Name:</p>
                <p><?=$result['lastname'];?></p>
            </div>
            </br>
            <div class="username">
                <p>Username:</p>
                <p><?=$result['username'];?></p>
            </div>
            </br>
            <div class="email">
                <p>Email:</p>
                <p><?=$result['email'];?></p>
            </div>
            </br>
            </br>
            </br>
            <div class="chng-password">
                <p>Want to change your password? <a href="changepassword.php" class="chng-password-link">Click here</a></p>
            </div>
        </div>
        </div>
    </div>
    </br>
    </br>
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

