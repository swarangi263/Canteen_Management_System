<?php
include('../config/constants.php');

$user_id = $_POST['user_id'];
$college_id = $_POST['college_id'];
$item_id = $_POST['item_id'];
$quantity = $_POST['quantity'];
$total_item_price = $_POST['total_item_price'];

$sql = "SELECT * FROM cart_items WHERE user_id = '$user_id' AND item_id = '$item_id'";

$res = mysqli_query($conn, $sql);

if (mysqli_fetch_assoc($res) > 0) {
    echo json_encode("Item already added");
} else {
    $sql = "INSERT INTO cart_items(user_id,college_id,item_id,quantity,total_item_price) VALUES('$user_id','$college_id','$item_id','$quantity','$total_item_price') ";

    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo json_encode("Added to cart");
    } else {
        echo json_encode("Couldn't add the item");
    }
}
