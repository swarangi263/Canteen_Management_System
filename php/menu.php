<?php include('partials/navbar.php'); ?>

<link rel="stylesheet" href="../css/menu.css">

<div class="title">
    <h1>Menu</h1>
</div>

<?php
if (isset($_SESSION['remove'])) {
    echo $_SESSION['remove'];
    unset($_SESSION['remove']);
}

if (isset($_SESSION['delete'])) {
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}
if(isset($_SESSION['no-category'])){
    echo $_SESSION['no-category'];
    unset($_SESSION['no-category']);
}
if(isset($_SESSION['update'])){
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}

if(isset($_SESSION['upload'])){
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}

if(isset($_SESSION['failed-remove'])){
    echo $_SESSION['failed-remove'];
    unset($_SESSION['failed-remove']);
}

if(isset($_SESSION['no-item'])){
    echo $_SESSION['no-item'];
    unset($_SESSION['no-item']);
}
?>

<div class="menutable">
    <table>
        <tr>
            <th>Sr No</th>
            <th>Item</th>
            <th>Category</th>
            <th>Image</th>
            <th>Summary</th>
            <th>Price</th>
            <th>Availability</th>
            <th>Edit</th>
        </tr>

        <?php

        $college_id = $_SESSION['clg_id'];

        $sql = "SELECT menu_items.id, menu_items.name, menu_items.category_id, 
        menu_items.image, menu_items.summary, menu_items.price, 
        menu_items.availability, categories.name 
        AS cat_name FROM menu_items 
        JOIN categories ON menu_items.category_id = categories.id 
        WHERE menu_items.college_id = $college_id;";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count==0){
            ?>
            
            <h2>Please Add Menu</h2>

            <?php
        }
        else{
            $i = 1;

        while ($row = mysqli_fetch_assoc($res)) {

            $id = $row['id'];
            $item = $row['name'];
            $category = $row['cat_name'];
            $image = $row['image'];
            $summary = $row['summary'];
            $price = $row['price'];
            // print_r($row);
            if ($row['availability'] == 1) {
                $availability = 'Available';
            } else {
                $availability = 'Not Available';
            }
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $item; ?></td>
                <td><?php echo $category; ?></td>
                <td><img src="../img/<?php echo $image; ?>" alt=""></td>
                <td><?php echo $summary; ?></td>
                <td><?php echo $price; ?></td>
                <td><?php echo $availability; ?></td>
                <td><a href="update-menu.php?id=<?php echo $id; ?>"><i class="fas fa-edit fa-lg"></i> </a> &nbsp; <a href="delete-menu.php?id=<?php echo $id; ?>&image=<?php echo $image; ?>"><i class="fas fa-trash fa-lg"></i></a></td>
            </tr>

        <?php
            $i++;
        }
        }

        ?>
    </table>

</div>

<?php include('partials/footer.php'); ?>