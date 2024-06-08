<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bakery Website</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Custom CSS */
    body {
      background-color: #222;
      color: #fff;
    }
    .navbar, .footer {
      background-color: #333;
    }
    .product-card {
      background-color: #444;
      border: none;
    }
    .product-card img {
      width: 100%;
      height: auto;
    }
    .product-info {
      margin-top: 10px;
    }
    .btn-add {
      background-color: #e67e22;
      color: #fff;
    }
    .btn-add:hover {
      background-color: #d35400;
      color: #fff;
    }
    
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <a class="navbar-brand" href="#">Bakery</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="#">About</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Products</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
    </ul>
  </div>
</nav>

<!-- Main Content -->
<div class="container my-5">
  <h2 class="text-center">Customer Favorites</h2>
  <div class="row">
    <!-- Product Card -->
    <div class="col-md-3">
      <div class="card product-card">
        <img src="bread.jpg" alt="Product Image">
        <div class="card-body">
          <h5 class="card-title">Whole Grain Spelt</h5>
          <p class="card-text">$5.00</p>
          <button class="btn btn-add">Add</button>
        </div>
      </div>
    </div>
    <!-- Add more product cards as needed -->
  </div>
</div>

<!-- Footer -->
<div class="footer py-3 text-center">
  <p>&copy; 2024 Bakery. All rights reserved.</p>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
