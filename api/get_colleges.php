<?php
include('../config/constants.php');

$sql = "SELECT * FROM colleges";

$res = mysqli_query($conn, $sql);

$arr = array();
$i = 0;

while ($row = mysqli_fetch_assoc($res)) {

    $arr[$i]['id'] =  $row['id'];
    $arr[$i]['name'] =  $row['name'];

    $i++;
}

if (count($arr) < 0) {
    echo json_encode('null');
} else {
    echo json_encode($arr);
}
