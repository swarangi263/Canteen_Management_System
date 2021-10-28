<?php
include('../config/constants.php');

$user_id = $_GET['user_id'];
$item_id = $_GET['item_id'];
$quantity = $_GET['quantity'];
$total_item_price = $_GET['total_item_price'];

$sql = "UPDATE cart_items SET quantity ='$quantity', total_item_price = '$total_item_price' WHERE user_id = '$user_id' AND item_id = '$item_id' " ;

$res = mysqli_query($conn, $sql);

if ($res) {
    echo json_encode("Item updated");
} else {
    echo json_encode("Couldn't updated the item");
}