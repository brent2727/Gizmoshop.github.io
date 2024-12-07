<?php
session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    // Check if form was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['submit'])) {
            // Save form data in the session
            $_SESSION['address_data'] = $_POST;
        } elseif (isset($_POST['cancel'])) {
            // Clear session data and reload the form
            unset($_SESSION['address_data']);
        }
    }

    // Check if the "Edit" button was clicked
    $editMode = isset($_POST['edit']);
    $addressData = isset($_SESSION['address_data']) ? $_SESSION['address_data'] : null;
?>
<!DOCTYPE html>
<html>
<head>
    <title>ADDRESS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Cinzel:700" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <style>
        /* Inline CSS styling for layout */
        .container3 { width: 40%; }
        @media (max-width: 960px) {
            .btn-primary { width: 80%; }
            .container3 { width: 80%; }
        }
    </style>
</head>
<body>
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
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="mobile.php"><span class="glyphicon glyphicon-phone"></span> Smartphones</a></li>
                    <li><a href="laptop.php"><i class="fas fa-laptop"></i> Laptops</a></li>
                    <li><a href="watch.php"><i class="far fa-clock"></i> Watches</a></li>
                    <li><a href="tv.php"><i class="fas fa-tv"></i> Televisions</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                        if (isset($_SESSION['uname'])) {
                            echo "<li><a href='pass.php'><span class='glyphicon glyphicon-user'></span> " . $_SESSION['uname'] . "</a></li>
                                  <li><a href='cart.php'><span class='glyphicon glyphicon-shopping-cart'></span> Cart</a></li>
                                  <li><a href='logout.php'><span class='glyphicon glyphicon-log-in'></span> Logout</a></li>";
                        } else {
                            echo "<li><a href='signup.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>
                                  <li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <br><br><br>

    <div class="container container3">
        <?php if ($addressData && !$editMode): ?>
            <!-- Display the saved address information -->
            <h2 class="text-danger">Your Address Details</h2>
            <hr>
            <p><strong>First Name:</strong> <?= htmlspecialchars($addressData['fname']) ?></p>
            <p><strong>Last Name:</strong> <?= htmlspecialchars($addressData['lname']) ?></p>
            <p><strong>Street Name:</strong> <?= htmlspecialchars($addressData['sname']) ?></p>
            <p><strong>Address Line 2:</strong> <?= htmlspecialchars($addressData['address']) ?></p>
            <p><strong>City:</strong> <?= htmlspecialchars($addressData['city']) ?></p>
            <p><strong>State:</strong> <?= htmlspecialchars($addressData['state']) ?></p>
            <p><strong>Pin Code:</strong> <?= htmlspecialchars($addressData['zip']) ?></p>
            <p><strong>Phone Number:</strong> <?= htmlspecialchars($addressData['phone']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($addressData['email']) ?></p>
            <p><strong>Coupon Code:</strong> <?= htmlspecialchars($addressData['coupon']) ?></p>
            <form method="post" action="">
                <center>
                    <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                    <button type="submit" name="cancel" class="btn btn-danger">Cancel</button>
                </center>
            </form>
        <?php else: ?>
            <!-- Address Form -->
            <form action="" method="POST">
                <h2 class="text-danger">ADDRESS DETAILS</h2>
                <hr>
                <div class="form-group">
                    <label for="fname">First Name:</label>
                    <input type="text" class="form-control" id="fname" name="fname" value="<?= $addressData['fname'] ?? '' ?>" placeholder="First Name" required>
                    <label for="lname">Last Name:</label>
                    <input type="text" class="form-control" id="lname" name="lname" value="<?= $addressData['lname'] ?? '' ?>" placeholder="Last Name">
                </div>
                <div class="form-group">
                    <label for="sname">Street Name:</label>
                    <input type="text" class="form-control" id="sname" name="sname" value="<?= $addressData['sname'] ?? '' ?>" placeholder="Street Name" required>
                </div>
                <div class="form-group">
                    <label for="address">Address Line 2:</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?= $addressData['address'] ?? '' ?>" placeholder="Address">
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?= $addressData['city'] ?? '' ?>" placeholder="City" required>
                    <label for="state">State:</label>
                    <select name="state" class="form-control" required>
                        <option value="METRO MANILA" <?= (isset($addressData['state']) && $addressData['state'] == 'METRO MANILA') ? 'selected' : '' ?>>METRO MANILA</option>
                        <option value="CALABARZON" <?= (isset($addressData['state']) && $addressData['state'] == 'CALABARZON') ? 'selected' : '' ?>>CALABARZON</option>
                        <option value="MIMAROPA" <?= (isset($addressData['state']) && $addressData['state'] == 'MIMAROPA') ? 'selected' : '' ?>>MIMAROPA</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="zip">Pin Code:</label>
                    <input type="text" class="form-control" id="zip" name="zip" value="<?= $addressData['zip'] ?? '' ?>" placeholder="Zip Code" required>
                    <label for="phone">Phone Number:</label>
                    <input type="number" class="form-control" id="phone" name="phone" value="<?= $addressData['phone'] ?? '' ?>" placeholder="xxxxxxxxxx" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $addressData['email'] ?? '' ?>" placeholder="email">
                </div>
                <div class="form-group">
                    <label for="coupon">Coupon Code:</label>
                    <input type="text" class="form-control" id="coupon" name="coupon" value="<?= $addressData['coupon'] ?? '' ?>" placeholder="code">
                </div>
                <center><button type="submit" name="submit" class="btn btn-primary">PROCEED</button></center>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
<?php
} else {
    header('location:login.php');
}
?>  
