<?php
include('../config/constants.php');

$contact= $_POST['contact'];

$password =md5($_POST['password']);

$sql = "SELECT * FROM users WHERE contact = '$contact' AND password = '$password' AND role = 1";

$result = mysqli_query($conn, $sql);

$row= mysqli_fetch_assoc($result);

$num = mysqli_num_rows($result);


if($num == 1){
   
    echo json_encode("Logged In Successfully");
}
else{
    echo json_encode("dont have an account");
}

?>