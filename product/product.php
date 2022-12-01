<?php 
    session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Product</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="product.css?ts=<?=time()?>">
        <link rel="stylesheet" href="/footer/footer.css">
        <link rel="stylesheet" href="/shared-files/200219998/footer.css?ts=<?=time()?>">

    </head>
    <body>
        <div id="container">
            <div id="row-1-col-1">
                <img src="/shared-files/logo.png" width="50" height="50">
            </div>
            <div id="row-1-col-2">
                <a href="/home/home.php"><h1>HOME</h1></a>
                <a href="/collections/collections.php"><h1>COLLECTIONS</h1></a>
                <a href="/contact/contact.php"><h1>CONTACT</h1></a>
                <a href="/about-us/about-us.php"><h1>ABOUT US</h1></a>
            </div>
            <div id="row-1-col-3">
                <?php
                    if(!isset($_SESSION['auth']))
                    {
                        echo "<a href=\"/auth/login.php\">Login</a>";
                        echo "<a href=\"/auth/register.php\">Register</a>";
                    }
                    else
                    {
                        $size=40;
                        echo "<a href=\"/account/accountinfo.php\"><img src=\"/shared-files/200219998/account.png\" width=\"{$size}px\" height=\"{$size}px\"></a>";
                        echo "<a href=\"/cart/cart.php\"><img src=\"/shared-files/200219998/cart.png\" width=\"{$size}px\" height=\"{$size}px\"></a>";
                        echo "<a href=\"/auth/logout.php\">Logout</a>";
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
                        include_once($_SERVER['DOCUMENT_ROOT'] . '/shared-files/200219998/notification.php');
                    ?>                    
                </form>
            </div>
            <div id="row-3">
                <?php
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/shared-files/200219998/db.php');
                    require_once('scripts/fetch.php');
                    require_once('scripts/save_state.php'); ?>
                <div id="product-stage">
                    <div id="product-gallery">
                        <?php 
                            $dir = "/img/" . $_SESSION['product']['name'] . "/";
                            $images = glob(getcwd() . $dir . "*");
                            $n = count($images);
                            for($i=1;$i<=$n && $i <= 4;$i++)
                            {
                                echo "<a href=\"/product/product.php?model=" . $_SESSION['product']['model'] . "&selected=" . $i . "\"><img src=\"/product/img/" . $_SESSION['product']['name'] . "/" . $i . ".png\"></a>"; 
                            }
                        ?>
                    </div>
                    <img id="product-selected-image" src="/product/img/<?= $_SESSION['product']['name'] . "/" . ((isset($_GET['selected'])) ? $_GET['selected'] : "1") ?>.png">
                    <div id="product-attributes">
                        <h1><?= $_SESSION['product']['name'] ?></h1>
                        <a href="#product-list-reviews">
                            <span class="product-feedback-overview">
                                <?php
                                for($j=1;$j <= 5;$j++)
                                {
                                    echo "<img class=\"star\" src=\"/shared-files/200219998/star-";
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
                            
                            <span><u><?php
                                if($product['avg_rating'] == 0) 
                                    echo "Be the first to review!"; 
                                else 
                                {
                                    $query = "SELECT 1 FROM feedback WHERE model=:model";
                                    $sth = $db->prepare($query);
                                    $sth->bindParam(':model', $_SESSION['product']['model']);
                                    $sth->execute();
                                    $n = "(" . $sth->rowCount();
                                    echo $n . ")";
                                }
                            ?></u></span>
                        </a>
                        <?php  
                            require_once('scripts/stock.php');
                        ?>
                    </div>
                </div>
                <div id="product-description">
                        <h2>Description</h2>    
                        <p><?= $_SESSION['product']['description'] ?></p>
                </div>
                <div id="product-feedback">
                    <h2>Feedback</h2>
                    <?php 
                        require_once('scripts/feedback.php');
                    ?>
                </div>
                <div id="product-review">
                    <h2>Write review</h2>
                    <form method="post" action="scripts/review.php">
                        <label>Rating</label>
                        <input type="text" class="long-field" name="product-review-rating" placeholder="(1-5)"><br>
                        <label>Comments</label>
                        <textarea class="long-field" name="product-review-comments" placeholder="Tell us what you think."></textarea><br>
                        <button type="submit" name="product-submit-review">Submit</button>
                    </form>
                </div>
            </div>
                
            <div class="end-footer">

            <div class="main-footer-container">
                <div class="inside-footer">
                    <div class="footer-heading1 foooter-1">
                    <h2>Terms & Conditions</h2>
                        <a href="/footer_pages/privacy-policy.html">Privacy Policy</a>
                        <a href="/footer_pages/return-policy.html">Return Policy</a>
                        <a href="/footer_pages/Terms.html">Terms & Conditions</a>
                    </div>

                    <div class="footer-heading1 foooter-2">
                        <h2>Customer Service</h2>
                        <a href="/contact/contact.php">Contact Us</a>
                        <a href="/footer_pages/faq.html">FAQ's</a>
                    </div>
                        
                    <div class="footer-heading1 foooter-3">
                        <h2>Information</h2>
                        <a href="/footer_pages/delivery-faq.html">Delivery Information</a>
                        <a href="/footer_pages/genral-faq.html">Genral Information</a>
                        <a href="/footer_pages/payments-faq.html">Payments Information</a>
                        <a href="/footer_pages/products-faq.html">Products Information</a>
                        <a href="/footer_pages/Vouchers-faq.html">Vouchers Information</a>
                        <a href="/footer_pages/returns-faq.html">Returns Information</a>
                    </div>

                    <div class="footer-email-form1">
                    <h2>Join our newsletter subscription</h2>
                    <input type="email" placeholder="your email address" id="footer-email1">
                    <input type="submit" value="Sign Up" id="footer-email-btn1">
                    </div>
                </div>

</div>
</div>


    </body>
</html>
