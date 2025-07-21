<?php
include('includes/db.php');

// Enable error reporting and log errors to a file
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', 'error_log.txt');
ini_set('display_errors', 0); // Hide errors from being displayed to users

// 🚀 Clear previous output to ensure a clean JSON response
ob_start();
header('Content-Type: application/json');
$response = [];

try {
    // Log incoming POST data
    error_log("Received POST Data: " . print_r($_POST, true));

    // Check if the request is POST
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception("Invalid request method.");
    }

    // Check if project ID is provided
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        throw new Exception("Invalid Project ID.");
    }

    $project_id = mysqli_real_escape_string($conn, $_POST['id']);

    // Fetch form inputs
    $property_type = mysqli_real_escape_string($conn, $_POST['property_type']);
    $size = mysqli_real_escape_string($conn, $_POST['size']);
    $configuration = isset($_POST['configuration']) ? mysqli_real_escape_string($conn, $_POST['configuration']) : "";
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $bedrooms = mysqli_real_escape_string($conn, $_POST['bedrooms']);
    $car_parking = mysqli_real_escape_string($conn, $_POST['car_parking']);
    $year_built = isset($_POST['year_built']) && $_POST['year_built'] !== '' ? (int)$_POST['year_built'] : 2000;
    $property_address = mysqli_real_escape_string($conn, $_POST['property_address']);
    $property_address2 = mysqli_real_escape_string($conn, $_POST['property_address2']);

    $dining_room = mysqli_real_escape_string($conn, $_POST['dining_room']);
    $kitchen = mysqli_real_escape_string($conn, $_POST['kitchen']);
    $living_room = mysqli_real_escape_string($conn, $_POST['living_room']);
    $master_bedroom = mysqli_real_escape_string($conn, $_POST['master_bedroom']);
    $bedroom2 = mysqli_real_escape_string($conn, $_POST['bedroom2']);
    $other_room = mysqli_real_escape_string($conn, $_POST['other_room']);

    // Log the configuration value
    error_log("Configuration Value: " . $configuration);

    // Handle amenities (convert array to string)
    $amenities = isset($_POST['amenities']) ? implode(", ", $_POST['amenities']) : "";

    // Handle file upload for images
    $project_images = "";
    if (!empty($_FILES['project_images']['name'][0])) {
        $upload_dir = "uploads/";
        $image_paths = [];

        foreach ($_FILES['project_images']['tmp_name'] as $key => $tmp_name) {
            $file_name = basename($_FILES['project_images']['name'][$key]);
            $target_path = $upload_dir . $file_name;

            if (move_uploaded_file($tmp_name, $target_path)) {
                $image_paths[] = $target_path;
            }
        }
        $project_images = implode(",", $image_paths);
    }

    // Log before executing SQL query
    error_log("Preparing SQL Query...");

    // Update query
    $query = "UPDATE agent_panel_projects_table SET 
                property_type = '$property_type', 
                size = '$size', 
                configuration = '$configuration',
                price = '$price', 
                bedrooms = '$bedrooms',
                car_parking = '$car_parking',
                year_built = $year_built,
                property_address = '$property_address',
                property_address2 = '$property_address2',
                dining_room = '$dining_room',
                kitchen = '$kitchen',
                living_room = '$living_room',
                master_bedroom = '$master_bedroom',
                bedroom2 = '$bedroom2',
                other_room = '$other_room',
                amenities = '$amenities'";

    // Append image update only if a new image is uploaded
    if (!empty($project_images)) {
        $query .= ", project_images = '$project_images'";
    }

    $query .= " WHERE id = '$project_id'";

    // Log the final SQL query
    error_log("Executing SQL Query: " . $query);

    if (mysqli_query($conn, $query)) {
        error_log("Query executed successfully.");
        $response = ["success" => true];
    } else {
        error_log("MySQL Error: " . mysqli_error($conn));
        $response = ["success" => false, "error" => mysqli_error($conn)];
    }

} catch (Exception $e) {
    $response['success'] = false;
    $response['error'] = $e->getMessage();
    error_log("Error: " . $e->getMessage());
}

// 🚀 Ensure only JSON is outputted
ob_end_clean();
echo json_encode($response);
exit;
?>
