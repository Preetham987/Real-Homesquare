<?php
include('includes/db.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM sellers_table WHERE id = $id";
    
    if (mysqli_query($conn, $query)) {
        echo json_encode(["status" => "success", "message" => "Seller deleted successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to delete seller."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
