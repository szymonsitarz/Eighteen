<?php
    session_start();
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    if(isset($_SESSION['auth']))
    {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/shared-files/200219998/db.php');
        require_once("scripts/getuid.php");

        // INSERT record into orders table per unit bought
        foreach($_SESSION['cart'] as $key => $quantity)
        {
            for($i=0;$i<$quantity;$i++)
            {
                $pid=intval($key);
                $query = "INSERT INTO orders (uid, pid) VALUES (:uid, :pid)";
                $sth = $db->prepare($query);
                $sth->bindParam(':uid', $uid);
                $sth->bindParam(':pid', $pid);
                $sth->execute();
            }
            // DECREMENT stock for pid in products table
            $query = "UPDATE products SET stock = stock - 1 WHERE pid=:pid";
            $sth = $db->prepare($query);
            $sth->bindParam(':pid', $pid);
            $sth->execute();

            // INCREMENT bought_all_time for pid in products table
            $query = "UPDATE products SET bought_all_time = bought_all_time + 1 WHERE pid=:pid";
            $sth = $db->prepare($query);
            $sth->bindParam(':pid', $pid);
            $sth->execute();
        }
        unset($_SESSION['cart'][$key]);
        $_SESSION['info']['success'] = true;
        $_SESSION['info']['notification'] = "Thank you for your purchase.";
    }

    header('Location: /collections/collections.php');
?>
