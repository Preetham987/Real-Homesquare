<?php 
include('includes/db.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $email = mysqli_real_escape_string($conn, $_POST['email_id']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $update_query = "UPDATE buyers_table SET customer_name='$name', phone_number='$phone', email_id='$email', address='$address' WHERE id=$id";

    if (mysqli_query($conn, $update_query)) {
        echo json_encode(["status" => "success", "message" => "Buyer updated successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update buyer."]);
    }
}
?>
