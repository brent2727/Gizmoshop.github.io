<?php
session_start(); 

// Check if the user is logged in
if (isset($_SESSION['login']) && $_SESSION['login'] == true) { 
    // Hard-coded smartphone data
    $smartphones = [
        1 => [
            "name" => "Iphone XS Max",
            "image" => "mob1.jpg",
            "price" => 999,
            "description" => "The iPhone XS Max features a 6.5-inch Super Retina display, A12 Bionic chip, and advanced Face ID.",
        ],
        2 => [
            "name" => "Samsung S9 Plus",
            "image" => "mob2.jpg",
            "price" => 899,
            "description" => "The Galaxy S9+ has a 6.2-inch display, an impressive camera, and is powered by the Snapdragon 845 processor.",
        ],
        3 => [
            "name" => "One Plus 6",
            "image" => "one.jpg",
            "price" => 549,
            "description" => "The OnePlus 6 comes with a 6.28-inch AMOLED display and is powered by Snapdragon 845 with up to 8GB of RAM.",
        ],
    ];

    // Get the product ID from the URL
    $n1 = isset($_REQUEST['n1']) ? intval($_REQUEST['n1']) : null;

    // Check if the product ID is valid
    if (array_key_exists($n1, $smartphones)) {
        $phone = $smartphones[$n1];

        echo "<!DOCTYPE html>
        <html>
        <head>
            <title>{$phone['name']}</title>
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
            <link rel='stylesheet' type='text/css' href='main.css'>
            <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.1/css/all.css' integrity='sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz' crossorigin='anonymous'>
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
                                <li><a href='mobile.php'><span class='glyphicon glyphicon-phone'></span> Smartphones</a></li>
                                <li><a href='laptop.php'><i class='fas fa-laptop'></i> Laptops</a></li>
                                <li><a href='watch.php'><i class='far fa-clock'></i> Watches</a></li>
                                <li><a href='tv.php'><i class='fas fa-tv'></i> Televisions</a></li>
                            </ul>
                            <ul class='nav navbar-nav navbar-right'>
                                <li>";
                                
                                if (isset($_SESSION['uname'])) {
                                    echo "<a href='pass.php'><span class='glyphicon glyphicon-user'></span>" . $_SESSION['uname'] . "</a></li>
                                          <li><a href='cart.php'><span class='glyphicon glyphicon-shopping-cart'></span> Cart</a></li>
                                          <li><a href='logout.php'><span class='glyphicon glyphicon-log-in'></span> Logout</a></li>";
                                } else {
                                    echo "<a href='signup.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>
                                          <li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
                                }
                                
                                echo "</ul>
                        </div>
                    </center>
                </div>
            </nav>
            <br><br><br>
            <div class='bg'>
                <div class='container'>
                    <div class='row'>
                        <div class='col-md-9' style='margin: 0 10%;'>
                            <div class='thumbnail'>
                                <img class='img-responsive' src='" . $phone['image'] . "' alt='" . $phone['name'] . "'>
                                <div class='caption'>
                                    <h2 class='pull-right'>₱ " . $phone['price'] . "</h2>
                                    <h2><a>" . $phone['name'] . " - ID: " . $n1 . "</a></h2><br>
                                    <form action='mobcart.php?n1=" . $n1 . "' method='POST'>
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
                                    <h4><br>Description :<br><br>" . $phone['description'] . "</h4>
                                </div>
                            </div>
                        </div>
                    </div>	
                </div>	
            </body>
        </html>";
    } else {
        echo "<p>Product not found.</p>";
    }
} else {
    header('location:login.php');
}
?>
