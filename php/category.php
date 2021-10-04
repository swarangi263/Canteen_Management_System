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
            <th>Delete</th>
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
                    <td><img src="../img/<?php echo $image; ?>" alt=""></td>
                    <td>
                        <a href="delete-category.php?id=<?php echo $id; ?>&image=<?php echo $image; ?>">
                            <i class="fas fa-trash fa-lg"></i></a>
                    </td>
                </tr>

        <?php
                $i++;
            }
        }

        ?>

    </table>

</div>

<!-- <a href="#"><i class="fas fa-edit fa-lg"></i> </a> &nbsp;  -->
<?php include('partials/footer.php'); ?>