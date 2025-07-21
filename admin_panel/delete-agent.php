<?php
include('includes/db.php');

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id']) || !isset($data['action'])) {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
    exit;
}

$agent_id = intval($data['id']);
$action = $data['action'];

if ($action === "soft_delete") {
    // Soft delete: Update is_deleted to 1
    $query = "UPDATE agents_table SET is_deleted = 1 WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $agent_id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["status" => "success", "message" => "Agent moved to deleted list"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to soft delete agent"]);
    }
    mysqli_stmt_close($stmt);
} elseif ($action === "hard_delete") {
    // Hard delete: Remove agent from database permanently
    $query = "DELETE FROM agents_table WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $agent_id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["status" => "success", "message" => "Agent permanently deleted"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to hard delete agent"]);
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
