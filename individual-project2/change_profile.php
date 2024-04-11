<?php
// Database connection
$mysqli = new mysqli('localhost', 'okaiso', 'Pa$$w0rd', 'waph');

// Check for database connection errors
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if profile information is provided via POST
    if (isset($_POST["new_username"]) && isset($_POST["new_email"])) {
        // Update profile information
        $new_username = $_POST["new_username"];
        $new_email = $_POST["new_email"];

        // Add code to update profile information in the database
        $query = "UPDATE users SET username=?, email=? WHERE username=?";

        // Prepare the statement
        $stmt = $mysqli->prepare($query);

        // Bind parameters
        $stmt->bind_param("sss", $new_username, $new_email, $_SESSION['username_or_email']);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Profile information updated successfully!";
        } else {
            echo "Error updating profile information: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }
}

// Retrieve user's current name and email from the database
$query = "SELECT username, email FROM users WHERE username=?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $_SESSION['username_or_email']);
$stmt->execute();
$stmt->bind_result($current_username, $current_email);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Profile</title>
</head>
<body>
    <h1>Change Profile Information</h1>
    <form action="change_profile.php" method="POST">
        <label for="new_username">New Username:</label><br>
        <input type="text" id="new_username" name="new_username" value="<?php echo htmlspecialchars($current_username); ?>" required><br>
        <label for="new_email">New Email:</label><br>
        <input type="email" id="new_email" name="new_email" value="<?php echo htmlspecialchars($current_email); ?>" required><br><br>
        <button type="submit">Change Profile</button>
    </form>
</body>
</html>
