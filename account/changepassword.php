<?php
require_once("dbc.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="changepassword.css">
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

              if (isset($_POST['submit'])){
                $email=mysqli_real_escape_string($db,($_POST['email']));
                $password=mysqli_real_escape_string($db,($_POST['password']));
                $newpassword=mysqli_real_escape_string($db,($_POST['newpassword']));
                
            
                $sql = "SELECT * FROM users WHERE email='$email'" or die("Failed to query database".mysql_error());
                $result = mysqli_query($db, $sql);
                if(mysqli_num_rows($result) <= 0) {
                  echo"email is not registered";
                  
                }
                else{
                    $query= "UPDATE users SET password='$newpassword' WHERE email='$email' AND password='$password'" ;
                    $output=mysqli_query($db,$query);
                    echo"password changed";
                    
                }
               
                
            }
              ?>
                <form method="POST" action="">
                <h3>Change your Password here</h3>
                </br>
                </br>
                <input name="email" id="email" type="text" placeholder="Email" required>
                <input name="password" id="password" type="password" placeholder="Current Password" required>
                <input name="newpassword" id="password" type="password" placeholder="New Password" required>
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