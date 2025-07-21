<?php 
include('includes/db.php');

session_start();
$username = $_SESSION['username'] ?? 'guest';

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_log("Received POST Data: " . print_r($_POST, true));

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
    $minimum_lease_period = $_POST['minimum_lease_period'] ?? '';
    $property_details = $_POST['property_details'] ?? '';
    $Amenities = isset($_POST['Amenities']) ? implode(", ", $_POST['Amenities']) : '';
    
    $combinedLocality = trim($locality . ' ' . $range);

    // Handle Project_images upload
    $project_images = ''; // Initialize before use
    
    if (!empty($_FILES['project_images']['name'])) {
        $target_dir = "uploads/project_images/";
        $project_images = $target_dir . basename($_FILES["project_images"]["name"]);
        move_uploaded_file($_FILES["project_images"]["tmp_name"], $project_images);
    }

    // Handle Background_images upload
    $background_images = '';
    if (!empty($_FILES['background_images']['name'])) {
        $target_dir = "uploads/background_images/";
        $background_images = $target_dir . basename($_FILES["background_images"]["name"]);
        move_uploaded_file($_FILES["background_images"]["tmp_name"], $background_images);
    }
    
    $plans_and_brochure = "";
    if (!empty($_FILES['plans_and_brochure']['name'])) {
        $brochure_dir = "uploads/brochures/";
        $plans_and_brochure = $brochure_dir . basename($_FILES["plans_and_brochure"]["name"]);
        if (move_uploaded_file($_FILES["plans_and_brochure"]["tmp_name"], $plans_and_brochure)) {
            error_log("Plans & Brochure uploaded successfully: $plans_and_brochure");
        } else {
            error_log("Plans & Brochure upload failed.");
        }
    }

    // Insert query
    $sql = "INSERT INTO user_project_table (
        Main_title, Category, Price, Keywords, Area_type, Phone, Email, City,
        Address_line_1, Address_line_2, Address_line_3, Locality, project_images, background_images,
        Area, Bedroom, Bathrooms, Parking, Age_of_property, Facing_direction, Minimum_lease_period,
        Property_details, Amenities, plans_and_brochure, Type, username
    ) VALUES (
        '$main_title', '$category', '$price', '$keywords', '$area_type', '$phone', '$email', '$city',
        '$address_line_1', '$address_line_2', '$address_line_3', '$combinedLocality', '$project_images', '$background_images', 
        '$area', '$bedrooms', '$bathrooms', '$parking', '$age_of_property', '$facing_direction', '$minimum_lease_period',
        '$property_details', '$Amenities', '$plans_and_brochure', 'Lease', '$username'
    )";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => true]);
    } else {
        error_log("MySQL Error: " . mysqli_error($conn));
        echo json_encode(["success" => false, "error" => mysqli_error($conn)]);
    }
}
?>
