<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Check if username or email already exists
    $check_query = "SELECT * FROM users WHERE username=? OR email=?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("ss", $username, $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        // Username or email already exists
        echo 'error: Username or email already exists.';
    } else {
        // Insert new user into database
        $insert_query = "INSERT INTO users (first_name, last_name, email, username, password, role) 
                         VALUES (?, ?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("ssssss", $first_name, $last_name, $email, $username, $password, $role);
        if ($insert_stmt->execute()) {
            // Signup successful
            echo 'success';
        } else {
            // Error inserting user
            echo 'error: Unable to insert user into database.';
        }
    }
}

?>