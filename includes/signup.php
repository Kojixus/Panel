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
    if ($stmt->execute()) {
    // Signup successful, display success message
        header("Location: signup.php?signup=success");
        exit();
    } else {
    // Signup failed, display error message
    echo "Error: " . $stmt->error;
}

    //Close the statement
    $stmt->close();

}


$conn->close();
?>