<?php
require_once 'db_config.php';

$username = $_POST['username'];
$password = $_POST['password'];

if (strlen($username) > 0 && strlen($password) > 0) {
    $select = "SELECT * FROM users WHERE username='$username'";
    $getUser = mysqli_query($conn, $select);

    if (mysqli_num_rows($getUser) == 1) {
        while ($row = mysqli_fetch_array($getUser)) {
            $encrypted = $row['password'];
            $decrypted = password_verify($password, $encrypted);

            if ($decrypted) {
                // Start session and set username in session variable
                session_start();
                $_SESSION['username'] = $username;
                header("location: user.php");
            } else {
                header("location: login.php?error=Wrong username/password");
                exit;
            }
        }
    } else {
        header("location: login.php?error=Wrong username/password");
        exit;
    }
} else {
    header("location: login.php?error=Please fill all the mandatory fields and correctly");
    exit;
}
?>