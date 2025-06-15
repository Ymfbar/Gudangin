<?php
// This is a utility script to create a user with a securely hashed password.
// Run this file once from your browser (e.g., http://localhost/gudangin/create_user.php)
// IMPORTANT: Delete this file after you have created the user.

include('config/db.php');

$username = 'admin';
$password = 'password123';

// Hash the password securely
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Check if user already exists
$stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE username = ?");
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    echo "User '$username' already exists.";
} else {
    // Insert the new user
    $stmt = mysqli_prepare($conn, "INSERT INTO users (username, password) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPassword);

    if (mysqli_stmt_execute($stmt)) {
        echo "User '$username' created successfully with password '$password'.<br>";
        echo "<strong>Please delete this file now!</strong>";
    } else {
        echo "Error creating user: " . mysqli_error($conn);
    }
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>