<?php
// Simulating user data (in a real application, this would come from a database)
$user = [
    'name' => 'John Doe',
    'email' => 'john.doe@knights.ucf.edu',
    'major' => 'Mechanical Engineering',
    'year' => 'Junior',
    'role' => 'Suspension Team Lead',
    'bio' => 'Passionate about automotive engineering and pushing the limits of performance.',
    'skills' => ['CAD Design', 'FEA Analysis', 'Vehicle Dynamics', 'Project Management', 'MATLAB']
];

// Function to sanitize output
function sanitize($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
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
        <h2>Team Member Profile</h2>
        <div class="profile-info">
            <p><strong>Name:</strong> <?php echo sanitize($user['name']); ?></p>
            <p><strong>Email:</strong> <?php echo sanitize($user['email']); ?></p>
            <p><strong>Major:</strong> <?php echo sanitize($user['major']); ?></p>
            <p><strong>Year:</strong> <?php echo sanitize($user['year']); ?></p>
            <p><strong>Role:</strong> <?php echo sanitize($user['role']); ?></p>
            <p><strong>Bio:</strong> <?php echo sanitize($user['bio']); ?></p>
        </div>
        <h2>Technical Skills</h2>
        <ul class="skills-list">
            <?php foreach ($user['skills'] as $skill): ?>
                <li><?php echo sanitize($skill); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
