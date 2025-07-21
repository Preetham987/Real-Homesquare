<?php
session_start();
include("includes/db.php"); // Include database connection

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $newPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if passwords match
    if ($newPassword !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        // Update password in the database (WITHOUT hashing)
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
        $stmt->bind_param("ss", $newPassword, $username);
        
        if ($stmt->execute()) {
            $success = "Password updated successfully! Redirecting to login...";
        } else {
            $error = "Failed to update password.";
        }

        $stmt->close();
    }
    $conn->close();
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Welcome">
<meta name="author" content="Welcome">
    <meta name="description" content="Welcome">

    <title>:: Oreo RealEstate :: Reset Password</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Custom Css -->
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/authentication.css">
    <link rel="stylesheet" href="assets/css/color_skins.css">
</head>

<body class="theme-purple authentication sidebar-collapse">
<div class="page-header">
    <div class="page-header-image" style="background-image:url(../assets/images/login.jpg)"></div>
    <div class="container">
        <div class="col-md-12 content-center">
            <div class="card-plain">
                <form class="form" method="post">                                         
                    <div class="header">
                        <div class="logo-container">
                            <img src="admin.png" alt="">
                        </div>
                        <h5>Reset Password</h5>
                    </div>
                    <div class="content">       
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter New Password" name="password" id="password" required>
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-account-circle"></i>
                            </span>
                        </div>
                        <div class="input-group">
                            <input type="text" placeholder="Confirm New Password" class="form-control" name="confirm_password" id="confirm_password" required>
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-lock"></i>
                            </span>
                        </div>
                    </div>
                    <div class="footer text-center">
                        <button type="submit" class="btn btn-primary btn-round btn-lg btn-block">RESET PASSWORD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script>
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->

<!-- Include SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
<?php if (isset($error)) { ?>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '<?php echo $error; ?>'
    });
<?php } ?>

<?php if (isset($success)) { ?>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '<?php echo $success; ?>',
        allowOutsideClick: false
    }).then(() => {
        window.location.href = 'sign-in.php';
    });
<?php } ?>
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    function maskInput(input) {
        let actualValue = ""; // Store the real value

        input.addEventListener("input", function (event) {
            let lastChar = event.data; // Get the last typed character

            if (lastChar) {
                actualValue += lastChar; // Append to actual value
            } else {
                actualValue = actualValue.slice(0, -1); // Handle backspace
            }

            this.value = "*".repeat(actualValue.length); // Show masked value
        });

        input.addEventListener("focus", function () {
            this.value = actualValue; // Show real value on focus
        });

        input.addEventListener("blur", function () {
            this.value = "*".repeat(actualValue.length); // Mask again on blur
        });

        // Ensure real values are submitted
        document.querySelector("form").addEventListener("submit", function () {
            input.value = actualValue;
        });
    }

    let passwordField = document.querySelector('input[name="password"]');
    let confirmPasswordField = document.querySelector('input[name="confirm_password"]');

    if (passwordField) maskInput(passwordField);
    if (confirmPasswordField) maskInput(confirmPasswordField);
});
</script>

</body>
</html>
