<?php 
include('includes/db.php'); 
session_start(); 

header('Content-Type: application/json'); // Ensure JSON response

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Query the agents_table instead of users table
    $sql = "SELECT * FROM agents_table WHERE username='$username'"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $agent = $result->fetch_assoc();

        if ($password == $agent['password']) {  // Assuming passwords are stored as plain text (consider hashing)
            $_SESSION['username'] = $username;

            echo json_encode(["success" => true, "redirect" => "property-add.php"]);
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
