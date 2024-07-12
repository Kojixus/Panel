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
    <link rel="stylesheet" href="css/style.css">
</head>
<?php include 'header.php';?>
<body>
    <div class="dashboard">
        <main>
            <div class="content-box">
                <h2>Welcome to UCF Formula Club</h2>
                <p>Made by: Dezso "Big Boy" Kovi</p>
                <!-- Add more content or widgets here -->
            </div>
        </main>
</body>
<?php include 'footer.php';?>
</html>