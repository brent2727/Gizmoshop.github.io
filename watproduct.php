<?php
session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    // Hardcoded product data for watches
    $products = [
        1 => [
            'image' => 'wat1.jpg',
            'wname' => 'Rolex',
            'price' => 540000,
            'description' => 'Rolex is world-famous for its performance and reliability. Discover Rolex luxury watches on the Official Rolex Website.'
        ],
        2 => [
            'image' => 'wat2.jpg',
            'wname' => 'Fossil',
            'price' => 15,000,
            'description' => 'Shop our latest men\'s and women\'s collections of Fossil watches, and find the mechanical, traditional or smart watches that suit your style.'
        ],
        3 => [
            'image' => 'watch.jpg',
            'wname' => 'Apple iWatch Series 4',
            'price' => 40,000,
            'description' => 'Apple Watch Series 4 features its largest display yet, a re-engineered digital crown and cellular to make calls.'
        ]
    ];

    // Get product ID from URL parameters
    $n1 = $_REQUEST['n1'];

    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Watches</title>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel='stylesheet' type='text/css' href='main.css'>
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.1/css/all.css' integrity='sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz' crossorigin='anonymous'>
        <script src='https://code.jquery.com/jquery-3.1.1.min.js' integrity='sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=' crossorigin='anonymous'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' crossorigin='anonymous'></script>
    </head>
    <body>
        <nav class='navbar navbar-inverse navbar-fixed-top'>
            <div class='container'>
                <div class='navbar-header'>
                    <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>                        
                    </button>
                    <img class='navhead' src='geek.webp' width='50' height='50'>
                    <a class='navbar-brand' href='index.php'>G@dgeteri@</a>
                </div>
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
        echo "<a href='signup.php'><span class='glyphicon glyphicon-user'></span>Sign Up</a></li>
            <li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span>Login</a></li>";
    }
    
    echo "</ul>
                </div>
            </div>
        </nav>
        <br><br><br>
        <div class='bg'>
            <div class='container'>
                <div class='row'>
                    <div class='col-md-9' style='margin: 0 10%;'>
                        <div class='thumbnail'>";
    
    // Check if product exists
    if (array_key_exists($n1, $products)) {
        $product = $products[$n1];
        echo "<img class='img-responsive' src='" . $product['image'] . "'>";
        echo "<div class='caption'>
                <h2 class='pull-right'>₱ " . $product['price'] . "</h2>
                <h2><a>" . $product['wname'] . " - " . $n1 . "</a></h2><br>
                <form action='watcart.php?n1=" . $n1 . "' method='POST'>
                    <h4>Quantity</h4>
                    <p><button class='btn btn-primary pull-right' style='float:left;'>Add to Cart</button></p>
                    <div class='quan'>
                        <select class='quan' name='quantity' required>
                            <option value='1' class='label1' selected>1</option>
                            <option value='2' class='label1'>2</option>
                            <option value='3' class='label1'>3</option>
                            <option value='4' class='label1'>4</option>
                            <option value='5' class='label1'>5</option>
                        </select>
                    </div>
                </form>
                <h4><br>Description :<br><br>" . $product['description'] . "</h4>
            </div>";
    } else {
        echo "<h4>Product not found.</h4>";
    }
    
    echo "</div>
            </div>
        </div>
    </div>
    </body>
    </html>";
} else {
    header('location:login.php');
}
?>
