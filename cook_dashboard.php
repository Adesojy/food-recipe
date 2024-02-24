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
    <title>Cook/Chef Dashboard</title>
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
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Cook/Chef Dashboard</a>
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

    <!-- Container -->
    <div class="container">
        <h2 class="mt-4">My Recipes</h2>
        <div class="row">
            <?php
            // Fetch recipes from database and display
            $sql = "SELECT * FROM recipes WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $user_id = $_SESSION['user_id'];
            $stmt->execute();
            $result = $stmt->get_result();

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
                    echo "<a href='view_recipe.php?id={$row['recipe_id']}' class='btn btn-secondary'>View Recipe</a>";
                    echo "<button class='btn btn-primary action-btn' data-toggle='modal' data-target='#editRecipeModal' data-id='" . $row['recipe_id'] . "'>Edit</button>";
                    echo "<a href='delete_recipe.php?id=" . $row["recipe_id"] . "' class='btn btn-danger action-btn ml-2'>Delete</a>";
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


    <!-- Add Recipe Modal -->
    <div class="modal fade" id="addRecipeModal" tabindex="-1" role="dialog" aria-labelledby="addRecipeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRecipeModalLabel">Add New Recipe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add Recipe Form -->
                    <form id="addRecipeForm" action="backend/add_recipe_process.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="instruction">Instructions:</label>
                            <textarea class="form-control" id="instruction" name="instruction" rows="8" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="recipe_file">Recipe File:</label>
                            <input type="file" class="form-control-file" id="recipe_file" name="recipe_file" required>
                        </div>
                        <div class="form-group">
                            <label for="recipe_image">Recipe Image:</label>
                            <input type="file" class="form-control-file" id="recipe_image" name="recipe_image" required>
                        </div>
                        <div class="form-group">
                            <label for="recipe_image">Recipe Thumbnail:</label>
                            <input type="file" class="form-control-file" id="recipe_thumbnail" name="recipe_thumbnail" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Location:</label>
                            <input type="text" class="form-control" id="location" name="location" placeholder="Enter a location">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Recipe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Recipe Modal -->
    <div class="modal fade" id="editRecipeModal" tabindex="-1" role="dialog" aria-labelledby="editRecipeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRecipeModalLabel">Edit Recipe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Edit Recipe Form -->
                    <form id="editRecipeForm" action="backend/edit_recipe_process.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="edit_recipe_id" name="edit_recipe_id">
                        <div class="form-group">
                            <label for="edit_title">Title:</label>
                            <input type="text" class="form-control" id="edit_title" name="edit_title" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_description">Description:</label>
                            <textarea class="form-control" id="edit_description" name="edit_description" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_instruction">Instructions:</label>
                            <textarea class="form-control" id="edit_instruction" name="edit_instruction" rows="8" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_recipe_file">Recipe File:</label>
                            <input type="file" class="form-control-file" id="edit_recipe_file" name="edit_recipe_file">
                        </div>
                        <div class="form-group">
                            <label for="edit_recipe_image">Recipe Image:</label>
                            <input type="file" class="form-control-file" id="edit_recipe_image" name="edit_recipe_image">
                        </div>
                        <div class="form-group">
                            <label for="edit_recipe_thumbnail">Recipe Thumbnail:</label>
                            <input type="file" class="form-control-file" id="edit_recipe_thumbnail" name="edit_recipe_thumbnail">
                        </div>
                        <div class="form-group">
                            <label for="edit_location">Location:</label>
                            <input type="text" class="form-control" id="edit_location" name="edit_location" placeholder="Enter a location">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
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


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#location").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "https://nominatim.openstreetmap.org/search",
                        dataType: "json",
                        data: {
                            q: request.term,
                            format: "json",
                            limit: 5 // Limit number of results
                        },
                        success: function(data) {
                            response($.map(data, function(item) {
                                return {
                                    label: item.display_name,
                                    value: item.display_name
                                };
                            }));
                        }
                    });
                },
                minLength: 2 // Minimum characters before autocomplete starts
            });
        });
    </script>
    <!-- Custom Script -->
    <script>
        // Handle click on "Edit" button to open edit recipe modal
        $(document).ready(function() {
            // Initialize autocomplete when the modal is opened
            $('#addRecipeModal').on('shown.bs.modal', function() {
                $("#location").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: "https://nominatim.openstreetmap.org/search",
                            dataType: "json",
                            data: {
                                q: request.term,
                                format: "json",
                                limit: 5 // Limit number of results
                            },
                            success: function(data) {
                                response($.map(data, function(item) {
                                    return {
                                        label: item.display_name,
                                        value: item.display_name
                                    };
                                }));
                            }
                        });
                    },
                    minLength: 2, // Minimum characters before autocomplete starts
                    appendTo: "#addRecipeModal .modal-body" // Append dropdown to modal's content area
                });
            });

            // Destroy autocomplete when the modal is closed
            $('#addRecipeModal').on('hidden.bs.modal', function() {
                $("#location").autocomplete("destroy");
            });
        });
    </script>
</body>

</html>