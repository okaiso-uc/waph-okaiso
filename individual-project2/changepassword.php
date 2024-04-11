<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

// Check CSRF token
$csrf_token = isset($_POST["csrf_token"]) ? $_POST["csrf_token"] : null;
if (!isset($csrf_token) || $csrf_token !== $_SESSION["csrf_token"]) {
    echo "CSRF Attack detected!";
    die();
}

$username_or_email = $_POST["username_or_email"];
$password = $_POST["newpassword"];

if (isset($username_or_email) && isset($password)) {
    if (changepassword($username_or_email, $password)) {
        echo "Password has been changed!";
    } else {
        echo "Change password failed!";
    }
} else {
    echo "No username/password provided!";
}

function changepassword($username_or_email, $password) {
    $mysqli = new mysqli('localhost', 'okaiso', 'Pa$$w0rd', 'waph');
    
    if ($mysqli->connect_errno) {
        printf("Database connection failed: %s\n", $mysqli->connect_error);
        return FALSE;
    }

    // Hash the password securely
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Determine if the username_or_email is an email or username
    if (filter_var($username_or_email, FILTER_VALIDATE_EMAIL)) {
        $prepared_sql = "UPDATE users SET password = ? WHERE email = ?";
    } else {
        $prepared_sql = "UPDATE users SET password = ? WHERE username = ?";
    }

    // Prepare and execute the SQL statement
    $stmt = $mysqli->prepare($prepared_sql);
    
    if (!$stmt) {
        printf("Error: %s\n", $mysqli->error);
        return FALSE;
    }

    $stmt->bind_param("ss", $hashed_password, $username_or_email);
    
    if ($stmt->execute()) {
        return TRUE;
    } else {
        printf("Error: %s\n", $mysqli->error);
        return FALSE;
    }
}
?>
