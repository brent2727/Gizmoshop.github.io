<?php 
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "gizmodb");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve input from the form
$username = mysqli_real_escape_string($conn, $_POST['uname1']);
$password = mysqli_real_escape_string($conn, $_POST['pass1']);

// Query to check user credentials
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
    if (password_verify($password, $user['password'])) {
        // Login successful
        $_SESSION['login'] = true;
        $_SESSION['uname'] = $username;

        // Remember me functionality
        if (isset($_POST['rem'])) {
            setcookie("username", $username, time() + 60*60*24*30, "/");
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
    // User not found
    echo "<script>
            alert('User not found');
            window.location='login.php';
          </script>";
}

mysqli_close($conn);
?>