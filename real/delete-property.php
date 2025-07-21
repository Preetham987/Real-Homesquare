<?php
include('includes/db.php');
session_start();

if (isset($_GET['id']) && isset($_SESSION['username'])) {
    $id = intval($_GET['id']);
    $username = $_SESSION['username'];

    // Verify that this project belongs to the logged-in user
    $stmt = $conn->prepare("DELETE FROM user_project_table WHERE id = ? AND username = ?");
    $stmt->bind_param("is", $id, $username);

    if ($stmt->execute()) {
        // Redirect with success flag
        header("Location: current-listings.php?deleted=1");
        exit();
    } else {
        // Redirect with failure flag
        header("Location: current-listings.php?deleted=0");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
