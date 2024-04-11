<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_set_cookie_params(15 * 60, "/", "okaiso.waph.io", TRUE, TRUE);
session_start();

// Check CSRF token
$token = isset($_POST["nocsrftoken"]) ? $_POST["nocsrftoken"] : null;
if (!isset($token) || $token !== $_SESSION["nocsrftoken"]) {
    echo "CSRF Attack detected!";
    die();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if username/email and password are provided via POST
    if (isset($_POST["username_or_email"]) && isset($_POST["password"])) {
        $username_or_email = $_POST["username_or_email"];
        $password = $_POST["password"];

        // Attempt to log in
        if (checklogin_mysql($username_or_email, $password)) {
            // Authentication successful, set session variables
            $_SESSION['authenticated'] = TRUE;
            $_SESSION['username_or_email'] = $username_or_email;
            $_SESSION['browser'] = $_SERVER["HTTP_USER_AGENT"];
        } else {
            // Authentication failed, destroy session and display error message
            session_destroy();
            echo "<script>alert('" . htmlspecialchars('Invalid username/email or password', ENT_QUOTES, 'UTF-8') . "');window.location='form.php';</script>";
            die();
        }
    }
}

// Check if user is authenticated
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== TRUE) {
    session_destroy(); // Destroy session
    echo "<script>alert('You are not logged in. Please log in first.');</script>";
    header("Refresh:0; url=form.php");
    exit();
}

// Check for session hijacking
if ($_SESSION['browser'] != $_SERVER["HTTP_USER_AGENT"]) {
    session_destroy(); // Destroy session
    echo "<script>alert('Session hijacking attack is detected!')</script>";
    header("Refresh: 0; url=form.php");
    die();
}

// Function to check login credentials against MySQL database
function checklogin_mysql($username_or_email, $password) {
    $mysqli = new mysqli('localhost', 'okaiso', 'Pa$$w0rd', 'waph');

    // Check for database connection errors
    if ($mysqli->connect_errno) {
        error_log("Database connection failed: " . $mysqli->connect_error); // Log error
        exit();
    }

    // Hash the password before comparison
    $hashed_password = md5($password);

    // Determine the type of identifier (email or username) and prepare SQL statement
    if (filter_var($username_or_email, FILTER_VALIDATE_EMAIL)) {
        $prepared_sql = "SELECT * FROM users WHERE email=? AND password=?";
    } else {
        $prepared_sql = "SELECT * FROM users WHERE username=? AND password=?";
    }

    // Prepare and bind parameters
    $stmt = $mysqli->prepare($prepared_sql);
    $stmt->bind_param("ss", $username_or_email, $hashed_password);
    
    // Execute the SQL statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if there's a matching user
    if ($result->num_rows == 1) {
        return true;
    }
    return false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>WAPH-Login page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript">
      function displayTime() {
        document.getElementById('digit-clock').innerHTML = "Current time:" + new Date();
      }
      setInterval(displayTime,500);
  </script>
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }
    .container {
      max-width: 400px;
      margin: 100px auto;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      background-color: #fff;
    }
    .form-control {
      border-radius: 20px;
    }
    .btn-primary {
      border-radius: 20px;
      padding: 10px 20px;
      width: 100%;
      margin-top: 20px;
      background-color: #007bff;
      border-color: #007bff;
    }
    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }
    .btn-primary:focus {
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="text-center mb-4">A Simple login form, WAPH</h1>
    <div class="text-center mb-3">Seth Okai</div>
    <div id="digit-clock" class="text-center mb-3"></div>
    <?php
      // Display visited time
      echo "Visited time: " . date("Y-m-d h:i:sa");
    ?>
    <h2>Welcome <?php echo isset($_SESSION['username_or_email']) ? htmlentities($_SESSION['username_or_email']) : ''; ?>!</h2>
    <a href="changepasswordform.php">Change password</a> | <a href="logout.php">Logout |  <a href="profile_form.php">Change Profile </a>
  </div>
</body>
</html>