<?php
session_start();
require 'connection.php';

// Check if edit form has been submitted
if (isset($_POST['edit_profile'])) {
    // Update user data in database
    $mysql = new mysqli($serverName, $db_username, $db_password, $dbname);
    if ($mysql->connect_error) {
        die("Connection failed: ". $mysql->connect_error);
    }

    $name = $mysql->real_escape_string($_POST['name']);
    $email = $mysql->real_escape_string($_POST['email']);
    $major = $mysql->real_escape_string($_POST['major']);
    $year = $mysql->real_escape_string($_POST['year']);
    $role = $mysql->real_escape_string($_POST['role']);
    $bio = $mysql->real_escape_string($_POST['bio']);
    $skills = isset($_POST["skills"]) ? $_POST["skills"] : [];

    $query = "UPDATE users SET username = '$name', email = '$email', major = '$major', year = '$year', role = '$role', bio = '$bio', skills = '$skills' WHERE id = '".$_SESSION['user_id']."'";
    $mysql->query($query);

    if (!isset($_POST["skills"])) {
        error_log("Skills not set in form submission");
        // You might want to redirect the user or show an error message
    }
    $skills = $_POST["skills"] ?? "";
    

    // Update user data in session
    $_SESSION['user_data'] = [
        'name' => $name,
        'email' => $email,
        'major' => $major,
        'year' => $year,
        'role' => $role,
        'bio' => $bio,
        'kills' => explode(',', $skills)
    ];

    echo "Profile updated successfully!";
    header('Location: profile.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCF Formula SAE Team Member Profile</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <header class="header">
        <h1>UCF Formula SAE</h1>
        <p>Engineering the Future of Racing</p>
    </header>
    <div class="profile-container">
        <h2>Update Your Profile</h2>
        <form action="update-profile.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="major">Major:</label>
                <input type="text" id="major" name="major">
            </div>
            <div class="form-group">
                <label for="skills">Skills (comma-separated):</label>
                <input type="text" id="skills" name="skills">
            </div>
            <div class="form-group">
                <label for="bio">Bio:</label>
                <textarea id="bio" name="bio" rows="4"></textarea>
            </div>
            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>