<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $recipe_id = $_POST['edit_recipe_id'];
    $title = $_POST['edit_title'];
    $description = $_POST['edit_description'];
    $instruction = $_POST['edit_instruction'];
    $ingredients = $_POST['edit_ingredients'];
    $category = $_POST['edit_category'];

    // Check if recipe file is uploaded
    if ($_FILES['edit_recipe_file']['size'] > 0) {
        // Handle recipe file upload
        $recipe_file = $_FILES['edit_recipe_file']['name'];
        $recipe_file_tmp = $_FILES['edit_recipe_file']['tmp_name'];
        $recipe_file_destination = 'uploads/' . $recipe_file;
        move_uploaded_file($recipe_file_tmp, $recipe_file_destination);
    } else {
        // If recipe file is not uploaded, keep the existing file
        $sql_select_file = "SELECT recipe_file FROM recipes WHERE recipe_id=?";
        $stmt_select_file = $conn->prepare($sql_select_file);
        $stmt_select_file->bind_param("i", $recipe_id);
        $stmt_select_file->execute();
        $result_select_file = $stmt_select_file->get_result();
        $row_select_file = $result_select_file->fetch_assoc();
        $recipe_file = $row_select_file['recipe_file'];
    }

    // Check if recipe image is uploaded
    if ($_FILES['edit_recipe_image']['size'] > 0) {
        // Handle recipe image upload
        $recipe_image = $_FILES['edit_recipe_image']['name'];
        $recipe_image_tmp = $_FILES['edit_recipe_image']['tmp_name'];
        $recipe_image_destination = 'uploads/' . $recipe_image;
        move_uploaded_file($recipe_image_tmp, $recipe_image_destination);
    } else {
        // If recipe image is not uploaded, keep the existing image
        $sql_select_image = "SELECT recipe_image FROM recipes WHERE recipe_id=?";
        $stmt_select_image = $conn->prepare($sql_select_image);
        $stmt_select_image->bind_param("i", $recipe_id);
        $stmt_select_image->execute();
        $result_select_image = $stmt_select_image->get_result();
        $row_select_image = $result_select_image->fetch_assoc();
        $recipe_image = $row_select_image['recipe_image'];
    }

    // Check if recipe thumbnail is uploaded
    if ($_FILES['edit_recipe_thumbnail']['size'] > 0) {
        // Handle recipe thumbnail upload
        $recipe_thumbnail = $_FILES['edit_recipe_thumbnail']['name'];
        $recipe_thumbnail_tmp = $_FILES['edit_recipe_thumbnail']['tmp_name'];
        $recipe_thumbnail_destination = 'uploads/' . $recipe_thumbnail;
        move_uploaded_file($recipe_thumbnail_tmp, $recipe_thumbnail_destination);
    } else {
        // If recipe thumbnail is not uploaded, keep the existing thumbnail
        $sql_select_thumbnail = "SELECT recipe_thumbnail FROM recipes WHERE recipe_id=?";
        $stmt_select_thumbnail = $conn->prepare($sql_select_thumbnail);
        $stmt_select_thumbnail->bind_param("i", $recipe_id);
        $stmt_select_thumbnail->execute();
        $result_select_thumbnail = $stmt_select_thumbnail->get_result();
        $row_select_thumbnail = $result_select_thumbnail->fetch_assoc();
        $recipe_thumbnail = $row_select_thumbnail['recipe_thumbnail'];
    }

    // Update recipe details in the database
    $sql = "UPDATE recipes SET title=?, description=?, instruction=?, ingredients=?, category=?, recipe_file=?, recipe_image=?, recipe_thumbnail=? WHERE recipe_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssi", $title, $description, $instruction, $ingredients, $category, $recipe_file, $recipe_image, $recipe_thumbnail, $recipe_id);

    if ($stmt->execute()) {
        // Recipe updated successfully
        header("Location: ../cook_dashboard.php");
        exit();
    } else {
        // Error occurred
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>