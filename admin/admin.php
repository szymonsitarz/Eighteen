<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Grid</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="admin.css?ts=<?=time()?>">
    </head>
    <body>
        <div id="container">
            <div id="row-1-col-1">
                <img src="/shared-images/logo-2.png" width="50" height="50" alt="logo">
            </div>
            <div id="row-1-col-2">
                <a href="/home/home.html"><h1>HOME</h1></a>
                <a href="/collections/collections.php"><h1>COLLECTIONS</h1></a>
                <a href="/contact/contact.html"><h1>CONTACT</h1></a>
                <a href="/about-us/about-us.html"><h1>ABOUT US</h1></a>
            </div>
            <div id="row-1-col-3">
                <?php
                    echo "<form action=\"/TEMPORARY_LOGIN.php\" method=\"post\">";
                    echo "<button type=\"submit\" name=\"state\" ";
                    if(!isset($_SESSION['auth']))
                        echo " style=\"background-color: #ff0000; font-weight: bold;\" ";
                    echo "value=\"off\">DE-EMULATE AUTH STATE</button>";
                    echo "<button type=\"submit\" name=\"state\" "; 
                    if(isset($_SESSION['auth']))
                        echo " style=\"background-color: #00ff00; font-weight: bold;\" ";
                    echo "value=\"on\">EMULATE AUTH STATE</button>";
                    echo "</form>";
                    if(isset($_SESSION['auth']))
                    {
                        //echo "<img src=\"/account.jpg\">";
                        //echo "<img src=\"/cart.jpg\">";
                    }
                ?>
            </div>
            <div id="row-2">
                    <?php
                        if(isset($_SESSION['product']['notification']))
                        {
                            if($_SESSION['product']['success'])
                                echo "<p style=\"color:#00ff00;\"><strong>";
                            else
                                echo "<p style=\"color:#ff0000;\"><strong>Error: ";
                            echo $_SESSION['product']['notification'] . "</strong></span>";
                            unset($_SESSION['product']['notification']);
                        }
                    ?>                    
            </div>
            <div id="row-3-col-1">
                <a href="admin.php?admin_tab=orders" class="tab"><span> 
                    <h4>Orders</h4>
                    <img src="img/orders.png" alt="orders">
                </span></a>
                <a href="admin.php?admin_tab=access" class="tab"><span>
                    <h4>Access</h4>
                    <img src="img/access.png" alt="access">
                </span></a>
                <a href="admin.php?admin_tab=sales" class="tab"><span>
                    <h4>Sales</h4>
                    <img src="img/sales.png" alt="sales">
                </span></a>
                <a href="admin.php?admin_tab=config" class="tab"><span>
                    <h4>Config</h4>
                    <img src="img/config-1.png" alt="config">
                </span></a>
            </div>
            <div id="row-3-col-2">
                <h2>ADMIN PANEL</h2>
                <?php
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL); 
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/database_connection.php');
                    if(!isset($_GET['admin_tab']) || $_GET['admin_tab'] == 'orders') 
                    {
                        echo "<h3>Orders</h3>";
                        require_once('scripts/orders.php');
                    }
                    else
                    {
                        switch($_GET['admin_tab'])
                        {
                            case "access":
                                echo "<h3>Access</h3>";
                                require_once('scripts/access.php');
                                break;
                            case "sales":
                                echo "<h3>Sales</h3>";
                                require_once('scripts/sales.php');
                                break;
                            case "config":
                                echo "<h3>Config</h3>";
                                require_once('scripts/config.php');
                                break;
                            default:
                                echo "THROW ERROR";
                        }
                    }   
                ?>
            </div>
            <div id="row-4">
                <p>(footer)</p>
            </div>
        </div>
    </body>
</html>