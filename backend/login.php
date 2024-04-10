<?php

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conn.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to fetch user data by username
    $stmt = $conn->prepare("SELECT user_id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if user exists and password is correct
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, start session and set user ID
            session_start();
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            
            // Echo the role of the user
            echo $row['role'];
            exit();
        }
    }
    // If the script reaches here, either the user does not exist or the password is incorrect
    echo 'error';
}
?>