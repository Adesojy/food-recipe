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
</body>

</html>