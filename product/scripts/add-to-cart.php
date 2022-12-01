<?php
    /* Assumptions made:
        1. cart.php uses $_SESSION['cart']["'" . $pid . "'"] to map pids and quantities.
    */
    session_start();
    $_SESSION['info']['success'] = false;
    if(!isset($_SESSION['authenticate']['username']))
    {
        if($_POST['quantity'] <= 0)
            $_SESSION['info']['notification'] = "No action was made.";
        else
        {
            $_SESSION['cart'][$_POST['pid']] = $_POST['quantity'];
           
            $_SESSION['info']['success'] = true;
            $_SESSION['info']['notification'] = "Added " . $_POST['quantity'] . " item(s) to cart.";
        }
    }
    else
        $_SESSION['info']['notification'] = "You must log in to perform this action.";

    header('Location: ' . $_SERVER['HTTP_REFERER']);

?>