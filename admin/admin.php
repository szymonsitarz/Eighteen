<?php 
    session_start();

    // Only authorise access to users with privileges flag set in users table.
    if(!isset($_SESSION['is_admin']))
    {
        $_SESSION['info']['success'] = false;
        $_SESSION['info']['notification'] = "Access denied";
        header('Location: /collections/collections.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin dashboard</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="admin.css?ts=<?=time()?>">
        <link rel="stylesheet" href="/footer/footer.css">
        <link rel="stylesheet" href="/shared-files/200219998/footer.css?ts=<?=time()?>">
    </head>
    <body>
        <div id="container">
            <!-- Row #1 consists of header -->
            <!-- Col #1 of Row #1 consists of logo -->
            <div id="row-1-col-1">
                <img src="/shared-files/logo.png" width="50" height="50" alt="logo">
            </div>
            <!-- Col #2 of Row #1 consists of Home, Collections, Contact & About Us (i.e. business navigation links) -->
            <div id="row-1-col-2">
                <a href="/home/home.php"><h1>HOME</h1></a>
                <a href="/collections/collections.php"><h1>COLLECTIONS</h1></a>
                <a href="/contact/contact.php"><h1>CONTACT</h1></a>
                <a href="/about-us/about-us.php"><h1>ABOUT US</h1></a>
            </div>
            <!-- Col #3 of Row #1 consists of Login, Register or alternatively Account, Logout, Cart - depending on 
                authentication state (i.e. functional navigation links) -->
            <div id="row-1-col-3">
                <?php
                    if(!isset($_SESSION['auth']))
                    {
                        echo "<a href=\"/auth/login.php\">Login</a>";
                        echo "<a href=\"/auth/register.php\">Register</a>";
                    }
                    else
                    {
                        $size=40;
                        echo "<a href=\"/account/accountinfo.php\"><img src=\"/shared-files/200219998/account.png\" width=\"{$size}px\" height=\"{$size}px\"></a>";
                        echo "<a href=\"/cart/cart.php\"><img src=\"/shared-files/200219998/cart.png\" width=\"{$size}px\" height=\"{$size}px\"></a>";
                        echo "<a href=\"/auth/logout.php\">Logout</a>";
                    }
                ?>
            </div>
            <!-- Row #2 displays the notification - if any. -->
            <div id="row-2">
                    <?php
                       include_once($_SERVER['DOCUMENT_ROOT'] . '/shared-files/200219998/notification.php');
                    ?>                    
            </div>
            <!-- Row #3 consists of the main content of the admin page -->
            <!-- Col #1 of Row #3 consists of Orders, Users and Products which are different tabs within the admin page. -->
            <div id="row-3-col-1">
                <a href="admin.php?admin_tab=orders" class="tab"><span> 
                    <h4>Orders</h4>
                    <img src="img/orders.png" alt="orders">
                </span></a>
                <a href="admin.php?admin_tab=users" class="tab"><span>
                    <h4>Users</h4>
                    <img src="img/users.png" alt="users">
                </span></a>
                <a href="admin.php?admin_tab=products" class="tab"><span>
                    <h4>Products</h4>
                    <img src="img/products.png" alt="products">
                </span></a>
            </div>
            <!-- Col #2 of Row #3 consists of the table that is presented for the selected tab -->
            <div id="row-3-col-2">
                <h2>ADMIN PANEL</h2>
                <?php
                    // Connect to database once here, for whatever tab may be chosen - to avoid repeated code.
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/shared-files/200219998/db.php');

                    $array = array('orders', 'users', 'products');

                    /* If $_GET['admin_tab'] has a valid value, set $_SESSION['tab_selected'], otherwise
                        set it to orders by default */
                    $match=false;
                    foreach($array as $comparer)
                        if(isset($_GET['admin_tab']) && $_GET['admin_tab'] === $comparer)
                        {
                            $match=true;
                            break;
                        }
                    if(isset($_GET['admin_tab']) && $match)
                        $_SESSION['admin']['tab_selected'] = $_GET['admin_tab'];
                    else
                        $_SESSION['admin']['tab_selected'] = "orders";

                    /* Covers all bases; if there is no previous tab, it resets the sort; if the client chooses
                        a new tab, it resets the sort */
                    if($_SESSION['admin']['tabbed_last'] != $_SESSION['admin']['tab_selected'])
                        if(isset($_SESSION['admin']['sort_selected'])) 
                            unset($_SESSION['admin']['sort_selected']);
                    
                    echo "<h3>" . ucfirst($_SESSION['admin']['tab_selected']) . "</h3>";
                    require_once('scripts/' . $_SESSION['admin']['tab_selected'] . '.php');
                    
                    // Memorise the will-be previous tab once the client navigaates to a new web page.
                    $_SESSION['admin']['tabbed_last'] = $_SESSION['admin']['tab_selected'];
                ?>
            </div>

                
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

            <!-- <div id="row-4">
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
    </body>
</html>
