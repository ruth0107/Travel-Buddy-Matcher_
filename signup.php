<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Travel Buddy Matcher</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        header {
            background-color: #4da6b8;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        .logo h1 {
            margin: 0;
            font-size: 24px;
        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .signup-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .signup-section h2 {
            margin-bottom: 20px;
        }

        .signup-section input[type="text"],
        .signup-section input[type="email"],
        .signup-section input[type="password"],
        .signup-section button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .signup-section button {
            background-color: #4da6b8;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .signup-section button:hover {
            background-color: #3b8593;
        }

        footer {
            background-color: #4da6b8;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <h1>Travel Buddy Matcher</h1>
        </div>
    </header>

    <main>
        <section class="signup-section">
            <h2>Sign Up</h2>
            <form id="signupForm" action="signup_process.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <button type="submit">Sign Up</button>
            </form>
            <p>Already have an account? <a href="login.php">Log in here</a>.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Travel Buddy Matching Platform</p>
    </footer>
</body>
</html>
