<?php
include('includes/db.php');

header('Content-Type: application/json');

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM customers_table WHERE id = $id";

    if(mysqli_query($conn, $query)) {
        echo json_encode(["status" => "success", "message" => "Customer deleted successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to delete customer."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
