<?php
include('../config/constants.php');

$category_id = $_GET['category_id'];

$sql = "SELECT * FROM menu_items WHERE category_id = $category_id;";

$res = mysqli_query($conn, $sql);

$count = mysqli_num_rows($res);

$arr = array();
$i = 0;

while ($row = mysqli_fetch_assoc($res)) {

    $arr[$i]['id'] =  $row['id'];
    $arr[$i]['name'] =  $row['name'];
    $arr[$i]['image'] =  $row['image'];
    $arr[$i]['summary'] =  $row['summary'];
    $arr[$i]['price'] =  $row['price'];
    $arr[$i]['availability'] =  $row['availability'];

    $i++;
}

if (count($arr) < 0) {
    echo json_encode('null');
} else {
    echo json_encode($arr);
}
