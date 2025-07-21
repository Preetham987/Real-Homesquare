<?php 
include('includes/db.php'); 
session_start(); 

header('Content-Type: application/json'); // Ensure JSON response

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username'"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($password == $user['password']) { 
            if ($user['position'] === 'Admin') {
                $_SESSION['username'] = $username;
                $_SESSION['position'] = $user['position']; 

                echo json_encode(["success" => true, "redirect" => "create-project.php"]);
                exit();
            } else {
                echo json_encode(["success" => false, "message" => "You are not authorized to access the Admin panel."]);
                exit();
            }
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
