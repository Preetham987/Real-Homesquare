<?php 
include('includes/db.php');
session_start();
$username = $_SESSION['username'] ?? 'guest';

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $property_id = $_POST['property_id'] ?? null;
    if (!$property_id) {
        echo json_encode(["success" => false, "error" => "Missing property_id"]);
        exit;
    }

    $main_title = $_POST['main_title'] ?? '';
    $category = $_POST['category'] ?? '';
    $price = $_POST['price'] ?? '';
    $keywords = $_POST['keywords'] ?? '';
    $area_type = $_POST['area_type'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $city = $_POST['city'] ?? '';
    $address_line_1 = $_POST['address_line_1'] ?? '';
    $address_line_2 = $_POST['address_line_2'] ?? '';
    $address_line_3 = $_POST['address_line_3'] ?? '';
    $locality = $_POST['locality'] ?? '';
    $range = $_POST['range'] ?? '';
    $area = $_POST['area'] ?? '';
    $bedrooms = $_POST['bedrooms'] ?? '';
    $bathrooms = $_POST['bathrooms'] ?? '';
    $parking = $_POST['parking'] ?? '';
    $age_of_property = $_POST['age_of_property'] ?? '';
    $facing_direction = $_POST['facing_direction'] ?? '';
    $security_deposit = $_POST['security_deposit'] ?? '';
    $minimum_lease_period = $_POST['minimum_lease_period'] ?? '';
    $property_details = $_POST['property_details'] ?? '';
    $Amenities = isset($_POST['Amenities']) ? implode(", ", $_POST['Amenities']) : '';

    $combinedLocality = trim($locality . ' ' . $range);

    // Retrieve existing data to preserve unchanged images
    $existing = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user_project_table WHERE id='$property_id'"));

    $project_images_paths = [];

    if (!empty($_FILES['project_images']['name'][0])) {  // Check first file exists
        $target_dir = "uploads/project_images/";
        foreach ($_FILES['project_images']['name'] as $key => $name) {
            $tmp_name = $_FILES['project_images']['tmp_name'][$key];
            $filename = basename($name);
            $target_file = $target_dir . $filename;
            
            if (move_uploaded_file($tmp_name, $target_file)) {
                $project_images_paths[] = $target_file;
            }
        }
    }
    // Save as a comma-separated string if you want
    $project_images = !empty($project_images_paths) ? implode(",", $project_images_paths) : $existing['project_images'];

    $background_images_paths = [];
    
    if (!empty($_FILES['background_images']['name'][0])) {  // Check if files exist
        $target_dir = "uploads/background_images/";
        foreach ($_FILES['background_images']['name'] as $key => $name) {
            $tmp_name = $_FILES['background_images']['tmp_name'][$key];
            $filename = basename($name);
            $target_file = $target_dir . $filename;
            
            if (move_uploaded_file($tmp_name, $target_file)) {
                $background_images_paths[] = $target_file;
            }
        }
    }
    
    $background_images = !empty($background_images_paths) ? implode(",", $background_images_paths) : $existing['background_images'];

    $plans_and_brochure_paths = [];
    
    if (!empty($_FILES['plans_and_brochure']['name'][0])) {  // Check if files exist
        $brochure_dir = "uploads/brochures/";
        foreach ($_FILES['plans_and_brochure']['name'] as $key => $name) {
            $tmp_name = $_FILES['plans_and_brochure']['tmp_name'][$key];
            $filename = basename($name);
            $target_file = $brochure_dir . $filename;
            
            if (move_uploaded_file($tmp_name, $target_file)) {
                $plans_and_brochure_paths[] = $target_file;
            }
        }
    }
    
    $plans_and_brochure = !empty($plans_and_brochure_paths) ? implode(",", $plans_and_brochure_paths) : $existing['plans_and_brochure'];

    // UPDATE query
    $sql = "UPDATE user_project_table SET 
        Main_title = '$main_title',
        Category = '$category',
        Price = '$price',
        Keywords = '$keywords',
        Area_type = '$area_type',
        Phone = '$phone',
        Email = '$email',
        City = '$city',
        Address_line_1 = '$address_line_1',
        Address_line_2 = '$address_line_2',
        Address_line_3 = '$address_line_3',
        Locality = '$combinedLocality',
        project_images = '$project_images',
        background_images = '$background_images',
        Area = '$area',
        Bedroom = '$bedrooms',
        Bathrooms = '$bathrooms',
        Parking = '$parking',
        Age_of_property = '$age_of_property',
        Facing_direction = '$facing_direction',
        Security_deposit = '$security_deposit',
        Minimum_lease_period = '$minimum_lease_period',
        Property_details = '$property_details',
        Amenities = '$Amenities',
        plans_and_brochure = '$plans_and_brochure',
        username = '$username'
    WHERE id = '$property_id'";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => mysqli_error($conn)]);
    }
}
?>
