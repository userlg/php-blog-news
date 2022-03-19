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