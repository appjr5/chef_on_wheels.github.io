<?php

include_once('../../config.php');

if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $sql = "DELETE FROM `users` WHERE `users`.`user_id` = $user_id";
    $result = mysqli_query($conn, $sql);

    if($result) {
        header('location:../user.php?success="deleted"');
    } else {
        echo 'The user you want to delete is immortal';
    }
} elseif(isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $sql = "DELETE FROM `product` WHERE product_id = $product_id";
    $result = mysqli_query($conn, $sql);

    if($result) {
        header('location:../product.php?success="deleted"');
    } else {
        echo 'The product you want to delete is immortal';
    }
} elseif(isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $sql = "DELETE FROM `orders` WHERE order_id = $order_id";
    $result = mysqli_query($conn, $sql);

    if($result) {
        header('location:../../cow/menu.php?success="deleted"');
    } else {
        echo 'The order you want to delete is immortal';
    }
} else {
    echo 'Invalid request';
}

?>
