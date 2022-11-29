<?php
    // echo $sth->debugDumpParams();

    // Store rows in $collection
    $collection = $sth->fetchAll();

    // Display items.
    echo "\t\t\t\t<div id='product-view'>\n";
    foreach($collection as $tmp)
    {
        echo "\t\t\t\t\t<a href=\"/product/product.php?model=" . $tmp['model'] . "&selected=1\">\n";
        echo "\t\t\t\t\t\t<span class=\"item-view\">\n";
        echo "\t\t\t\t\t\t\t<img src=\"/product/img/" . $tmp['name'] . "/1.jpg\">\n";
        echo "\t\t\t\t\t\t\t<h3>" . $tmp['name'] . "</h3>\n";
        echo "\t\t\t\t\t\t\t<h4>£" . $tmp['price'] . "</h4>\n";
        for($j=1;$j <= 5;$j++)
        {
            echo "<img class=\"star\" src=\"/shared-files/200219998/star-";
            if($j <= $tmp['avg_rating'])
                echo "full.png\">";
            else
                echo "empty.png\">";
        }
        echo "\t\t\t\t\t\t</span>\n";
        echo "\t\t\t\t\t</a>\n";
    }
    echo "\t\t\t\t</div>\n";

?>