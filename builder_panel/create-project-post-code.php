<?php 
include('includes/db.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json'); // Ensure JSON response

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debugging: Check if the POST data is received
    error_log("Received POST Data: " . print_r($_POST, true));

    // Assign form data to variables
    $builder_name = $_POST['builder_name'] ?? '';
    $project_name = $_POST['project_name'] ?? '';
    $configurations = isset($_POST['configurations']) ? implode(',', $_POST['configurations']) : null; // Convert array to comma-separated string
    $project_type = $_POST['project_type'] ?? '';
    $construction_status = $_POST['construction_status'] ?? '';
    $project_location = $_POST['project_location'] ?? '';
    $no_of_units = $_POST['no_of_units'] ?? 0;
    $project_link = isset($_POST['project_link']) ? $_POST['project_link'] : '';
    $project_area = $_POST['project_area'] ?? '';
    $project_size = isset($_POST['project_size']) ? $_POST['project_size'] : '';
    $project_launch = $_POST['project_launch'] ?? null;
    $possesion_start_date = $_POST['possesion_start_date'] ?? null;
    $min_area_sft = $_POST['min_area_sft'] ?? 0;
    $max_area_sft = $_POST['max_area_sft'] ?? 0;
    $min_price = $_POST['min_price'] ?? 0.00;
    $max_price = $_POST['max_price'] ?? 0.00;
    $rera_id = $_POST['rera_id'] ?? '';
    $contact_email = $_POST['contact_email'] ?? '';
    $contact_mobile = $_POST['contact_mobile'] ?? '';
    $validity = $_POST['validity'] ?? '';
    $project_overview = $_POST['project_overview'] ?? '';

    // Debugging: Check file upload
    error_log("Received FILE Data: " . print_r($_FILES, true));

    // File Upload for Banner Image
    $banner_image = "";
    if (!empty($_FILES['banner_image']['name'])) {
        $target_dir = "uploads/project_images/";
        $banner_image = $target_dir . basename($_FILES["banner_image"]["name"]);
        if (move_uploaded_file($_FILES["banner_image"]["tmp_name"], $banner_image)) {
            error_log("File uploaded successfully: $banner_image");
        } else {
            error_log("File upload failed.");
        }
    }

    if (empty($_POST['project_id'])) {
        // Insert New Project
        $sql = "INSERT INTO builder_panel_projects_table (
            builder_name, project_name, configurations, project_type, construction_status, 
            project_location, no_of_units, project_link, project_area, project_size, project_launch, possesion_start_date, 
            min_area_sft, max_area_sft, min_price, max_price, rera_id, contact_email, 
            contact_mobile, validity, banner_image, project_overview
        ) VALUES (
            '$builder_name', '$project_name', '$configurations', '$project_type', '$construction_status', 
            '$project_location', '$no_of_units','$project_link', '$project_area','$project_size', '$project_launch', '$possesion_start_date', 
            '$min_area_sft', '$max_area_sft', '$min_price', '$max_price', '$rera_id', '$contact_email', 
            '$contact_mobile', '$validity', '$banner_image', '$project_overview'
        )";

        // Execute Insert Query
        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            error_log("Inserted Project ID: " . $last_id);
            echo json_encode(["success" => true, "last_id" => $last_id]);
        } else {
            error_log("MySQL Error: " . mysqli_error($conn));
            echo json_encode(["success" => false, "error" => mysqli_error($conn)]);
        }
    }
}
?>
