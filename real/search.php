<?php
include 'includes/db.php';
header('Content-Type: application/json');

$category = isset($_POST['category']) ? $conn->real_escape_string($_POST['category']) : '';
$area_min = isset($_POST['area_min']) ? (int)$_POST['area_min'] : 0;
$area_max = isset($_POST['area_max']) ? (int)$_POST['area_max'] : 1000000;

$price_min = isset($_POST['price_min']) ? (int)$_POST['price_min'] : 0;
$price_max = isset($_POST['price_max']) ? (int)$_POST['price_max'] : 100000000;

$location = isset($_POST['location']) ? $conn->real_escape_string($_POST['location']) : '';
$bhk = isset($_POST['bhk']) ? (int)$_POST['bhk'] : 0;

$city = isset($_POST['project_location']) ? $conn->real_escape_string($_POST['project_location']) : '';

$sql = "SELECT id, builder_name, project_name, project_type, construction_status,
               project_location, property_address, property_address2, project_area,
               min_price, max_price, banner_image, no_of_bhk, slug
        FROM builder_panel_projects_table
        WHERE is_deleted = 0";

if (!empty($category)) {
    $sql .= " AND project_type = '$category'";
}

$sql .= " AND project_area BETWEEN $area_min AND $area_max";

$sql .= " AND (
            min_price BETWEEN $price_min AND $price_max
            OR
            max_price BETWEEN $price_min AND $price_max
        )";

if (!empty($location)) {
    $sql .= " AND (
        project_location LIKE '%$location%' OR
        property_address LIKE '%$location%' OR
        property_address2 LIKE '%$location%'
    )";
}

if (!empty($city)) {
    $sql .= " AND project_location = '$city'";
}

if (!empty($bhk)) {
    $sql .= " AND FIND_IN_SET('$bhk', no_of_bhk)";
}

$amenities = isset($_POST['amenities']) ? $_POST['amenities'] : [];

if (!empty($amenities)) {
    $amenityConditions = [];

    foreach ($amenities as $amenity) {
        $escapedAmenity = $conn->real_escape_string($amenity);
        // Option 1: using FIND_IN_SET for exact match (only if values are comma-separated, no extra spaces)
        // $amenityConditions[] = "FIND_IN_SET('$escapedAmenity', amenities)";

        // Option 2: using LIKE (more flexible with spacing or partials)
        $amenityConditions[] = "amenities LIKE '%$escapedAmenity%'";
    }

    $sql .= " AND (" . implode(' OR ', $amenityConditions) . ")";
}

$result = $conn->query($sql);

$projects = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }
}

echo json_encode($projects);
$conn->close();
?>
