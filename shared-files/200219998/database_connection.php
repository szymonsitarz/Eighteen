<?php
    /*
    $dbname     = "u_200219998_22";
    $servername = "localhost";
    $username   = "u-200219998";
    $password   = "eQkPde3XGHj3Rxr";
    */
    $dbname     = "cs2tp";
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    try {
        $db = new PDO("mysql:dbname=$dbname;host=$servername;", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo $e->getMessage();
        exit;
    }
?>