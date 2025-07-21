<?php
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $bank_name = $_POST["bank_name"];
    $branch_name = $_POST["branch_name"];
    $ifsc_code = $_POST["ifsc_code"];
    $account_number = $_POST["account_number"];
    $account_holder_name = $_POST["account_holder_name"];
    $bank_address = $_POST["bank_address"];
    $contact_number = $_POST["contact_number"];
    $email_address = $_POST["email_address"];

    // Update query
    $query = "UPDATE customer_bank_details SET 
                bank_name='$bank_name', 
                branch_name='$branch_name', 
                ifsc_code='$ifsc_code', 
                account_number='$account_number', 
                account_holder_name='$account_holder_name', 
                bank_address='$bank_address', 
                contact_number='$contact_number', 
                email_address='$email_address' 
              WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
        echo json_encode(["status" => "success", "message" => "Bank details updated successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update details."]);
    }
}
?>
