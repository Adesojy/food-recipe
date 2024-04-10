<?php
include 'conn.php'; // Include your database connection file

// // Enable error reporting for debugging
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Fetch the three most popular recipes from the database
$sql = "SELECT * FROM recipes ORDER BY popularity DESC LIMIT 3"; // Assuming 'popularity' is the column storing popularity
$result = $conn->query($sql);

if ($result) {
    $popularRecipes = array();
    // Fetch the data and store it in an array
    while ($row = $result->fetch_assoc()) {
        $popularRecipes[] = $row;
    }

    // Convert the array to JSON and output it
    echo json_encode($popularRecipes);
} else {
    // If an error occurred, return an empty array
    echo json_encode(array());
}

?>