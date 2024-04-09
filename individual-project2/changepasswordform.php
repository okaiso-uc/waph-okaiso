<?php
  require "session_auth.php";
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>WAPH-Change password</title>
	<script type="text/javascript">
		function displayTime(){
			document.getElementById('digital-clock').innerHTML = "Current time: " + new Date();
		}
		setInterval(displayTime, 500); // Corrected setInterval
	</script>
</head>
<body>
	<h1>Change password, Waph</h1>
	<h2>Seth Okai</h2>
	<div id="digital-clock"></div> <!-- Corrected id attribute -->
<?php
	//some code here
	echo "Visited time: " . date("y-m-d h:i:sa");
?>
	<form action="changepassword.php" method="POST" class="form login">
		Username:
		<?php echo htmlentities($_SESSION['username']); ?> 
	  <br>
	  Password: <input type="password" class="text_field" name="newpassword" /> <br>
	  <button class="button" type="submit">Change Password </button>
	 </form>
	</body>
	</html>