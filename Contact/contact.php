<?php session_start(); ?>
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
    <div id = "formheading">
      <h1> Contact Form <h1>
</div>
        <div class = "container">
            <div id = "contactform">
            <form action = "thankyou.php" method = "post">
                
              <label for="cname">Your Name</label><br>
              <input type="text" id="cname" name="cname" placeholder="John Doe" pattern=[A-Z\sa-z]{3,20} required>
            <br><br>
          
              <label for="cemail">Your E-mail</label><br>
              <input type="email" id="cemail" name="cemail" placeholder="your.email@email.com" required>
            <br><br>
          
              <label for="ctitle">Telephone</label><br>
              <input type="text" id="ctitle" name="cnumber" required placeholder="12345678910" pattern=[0-9\s]{8,60}>
          
            <br><br>
          
              <label for="cmessage">Write your message</label><br>
              <textarea id="cmessage" name="cmessage" placeholder="Write your message here" required></textarea>
          
            <br>
            <input type="submit" name="submit" value="Submit">

          </div>   
        </div> 
        
                            <div id= "contactinfo">
                              <h1> Aston University <br><br>•<br><br> Birmingham, England <br><br>•<br><br> 0121 204 3000 <br><br>•<br><br> eighteenstore@gmail.com</h1>
</div>
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
  <div class="vl"></div> 
    </body>

</html>