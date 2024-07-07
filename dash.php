<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <?php
        //Requirements
        require 'connection.php';

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch data from the database
        $sql = "SELECT * FROM projects";
        $result = $conn->query($sql);

        // Generate HTML content for each project
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="card">';
                echo '<h2>' . $row["title"] . '</h2>';
                echo '<p>' . $row["description"] . '</p>';
                echo '</div>';
            }
        } else {
            echo "No projects found.";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>