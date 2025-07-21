<?php
session_start();
include("includes/db.php"); // Ensure this file correctly connects to your database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredEmail = $_POST['email'];

    if (!isset($_SESSION['username'])) {
        header("Location: forgot-password.php?error=You must be logged in to reset your password.");
        exit();
    }

    $username = $_SESSION['username'];

    // Fetch the email of the logged-in user using the username
    $stmt = $conn->prepare("SELECT email FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($storedEmail);
    $stmt->fetch();
    $stmt->close();

    if ($storedEmail && $enteredEmail === $storedEmail) {
        header("Location: new-password.php");
        exit();
    } else {
        header("Location: forgot-password.php?error=Email does not match the logged-in user.");
        exit();
    }
}
?>
