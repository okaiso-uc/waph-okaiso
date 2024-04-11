<?php
session_set_cookie_params(15 * 60, "/", "okaiso.waph.io", TRUE, TRUE);
session_start();

// Check if the user is logged in
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== TRUE) { 
    session_destroy();
    echo "<script>alert('You have not logged in. Please login first!')</script>";
    header("Refresh: 0; url=form.php");
    die();
}

// Check for session hijacking
if ($_SESSION['browser'] != $_SERVER["HTTP_USER_AGENT"] || $_SESSION['ip_address'] != $_SERVER['REMOTE_ADDR']) {
    session_destroy();
    echo "<script>alert('Session hijacking attack is detected!')</script>";
    header("Refresh: 0; url=form.php");
    die();
}
?>
