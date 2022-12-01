<?php
/*
    REQUIREMENTS:
        1. INSERT record into orders table per unit bought
        2. DECREMENT stock for pid in products table
        3. INCREMENT bought_all_time for pid in products table
*/
    session_start();
    $_SESSION['auth'] = "admin";
    if(isset($_SESSION['auth']))
    {
        require_once("scripts/getuid.php");
        require_once($_SERVER['DOCUMENT_ROOT'] . '/shared-files/200219998/db.php');
        foreach($_SESSION['cart'] as $key => $quantity)
            for($i=0;$i<$quantity;$i++)
            {
                echo $key . " is " . $quantity . "\n";
                $query = "INSERT INTO orders (uid, pid) VALUES (:uid, :pid)";
                $sth = $db->prepare($query);
                $sth->bindParam(':uid', $uid);
                $sth->bindParam(':pid', intval($key));
                $sth->execute();
            }
            unset($_SESSION['cart'][$key]);
        $_SESSION['info']['success'] = true;
        $_SESSION['info']['notification'] = "Thank you for your purchase.";
    }

//    header('Location: /collections/collections.php');
?>
