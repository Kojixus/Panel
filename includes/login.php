<?php
$servername = "localhost";
$username = "root"; //Default username for XAMPP is "root"
$password = ""; //Default password for XAMPP is an empty string
$dbname = "main";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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

    header("Location: dashboard.html");
    exit();
} else {
    // Invalid username or password
    echo "Invalid username or password.";
}

$stmt->close();
$conn->close();
?>