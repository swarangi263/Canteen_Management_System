<?php include('partials/unavbar.php'); ?>

<link rel="stylesheet" href="../css/menu.css">
<script src="../js/store.js" async></script>
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
if (isset($_SESSION['no-category'])) {
    echo $_SESSION['no-category'];
    unset($_SESSION['no-category']);
}
if (isset($_SESSION['update'])) {
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}

if (isset($_SESSION['upload'])) {
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}

if (isset($_SESSION['failed-remove'])) {
    echo $_SESSION['failed-remove'];
    unset($_SESSION['failed-remove']);
}

if (isset($_SESSION['no-item'])) {
    echo $_SESSION['no-item'];
    unset($_SESSION['no-item']);
}
?>

<div class="menutable">
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

    if ($count == 0) {
    ?>

        <h2>Please Add Menu</h2>

    <?php
    } else {
    ?>
        <table>
            <tr>
                
                <th>Item</th>
                
                <th>Image</th>
                
                <th>Price</th>
                
                <th>Edit</th>
            </tr>

            <?php
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
                    
                    <td><span class="shop-item-title"><?php echo $item; ?></span></td>
                    
                    <td><img class="shop-item-image" src="../img/<?php echo $image; ?>" alt=""></td>
                    
                    <td><span class="shop-item-price"><?php echo $price; ?></span></td>
                    
                    <td><button class="btn btn-primary shop-item-button" type="button">ADD TO CART</button>
                    </td>
                </tr>

        <?php
                $i++;
            }
        }

        ?>
        </table>
        
</div>
<section class="container content-section">
            <h2 class="section-header">CART</h2>
            <div class="cart-row">
                <span class="cart-item cart-header cart-column">ITEM</span>
                <span class="cart-price cart-header cart-column">PRICE</span>
                <span class="cart-quantity cart-header cart-column">QUANTITY</span>
            </div>
            <div class="cart-items">
            </div>
            <div class="cart-total">
                <strong class="cart-total-title">Total</strong>
                <span class="cart-total-price">$0</span>
            </div>
            <button class="btn btn-primary btn-purchase" type="button">PURCHASE</button>
</section>
<?php include('partials/footer.php'); ?>