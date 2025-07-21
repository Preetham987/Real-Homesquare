<?php
include('includes/db.php'); // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    // Get current status of the employee
    $query = "SELECT status FROM customer_bank_details WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        // Toggle status between 'Active' and 'Inactive'
        $newStatus = ($row['status'] === 'Active') ? 'Inactive' : 'Active';
        $updateQuery = "UPDATE customer_bank_details SET status = '$newStatus' WHERE id = '$id'";

        if (mysqli_query($conn, $updateQuery)) {
            echo json_encode(["status" => "success", "newStatus" => $newStatus]);
            exit();
        } else {
            echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
            exit();
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Employee not found"]);
        exit();
    }
}
?>
