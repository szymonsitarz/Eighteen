<?php
    session_start();

    require_once($_SERVER['DOCUMENT_ROOT'] . '/shared-files/200219998/database_connection.php');

    /* Passing conditions:
        1. User is authenticated - check if $_SESSION['authenticate']['username'] is set. 
        2. Required fields, $_POST['product-review-rating'], $_POST['product-comments'] are set.
        3. $_POST['product-review-rating'] is strictly an string containing an integer value.
        4. $_POST['product-review-rating'] as an integer is 1, 2, 3, 4 or 5.
        5. Values conform to whitelist of accepted values (e.g. no null bytes like %00)
        6. User has not already submitted a review for this product.
    */
    $_SESSION['info']['success'] = false;
    if(!isset($_SESSION['authenticate']['username']))
        $_SESSION['info']['notification'] = "You must register an account and login to submit feedback.";
    else if(!isset($_POST['product-review-rating']) || !isset($_POST['product-review-comments']))
        $_SESSION['info']['notification'] = "Missing fields required in review submission form.";
    else if(!is_numeric($_POST['product-review-rating']) || $_POST['product-review-rating'] != strval(round($_POST['product-review-rating'])))
        $_SESSION['info']['notification'] = "Unrecognized data in first field of review submission form.";
    else if($_POST['product-review-rating'] < 1 || $_POST['product-review-rating'] > 5)
        $_SESSION['info']['notification'] = "Expected number 1-5 in first field of review submission form.";
    else
    {
    /* Now complete actions tied to review submission */ 

        // Insert new record into feedback table.
        $rating = round($_POST['product-review-rating']);
        $query = "INSERT INTO feedback (model, username, review, rating, seconds_since_epoch) VALUES (:model, :username, :review, :rating, UNIX_TIMESTAMP(now()))";
        $sth = $db->prepare($query);
        $sth->bindParam(':model', $_SESSION['product']['model']);
        $sth->bindParam(':username', $_SESSION['authenticate']['username']);
        $sth->bindParam(':rating', $rating);
        $sth->bindParam(':review', $_POST['product-review-comments']);
        $sth->execute();

        // Update avg_record from products table
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
        $sth = $db->prepare($query);
        $sth->bindParam(':avg_rating', $new_average);
        $sth->bindParam(':model', $_SESSION['product']['model']);
        $sth->execute();
        $_SESSION['info']['success'] = true;
        $_SESSION['info']['notification'] = "Submitted feedback.";
    }
    header('Location: /product/product.php?model=' . $_SESSION['product']['model']);


?>