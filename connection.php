<?php
$servername = "localhost";
$username = "root"; //Default username for XAMPP is "root"
$password = ""; //Default password for XAMPP is an empty string
$dbname = "main";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>