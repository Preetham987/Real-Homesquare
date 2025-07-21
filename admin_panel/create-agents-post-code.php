<?php
include('includes/db.php'); // Include database connection
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from the form
    $agent_name = mysqli_real_escape_string($conn, $_POST['agent_name']);
    $year_estd = mysqli_real_escape_string($conn, $_POST['year_estd']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $email_id = mysqli_real_escape_string($conn, $_POST['email_id']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $website_link = mysqli_real_escape_string($conn, $_POST['website_link']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    if ($password !== $confirm_password) {
        echo json_encode(["status" => "error", "message" => "Passwords do not match."]);
        exit;
    }

    // Insert into database
    $sql = "INSERT INTO agents_table (agent_name, year_estd, phone_number, email_id, username, password, confirm_password, website_link, address, description) 
            VALUES ('$agent_name', '$year_estd', '$phone_number', '$email_id', '$username', '$password', '$confirm_password', '$website_link', '$address', '$description')";

    if (mysqli_query($conn, $sql)) {
        // Send email after successful insert
        $to = $email_id;
        $subject = "Your Agent Account Credentials";
        $message = "Hello $agent_name,\n\nYour agent account in HomeSquare has been successfully created.\n\nUsername: $username\nPassword: $password\n\nYou can now log in to your dashboard.\n\nRegards,\nTeam";
        $headers = "From: noreply@yourdomain.com";

        if (mail($to, $subject, $message, $headers)) {
            echo json_encode(["status" => "success", "message" => "Agent created and email sent successfully!"]);
        } else {
            echo json_encode(["status" => "success", "message" => "Agent created but email sending failed."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Something went wrong. Please try again."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}

// Close connection
mysqli_close($conn);
?>
