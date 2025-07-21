<?php 
include('includes/db.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json'); // Ensure JSON response

// Function to generate slug
function generateSlug($string) {
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
    return $slug;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_log("Received POST Data: " . print_r($_POST, true));

    $builder_name = $_POST['builder_name'] ?? '';
    $project_name = $_POST['project_name'] ?? '';
    $configurations = isset($_POST['configurations']) ? implode(',', $_POST['configurations']) : null;
    $project_type = $_POST['project_type'] ?? '';
    $construction_status = $_POST['construction_status'] ?? '';
    $project_location = $_POST['project_location'] ?? '';
    $no_of_units = $_POST['no_of_units'] ?? 0;
    $project_link = $_POST['project_link'] ?? '';
    $project_area = $_POST['project_area'] ?? '';
    $project_size = $_POST['project_size'] ?? '';
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

    // Handle file upload
    error_log("Received FILE Data: " . print_r($_FILES, true));
$banner_image = [];
$target_dir = "uploads/project_images/";

// Handle main banner image (720x405)
if (!empty($_FILES['banner_image']['name'])) {
    $main_image_name = basename($_FILES["banner_image"]["name"]);
    $main_image_path = $target_dir . $main_image_name;

    if (move_uploaded_file($_FILES["banner_image"]["tmp_name"], $main_image_path)) {
        error_log("Main image uploaded successfully: $main_image_path");
        $banner_image[] = $main_image_path;
    } else {
        error_log("Main image upload failed.");
    }
}

// Handle side banner images (can be multiple)
if (!empty($_FILES['side_image']['name'][0])) {
    foreach ($_FILES['side_image']['name'] as $index => $sideImageName) {
        if (!empty($sideImageName)) {
            $side_image_path = $target_dir . basename($sideImageName);
            if (move_uploaded_file($_FILES['side_image']['tmp_name'][$index], $side_image_path)) {
                error_log("Side image uploaded: $side_image_path");
                $banner_image[] = $side_image_path;
            } else {
                error_log("Side image upload failed: $sideImageName");
            }
        }
    }
}

// Convert array to comma-separated string
$banner_image_string = implode(',', $banner_image);

// Now store $banner_image_string into your database
// Example: INSERT INTO your_table (banner_image) VALUES ('$banner_image_string');


    // Generate unique slug
    $base_slug = generateSlug($project_name);
    $slug = $base_slug;
    $counter = 1;
    $check_slug_query = "SELECT COUNT(*) as count FROM builder_panel_projects_table WHERE slug = '$slug'";
    $result = mysqli_query($conn, $check_slug_query);
    $row = mysqli_fetch_assoc($result);

    while ($row['count'] > 0) {
        $slug = $base_slug . '-' . $counter;
        $counter++;
        $check_slug_query = "SELECT COUNT(*) as count FROM builder_panel_projects_table WHERE slug = '$slug'";
        $result = mysqli_query($conn, $check_slug_query);
        $row = mysqli_fetch_assoc($result);
    }

    if (empty($_POST['project_id'])) {
        // Insert New Project
        $sql = "INSERT INTO builder_panel_projects_table (
            builder_name, project_name, configurations, project_type, construction_status, 
            project_location, no_of_units, project_link, project_area, project_size, project_launch, possesion_start_date, 
            min_area_sft, max_area_sft, min_price, max_price, rera_id, contact_email, 
            contact_mobile, validity, banner_image, project_overview, slug
        ) VALUES (
            '$builder_name', '$project_name', '$configurations', '$project_type', '$construction_status', 
            '$project_location', '$no_of_units','$project_link', '$project_area','$project_size', '$project_launch', '$possesion_start_date', 
            '$min_area_sft', '$max_area_sft', '$min_price', '$max_price', '$rera_id', '$contact_email', 
            '$contact_mobile', '$validity', '$banner_image_string', '$project_overview', '$slug'
        )";

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
