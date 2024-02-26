<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $recipe_id = $_GET['id'];

    // Delete recipe from the database
    $sql = "DELETE FROM recipes WHERE recipe_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $recipe_id);
    if ($stmt->execute()) {
        // Recipe deleted successfully
        header("Location: cook_dashboard.php");
        exit();
    } else {
        // Error occurred
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>