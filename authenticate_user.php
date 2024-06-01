<?php
session_start();

include_once('config.php');

// Get email and password from the login form
$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);

// Prepare SQL statement to select user from database
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";

// Execute SQL statement
$result = $conn->query($sql);

// Check if user exists
if ($result->num_rows == 1) {
    // User exists, fetch user data
    $row = $result->fetch_assoc();
    
    // Set sessions for user_id and role
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['name'] = $row['name'];
    if($row['role']=='admin' || $row['role']=='cook' || $row['role']=='delivery'){
    // Redirect to a logged-in page
    header("Location: admin/home.php");
}
elseif($row['role']==NULL){
    header("Location: cow/menu.php");
}
} else {
    // Invalid email or password, redirect back to login page with error message
    $_SESSION['error'] = "Invalid email or password";
    header("Location: login.php");
}

// Close connection
$conn->close();
?>
`