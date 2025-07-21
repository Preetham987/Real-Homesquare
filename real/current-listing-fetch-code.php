<?php
session_start(); // Start the session to access session variables
include('includes/db.php');

// Make sure session has a username
if (!isset($_SESSION['username'])) {
    http_response_code(401); // Unauthorized
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$username = $_SESSION['username'];

// Prepare SQL to fetch only rows that match the session username
$sql = "SELECT id, Main_title, project_images, Area, Price, City, Category, Type 
        FROM user_project_table
        WHERE username = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$listings = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $listings[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($listings);

$stmt->close();
$conn->close();
?>
