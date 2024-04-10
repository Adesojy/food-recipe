<?php
session_start();
include 'conn.php';

// if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
//     $recipe_id = $_GET['id'];

//     // Delete recipe from the database
//     $sql = "DELETE FROM recipes WHERE recipe_id=?";
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param("i", $recipe_id);
//     if ($stmt->execute()) {
//         // Recipe deleted successfully
//         header("Location: ../cook_dashboard.php");
//         exit();
//     } else {
//         // Error occurred
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }
// }

// Check if user is logged in and has a role
if(isset($_SESSION['role'])) {
    // Check if user is authorized to delete
    if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'cook') {
        // Check if recipe ID is provided in the request
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
            $recipe_id = $_GET['id'];

            // Delete recipe from the database
            $sql = "DELETE FROM recipes WHERE recipe_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $recipe_id);
            if ($stmt->execute()) {
                // Recipe deleted successfully
                if($_SESSION['role'] == 'admin') {
                    // If admin, redirect to admin dashboard
                    header("Location: ../admin_dashboard.php");
                } elseif($_SESSION['role'] == 'cook') {
                    // If cook, redirect to cook dashboard
                    header("Location: ../cook_dashboard.php");
                }
                exit();
            } else {
                // Error occurred
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            // Redirect to appropriate dashboard if recipe ID is not provided
            if($_SESSION['role'] == 'admin') {
                // If admin, redirect to admin dashboard
                header("Location: ../admin_dashboard.php");
            } elseif($_SESSION['role'] == 'cook') {
                // If cook, redirect to cook dashboard
                header("Location: ../cook_dashboard.php");
            }
            exit();
        }
    } else {
        // User is not authorized to delete
        echo "You are not authorized to perform this action.";
    }
} else {
    // If user is not logged in or role is not set, redirect to login page
    header("Location: ../login.php");
    exit();
}
?>