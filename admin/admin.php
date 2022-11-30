<?php 
    session_start();
    if(!isset($_SESSION['authenticate']['is_admin']))
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
        <title>Grid</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="admin.css?ts=<?=time()?>">
        <link rel="stylesheet" href="/shared-files/200219998/footer.css?ts=<?=time()?>">
    </head>
    <body>
        <div id="container">
            <div id="row-1-col-1">
                <img src="/shared-files/200219998/logo-2.png" width="50" height="50" alt="logo">
            </div>
            <div id="row-1-col-2">
                <a href="/home/home.html"><h1>HOME</h1></a>
                <a href="/collections/collections.php"><h1>COLLECTIONS</h1></a>
                <a href="/contact/contact.php"><h1>CONTACT</h1></a>
                <a href="/about-us/about-us.html"><h1>ABOUT US</h1></a>
            </div>
            <div id="row-1-col-3">
                <?php
                    if(isset($_SESSION['authenticate']['username']))
                    {
                        echo "<a href=\"/authenticate/login.php\">Login   </a>";
                        echo "<a href=\"/authenticate/register.php\">Register</a>";
                    }
                    else
                    {
                        echo "<a href=\"/account/accountinfo.php\">Account    </a>";
                        echo "<a href=\"/authenticate/logout.php\">Logout</a>";
                    }
                ?>
            </div>
            <div id="row-2">
                    <?php
                       include_once($_SERVER['DOCUMENT_ROOT'] . '/shared-files/200219998/notification.php');
                    ?>                    
            </div>
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
            <div id="row-3-col-2">
                <h2>ADMIN PANEL</h2>
                <?php
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/shared-files/200219998/database_connection.php');
                    if(!isset($_GET['admin_tab']) || $_GET['admin_tab'] == 'orders') 
                    {
                        // Ensure sort is not persistent between tabs
                        $_SESSION['admin']['tab_selected'] = 'orders';
                        if($_SESSION['admin']['tabbed_last'] != $_SESSION['admin']['tab_selected'])
                            unset($_SESSION['admin']['sort_selected']);

                        echo "<h3>Orders</h3>";
                        require_once('scripts/orders.php');
                    }
                    else
                    {
                        switch($_GET['admin_tab'])
                        {
                            case "users":
                                // Ensure sort is not persistent between tabs
                                $_SESSION['admin']['tab_selected'] = 'users';
                                if($_SESSION['admin']['tabbed_last'] != $_SESSION['admin']['tab_selected'])
                                    unset($_SESSION['admin']['sort_selected']);
                                echo "<h3>Users</h3>";
                                require_once('scripts/users.php');
                                break;
                            case "products":
                                // Ensure sort is not persistent between tabs
                                $_SESSION['admin']['tab_selected'] = 'products';
                                if($_SESSION['admin']['tabbed_last'] != $_SESSION['admin']['tab_selected'])
                                    unset($_SESSION['admin']['sort_selected']);
                                echo "<h3>Products</h3>";
                                require_once('scripts/products.php');
                                break;
                            default:
                                http_response_code(404);
                                include_once($_SERVER['DOCUMENT_ROOT'] . '/shared-files/200219998/error/404.php');
                        }
                    }   
                    $_SESSION['admin']['tabbed_last'] = $_SESSION['admin']['tab_selected'];
                ?>
            </div>
            <div id="row-4">
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