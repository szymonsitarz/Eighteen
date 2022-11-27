<?php
    /* Assumptions made:
        1. cart.php uses $_SESSION['cart']["'" . $pid . "'"] to map pids and quantities.
    */
    session_start();
    $_SESSION['product']['success'] = false;
    if(isset($_SESSION['auth']))
    {
        if($_POST['quantity'] <= 0)
            $_SESSION['product']['notification'] = "No action was made.";
        else
        {
            // THIS IS AN ASSUMPTION OF $_SESSION VARIABLE STRUCTURE
            $_SESSION['cart']["'" . $_POST['pid'] . "'"] = $_POST['quantity'];
           
            $_SESSION['product']['success'] = true;
            $_SESSION['product']['notification'] = "Added " . $_POST['quantity'] . " item(s) to cart.";
        }
    }
    else
        $_SESSION['product']['notification'] = "You must log in to perform this action.";

    header('Location: ' . $_SERVER['HTTP_REFERER']);

?>