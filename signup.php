<?php
session_start();
// Database connection
$conn = mysqli_connect("localhost", "root", "", "gizmodb");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    header("location:index.php");
    exit;
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, trim($_POST['uname']));
    $email = mysqli_real_escape_string($conn, trim($_POST['ead']));
    $password = mysqli_real_escape_string($conn, trim($_POST['pass']));
    $repassword = mysqli_real_escape_string($conn, trim($_POST['repass']));

    if ($password === $repassword) {
        // Check if username exists
        $check_user = "SELECT username FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $check_user);
        
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Username already exists!');</script>";
        } else {
            // Check if email exists
            $check_email = "SELECT email FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $check_email);
            
            if (mysqli_num_rows($result) > 0) {
                echo "<script>alert('Email already registered!');</script>";
            } else {
                // Hash password and insert user
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $insert_query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
                
                if (mysqli_query($conn, $insert_query)) {
                    echo "<script>alert('Registration Successful'); window.location='login.php';</script>";
                } else {
                    echo "<script>alert('Registration failed: " . mysqli_error($conn) . "');</script>";
                }
            }
        }
    } else {
        echo "<script>alert('Passwords do not match');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel='stylesheet' type='text/css' href='main.css'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.1/css/all.css' integrity='sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz' crossorigin='anonymous'>
    <link href='https://fonts.googleapis.com/css?family=Cinzel:700' rel='stylesheet'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js' type='text/javascript' async></script>
    <script src='https://code.jquery.com/jquery-3.1.1.min.js' integrity='sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=' crossorigin='anonymous'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' crossorigin='anonymous'></script>
</head>
<body data-spy='scroll' data-target='.navbar' data-offset='50'>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                </button>
                <img class="navhead" src="geek.webp" width="50" height="50">
                <a class="navbar-brand" href="index.php">Gizmo</a>
            </div>
            <center>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="mobile.php"><span class="glyphicon glyphicon-phone"></span>Smartphones</a></li>
                        <li><a href="laptop.php"><i class="fas fa-laptop"></i> Laptops</a></li>
                        <li><a href="watch.php"><i class="far fa-clock"></i> Watches</a></li>
                        <li><a href="tv.php"><i class="fas fa-tv"></i> Televisions</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    </ul>
                </div>
            </center>
        </div>
    </nav>

    <div id="particles-js">
        <div style="width: 40%; position: absolute; top:10vh; left: 30vw;">
            <form action="signup.php" method="POST">
                <center><h2 class="h22">Sign Up Form</h2></center>
                <div class="form-group">
                    <label for="Username"> Username</label>
                    <input type="text" class="form-control" id="Username" placeholder="Username" name="uname" required>
                </div>
                <div class="form-group">
                    <label for="Email">Email Address</label>
                    <input type="email" class="form-control" id="Email" placeholder="Email Address" name="ead" required>
                </div>
                <div class="form-group">
                    <label for="Password">Password</label>
                    <input type="password" class="form-control" id="Password" placeholder="Password" name="pass" required>
                    <br>
                    <label class="f2" for="Pass">Retype Password</label><br>
                    <input type="password" class="form-control" id="Pass" placeholder="Retype Password" name="repass" required>
                </div>
                <center><input type='submit' value=" Submit " class="btn btn-primary" id="bt"></center><br>
                <div class="form-group">
                    <center><a href="login.php" id="a"><label for="remember">Already have an account: Login </label></a></center>
                </div>
            </form>
        </div>
    </div>

    <script src="particles.js"></script>
    <script src="app.js"></script>
</body>
</html>