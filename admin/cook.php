<?php include('layout/dashboard.php'); ?>
<!-- Content -->
<div class="container-fluid">
  <h2>Orders Table</h2>
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Order Time</th>
          <th>Product Name</th>
          <th>Price</th>
          <th>Status</th> <!-- New column for status -->
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
          $sqlUpdate = "UPDATE orders SET status='$status' WHERE order_id='$orderId' ";
          $conn->query($sqlUpdate);
        }

        // Fetch orders and related items from the database
        $sql = "SELECT o.order_id, o.order_time, oi.product_id, p.product_name, p.price, o.status
                FROM orders o
                INNER JOIN order_items oi ON o.order_id = oi.order_id
                INNER JOIN product p ON oi.product_id = p.product_id
                WHERE status IS NULL 
                ORDER BY o.order_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["order_id"] . "</td>";
            echo "<td>" . $row["order_time"] . "</td>";
            echo "<td>" . $row["product_name"] . "</td>";
            echo "<td>$" . $row["price"] . "</td>";
            echo "<td>";
            // Form for updating status
            echo "<form method='post' action='" . $_SERVER["PHP_SELF"] . "'>";
            echo "<input type='hidden' name='order_id' value='" . $row["order_id"] . "'>";
            echo "<select name='status' class='form-control'>";
            echo "<option value='pending'" . ($row["status"] == "pending" ? " selected" : "") . ">Pending</option>";
            echo "<option value='ready'" . ($row["status"] == "ready" ? " selected" : "") . ">Ready</option>";
            echo "</select>";
            echo "<button type='submit' class='btn btn-primary mt-1'>Update</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='6'>No orders found.</td></tr>";
        }

        $conn->close();
        ?>
      </tbody>
    </table>
  </div>
</div>
<!-- End Content -->

<?php include('layout/footer.php'); ?>
