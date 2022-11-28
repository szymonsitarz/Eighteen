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
              $_SESSION['auth']['username'] = "admin";
              if(isset($_SESSION['auth']['username']))
              {
                if (isset($_POST['submit'])) 
                {
                  $success=0;
                  $query = "SELECT password FROM users WHERE username=:username";
                  $sth = $db->prepare($query);
                  $sth->bindParam(":username", $_SESSION['auth']['username']);
                  $sth->execute();
                  $row = $sth->fetch(PDO::FETCH_ASSOC);
                  if($_POST['new-password'] == $_POST['confirm-new-password'])
                    if(password_verify($_POST['current-password'], $row['password']))
                    {
                      $query= "UPDATE users SET password=:new-password WHERE username=:username";
                      $sth = $db->prepare($query);
                      $sth->bindParam(":new-password", $_POST['new-password']);
                      $sth->bindParam(":username", $_SESSION['auth']['username']);
                      $sth->execute();
                      $success=1;
                    }

                    if(!$success)
                      echo "incorrect password or new passwords don't match";
                    else
                      echo "password changed.";
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
