<?php
include 'conn.php';

// // Enable error reporting
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Check if the user is logged in and retrieve the user ID
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $instruction = $_POST['instruction'];
    $ingredients = $_POST['ingredients'];
    $location = $_POST['location'];
    $recipe_file = $_FILES['recipe_file']['name'];
    $recipe_image = $_FILES['recipe_image']['name'];
    $recipe_thumbnail = $_FILES['recipe_thumbnail']['name'];
    $category = $_POST['category'];

    // Move uploaded files to designated folders
    $target_dir = "uploads/";
    move_uploaded_file($_FILES["recipe_file"]["tmp_name"], $target_dir . $recipe_file);
    move_uploaded_file($_FILES["recipe_image"]["tmp_name"], $target_dir . $recipe_image);
    move_uploaded_file($_FILES["recipe_thumbnail"]["tmp_name"], $target_dir . $recipe_thumbnail);

    // Insert new recipe into database
    $sql = "INSERT INTO recipes (title, description, instruction, ingredients, location, recipe_file, recipe_image, recipe_thumbnail, user_id, category) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        // Print the error message and SQL query for debugging
        echo "Error: " . $conn->error;
        echo "SQL: " . $sql;
        exit();
    }
    // $stmt->bind_param("sssssssis", $title, $description, $instruction, $ingredients, $location, $recipe_file, $recipe_image, $recipe_thumbnail, $user_id, $category);
    // Bind parameters to the prepared statement
    $stmt->bind_param("sssssssssi", $title, $description, $instruction, $ingredients, $location, $recipe_file, $recipe_image, $recipe_thumbnail, $user_id, $category);
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        // Print the error message and SQL query for debugging
        echo "Error: " . $conn->error;
        echo "SQL: " . $sql;
        exit();
    }
    // $stmt->bind_param("sssssssi", $title, $description, $instruction, $ingredients, $location, $recipe_file, $recipe_image, $recipe_thumbnail, $user_id);
    // Bind parameters to the prepared statement
    $stmt->bind_param("sssssssssi", $title, $description, $instruction, $ingredients, $location, $recipe_file, $recipe_image, $recipe_thumbnail, $user_id, $category);
    if ($stmt->execute()) {
        // Recipe added successfully
        header("Location: ../cook_dashboard.php");
        exit();
    } else {
        // Error occurred
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
