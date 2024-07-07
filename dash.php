<?php
session_start();
// Check if user is logged in (you'd implement proper authentication)
$loggedIn = true; // For demonstration purposes
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php if ($loggedIn): ?>
        <div class="dashboard">
            <header>
                <h1>Admin Dashboard</h1>
                <div class="user-info">
                    Welcome, Admin
                    <a href="#" class="logout-btn">Logout</a>
                </div>
            </header>
            <nav>
                <ul>
                    <li><a href="#dashboard">Dashboard</a></li>
                    <li><a href="#users">Users</a></li>
                    <li><a href="#settings">Settings</a></li>
                    <li><a href="#reports">Reports</a></li>
                </ul>
            </nav>
            <main>
                <h2>Welcome to your Dashboard</h2>
                <p>This is where you can manage your website content, users, and settings.</p>
                <!-- Add more content or widgets here -->
            </main>
        </div>
    <?php else: ?>
        <div class="login-prompt">
            <h2>Please log in to access the dashboard</h2>
            <a href="login.php" class="login-btn">Login</a>
        </div>
    <?php endif; ?>
</body>
</html>
