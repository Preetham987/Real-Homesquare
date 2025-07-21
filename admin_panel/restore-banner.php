<?php
session_start();
include('includes/db.php');

header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $banner_id = $_GET['id'];

    $query = "UPDATE banner_table SET is_deleted = 0 WHERE id = $banner_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo json_encode(["status" => "success", "message" => "Banner restored successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to restore banner"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>
