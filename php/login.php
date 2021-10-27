<?php
include("../config/constants.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css" type="text/css">

    <title>Login</title>

</head>

<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <?php

        if (isset($_SESSION['login'])) {

            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if (isset($_SESSION['no-login'])) {

            echo $_SESSION['no-login'];
            unset($_SESSION['no-login']);
        }

        ?>


        <!-- Login Form -->
        <form action="" method="POST" class="text-center">
            <div class="txtfield">    
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Enter Username" required>
                <span></span>
            </div>
            <div class="txtfield">    
                <label for="password">Password</label>
                <input type="Password" name="password" placeholder="Enter Password" required>
                <span></span>
            </div>
            <input type="submit" name="submit" value="Login" class="btn btn-primary"> <br />
        </form>
        <div class="signup_link">
        <a href="register.php">Create an account</a>
        </div>
    </div>
</body>

</html>


<?php
// Check whether submit button is pressed
if (isset($_POST['submit'])) {

    // Process for Login
    // 1.Get data from form
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    // 2. Query to check user exist
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND role = 1";

    // 3. Execute query
    $result = mysqli_query($conn, $sql);

    $row= mysqli_fetch_assoc($result);
    // print_r($result);

    // 4. Count to check user exists
    $num = mysqli_num_rows($result);

    if ($num == 1) {

        $_SESSION['login'] = "<div class ='success'>Login Successful. </div>";

        $_SESSION['user']= $email; //to check if user is logged in or not 
        
        $_SESSION['user_id']= $row['id'];
        
        $_SESSION['clg_id']= $row['college_id'];
        // while ($row = mysqli_fetch_assoc($result)) {
        //     //get the details
        //     $_SESSION["clg_id"] = $row['college'];
        // }

        // Redirect to home/dashboard
        header('location:' . HOME_URL . 'php/');
    } else {

        $_SESSION['login'] = "<div class ='error text-center'> Username or Password Not Matched OR Invalid User. </div>";

        // Redirect to home/dashboard
        header('location:' . HOME_URL . 'php/login.php');
    }
}
?>