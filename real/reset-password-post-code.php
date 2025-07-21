<?php
include('includes/db.php');
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_GET['token'])) {
        echo json_encode(["status" => "error", "message" => "Missing token."]);
        exit;
    }

    $token = mysqli_real_escape_string($conn, $_GET['token']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    if ($password !== $confirmPassword) {
        echo json_encode(["status" => "error", "message" => "Passwords do not match."]);
        exit;
    }

    $sql = "SELECT * FROM website_users WHERE reset_token = '$token' AND reset_token_expire > NOW()";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $update = "UPDATE website_users SET password = '$hashedPassword', reset_token = NULL, reset_token_expire = NULL WHERE reset_token = '$token'";
        if (mysqli_query($conn, $update)) {
            echo json_encode(["status" => "success", "message" => "Password reset successful."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Database error during password update."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid or expired token."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
