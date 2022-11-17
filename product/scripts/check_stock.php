<?php
    /* Look for availability of product for all its sizes and colors, first. */
    $query = "SELECT size FROM products WHERE model=:model and stock > 0";
    $sth = $db->prepare($query);
    $sth->bindParam(':model', $_SESSION['product']['model']);
    $sth->execute();
    $has_stock = ($sth->rowCount() > 0);

    if($has_stock)
    {
        // Part 1/4: Price (EDIT THIS SO WHEN NO SIZE AND COLOR IS SELECTED, A RANGE OF PRICE [MIN-MAX] IS GIVEN)
        echo "<p><strong>£" . number_format($_SESSION['product']['price'], 2) . "</strong> (per unit.)</p>";
        
        // Part 2/4: Sizes
        $sizes = $sth->fetchAll();
        echo "<form action=\"/product/product.php\" method=\"get\">\n";
        // (Maintain /product.php?model=xxx on redirect)
        echo "<input type=\"hidden\" name=\"model\" value=\"" . $_SESSION['product']['model'] . "\">\n";
        foreach($sizes as $tmp)
        {
            echo "<button type=\"submit\" class=\"" . $tmp['size'] . "\" name=\"size\" value=\"" . $tmp['size'] . "\"";
            if(isset($_GET['size']) && $_GET['size'] == $tmp['size'])
                echo " style=\"background-color: grey;\"";
            echo ">" . $tmp['size'] . "</button>\n";
        }

        // Part 3/4: Colors
        

        // Part 3/3: Add to cart button
        echo "</form>\n";
        echo "<form action=\"scripts/add-to-cart.php\" method=\"post\">";
        echo "\t<br><label>Qty:</label><br>";
        echo "\t<input type=\"number\" name=\"quantity\" value=\"0\" min=\"0\">";
        echo "\t<input type=\"hidden\" name=\"pid\" value=\"" . $_SESSION['product']['pid'] . "\">";
        echo "\t<input type=\"hidden\" name=\"quantity\"";
        if(isset($_SESSION['product']['quantity']))
            echo " value=\"" . $_SESSION['product']['quantity'] . "\"";
        echo ">";
        echo "\t<button type=\"submit\">Add to cart</button>";
        echo "</form>\n";
    }
    else
        echo "<p><strong>Out-of-stock.<strong></p>";

?>