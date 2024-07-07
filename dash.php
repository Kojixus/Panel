<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCF Formula Club Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/ucf-formula-club-theme.css">
</head>
<body>
    <div class="dashboard">
        <header>
            <h1>UCF Formula Club Dashboard</h1>
            <div class="user-info">
                Welcome, <?php echo htmlspecialchars($userName); ?>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </header>
        <nav>
            <ul>
                <li><a href="#dashboard">Dashboard</a></li>
                <li><a href="#team">Team</a></li>
                <li><a href="#events">Events</a></li>
                <li><a href="#car">Car</a></li>
                <li><a href="https://www.tacobell.com/food?store=028007">Taco Bell</a></li>
            </ul>
        </nav>
        <main>
            <div class="content-box">
                <h2>Welcome to UCF Formula Club</h2>
                <p>This is where you can manage your team, events, and car information.</p>
                <!-- Add more content or widgets here -->
            </div>
        </main>
    </div>
    <div class="container">
        <div class="card">
        <h2>Welcome</h2>
        <p>This is a sample card with some content.</p>
        <a href="#" class="btn">Learn More</a>
    </div>
    <!-- Add more cards as needed -->
</div>

</body>
</html>

