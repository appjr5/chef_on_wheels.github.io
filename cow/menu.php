<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restaurant Menu</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .menu-item {
      margin-bottom: 20px;
      position: relative; /* Add relative positioning */
    }
    .menu-item img {
      width: 200px; /* Set width for all images */
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
      display: none; /* Hide the checkbox */
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
    }
  </style>
</head>
<body>
<div class="container">
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
        <th>Order ID</th>
        <th>Order Time</th>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Price</th>
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
            echo "<td>" . $row["order_id"] . "</td>";
            echo "<td>" . $row["order_time"] . "</td>";
            echo "<td>" . $row["product_id"] . "</td>";
            echo "<td>" . $row["product_name"] . "</td>";
            echo "<td>Tsh " . $row["price"] . "</td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='5'>No orders found.</td></tr>";
        }

        $conn->close();
    }else{
        echo "your order will appear here";
    }
        ?>
    </tbody>
  </table>
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
        totalDisplay.textContent = "Total: Tsh" + total.toFixed(2); // Update total display
      } else { // Subtract the price if item is deselected
        total -= price;
        totalDisplay.textContent = "Total: Tsh" + total.toFixed(2); // Update total display
      }
    });
  });
});
</script>

</body>
</html>
