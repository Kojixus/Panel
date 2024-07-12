<?php
$loggedIn = isset($_SESSION['user_id']);

$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];
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
                <li><a href="#">Home</a></li>
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