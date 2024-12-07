<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    // Clear the cart by unsetting the session variable
    if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }

    // Redirect back to the cart page
    header('Location: cart.php');
    exit();
} else {
    // If not logged in, redirect to the login page
    header('Location: login.php');
    exit();
}
?>
