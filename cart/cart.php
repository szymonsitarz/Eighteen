<?php 
	/*
		1. Add paths to web pages in anchors (e.g. class=list-items, class=nav-btns)
			--see web root structure on GitHub for paths
		2. CSS styling

	*/
	session_start(); 
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="cart.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <div class="logo 1">
             <img src="/shared-files/logo.png" alt="eighteen" width="80" height="90"
             div class="main-right">
			 
            </div>

            
            <ul class="list-items">
                <li><a href="/home/home.php" class="link">HOME</a></li>
                <li><a href="/collections/collections.php" class="link">COLLECTIONS</a></li>
                <li><a href="/contact/contact.php" class="link">CONTACT US</a></li>
                <li><a href="/about-us/about-us.php" class="link">ABOUT US</a></li>
                
            </ul>
        
            <div class="nav-btns">
                <a href="/cart/cart.php" class="btn-nav-i"><i class="fa fa-shopping-cart"></i></a>
                <a href="/account/accountinfo.php" class="btn-nav-i"><i class="fa fa-user"></i></a>
               
            </div>
        </nav>
		<div class="project">
			<div class="shop">
				<?php
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);

				// If previous action was to remove an item, do so for the particular pid.
				if(isset($_POST['remove']))
					unset($_SESSION['cart'][$_POST['remove']]);
				
				// Display each unique item in cart and calculate subtotal
				$subtotal=0;
				foreach($_SESSION['cart'] as $key => $quantity)
				{
					// STRANGE ERROR
					if(intval($key) == 0) continue;

					// Remove items with negative quantities
					if($quantity < 0)
						unset($_SESSION['cart'][$key]);
					else
					{
						require_once($_SERVER['DOCUMENT_ROOT'] . "/shared-files/200219998/db.php");
						$query = "SELECT name, price FROM products WHERE pid=:pid";
						$sth = $db->prepare($query);
						$pid=intval($key);
						$sth->bindParam(":pid", $pid);
						$sth->execute();
						$row = $sth->fetch(PDO::FETCH_ASSOC);

						$subtotal+=$row['price']*$quantity;

						echo "<div class=\"box-container\">";
						echo "<div class=\"box\">";
						echo "<img src=\"/product/img/" . $row['name'] . "/1.png\">";
						echo "<div class=\"content\">";
						echo "<h3>" . $row['name'] . "</h3>";
						echo "<h4>Price: " . $_SESSION['product']['price'] . "</h4>";
						echo "<p class=\"unit\">Quantity: <input name=\"\" value=\"" . $quantity . "\"></p>";
						echo "</div></div>";
						echo "<form action=\"\" method=\"post\"><button type=\"submit\" name=\"remove\" value=\"" . $key . "\" class=\"btn-area\">Remove</button></form>";
					}
				}
				?>
			</div>
			<div class="right-bar">
				<?php
					if($subtotal > 0)
					{
						$tax = (double) $subtotal * 0.05;
						echo "<div>";
						echo "<p><span>Subtotal</span> <span>£" . $subtotal . "</span></p>";
						echo "<hr>";
						echo "<p><span>Tax (5%)</span> <span>£" . $tax . "</span></p>";
						echo "<hr>";
						echo "<p><span>Shipping</span> <span>£5</span></p>";
						echo "<hr>";
						echo "<p><span>Total</span> <span>£141</span></p>";
						echo "</div>";
						echo "<div class=\"checkout-btn\">";
						echo "<form action=\"checkout.php\" method=\"post\">";
						echo "<button type=\"submit\" name=\"checkout\">Checkout</button>";
						echo "<input type=\"hidden\" name=\"quantity\">";
						echo "</form>";
						echo "</div>";
					}
					else
						echo "No items in cart";
				?>
				</div>
			</div>

		</div>
</body>
</html>
