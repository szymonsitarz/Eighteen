<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Grid</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="product.css?ts=<?=time()?>">
    </head>
    <body>
        <div id="container">
            <div id="row-1-col-1">
                <img src="/shared-images/logo-2.png" width="50" height="50">
            </div>
            <div id="row-1-col-2">
                <a href="/home/home.html"><h1>HOME</h1></a>
                <a href="/collections/collections.php"><h1>COLLECTIONS</h1></a>
                <a href="/contact/contact.html"><h1>CONTACT</h1></a>
                <a href="/about-us/about-us.html"><h1>ABOUT US</h1></a>
            </div>
            <div id="row-1-col-3">
                <?php
                    echo "<form action=\"/TEMPORARY_LOGIN.php\" method=\"post\">";
                    echo "<button type=\"submit\" name=\"state\"";
                    if(!isset($_SESSION['auth']))
                        echo " style=\"background-color: #ff0000; font-weight: bold;\" ";
                    echo "value=\"off\">DE-EMULATE AUTH STATE</button>";
                    echo "<button type=\"submit\" name=\"state\""; 
                    if(isset($_SESSION['auth']))
                        echo " style=\"background-color: #00ff00; font-weight: bold;\" ";
                    echo "value=\"on\">EMULATE AUTH STATE</button>";
                    echo "</form>";
                    if(isset($_SESSION['auth']))
                    {
                        //echo "<img src=\"/account.jpg\">";
                        //echo "<img src=\"/cart.jpg\">";
                    }
                ?>
            </div>
            <div id="row-2">
                <form method="get" action="/collections/collections.php">
                    <span id="sorting">
                        <label>Sort By</label>
                        <select name="sort">
                            <option value="relevance">Relevance</option>
                            <option value="low-to-high">Price (Low-to-High)</option>
                            <option value="high-to-low">Price (High-to-Low)</option>
                            <option value="rating">Rating</option>
                        </select>
                    </span>
                    <span id="search-bar">
                        <input type="text" name="q">
                        <button type="submit">Search</button>
                    </span>
                        <?php
                            if(isset($_SESSION['product']['notification']))
                            {
                                if($_SESSION['product']['success'])
                                    echo "<p style=\"color:#00ff00;\"><strong>";
                                else
                                    echo "<p style=\"color:#ff0000;\"><strong>Error: ";
                                echo $_SESSION['product']['notification'] . "</strong></span>";
                                unset($_SESSION['product']['notification']);
                            }
                        ?>                    
                </form>
            </div>
            <div id="row-3">
                <?php
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL); 
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/database_connection.php');
                    require_once('scripts/fetch_product.php');
                    require_once('scripts/save_product.php'); ?>
                <div id="product-stage">
                    <div id="product-gallery">
                        <?php 
                            $dir = "/img/" . $_SESSION['product']['name'] . "/";
                            $images = glob(getcwd() . $dir . "*");
                            $n = count($images);
                            for($i=1;$i<=$n && $i <= 4;$i++)
                            {
                                echo "<a href=\"/product/product.php?model=" . $_SESSION['product']['model'] . "&selected=" . $i . "\"><img src=\"/product/img/" . $_SESSION['product']['name'] . "/" . $i . ".jpg\"></a>"; 
                            }
                        ?>
                    </div>
                    <img id="product-selected-image" src="/product/img/<?= $_SESSION['product']['name'] . "/" . ((isset($_GET['selected'])) ? $_GET['selected'] : "1") ?>.jpg">
                    <div id="product-attributes">
                        <h2><strong><?= $_SESSION['product']['name'] ?></strong></h2>
                        <a href="#product-list-reviews">
                            <span class="product-feedback-overview">
                                <?php
                                for($j=1;$j <= 5;$j++)
                                {
                                    echo "<img class=\"star\" src=\"/shared-images/star-";
                                    if($j <= $product['avg_rating'])
                                        echo "full.png\">";
                                    else
                                        echo "empty.png\">";
                                }
                                ?>
                                <span><?= number_format($product['avg_rating'], 2); ?></span>
                            </span>
                        </a>
                        <a href="#product-write-review">
                            <span><?php 
                                echo "<u>(";
                                $query = "SELECT 1 FROM feedback WHERE model=:model";
                                $sth = $db->prepare($query);
                                $sth->bindParam(':model', $_SESSION['product']['model']);
                                $sth->execute();
                                $n = $sth->rowCount();
                                echo $n . ")</u>";
                            ?></span>
                        </a>
                        <?php 
                            require_once('scripts/check_stock.php');
                        ?>
                        
                        
                    </div>
                </div>
                <div id="product-description">
                    <h2>Description</h2>
                    <p><?= $_SESSION['product']['description'] ?></p>
                </div>
                <div id="product-list-reviews">
                    <h2>Reviews</h2>
                    <?php 
                        require_once('scripts/list_reviews.php');
                    ?>
                </div>
                <div id="product-write-review">
                    <h4>Write your own review</h4>
                    <form method="post" action="scripts/submit_review.php">
                        <label>Rating</label>
                        <input type="text" class="long-field" name="product-review-rating" placeholder="(1-5)"><br>
                        <label>Comments</label>
                        <textarea class="long-field" name="product-review-comments" placeholder="Tell us what you think."></textarea><br>
                        <button type="submit" name="product-submit-review">Submit</button>
                        <!-- CAPTCHA (after loading to webmin server)
                            <iframe src="http://www.google.com/recaptcha/api/noscript?k=6LdaKw8jAAAAABEnvzOPHGBMeb7hFM1WbUHlBCGJ" height="300" width="500" frameborder="0"></iframe><br>
                            <textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
                            <input type="hidden" name="recaptcha_response_field" value="manual_challenge">
                        -->
                    </form>
                </div>
            </div>
            <div id="row-4">
                <p>(footer)</p>
                <?php require_once('scripts/increment_views.php'); ?>
            </div>
        </div>
    </body>
</html>