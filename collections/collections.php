<?php 
    session_start(); 
    $_SESSION['info']['referer']=$_SERVER['PHP_SELF'];
    if(isset($_POST['submit']))
        if($_POST['submit'] != 'Apply filters')
            unset($_POST);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Grid</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="collections.css?ts=<?=time()?>">
        <link rel="stylesheet" href="/shared-files/200219998/footer.css?ts=<?=time()?>">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                <script>
                    $(function(){
                    $("#footer").load("/footer/footer.html"); 
                    });
        </script> 
    </head>
    <body>
        <div id="container">
            <div id="row-1-col-1">
                <img src="/shared-files/200219998/logo-2.png" width=50px height=50px>
            </div>
            <div id="row-1-col-2">
                <a href="/home/home.html"><h1>HOME</h1></a>
                <a href="/collections/collections.php"><h1>COLLECTIONS</h1></a>
                <a href="/contact/contact.php"><h1>CONTACT</h1></a>
                <a href="/about-us/about-us.html"><h1>ABOUT US</h1></a>
            </div>
            <div id="row-1-col-3">
                <?php
                    echo "<a href=\"/cart/cart.php\">Cart   </a><br>";
                    if(isset($_SESSION['authenticate']['username']))
                    {
                        echo "<a href=\"/authenticate/login.php\">Login   </a>";
                        echo "<a href=\"/authenticate/register.php\">Register</a>";
                    }
                    else
                    {
                        echo "<a href=\"/account/accountinfo.php\">Account    </a>";
                        echo "<a href=\"/authenticate/logout.php\">Logout</a>";
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
                            $genders = array('male', 'female'); 
                            foreach($genders as $gender)
                            {
                                echo '<label>' . ucfirst($gender) . '</label>';
                                echo "<input type=\"checkbox\" name=\"gender['" . $gender . "']\" value=\"" . $gender . "\"" . (isset($_POST['gender']['\'' . $gender . '\'']) ? "checked" : "") . "></br>";
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
                    <input type="submit" value="Apply filters">
                    <input type="submit" value="Reset filters">
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
                    require_once($_SERVER['DOCUMENT_ROOT'] . '/shared-files/200219998/database_connection.php');
                    require_once('scripts/assemble_query.php');
                    require_once('scripts/display_products.php');
                ?>
            </div>
            <div id="row-4">
                <div id="footer"></div>
            </div>
        </div>
    </body>
</html>