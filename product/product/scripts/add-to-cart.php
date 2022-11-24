<?php
    /* Assumptions made:
        1. cart.php uses $_SESSION['cart']["'" . $pid . "'"] to map pids and quantities.
    */
    session_start();
    $_SESSION['product']['success'] = false;
    if(isset($_SESSION['auth']))
    {
        $_SESSION['cart']["'" . $_POST['pid'] . "'"] = $_POST['quantity'];
        /* 
        Above expression is not complicated, here is an example:
            $_SESSION['cart']['1'] = 5;
            $_SESSION['cart']['3'] = 40;
            $_SESSION['cart']['1'] -= 1;
            
        ... where accessing data might look like:
            $_SESSION['cart']['1']  =>     4
            $_SESSION['cart']['2']  =>     NULL
            $_SESSION['cart']['3']  =>     40
        */
        $_SESSION['product']['success'] = true;
        $_SESSION['product']['notification'] = "Added " . $_POST['quantity'] . " item(s) to cart.";
    }
    else
        $_SESSION['product']['notification'] = "You must log in to perform this action.";

    header('Location: ' . $_SERVER['HTTP_REFERER']);

?>