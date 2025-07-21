<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Include your database connection
include 'includes/db.php';

try {
    // Check connection
    if (!$conn) {
        throw new Exception("Database connection failed.");
    }

    $sql = "SELECT DISTINCT project_location FROM builder_panel_projects_table WHERE project_location IS NOT NULL";
    $result = $conn->query($sql);

    $locations = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $locations[] = $row['project_location'];
        }
        echo json_encode(['success' => true, 'data' => $locations]);
    } else {
        throw new Exception("Query failed: " . $conn->error);
    }

    $conn->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
