<?php include('partials/navbar.php'); ?>

<div class="main-content">
    <div class="wrapper">
        
    <h1>Add Category</h1>
        <br><br>

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
        <!-- Add  -->

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" placeholder="CategoryTitle" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <!-------------- Table to display existing categories will come here -------------------->
    </div>
</div>

<?php
include('partials/footer.php');
?>

<?php
        // process the value and save it in database
        // check whether the button is clicked or not

        if (isset($_POST['submit'])) {
           
            $name = $_POST['name'];

           
            $input = "INSERT INTO categories(name) VALUES ('$name')";

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
                header('location:' . HOME_URL . 'php/add-category.php');
            }
        }
        ?>