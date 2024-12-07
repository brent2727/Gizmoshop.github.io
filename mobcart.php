<?php
session_start();

// Hard-coded smartphone data
$smartphones = [
    1 => [
        "name" => "Iphone XS Max",
        "price" => 999,
    ],
    2 => [
        "name" => "Samsung S9 Plus",
        "price" => 899,
    ],
    3 => [
        "name" => "One Plus 6",
        "price" => 549,
    ],
];

// Get the product ID and quantity from the request
$n1 = isset($_REQUEST['n1']) ? intval($_REQUEST['n1']) : null;
$_SESSION['quan'] = isset($_REQUEST['quantity']) ? intval($_REQUEST['quantity']) : 1;

// Check if the product ID is valid
if (array_key_exists($n1, $smartphones)) {
    // Retrieve the product details
    $product = $smartphones[$n1];

    // Initialize the cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add product to the cart
    $cartItem = [
        "product_id" => $n1,
        "mname" => $product['name'],
        "price" => $product['price'],
        "quantity" => $_SESSION['quan'],
    ];

    // Check if the product is already in the cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $n1) {
            $item['quantity'] += $_SESSION['quan']; // Update quantity
            $found = true;
            break;
        }
    }

    // If not found, add the new product to the cart
    if (!$found) {
        $_SESSION['cart'][] = $cartItem;
    }

    // Redirect back to mobile.php
    header("location:mobile.php");
} else {
    echo "<p>Product not found.</p>";
}
?>
