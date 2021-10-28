<?php
include('../config/constants.php');

$user_id = $_GET['user_id'];
$item_id = $_GET['item_id'];

$sql = "DELETE FROM cart_items WHERE user_id = '$user_id' AND item_id = '$item_id'";

$res = mysqli_query($conn, $sql);

if ($res) {
    echo json_encode("Item deleted from cart");
} else {
    echo json_encode("Couldn't delete the item");
}
