<?php
    // Store rows in $collection
    $collection = $sth->fetchAll();

    // Display items.
    echo "<div id='catalogue'>\n";
    foreach($collection as $tmp)
    {
        echo "<a href=\"/product/product.php?model=" . $tmp['model'] . "&selected=1\">\n";
        echo "<span class=\"listing\">\n";
        echo "<img src=\"/product/img/" . $tmp['name'] . "/1.png\">\n";
        echo "<h3>" . $tmp['name'] . " (" . $tmp['size'] . ")</h3>\n";
        echo "<h4>£" . $tmp['price'] . "</h4>\n";
        for($j=1;$j <= 5;$j++)
        {
            echo "<img class=\"star\" src=\"/shared-files/200219998/star-";
            if($j <= $tmp['avg_rating'])
                echo "full.png\">";
            else
                echo "empty.png\">";
        }
        echo "</span>\n";
        echo "</a>\n";
    }
    echo "</div>\n";

?>
