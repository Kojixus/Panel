<?php
// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
$loggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);

// Ensure $user is set and contains the expected data
if (isset($user) && is_array($user) && isset($user['id'], $user['name'])) {
    // Use null coalescing operator to set default values
    $_SESSION['user_id'] = $user['id'] ?? null;
    $_SESSION['user_name'] = $user['name'] ?? '';

    // Optionally, you can add a timestamp for the login
    $_SESSION['login_time'] = time();
} else {
    // Log an error or handle the case where $user is not properly set
    error_log('User data is not properly set');
}
?>


<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCF Formula Club</title>
    <link rel="stylesheet" href="css/header.css">
    <!-- Add other CSS files and meta tags as needed -->
</head>
<body>
<header class="header">
    <div class="header-container">
        <div class="logo">
            <img src="img/kr.png" alt="UCF Formula Logo">
        </div>
        <nav>
            <ul class="nav-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="dash.php">Dash</a></li>
                <li><a href="team.php">Team</a></li>
            </ul>
        </nav>
        <div class="user-actions">
            <?php if ($loggedIn): ?>
                <div class="user-profile">
                    <span class="user-name"><?php echo isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'User'; ?></span>
                </div>
                <a href="profile.php" class="profile-btn">Profile</a>
                <form action="logout.php" method="post" style="display: inline;">
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            <?php else: ?>
                <a href="login.php" class="login-btn">Login</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<main class="site-content">