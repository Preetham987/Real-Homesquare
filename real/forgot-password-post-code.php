<?php
include('includes/db.php');
session_start();
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']); // email is in username column

    // Check if user with that email exists in username column
    $query = "SELECT * FROM website_users WHERE username = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 0) {
        echo json_encode(["status" => "error", "message" => "No account found with that email address."]);
        exit;
    }

    // Since email is stored in username, just use it directly
    $user = mysqli_fetch_assoc($result);
    $userEmail = $user['username']; // this is actually the email

    // Generate token and expiry time
    date_default_timezone_set('Asia/Kolkata'); // or your timezone
    $token = bin2hex(random_bytes(32));
    $expires_at = date("Y-m-d H:i:s", strtotime('+1 hour'));

    // Save token and expiry in the database
    $update = "UPDATE website_users SET reset_token = '$token', reset_token_expire = '$expires_at' WHERE username = '$userEmail'";
    if (!mysqli_query($conn, $update)) {
        echo json_encode(["status" => "error", "message" => "Error saving reset token."]);
        exit;
    }

    // Create reset link
    $reset_link = "https://rigvesoft.com/homesquare/real-estate-panels-2/real/reset-password.php?token=$token";

    // Send email
    $to = $userEmail;
    $subject = "Password Reset Request";
    $message = "Hello,\n\nClick the link below to reset your password:\n$reset_link\n\nThis link will expire in 1 hour.\n\nIf you didn’t request this, please ignore this email.\n\n– Your Website Team";
    $headers = "From: noreply@yourdomain.com";

    if (mail($to, $subject, $message, $headers)) {
        echo json_encode(["status" => "success", "message" => "Password reset link sent to your registered email."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to send email."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
