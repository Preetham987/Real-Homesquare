<?php
include('includes/db.php');

if (isset($_GET['id'])) {
    $project_id = intval($_GET['id']);

    $query = "UPDATE trending_projects_table SET is_deleted = 0 WHERE id = $project_id";
    if (mysqli_query($conn, $query)) {
        echo json_encode(["status" => "success", "message" => "Project restored successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to restore project"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>
