<?php
include('includes/db.php');

header('Content-Type: application/json');

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM buyers_table WHERE id = $id";

    if(mysqli_query($conn, $query)) {
        echo json_encode(["status" => "success", "message" => "Buyer deleted successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to delete buyer."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
