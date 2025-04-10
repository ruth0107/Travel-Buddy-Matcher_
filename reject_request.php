<?php
session_start();
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['request_id'])) {
    $request_id = $_POST['request_id'];

    // Update the status of the request to rejected
    $update_query = "UPDATE connection_requests SET status = 'rejected' WHERE request_id = ?";
    $stmt_update = $conn->prepare($update_query);
    $stmt_update->bind_param("i", $request_id);
    if ($stmt_update->execute()) {
        header("Location: matches.php");
        exit;
    } else {
        echo "Error rejecting request: " . $stmt_update->error;
    }
} else {
    echo "Invalid request.";
}
?>
