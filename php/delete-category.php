<?php

// echo 'Delete Category';
include('../config/constants.php');

// echo 'Delete Menu Item';

//Check whether the id and image name is set or not 

if (isset($_GET['id']) and isset($_GET['image'])) {
    //Get the value and delete
    $id = $_GET['id'];
    $image = $_GET['image'];

    //remove the physical image file if available
    if ($image != "") {

        //image is available so remove it
        $path = "../img/" . $image;

        //remove image
        $remove = unlink($path);

        //if error show msg and stop process
        if ($remove == FALSE) {
            //set session msg
            $_SESSION['remove'] = "<div class='error'>Failed to Remove Image</div>";
            //redirect
            header('location:' . HOME_URL . 'php/category.php', true, 301);
            //stop
            die();
        }
        //delete data from db

        // 2. create query to delete
        $sql = "DELETE FROM categories WHERE id = $id";

        $result = mysqli_query($conn,$sql);
        
        //check for query
        if($result==TRUE){
            // echo $id.' Deleted';
            // create session variable to display message
            $_SESSION['delete'] = "<div class='success'>Category Deleted</div>" ;
            header('location:'.HOME_URL.'php/category.php',true,301);
    
        }
        else{
            $_SESSION['delete'] = "<div class='error'>Error in Deleting</div>" ;
            header('location:'.HOME_URL.'php/category.php',true,301);
        }
    }
    else{
        $sql = "DELETE FROM categories WHERE id = $id";

        $result = mysqli_query($conn,$sql);
        
        //check for query
        if($result==TRUE){
            // echo $id.' Deleted';
            // create session variable to display message
            $_SESSION['delete'] = "<div class='success'>Category Deleted</div>" ;
            header('location:'.HOME_URL.'php/category.php',true,301);
    
        }
        else{
            $_SESSION['delete'] = "<div class='error'>Error in Deleting</div>" ;
            header('location:'.HOME_URL.'php/category.php',true,301);
        }
    }
} else {
    //Redirect to Menu Page
    header('location:' . HOME_URL . 'php/category.php');
    
}

?>