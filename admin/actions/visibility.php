<?php
include_once('../../config.php');

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Fetch the current visibility status
    $sql = "SELECT visibility FROM product WHERE product_id = $product_id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $current_visibility = $row['visibility'];

        // Toggle visibility
        $new_visibility = ($current_visibility == 'visible') ? 'not visible' : 'visible';

        // Update the visibility status in the database
        $sql_update = "UPDATE product SET visibility = '$new_visibility' WHERE product_id = $product_id";
        if (mysqli_query($conn, $sql_update)) {
            header('Location: ../product.php?success=the product visible is changed'); // Redirect back to the product page
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "Error fetching record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
