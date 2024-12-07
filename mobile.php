<?php          
session_start(); 

// Check if the user is logged in
if (isset($_SESSION['login']) && $_SESSION['login'] === true) { 
    // Hard-coded smartphone data
    $smartphones = [
        [
            'name' => 'Iphone XS Max',
            'description' => 'Buy iPhone XS and iPhone XS Max in Gold, Space Gray, or Silver. With advanced Face ID, A12 Bionic chip, and Super Retina display.',
            'image' => 'mob1.jpg',
            'product_id' => 1
        ],
        [
            'name' => 'Samsung S9 Plus',
            'description' => 'Explore the specifications to find out what makes Galaxy S9 and S9+ work. ... sound with Dolby Atmos technology',
            'image' => 'mob2.jpg',
            'product_id' => 2
        ],
        [
            'name' => 'One Plus 6',
            'description' => 'Fast and Smooth, Get the The Speed You Need with OnePlus 6 - Snapdragon™ 845, 6.28 Inch Display Optic AMOLED, 16+20 MP Dual camera, Up to 8GB Ram.',
            'image' => 'one.jpg',
            'product_id' => 3
        ]
    ];

    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Smartphones</title>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel='stylesheet' type='text/css' href='animate.css'>
        <link rel='stylesheet' type='text/css' href='main.css'>
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.1/css/all.css' integrity='sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz' crossorigin='anonymous'>
        <link href='https://fonts.googleapis.com/css?family=Cinzel:700' rel='stylesheet'>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js' async></script>
        <script src='https://code.jquery.com/jquery-3.1.1.min.js' integrity='sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=' crossorigin='anonymous'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' crossorigin='anonymous'></script>
    </head>
    <body data-spy='scroll' data-target='.navbar' data-offset='50'>
        <nav class='navbar navbar-inverse navbar-fixed-top shrink'>
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
                    <ul class='nav navbar-nav navbar-right'>";
                    
                    if (isset($_SESSION['uname'])) {
                        echo "<li><a href='pass.php'><span class='glyphicon glyphicon-user'></span>" . htmlspecialchars($_SESSION['uname']) . "</a></li>
                        <li><a href='cart.php'><span class='glyphicon glyphicon-shopping-cart'></span> Cart</a></li>
                        <li><a href='logout.php'><span class='glyphicon glyphicon-log-in'></span> Logout</a></li>";
                    } else {
                        echo "<li><a href='signup.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>
                        <li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
                    } 
                    
                    echo "</ul>
                </div>
            </div>
        </nav>

        <div class='container-fluid'> 
            <div id='myCarousel' class='carousel slide' data-ride='carousel'>
                <ol class='carousel-indicators'>
                    <li data-target='#myCarousel' data-slide-to='0' class='active'></li>
                    <li data-target='#myCarousel' data-slide-to='1'></li>
                    <li data-target='#myCarousel' data-slide-to='2'></li>
                </ol>

                <div class='carousel-inner'>";

    // Display carousel items
    foreach ($smartphones as $index => $phone) {
        $activeClass = $index === 0 ? 'active' : '';
        echo "<div class='item {$activeClass}'>
                <img src='{$phone['image']}' alt='{$phone['name']}' style='width:100%;'>
                <div class='carousel-caption'>
                    <h2 class='animated bounceInDown'>{$phone['name']}</h2>
                    <p class='animated bounceInDown'>{$phone['description']}</p>
                </div>
              </div>";
    }

    echo "</div>
                <a class='left carousel-control' href='#myCarousel' data-slide='prev'>
                    <span class='glyphicon glyphicon-chevron-left'></span>
                    <span class='sr-only'>Previous</span>
                </a>
                <a class='right carousel-control' href='#myCarousel' data-slide='next'>
                    <span class='glyphicon glyphicon-chevron-right'></span>
                    <span class='sr-only'>Next</span>
                </a>
            </div>
        </div>

        <div class='periscope'>
            <div class='container-fluid'>
                <br>
                <div class='row text-center' style='display:flex; flex-wrap:wrap'>";

    // Display smartphone products
    foreach ($smartphones as $phone) {
        echo "<div class='col-lg-4 col-sm-6'>
                <div class='thumbnail'>
                    <img src='{$phone['image']}' alt='{$phone['name']}' style='width:100%;'>
                    <div class='caption'>
                        <h4>{$phone['name']} - ID: {$phone['product_id']}</h4>
                    </div>
                    <p><a href='mobproduct.php?n1={$phone['product_id']}' class='btn btn-primary'>More Info</a></p>
                </div>
              </div>";
    }

    echo "</div>                                  
                </div>
            </div>
            <script type='text/javascript' src='nav.js'></script>
        </body>
    </html>";
} else {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit(); // Ensure no further code is executed after redirect
}
?>
