<?php
session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    // Sample laptop data array (replacing database)
    $laptops = [
        [
            'product_id' => 1,
            'lname' => 'Macbook Pro',
            'image' => 'apple.png',
            'price' => 1500,
            'description' => 'The ultimate pro notebook, MacBook Pro features faster processors, upgraded memory, the Apple T2 chip, and a Retina display with True Tone technology.',
        ],
        [
            'product_id' => 2,
            'lname' => 'Asus ROG',
            'image' => 'lap1.jpg',
            'price' => 1200,
            'description' => 'World\'s 1st 144Hz, G2G 3ms, Narrow bezel 7.7 Gaming laptop. Anti-Dust Cooling. Ultra-thin Intel i7 8th generation gaming laptop with NVIDIA GTX 1080.',
        ],
        [
            'product_id' => 3,
            'lname' => 'HP Spectre',
            'image' => 'lap2.jpg',
            'price' => 1300,
            'description' => 'Shop for HP Spectre x360 laptop here. Powerful, lightweight and stylish, featuring four operation modes with 360 degree hinge, and Windows Ink for creative.',
        ],
    ];

    // Get product ID from URL
    $n1 = isset($_REQUEST['n1']) ? intval($_REQUEST['n1']) : 0;

    // Find laptop by product_id
    $laptop = null;
    foreach ($laptops as $item) {
        if ($item['product_id'] === $n1) {
            $laptop = $item;
            break;
        }
    }

    if ($laptop) {
        echo "<!DOCTYPE html>
        <html>
        <head>
            <title>Laptop Details</title>
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
            <link rel='stylesheet' type='text/css' href='main.css'>
            <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.1/css/all.css' integrity='sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz' crossorigin='anonymous'>
            <script src='https://code.jquery.com/jquery-3.1.1.min.js' integrity='sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=' crossorigin='anonymous'></script>
            <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' crossorigin='anonymous'></script>
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
                    <div class='collapse navbar-collapse' id='myNavbar'>
                        <ul class='nav navbar-nav'>
                            <li><a href='mobile.php'><span class='glyphicon glyphicon-phone'></span> Smartphones</a></li>
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
                </div>
            </nav>
            <br><br><br>
            <div class='bg'>
                <div class='container'>
                    <div class='row'>
                        <div class='col-md-9' style='margin: 0 10%;'>
                            <div class='thumbnail'>
                                <img class='img-responsive' src='".$laptop['image']."'>
                                <div class='caption'>
                                    <h2 class='pull-right'>₱ ".$laptop['price']."</h2>
                                    <h2><a>".$laptop['lname']." - ".$laptop['product_id']."</a></h2><br>
                                    <form action='lapcart.php?n1=".$laptop['product_id']."' method='POST'>
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
                                    <h4><br>Description :<br><br>".$laptop['description']."</h4>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>  
            </body>
        </html>";
    } else {
        echo "<h2>Product not found!</h2>";
    }
} else {
    header('location:login.php');
}
?>
