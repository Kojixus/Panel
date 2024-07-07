<!DOCTYPE html><html>
<head>
    <title>Login</title>
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
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>
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
$usernameInput = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
$passwordInput = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

// Prepare and bind
$stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
$stmt->bind_param("s", $usernameInput);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Verify password
if ($row && password_verify($passwordInput, $row['password'])) {
    // User is authenticated
    $_SESSION['loggedIn'] = true;
    $_SESSION['userId'] = $row['id'];
    $_SESSION['username'] = $row['username'];

    header("Location: dash.php");
    exit();
} else {
    // Invalid username or password
    $error_message = "Invalid username or password";
    header("Location: login.php?error=". urlencode($error_message));
}

$stmt->close();

$conn->close();
?>