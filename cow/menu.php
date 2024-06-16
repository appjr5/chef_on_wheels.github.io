<?php 
include 'dashboard/dashboard.php'; 
session_start(); // Ensure session_start is called before any output
?>
<!-- Main Content -->
<div class="container my-5">
  <h1 class="mt-5 text-center">Menu</h1>
  <form action="backend/menu.php" method="post">
  <!-- Food Section -->
  <section id="food" class="menu-section">
    <h2 class="mt-4 mb-3 text-center">Food</h2>
    <div class="row">
      <?php
        // Database connection
        include_once('../config.php');

        // Fetch food items from the database
        $sql_food = "SELECT product_id, product_name, product_image, price FROM product WHERE product_type='food'";
        $result_food = $conn->query($sql_food);

        if ($result_food->num_rows > 0) {
          // Output each food item as an image
          while($row = $result_food->fetch_assoc()) {
            echo '<div class="menu-item col-md-4">';
            echo '<input type="checkbox" class="checkbox" name="selected_items[]" value="' . $row["product_id"] . '">';
            echo '<img src="../admin/uploads/' . $row["product_image"] . '" alt="' . $row["product_name"] . '">';
            echo '<p>' . $row["product_name"] . '<br> Tsh ' . $row["price"] . '</p>';
            echo '</div>';
          }
        } else {
          echo "<p class='text-center'>No food items found.</p>";
        }
      ?>
    </div>
  </section>

  <!-- Dessert Section -->
  <section id="dessert" class="menu-section">
    <h2 class="mt-4 mb-3 text-center">Desserts</h2>
    <div class="row">
      <?php
        // Fetch dessert items from the database
        $sql_dessert = "SELECT product_id, product_name, product_image, price FROM product WHERE product_type='dessert'";
        $result_dessert = $conn->query($sql_dessert);

        if ($result_dessert->num_rows > 0) {
          // Output each dessert item as an image
          while($row = $result_dessert->fetch_assoc()) {
            echo '<div class="menu-item col-md-4">';
            echo '<input type="checkbox" class="checkbox" name="selected_items[]" value="' . $row["product_id"] . '">';
            echo '<img src="../admin/uploads/' . $row["product_image"] . '" alt="' . $row["product_name"] . '">';
            echo '<p>' . $row["product_name"] . '<br> Tsh ' . $row["price"] . '</p>';
            echo '</div>';
          }
        } else {
          echo "<p class='text-center'>No dessert items found.</p>";
        }
      ?>
    </div>
  </section>

  <!-- Drinks Section -->
  <section id="drinks" class="menu-section">
    <h2 class="mt-4 mb-3 text-center">Drinks</h2>
    <div class="row">
      <?php
        // Fetch drink items from the database
        $sql_drinks = "SELECT product_id, product_name, product_image, price FROM product WHERE product_type='drink'";
        $result_drinks = $conn->query($sql_drinks);

        if ($result_drinks->num_rows > 0) {
          // Output each drink item as an image
          while($row = $result_drinks->fetch_assoc()) {
            echo '<div class="menu-item col-md-4">';
            echo '<input type="checkbox" class="checkbox" name="selected_items[]" value="' . $row["product_id"] . '">';
            echo '<img src="../admin/uploads/' . $row["product_image"] . '" alt="' . $row["product_name"] . '">';
            echo '<p>' . $row["product_name"] . '<br> Tsh ' . $row["price"] . '</p>';
            echo '</div>';
          }
        } else {
          echo "<p class='text-center'>No drink items found.</p>";
        }

        // Close the database connection
      ?>
    </div>
  </section>
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
      $total = 0;
      if(isset($_GET['order_id'])){
        include_once('../config.php');
        $order_id = $_GET['order_id'];
        
        // Check if the user_id session variable is set
        if(isset($_SESSION["user_id"])) {
          $user_id = $_SESSION["user_id"];
        } else {
          // Handle the case where user_id is not set
          echo "<tr><td colspan='3'>User not logged in.</td></tr>";
          exit;
        }

        // Fetch orders and related items from the database
        $sql = "SELECT o.order_id, o.order_time, oi.product_id, p.product_name, p.price, 
                       (SELECT COUNT(*) FROM orders WHERE user_id = $user_id) AS order_count
                FROM orders o
                INNER JOIN order_items oi ON o.order_id = oi.order_id
                INNER JOIN product p ON oi.product_id = p.product_id 
                WHERE o.order_id = $order_id 
                AND o.user_id = $user_id
                GROUP BY o.order_id, o.order_time, oi.product_id, p.product_name, p.price";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          $order_count = 0;
          while ($row = $result->fetch_assoc()) {
            $total += $row["price"];
            $order_count = $row["order_count"];
            echo "<tr>";
            echo "<td>" . $row["order_time"] . "</td>";
            echo "<td>" . $row["product_name"] . "</td>";
            echo "<td>Tsh " . $row["price"] . "</td>";
            echo "</tr>";
          }

          if($order_count > 1){
            $discount = $total * 0.05;
            $total -= $discount;
            echo "<tr><td colspan='3' class='text-right'><strong>Discount: Tsh " . number_format($discount, 2) . "</strong></td></tr>";
          }
          echo "<tr><td colspan='3' class='text-right'><strong>Total: Tsh " . number_format($total, 2) . "</strong></td></tr>";
        } else {
          echo "<tr><td colspan='3'>No orders found.</td></tr>";
        }

        echo '<tr><td colspan="3" class="text-center">';
        echo '<a class="btn btn-danger" href="../admin/actions/delete.php?order_id=' . $order_id . '" onclick="return confirm(\'Are you sure you want to cancel this order?\')">Cancel the order</a>';
        echo '</td></tr>';

        $conn->close();
      } else {
        echo "<tr><td colspan='3'>Your order will appear here.</td></tr>";
      }
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
  let total = 0;
  const totalDisplay = document.getElementById("totalDisplay");

  menuItems.forEach(item => {
    const checkbox = item.querySelector("input[type='checkbox']");
    const image = item.querySelector("img");
    const priceText = item.querySelector("p").textContent.trim();
    const price = parseFloat(priceText.match(/\d+(\.\d+)?/)[0]);

    function updateTotal(isSelected) {
      if (isSelected) {
        total += price;
      } else {
        total -= price;
      }
      totalDisplay.textContent = "Total: Tsh " + total.toFixed(2);
    }

    image.addEventListener("click", function() {
      checkbox.checked = !checkbox.checked;
      item.classList.toggle("selected");
      updateTotal(checkbox.checked);
    });

    checkbox.addEventListener("change", function() {
      item.classList.toggle("selected");
      updateTotal(checkbox.checked);
    });
  });
});
</script>
</body>
</html>
