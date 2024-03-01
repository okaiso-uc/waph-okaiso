# WAPH-Web Application Programming and Hacking

## Instructor: Dr. Phu Phung

## Student: Seth Okai

![Seths's Headshot](Images/headshot.jpg)

# Lab 2 - Front-end Web Development 

## The lab's overview

In Lab 3, I Installed Mysql, created a new database with tables and permissions, interacted with a login system with PHP/MySQL, and Performed XSS and SQL Injection attacks. After performing the attacks I implemented a prepared statement for SQL injection prevention.

## Database Setup and Management
 - I used sudo "apt-get install mysql-server -y" to install MySQL server
   
 - I then used "sudo mysql -u root -p to connect to the MySQL server, pressing enter when prompted for a password

## Database Creation, Database User and Permission 

 - I created a new database Waph and granted my user Seth all permissions using a database-account.sql file
   
 ```
   create database waph;
  " Create User 'setg'@localhost' IDENTIFIED BY 'ubuntu';
   GRANT ALL ON waph.* TO 'Admin'@localhost';
```

![ss1](Images/ss1.png)

- Following that I created a new table and inserted data into it
```
drop table if exists users;
create table users(
  username varchar(0) PRIMARY KEY,
  passsword varchar(100) NOT NULL);
INSERT INTO users(username,password) VALUES ('admin, md5('MyPa$$w0rd));

```

![ss2](Images/ss2.png)

## A Simple (Insecure)Login System with PHP/MySQL

- I installed PHP PHP MySQLi extension with sudo apt-get install php-mysqli, and restarted Apache using sudo service apache2 restart.
  
-  I modified index.php by adding a checklogin_mysql function in index.php for database programming authentication
- 
 ```
	function checklogin_mysql($username, $password) {
		$mysqli = new mysqli('localhost', 'okaiso', '12345', 'waph');
		if ($mysqli->connect_errno) {
			printf("Database connection failed: %s\n", $mysqli->connect_error);
			exit(); 
		}

		
		return false;
	}
```

- I was able to log in successfully with the username and password from my database and 
insecurely with the following code options in index.php:

String Concat in PHP 

```
$sql = "SELECT * FROM users where username='" . $username . "' "; 
$sql = $sql . " AND password = md5('" . $password . "')";
```

```
Variable Injection into String 
$username = $POST["username"]; 
$password = $POST["password"]; 
$sql = "SELECT * FROM users WHERE username='$username' AND password= md5('$password)
```


-  I then Deployed form.php and the modified index.php and tested the login functionality.
  ![ss3](Images/ss3.png)

## Performing XSS and SQL Injection Attacks

### SQL Injection

- Because the form lacks proper input validation, I was able to carry out a successful SQL injection attack using the username 'OR 1=1;#. This exploit worked because the SQL query string concatenation, along with the injected conditional statement 1=1, resulted in a true evaluation, enabling access to all records in the targeted table.
 ![ss4](Images/ss4.png)

### XSS Attack
- The site is vulnerable to XSS due to the lack of Input Validation and Output Encoding
  
I was able to attack this site with the code : admin '#<script>alert(document.cookie)</script>
![ss5](Images/ss5.png)


### Prepared Statement Implementation

- Prepared statements protect against SQL injection by keeping SQL code separate from user-entered data. They first build the SQL query and then add user data as predetermined parameters. This blocks attackers from adding their own SQL code, making the query less likely to be manipulated.
```
$prepared_sql = "SELECT * FROM users where username=? AND password=md5(?);";
		$stmt = $mysqli->prepare($prepared_sql);
		$stmt->bind_param("ss", $username,$password);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows ==1)
			return TRUE;
		return FALSE;
```

- Testing sql injection with Implentation in place:

![ss6](Images/ss6.png)

- To mitigate XSS risks, I enhanced the code to sanitize outputs by using the htmlspecialchars function. Here's the revised code snippet:
  ```
  echo "<script>alert('" . htmlspecialchars('Invalid username/password', ENT_QUOTES, 'UTF-8') . "');window.location='form.php';</script>";
		 die();
  ```
  
  - Output from XSS Attack
  
![ss7](Images/ss7.png)




 Discussion: The PHP code has major flaws that threaten security and functionality. Firstly, the absence of input validation fails to address empty username or password fields, leaving the system vulnerable to exploitation. Secondly, the lack of error handling for database operations can potentially leak sensitive data or disrupt services in case of database errors. Moreover, the insecure authentication mechanism, relying on plaintext storage and direct comparison of passwords, exposes user credentials to theft and timing-based attacks. 

  
