<?php
include('includes/db.php'); // Ensure this connects and sets $conn
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Check database connection
if (!$conn) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed.']));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $newpassword = trim($_POST['newpassword']);
    $token = trim($_POST['token']);

    // Check for empty fields
    if (empty($username) || empty($password) || empty($newpassword) || empty($token)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'All fields are required.'
        ]);
        exit();
    }

    // Check if passwords match
    if ($password !== $newpassword) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Passwords do not match.'
        ]);
        exit();
    }

    // Check token validity using correct column name
    $stmt = $conn->prepare("SELECT email FROM builders_table WHERE reset_token = ? AND reset_token_expiry > NOW()");
    $stmt->bind_param("s", $token);

    if (!$stmt->execute()) {
        error_log('Error executing token validation query: ' . $stmt->error);
        echo json_encode([
            'status' => 'error',
            'message' => 'Error verifying token.'
        ]);
        exit();
    }

    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid or expired token. Please request a new password reset.'
        ]);
        exit();
    }

    $user = $result->fetch_assoc();
    $email = $user['email'];

    // Store password as plain text (not secure — use hashing like password_hash() in production)
    $update = $conn->prepare("UPDATE builders_table SET username = ?, password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE email = ?");
    $update->bind_param("sss", $username, $password, $email);

    if (!$update->execute()) {
        error_log('Error executing update query: ' . $update->error);
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to update credentials. Please try again.'
        ]);
        exit();
    }

    echo json_encode([
        'status' => 'success',
        'message' => 'Your credentials have been updated successfully.'
    ]);
    exit();
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method.'
    ]);
    exit();
}
?>
