<?php
header("Content-Type: application/json"); // Set response type as JSON
include('includes/db.php'); // Include database connection

$response = []; // Initialize response array

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $main_heading = mysqli_real_escape_string($conn, $_POST['main_heading']);
    $sub_heading = isset($_POST['sub_heading']) ? mysqli_real_escape_string($conn, $_POST['sub_heading']) : NULL;

    // File Upload Handling
    $target_dir = "uploads/banners/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (!empty($_FILES['banner_image']['name'])) {
        $banner_image = $_FILES['banner_image']['name'];
        $target_file = $target_dir . basename($banner_image);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ["jpg", "jpeg", "png", "gif"];

        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES['banner_image']['tmp_name'], $target_file)) {
                // Store only the relative path in the database
                $sql = "INSERT INTO banner_table (main_heading, sub_heading, banner_image) 
                        VALUES ('$main_heading', " . ($sub_heading ? "'$sub_heading'" : "NULL") . ", '$target_file')";
                
                if (mysqli_query($conn, $sql)) {
                    $response = ["status" => "success", "message" => "Banner created successfully!"];
                } else {
                    $response = ["status" => "error", "message" => "Database error: " . mysqli_error($conn)];
                }
            } else {
                $response = ["status" => "error", "message" => "Error uploading the image."];
            }
        } else {
            $response = ["status" => "error", "message" => "Invalid file type. Only JPG, JPEG, PNG, and GIF allowed."];
        }
    } else {
        $response = ["status" => "error", "message" => "Please select a banner image."];
    }
} else {
    $response = ["status" => "error", "message" => "Invalid request method."];
}

// Return JSON response
echo json_encode($response);
?>
