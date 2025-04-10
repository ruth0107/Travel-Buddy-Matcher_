<?php
// Include database configuration
include 'db_config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .connection-cards .card {
            background-color: transparent;
            border: none;
            margin-bottom: 10px;
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <header class="bg-dark text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h2 class="m-0">Travel Buddy Matcher</h2>
            </div>
            <nav>
                <ul class="list-inline m-0">
                    <li class="list-inline-item"><a href="user.php" class="text-white">Home</a></li>
                    <li class="list-inline-item"><a href="discover.php" class="text-white">Discover</a></li>
                    <li class="list-inline-item"><a href="matches.php" class="text-white">Matches</a></li>
                    <li class="list-inline-item"><a href="profile.php" class="text-white">Profile</a></li>
                    <li class="list-inline-item"><a href="status.php" class="text-white">Status</a></li>
                    <li class="list-inline-item"><a href="index.html" class="text-white">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="connection-requests py-5">
        <div class="container">
            <h1 class="section-heading">Status</h1>
            <div class="connection-cards">
            <?php
// Start the session
session_start();

// Include database configuration
include 'db_config.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit;
}

// Fetch requests sent by the current user
$query = "SELECT cr.*, u.instagram ,u.whatsapp,u.discord
          FROM connection_requests cr
          JOIN users u ON cr.receiver_username = u.username
          WHERE cr.sender_username = '" . $_SESSION['username'] . "'";
$result = mysqli_query($conn, $query);

// Check if there are any requests
if ($result) {
    // Display the requests
    while ($row = mysqli_fetch_assoc($result)) {
        // Output request details
        echo '<div class="card mb-3">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">Trip Id: ' . $row['trip_id'] . '</h5>';
        echo '<p class="card-text">Receiver Name: ' . $row['receiver_username'] . '</p>';
        echo '<p class="card-text">Status: ' . $row['status'] . '</p>';

        // Display social media links if the status is accepted
        if ($row['status'] === 'accepted') {
            echo '<p class="card-text">Instgram: <a href="' . $row['instagram'] . '">' . $row['instagram'] . '</a></p>';
            echo '<p class="card-text">Whatsapp: <a href="' . $row['whatsapp'] . '">' . $row['whatsapp'] . '</a></p>';
            echo '<p class="card-text">Discord: <a href="' . $row['discord'] . '">' . $row['discord'] . '</a></p>';
        } else {
            echo '<p class="card-text">Social Media Links: N/A</p>';
        }
        
        echo '</div>';
        echo '</div>';
    }
} else {
    // Handle query error
    echo "Error executing query: " . mysqli_error($conn);
}
?>

            </div>
        </div>
    </section>

    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; 2024 Travel Buddy Matching Platform</p>
        </div>
    </footer>

    <!-- Bootstrap JS and Popper.js (required for Bootstrap dropdowns, modals, etc.) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
