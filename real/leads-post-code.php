<?php
header('Content-Type: application/json');

include 'includes/db.php'; // Ensure db.php contains ONLY database connection

// Get and sanitize form data
$name  = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : '';
$phone = isset($_POST['phone']) ? $conn->real_escape_string($_POST['phone']) : '';
$date  = isset($_POST['datepicker-here']) ? $conn->real_escape_string($_POST['datepicker-here']) : '';
$time  = isset($_POST['time']) ? $conn->real_escape_string($_POST['time']) : '';

$date = date("Y-m-d", strtotime($date));

// Insert into database
$sql = "INSERT INTO leads (name, phone, date, time) VALUES ('$name', '$phone', '$date', '$time')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $conn->error]);
}

$conn->close();
?>
