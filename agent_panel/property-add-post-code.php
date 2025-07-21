<?php 
include('includes/db.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json'); // Ensure JSON response

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assign form data to variables
    $property_type = $_POST['property_type'] ?? '';
    $size = $_POST['size'] ?? '';
    $configuration = isset($_POST['configurations']) ? $_POST['configurations'] : ''; // Fix for single value
    $price = $_POST['price'] ?? '';
    $bedrooms = $_POST['bedrooms'] ?? '';
    $car_parking = $_POST['car_parking'] ?? '';
    $year_built = $_POST['year_built'] ?? '';
    $property_address = $_POST['property_address'] ?? '';
    $dining_room = $_POST['dining_room'] ?? '';
    $kitchen = $_POST['kitchen'] ?? '';
    $living_room = $_POST['living_room'] ?? '';
    $master_bedroom = $_POST['master_bedroom'] ?? '';
    $bedroom2 = $_POST['bedroom2'] ?? '';
    $other_room = $_POST['other_room'] ?? '';
    $amenities = isset($_POST['amenities']) ? implode(',', $_POST['amenities']) : ''; // Convert array to string if multiple
    $property_address2 = $_POST['property_address2'] ?? '';
    $created_at = date("Y-m-d H:i:s");
    $updated_at = $created_at;

    // File Upload for Project Images
    $project_images = "";
    if (!empty($_FILES['project_images']['name'][0])) {
        $target_dir = "uploads/";
        $uploaded_files = [];

        foreach ($_FILES['project_images']['name'] as $key => $file_name) {
            $file_tmp = $_FILES['project_images']['tmp_name'][$key];
            $file_basename = basename($file_name);
            $target_file = $target_dir . $file_basename;

            if (move_uploaded_file($file_tmp, $target_file)) {
                $uploaded_files[] = $target_file;
            }
        }
        $project_images = implode(", ", $uploaded_files); // Store as comma-separated paths
    }

    // Insert New Project into `agent_panel_projects_table`
    $sql = "INSERT INTO agent_panel_projects_table (
        property_type, size, configuration, price, bedrooms, car_parking, year_built, 
        property_address, dining_room, kitchen, living_room, master_bedroom, 
        bedroom2, other_room, amenities, project_images, property_address2, created_at, updated_at
    ) VALUES (
        '$property_type', '$size', '$configuration', '$price', '$bedrooms', 
        '$car_parking', '$year_built', '$property_address', '$dining_room', '$kitchen', 
        '$living_room', '$master_bedroom', '$bedroom2', '$other_room', '$amenities', 
        '$project_images', '$property_address2', '$created_at', '$updated_at'
    )";

    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
        echo json_encode(["success" => true, "last_id" => $last_id]);
    } else {
        echo json_encode(["success" => false, "error" => mysqli_error($conn)]);
    }
}
?>
