<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['trip_id'])) {
    $username = $_SESSION['username'];
    $tripId = $_POST['trip_id'];

    // Delete the trip from the database
    $query = "DELETE FROM trips WHERE user_name = ? AND id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $username, $tripId);

    if ($stmt->execute()) {
        // Trip deleted successfully, redirect to profile page
        header("Location: profile.php");
        exit;
    } else {
        // Error occurred while deleting the trip
        echo "Error deleting trip.";
    }
} else {
    // If the request method is not POST or trip_id is not set
    echo "Invalid request.";
}
?>
