<?php
session_start();
// Enable error reporting
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include 'includes/conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>All Recipes</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        .recipe-container {
            margin-top: 20px;
        }

        .recipe {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        .recipe-title {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .recipe-description {
            color: #555;
            margin-bottom: 10px;
        }

        .action-btn {
            margin-top: 10px;
        }

        .fixed-height {
            max-height: 200px;
            /* Adjust the max height as needed */
            overflow-y: auto;
            /* Enable vertical scrolling if needed */
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="admin_dashboard.php">All Recipes</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="btn btn-info ml-2" href="list-recipes.php">Recipes</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-danger ml-2" href="backend/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Container -->
    <div class="container">
        <h2 class="mt-4">All Recipes</h2>
        <div class="row">
            <?php
                // Fetch recipes from database and display
                $sql = "SELECT * FROM recipes ORDER BY recipe_id ASC";
                $result = $conn->query($sql);
            
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='col-md-4'>";
                        echo "<div class='card mb-4'>";
                        // Assuming you have a column named 'recipe_image' which stores the image path
                        echo "<img src='backend/uploads/" . $row["recipe_image"] . "' class='card-img-top' alt='Recipe Image'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>" . $row["title"] . "</h5>";
                        echo "<p class='card-text'>" . $row["description"] . "</p>";
                        // Assuming you have a column named 'recipe_id' which represents the primary key                    
                        echo "<a href='view_recipe.php?id={$row['recipe_id']}' class='btn btn-secondary mt-2' style='margin: 6px;'>View Recipe</a>";
                        echo "<a href='backend/delete_recipe.php?id=" . $row["recipe_id"] . "' class='btn btn-danger action-btn ml-2' style='margin: 6px;'>Delete</a>";
                        echo "</div>"; // Close card-body
                        echo "</div>"; // Close card
                        echo "</div>"; // Close col-md-4
                    }
                } else {
                    echo "No recipes found.";
                }
            ?>
        </div> <!-- Close row -->
    </div> <!-- Close container -->

    <footer class="py-3 my-4">
        <!--<ul class="nav justify-content-center border-bottom pb-3 mb-3">-->
        <!--    <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>-->
        <!--    <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>-->
        <!--    <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>-->
        <!--    <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>-->
        <!--    <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>-->
        <!--</ul>-->
        <p class="text-center text-muted">© 2024</p>
    </footer>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</body>

</html>