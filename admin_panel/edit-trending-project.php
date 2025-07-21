<?php
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['id']); // Ensure ID is an integer
    $status = $_POST['status'];

    // Allowed ENUM values (for extra safety)
    if (!in_array($status, ['Trending', 'Not-trending'])) {
        echo "invalid_status";
        exit;
    }

    // Debugging: Check received values
    // error_log("Received ID: $id, Status: $status");

    // Update query
    $query = "UPDATE builder_panel_projects_table SET trending = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
