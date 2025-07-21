<?php
session_start();
include('includes/db.php');

header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $project_id = intval($_GET['id']);

    $query = "UPDATE agent_panel_projects_table SET is_deleted = 0 WHERE id = $project_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo json_encode(["status" => "success", "message" => "Project restored successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to restore project"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>
