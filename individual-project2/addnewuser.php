<?php 
error_reporting(E_ALL);

    $username = $_POST["username"];
    $password = $_POST["password"];
    if (isset($username) and isset($password)) {
        //echo "Debug> got username=$username;password=$password";
        if (addnewuser($username,$password)) {
         echo "Registration succeed!";
     }else{
         echo "Registration FAILED!";
       
        }
    }else{
        echo "No username/password provided!";
    }


    function addnewuser($username, $password) {
        $mysqli = new mysqli('localhost', 'okaiso', 'Pa$$w0rd', 'waph');
        if ($mysqli->connect_errno) {
            printf("Database connection failed: %s\n", $mysqli->connect_error);
        return FALSE;

        }
        $prepared_sql = "INSERT INTO users (username,password) VALUES (?,md5(?));";
        $stmt = $mysqli->prepare($prepared_sql);
        $stmt->bind_param("ss", $username,$password);
        if ($stmt->execute()) return TRUE;
        return FALSE;

    }
?>
