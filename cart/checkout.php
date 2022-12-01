<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <link rel="stylesheet" href="checkout.css">

</head>
<body>
    <header>
        <nav>
            <div class="logo 1">
             <img src="C:\Users\pkafu\team 18 project\eighteen.png" alt="eighteen" width="80" height="90"
             div class="main-right">
           
            </div>

            
            <ul class="list-items">
                <li><a href="C:\Users\Ayubs\OneDrive\Desktop\team project\Home page\Home Page.html" class="link">HOME</a></li>
                <li><a href="/collections/collections.php" class="link">COLLECTIONS</a></li>
                <li><a href="#" class="link">CONTACT US</a></li>
                <li><a href="#" class="link">ABOUT US</a></li>
                
            </ul>
        
            <div class="nav-btns">
                <a href="#" class="btn-nav-i"><i class="fa fa-search"></i></a>
                <a href="#" class="btn-nav-i"><i class="fa fa-shopping-cart"></i></a>
                <a href="#" class="btn-nav-i"><i class="fa fa-user"></i></a>
                <a href="#" class="btn-nav-i"><i class="fa fa-heart"></i></a>
               
            </div>
        </nav>
        </header>
<div class="container">

    <form action="/cart/complete.php" method="post">

        <div class="row">

            <div class="col">

                <h3 class="title">billing address</h3>

                <div class="inputBox">
                    <span>full name :</span>
                    <input type="text" placeholder="john deo">
                </div>
                <div class="inputBox">
                    <span>email :</span>
                    <input type="email" placeholder="example@example.com"
                    title="please enter a valid email address and use the proper format"
                    required>
                </div>
                <div class="inputBox">
                    <span>address :</span>
                    <input type="text" placeholder="room - street - locality"
                    required>
                </div>
                <div class="inputBox">
                    <span>city :</span>
                    <input type="text" placeholder="mumbai"
                    required>
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>state :</span>
                        <input type="text" placeholder="india"
                        required>
                    </div>
                    <div class="inputBox">
                        <span>zip code :</span>
                        <input type="text" placeholder="123 456"
                        required>
                    </div>
                </div>

            </div>

            <div class="col">

                <h3 class="title">payment</h3>

                <div class="inputBox">
                    <span>cards accepted :</span>
                    <img src="images/card_img.png" alt="">
                </div>
                <div class="inputBox">
                    <span>name on card :</span>
                    <input type="text" placeholder="mr. john deo"
                    required>
                </div>
                <div class="inputBox">
                    <span>credit card number :</span>
                    <input type="number" placeholder="1111-2222-3333-4444"
                    pattern="/^\d*$/" onKeyPress="if(this.value.length==16) return false;"
                    required>
                </div>
                <div class="inputBox">
                    <span>exp month :</span>
                    <input type="month" min="2015-01" placeholder="MM/YYYY"
                    required>
                </div>
                <div class="flex">
                    <div class="inputBox">
                        <span>CVV :</span>
                        <input type="number" placeholder="123" maxlength="3"
                        pattern="/^\d*$/" onKeyPress="if(this.value.length==3) return false;"
                        required>
                    </div>
                </div>
            </div>
        </div>

        <input type="submit" value="complete" class="submit-btn">
    </form>

</div>    
    
</body>
</html>