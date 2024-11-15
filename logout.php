<?php
// Start the session
session_start();

// Unset all session variables
$_SESSION = array();

// If the session was propagated using cookies, delete the session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Destroy the session
session_destroy();

// Redirect to login page
header("location: index.php");
exit;
?>