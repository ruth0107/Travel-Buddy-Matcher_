<?php

session_start();
include 'db_config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $profileName = $_POST['profile_name'] ?? ''; // Using null coalescing operator to handle optional fields
    $profileBio = $_POST['profile_bio'] ?? '';
    $instagram = $_POST['instagram'] ?? '';
    $whatsapp = $_POST['whatsapp'] ?? '';
    $discord = $_POST['discord'] ?? '';
    $username = $_SESSION['username'];

    // Validate Instagram link if provided
    if (!empty($instagram) && !filter_var($instagram, FILTER_VALIDATE_URL)) {
        echo "Invalid Instagram link";
        exit;
    }

    // Validate WhatsApp link if provided
    if (!empty($whatsapp) && !filter_var($whatsapp, FILTER_VALIDATE_URL)) {
        echo "Invalid WhatsApp link";
        exit;
    }

    // Validate Discord link if provided
    if (!empty($discord) && !filter_var($discord, FILTER_VALIDATE_URL)) {
        echo "Invalid Discord link";
        exit;
    }

    // Process profile picture upload if provided
    $targetFilepath = '';
    if (!empty($_FILES["profile_pic"]["name"])) {
        $targetDir = "uploads/";
        $targetFilepath = $targetDir . basename($_FILES["profile_pic"]["name"]);
        $fileType = strtolower(pathinfo($targetFilepath, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            exit;
        }

        $allowedFormats = array("jpg", "png", "jpeg", "gif");
        if (!in_array($fileType, $allowedFormats)) {
            echo "Only JPG, JPEG, PNG & GIF files are allowed.";
            exit;
        }

        if (!move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $targetFilepath)) {
            echo "Error uploading file: " . $_FILES["profile_pic"]["error"];
            exit;
        }
    }

    // Update the user's profile data
    $query = "UPDATE users SET profile_name=?, profile_bio=?, profile_pic=?, instagram=?, whatsapp=?, discord=? WHERE username=?";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        echo "Error preparing statement.";
        exit;
    }
    $stmt->bind_param("sssssss", $profileName, $profileBio, $targetFilepath, $instagram, $whatsapp, $discord, $username);
    if (!$stmt->execute()) {
        echo "Error executing statement: " . $stmt->error;
        exit;
    }

    // Redirect back to the profile page after successful update
    header("Location: profile.php");
    exit;
}

include 'edit_profile_form.php'; // Include the HTML form for editing profile
?>
