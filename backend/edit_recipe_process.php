<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $recipe_id = $_POST['edit_recipe_id'];
    $title = $_POST['edit_title'];
    $description = $_POST['edit_description'];
    $instruction = $_POST['edit_instruction'];
    
    // Update recipe details in the database
    $sql = "UPDATE recipes SET title=?, description=?, instruction=? WHERE recipe_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $title, $description, $instruction, $recipe_id);
    if ($stmt->execute()) {
        // Recipe updated successfully
        header("Location: cook_dashboard.php");
        exit();
    } else {
        // Error occurred
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>