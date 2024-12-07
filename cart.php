<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    // Initialize the cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Calculate total price
    $totalPrice = 0;

    // HTML output
    echo "
    <!DOCTYPE html>
    <html>
    <head>
        <title>CART</title>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel='stylesheet' type='text/css' href='main.css'>
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.1/css/all.css' integrity='sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz' crossorigin='anonymous'>
        <link href='https://fonts.googleapis.com/css?family=Cinzel:700' rel='stylesheet'>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js' type='text/javascript' async></script>
        <script src='https://code.jquery.com/jquery-3.1.1.min.js' integrity='sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=' crossorigin='anonymous'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' crossorigin='anonymous'></script>
        <style type='text/css'>
            * {
                margin: 0px;
                padding: 0px;
            }
            body {
                background-color: #232323;
                color: white;
            }
            .c1 {
                margin-top: 20px;
                text-align: center;
                font-size: 1.2em;
            }
            .c2 {
                width: 20%;
                height: 5vh;
                font-size: 1.2em;
                background-color: green;
            }
            .d {
                width: 50%;
                position: absolute;
                top: 20vh; 
                left: 25vw;
            }
            th, td {
                padding: 2vh 5vw;
            }
            @media(max-width: 960px) {
                .btn-success, .btn-danger {
                    width: 80%;
                    text-align: center;
                    position: absolute;
                    left: 20vh;
                }
                .d {
                    width: 30%;
                    position: absolute;
                    top: 10vh; 
                    left: 15vw;
                }
                th, td {
                    padding: 1vh 2vw;
                }
            }
        </style>
    </head>
    <body data-spy='scroll' data-target='.navbar' data-offset='50'>
        <nav class='navbar navbar-inverse navbar-fixed-top'>
            <div class='container'>
                <div class='navbar-header'>
                    <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>                        
                    </button>
                    <img class='navhead' src='geek.webp' width='50' height='50'>
                    <a class='navbar-brand' href='index.php'>Gizmo</a>
                </div>
                <center>
                    <div class='collapse navbar-collapse' id='myNavbar'>
                        <ul class='nav navbar-nav'>
                            <li><a href='mobile.php'><span class='glyphicon glyphicon-phone'></span>Smartphones</a></li>
                            <li><a href='laptop.php'><i class='fas fa-laptop'></i> Laptops</a></li>
                            <li><a href='watch.php'><i class='far fa-clock'></i> Watches</a></li>
                            <li><a href='tv.php'><i class='fas fa-tv'></i> Televisions</a></li>
                        </ul>
                        <ul class='nav navbar-nav navbar-right'>
                            <li>";
                            if (isset($_SESSION['uname'])) {
                                echo "<a href='pass.php'><span class='glyphicon glyphicon-user'></span>";
                                echo $_SESSION['uname']; 
                                echo "</a></li>
                                <li><a href='cart.php'><span class='glyphicon glyphicon-shopping-cart'></span> Cart</a></li>
                                <li><a href='logout.php'><span class='glyphicon glyphicon-log-in'></span> Logout</a></li>";
                            } else {
                                echo "<a href='signup.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>
                                <li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
                            } 
                            echo "        
                            </ul>
                    </div>
                </center>
            </div>
        </nav>

        <div id='particles-js'>
            <div class='d'>
                <form action='address.php' method='POST'>
                    <center>
                        <table class='c1' cellpadding='20px' border='2'>
                            <tr>
                                <td>PRODUCT NAME</td>
                                <td>QUANTITY</td>
                                <td class='black1'>PRICE</td>
                            </tr>";

    // Display cart items
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $productName = $item['name'] ?? 'Iphone Xs Max'; // Fetch product name from session
            $quantity = $item['quantity'] ?? 0; // Fetch quantity from session
            $price = $item['price'] ?? 0; // Fetch price from session
            $amount = $price * $quantity;
            $totalPrice += $amount;

            echo "<tr>
                    <td>{$productName}</td>
                    <td>{$quantity}</td>
                    <td>₱ {$amount}</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Your cart is empty.</td></tr>"; // Show message if the cart is empty
    }

    echo "
                            <tr>
                                <td>Order Total</td>
                                <td></td>
                                <td>₱ {$totalPrice}</td>
                            </tr>
                        </table><br><br>
                    </center>
                    <center>
                        <button class='btn btn-success'>Proceed</button>
                        <a href='clear.php' class='btn btn-danger'>Clear Cart</a>
                    </center>
                </form>
            </div>
        </div>
        <script src='particles.js'></script>
        <script src='app.js'></script>
    </body>
    </html>";
} else {
    header('location:login.php');
    exit();
}
?>
