<?php
session_start();
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['receiver_username'])) {
    $sender_username = $_SESSION['username'];
    $receiver_username = $_POST['receiver_username'];
    $trip_id = $_POST['id'];

    // Check if the request already exists
    $check_query = "SELECT * FROM connection_requests WHERE sender_username = ? AND receiver_username = ?";
    $stmt_check = $conn->prepare($check_query);
    $stmt_check->bind_param("ss", $sender_username, $receiver_username);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows == 0) {
        // Insert the request into the database
        $insert_query = "INSERT INTO connection_requests (trip_id ,sender_username, receiver_username) VALUES (?,?, ?)";
        $stmt_insert = $conn->prepare($insert_query);
        $stmt_insert->bind_param("sss", $trip_id, $sender_username, $receiver_username);
        if ($stmt_insert->execute()) {
            header("Location: discover.php");
            exit;
        } else {
            echo "Error sending request: " . $stmt_insert->error;
        }
    } else {
        echo "Request already sent.";
    }
} else {
    echo "Invalid request.";
}
?>
