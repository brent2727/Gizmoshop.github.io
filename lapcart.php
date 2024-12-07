<?php
session_start();

// Sample laptop data array (replacing database)
$laptops = [
    [
        'product_id' => 1,
        'lname' => 'Macbook Pro',
        'price' => 1500,
    ],
    [
        'product_id' => 2,
        'lname' => 'Asus ROG',
        'price' => 1200,
    ],
    [
        'product_id' => 3,
        'lname' => 'HP Spectre',
        'price' => 1300,
    ],
];

// Initialize cart in session if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get product ID and quantity from request
$n1 = isset($_REQUEST['n1']) ? intval($_REQUEST['n1']) : 0;
$_SESSION['quan'] = isset($_REQUEST['quantity']) ? intval($_REQUEST['quantity']) : 1;

// Find laptop by product_id
$laptop = null;
foreach ($laptops as $item) {
    if ($item['product_id'] === $n1) {
        $laptop = $item;
        break;
    }
}

// Add laptop to cart if found
if ($laptop) {
    // Prepare the item to be added to the cart
    $cartItem = [
        'product_id' => $laptop['product_id'],
        'lname' => $laptop['lname'],
        'price' => $laptop['price'],
        'quantity' => $_SESSION['quan'],
    ];

    // Check if the product is already in the cart
    $found = false;
    foreach ($_SESSION['cart'] as &$cartProduct) {
        if ($cartProduct['product_id'] === $cartItem['product_id']) {
            // Update quantity if product already exists in cart
            $cartProduct['quantity'] += $cartItem['quantity'];
            $found = true;
            break;
        }
    }

    // If product is not found in the cart, add it
    if (!$found) {
        $_SESSION['cart'][] = $cartItem;
    }

    // Redirect back to the laptop page
    header("Location: laptop.php");
    exit();
} else {
    echo "<h2>Product not found!</h2>";
}
?>
