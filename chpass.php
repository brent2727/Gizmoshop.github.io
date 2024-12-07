<?php
session_start();

// Simulate getting user inputs for username, password, and email
$name = $_REQUEST["uname2"];
$newpwd = $_REQUEST["pass2"];
$mail = $_REQUEST["email2"];

// Encrypt the new password
$enpwd = sha1($newpwd);

// Check if the user is registered in the session and email matches
if (isset($_SESSION['registered_users'][$name]) && $_SESSION['registered_users'][$name]['email'] === $mail) {
    // Update the password in the session-based user data
    $_SESSION['registered_users'][$name]['password'] = $enpwd;

    echo "
        <script>
            alert('Password has been updated successfully');
            window.location='index.php';
        </script>";
} else {
    // If the user is not found or email doesn't match
    echo "
        <script>
            alert('User not found or email does not match.');
            window.location='forgot_password.php';
        </script>";
}
?>
