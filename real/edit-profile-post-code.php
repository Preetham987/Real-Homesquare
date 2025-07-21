<?php
session_start();
header('Content-Type: application/json');
include('includes/db.php'); // Assumes $conn is initialized

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    $facebook = $_POST['facebook'] ?? '';
    $instagram = $_POST['instagram'] ?? '';
    $twitter = $_POST['twitter'] ?? '';
    $youtube = $_POST['youtube'] ?? '';
    $socialLinks = implode(",", [$facebook, $instagram, $twitter, $youtube]);

    // Get existing profile image from database
    $query = "SELECT profile_image FROM website_users WHERE username=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($existingProfileImage);
    $stmt->fetch();
    $stmt->close();

    // Handle profile image upload
    $profileImageName = $existingProfileImage;
    if (!empty($_FILES['profile_image']['name'])) {
        $targetDir = "uploads/profile_image/";
        $profileImageName = basename($_FILES["profile_image"]["name"]);
        $targetFilePath = $targetDir . $profileImageName;

        if (!move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFilePath)) {
            echo json_encode(['status' => 'error', 'message' => 'Failed to upload image.']);
            exit;
        }
    }

    // Build query
    if (!empty($newPassword) && $newPassword === $confirmPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $query = "UPDATE website_users SET name=?, phone=?, address=?, profile_image=?, social_links=?, password=? WHERE username=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssss", $name, $phone, $address, $profileImageName, $socialLinks, $hashedPassword, $username);
    } else {
        $query = "UPDATE website_users SET name=?, phone=?, address=?, profile_image=?, social_links=? WHERE username=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssss", $name, $phone, $address, $profileImageName, $socialLinks, $username);
    }

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating profile.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access.']);
}
?>