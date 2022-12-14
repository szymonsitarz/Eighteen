<?php session_start(); ?>
<html>
<meta name="viewpoint" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="clothing.css">
<link rel="stylesheet" href="/header/header.css">
<link rel="stylesheet" href="/footer/footer.css">
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

<section>
<title>OUR TEAM</title>

<body>
<div class="container">
<div class="header">
    <h1>OUR TEAM</h1>
</div>
<div class="sb-container">
<div class="teams">
    <img src="/shared-files/about-images/image5.png" alt="">
    <div class="name">PRECIOUS KAFUNSE</div>
    <div class="design">DEVELOPER</div>
    <div class="about">I am a front end developer, and I was assigned the task of designing and making the website's home page. The header and footer of the website is also created by me.</div>

</div>
<div class="teams">
    <img src="/shared-files/about-images/image6.png"  alt="">
    <div class="name">SALMA HUSSAIN</div>
    <div class="design">DEVELOPER</div>
    <div class="about">I was given the responsibility of creating the front-end. The Account Information and Change Password pages are among the most important features that I created.</div>

    
</div>
<div class="teams">
    <img src="/shared-files/about-images/image7.png" alt="">
    <div class="name">AYUB HAMID</div>
    <div class="design">DEVELOPER</div>
    <div class="about">I was given the responsibility of testing the website's code to see if it is operating correctly or not. I also worked on the website's security alongside my team.</div>

</div>
<div class="teams">
    <img src="/shared-files/about-images/image3.png"  alt="">
    <div class="name"> RITIKA DEVI</div>
    <div class="design">DEVELOPER</div>
    <div class="about">I was a part of the website's front-end development. I was given the responsibility for the about us page. I was the one who designed and created that.</div>

    
</div>
<div class="teams">
    <img src="/shared-files/about-images/image.1.png"  alt="">
    <div class="name">ANAKHPREET SINGH</div>
    <div class="design">DEVELOPER</div>
    <div class="about">I've worked on the front end. In addition to designing the products and making the website responsive, I also made the FAQ pages, Terms and Conditions, and Privacy Policies pages.</div>

    
</div>
<div class="teams">
    <img src="/shared-files/about-images/image4.png"  alt="">
    <div class="name">SZYMON SITARZ</div>
    <div class="design">DEVELOPER</div>
    <div class="about">I was given the responsibility of working on the project's backend. The contact us page for the website was main focus for me.</div>
    
</div>
<div class="teams">
    <img src="/shared-files/about-images/image8.png"  alt="">
    <div class="name">HARRY WHARTON</div>
    <div class="design">DEVELOPER</div>
    <div class="about">I served as a backend developer and security consultant for the team. When consumers submit searches through a search algorithm, it is my responsibility to present the search results.</div>

    
</div>
<div class="teams">
    <img src="/shared-files/about-images/image2.png"  alt="">
    <div class="name">KWAJO SHAKANE</div>
    <div class="design">DEVELOPER</div>
    <div class="about">I contributed to the website's front-end development. I did some front-end work, concentrating on the registration and login pages.</div>  
</div>
</section>



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


</html>

