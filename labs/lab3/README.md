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

 - I created a new database Waph and granted my user Okaiso all permissions using a database-account.sql file
   
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

## 
