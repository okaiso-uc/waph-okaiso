<?php
	session_start();    
	if (isset($_POST["username"]) && isset($_POST["password"])) {
		if (checklogin($_POST["username"], $_POST["password"])) {
			$_SESSION['authenticated'] = TRUE;
			$_SESSION['username'] = $_POST["username"];
?>

<?php		
		} else {
			 session_destroy();
			 echo "<script>alert('" . htmlspecialchars('Invalid username/password', ENT_QUOTES, 'UTF-8') . "');window.location='form.php';</script>";
			 die();
		}
	}
	if(!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] != TRUE) {
		session_destroy();
		echo "<script>alert('you have not login. Please login first!')</script>";
	    header("Refresh: 0; url=form.php");
	    die();
	}
	function checklogin($username, $password) {
		$account = array("admin", "12345");
		if ($username == $account[0] && $password == $account[1]) {
		  return true;
		} else {
		  return false;
		}
	}

	function checklogin_mysql($username, $password) {
		$mysqli = new mysqli('localhost', 'okaiso', '12345', 'waph');
		if ($mysqli->connect_errno) {
			printf("Database connection failed: %s\n", $mysqli->connect_error);
			exit(); 
		}
		
		$prepared_sql = "SELECT * FROM users where username=? AND password=md5(?);";
		$stmt = $mysqli->prepare($prepared_sql);
		$stmt->bind_param("ss", $username, $password);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows == 1)
			return TRUE;
		return FALSE;
	}
?>
		<h2> Welcome <?php echo htmlentities($_SESSION['username']) ?> !</h2>
		<a href="logout.php">Logout</a>