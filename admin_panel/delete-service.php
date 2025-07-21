<?php
include('includes/db.php');
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id']) || !isset($data['action'])) {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
    exit;
}

$service_id = intval($data['id']);
$action = $data['action'];

if ($action == "soft_delete") {
    // Soft delete: Update is_deleted to 1
    $query = "UPDATE services_table SET is_deleted = 1 WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $service_id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["status" => "success", "message" => "Service moved to deleted list"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to delete service"]);
    }
    mysqli_stmt_close($stmt);

} elseif ($action == "hard_delete") {
    // Fetch service image path
    $query = "SELECT service_image FROM services_table WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $service_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $imagePath = $row["service_image"];

        // Delete service from database
        $deleteQuery = "DELETE FROM services_table WHERE id = ?";
        $deleteStmt = mysqli_prepare($conn, $deleteQuery);
        mysqli_stmt_bind_param($deleteStmt, "i", $service_id);

        if (mysqli_stmt_execute($deleteStmt)) {
            // Delete image file if exists
            if (!empty($imagePath) && file_exists($imagePath)) {
                unlink($imagePath);
            }
            echo json_encode(["status" => "success", "message" => "Service permanently deleted"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to delete service"]);
        }
        mysqli_stmt_close($deleteStmt);
    } else {
        echo json_encode(["status" => "error", "message" => "Service not found"]);
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
