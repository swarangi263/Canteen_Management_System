<?php
include('../config/constants.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register.css">
    <title>Register</title>
</head>

<body>

    <div class="login">        
            <form action="" method="POST" class="text-center">
                    <div class="txtfield">
                        <label for="">Name</label>
                        <input type="text" name="name" value="" required>
                        <span></span>
                    </div>
                    <div class="txtfield">
                        <label for="Email">Email</label>
                        <input type="email" name="username" value="" required>
                        <span></span>
                    </div>
                    <div class="txtfield">
                        <label for="Password">Password</label>
                        <input type="password" name="pass" value="" required>
                        <span></span>
                    </div>
                    <div class="txtfield">
                        <label for="Contact_Details"> Contact Details</label>
                        <input type="number" name="contact" value="" required>
                        <span></span>
                    </div>
                    <input type="submit" name="submit" value="Register" class="btn btn-primary">
                    <div class="signup_link">
                        <a href="login.php">Already have an account?</a>
                    </div>
                    <div class="txtfield">
                        <label for="College">College</label> 
                        
                            <select name="college">
                                <option value="0">Select College</option>
                                <?php
                                //create code to display categories from db
                                //1.create sql to get all active queries from db
                                $sql = "SELECT * FROM colleges";
                                //executing query
                                $res = mysqli_query($conn, $sql);
                                //count rows
                                $count = mysqli_num_rows($res);

                                if ($count > 0) {
                                    //display
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        //get the details
                                        $id = $row['id'];
                                        $name = $row['name'];
                                ?>
                                        <!-- //2. display dropdown -->
                                        <option value="<?php echo $id; ?>"> <?php echo $name; ?> </option>
                                    <?php
                                    }
                                } else {
                                    //no values found
                                    ?>
                                    <option value="0">No Colleges Found</option>

                                <?php
                                }

                                ?>
                            </select>
                        
                    </div>
                    
                    
                
            </form>
            
    </div>

</body>

</html>

<?php

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['pass']); //pass encrypted with md5
    $contact = $_POST['contact'];
    $college = $_POST['college'];

    $input = "INSERT INTO users(name,email,password,contact,college) VALUES ('$name','$email','$password','$contact', '$college')";

    $result = mysqli_query($conn, $input) or die(mysqli_error($conn));

    if ($result == TRUE) {

        $_SESSION['add'] = "<div class= 'success'>Registered Successfully. </div>";

        // Redirect
        header('location:' . HOME_URL . 'php/index.php', true, 301);
    }

    echo ($input);
}
