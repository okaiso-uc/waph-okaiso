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
    <div class="text-center mb-3">Student Name</div>
    <div id="digit-clock" class="text-center mb-3"></div>
    <?php
      //some code here
      echo "Visited time: " . date("Y-m-d h:i:sa");
    ?>
    <form action="index.php" method="POST" class="login">
      <div class="mb-3">
        <input type="text" class="form-control" id="username_or_email" name="username_or_email" placeholder="Username or Email">
      </div>
      <div class="mb-3">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
  </div>
</body>