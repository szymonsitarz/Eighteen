<?php session_start(); ?>
<html>
    <link rel="stylesheet" href="contact.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/header/header.css">
    <link rel="stylesheet" href="/footer/footer.css">
    <link rel="stylesheet" href="https://fonts.google.com/knowledge/glossary/sans_serif">
    
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
                    <a href="/cart/cart.php" class="button-navigation-i"><i class="fa fa-shopping-cart"></i></a>
                        <a href="/auth/login.php" class="button-navigation-i">Login</a>
                        <a href="/auth/register.php" class="button-navigation-i">Register</a><?php
                    }
                    else
                    {
                        $size=40;?>
                        <a href="/auth/logout.php" class="button-navigation-i">Logout</a><?php
                    }
                ?>
          </div>
      </nav>
    </header>
  </div>

    <body>
    <!-- <header>
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
    </header> -->
    <div id = "formheading">

      <h1> CONTACT FORM <h1>
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
                            <!-- <div class="footer-container"> -->
    <!-- <div class="footer">
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
  </div> -->
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

  <div class="vl"></div> 
    </body>

</html>
