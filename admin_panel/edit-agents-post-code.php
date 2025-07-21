<?php
include('includes/db.php');

header('Content-Type: application/json'); // Ensure JSON response

// Capture PHP errors
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $agent_id = mysqli_real_escape_string($conn, $_POST['agent_id']);
    $agent_name = mysqli_real_escape_string($conn, $_POST['agent_name']);
    $year_estd = mysqli_real_escape_string($conn, $_POST['year_estd']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $email_id = mysqli_real_escape_string($conn, $_POST['email_id']);
    $username = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : null;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : null;
    $confirm_password = isset($_POST['confirm_password']) ? mysqli_real_escape_string($conn, $_POST['confirm_password']) : null;
    $website_link = mysqli_real_escape_string($conn, $_POST['website_link']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    
        // Ensure required fields are not empty
    if (!$agent_id || !$agent_name || !$email_id || !$username || !$password || !$confirm_password) {
        echo json_encode(["status" => "error", "message" => "Required fields are missing."]);
        exit();
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo json_encode(["status" => "error", "message" => "Passwords do not match."]);
        exit();
    }

    $query = "UPDATE agents_table SET 
                agent_name = '$agent_name', 
                year_estd = '$year_estd', 
                phone_number = '$phone_number', 
                email_id = '$email_id',
                username='$username', 
                password='$password', 
                confirm_password='$confirm_password',
                website_link = '$website_link', 
                address = '$address', 
                description = '$description' 
              WHERE id = '$agent_id'";

    if (mysqli_query($conn, $query)) {
        echo json_encode(["status" => "success", "message" => "Agent details updated successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update agent details."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
