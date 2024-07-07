<?php
//Requirements
require 'connection.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Get user information from session variables
$userId = $_SESSION['userId'];
$username = $_SESSION['username'];