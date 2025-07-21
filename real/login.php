<?php
session_start();

include ('includes/db.php');

// 1. Get Form Data
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
header("Location: index.php?error=empty");
exit();
    exit();
}

// 2. Check User in DB
$stmt = $conn->prepare("SELECT * FROM website_users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {  
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        // Password Match - Set Session
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];

        header("Location: index.php");
        exit();
    } else {
header("Location: index.php?error=wrongpass");
exit();
    }
} else {
header("Location: index.php?error=nouser");
exit();
}

$stmt->close();
$conn->close();
?>
