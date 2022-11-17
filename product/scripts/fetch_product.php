<?php
    $query = "SELECT pid,model,name,price,avg_rating,stock,bought_all_time,description FROM products WHERE model=:model";
    $sth = $db->prepare($query);
    $sth->bindParam(':model', $_GET['model']);
    $sth->execute();
    $product = $sth->fetch(PDO::FETCH_ASSOC);
?>