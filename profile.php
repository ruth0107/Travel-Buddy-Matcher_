<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $profileName = $row['profile_name'];
    $profileBio = $row['profile_bio'];
    $profilePic = $row['profile_pic'];
    $profileExists = true; 
} else {
    $profileName = "";
    $profileBio = "";
    $profilePic = "";
    $profileExists = false; 
}

// Fetch user's trips
$queryTrips = "SELECT * FROM trips WHERE user_name = ?";
$stmtTrips = $conn->prepare($queryTrips);
$stmtTrips->bind_param("s", $username);
$stmtTrips->execute();
$resultTrips = $stmtTrips->get_result();

$trips = array(); // Array to store user's trips

if ($resultTrips->num_rows > 0) {
    while ($rowTrip = $resultTrips->fetch_assoc()) {
        $trips[] = $rowTrip; // Store each trip in the array
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            background-color: #fafafa;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensure full height of the viewport */
        }

        .container {
            width: 80%;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .header {
            background-color: #4da6b8;
            color: #fff;
            padding: 20px;
            text-align: right;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .logo h1 {
            margin: 0;
            text-align: left;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: right;
            align-items: center;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
            align-items: right;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        .profile_content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 50px;
        }
        .profile {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: calc(50% - 20px); /* Adjust width as needed */
    margin-right: 20px; /* Adjust space between sections */
}
    
.profile-image-container {
    width: 150px; /* Adjust size as needed */
    height: 150px; /* Adjust size as needed */
    border-radius: 50%; /* Make it circular */
    overflow: hidden; /* Hide overflow content */
    margin: 0 auto 20px; /* Center horizontally and add bottom margin */
    margin-left: 50px;
}

.profile-image-container img {
            border-radius: 50%;
            width: 160px;
            height: 160px;
            object-fit: cover;
            
}

        .profile {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: calc(50% - 20px); 
            margin-right: 20px; /* Adjust space between sections */
        }

        .profile-details {
            flex-grow: 1;
            margin: 30px;
}

.profile-details h1,
.profile-details p,
.profile-details a {
    margin-top: 0; /* Remove default margin */
}
        .add-trip {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: calc(50% - 20px); /* Adjust width as needed */
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            max-width: 100%;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px" height="24px"><path d="M7 10l5 5 5-5H7z"/><path d="M0 0h24v24H0z" fill="none"/></svg>');
            background-repeat: no-repeat;
            background-position-x: 95%;
            background-position-y: 50%;
            padding-right: 30px;
        }

        button[type="submit"] {
            background-color: #4da6b8;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            display: block;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        
        .row {
    display: flex;
    flex-wrap: wrap;
}

.col-md-4 {
    flex: 0 0 calc(33.33% - 20px); /* Adjust width of each column */
    margin-right: 20px; /* Adjust space between columns */
}

/* Add these styles to your existing CSS */

.card {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
}

.card:hover {
    transform: translateY(-5px);
}

.card-body {
    padding: 20px;
}

.card-title {
    margin-bottom: 10px;
    font-size: 18px;
    color: #4da6b8;
}

.card-text {
    margin-bottom: 5px;
}

.btn-danger {
    background-color: #e74c3c;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 8px 15px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-danger:hover {
    background-color: #c0392b;
}


.trip {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
}

.trip:hover {
    transform: translateY(-5px);
}

.trip h3 {
    margin-bottom: 10px;
    font-size: 18px;
    color: #4da6b8;
}

.trip p {
    margin-bottom: 5px;
}

.trip button[type="submit"] {
    background-color: #e74c3c;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 8px 15px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.trip button[type="submit"]:hover {
    background-color: #c0392b;
}

.col-md-4 {
    flex: 0 0 calc(50% - 20px); /* Adjust width of each column */
    margin-right: 20px; /* Adjust space between columns */
}



.footer {
    text-align: center;
    padding: 20px;
    background-color: #333;
    color: #fff;
    width: 100%;
    left: 0;
    z-index: 1000; 
    bottom: 0px;
}

    </style>
</head>
<body>
<header class="header">
    <div class="logo">
        <h1 class="logotext">Travel Buddy Matcher</h1>
    </div>
    <nav class="nav_items">
        <ul>
            <li><a href="user.php">Home</a></li>
            <li><a href="discover.php">Discover</a></li>
            <li><a href="matches.php">Matches</a></li>
            <li class="list-inline-item"><a href="status.php" class="text-white">Status</a></li>
            <li class="auth"><a href="index.html"><i class="fas fa-sign-in-alt mr-1"></i>Logout</a></li>
        </ul>
    </nav>
</header>
<section class="profile_content">
<div class="profile-image-container">
        <img src="<?php echo $profilePic; ?>" alt="Profile Picture">
    </div>
    <div class="profile-details">
        <h1>Welcome, <?php echo $profileName; ?></h1>
        <p><?php echo $profileBio; ?></p>
        <a href="edit_profile.php">Edit Profile</a>
    </div>
    <div class="add-trip">
    <h2>Add Trip</h2>
    <form action="add_trip.php" method="post">
    <label for="destination">Destination:</label><br>
    <input type="text" id="destination" name="destination" placeholder="Enter destination"><br>
    
    <label for="month">Month Traveling:</label><br>
<select id="month" name="month">
    <option value="January">January</option>
    <option value="February">February</option>
    <option value="March">March</option>
    <option value="April">April</option>
    <option value="May">May</option>
    <option value="June">June</option>
    <option value="July">July</option>
    <option value="August">August</option>
    <option value="September">September</option>
    <option value="October">October</option>
    <option value="November">November</option>
    <option value="December">December</option>
</select><br>

    
    <label for="travel_style">Travel Style:</label><br>
    <select id="travel_style" name="travel_style">
        <option value="Adventure">Adventure</option>
        <option value="Beach">Beach</option>
        <option value="Cultural">Cultural</option>
        <option value="Ecotourism">Ecotourism</option>
        <option value="Safari">Safari</option>
    </select><br>
    
    <button type="submit">Add</button>
</form>

</div>
</section>

<section>
    <div class="container">
        <h2>Your Trips</h2>
        <div class="row">
            <?php foreach ($trips as $trip): ?>
                <div class="col-md-4 mb-4" id="trips">
                    <div class="card trip">
                        <div class="card-body">
                            <h3 class="card-title">Trip ID: <?php echo $trip['id']; ?></h3>
                            <p class="card-text">Destination: <?php echo $trip['destination']; ?></p>
                            <p class="card-text">Travel Month: <?php echo $trip['travel_month']; ?></p>
                            <p class="card-text">Travel Style: <?php echo $trip['travel_style']; ?></p>
                            <form action="delete_trip.php" method="post">
                                <input type="hidden" name="trip_id" value="<?php echo $trip['id']; ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>



<footer class="footer">
    <p>&copy; 2024 Travel Buddy Matching Platform</p>
</footer>
</body>
</html>
