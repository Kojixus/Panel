<?php
session_start();
require_once 'connection.php';


// For debugging purposes, let's check if $pdo is set
if (!isset($pdo)) {
    die("Database connection not established. Check connection.php");
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
    $stmt->execute([$name, $email, $user_id]);

    // Redirect back to profile page or show success message
    header("Location: profile.php?update=success");
    exit();
}

$skillsList = [
    'Web Development', 'Mobile App Development', 'Data Analysis',
    'Machine Learning', 'Artificial Intelligence', 'Cloud Computing',
    'Cybersecurity', 'DevOps', 'UI/UX Design', 'Game Development',
    'Blockchain', 'IoT', 'AR/VR', 'Robotics'
];

// Fetch current user data
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/update-profile.css">
</head>
<?php include 'header.php';?>
<body>
    <div class="container">
        <h1>Update Your Profile</h1>
        <img src="img/person.jpg" alt="Profile Picture" class="profile-picture">
        <form id="update-profile-form">
            <form action="update_profile.php" method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="name">Email:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="name">Major:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['major']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="name">Year:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['year']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="name">Bio:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['bio']); ?>" required>
                </div>
                <div class="button-container">
                    <a href="profile.php" class="button button-secondary">Back to Profile</a>
                    <button type="submit" class="button button-primary">Update Profile</button>
                </div>
            </form>
            <fieldset>
                <legend>Skills</legend>
                <?php foreach ($skillsList as $skill): ?>
                <label>
                    <input type="checkbox" name="skills[]" value="<?php echo htmlspecialchars($skill); ?>">
                    <?php echo htmlspecialchars($skill); ?>
                </label>
                <br>
                    <?php endforeach; ?>
                </br>
            </fieldset>
        </form>
    </div>
</body>
<?php include 'footer.php';?>
</html>