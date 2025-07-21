<?php
session_start();
include('includes/db.php');

header('Content-Type: application/json');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit;
}

if (!isset($_SESSION['username'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Username session missing.']);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$project = isset($data['project']) ? $data['project'] : '';

$username = $_SESSION['username'];

// Fetch user details
$stmt = $conn->prepare("SELECT name, username AS email, phone, address FROM website_users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['status' => 'error', 'message' => 'User not found.']);
    exit;
}

$user = $result->fetch_assoc();

// Check if user already enquired about this project
$check = $conn->prepare("SELECT id FROM leads WHERE email = ? AND project = ?");
$check->bind_param("ss", $user['email'], $project);
$check->execute();
$checkResult = $check->get_result();

if ($checkResult->num_rows > 0) {
    echo json_encode(['status' => 'error', 'message' => 'You have already contacted for this project.']);
    exit;
}

// Insert into leads table
$insert = $conn->prepare("INSERT INTO leads (name, email, phone, address, project, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
$insert->bind_param("sssss", $user['name'], $user['email'], $user['phone'], $user['address'], $project);

if ($insert->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Lead submitted successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error submitting lead']);
}
?>
