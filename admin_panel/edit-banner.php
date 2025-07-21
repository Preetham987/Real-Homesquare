<?php
include('includes/db.php');

$data = json_decode(file_get_contents('php://input'), true);

$id = intval($data['id']);
$banner = ($data['banner'] === 'Active') ? 'Active' : 'Inactive';

$query = "UPDATE builder_panel_projects_table SET banner = ? WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("si", $banner, $id);

$response = [];

if ($stmt->execute()) {
    $response['status'] = 'success';
    $response['message'] = 'Banner status updated successfully.';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Failed to update banner status.';
}

echo json_encode($response);
?>
