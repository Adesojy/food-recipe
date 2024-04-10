<?php
session_start();
// // Enable error reporting
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include 'conn.php';

// Fetch categories from the database
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

// Check if categories exist
if ($result->num_rows > 0) {
    $categories = array();
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row['category'];
    }
    echo json_encode($categories);
} else {
    echo json_encode(array()); // Return an empty array if no categories found
}
?>