<?php
    require_once("../config/constants.php");

    $contact= $_POST['contact'];
    $password =  md5($_POST['password']);

    $sql = "SELECT * from users Where contact = '$contact'";
    $res = mysqli_query($conn,$sql);
    $data = mysqli_fetch_assoc($res);
    if($data>0){
        $sql = "SELECT * from users where contact = '$contact' AND password = '$password'";
        $res = mysqli_query($conn,$sql);
        $data = mysqli_fetch_assoc($res);
        if($data>0)
        {
           echo json_encode($data['id']);
        }
        
        else{
            echo json_encode("wrong password");
        }
    }
    else
    {
        echo json_encode("dont have account");
    }

?>