<?php

session_start();
// Database connection
include_once('../../config.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data

  $user_id = $_SESSION["user_id"];
  // Generate random 6-digit token
  $order_token = rand(100000, 999999);

  // Insert data into orders table
  $sql_order = "INSERT INTO orders (user_id, order_token) VALUES (?, ?)";
  $stmt_order = $conn->prepare($sql_order);
  $stmt_order->bind_param("ii", $user_id, $order_token);

  if ($stmt_order->execute()) {
    // Get the inserted order id
    $order_id = $stmt_order->insert_id;

    // Insert order items into order_items table
    if(isset($_POST['selected_items']) && is_array($_POST['selected_items'])) {
      foreach($_POST['selected_items'] as $product_id) {
        $sql_items = "INSERT INTO order_items (order_id, product_id) VALUES (?, ?)";
        $stmt_items = $conn->prepare($sql_items);
        $stmt_items->bind_param("ii", $order_id, $product_id);
        $stmt_items->execute();
      }
    }

    header("location: ../menu.php?order_id=$order_id");
    exit();
  } else {
    echo "Error: " . $sql_order . "<br>" . $conn->error;
  }

  $stmt_order->close();
}

$conn->close();
?>
