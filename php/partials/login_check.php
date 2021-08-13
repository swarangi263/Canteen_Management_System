<?php
    // Authorization - Access Control
    // check whether user is logged in or out

    if(!isset($_SESSION['user']))//if user session is not set
    {
        // User is not logged in
        // redirect to login pg 

        $_SESSION['no-login'] = "<div class ='error text-center'> Please Login to Access Admin Panel. </div>";
            
        // Redirect to home/dashboard
        header('location:'.HOME_URL.'php/login.php');

    }
    
?>