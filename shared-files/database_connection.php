<?php
    $dbname     = "u_210051225_cs2tp";
    $servername = "cs2410-web01pvm.aston.ac.uk";
    $username   = "u-210051225";
    $password   = "58G2hqFATDAmxIG";
    try {
        $db = new PDO("mysql:dbname=$dbname;host=$servername;", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo $e->getMessage();
        exit;
    }
?>
