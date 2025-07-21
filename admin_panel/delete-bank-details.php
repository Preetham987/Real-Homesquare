<?php
include('includes/db.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure ID is an integer for security

    // Fetch bank details to delete associated files
    $query = "SELECT bank_logo, uploaded_file FROM bank_details_table WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $bankLogo = $row['bank_logo'];
        $uploadedFile = $row['uploaded_file'];

        // Delete bank logo if it exists
        if (!empty($bankLogo) && file_exists($bankLogo)) {
            unlink($bankLogo);
        }

        // Delete uploaded document if it exists
        if (!empty($uploadedFile) && file_exists($uploadedFile)) {
            unlink($uploadedFile);
        }

        // Now delete the record from the database
        $deleteQuery = "DELETE FROM bank_details_table WHERE id = ?";
        $deleteStmt = mysqli_prepare($conn, $deleteQuery);
        mysqli_stmt_bind_param($deleteStmt, "i", $id);

        if (mysqli_stmt_execute($deleteStmt)) {
            echo json_encode(["status" => "success", "message" => "Bank details deleted successfully!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to delete bank details."]);
        }

        mysqli_stmt_close($deleteStmt);
    } else {
        echo json_encode(["status" => "error", "message" => "Bank record not found."]);
    }

    mysqli_stmt_close($stmt);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}

mysqli_close($conn);
?>
