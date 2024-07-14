<?php
$serverName = "localhost";
$db_username = "root"; //Default username for XAMPP is "root"
$db_password = ""; //Default password for XAMPP is an empty string
$dbname = "main";

try {
    $pdo = new PDO("mysql:host=$serverName;dbname=$dbname", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
return $pdo;

// Create connection
$conn = new mysqli($serverName, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>