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
            (SELECT COUNT(*) FROM users WHERE role = 'recipe_seeker') AS num_recipe_seekers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $num_cooks = $row['num_cooks'];
    $num_recipes = $row['num_recipes'];
    $num_recipe_seekers = $row['num_recipe_seekers'];
} else {
    $num_cooks = 0;
    $num_recipes = 0;
    $num_recipe_seekers = 0;
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
                        <h5 class="card-title">Number of Recipe Seekers</h5>
                        <p class="card-text"><?php echo $num_recipe_seekers; ?></p>
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
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
        </ul>
        <p class="text-center text-muted">© 2022 Company, Inc</p>
    </footer>
    