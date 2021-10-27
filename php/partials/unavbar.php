<?php
include('../config/constants.php');
include('login_check.php'); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Canteen Automation</title>
    
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/style.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"/>

</head>

<body>
    <!---Menu Section------>
    <div class="navigator">
        <div class="logo">
            CAS
        </div>
        <div class="page">
            <ul>
                <li><a href="umenu.php">Menu</a></li>
                <li><a href="transactionhistorypage.php">History</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>