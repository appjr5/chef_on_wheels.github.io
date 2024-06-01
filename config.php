<?php
$servername = "localhost";
$username = "root"; // Assuming username is 'root', change it if it's different
$password = ""; // Enter your MySQL password here
$dbname = "cow";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}