<?php
session_start();
include('includes/db.php');

header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $builder_id = intval($_GET['id']);

    // Update query to restore the builder
    $query = "UPDATE builders_table SET is_deleted = 0 WHERE id = $builder_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo json_encode(["status" => "success", "message" => "Builder restored successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to restore builder!"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request!"]);
}
?>
