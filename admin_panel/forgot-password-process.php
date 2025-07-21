<?php
session_start();
include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['status'] = 'error';
        $_SESSION['status_message'] = 'Invalid email address.';
        header("Location: forgot-password.php");
        exit();
    }

    $email = mysqli_real_escape_string($conn, $email);
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        date_default_timezone_set('Asia/Kolkata');

        // Generate token
        $token = bin2hex(random_bytes(32));
        $tokenExpiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Store token in database
        $storeToken = "UPDATE users SET reset_token='$token', reset_token_expiry='$tokenExpiry' WHERE email='$email'";
        if (mysqli_query($conn, $storeToken)) {
            // Create reset link
            $resetLink = "https://rigvesoft.com/homesquare/real-estate-panels-2/admin_panel/confirm-password.php?token=$token";

            $subject = "Password Reset Request";
            $message = "Hello,\n\nWe received a request to reset your username or password.\n\nClick the link below to reset:\n$resetLink\n\nIf you did not request this, ignore it.\n\nRegards,\nHomesquare Team";
            $headers = "From: noreply@rigvesoft.com";

            if (mail($email, $subject, $message, $headers)) {
                $_SESSION['status'] = 'success';
                $_SESSION['status_message'] = 'Password reset link has been sent to your email.';
            } else {
                $_SESSION['status'] = 'error';
                $_SESSION['status_message'] = 'Failed to send email. Try again.';
            }
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['status_message'] = 'Could not save reset token.';
        }
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['status_message'] = 'No account found with that email.';
    }

    header("Location: forgot-password.php");
    exit();
}
?>
