<!DOCTYPE html><html>
<head>
    <title>Signup Form</title>
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
</body>
<body>
    <div class="form-container">
        <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>
        <form action="signup.php" method="POST">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Sign Up">
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
    // Process signup (you'll need to implement this part)
    // For now, let's just redirect to login.php
    header("Location: login.php");
    exit();
}
?>