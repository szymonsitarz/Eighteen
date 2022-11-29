<?php session_start(); ?>
<?php
          ini_set('display_errors', 1);
          ini_set('display_startup_errors', 1);
          error_reporting(E_ALL);
          echo "Value of POST SUBMIT: " . $_POST['submit'];
          if(isset($_POST['submit']))
          {
            require_once('database_connection.php');
            /*
            $query = "SELECT uid from users";
            $sth = $db->prepare($query);
            $sth->execute();
            $first_row = $sth->fetch(PDO::FETCH_ASSOC); echo $first_row['uid']; */
            
            echo "Look at POST: <br>" . $_POST['cname'];
            $query = "INSERT INTO contact (forename, email, phone, message) VALUES (:forename, :email, :phone, :message)";
            $sth = $db->prepare($query);
            $sth->bindParam(":forename", $_POST['cname']);
            $sth->bindParam(":email", $_POST['cemail']);
            $sth->bindParam(":phone", $_POST['cnumber']);
            $sth->bindParam(":message", $_POST['cmessage']);
            $sth->execute();
          }
?>
<html>
    <link rel="stylesheet" href="contact.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <body>
    <header>
        <nav>
            <div class="logo 1">
             <img src="logo-white.png" alt="eighteen" width="90" height="90"
             div class="main-right">
           
            </div>

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
        <div class="main-right"></div>

      </div>
    </header>
    <div id = "ty-header">
      <h1> Thank you, <h1>
</div><br>
<div id = "ty-subheader">
    <h1> We will respond to your query shortly. <h2></div>
       <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                            <div class="footer-container">
    <div class="footer">
      <div class="footer-heading footer-1">
        <h2>About Us</h2>
<a href="#">Blog</a>
<a href="#">Desmo</a>
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
    </body>

</html>