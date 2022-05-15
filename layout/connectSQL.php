<?php
    $username = "root";
    $password = "bachien2k1";
    $host = "localhost";
    $database = "smartphone";
    
    // Create connection
    $conn = new mysqli($host, $username, $password, $database);
    
    // Check connection
    
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
?>