<?php 
    session_start(); 
    $_SESSION['info']['referer']=$_SERVER['PHP_SELF'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Grid</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="collections.css?ts=<?=time()?>">
    </head>
    <body>
        <div id="container">
            <div id="row-1-col-1">
                <img src="/shared-images/logo-2.png" width=50px height=50px>
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
                    if(!isset($_SESSION['authenticate']['username']))
                        echo " style=\"background-color: #ff0000; font-weight: bold;\" ";
                    echo "value=\"off\">DE-EMULATE AUTH STATE</button>";
                    echo "<button type=\"submit\" name=\"state\""; 
                    if(isset($_SESSION['authenticate']['username']))
                        echo " style=\"background-color: #00ff00; font-weight: bold;\" ";
                    echo "value=\"on\">EMULATE AUTH STATE</button>";
                    echo "</form>";
                    if(isset($_SESSION['authenticate']['username']))
                    {
                        //echo "<img src=\"/account.jpg\">";
                        //echo "<img src=\"/cart.jpg\">";
                    }
                ?>
            </div>
            <div id="row-2">
                <form method="get" action="collections.php">
                    <span id="sorting">
                        <label for="sort">Sort By</label>
                        <select name="sort" value>
                            <option value="relevance" <?php if($_GET['sort'] == 'relevance') echo "selected"; ?>>Relevance</option>
                            <option value="low-to-high" <?php if($_GET['sort'] == 'low-to-high') echo "selected"; ?>>Price (Low-to-High)</option>
                            <option value="high-to-low" <?php if($_GET['sort'] == 'high-to-low') echo "selected"; ?>>Price (High-to-Low)</option>
                            <option value="rating" <?php if($_GET['sort'] == 'rating') echo "selected"; ?>>Rating</option>
                        </select>
                    </span>
                    <span id="search-bar">
                        <input type="text" name="q" <?php if(isset($_GET['q'])) echo "value='" . $_GET['q'] . "'"; ?>>
                        <button type="submit">Search</button>
                    </span>
                </form>
                <?php
                    include_once('notification.php');
                ?>   
            </div>
            <div id="row-3-col-1">
                <form method="post" action="">
                    <div id="categories">
                        <h3>Category</h3>
                        <?php
                            $categories = array('sweatshirt', 'hoodie', 'jacket', 't-shirt'); 
                            foreach($categories as $category)
                            {
                                echo '<label>' . ucfirst($category) . 's</label>';
                                echo "<input type=\"checkbox\" name=\"category['" . $category . "']\" value=\"" . $category . "\"" . (isset($_POST['category']['\'' . $category . '\'']) ? "checked" : "") . "></br>";
                            }
                        ?>
                    </div>
                    <div id="price-range">
                        <h3>Price</h3>
                        <label for="lower">From</label>
                        <input type="number" id="lower" name="lower" value="<?php if(isset($_POST['lower'])) echo $_POST['lower']; else echo "0"?>" min="0" max="10000"></br>
                        <label for="upper">To</label>
                        <input type="number" id="upper" name="upper" value="<?php if(isset($_POST['upper'])) echo $_POST['upper']; else echo "10000"?>" min="0" max="10000"></br>
                    </div>
                    <div id="color">
                        <h3>Color</h3>
                        <?php
                            $colors = array('black', 'white', 'grey'); 
                            foreach($colors as $color)
                            {
                                echo '<label>' . ucfirst($color) . '</label>';
                                echo "<input type=\"checkbox\" name=\"color['" . $color . "']\" value=\"" . $color . "\"" . (isset($_POST['color']['\'' . $color . '\'']) ? "checked" : "") . "></br>";
                            }
                        ?>
                    </div>
                    <input type="submit" value="Apply filters">
                </form>
            </div>
            <div id="row-3-col-2">
                <?php
                    echo "<h2>";
                    if(isset($_GET['sort']))
                    {
                        switch($_GET['sort'])
                        {
                            // Most views and most sold
                            case "best_selling":
                                echo "Best Selling";
                                break;
                            case "latest":
                                echo "Latest";
                                break;
                            case "trending":
                                echo "Trending";
                                break;
                            default:
                                echo "Products";
                        }
                    }
                    else
                        echo "Products";

                    echo "</h2>";
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/database_connection.php');
                    require_once('scripts/assemble_query.php');
                    require_once('scripts/display_products.php');
                ?>
            </div>
            <div id="row-4">
                <p>(footer)</p>
            </div>
        </div>
    </body>
</html>