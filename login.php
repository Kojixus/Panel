<!DOCTYPE html><html>
<head>
    <title>Login</title>
    <meta http-equiv="Content-Security-Policy" content="default-src 'self';">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="icon" type="img/png" href="imgs/kr_favicon.png">
</head>

<body>
    <div class="taskbar">
        <ul>
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.php">Signup</a></li>
        </ul>
    </div>
    <div class="form-container">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>

<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: dash.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process login (you'll need to implement this part)
    // For now, let's just redirect to dash.php
    $_SESSION['user_id'] = 1; // This should be the actual user ID from your database
    $_SESSION['user_name'] = "Test User"; // This should be the actual username from your database
    header("Location: dash.php");
    exit();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);


?>