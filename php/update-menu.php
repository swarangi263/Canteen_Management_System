<?php
include('partials/navbar.php');

if (isset($_SESSION['upload'])) {
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}

// echo 'Update Menu';
$college_id =  $_SESSION['clg_id'];
if (isset($_GET['id'])) {
    // get id of and all details

    $id = $_GET['id'];

    $sql = "SELECT * FROM menu_items WHERE id = $id";
    $res = mysqli_query($conn, $sql);

    // check query executed
    if ($res == TRUE) {
        // data is available
        $count = mysqli_num_rows($res);
        // check whether admin data is present or not
        if ($count == 1) {
            // get the details
            $row = mysqli_fetch_assoc($res);

            $item = $row['name'];
            $category = $row['category_id'];
            $curr_image = $row['image'];
            $summary = $row['summary'];
            $price = $row['price'];
            $availability = $row['availability'];
        } else {
            // redirect with msg
            $_SESSION['no-item'] = "<div class = 'error'>Menu Item not found</div>";
            header('location:' . HOME_URL . 'php/menu.php', true, 301);
        }
    }
} else {
    //redirect to manage category
    header('location:' . HOME_URL . 'php/menu.php', true, 301);
}

?>
<link rel="stylesheet" href="../css/add-menu.css">
<div class="login">
    <h1>Update Menu</h1>
    <form action="" method="POST" enctype="multipart/form-data">

        <div class="txtfield">
            <label for=""> Name </label>
            <input type="text" name="name" value="<?php echo $item; ?>">
        </div>

        <div class="txtfield">
            <label for=""> Summary </label>
            <br>
            <textarea style="resize:none" name="summary" cols="20" rows="3" value = "" style="display: flex;"><?php echo $summary; ?> </textarea>

        </div>

        <div class="txtfield">
            <label for=""> Price </label>
            <input type="number" name="price" value="<?php echo $price; ?>">
        </div>

        <div class="txtfield">
            <?php
            if ($curr_image != '') {
                //display image
            ?>
                <img src="../img/<?php echo $curr_image; ?>" width="150px">
            <?php
            } else {
                //display msg
                echo "<div class = 'error'>Image Not Added. </div>";
            }
            ?> <br />
            <label for=""> Select Image </label>
            <input type="file" name="image">
        </div>
        <div class="txtfield">
            <label for="">Availability </label>
            <input <?php if ($availability == "1") {
                        echo "checked";
                    } ?> type="radio" name="availability" value="1">Yes
            <input <?php if ($availability == "0") {
                        echo "checked";
                    } ?> type="radio" name="availability" value="0">No
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
                    <option <?php if ($category == $id) {
                                echo "selected";
                            } ?> value="<?php echo $id; ?>"> <?php echo $name; ?> </option>
                <?php
                }
            } else {
                ?>
                <option value="0">No Category Found</option>
            <?php
            }
            ?>
        </select>

        <input type="submit" name="submit" value="Update">
        <input type="hidden" name="curr_image" value="<?php echo $curr_image; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <?php

        if (isset($_POST['submit'])) {
            // button clicked

            // 1. get data
            $id = $_POST['id'];
            $name = $_POST['name'];
            $summary = $_POST['summary'];
            $price = $_POST['price'];
            $category_id = $_POST['category'];
            $availability = $_POST['availability'];

            print_r($availability);

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
                        header('location:' . HOME_URL . 'php/update-menu.php');
                        //stop the process
                        die();
                    }

                    //2. remove old image if available
                    if ($curr_image != '') {
                        $remove_path = "../img/" . $curr_image;

                        //remove image
                        $remove = unlink($remove_path);

                        //if error show msg and stop process
                        if ($remove == FALSE) {
                            //set session msg
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to Remove Category Image</div>";
                            //redirect
                            header('location:' . HOME_URL . 'php/update-menu.php', true, 301);
                            //stop
                            die();
                        }
                    }
                }
                else{
                    $image = $curr_image;
                }
            } else {
                //don't upload image and set name as blank

                $image = $curr_image;
            }

            //3.query to update into db

            $input = "UPDATE menu_items
            SET name = '$name',
            category_id = '$category_id',
            college_id = '$college_id',
            image = '$image',
            summary = '$summary',
            price = '$price',
            availability = '$availability' 
            WHERE id = '$id' ";

            // 4. execute query 
            $result = mysqli_query($conn, $input) or die(mysqli_error($conn));

            // 5. check if data is added and executed query
            if ($result == TRUE) {
                // Data inserted
                // Create session variable
                $_SESSION['update'] = "<div class= 'success'>Item Updated Successfully. </div>";

                // Redirect
                header('location:' . HOME_URL . 'php/menu.php');
            } else {

                $_SESSION['update'] = "<div class= 'error'>Failed to Update Menu Item. </div>";

                // Redirect
                header('location:' . HOME_URL . 'php/menu.php');
            }
        }
        ?>

    </form>

</div>

<?php include('partials/footer.php'); ?>