<?php
include('../config/constants.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>

    <div class="main-content">
        <div class="wrapper">
            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Name</td>
                        <td><input type="text" name="name" value="" required></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="email" name="username" value="" required></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="pass" value="" required></td>
                    </tr>
                    <tr>
                        <td>Contact Details</td>
                        <td><input type="number" name="contact" value="" required></td>
                    </tr>
                    <tr>
                        <td>College</td>
                        <td>
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
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Register" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            <a href="login.php">Already have an account?</a>
        </div>
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
