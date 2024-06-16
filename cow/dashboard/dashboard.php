<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restaurant Menu</title>
  <!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      background-image: url('resource/background.jpg'); /* Replace with your background image path */
      background-size: cover;
      background-position: center;
      color: #fff;
      font-family: 'Roboto', sans-serif;
    }
    .navbar, .footer {
      background-color: rgba(51, 51, 51, 0.8); /* Add transparency */
    }
    .container {
      background-color: rgba(0, 0, 0, 0.8); /* Add transparency */
      padding: 20px;
      border-radius: 10px;
    }
    .menu-item {
      margin-bottom: 20px;
      position: relative;
    }
    .menu-item img {
      width: 100%; /* Set width for all images */
      height: 200px; /* Set height for all images */
      object-fit: cover;
      border-radius: 10px;
      cursor: pointer;
    }
    .menu-item p {
      margin-top: 10px;
      font-size: 18px;
    }
    .menu-item.selected img {
      border: 2px solid blue;
    }
    .checkbox {
      display: none;
    }
    #totalDisplay {
      font-size: 20px;
      font-weight: bold;
    }
    #orders {
      margin-top: 50px;
    }
    #orders th, #orders td {
      padding: 10px;
      border: 1px solid #ccc;
      text-align: center;
    }
    #orders th {
      background-color: rgba(255, 255, 255, 0.1);
      color: #fff;
      border: none;
    }
    #orders td {
      background-color: rgba(255, 255, 255, 0.2);
      color: #fff;
      border: none;
    }
    .icon {
      margin-right: 5px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <a class="navbar-brand" href="#">Chef On Wheels</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="#">About</a></li>
      <li class="nav-item"><a class="nav-link" href="#">menu</a></li>
      <?php 
      if (isset($_SESSION['user_id'])) {
     echo '<li class="nav-item"><a class="nav-link" href="../logout.php">logout</a></li>';
      }else{
        echo '<li class="nav-item"><a class="nav-link" href="../login.php">login</a></li>';

      }
      ?>
    </ul>
  </div>
</nav>
