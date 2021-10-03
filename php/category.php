<?php include('partials/navbar.php'); ?>
<link rel="stylesheet" href="../css/category.css">
<div class="title">
    <h1>Categories</h1>
</div>
<div class="menutable">
    <table>
        <tr>
            <th>Sr No</th>
            <th>Category</th>
            <th>Image</th>
            <th>Edit</th>
        </tr>

        <?php

        $college_id = $_SESSION['clg_id'];

        $sql = "SELECT * FROM categories  WHERE college_id = $college_id;";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if ($count == 0) {
        ?>

            <h2>Please Add Categories</h2>

            <?php
        } else {
            $i = 1;

            while ($row = mysqli_fetch_assoc($res)) {

                $id = $row['id'];
                $cat = $row['name'];
                $image = $row['image'];
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $cat; ?></td>
                    <td></td>
                    <td><a href="#"><i class="fas fa-edit fa-lg"></i> </a> &nbsp; <a href="delete-category.php?id=<?php echo $id; ?>&image=<?php echo $image; ?>"><i class="fas fa-trash fa-lg"></i></a></td>
                </tr>

        <?php
                $i++;
            }
        }

        ?>

    </table>

</div>

<div class="main-content">
    <div class="wrapper">

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        $college_id =  $_SESSION['clg_id'];

        ?>


        <form action="" method="POST" enctype="multipart/form-data">
            <div class="txtfield">
                <label for=""> Name </label>
                <input type="text" name="name" placeholder="Food Title">
            </div>
            <div class="txtfield">
                <label for=""> Select Image </label>
                <input type="file" name="image">
            </div>

            <input type="submit" name="submit" value="Add Category">

            <?php
            // process the value and save it in database
            // check whether the button is clicked or not

            if (isset($_POST['submit'])) {

                $name = $_POST['name'];

                if (isset($_FILES['image']['name'])) {

                    //Upload image
                    //to upload we need image name, source path and destination path
                    $image = $_FILES['image']['name'];

                    //upload the image only if image is selected
                    if ($image != '') {


                        //auto rename image
                        //get the extension of image(jpg, png, gif, etc)
                        $ext = end(explode('.', $image));

                        //rename image
                        $image = "Canteen_Menu_Category" . rand(000, 999) . '.' . $ext;

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../img/" . $image;

                        //Finally upload image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //check if uploaded or not
                        //if not uploaded then we will stop the process and redirect with error message
                        if ($upload == FALSE) {

                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";

                            // Redirect
                            header('location:' . HOME_URL . 'php/category.php');
                            //stop the process
                            die();
                        }
                    }
                } else {
                    //don't upload image and set name as blank

                    $image = "";
                }

                $input = "INSERT INTO categories(name,image,college_id) VALUES ('$name','$image',$college_id')";

                // 3. execute query and saving data in db

                $result = mysqli_query($conn, $input) or die(mysqli_error($conn));

                // 4. check if data is added and executed query
                if ($result == TRUE) {
                    // Data inserted
                    // Create session variable
                    $_SESSION['add'] = "<div class= 'success'>Category Added Successfully. </div>";

                    // Redirect
                    header('location:' . HOME_URL . 'php/add-menu.php');
                } else {

                    $_SESSION['add'] = "<div class= 'error'>Failed to Add Category. </div>";

                    // Redirect
                    header('location:' . HOME_URL . 'php/category.php');
                }
            }
            ?>
        </form>


    </div>
</div>


<?php include('partials/footer.php'); ?>