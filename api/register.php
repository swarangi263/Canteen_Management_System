<?php
include('../config/constants.php');

$name = $_POST['name'];
$email = $_POST['email'];
$password = md5($_POST['pass']); //pass encrypted with md5
$contact = $_POST['contact'];
$college = $_POST['college'];

$input = "INSERT INTO users(name,email,password,contact,college_id) VALUES ('$name','$email','$password','$contact', '$college')";

$res = mysqli_query($conn, $input);


if ($res == TRUE) {

    echo "Registered Successfully";
} else {

    echo "Please try again";
}