<?php
include('../config/constants.php');

$college_id = $_GET['college_id'];

$sql = "SELECT menu_items.id, menu_items.name, menu_items.category_id, 
menu_items.image, menu_items.summary, menu_items.price, 
menu_items.availability, categories.name 
AS cat_name FROM menu_items 
JOIN categories ON menu_items.category_id = categories.id 
WHERE menu_items.college_id = $college_id;";

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
