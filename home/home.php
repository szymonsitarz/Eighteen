<!DOCTYPE html>
<html lang="en">
  <?php session_start()?>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="clothing.css">
<link rel="stylesheet" href="/header/header.css">
<link rel="stylesheet" href="/footer/footer.css">
<link rel="stylesheet" href="https://fonts.google.com/knowledge/glossary/sans_serif">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body>

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

<header>
<!-- <nav>
  <div class="logo 1">
    <img src="/shared-files/logo.png" alt="" width="80" height="90"
    div class="main-right">
  </div>
  <ul class="list-items">
      <li><a href="/home/home.php" class="link">HOME</a></li>
      <li><a href="/collections/collections.php" class="link">COLLECTIONS</a></li>
      <li><a href="/contact/contact.php" class="link">CONTACT US</a></li>
      <li><a href="#" class="link">ABOUT US</a></li>
  </ul>
  <div class="nav-btns">
    <a href="#" class="btn-nav-i"><i class="fa fa-search"></i></a>
    <a href="#" class="btn-nav-i"><i class="fa fa-shopping-cart"></i></a>
    <a href="#" class="btn-nav-i"><i class="fa fa-user"></i></a>
    <a href="#" class="btn-nav-i"><i class="fa fa-heart"></i></a>
  </div>
</nav> -->

  <div class="main">
    <div class="main-left">
        <div class="social-media">
    
        <a href="http://www.facebook.com" class="s-btn"><i class="fa fa-facebook-f"></i></a>
        <a href="http://www.twitter.com" class="s-btn"><i class="fa fa-twitter"></i></a>
        <a href="http://www.instagram.com" class="s-btn"><i class="fa fa-instagram"></i></a>
      </div>
    </div>
    <div class="main-right">
    </div>
</br>
    <div class="banner">
        <div class="f-text">
          <h1>
            BE TRUE
            <br />
            <span>BE DIVINE</span>
            <br />
            BE 18.
          </h1>
        </div>
        <a href="/collections/collections.php" class="btn">SHOP NOW</a>

      </br>
    </div>
  </div>

  <div id="container"> 
    <div class="BESTSELLING1" class="item">
      <img src= "/shared-files/home-images/product1.png" alt="hers" style="width:80%">
      <div class="f-text2">
        <p class="BESTSELLING"><a href="/collections/collection.php?sort=best_selling">BESTSELLING</a></p>
        <h1>Women’s Cropped Full-Zip Hoodie</h1>
        <p class="price">£50.00</p>
      </div>
  </div>
                  
          
  <div class="TRENDING1" class="item">
    <img src="/shared-files/home-images/product2.png" alt="tshirt" style="width:80%">
    <div class="f-text3">
      <p class="TRENDING"><a href="/collections/collection.php?sort=trending">TRENDING</a></p>
      <h1>Men’s Oversized Short-Sleeve T-Shirt</h1>
      <p class="price">£12.99</p>
    </div>
  </div>
        

    <div class="NEWIN1" class="item">
      <img src="/shared-files/home-images/product3.png" alt="hoodie" style="width:80%">
      <div class="f-text4">
        <p class="NEWIN"><a href="/collections/collections.php?sort=latest">LATEST</a></p>
        <h1>Unisex Bomber Sports Jacket</h1>
        <p class="price">£31.99</p>
    </div>
  </div>
</div>
</header>

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
