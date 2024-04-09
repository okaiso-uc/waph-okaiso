<?php
error_reporting(E_ALL);

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

if (isset($username) && isset($email) && isset($password)) {
    if (validateInput($username, $email, $password)) {
        if (addNewUser($username, $email, $password)) {
            echo "Registration succeed!";
        } else {
            echo "Registration FAILED!";
        }
    } else {
        echo "Invalid username, email, or password format!";
    }
} else {
    echo "No username/email/password provided!";
}

function validateInput($username, $email, $password) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    
    $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/';
    if (!preg_match($regex, $password)) {
        return false;
    }
    
    return true;
}

function addNewUser($username, $email, $password) {
    $mysqli = new mysqli('localhost', 'okaiso', 'Pa$$w0rd', 'waph');
    if ($mysqli->connect_errno) {
        printf("Database connection failed: %s\n", $mysqli->connect_error);
        return false;
    }
    $prepared_sql = "INSERT INTO users (username, email, password) VALUES (?, ?, MD5(?))";
    $stmt = $mysqli->prepare($prepared_sql);
    $stmt->bind_param("sss", $username, $email, $password);
    if ($stmt->execute()) return true;
    return false;
}
?>
