<!DOCTYPE html><html>
<head>
    <title>Signup Form</title>
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
</body>
<body>
    <div class="form-container">
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
    //Requirements
    require 'connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect form data
        $user_username = $_POST['username'];
        $user_email = $_POST['email'];
        $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user_username, $user_email, $user_password);
        
        // Execute the statement
        $stmt->execute();

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
?>