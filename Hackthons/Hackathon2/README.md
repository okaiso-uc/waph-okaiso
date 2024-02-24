# WAPH-Web Application Programming and Hacking

## Instructor: Dr. Phu Phung

## Student: Seth Okai

![Seth's Headshot](Images/headshot.jpg)

# Hackathon 1 - Cross-site Scripting Attacks and Defenses

## Overview and Requirements

This hackathon consists of three levels with multiple sub-tasks.

### Level 0

![level0](Images/level0.png)

- **Description**: I  Injected SQL code with my University’s username to bypass the login check and successfully log in to the system.

  
### Level 1

  ![level1](Images/level1.png)
  
- **Description**:Injected SQL code leveraging the UNION SELECT statement to display specific information on the page. Utilized the LIMIT function in conjunction with the SQL injection payload to ensure only the desired information is retrieved.
  


### Level 2 - Exploiting SQLi to Access Data

### Detecting SQLi Vulnerabilities

![level2.i](Images/levl2.1b.png)

- **Description**: used different inputs to see if the application responds in a way that indicates a vulnerability. An example of an error page above tells me I got the number of columns wrong.

#### Sub-task: Identify the Number of Columns

I found out the number of columns was 3 by using Union Select and identifying which query worked for the number of columns I tried to select.

![level2.i](Images/2.ia.png)

- **Description**: Utilized SQL injection techniques to identify the number of columns in the database table. I experimented with different payloads including UNION SELECT statements to determine the correct number of columns required for injection.


#### Sub-task: Display Your Information

 ![level2.1b](Images/level2.ii.png)



#### Sub-task: Display the Database Schema

![level2.III](Images/level2.III.png)

- **Description**: Exploited SQLi vulnerabilities to retrieve the entire database schema. Used SQL injection techniques to extract information about all tables and their columns in the database.



#### Sub-task: Display Login Credentials

![level2.iv](Images/Level2.iv.png)

- **Description**: Identified the table and columns storing usernames and passwords in the database. Constructed an SQL injection query incorporating the LIMIT function to display a limited number of rows containing login credentials.


#### Sub-task: Login with Stolen Credentials

- **Description**: Utilized stolen login credentials obtained through SQL injection to log in to the system. Demonstrated the successful exploitation of SQLi vulnerabilities to gain unauthorized access to the application.
  
- Used the hash to find the password
  
![level2.ivc](Images/level2.ivc.png)

![revealhash](Images/revealhash.png)


