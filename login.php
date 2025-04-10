<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Travel Buddy Matcher</title>
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

        .login-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-section h2 {
            margin-bottom: 20px;
        }

        .login-section input[type="text"],
        .login-section input[type="password"],
        .login-section button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .login-section button {
            background-color: #4da6b8;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-section button:hover {
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
        <section class="login-section">
            <h2>Login</h2>
            <form id="loginForm" action="login_process.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <?php if (!empty($error)) : ?> <!-- Check if there is an error message -->
        <div class="alert alert-danger" role="alert"> <!-- Display error message as an alert -->
            <?php echo htmlspecialchars($error); ?> <!-- Escape HTML to prevent XSS attacks -->
        </div>
    <?php endif; ?>
                <button type="submit">Login</button>
            </form>
            <p>Don't have an account? <a href="signup.php">Sign up here</a>.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Travel Buddy Matching Platform</p>
    </footer>
</body>
</html>
