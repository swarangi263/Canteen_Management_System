<?php
include('../config/constants.php');

$college_id = $_GET['college_id'];

$sql = "SELECT * FROM categories WHERE college_id = $college_id";

$res = mysqli_query($conn, $sql);

$count = mysqli_num_rows($res);

$arr = array();
$i = 0;

while ($row = mysqli_fetch_assoc($res)) {

    $arr[$i]['id'] =  $row['id'];
    $arr[$i]['name'] =  $row['name'];
    $arr[$i]['image'] =  $row['image'];

    $i++;
}

if (count($arr) < 0) {
    echo json_encode('null');
} else {
    echo json_encode($arr);
}
