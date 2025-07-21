<?php
include('includes/db.php');
header('Content-Type: application/json'); // Ensure JSON response

$response = ["status" => "error", "message" => "Something went wrong."]; // Default response

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_name = mysqli_real_escape_string($conn, $_POST['project_name']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $area_size = mysqli_real_escape_string($conn, $_POST['area_size']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    // File Upload Handling
    $target_dir = "uploads/projects/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (!empty($_FILES['project_image']['name'])) {
        $project_image = $_FILES['project_image']['name'];
        $target_file = $target_dir . basename($project_image);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ["jpg", "jpeg", "png", "gif"];

        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES['project_image']['tmp_name'], $target_file)) {
                $sql = "INSERT INTO trending_projects_table (project_name, location, area_size, price, image_path) 
                        VALUES ('$project_name', '$location', '$area_size', '$price', '$target_file')";

                if (mysqli_query($conn, $sql)) {
                    $response = ["status" => "success", "message" => "Trending project added successfully!"];
                } else {
                    $response["message"] = "Database Error: " . mysqli_error($conn);
                }
            } else {
                $response["message"] = "Error uploading the image.";
            }
        } else {
            $response["message"] = "Invalid file type. Only JPG, JPEG, PNG, and GIF allowed.";
        }
    } else {
        $response["message"] = "Please select a project image.";
    }
}

echo json_encode($response); // Return JSON response
?>
