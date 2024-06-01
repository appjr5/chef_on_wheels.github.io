    <?php
    session_start();
    $name =$_SESSION['name'];
    $user_id=$_SESSION['user_id'];
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
      overflow: auto;
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
          <li><a href="users.php">Users</a></li>
          <li><a href="add_users.php">add staff</a></li>
          <li><a href="product.php">Products</a></li>
          <li><a href="add_product.php">add Products</a></li>
          <li><a href="order.php">Orders</a></li>
          <li><a href="settings.php">Settings</a></li>
        </ul>
      </div>
      <div class="col-md-9">
        <div class="content">
      <!-- Content -->
      
    
