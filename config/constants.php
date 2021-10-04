<?php
// start session
session_start();


// Create constants to store Non Repeating Values
define('HOME_URL','http://localhost/Canteen_Automation-main/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','canteen_automation');
// define('HOME_URL','http://localhost/Canteen_Automation-main/');
// define('HOST','sql304.iceiy.com');
// define('DB_USERNAME','icei_29920603');
// define('DB_PASSWORD','CAS@1234');
// define('DB_NAME','icei_29920603_canteen_automation');

$conn = mysqli_connect("localhost","root","") or die(mysqli_error($conn)); //db connection
    
mysqli_select_db($conn,"canteen_automation") or die(mysqli_error($conn)); //selecting db


?>

