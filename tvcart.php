<?php
session_start();

// Simulated television data
$televisions = [
    [
        'product_id' => '1',
        'tname' => 'Sony Bravia 4K',
        'price' => 50000,
    ],
    [
        'product_id' => '2',
        'tname' => 'Mi 4A PRO',
        'price' => 30000,
    ],
    [
        'product_id' => '3',
        'tname' => 'LG Wallpaper TV',
        'price' => 70000,
    ]
];

// Get the product_id and quantity from the request
$n1 = $_REQUEST['n1'] ?? null;
$quantity = $_REQUEST['quantity'] ?? null;

if ($n1 && $quantity) {
    // Find the selected television by product_id
    foreach ($televisions as $tv) {
        if ($tv['product_id'] === $n1) {
            // If cart session is not set, initialize it
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Check if the product is already in the cart
            $found = false;
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['product_id'] === $tv['product_id']) {
                    // Update the quantity if product is already in cart
                    $item['quantity'] += $quantity;
                    $found = true;
                    break;
                }
            }

            // If the product is not in the cart, add it
            if (!$found) {
                $_SESSION['cart'][] = [
                    'product_id' => $tv['product_id'],
                    'tname' => $tv['tname'],
                    'price' => $tv['price'],
                    'quantity' => $quantity
                ];
            }

            // Redirect back to the TV page
            header("Location: tv.php");
            exit();
        }
    }
}

// If product is not found, redirect to tv.php
header("Location: tv.php");
exit();
?>
