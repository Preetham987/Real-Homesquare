<?php
include('includes/db.php');
session_start();

if (!isset($_SESSION['username'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit();
}

$username = $_SESSION['username'];
$new_username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];  // real password from hidden field
$newpassword = $_POST['newpassword'];  // confirm password from hidden field

// Validate password match
if ($password !== $newpassword) {
    echo json_encode(["status" => "error", "message" => "Passwords do not match"]);
    exit();
}

// Update query with password field included
$query = "UPDATE builders_table SET username = ?, email = ?, password = ? WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssss", $new_username, $email, $password, $username); // Use $hashedPassword instead of $password if hashing

if ($stmt->execute()) {
    $_SESSION['username'] = $new_username; // Update session username if changed
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Update failed"]);
}

$stmt->close();
$conn->close();
?>
