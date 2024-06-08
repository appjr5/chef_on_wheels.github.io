<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restaurant Menu</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      background-image: url('resource/HD wallpaper_ tomato, hamburger, Patty, sandwich, fast food, bun, salad, tomatoes.jpg'); /* Replace with your background image path */
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
      <li class="nav-item"><a class="nav-link" href="#">Products</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
    </ul>
  </div>
</nav>

<!-- Main Content -->
<div class="container my-5">
  <h1 class="mt-5 text-center">Restaurant Menu</h1>
  <form action="backend/menu.php" method="post">
    <div class="row">
    <?php
      // Database connection
      include_once('../config.php');

      // Fetch menu items from the database
      $sql = "SELECT product_id, product_name, product_image, price FROM product";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // Output each menu item as an image
        while($row = $result->fetch_assoc()) {
          echo '<div class="menu-item col-md-4">';
          echo '<input type="checkbox" class="checkbox" name="selected_items[]" value="' . $row["product_id"] . '">';
          echo '<img src="../admin/uploads/' . $row["product_image"] . '" alt="' . $row["product_name"] . '">';
          echo '<p>' . $row["product_name"] . '<br> Tsh ' . $row["price"] . '</p>';
          echo '</div>';
        }
      } else {
        echo "No menu items found.";
      }
  
    ?>
    </div>
    <div id="totalDisplay" class="text-center mt-3">Total: Tsh 0.00</div> <!-- Div to display total -->
    <button type="submit" class="btn btn-primary mt-3 btn-block">Submit Order</button>
  </form>
</div>

<div class="container" id="orders">
  <h2 class="mt-5 text-center">Your Orders</h2>
  <table class="table">
    <thead>
      <tr>
        <th><i class="fas fa-clock icon"></i>Order Time</th>
        <th><i class="fas fa-utensils icon"></i>Product Name</th>
        <th><i class="fas fa-dollar-sign icon"></i>Price</th>
      </tr>
    </thead>
    <tbody>
      <?php
        // Database connection
        if(isset($_GET['order_id'])){
        include_once('../config.php');
        $order_id=$_GET['order_id'];
        // Fetch orders and related items from the database
        $sql = "SELECT o.order_id, o.order_time, oi.product_id, p.product_name, p.price
                FROM orders o
                INNER JOIN order_items oi ON o.order_id = oi.order_id
                INNER JOIN product p ON oi.product_id = p.product_id 
                WHERE o.order_id=$order_id
                ORDER BY o.order_id ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["order_time"] . "</td>";
            echo "<td>" . $row["product_name"] . "</td>";
            echo "<td>Tsh " . $row["price"] . "</td>";
            echo "</tr>";
          }
          
        } else {
          echo "<tr><td colspan='3'>No orders found.</td></tr>";
        }

        $conn->close();
    }else{
        echo "your order will appear here";
    }echo '<a class="btn btn-danger" href="../admin/actions/delete.php?order_id=' . $order_id . '">cancel the order</a>';
        ?>
    </tbody>
  </table>
</div>

<!-- Footer -->
<div class="footer py-3 text-center">
  <p>&copy; 2024 Chef On Wheels. All rights reserved.</p>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const menuItems = document.querySelectorAll(".menu-item");
  var total = 0; // Move the total variable outside the event listener
  const totalDisplay = document.getElementById("totalDisplay"); // Get the total display div

  menuItems.forEach(item => {
    const checkbox = item.querySelector("input[type='checkbox']");
    const image = item.querySelector("img");
    const priceText = item.querySelector(".menu-item p").textContent.trim(); // Get the text content
    const price = parseFloat(priceText.match(/\d+(\.\d+)?/)[0]); // Extract the number using regular expression
    image.addEventListener("click", function() {
      checkbox.checked = !checkbox.checked;
      item.classList.toggle("selected");
      
      if (item.classList.contains("selected")) {
        total += price;
        totalDisplay.textContent = "Total: Tsh " + total.toFixed(2); // Update total display
      } else { // Subtract the price if item is deselected
        total -= price;
        totalDisplay.textContent = "Total: Tsh " + total.toFixed(2); // Update total display
      }
    });
  });
});
</script>

</body>
</html>
