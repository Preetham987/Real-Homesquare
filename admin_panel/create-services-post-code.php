<?php
include('includes/db.php');
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_name = mysqli_real_escape_string($conn, $_POST['service_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $service_link = mysqli_real_escape_string($conn, $_POST['service_link']);

    // Handle file upload
    if (!empty($_FILES['service_image']['name'])) {
        $target_dir = "uploads/";
        $image_name = time() . "_" . basename($_FILES["service_image"]["name"]);
        $target_file = $target_dir . $image_name;

        if (move_uploaded_file($_FILES["service_image"]["tmp_name"], $target_file)) {
            $query = "INSERT INTO services_table (service_name, description, service_image, service_link) VALUES ('$service_name', '$description', '$target_file', '$service_link')";

            if (mysqli_query($conn, $query)) {
                echo json_encode(["status" => "success", "message" => "Service created successfully!"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Database Error: " . mysqli_error($conn)]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Image upload failed."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Please upload an image."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
