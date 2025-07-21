<?php
include('includes/db.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure ID is an integer for security

    // Delete the employee
    $query = "DELETE FROM employee_table WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["status" => "success", "message" => "Employee deleted successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to delete employee."]);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
