<?php
session_start(); // Start the session
include('includes/db.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = trim($_POST['username']);
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);
    $position = "Agent"; // Default position for new users

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Insert user into the database with position column
    $sql = "INSERT INTO users (username, email, password, position) VALUES ('$user', '$email', '$pass', '$position')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['username'] = $user;
        $_SESSION['user_id'] = $conn->insert_id;

        header("Location: property-add.php"); // Redirect after successful signup
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sign Up</title>
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/authentication.css">
    <link rel="stylesheet" href="assets/css/color_skins.css">
</head>

<body class="theme-purple authentication sidebar-collapse">
<nav class="navbar navbar-expand-lg fixed-top navbar-transparent">
    <div class="container">
        <div class="navbar-translate n_logo">
            <a class="navbar-brand" href="#">Oreo</a>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link btn btn-white btn-round" href="sign-in.php">SIGN IN</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="page-header">
    <div class="page-header-image" style="background-image:url(assets/images/login.jpg)"></div>
    <div class="container">
        <div class="col-md-12 content-center">
            <div class="card-plain">
                <form class="form" method="POST" action="sign-up.php">
                    <div class="header">
                        <div class="logo-container">
                            <img src="assets/images/logo.svg" alt="">
                        </div>
                        <h5>Sign Up</h5>
                        <span>Register a new membership</span>
                    </div>
                    <div class="content">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter User Name" name="username" required>
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-account-circle"></i>
                            </span>
                        </div>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter Email" name="email" required>
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-email"></i>
                            </span>
                        </div>
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-lock"></i>
                            </span>
                        </div>
                    </div>
                    <div class="checkbox">
                        <input id="terms" type="checkbox" required>
                        <label for="terms">
                            I read and agree to the <a href="#">terms of usage</a>
                        </label>
                    </div>
                    <div class="footer text-center">
                        <button type="submit" class="btn btn-primary btn-round btn-lg btn-block waves-effect waves-light">SIGN UP</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <nav>
            <ul>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">FAQ</a></li>
            </ul>
        </nav>
        <div class="copyright">
            &copy; <script>document.write(new Date().getFullYear())</script>, Designed by <a href="#">Rigvesoft</a>
        </div>
    </div>
</footer>

<script src="assets/bundles/libscripts.bundle.js"></script>
<script src="assets/bundles/vendorscripts.bundle.js"></script>

</body>
</html>
