<?php
include('includes/db.php');
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $builder_name = mysqli_real_escape_string($conn, $_POST['builder_name']);
    $year_estd = mysqli_real_escape_string($conn, $_POST['year_estd']);
    $ongoing_projects = mysqli_real_escape_string($conn, $_POST['ongoing_projects']);
    $completed_projects = mysqli_real_escape_string($conn, $_POST['completed_projects']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $website_link = mysqli_real_escape_string($conn, $_POST['website_link']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo json_encode(["status" => "error", "message" => "Passwords do not match."]);
        exit;
    }

    // Handle image upload
    $builder_image = "";
    if (isset($_FILES['builder_image']) && $_FILES['builder_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/builder_images/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileTmpPath = $_FILES['builder_image']['tmp_name'];
        $fileName = basename($_FILES['builder_image']['name']);
        $fileName = time() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "_", $fileName); // sanitize
        $destPath = $uploadDir . $fileName;

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $builder_image = $fileName;
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to upload image."]);
            exit;
        }
    }

    $query = "INSERT INTO builders_table 
        (builder_name, year_estd, ongoing_projects, completed_projects, phone_number, email, username, password, website_link, address, description, builder_image) 
        VALUES 
        ('$builder_name', '$year_estd', '$ongoing_projects', '$completed_projects', '$phone_number', '$email', '$username', '$password', '$website_link', '$address', '$description', '$builder_image')";

    if (mysqli_query($conn, $query)) {
        // Send email after successful insert
        $to = $email;
        $subject = "Your Builder Account Credentials";
        $message = "Hello $builder_name,\n\nYour builder account in Homesquare has been successfully created.\n\nUsername: $username\nPassword: $password\n\nYou can now log in to your dashboard.\n\nRegards,\nTeam";
        $headers = "From: noreply@yourdomain.com";

        if (mail($to, $subject, $message, $headers)) {
            echo json_encode(["status" => "success", "message" => "Builder created and email sent successfully!"]);
        } else {
            echo json_encode(["status" => "success", "message" => "Builder created but email sending failed."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Database Error: " . mysqli_error($conn)]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
