<?php
// In session_check.php
session_start();
$user = $_SESSION['user'] ?? null;
if (isset($user['some_key'])) {
    // Use $user['some_key']
}

$someValue = $user['some_key'] ?? 'default value';
// In header.php and other files
require_once 'session_check.php';
// Now you can use $user safely