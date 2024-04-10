<?php
session_start();
// // Enable error reporting
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include 'conn.php';

// Fetch unique locations from the recipes table
$sql = "SELECT DISTINCT location FROM recipes";
$result = $conn->query($sql);

// Check if there are any locations
if ($result->num_rows > 0) {
    $locations = array();
    // Store each location in an array
    while ($row = $result->fetch_assoc()) {
        $locations[] = $row['location'];
    }
    // Send the locations array as JSON response
    echo json_encode($locations);
} else {
    // Send an empty array if no locations found
    echo json_encode(array());
}

?>