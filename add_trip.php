<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $destination = $_POST['destination'];
    $travel_month = $_POST['month'];
    $travel_style = $_POST['travel_style'];
    
    $query = "INSERT INTO trips (user_name, destination, travel_month, travel_style) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        echo "Error preparing statement.";
        exit;
    }
    $stmt->bind_param("ssss", $username, $destination, $travel_month, $travel_style);
    if (!$stmt->execute()) {
        echo "Error executing statement: " . $stmt->error;
        exit;
    }

    header("Location:profile.php");
    exit;
} else {
    header("Location: form.php");
    exit;
}
?>
