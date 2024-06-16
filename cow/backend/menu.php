<?php
session_start(); // Ensure session_start is called before any output
include_once('../../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selected_items'])) {
  // Retrieve user_id from session
  if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
  } else {
    header("location: ../menu.php?success=please log in to place an order");
    exit();
  }

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
    foreach ($_POST['selected_items'] as $product_id) {
      $sql_items = "INSERT INTO order_items (order_id, product_id) VALUES (?, ?)";
      $stmt_items = $conn->prepare($sql_items);
      $stmt_items->bind_param("ii", $order_id, $product_id);
      $stmt_items->execute();
    }

    // Redirect with success message
    header("location: ../menu.php?order_id=$order_id&success=Order placed successfully. Wait for your order!");
    exit();
  } else {
    // Handle errors
    echo "Error inserting order: " . $stmt_order->error;
  }

  $stmt_order->close();
} else {
  // If no items selected, redirect back with message
  header("location: ../menu.php?success=Please select items before submitting your order");
  exit();
}

$conn->close();
?>
