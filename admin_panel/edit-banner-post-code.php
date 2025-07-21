<?php
include('includes/db.php');

$response = ["status" => "error", "message" => "Something went wrong!"];

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $banner_id = intval($_POST["banner_id"]);
    $main_heading = mysqli_real_escape_string($conn, $_POST["main_heading"]);
    $sub_heading = mysqli_real_escape_string($conn, $_POST["sub_heading"]);

    // Handle file upload (if a new image is uploaded)
    if (!empty($_FILES["banner_image"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["banner_image"]["name"]);

        if (move_uploaded_file($_FILES["banner_image"]["tmp_name"], $target_file)) {
            $banner_image = $target_file;
            $query = "UPDATE banner_table SET main_heading='$main_heading', sub_heading='$sub_heading', banner_image='$banner_image' WHERE id=$banner_id";
        } else {
            $response["message"] = "Error uploading file.";
            echo json_encode($response);
            exit();
        }
    } else {
        $query = "UPDATE banner_table SET main_heading='$main_heading', sub_heading='$sub_heading' WHERE id=$banner_id";
    }

    // Execute query
    if (mysqli_query($conn, $query)) {
        $response = ["status" => "success", "message" => "Banner updated successfully!"];
    } else {
        $response["message"] = "Database error: " . mysqli_error($conn);
    }
}

// Send JSON response
echo json_encode($response);
?>
