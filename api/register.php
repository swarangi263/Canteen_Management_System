<?php
include('../config/constants.php');

$name = $_POST['name'];
$email = $_POST['email'];
$password = md5($_POST['pass']); //pass encrypted with md5
$contact = $_POST['contact'];
$college = $_POST['college'];

$sql = "SELECT * FROM users WHERE contact = '$contact' ";
$res = mysqli_query($conn, $sql);

if (mysqli_fetch_assoc($res)>0) {
    echo json_encode("Account already exist");
} 
else {
    $input = "INSERT INTO users(name,email,password,contact,college_id) VALUES ('$name','$email','$password','$contact', '$college')";
    $res = mysqli_query($conn, $input);
    if ($res) {
          
       echo json_encode(mysqli_insert_id($conn));
    }
    else{
        echo json_encode("Something Went Wrong");
    }
}


// else {
//    
//     if ($res == TRUE) {
//         $data = "SELECT * WHERE contact='$contact'";
//         $user = mysqli_query($conn, $data);

//         // if(mysqli_num_rows($user)==1){
//         //     while($row = mysqli_fetch_assoc($user)){
//         //         echo json_encode($row['id']);
//         //     }
//         // }
//         // else{
//         //     echo json_encode("Something Went Wrong");
//         // }
        
//     } 
//     else {

//         
//     }
// }
