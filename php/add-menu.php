<?php include('partials/navbar.php'); ?>

<link rel="stylesheet" href="../css/add-menu.css">

<div class="login">
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
        $college_id =  $_SESSION['clg_id'];

        ?>


        <form action="" method="POST" enctype="multipart/form-data">

            <div class="txtfield">
                <label for=""> Name </label>
                <input type="text" name="name" placeholder="Food Title">
            </div>

            <div class="txtfield">
                <label for=""> Summary </label>
                <br>
                <textarea style="resize:none" name="summary" cols="20" rows="3" placeholder="Enter Summary" style="display: flex;"></textarea>

            </div>

            <div class="txtfield">
                <label for=""> Price </label>
                <input type="number" name="price" placeholder="Enter Price">
            </div>

            <div class="txtfield">
                <label for=""> Select Image </label>
                <input type="file" name="image">
            </div>
            <div class="txtfield">
                <label for="">Availability </label>
                <input type="radio" name="status" value="1">Yes
                <input type="radio" name="status" value="0">No
            </div>

            <label for="">Category</label>

            <select name="category">
                <option value="0">Select Category</option>
                <?php

                $sql = "SELECT * FROM categories WHERE college_id = '$college_id' ";

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



            <input type="submit" name="submit" value="Submit">

            <?php

            if (isset($_POST['submit'])) {
                // button clicked
                // 1. get data
                $name = $_POST['name'];
                $summary = $_POST['summary'];
                $price = $_POST['price'];
                $category_id = $_POST['category'];

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

                        $destination_path = "../img/" . $image;

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

                $input = "INSERT INTO menu_items(name,category_id,college_id,image, summary,price,availability) 
                VALUES ('$name','$category_id','$college_id','$image','$summary','$price','$status')";

                // 3. execute query and saving data in db

                $result = mysqli_query($conn, $input) or die(mysqli_error($conn));

                // 4. check if data is added and executed query
                if ($result == TRUE) {
                    // Data inserted
                    // Create session variable
                    $_SESSION['add'] = "<div class= 'success'>Item Added Successfully. </div>";

                    // Redirect
                    header('location:' . HOME_URL . 'php/add-menu.php');
                } else {

                    $_SESSION['add'] = "<div class= 'error'>Failed to Add Category. </div>";

                    // Redirect
                    header('location:' . HOME_URL . 'php/add-menu.php');
                }
            }
            ?>

        </form>

    </div>
</div>

<div class="hoverbutton">
    <a href="category.php" target="_blank" class="float">Add Category</a>
</div>

<?php include('partials/footer.php'); ?>