<?php
session_start();
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'includes/conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Recipe</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="cook_dashboard.php">Cook/Chef Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <!-- <button class="btn btn-success" data-toggle="modal" data-target="#addRecipeModal">Add Recipe</button> -->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addRecipeModal">Add Recipe</button>
                </li>
                <li class="nav-item">
                    <a class="btn btn-danger ml-2" href="backend/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <!-- Display Recipe Details -->
        <?php
        // Retrieve recipe details from database based on recipe ID
        $recipe_id = $_GET['id'];
        $sql = "SELECT * FROM recipes WHERE recipe_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $recipe_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<h2>{$row['title']}</h2>";
            echo "<p>{$row['description']}</p>";
            echo "<p>{$row['instruction']}</p>";
            // Add more details as needed
        } else {
            echo "Recipe not found.";
        }
        ?>
        <!-- Edit and Delete Buttons -->
        <div class="mt-3">
            <a href="edit_recipe.php?id=<?php echo $recipe_id; ?>" class="btn btn-primary mr-2">Edit Recipe</a>
            <a href="delete_recipe.php?id=<?php echo $recipe_id; ?>" class="btn btn-danger">Delete Recipe</a>
        </div>
    </div>
    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
        </ul>
        <p class="text-center text-muted">© 2022 Company, Inc</p>
    </footer>
</body>

</html>