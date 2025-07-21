<?php
include('includes/db.php');

if (isset($_GET['id'])) {
    $service_id = intval($_GET['id']);

    // Update the is_deleted flag to restore the service
    $query = "UPDATE services_table SET is_deleted = 0 WHERE id = $service_id";
    
    if (mysqli_query($conn, $query)) {
        echo json_encode(["status" => "success", "message" => "Service restored successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to restore service"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>
