<?php include('layout/dashboard.php'); ?>
<!-- Content -->
<div class="container-fluid">
  <h2>Orders Table</h2>

  <!-- Message Div -->
  <?php if (isset($_GET['success'])): ?>
  <div id="message" class="alert alert-info">
    <?php echo htmlspecialchars($_GET['success']); ?>
  </div>
  <?php endif; ?>

  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Order Time</th>
          <th>Product Name</th>
          <th>Price</th>
          <th>Status</th>
          <th>Token</th> <!-- New column for token -->
          <th>Action</th> <!-- New column for action -->
        </tr>
      </thead>
      <tbody>
        <?php
        // Database connection
        include_once('../config.php');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // Update status if form is submitted
          $orderId = $_POST["order_id"];
          $status = $_POST["status"];
          // Check if token matches before updating status
          $token = $_POST["token"];
          $sqlCheckToken = "SELECT order_id, order_token FROM orders WHERE order_id='$orderId' AND order_token='$token'";
          $resultToken = $conn->query($sqlCheckToken);
          if ($resultToken->num_rows > 0) {
            $sqlUpdate = "UPDATE orders SET status='$status' WHERE order_id='$orderId'";
            if ($conn->query($sqlUpdate) === TRUE) {
              header('Location: delivery.php?success=Status updated successfully.');
            } else {
              header('Location: delivery.php?success=Error updating status.');
            }
          } else {
            header('Location: delivery.php?success=Invalid token or status not ready.');
          }
          exit();
        }

        // Fetch orders and related items from the database
        $sql = "SELECT o.order_id, o.order_time, GROUP_CONCAT(p.product_name SEPARATOR ', ') AS product_names, 
                       SUM(p.price) AS total_price, o.status, o.order_token, COUNT(*) AS order_count
                FROM orders o
                INNER JOIN order_items oi ON o.order_id = oi.order_id
                INNER JOIN product p ON oi.product_id = p.product_id
                WHERE status='ready'
                GROUP BY o.order_id, o.order_time, o.status, o.order_token
                ORDER BY o.order_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $totalPrice = $row["total_price"];
            $orderCount = $row["order_count"];

            // Apply discount if user has ordered more than once
            if ($orderCount > 1) {
              $totalPrice *= 0.9; // 10% discount
            }
            echo "<tr>";
            echo "<form method='post' action='" . $_SERVER["PHP_SELF"] . "'>";
            echo "<td>" . $row["order_id"] . "</td>";
            echo "<td>" . $row["order_time"] . "</td>";
            echo "<td>" . $row["product_names"] . "</td>";
            echo "<td>$" . number_format($totalPrice, 2) . "</td>"; // Display total price
            echo "<td>" . ($row["status"] ? $row["status"] : "Pending") . "</td>"; // Display status or "Pending"
            echo "<td>";
            echo "<input type='text' name='token' placeholder='Enter token'>";
            echo "</td>"; // Include token input
            echo "<td>";
            // Form for updating status
            echo "<input type='hidden' name='order_id' value='" . $row["order_id"] . "'>";
            echo "<select name='status' class='form-control'>";
            echo "<option value='in transit'" . ($row["status"] == "in transit" ? " selected" : "") . ">In Transit</option>";
            echo "<option value='delivered'" . ($row["status"] == "delivered" ? " selected" : "") . ">Delivered</option>";
            echo "</select>";
            echo "<button type='submit' class='btn btn-primary mt-1'>Update</button>";
            echo "</td>";
            echo "</form>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='7'>No orders found.</td></tr>";
        }

        $conn->close();
        ?>
      </tbody>
    </table>
  </div>
</div>
<!-- End Content -->

<!-- Use full version of jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  // Hide the message div after 5 seconds
  setTimeout(function() {
    $('#message').fadeOut('slow');
  }, 5000);
});
</script>

<?php include('layout/footer.php'); ?>
