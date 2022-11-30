<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] . "/shared-files/200219998/database_connection.php");

    $_SESSION['authenticate']['username'] = "admin";
    if(isset($_SESSION['authenticate']['username']))
    {
        require_once($_SERVER['DOCUMENT_ROOT'] . "/shared-files/200219998/select_uid.php");
        foreach($_SESSION['cart'] as $key => $quantity)
            for($i=0;$i<$quantity;$i++)
            {
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