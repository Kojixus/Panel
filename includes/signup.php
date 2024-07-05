<?php
$servername = "localhost";
$username = "root"; //Default username for XAMPP is "root"
$password = ""; //Default password for XAMPP is an empty string
$dbname = "main";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $user_username = $_POST['username'];
    $user_email = $_POST['email'];
    $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $user_username, $user_email, $user_password);

    // Execute the statement
    if ($stmt->execute()) {
    // Signup successful, display success message
    echo "Signup successful! You can now <a href='login.php'>Login</a>.";
    } else {
    // Signup failed, display error message
    echo "Error: " . $stmt->error;
}

    //Close the statement
    $stmt->close();

}


$conn->close();
?>