<?php 
include('includes/db.php'); 
session_start(); 

header('Content-Type: application/json'); // Ensure JSON response

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Query the builders_table instead of users table
    $sql = "SELECT * FROM builders_table WHERE username='$username' AND is_deleted=0"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $builder = $result->fetch_assoc();

        if ($password == $builder['password']) {  // Assuming passwords are stored as plain text (consider hashing)
            $_SESSION['username'] = $username;

            echo json_encode(["success" => true, "redirect" => "create-project.php"]);
            exit();
        } else {
            echo json_encode(["success" => false, "message" => "Invalid password."]);
            exit();
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid username."]);
        exit();
    }
}
?>