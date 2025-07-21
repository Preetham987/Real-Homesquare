<?php
include('includes/db.php');

header('Content-Type: application/json');

$response = [];

// Fetch trending projects
$sql = "SELECT id, property_address, price, saleable_area_sft, project_name, banner_image, slug FROM builder_panel_projects_table WHERE trending = 'Trending'";
$result = $conn->query($sql);
$response['projects'] = $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];

// Fetch builders data (Updated to include builder_image and description)
$sql = "SELECT builder_name, description, completed_projects, builder_image FROM builders_table";
$result = $conn->query($sql);
$response['builders'] = $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];

// Return JSON response
echo json_encode($response);

$conn->close();
?>
