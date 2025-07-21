<?php
include('includes/db.php');

header("Content-Type: application/json");

// Capture PHP errors
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $builder_id = isset($_POST['id']) ? mysqli_real_escape_string($conn, $_POST['id']) : null;
    $builder_name = isset($_POST['builder_name']) ? mysqli_real_escape_string($conn, $_POST['builder_name']) : null;
    $year_estd = isset($_POST['year_estd']) ? mysqli_real_escape_string($conn, $_POST['year_estd']) : null;
    $ongoing_projects = isset($_POST['ongoing_projects']) ? mysqli_real_escape_string($conn, $_POST['ongoing_projects']) : null;
    $completed_projects = isset($_POST['completed_projects']) ? mysqli_real_escape_string($conn, $_POST['completed_projects']) : null;
    $phone_number = isset($_POST['phone_number']) ? mysqli_real_escape_string($conn, $_POST['phone_number']) : null;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : null;
    $username = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : null;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : null;
    $confirm_password = isset($_POST['confirm_password']) ? mysqli_real_escape_string($conn, $_POST['confirm_password']) : null;
    $website_link = isset($_POST['website_link']) ? mysqli_real_escape_string($conn, $_POST['website_link']) : null;
    $address = isset($_POST['address']) ? mysqli_real_escape_string($conn, $_POST['address']) : null;
    $description = isset($_POST['description']) ? mysqli_real_escape_string($conn, $_POST['description']) : null;

    // Ensure required fields are not empty
    if (!$builder_id || !$builder_name || !$email || !$username || !$password || !$confirm_password) {
        echo json_encode(["status" => "error", "message" => "Required fields are missing."]);
        exit();
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo json_encode(["status" => "error", "message" => "Passwords do not match."]);
        exit();
    }

    // Update Query
    $query = "UPDATE builders_table SET 
              builder_name='$builder_name', 
              year_estd='$year_estd', 
              ongoing_projects='$ongoing_projects', 
              completed_projects='$completed_projects', 
              phone_number='$phone_number', 
              email='$email', 
              username='$username', 
              password='$password', 
              confirm_password='$confirm_password',
              website_link='$website_link', 
              address='$address', 
              description='$description' 
              WHERE id='$builder_id'";

    if (mysqli_query($conn, $query)) {
        echo json_encode(["status" => "success", "message" => "Builder updated successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database update failed: " . mysqli_error($conn)]);
        error_log("MySQL Error: " . mysqli_error($conn)); // Logs error in PHP error log
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
    error_log("Invalid request method: " . $_SERVER['REQUEST_METHOD']);
}
?>
