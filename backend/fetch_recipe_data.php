<?php
// Include database connection
include 'conn.php';

// Fetch recipe data from the database
$sql = "SELECT * FROM recipes";
$result = $conn->query($sql);

// Initialize an array to store recipe data
$recipes = array();

// Check if query was successful
if ($result) {
    // Fetch associative array of recipe data
    while ($row = $result->fetch_assoc()) {
        // Add recipe data to the array
        $recipes[] = array(
            'id' => $row['recipe_id'],
            'title' => $row['title'],
            'description' => $row['description'],
            'instruction' => $row['instruction'],
            'location' => $row['location'],
            'created_at' => $row['created_at'],
            'user_id' => $row['user_id'],
            'recipe_image' => $row['recipe_image'],
            'recipe_thumbnail' => $row['recipe_thumbnail'],
            'recipe_file' => $row['recipe_file']
        );
    }

    // Convert array to JSON format and output
    echo json_encode($recipes);
} else {
    // Error occurred
    echo json_encode(array('error' => 'Error fetching recipe data'));
}

// Close database connection
$conn->close();
?>
