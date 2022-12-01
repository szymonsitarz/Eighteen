<?php
    // Save data that does not change between pages.
    $_SESSION['product']['pid'] = $product['pid'];
    $_SESSION['product']['model'] = $product['model'];
    $_SESSION['product']['name'] = $product['name'];
    $_SESSION['product']['price'] = $product['price'];
    $_SESSION['product']['description'] = $product['description'];
    if(isset($_GET['size']))
        $_SESSION['product']['size'] = $_GET['size'];
    $_SESSION['product']['date_time'] = $product['date_time'];
?>