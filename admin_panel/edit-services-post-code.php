<?php
include('includes/db.php');
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_id = mysqli_real_escape_string($conn, $_POST['service_id']);
    $service_name = mysqli_real_escape_string($conn, $_POST['service_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $service_link = mysqli_real_escape_string($conn, $_POST['service_link']);

    $query = "UPDATE services_table SET service_name='$service_name', description='$description', service_link='$service_link'";

    // Handle file upload
    if (!empty($_FILES['service_image']['name'])) {
        $target_dir = "uploads/";
        $image_name = time() . "_" . basename($_FILES["service_image"]["name"]);
        $target_file = $target_dir . $image_name;

        if (move_uploaded_file($_FILES["service_image"]["tmp_name"], $target_file)) {
            $query .= ", service_image='$target_file'";
        } else {
            echo json_encode(["status" => "error", "message" => "Image upload failed."]);
            exit();
        }
    }

    $query .= " WHERE id=$service_id";

    if (mysqli_query($conn, $query)) {
        echo json_encode(["status" => "success", "message" => "Service updated successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database Error: " . mysqli_error($conn)]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
