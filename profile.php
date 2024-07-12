<?php
session_start();
require 'connection.php';
// Initialize variables
$user_id = $_SESSION['user_id'] ?? 0; // Assume user_id is stored in session after login
$username = $email = $name = $major = $year = $role = $bio = $skills = '';

// Fetch user data from database
if ($user_id > 0) {
    $stmt = $conn->prepare("SELECT username, email, name, major, year, role, bio, skills FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $username = $row['username'];
        $email = $row['email'];
        $name = $row['name'];
        $major = $row['major'];
        $year = $row['year'];
        $role = $row['role'];
        $bio = $row['bio'];
        $skills = $row['skills'];
    }
    $stmt->close();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $major = filter_input(INPUT_POST, 'major', FILTER_SANITIZE_STRING);
    $year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_STRING);
    $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
    $bio = filter_input(INPUT_POST, 'bio', FILTER_SANITIZE_STRING);
    $skills = filter_input(INPUT_POST, 'skills', FILTER_SANITIZE_STRING);

    // Update database
    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, major = ?, year = ?, role = ?, bio = ?, skills = ? WHERE id = ?");
    $stmt->bind_param("sssssssi", $name, $email, $major, $year, $role, $bio, $skills, $user_id);

    if ($stmt->execute()) {
        $update_message = "Profile updated successfully!";
    } else {
        $update_message = "Error updating profile: " . $conn->error;
    }
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCF Formula SAE Team Member Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/profile.css">
</head>
<?php include 'header.php';?>
<body>
    <main class="main-content">
        <div class="profile-container">
            <h2>Your Profile</h2>
            <?php
            if (isset($update_message)) {
                echo "<p class='update-message'>$update_message</p>";
            }
            ?>
            <div class="profile-card">
                <div class="profile-header">
                    <img src="https://via.placeholder.com/150" alt="Profile Picture" class="profile-picture">
                    <h3><?php echo htmlspecialchars($name); ?></h3>
                    <p><?php echo htmlspecialchars($role); ?></p>
                </div>
                <div class="profile-body">
                    <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                    <p><strong>Major:</strong> <?php echo htmlspecialchars($major); ?></p>
                    <p><strong>Year:</strong> <?php echo htmlspecialchars($year); ?></p>
                    <p><strong>Bio:</strong> <?php echo htmlspecialchars($bio); ?></p>
                    <p><strong>Skills:</strong> <?php echo htmlspecialchars($skills); ?></p>
                </div>
            </div>
            <h3>Update Your Profile</h3>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="update-form">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>
                <div class="form-group">
                    <label for="major">Major:</label>
                    <input type="text" id="major" name="major" value="<?php echo htmlspecialchars($major); ?>">
                </div>
                <div class="form-group">
                    <label for="year">Year:</label>
                    <input type="text" id="year" name="year" value="<?php echo htmlspecialchars($year); ?>">
                </div>
                <div class="form-group">
                    <label for="role">Role:</label>
                    <input type="text" id="role" name="role" value="<?php echo htmlspecialchars($role); ?>">
                </div>
                <div class="form-group">
                    <label for="bio">Bio:</label>
                    <textarea id="bio" name="bio" rows="4"><?php echo htmlspecialchars($bio); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="skills">Skills (comma-separated):</label>
                    <input type="text" id="skills" name="skills" value="<?php echo htmlspecialchars($skills); ?>">
                </div>
                <button type="submit" class="submit-btn">Update Profile</button>
            </form>
        </div>
    </main>
</body>
<?php include 'footer.php';?>
</html>
