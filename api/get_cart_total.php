<?php
include('../config/constants.php');

$user_id = $_GET['user_id'];

$sql = "SELECT SUM(total_item_price) as total FROM cart_items WHERE user_id = '$user_id' ";

$res = mysqli_query($conn, $sql);

if ($res) {

    $total = mysqli_fetch_assoc($res);
    echo json_encode($total['total']);
}else{
    echo json_encode("error");
}