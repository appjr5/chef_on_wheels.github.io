<?php
session_start();
$name = $_SESSION['name'];
$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

// Use the correct function for checking if a variable is empty
if (empty($user_id) || empty($role)) {
    header('Location: ../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Custom CSS */
    .sidebar {
      background-color: #343a40;
      color: #fff;
      height: 100vh;
    }
    .sidebar ul {
      list-style-type: none;
      padding: 0;
    }
    .sidebar li {
      padding: 10px 20px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    .content {
      padding: 20px;
      overflow-y: auto;
      max-height: 100vh;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-3 sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
          <li><a href="home.php">Dashboard</a></li>
          <?php
          if ($role == 'admin') {
              echo '<li><a href="users.php">Users</a></li>';
              echo '<li><a href="add_users.php">Add Staff</a></li>';
              echo '<li><a href="product.php">Products</a></li>';
              echo '<li><a href="add_product.php">Add Products</a></li>';
              echo '<li><a href="order.php">Orders</a></li>';
          }
          if ($role == 'cook') {
              echo '<li><a href="cook.php">Orders</a></li>';
          }
          if ($role == 'delivery') {
              echo '<li><a href="delivery.php">Orders</a></li>';
          }
          ?>
          <li><a href="../logout.php">logout</a></li>
        </ul>
      </div>
      <div class="col-md-9">
        <div class="content">
          <!-- Content -->
          <!-- Content goes here... -->
       
  
