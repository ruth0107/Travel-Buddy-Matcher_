<?php
session_start();
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['request_id'])) {
    $request_id = $_POST['request_id'];

    // Update the status of the request to accepted
    $update_query = "UPDATE connection_requests SET status = 'accepted' WHERE request_id = ?";
    $stmt_update = $conn->prepare($update_query);
    $stmt_update->bind_param("i", $request_id);
    if ($stmt_update->execute()) {
        header("Location: matches.php");
        exit;
    } else {
        echo "Error accepting request: " . $stmt_update->error;
    }
} else {
    echo "Invalid request.";
}
?>
