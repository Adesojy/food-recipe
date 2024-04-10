<?php
session_start();
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'includes/conn.php';

// Retrieve recipe ID from URL parameter
$recipe_id = $_GET['id'];

// Update the popularity of the recipe
$sql = "UPDATE recipes SET popularity = popularity + 1 WHERE recipe_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
// Check the role of the user
if ($_SESSION['role'] == 'admin') {
    $dashboard_link = 'admin_dashboard.php';
} elseif ($_SESSION['role'] == 'cook') {
    $dashboard_link = 'cook_dashboard.php';
} else {
    // Default link if role is not recognized
    $dashboard_link = 'cook_dashboard.php';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Recipe</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap Lightbox CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
    <!-- Custom CSS -->
    <style>
        /* Increase the size of the lightbox */
        .ekko-lightbox-container .modal-dialog {
            max-width: 90%;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?php echo $dashboard_link; ?>">View Recipe</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <!-- Show logout button if user is logged in -->
                    <li class="nav-item">
                        <a class="btn btn-danger ml-2" href="backend/logout.php">Logout</a>
                    </li>
                <?php } else { ?>
                    <!-- Show login and sign up buttons if user is not logged in -->
                    <li class="nav-item">
                        <a class="btn btn-primary ml-2" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-secondary ml-2" href="signup.php">Sign Up</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>

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
                            <a id="edit_recipe_file_link" href="" target="_blank">View Recipe File</a>
                            <input type="file" class="form-control-file" id="edit_recipe_file" name="edit_recipe_file">
                        </div>
                        <div class="form-group">
                            <label for="edit_recipe_image">Recipe Image:</label>
                            <img id="edit_recipe_image_preview" class="img-fluid" src="" alt="Recipe Image Preview">
                            <input type="file" class="form-control-file" id="edit_recipe_image" name="edit_recipe_image">
                        </div>
                        <div class="form-group">
                            <label for="edit_recipe_thumbnail">Recipe Thumbnail:</label>
                            <img id="edit_recipe_thumbnail_preview" class="img-fluid" src="" alt="Recipe Thumbnail Preview">
                            <input type="file" class="form-control-file" id="edit_recipe_thumbnail" name="edit_recipe_thumbnail">
                        </div>
                        <div class="form-group">
                            <label for="edit_category">Category:</label>
                            <select class="form-control" id="edit_category" name="edit_category">
                                <option value="">Select category</option>
                                <!-- Categories will be dynamically added here -->
                            </select>
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

            // Determine the file type of recipe_file
            $recipe_file_extension = pathinfo($row['recipe_file'], PATHINFO_EXTENSION);
            if (in_array($recipe_file_extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                echo "<a href='backend/uploads/{$row['recipe_file']}' data-toggle='lightbox' data-gallery='gallery' data-title='Recipe File'><img src='backend/uploads/{$row['recipe_file']}' alt='Recipe Image' class='img-thumbnail'></a>";
            } elseif (in_array($recipe_file_extension, ['mp4', 'avi', 'mov', 'wmv'])) {
                echo "<a href='backend/uploads/{$row['recipe_file']}' data-toggle='lightbox' data-gallery='gallery' data-title='Recipe Video'><video controls><source src='backend/uploads/{$row['recipe_file']}' type='video/mp4'></video></a>";
            } else {
                echo "Recipe File: <a href='{$row['recipe_file']}' target='_blank'>View File</a>";
            }

            // Display recipe_image and recipe_thumbnail as images
            echo "<a href='backend/uploads/{$row['recipe_image']}' data-toggle='lightbox' data-gallery='gallery' data-title='Recipe Image'><img src='backend/uploads/{$row['recipe_image']}' alt='Recipe Image' class='img-thumbnail'></a>";
            echo "<a href='backend/uploads/{$row['recipe_thumbnail']}' data-toggle='lightbox' data-gallery='gallery' data-title='Recipe Thumbnail'><img src='backend/uploads/{$row['recipe_thumbnail']}' alt='Recipe Thumbnail' class='img-thumbnail'></a>";

            // Add more details as needed
        } else {
            echo "Recipe not found.";
        }

        // Check if the user is logged in
        if (isset($_SESSION['user_id'])) {
            // Display edit and delete buttons
            echo '<div class="mt-3">';
            // echo '<a href="edit_recipe.php?id=' . $recipe_id . '" class="btn btn-primary mr-2">Edit Recipe</a>';
            // echo "<a class='btn btn-primary mr-2 action-btn' data-toggle='modal' data-target='#editRecipeModal' data-recipeid='" . $recipe_id . "'>Edit</a>";
            echo '<a href="backend/delete_recipe.php?id=' . $recipe_id . '" class="btn btn-danger">Delete Recipe</a>';
            echo '</div>';
        }
        ?>
    </div>
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
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap Lightbox JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
    <!-- Initialize Lightbox -->
    <script>
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    </script>
    <script>
        $(document).ready(function() {
            // Function to initialize autocomplete
            function initAutocomplete(selector) {
                $(selector).autocomplete({
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
                    appendTo: $(selector).closest('.modal-body') // Append dropdown to modal's content area
                }).autocomplete("widget").addClass("fixed-height");
            }

            // Initialize autocomplete for location fields
            initAutocomplete("#location");
            initAutocomplete("#edit_location");

            // Function to fetch categories and populate the dropdown filter
            function fetchCategories() {
                $.ajax({
                    url: 'backend/fetch_categories.php',
                    method: 'GET',
                    success: function(data) {
                        try {
                            var categories = JSON.parse(data);
                            var categorySelect = $('#category, #edit_category');

                            categorySelect.empty();
                            categorySelect.append($('<option>', {
                                value: '',
                                text: 'Select category'
                            }));

                            categories.forEach(function(category) {
                                categorySelect.append($('<option>', {
                                    value: category,
                                    text: category
                                }));
                            });
                        } catch (error) {
                            console.error('Error parsing JSON:', error);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching categories:', error);
                    }
                });
            }

            // Fetch categories on page load
            fetchCategories();

            // Function to fetch recipe details and populate the edit modal
            function populateEditModal(recipeId) {
                $.ajax({
                    url: 'backend/fetch_recipe_details.php',
                    method: 'POST',
                    data: {
                        recipe_id: recipeId
                    },
                    success: function(data) {
                        try {
                            var recipeDetails = JSON.parse(data);

                            $('#edit_recipe_id').val(recipeDetails.recipe_id);
                            $('#edit_title').val(recipeDetails.title);
                            $('#edit_description').val(recipeDetails.description);
                            $('#edit_instruction').val(recipeDetails.instruction);
                            $('#edit_category').val(recipeDetails.category);
                            $('#edit_location').val(recipeDetails.location);

                            // Set image sources
                            $('#edit_recipe_image_preview').attr('src', 'backend/uploads/' + recipeDetails.recipe_image);
                            $('#edit_recipe_thumbnail_preview').attr('src', 'backend/uploads/' + recipeDetails.recipe_thumbnail);

                            // Set file link
                            $('#edit_recipe_file_link').attr('href', 'backend/uploads/' + recipeDetails.recipe_file);

                            // Check file extension to determine if it's an image or a video
                            var fileExtension = recipeDetails.recipe_file.split('.').pop().toLowerCase();
                            if (fileExtension === 'jpg' || fileExtension === 'jpeg' || fileExtension === 'png' || fileExtension === 'gif') {
                                // It's an image
                                $('#edit_recipe_file_link').text('View Recipe Image');
                            } else if (fileExtension === 'mp4' || fileExtension === 'avi' || fileExtension === 'mov' || fileExtension === 'wmv') {
                                // It's a video
                                $('#edit_recipe_file_link').text('View Recipe Video');
                            } else {
                                // It's neither an image nor a video
                                $('#edit_recipe_file_link').text('View Recipe File');
                            }

                            // Populate other fields as needed
                        } catch (error) {
                            console.error('Error parsing JSON:', error);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching recipe details:', error);
                    }
                });
            }

            // Call the function when the edit modal is shown
            $('#editRecipeModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var recipeId = button.data('recipeid');

                populateEditModal(recipeId);
            });

            // Destroy autocomplete when modal is closed to avoid multiple initializations
            $('#addRecipeModal, #editRecipeModal').on('hidden.bs.modal', function() {
                $("#location, #edit_location").autocomplete("destroy");
            });
        });
    </script>
</body>

</html>