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
          <th>Product ID</th>
          <th>Product Name</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Database connection
        include_once('../config.php');

        // Fetch orders and related items from the database
        $sql = "SELECT o.order_id, o.order_time, oi.product_id, p.product_name, p.price
                FROM orders o
                INNER JOIN order_items oi ON o.order_id = oi.order_id
                INNER JOIN product p ON oi.product_id = p.product_id 
                ORDER BY o.order_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["order_id"] . "</td>";
            echo "<td>" . $row["order_time"] . "</td>";
            echo "<td>" . $row["product_id"] . "</td>";
            echo "<td>" . $row["product_name"] . "</td>";
            echo "<td>$" . $row["price"] . "</td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='5'>No orders found.</td></tr>";
        }

        $conn->close();
        ?>
      </tbody>
    </table>
  </div>
</div>
<!-- End Content -->

<?php include('layout/footer.php'); ?>
