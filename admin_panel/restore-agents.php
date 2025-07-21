<?php
session_start();
include('includes/db.php');

header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $agent_id = intval($_GET['id']);

    $query = "UPDATE agents_table SET is_deleted = 0 WHERE id = $agent_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo json_encode(["status" => "success", "message" => "Agent restored successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to restore agent"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>
