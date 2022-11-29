<?php
    /* 
        If you are running on XAMPP
            1) Go to localhost/phpmyadmin
            2) Go to "User accounts" tab
            3) Go to "Add user account"
            4) Set username to "user"
            5) Change type of host to local (should automatically update to "localhost")
            6) Set password to "password"
            7) Check all for global privileges
        
        Run this script before using PDO to submit parameterized queries.
            e.g. require_once($_SERVER['DOCUMENT_ROOT'] . '/database_connection.php');
    */

    $dbname     = "cs2tp";
    $servername = "localhost";
    $username   = "user";
    $password   = "password";
    try {
        $db = new PDO("mysql:dbname=$dbname;host=$servername;", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo $e->getMessage();
        exit;
    }
?>
