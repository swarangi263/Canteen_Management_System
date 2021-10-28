<?php
include('../config/constants.php');
$id = $_POST['id'];
$sql = "SELECT * FROM users where id = '$id'";

$res = mysqli_query($conn, $sql);

$arr = array();
$i = 0;
if($res){
while ($row = mysqli_fetch_assoc($res)) {

    $arr[$i]['id'] =  $row['id'];
    $arr[$i]['name'] =  $row['name'];
    $arr[$i]['email'] = $row['email'];
    $arr[$i]['collegeId'] = $row['college_id'];
    $arr[$i]['contact'] = $row['contact'];
    $i++;
}
if($arr == null){
    echo json_encode('null');
}else{
    echo json_encode($arr);
}
}else{
    echo json_encode("Something went wrong");
}

