<?php
session_start();
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'includes/conn.php';

// Fetch counts for the number of cooks/chefs, recipes, and recipe seekers
$sql = "SELECT 
            (SELECT COUNT(*) FROM users WHERE role = 'cook') AS num_cooks,
            (SELECT COUNT(*) FROM recipes) AS num_recipes,
            (SELECT COUNT(*) FROM users WHERE role = 'recipe_seeker') AS num_recipe_seekers,
            COUNT(DISTINCT location) AS num_unique_locations
        FROM recipes";
$result = $conn->query($sql);

$num_cooks = 0;
$num_recipes = 0;
$num_recipe_seekers = 0;
$num_unique_locations = 0;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $num_cooks = $row['num_cooks'];
    $num_recipes = $row['num_recipes'];
    $num_recipe_seekers = $row['num_recipe_seekers'];
    $num_unique_locations = $row['num_unique_locations'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="admin_dashboard.php">Admin Dashboard</a>
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

    <div class="container mt-4">
        <h2>Admin Dashboard</h2>
        <!-- Statistics Boxes -->
        <div class="row mt-4">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Number of Cooks/Chefs</h5>
                        <p class="card-text"><?php echo $num_cooks; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Number of Recipes</h5>
                        <p class="card-text"><?php echo $num_recipes; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Number of Unique Locations</h5>
                        <p class="card-text"><?php echo $num_unique_locations; ?></p>
                    </div>
                </div>
            </div>

        </div>
        <!-- Recipe Display Map View -->
        <div class="mt-4">
            <h3>Recipe Map View</h3>
            <!-- Map display code goes here -->
            <div id="map" style="height: 500px;"></div>
        </div>
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

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Leaflet JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>

    <!-- Custom Script -->
    <script>
        // Initialize the map
        var map = L.map('map').setView([0, 0], 2);

        // Add a tile layer (you can choose different tile layers)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Fetch recipe data from the server
        $.ajax({
            url: 'backend/fetch_recipe_data.php', // Replace with the actual URL of your server-side script
            method: 'GET',
            success: function(data) {
                // Parse recipe data
                var recipes = JSON.parse(data);

                // Loop through each recipe
                recipes.forEach(function(recipe) {
                    // Perform geocoding for each recipe location
                    var location = encodeURIComponent(recipe.location); // Encode location for URL
                    $.ajax({
                        url: 'https://api.opencagedata.com/geocode/v1/json?q=' + location + '&key=49f423ff5ea7487a9f77b2cd810b415d',
                        method: 'GET',
                        success: function(geodata) {
                            // Extract latitude and longitude from geocoding response
                            var lat = geodata.results[0].geometry.lat;
                            var lng = geodata.results[0].geometry.lng;

                            // Create marker and add it to the map
                            L.marker([lat, lng]).addTo(map)
                                .bindPopup(recipe.title)
                                .openPopup();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error geocoding location:', error);
                        }
                    });
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching recipe data:', error);
            }
        });
    </script>

</body>

</html>