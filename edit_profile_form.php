<?php
session_start();
include 'db_config.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Retrieve current user's username
$username = $_SESSION['username'];

// Fetch user's profile data from the database
$query = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
if ($stmt === false) {
    echo "Error preparing statement.";
    exit;
}
$stmt->bind_param("s", $username);
if (!$stmt->execute()) {
    echo "Error executing statement: " . $stmt->error;
    exit;
}
$result = $stmt->get_result();

// Initialize variables to store profile data
$profileName = "";
$profileBio = "";
$profilePic = "";

// Check if profile data is retrieved successfully
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $profileName = $row['profile_name'];
    $profileBio = $row['profile_bio'];
    $profilePic = $row['profile_pic']; // Retrieve previous profile picture path
}

// Check if the form is submitted and the "add" button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    // Check if a new profile picture file is uploaded
    if (!empty($_FILES["profile_pic"]["name"])) {
        // If a new file is uploaded, use the new file
        $profilePic = "uploads/"; // Change this to the path where you store the new profile picture
    }

    // Rest of your code to process form submission
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #fafafa;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px;
}

input[type="file"] {
    margin-top: 5px;
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
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

.social-label {
    margin-top: 15px;
}

.social-input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px;
}

    </style>
</head>
<body>
    <h1>Edit Profile</h1>
    <form action="edit_profile.php" method="post" enctype="multipart/form-data">
        <label for="profile_name">Profile Name:</label>
        <input type="text" id="profile_name" name="profile_name" placeholder="Enter name" value="<?php echo $profileName; ?>"><br>

        <label for="profile_bio">Profile Bio:</label><br>
        <textarea id="profile_bio" name="profile_bio" placeholder="Enter Bio"><?php echo $profileBio; ?></textarea><br>

        <label for="profile_pic">Profile Picture:</label><br>
        <input type="file" id="profile_pic" name="profile_pic" accept="image/*"><br>
        <h5>Socials</h5>
        <label for="instagram">Instagram:</label><br>
        <input type="text" id="instagram" name="instagram" placeholder="Enter Instagram link" value=""><br>

        <label for="whatsapp">WhatsApp:</label><br>
        <input type="text" id="whatsapp" name="whatsapp" placeholder="Enter WhatsApp link" value=""><br>

        <label for="discord">Discord:</label><br>
        <input type="text" id="discord" name="discord" placeholder="Enter Discord link" value=""><br>

        
        <button type="submit" name="add">Save Changes</button>
    </form>
    
</body>
</html>
