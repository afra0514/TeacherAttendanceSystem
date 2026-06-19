<?php
// 1. Database Server Details
$host = "localhost";      // Usually 'localhost' for local servers
$user = "root";           // Default username for phpMyAdmin is 'root'
$pass = "";               // Default password is empty (no password)
$dbname = "db_attendance"; // The exact name of your database in phpMyAdmin

// 2. Connect to the Database
$conn = mysqli_connect($host, $user, $pass, $dbname);

// 3. Check if the connection works
if (!$conn) {
    // If the connection fails, stop the site and show the error
    die("Connection failed: " . mysqli_connect_error());
}

// You are now connected! You can start using $conn for your queries.
?>