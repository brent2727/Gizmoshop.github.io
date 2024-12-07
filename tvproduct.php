<?php
session_start();

// Simulated television data (same as in tv.php for consistency)
$televisions = [
    [
        'product_id' => 'TV001',
        'name' => 'Sony Bravia 4K',
        'price' => 50000,
    ],
    [
        'product_id' => 'TV002',
        'name' => 'Mi 4A PRO',
        'price' => 30000,
    ],
    [
        'product_id' => 'TV003',
        'name' => 'LG Wallpaper TV',
        'price' => 70000,
    ]
];

// Get the product_id from the URL
$n1 = $_GET['n1'] ?? null; // Use GET since you're passing the ID in the URL
$quantity = $_POST['quantity'] ?? 1; // Default to 1 if not specified

if ($n1) {
    // Check if the selected television exists
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
                    // Update the quantity if the product is already in the cart
                    $item['quantity'] += $quantity;
                    $found = true;
                    break;
                }
            }

            // If the product is not in the cart, add it
            if (!$found) {
                $_SESSION['cart'][] = [
                    'product_id' => $tv['product_id'],
                    'name' => $tv['name'],
                    'price' => $tv['price'],
                    'quantity' => $quantity
                ];
            }

            // Redirect to the cart page (or back to tv.php)
            header("Location: cart.php");
            exit();
        }
    }
}

// If product is not found, redirect back to tv.php
header("Location: tv.php?error=not_found");
exit();
?>
