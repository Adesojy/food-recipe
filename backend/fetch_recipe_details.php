<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipe_id = $_POST['recipe_id'];

    $sql = "SELECT * FROM recipes WHERE recipe_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $recipe_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(array('error' => 'Recipe not found'));
    }
} else {
    echo json_encode(array('error' => 'Invalid request method'));
}
?>