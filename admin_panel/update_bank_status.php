<?php
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['status'])) {
    $id = intval($_POST['id']);
    $status = ($_POST['status'] === "Active") ? "Active" : "Inactive";

    $query = "UPDATE customer_bank_details SET status = '$status' WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo json_encode(["status" => "success", "message" => "Status updated successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update status."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
