<?php
    if(isset($_GET['model']))
    {
        $query = "UPDATE products SET views = views + 1 WHERE model=:model";
        $sth = $db->prepare($query);
        $sth->bindParam(':model', $_GET['model']);
        $sth->execute();
    }
?>