<?php
include_once('config.php');

// Escape user inputs for security
// $user_id = $conn->real_escape_string($_POST['user_id']);
$name = $conn->real_escape_string($_POST['name']);
$email = $conn->real_escape_string($_POST['email']);
$phone = $conn->real_escape_string($_POST['phone']);
$zip_code = $conn->real_escape_string($_POST['zip_code']);
$role = $conn->real_escape_string($_POST['role']);
if(isset($_POST['password'])){
$password = $conn->real_escape_string($_POST['password']);
}
else{
    $password=$_POST['phone'];
}
// Insert data into users table
$sql = "INSERT INTO users (name, email, phone, zip_code, role, password) VALUES ('$name', '$email', '$phone', '$zip_code', '$role', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    // header('location:login.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
