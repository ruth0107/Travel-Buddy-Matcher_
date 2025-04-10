<?php
include 'db_config.php';
session_start();

$current_username = $_SESSION['username'];

$query = "SELECT u.username, t.id, u.profile_pic, t.destination, t.travel_style, t.travel_month 
          FROM users u 
          JOIN trips t ON u.username = t.user_name
          WHERE t.user_name != ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $current_username);
$stmt->execute();
$result = $stmt->get_result();

// Initialize an empty array to store profiles
$profiles = [];

// Check if there are any records
if (mysqli_num_rows($result) > 0) {
    // Loop through each row to fetch profiles
    while ($row = mysqli_fetch_assoc($result)) {
        // Append each profile to the $profiles array
        $profiles[] = $row;
    }
}


// Check if request_sent parameter is set in the URL
if (isset($_GET['request_sent'])) {
    // Display success message
    echo "<script>alert('Request sent successfully.')</script>";
}


mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discover Travel Buddies</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS styles */
        .featured-profiles {
            background-color: #f8f9fa;
            padding: 80px 0;
        }

        .profile {
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .profile img {
            border-radius: 50%;
            width: 120px;
            height: 120px;
            object-fit: cover;
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
            </ul>
        </nav>
    </div>
</header>

<section class="featured-profiles py-5">
    <div class="container">
        <h2 class="mb-4 text-center">Featured Profiles</h2>
        <div class="row justify-content-center">
            <!-- Display featured profiles -->
            <?php foreach ($profiles as $profile): ?>
                <div class="col-md-4 mb-4">
                    <div class="profile p-3 text-center">
                        <img src="<?php echo $profile['profile_pic']; ?>" alt="<?php echo $profile['username']; ?>" class="mb-2">
                        <h3 class="mb-2">Name: <?php echo $profile['username']; ?></h3>
                        <p class="mb-2">Trip Id: <?php echo $profile['id']; ?></p>
                        <p class="mb-2">Destination: <?php echo $profile['destination']; ?></p>
                        <p class="mb-2">Travel Month: <?php echo $profile['travel_month']; ?></p>
                        <p class="mb-2">Travel Style: <?php echo $profile['travel_style']; ?></p>
                        <form action="send_request.php" method="post">
                            <input type="hidden" name="receiver_username" value="<?php echo $profile['username']; ?>">
                            <input type="hidden" name="id" value="<?php echo $profile['id']; ?>">
                            <button class="btn btn-primary" type="submit">Send Request</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
            <!-- If no profiles found -->
            <?php if (empty($profiles)): ?>
                <div class="col-md-12 mb-4">
                    <p class="text-center">No featured profiles available.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<footer class="bg-dark text-white py-4">
    <div class="container text-center">
        <p>&copy; 2024 Travel Buddy Matching Platform</p>
    </div>
</footer>

<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
