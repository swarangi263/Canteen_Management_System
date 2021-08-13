<?php include('partials/navbar.php'); ?>

<script src="../js/add-menu.js"></script>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Menu</h1>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>
        <a href="add-category.php" target="_blank" class="btn-primary text-center"><button>Add Category</button></a>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" placeholder="Food Title"></td>
                </tr>

                <tr>
                    <td>Summary</td>
                    <td>
                        <textarea style="resize:none" name="summary" cols="20" rows="3" placeholder="Enter Summary" style="display: flex;"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td><input type="number" name="price" placeholder="Enter Price"></td>
                </tr>

                <tr>
                    <td>Select Image</td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category">
                            <option value="0">Select Category</option>
                            <?php

                            $sql = "SELECT * FROM categories";

                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    //get the details
                                    $id = $row['id'];
                                    $name = $row['name'];
                            ?>
                                    <option value="<?php echo $id; ?>"> <?php echo $name; ?> </option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No Category Found</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Availability</td>
                    <td>
                        <input type="radio" name="status" value="1">Yes
                        <input type="radio" name="status" value="0">No
                    </td>
                </tr>
                <tr>
                    <td><button type="button" name="add" onclick="addNext()" class="btn-secondary">Add Item</button></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Add Menu"></td>
                </tr>
                <?php

                if (isset($_POST['submit'])) {
                    // button clicked
                    // 1. get data
                    $name = $_POST['name'];

                    if (isset($_POST['status'])) {
                        //Get value from form
                        $status = $_POST['status'];
                    } else {
                        //set default value
                        $status = "No";
                    }

                    //check whether image is selected or not and set the value for image name acc
                    //print_r($_FILES['image']);
                    //die();

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
                            $image = "Canteen_Menu" . rand(000, 999) . '.' . $ext;

                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = "../assets/images" . $image;

                            //Finally upload image
                            $upload = move_uploaded_file($source_path, $destination_path);

                            //check if uploaded or not
                            //if not uploaded then we will stop the process and redirect with error message
                            if ($upload == FALSE) {

                                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";

                                // Redirect
                                header('location:' . HOME_URL . 'php/add-menu.php');
                                //stop the process
                                die();
                            }
                        }
                    } else {
                        //don't upload image and set name as blank

                        $image = "";
                    }

                    //2.query to insert into db

                    $input = "INSERT INTO menus(name,summary,status,image,price) VALUES ('$name','$summary','$status', '$image', '$price')";

                    // 3. execute query and saving data in db

                    $result = mysqli_query($conn, $input) or die(mysqli_error($conn));

                    // 4. check if data is added and executed query
                    if ($result == TRUE) {
                        // Data inserted
                        // Create session variable
                        $_SESSION['add'] = "<div class= 'success'>Item Added Successfully. </div>";

                        // Redirect
                        header('location:' . HOME_URL . 'php/index.php');
                    } else {

                        $_SESSION['add'] = "<div class= 'error'>Failed to Add Category. </div>";

                        // Redirect
                        header('location:' . HOME_URL . 'php/add-menu.php');
                    }
                }
                ?>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>