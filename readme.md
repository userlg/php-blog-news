#  Php Blog Project

## Description

### This project allow post news in the web, login, singup and signin. Also the users can createnew articles and publish in real time

## Requirements

+ Phpmyadmin (Any Database Manager Works)

+ XAMPP 

+ Only turn on your apache server and use this app


# Instructions

### You must have configure it the database credentials with user, password, host and database. **In the config file**

```
<?php
$host     = ""; // Database Host
$user     = ""; // Database Username
$password = ""; // Database's user Password
$database = ""; // Database Name

$connect = new mysqli($host, $user, $password, $database);

// Checking Connection
if (mysqli_connect_errno()) {
    printf("Database connection failed: %s\n", mysqli_connect_error());
    exit();
}

mysqli_set_charset($connect, "utf8mb4");

$site_url = "http://localhost";
?>
```


# Link

[Direct Acces Repository](https://github.com/userlg/php-blog-news)

# Screenshots

![ Screenshot 1](assets/img/cap1.png)

_____________________________________________________

![ Screenshot 2](assets/img/cap2.png)

____________________________________________________

##   Developed by userlg



