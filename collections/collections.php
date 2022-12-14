<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    session_start(); 
    if(isset($_POST['submit']))
        if($_POST['submit'] != 'Apply filters')
            header('Location: /collections/collections.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Grid</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="collections.css?ts=<?=time()?>">
        <link rel="stylesheet" href="/shared-files/200219998/footer.css?ts=<?=time()?>">
    </head>
    <body>
        <div id="container">
            <div id="row-1-col-1">
                <img src="/shared-files/logo.png" width=50px height=50px>
            </div>
            <div id="row-1-col-2">
                <span><h1><a href="/home/home.php">HOME</a></h1></span>
                <span><h1><a href="/collections/collections.php">COLLECTIONS</a></h1></span>
                <span><h1><a href="/contact/contact.php">CONTACT</a></h1></span>
                <span><h1><a href="/about-us/about-us.php">ABOUT US</a></h1></span>
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
                <form method="get" action="collections.php">
                    <span id="sorting">
                        <label for="sort">Sort By</label>
                        <select name="sort" value>
                            <option value="relevance" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'relevance') echo "selected"; ?>>Relevance</option>
                            <option value="low-to-high" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'low-to-high') echo "selected"; ?>>Price (Low-to-High)</option>
                            <option value="high-to-low" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'high-to-low') echo "selected"; ?>>Price (High-to-Low)</option>
                            <option value="rating" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'rating') echo "selected"; ?>>Rating</option>
                        </select>
                    </span>
                    <span id="search-bar">
                        <input type="text" name="q" <?php if(isset($_GET['q'])) echo "value='" . $_GET['q'] . "'"; ?>>
                        <button type="submit">Search</button>
                    </span>
                </form>
                <?php
                    include_once($_SERVER['DOCUMENT_ROOT'] . '/shared-files/200219998/notification.php');
                ?>   
            </div>
            <div id="row-3-col-1">
                <form method="post" action="">
                    <div id="categories">
                        <h3>Category</h3>
                        <?php
                            $categories = array('accessories', 'hoodies', 'jackets', 'shorts', 'sportswear', 'tops', 'trousers'); 
                            foreach($categories as $category)
                            {
                                echo '<label>' . ucfirst($category) . '</label>';
                                echo "<input type=\"checkbox\" name=\"category['" . $category . "']\" value=\"" . $category . "\"" . (isset($_POST['category']['\'' . $category . '\'']) ? "checked" : "") . "></br>";
                            }
                        ?>
                    </div>
                    <div id="genders">
                        <h3>Gender</h3>
                        <?php
                            $genders = array('M', 'F'); 
                            foreach($genders as $gender)
                            {
                                echo '<label>' . ucfirst($gender) . '</label>';
                                echo "<input type=\"checkbox\" name=\"gender['" . $gender . "']\" value=\"" . $gender . "\"" . (isset($_POST['gender']['\'' . $gender . '\'']) ? "checked" : "") . "></br>";
                            }
                        ?>
                    </div>
                    <div id="sizes">
                        <h3>Size</h3>
                        <?php
                            $sizes = array('S', 'M', 'L', 'XL', '2XL', '3XL'); 
                            foreach($sizes as $size)
                            {
                                echo '<label>' . ucfirst($size) . '</label>';
                                echo "<input type=\"checkbox\" name=\"size['" . $size. "']\" value=\"" . $size . "\"" . (isset($_POST['size']['\'' . $size . '\'']) ? "checked" : "") . "></br>";
                            }
                        ?>
                    </div>
                    <div id="price-range">
                        <h3>Price</h3>
                        <label for="lower">From</label><br>
                        <input type="number" id="lower" name="lower" value="<?php if(isset($_POST['lower'])) echo $_POST['lower']; else echo "0"?>" min="0" max="10000"><br>
                        <label for="upper">To</label><br>
                        <input type="number" id="upper" name="upper" value="<?php if(isset($_POST['upper'])) echo $_POST['upper']; else echo "10000"?>" min="0" max="10000"><br>
                    </div>
                    <div id="color">
                        <h3>Color</h3>
                        <?php
                            $colors = array('black', 'white'); 
                            foreach($colors as $color)
                            {
                                echo '<label>' . ucfirst($color) . '</label>';
                                echo "<input type=\"checkbox\" name=\"color['" . $color . "']\" value=\"" . $color . "\"" . (isset($_POST['color']['\'' . $color . '\'']) ? "checked" : "") . "></br>";
                            }
                        ?>
                    </div>
                    <input type="submit" name="submit" value="Apply filters">
                    <input type="submit" name="submit" value="Reset filters">
                </form>
            </div>
            <div id="row-3-col-2">
                <?php
                    echo "<h2>";
                    $array = array('best_selling', 'latest', 'trending');

                    /* If no parameter set or invalid parameter, set heading to Products, otherwise to the value 
                        of the valid parameter */
                    $match=false;
                    if(isset($_GET['sort']))
                    {
                        foreach($array as $comparer)
                            if($_GET['sort'] === $comparer)
                            {
                                $match=true;
                                break;
                            }
                    }
                    if(isset($_GET['sort']) && $match)
                        echo "<em>" . ucfirst($_GET['sort']) . "</em>";
                    else
                        echo "Products";
                    echo "</h2>";
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/shared-files/200219998/db.php');
                    require_once('scripts/sqlgen.php');
                    require_once('scripts/presentation.php');
                ?>
            </div>
            <div id="row-4">
                <div class="footer-heading footer-1">
                    <h2>Terms & Conditions</h2>
                    <a href="/footer_pages/privacy-policy.html">Privacy Policy</a>
                    <a href="/footer_pages/return-policy.html">Return Policy</a>
                    <a href="/footer_pages/Terms.html">Terms & Conditions</a>
                </div>

                <div class="footer-heading footer-2">
                    <h2>Customer Service</h2>
                    <a href="/contact/contact.php">Contact Us</a>
                    <a href="/footer_pages/faq.html">FAQ's</a>
                </div>

                <div class="footer-heading footer-3">
                    <h2>Information</h2>
                    <a href="/footer_pages/delivery-faq.html">Delivery Information</a>
                    <a href="/footer_pages/genral-faq.html">Genral Information</a>
                    <a href="/footer_pages/payments-faq.html">Payments Information</a>
                    <a href="/footer_pages/products-faq.html">Products Information</a>
                    <a href="/footer_pages/Vouchers-faq.html">Vouchers Information</a>
                    <a href="/footer_pages/returns-faq.html">Returns Information</a>
                </div>

                <div class="footer-email-form">
                    <h2>Join our newsletter subscription</h2>
                    <input type="email" placeholder="your email address" id="footer-email">
                    <input type="submit" value="Sign Up" id="footer-email-btn">
                </div>
            </div>
        </div>

    </body>
</html>
