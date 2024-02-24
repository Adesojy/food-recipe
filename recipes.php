<?php
session_start();
include 'includes/conn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch recipes from database based on user's role
$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

if ($role == "cook") {
    $sql = "SELECT * FROM recipes WHERE user_id='$user_id'";
} else {
    $sql = "SELECT * FROM recipes";
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recipes</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Recipes</h2>
        <?php if ($result->num_rows > 0): ?>
            <ul>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <li><?php echo $row['title']; ?></li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No recipes found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
