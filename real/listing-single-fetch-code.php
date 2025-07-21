<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'includes/db.php'; // Ensure db.php contains ONLY database connection

header('Content-Type: application/json');

// Get slug from URL
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

if (empty($slug)) {
    echo json_encode(["error" => "Invalid or missing slug"]);
    exit();
}

if (!$conn) {
    echo json_encode(["error" => "Database connection failed"]);
    exit();
}

// Fetch project details using slug
$query = "SELECT project_name, min_price, max_price, saleable_area_sft, property_address, property_address2, project_location, rera_id, no_of_bhk, project_area, project_size, possesion_start_date, carpet_area_sft, amenities,
contact_mobile, price, project_type, locality1, locality2, locality3, locality4, locality5, project_images, slug, banner_image, builder_name, project_overview
FROM builder_panel_projects_table 
WHERE slug = ? LIMIT 1";

$stmt = $conn->prepare($query);

if (!$stmt) {
    echo json_encode(["error" => "Query preparation failed"]);
    exit();
}

$stmt->bind_param("s", $slug);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    
    // Convert amenities string to an array
    $data['amenities'] = explode(',', $data['amenities']);
    
    echo json_encode($data);
} else {
    echo json_encode(["error" => "Project not found"]);
}

// Close database connections
$stmt->close();
$conn->close();
?>
