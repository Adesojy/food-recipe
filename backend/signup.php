<?php
include 'conn.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Check if username or email already exists
    $sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $error = "Username or email already exists.";
    } else {
        $sql = "INSERT INTO users (first_name, last_name, email, username, password, role) 
                VALUES ('$first_name', '$last_name', '$email', '$username', '$password', '$role')";
        if ($conn->query($sql) === TRUE) {
            header("Location: ../login.php");
            exit();
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>
