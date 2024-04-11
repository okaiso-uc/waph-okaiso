<?php
// Start session
session_start();

// Check CSRF token
$csrf_token = isset($_POST["csrf_token"]) ? $_POST["csrf_token"] : null;
if (!isset($csrf_token) || $csrf_token !== $_SESSION["csrf_token"]) {
    echo "CSRF Attack detected!";
    die();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$mysqli = new mysqli('localhost', 'okaiso', 'Pa$$w0rd', 'waph');

// Check for database connection errors
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if new username and email are provided via POST
    if (isset($_POST["new_username"]) && isset($_POST["new_email"])) {
        $new_username = $_POST["new_username"];
        $new_email = $_POST["new_email"];

        // Update profile information in the database
        $result = updateProfile($_SESSION['username_or_email'], $new_username, $new_email);
        if ($result === true) {
            echo "Profile information updated successfully!";
        } elseif ($result === false) {
            echo "Failed to update profile information! Please check your inputs.";
        } else {
            echo "Error: " . $result;
        }
    } else {
        echo "Both username and email must be provided!";
    }
}

function updateProfile($current_username_or_email, $new_username, $new_email) {
    global $mysqli;

    // Prepare the SQL statement to update the profile information
    $query = "UPDATE users SET username = ?, email = ? WHERE username = ? OR email = ?";

    // Prepare the statement
    $stmt = $mysqli->prepare($query);

    if (!$stmt) {
        return "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    // Bind parameters
    $stmt->bind_param("ssss", $new_username, $new_email, $current_username_or_email, $current_username_or_email);

    // Execute the statement
    if ($stmt->execute()) {
        // Update the session with the new username
        $_SESSION['username_or_email'] = $new_username;
        return true;
    } else {
        return "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
}
?>
