<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Seekers Landing Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        /* Add your custom CSS styles here */
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Recipe Seekers</a>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <h2>Recipes</h2>
        <!-- Filters -->
        <div class="row mb-4">
            <div class="col-md-4">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" placeholder="Enter location">
            </div>
            <div class="col-md-4">
                <label for="category">Category:</label>
                <select class="form-control" id="category">
                    <option value="">Select category</option>
                    <!-- Add options for different categories -->
                </select>
            </div>
        </div>
        <!-- Recipe Cards -->
        <div class="row" id="recipe-container">
            <!-- Recipe cards will be dynamically added here -->
        </div>
        <!-- Pagination -->
        <nav>
            <ul class="pagination justify-content-center" id="pagination">
                <!-- Pagination links will be dynamically added here -->
            </ul>
        </nav>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom Script -->
    <script>
        $(document).ready(function() {
            // Function to fetch and display recipes
            function fetchRecipes(page, location, category) {
                // Clear previous recipe cards
                $('#recipe-container').empty();
                // Send AJAX request to fetch recipes
                $.ajax({
                    url: 'backend/fetch_recipe_data.php', // Replace with the actual URL of your server-side script
                    method: 'GET',
                    data: {
                        page: page,
                        location: location,
                        category: category
                    },
                    success: function(data) {
                        // console.log('Response from server:', data); // Add this line for debugging

                        try {
                            // Attempt to parse the response as JSON
                            var recipes = JSON.parse(data);

                            // Check if parsed data is an array
                            if (Array.isArray(recipes)) {
                                // Get the container element where we will append the recipe cards
                                var recipeContainer = document.getElementById('recipe-container');

                                // Clear the existing content of the container
                                recipeContainer.innerHTML = '';

                                // Loop through each recipe
                                recipes.forEach(function(recipe) {
                                    // Create elements for recipe card
                                    var cardDiv = document.createElement('div');
                                    cardDiv.classList.add('col-md-4');

                                    var cardInnerDiv = document.createElement('div');
                                    cardInnerDiv.classList.add('card', 'mb-4');

                                    var cardImg = document.createElement('img');
                                    cardImg.classList.add('card-img-top');
                                    cardImg.src = 'backend/uploads/' + recipe.recipe_image; // Assuming recipe_image is the image path
                                    cardImg.alt = 'Recipe Image';

                                    var cardBodyDiv = document.createElement('div');
                                    cardBodyDiv.classList.add('card-body');

                                    var cardTitle = document.createElement('h5');
                                    cardTitle.classList.add('card-title');
                                    cardTitle.textContent = recipe.title;

                                    var cardText = document.createElement('p');
                                    cardText.classList.add('card-text');
                                    cardText.textContent = recipe.description;

                                    var viewRecipeBtn = document.createElement('a');
                                    viewRecipeBtn.classList.add('btn', 'btn-secondary');
                                    viewRecipeBtn.href = 'view_recipe.php?id=' + recipe.id; // Assuming recipe_id is the primary key
                                    viewRecipeBtn.textContent = 'View Recipe';

                                    // Append elements to build the card
                                    cardBodyDiv.appendChild(cardTitle);
                                    cardBodyDiv.appendChild(cardText);
                                    cardBodyDiv.appendChild(viewRecipeBtn);
                                    cardInnerDiv.appendChild(cardImg);
                                    cardInnerDiv.appendChild(cardBodyDiv);
                                    cardDiv.appendChild(cardInnerDiv);

                                    // Append the card to the recipe container
                                    recipeContainer.appendChild(cardDiv);
                                });
                            } else {
                                console.error('Response from server is not an array:', recipes);
                            }
                        } catch (error) {
                            console.error('Error parsing JSON:', error);
                        }
                    },

                    error: function(xhr, status, error) {
                        console.error('Error fetching recipes:', error);
                    }
                });
            }
            // Event listener for location input
            $('#location').on('input', function() {
                var location = $(this).val();
                var category = $('#category').val();
                fetchRecipes(1, location, category); // Fetch recipes for the first page
            });

            // Event listener for category select
            $('#category').on('change', function() {
                var location = $('#location').val();
                var category = $(this).val();
                fetchRecipes(1, location, category); // Fetch recipes for the first page
            });

            // Event listener for pagination links
            $(document).on('click', '.pagination .page-link', function(e) {
                e.preventDefault();
                var page = $(this).data('page');
                var location = $('#location').val();
                var category = $('#category').val();
                fetchRecipes(page, location, category); // Fetch recipes for the selected page
            });

            // Initial fetch recipes on page load
            fetchRecipes(1, '', '');
        });
    </script>
</body>

</html>