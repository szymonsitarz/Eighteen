<?php 
    session_start();
    if(!isset($_SESSION['authenticate']['is_admin']))
    {
        $_SESSION['info']['notification'] = "Access denied";
        if($_SESSION['info']['referer'] == "/product/product.php")
            header('Location: /collections/collections.php');
        else
            header('Location: ' . $_SESSION['info']['referer']);
        exit();
    }
    else
        $_SESSION['info']['notification'] = "Welcome to the admin dashboard.";

    $_SESSION['info']['referer']=$_SERVER['PHP_SELF'];
?>
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
                    if(!isset($_SESSION['authenticate']['username']))
                        echo " style=\"background-color: #ff0000; font-weight: bold;\" ";
                    echo "value=\"off\">DE-EMULATE AUTH STATE</button>";
                    echo "<button type=\"submit\" name=\"state\" "; 
                    if(isset($_SESSION['authenticate']['username']))
                        echo " style=\"background-color: #00ff00; font-weight: bold;\" ";
                    echo "value=\"on\">EMULATE AUTH STATE</button>";
                    echo "</form>";
                    if(isset($_SESSION['authenticate']['username']))
                    {
                        //echo "<img src=\"/account.jpg\">";
                        //echo "<img src=\"/cart.jpg\">";
                    }
                ?>
            </div>
            <div id="row-2">
                    <?php
                       include_once('notification.php');
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
                <a href="admin.php?admin_tab=statistics" class="tab"><span>
                    <h4>Statistics</h4>
                    <img src="img/statistics.png" alt="statistics">
                </span></a>
            </div>
            <div id="row-3-col-2">
                <h2>ADMIN PANEL</h2>
                <?php
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/database_connection.php');
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
                            case "access":
                                // Ensure sort is not persistent between tabs
                                $_SESSION['admin']['tab_selected'] = 'access';
                                if($_SESSION['admin']['tabbed_last'] != $_SESSION['admin']['tab_selected'])
                                    unset($_SESSION['admin']['sort_selected']);
                                echo "<h3>Access</h3>";
                                require_once('scripts/access.php');
                                break;
                            case "statistics":
                                // Ensure sort is not persistent between tabs
                                $_SESSION['admin']['tab_selected'] = 'statistics';
                                if($_SESSION['admin']['tabbed_last'] != $_SESSION['admin']['tab_selected'])
                                    unset($_SESSION['admin']['sort_selected']);
                                echo "<h3>Statistics</h3>";
                                require_once('scripts/statistics.php');
                                break;
                            default:
                                http_response_code(404);
                                include_once($_SERVER['DOCUMENT_ROOT'] . '/error/404.php');
                        }
                    }   
                    $_SESSION['admin']['tabbed_last'] = $_SESSION['admin']['tab_selected'];
                ?>
            </div>
            <div id="row-4">
                <p>(footer)</p>
            </div>
        </div>
    </body>
</html>