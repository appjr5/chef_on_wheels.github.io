<?php

include_once('../../config.php');


if(isset($_GET['user_id'])){

$user_id=$_GET['user_id'];
 $sql="DELETE FROM `users` WHERE `users`.`user_id` = $user_id" ;
//  $sql="delete  from  owners  where id='$id'";
}
elseif($_GET['product_id']){

    $product_id=$_GET['product_id'];
 $sql="DELETE FROM `product` WHERE product_id = $product_id" ;
}
 $result=mysqli_query($conn,$sql);

if($result){
    header('location:../users.php?success="yes"');
}
else{
    echo 'the person you want to delete is emmortal';
}
