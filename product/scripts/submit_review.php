<?php
    session_start();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL); 

    require_once($_SERVER['DOCUMENT_ROOT'] . '/database_connection.php');

    /* Check:
        1.
        
        1. User is authenticated - check if $_SESSION['auth'] is set. 
        2. Required fields, $_POST['product-review-rating'], $_POST['product-comments'] are set.
        3. $_POST['product-review-rating'] is strictly an string containing an integer value.
        4. $_POST['product-review-rating'] as an integer is 1, 2, 3, 4 or 5.
        5. Values conform to whitelist of accepted values (e.g. no null bytes like %00)
        6. CAPTCHA has been completed.
        7. User has not already submitted a review for this product.
    */
    $_SESSION['review']['success'] = false;
    if(!isset($_SESSION['auth']))
        $_SESSION['review']['notification'] = "You must first register/login to submit feedback.";
    else if(!isset($_POST['product-review-rating']) || !isset($_POST['product-review-comments']))
        $_SESSION['review']['notification'] = "Missing fields required.";
    else if(!is_numeric($_POST['product-review-rating']) || $_POST['product-review-rating'] != strval(intval($_POST['product-review-rating'])))
        $_SESSION['review']['notification'] = "Unrecognized data in first field.";
    else if($_POST['product-review-rating'] < 1 || $_POST['product-review-rating'] > 5)
        $_SESSION['review']['notification'] = "Please enter a whole number between 1 and 5.";
    else
    {
    /* Now complete actions tied to review submission */ 

        // Part 1/3: Insert new record into feedback table.
        $rating = intval($_POST['product-review-rating']);
        $query = "INSERT INTO feedback (model, username, review, rating) VALUES (:model, :username, :review, :rating)";
        $sth = $db->prepare($query);
        $sth->bindParam(':model', $_SESSION['product']['model']);
        $sth->bindParam(':username', $_SESSION['auth']);
        $sth->bindParam(':rating', $rating);
        $sth->bindParam(':review', $_POST['product-review-comments']);
        $sth->execute();

        // Part 2/3: Update avg_record from products table
        $query = "SELECT avg_rating FROM products WHERE model=:model GROUP BY model";
        $sth = $db->prepare($query);
        $sth->bindParam(':model', $_SESSION['product']['model']);
        $sth->execute();
        $current_average = $sth->fetchColumn();

        $query = "SELECT 1 FROM feedback WHERE model=:model";
        $sth = $db->prepare($query);
        $sth->bindParam(':model', $_SESSION['product']['model']);
        $sth->execute();
        $n = $sth->rowCount();
        $new_average = (($current_average * $n)+$rating)/((double) ($n+1));
        
        $query = "UPDATE products SET avg_rating=:avg_rating WHERE model=:model";
        $sth->bindParam(':model', $_SESSION['product']['model']);
        $sth->execute();
        $_SESSION['review']['notification'] = "Submitted feedback.";
    }
    header('Location: /product/product.php?model=' . $_SESSION['product']['model']);


?>