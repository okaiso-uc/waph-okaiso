<?php
// Start session
session_start();

// Generate and store CSRF token in session
$csrf_token = bin2hex(openssl_random_pseudo_bytes(16));
$_SESSION["csrf_token"] = $csrf_token;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            max-width: 400px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .form-control {
            margin-bottom: 15px;
            width: calc(100% - 22px); /* Adjust width to fit the button's padding */
            box-sizing: border-box;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px; /* Increase space between buttons */
        }
        .btn {
            flex: 1;
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Profile</h1>
        <form action="change_profile.php" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
            <input type="text" class="form-control" name="new_username" placeholder="New Username" required>
            <input type="email" class="form-control" name="new_email" placeholder="New Email" required>
            <div class="btn-container">
                <button type="submit" class="btn">Save Changes</button>
                <a href="logout.php" class="btn">Logout</a>
            </div>
        </form>
    </div>
</body>
</html>
