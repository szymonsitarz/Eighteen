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
    <link rel="stylesheet" href="https://fonts.google.com/knowledge/glossary/sans_serif">
    <link rel="stylesheet" href="/header/header.css">
    <link rel="stylesheet" href="/footer/footer.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
</script>
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
    </body>
    <div class="backgroundmain"></div> 
    <br><br><br><br><br><br><br><br><br>
    <div id = "ty-header">
      <h1> Thank you, <h1>
</div><br>
<div id = "ty-subheader">
    <h1> We will respond to your query shortly. <h2></div>
       <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
       <div class="maincontainer">

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