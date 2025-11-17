<?php
// includes/db_connect.php

$host = "localhost";
$user = "root"; 
$pass = "";    
$db   = "trackback_db";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Charset
$conn->set_charset("utf8mb4");
?>
