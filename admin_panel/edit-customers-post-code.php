<?php 
include('includes/db.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $email = mysqli_real_escape_string($conn, $_POST['email_id']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $customer_type = mysqli_real_escape_string($conn, $_POST['customer_type']);

    $update_query = "UPDATE customers_table SET customer_name='$name', phone_number='$phone', email_id='$email', address='$address', buyer_seller='$customer_type' WHERE id=$id";

    if (mysqli_query($conn, $update_query)) {
        echo json_encode(["status" => "success", "message" => "Customer updated successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update customer."]);
    }
}
?>
