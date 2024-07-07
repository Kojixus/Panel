<!DOCTYPE html><html>
<head>
    <title>Login</title>
    <meta http-equiv="Content-Security-Policy" content="default-src 'self';">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="scripts/background.js"></script>
    <link rel="icon" type="image/png" href="images/kr_favicon.png">
</head>

<body>
    <div class="taskbar">
        <ul>
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.php">Signup</a></li>
        </ul>
    </div>
    <div class="form-container">
        <form action="login.php" method="POST">
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

//Include database connection
require 'connection.php';

// Get form data
$usernameInput = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$passwordInput = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Prepare and bind
try {  
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = :username");
    if (!$stmt) {
        throw new Exception("Error prepare: ". $conn->error);
    }
    $stmt->bindParam(':username', $usernameInput);
    if (!$stmt->execute()) {
        throw new Exception("Error execute: ". $stmt->error);
    }
} catch (Exception $e) {
    //Handle the bitch ass error, log, display message, etc.
    exit("An error occurred. Please try again later.");
}

$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Verify password
if ($row && password_verify($passwordInput, $row['password'])) {
    // User is authenticated
    $_SESSION['loggedIn'] = true;
    $_SESSION['userId'] = $row['id'];
    $_SESSION['username'] = $row['username'];

    // Regenerate session ID
    session_regenerate_id(true);

    header("Location: dash.php");
    exit();
} else {
    // Invalid username or password
    $error_message = "Invalid username or password";
    header("Location: login.php");
}

$stmt->close();

$conn->close();
?>