<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/shared-files/200219998/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="/header/header.css">
<link rel="stylesheet" href="/footer/footer.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="changepassword.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="top-header">
    <header class="main-header">
      <nav class = "navigation-bar">
          <div class="logooo 1">
              <a href="/home/home.php">
            <img src="/shared-files/logo.png" alt="" width="80" height="90" div class="fully-right">
           </div>
          </a>
          
          <ul class="main-list-items">
              <li class="each-li"><a href="/home/home.php" class="link">HOME</a></li>
              <li class="each-li"><a href="/collections/collections.php" class="link">COLLECTIONS</a></li>
              <li class="each-li"><a href="/contact/contact.php" class="link">CONTACT US</a></li>
              <li class="each-li"><a href="/about-us/about-us.php" class="link">ABOUT US</a></li>
             
              
          </ul>
      
          <div class="navigation-buttons">

              <a href="/account/accountinfo.php" class="button-navigation-i"><i class="fa fa-user"></i></a>
              <?php
                    if(!isset($_SESSION['auth']))
                    {?>
                   
                        <a href="/auth/login.php" class="button-navigation-i">Login</a>
                        <a href="/auth/register.php" class="button-navigation-i">Register</a><?php
                    }
                    else
                    {
                        $size=40;?>
                        <a href="/cart/cart.php" class="button-navigation-i"><i class="fa fa-shopping-cart"></i></a>
                        <a href="/auth/logout.php" class="button-navigation-i">Logout</a><?php
                    }
                ?>
          </div>
      </nav>
    </header>
  </div>

</head>
<body>
    <div class="bg-colour">
       <!-- <nav>
            <div class="logo 1">
             <img src="eighteen.png" alt="eighteen" width="80" height="90"
             div class="main-right">
           
            </div>
            <ul class="list-items">
                <li><a href="/home/home.php" class="link">HOME</a></li>
                <li><a href="/collections/collections.php" class="link">COLLECTIONS</a></li>
                <li><a href="/contact/contact.php" class="link">CONTACT US</a></li>
                <li><a href="/about-us/about-us.php" class="link">ABOUT US</a></li>
                
            </ul>
            <div class="nav-btns">
                <a href="#" class="btn-nav-i"><i class="fa fa-search"></i></a>
                <a href="#" class="btn-nav-i"><i class="fa fa-shopping-cart"></i></a>
                <a href="#" class="btn-nav-i"><i class="fa fa-user"></i></a>
                <a href="#" class="btn-nav-i"><i class="fa fa-heart"></i></a>
               
            </div>
        </nav>-->
        

        <div class="main">
        <div class="main-left">
            <div class="social-media">
        
            <a href="#" class="s-btn"><i class="fa fa-facebook-f"></i></a>
            <a href="#" class="s-btn"><i class="fa fa-twitter"></i></a>
            <a href="#" class="s-btn"><i class="fa fa-instagram"></i></a>
          </div>
        </div>
        </br>
        <div class="form">
          <?php
              $_SESSION['auth'] = "admin";
              if(isset($_SESSION['auth']))
              {
                if (isset($_POST['submit']))
                {
                  $query = "SELECT password FROM users WHERE username=:username LIMIT 1";
                  $sth = $db->prepare($query);
                  $sth->bindParam(":username", $_SESSION['auth']);
                  $sth->execute();
                  $row = $sth->fetch(PDO::FETCH_ASSOC);
                  if($_POST['new-password'] == $_POST['confirm-new-password'])
                  {
                    if(password_verify($_POST['current-password'], $row['password']))
                    {
                      $query= 'UPDATE users SET password=:password WHERE username=:username';
                      $sth = $db->prepare($query);
                      $sth->bindParam(":password", $_POST['new-password']);
                      $sth->bindParam(":username", $_SESSION['auth']);
                      $sth->execute();
                      echo "<script>alert('Password changed.');</script>";
                    }
                    else {
                      echo "<script>alert('Error: Current password is incorrect.');</script>";
                    }
                  }
                  else {
                    echo "<script>alert('Error: New passwords do not match.');</script>";
                  }
              }
            }
              ?>
                <form method="POST" action="">
                <h3>Change your Password here</h3>
                </br>
                </br>
                <input name="current-password" id="password" type="password" placeholder="Current Password" required>
                <input name="new-password" id="password" type="password" placeholder="New Password" required>
                <input name="confirm-new-password" id="password" type="password" placeholder="Confirm New Password" required>
            </br>
            </br>
                <button name="submit">CHANGE PASSWORD</button>
              </form>
            </div>
        </div>
        </div>
    </div>
    </br>
    </br>
    </br>
    <div class="end-footer">

  <div class="main-footer-container">
      <div class="inside-footer">
          <div class="footer-heading1 foooter-1">
          <h2>Terms & Conditions</h2>
              <a href="/footer_pages/privacy-policy.html">Privacy Policy</a>
              <a href="/footer_pages/return-policy.html">Return Policy</a>
              <a href="/footer_pages/Terms.html">Terms & Conditions</a>
          </div>

          <div class="footer-heading1 foooter-2">
              <h2>Customer Service</h2>
              <a href="/contact/contact.php">Contact Us</a>
              <a href="/footer_pages/faq.html">FAQ's</a>
          </div>
              
          <div class="footer-heading1 foooter-3">
              <h2>Information</h2>
              <a href="/footer_pages/delivery-faq.html">Delivery Information</a>
              <a href="/footer_pages/genral-faq.html">Genral Information</a>
              <a href="/footer_pages/payments-faq.html">Payments Information</a>
              <a href="/footer_pages/products-faq.html">Products Information</a>
              <a href="/footer_pages/Vouchers-faq.html">Vouchers Information</a>
              <a href="/footer_pages/returns-faq.html">Returns Information</a>
          </div>

          <div class="footer-email-form1">
          <h2>Join our newsletter subscription</h2>
          <input type="email" placeholder="your email address" id="footer-email1">
          <input type="submit" value="Sign Up" id="footer-email-btn1">
          </div>
      </div>

  </div>
  </div>
  </body>

  
    <!--<div class="footer-container">
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
  </div>-->

</html>
