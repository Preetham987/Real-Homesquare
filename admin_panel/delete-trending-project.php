<?php
include('includes/db.php');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id']) || !isset($data['action'])) {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
    exit;
}

$project_id = intval($data['id']);
$action = $data['action'];

if ($action == "soft_delete") {
    // Soft delete: Update is_deleted to 1
    $query = "UPDATE trending_projects_table SET is_deleted = 1 WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $project_id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["status" => "success", "message" => "Project moved to deleted list"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to delete project"]);
    }
    mysqli_stmt_close($stmt);

} elseif ($action == "hard_delete") {
    // Fetch the image path before deletion
    $query = "SELECT image_path FROM trending_projects_table WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $project_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $imagePath = $row["image_path"];

        // Delete from database
        $deleteQuery = "DELETE FROM trending_projects_table WHERE id = ?";
        $deleteStmt = mysqli_prepare($conn, $deleteQuery);
        mysqli_stmt_bind_param($deleteStmt, "i", $project_id);

        if (mysqli_stmt_execute($deleteStmt)) {
            // Delete image file if exists
            if (!empty($imagePath) && file_exists($imagePath)) {
                unlink($imagePath);
            }
            echo json_encode(["status" => "success", "message" => "Project permanently deleted"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to delete project"]);
        }
        mysqli_stmt_close($deleteStmt);
    } else {
        echo json_encode(["status" => "error", "message" => "Project not found"]);
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
