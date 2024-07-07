<?php

//Start the session
session_start();

//Unset all session variables
$_SESSION = array();

//If it's desired to kill the bitch, then just let it kill itself
//PS this will kill the session :)))) and not just the session data :)))
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

//Destroy the session
session_destroy();

// Redirect to the login page
header("Location: login.php");
exit();
?>