<?php
session_start();

// Hardcode the demo account credentials
$name = 'Demo';
$pass = 'demo123';
$encp = sha1($pass); // Encrypt the password for matching

// Check if the user is logging in with the demo account credentials
if (isset($_POST['uname']) && isset($_POST['pass'])) {
    $input_name = $_POST['uname'];
    $input_pass = sha1($_POST['pass']); // Encrypt password input for comparison

    // Validate against hardcoded credentials
    if ($input_name === $name && $input_pass === $encp) {
        // Login successful
        $_SESSION['login'] = true;
        $_SESSION['uname'] = $name;

        // Create a session-based cart array for the user instead of a database table
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        echo "
            <script>
                alert('Login Successful');
                window.location='index.php';
            </script>";
    } else {
        // Login failed
        echo "<script>
                alert('Login Unsuccessful');
                window.location='login.php';
              </script>";
    }
} else {
    // If username or password are not set
    echo "<script>
            alert('Please provide username and password');
            window.location='login.php';
          </script>";
}
?>
