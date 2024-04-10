<?php

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include 'conn.php';

// Pagination settings
$limit = 6; // Number of recipes per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Filter settings
$location = isset($_GET['location']) ? $_GET['location'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';
$popularity = isset($_GET['popularity']) ? $_GET['popularity'] : '';

// SQL query for fetching recipes with optional filters
$sql = "SELECT * FROM recipes WHERE 1=1";
$params = [];
$types = '';

// Add filters to SQL query
if (!empty($location)) {
    $sql .= " AND location LIKE ?";
    $params[] = "%{$location}%";
    $types .= 's';
}
if (!empty($category)) {
    $sql .= " AND category = ?";
    $params[] = $category;
    $types .= 's';
}
if (!empty($popularity)) {
    if ($popularity === 'most_popular') {
        $sql .= " ORDER BY popularity DESC";
    } elseif ($popularity === 'least_popular') {
        $sql .= " ORDER BY popularity ASC";
    }
}

// SQL query for getting total number of recipes (for pagination)
$total_sql = $sql; // Copy original SQL query
$total_query = $conn->prepare("SELECT COUNT(*) AS total FROM ($total_sql) as total_query");
if (!empty($params)) {
    $total_query->bind_param($types, ...$params);
}
$total_query->execute();
$total_result = $total_query->get_result();
$total_data = $total_result->fetch_assoc();
$total_records = $total_data['total'];

// Add limit and offset to SQL query for pagination
$sql .= " LIMIT ? OFFSET ?";
$params[] = $limit;
$params[] = $offset;
$types .= 'ii';

// Prepare and execute the main SQL query
$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

// Fetch recipes as an associative array
$recipes = $result->fetch_all(MYSQLI_ASSOC);

// Encode recipes array as JSON and output
// $output = [
//     'recipes' => $recipes,
//     'total_records' => $total_records
// ];
$output = $recipes;

echo json_encode($output);

?>
