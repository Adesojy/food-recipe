<?php
$servername = "localhost";
$username = "sojyderi_recipes";
$password = "dznvUiEl9wfk";
$dbname = "sojyderi_recipes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>