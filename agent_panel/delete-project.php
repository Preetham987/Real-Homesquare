<?php
include('includes/db.php');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id']) || !isset($data['action'])) {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
    exit;
}

$project_id = intval($data['id']);
$action = $data['action'];

if ($action == "soft_delete") {
    // Soft delete: Update is_deleted to 1
    $query = "UPDATE agent_panel_projects_table SET is_deleted = 1 WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $project_id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["status" => "success", "message" => "Project moved to archive"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to archive project"]);
    }
    mysqli_stmt_close($stmt);

} elseif ($action == "hard_delete") {
    // Hard delete: Remove project permanently
    $query = "DELETE FROM agent_panel_projects_table WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $project_id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["status" => "success", "message" => "Project permanently deleted"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to delete project"]);
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
