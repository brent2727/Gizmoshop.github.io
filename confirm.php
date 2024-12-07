<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    // Start HTML Output
    echo "  
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel='stylesheet' type='text/css' href='main.css'>
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.1/css/all.css' integrity='sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz' crossorigin='anonymous'>
        <link href='https://fonts.googleapis.com/css?family=Cinzel:700' rel='stylesheet'>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body {
                background-color: #f8f9fa;
                color: #333;
                font-family: 'Cinzel', serif;
            }
            .navbar {
                margin-bottom: 0;
            }
            .container {
                margin-top: 80px;
            }
            .header {
                text-align: center;
                margin-bottom: 30px;
            }
            .order-summary {
                background: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
            table {
                width: 100%;
                margin-top: 20px;
                border-collapse: collapse;
            }
            th, td {
                padding: 12px;
                text-align: left;
                border: 1px solid #ddd;
            }
            th {
                background-color: #007bff;
                color: white;
            }
            .btn-success {
                width: 100%;
                padding: 10px;
            }
        </style>
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
                    <a class='navbar-brand' href='index.php'>Gizmo</a>
                </div>
                <div class='collapse navbar-collapse' id='myNavbar'>
                    <ul class='nav navbar-nav'>
                        <li><a href='mobile.php'>Smartphones</a></li>
                        <li><a href='laptop.php'>Laptops</a></li>
                        <li><a href='watch.php'>Watches</a></li>
                        <li><a href='tv.php'>Televisions</a></li>
                    </ul>
                    <ul class='nav navbar-nav navbar-right'>
                        <li>";
                        if (isset($_SESSION['uname'])) {
                            echo "<a href='pass.php'>" . htmlspecialchars($_SESSION['uname']) . "</a></li>
                                  <li><a href='cart.php'>Cart</a></li>
                                  <li><a href='logout.php'>Logout</a></li>";
                        } else {
                            echo "<a href='signup.php'>Sign Up</a></li>
                                  <li><a href='login.php'>Login</a></li>";
                        }
                        echo "
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class='container'>
            <div class='header'>
                <h2 class='bg-success'>Order Confirmation</h2>
            </div>
            <div class='order-summary'>
                <h4>Please Take a moment to review your Order:</h4>
                <table>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>";

                // Displaying the products from the session
                if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                    $sum = 0; // Initialize sum for total calculation
                    foreach ($_SESSION['cart'] as $item) {
                        // Check if expected keys exist in the item
                        $productName = isset($item['name']) ? htmlspecialchars($item['name']) : 'Iphone Xs Max  ';
                        $quantity = isset($item['quantity']) ? htmlspecialchars($item['quantity']) : 0;
                        $price = isset($item['price']) ? htmlspecialchars($item['price']) : 0;
                        $totalPrice = $price * $quantity;

                        echo "<tr>
                                <td>{$productName}</td>
                                <td>{$quantity}</td>
                                <td>₱ {$totalPrice}</td>
                            </tr>";

                        $sum += $totalPrice; // Add to the total sum
                    }

                    echo "<tr>
                            <td><strong>Order Total</strong></td>
                            <td></td>
                            <td><strong>₱ {$sum}</strong></td>
                        </tr>";
                } else {
                    echo "<tr>
                            <td colspan='3'>No items in cart</td>
                        </tr>";
                }

                echo "
                </table>
                <form action='thank.php' method='POST'>
                    <input type='submit' class='btn btn-success' value='Proceed to Payment'>
                </form>
            </div>
        </div>
        
        <script src='https://code.jquery.com/jquery-3.1.1.min.js' integrity='sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=' crossorigin='anonymous'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' crossorigin='anonymous'></script>
    </body>
    </html>";
} else {
    // Redirect to login if not logged in
    header('Location: login.php');
    exit();
}
?>
