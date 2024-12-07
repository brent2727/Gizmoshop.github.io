<?php
session_start();

// Sample products for demonstration purposes
$products = [
    'watch' => [
        'wname' => 'Watch Model 1',
        'product_id' => 'watch001',
        'price' => 5000
    ]
];

$n1 = $_REQUEST['n1'];
$_SESSION['quan'] = $_POST['quantity'];

if (isset($products[$n1])) {
    $product = $products[$n1];
    // Initialize cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Check if the product is already in the cart
    if (isset($_SESSION['cart'][$n1])) {
        $_SESSION['cart'][$n1]['quantity'] += $_SESSION['quan'];
    } else {
        // Add the product to the cart
        $_SESSION['cart'][$n1] = [
            'name' => $product['wname'],
            'price' => $product['price'],
            'quantity' => $_SESSION['quan']
        ];
    }
}

header("location:watch.php?n1=$n1");
?>
