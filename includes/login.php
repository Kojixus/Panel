<!DOCTYPE html><html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="scripts/background.js"></script>
</head>
<div class="taskbar">
    <ul>
        <li><a href="login.php">Login</a></li>
        <li><a href="signup.php">Signup</a></li>
    </ul>
</div>
</div>
<body>
    <form action="login.php" method="POST">
        <img src="images/kr.jpg" alt="Knights Racing" class="form-image">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>

<?php
//Include database connection
require 'connection.php';

// Get form data
$usernameInput = $_POST['username'];
$passwordInput = $_POST['password'];

// Prepare and bind
$stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
$stmt->bind_param("s", $usernameInput);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Verify password
if ($row && password_verify($passwordInput, $row['password'])) {
    // User is authenticated
    session_start();
    $_SESSION['loggedIn'] = true;
    $_SESSION['userId'] = $row['id'];
    $_SESSION['username'] = $row['username'];

    header("Location: <includes>dash.php");
    exit();
} else {
    // Invalid username or password
    echo "Invalid username or password.";
}

$stmt->close();
$conn->close();
?>