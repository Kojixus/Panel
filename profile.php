<?php
session_start();
require_once 'connection.php';
// Initialize variables
$conn = new mysqli($serverName, $db_username, $db_password, $dbname);
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

//Define a list of skills

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $name = filter_input(INPUT_POST, 'name', FILTER_UNSAFE_RAW);
    $name = strip_tags($name);
    
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    
    $major = filter_input(INPUT_POST, 'major', FILTER_UNSAFE_RAW);
    $major = strip_tags($major);
    
    $year = filter_input(INPUT_POST, 'year', FILTER_UNSAFE_RAW);
    $year = strip_tags($year);
    
    $role = filter_input(INPUT_POST, 'role', FILTER_UNSAFE_RAW);
    $role = strip_tags($role);
    
    $bio = filter_input(INPUT_POST, 'bio', FILTER_UNSAFE_RAW);
    $bio = strip_tags($bio);
    
    // Handle skills
    $selectedSkills = isset($_POST['skills']) ? $_POST['skills'] : [];
    $selectedSkills = array_intersect($skillsList, $selectedSkills);
    $skills = implode(',', $selectedSkills); // Ensure only valid skills are selected
}

$skillsList = [
    'Web Development', 'Mobile App Development', 'Data Analysis',
    'Machine Learning', 'Artificial Intelligence', 'Cloud Computing',
    'Cybersecurity', 'DevOps', 'UI/UX Design', 'Game Development',
    'Blockchain', 'IoT', 'AR/VR', 'Robotics'
];

    // Update database
    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, major = ?, year = ?, role = ?, bio = ?, skills = ? WHERE id = ?");
    $stmt->bind_param("sssssssi", $name, $email, $major, $year, $role, $bio, $skills, $user_id);

    if ($stmt->execute()) {
        $update_message = "Profile updated successfully!";
    } else {
        $update_message = "Error updating profile: " . $conn->error;
    }
    $stmt->close();

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
                <a href="update-profile.php">Update Profile</a>
            </div>
        </div>
    </main>
    <form method="POST" action="">
        <!-- Other form fields... -->
        
        <fieldset>
            <legend>Skills</legend>
            <div class="skills-container">
                <?php foreach ($skillsList as $skill): ?>
                    <div>
                        <input type="checkbox" id="skill_<?php echo htmlspecialchars($skill); ?>" 
                               name="skills[]" value="<?php echo htmlspecialchars($skill); ?>" 
                               class="skill-checkbox">
                        <label for="skill_<?php echo htmlspecialchars($skill); ?>" class="skill-label">
                            <?php echo htmlspecialchars($skill); ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
        </fieldset>
        
        <input type="submit" value="Submit">
    </form>
</body>
<?php include 'footer.php';?>
</html>
