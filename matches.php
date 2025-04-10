<?php
// Include database configuration
include 'db_config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connection Requests</title>
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
                    <li class="list-inline-item"><a href="status.php" class="text-white">Status</a></li>
                    <li class="list-inline-item"><a href="profile.php" class="text-white">Profile</a></li>
                    <li class="list-inline-item"><a href="index.html" class="text-white">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="connection-requests py-5">
        <div class="container">
            <h1 class="section-heading">Connection Requests</h1>
            <div class="connection-cards">
                <!-- Connection request cards will be dynamically generated here -->
                <?php
                session_start();
                
                $query = "SELECT cr.*, t.destination, t.travel_month, u.profile_pic 
                FROM connection_requests cr
                JOIN trips t ON cr.sender_username = t.user_name
                JOIN users u ON cr.sender_username = u.username
                WHERE cr.receiver_username = '" . $_SESSION['username'] . "'";
      
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                // Loop through each request
                while ($row = $result->fetch_assoc()) {
                    // Display each request as a card
                    echo '<div class="card mb-3">';
                    echo '<div class="d-flex align-items-center">';
                    echo '<img src="' . $row['profile_pic'] . '" class="profile-img mr-3" alt="Profile Picture">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title mb-0">' . $row['sender_username'] . ' | Destination: ' . $row['destination'] . ' | Month Travelling: ' . $row['travel_month'] . '</h5>';
                    echo '</div>';
                    echo '<div class="ml-auto">';
                    // Accept and Reject buttons with form submission
                    echo '<form action="accept_request.php" method="post">';
                    echo '<input type="hidden" name="request_id" value="' . $row['request_id'] . '">';
                    echo '<button class="btn btn-sm btn-success" type="submit">Accept</button>';
                    echo '</form>';
                    echo '<form action="reject_request.php" method="post">';
                    echo '<input type="hidden" name="request_id" value="' . $row['request_id'] . '">';
                    echo '<button class="btn btn-sm btn-danger" type="submit">Reject</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
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
