<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match";
        exit;
    }

    // Check if username or email already exists
    $check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        echo "Username or email already exists";
        exit;
    }

    // Insert new user into the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
    $insert_query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

    if ($conn->query($insert_query) === TRUE) {
        header("Location: login.php");
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}
?>
