<?php
// listing-fetch-code.php
include 'includes/db.php';
header('Content-Type: application/json');

$sql = "SELECT id, builder_name, project_name, project_type, construction_status,
               project_location, min_price, max_price, project_area,
               banner_image, no_of_bhk, slug
        FROM builder_panel_projects_table
        WHERE is_deleted = 0
        ORDER BY RAND()"; // Fetch rows in random order

$result = $conn->query($sql);
$projects = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }
}

echo json_encode($projects);
$conn->close();
?>
