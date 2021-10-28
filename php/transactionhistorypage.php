<?php

use function PHPSTORM_META\type;

include('../php/partials/unavbar.php');
?>
<link rel="stylesheet" href="../css/dashboard.css">
<div class="wrapper">
    <div class="title1">
        <h1>Order History</h1>
        <?php

        if (isset($_SESSION['login'])) {

            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>

    </div>

    <div class="menutable">


        <?php

        $college_id = $_SESSION['clg_id'];

        $sql = "SELECT  order_lists.id, order_lists.user_id, users.contact, 
        GROUP_CONCAT(menu_items.name) AS items ,  order_lists.total_price, 
        order_lists.payment_id, order_lists.payment_status, order_lists.order_status, 
        order_lists.time_stamp 
        FROM order_lists JOIN order_details ON 
        order_lists.id = order_details.order_id JOIN menu_items 
        ON order_details.item_id=menu_items.id JOIN users ON 
        order_lists.user_id = users.id WHERE order_lists.college_id = $college_id 
        GROUP BY order_lists.id ORDER BY order_lists.id DESC";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);
        if ($count == 0) {
        ?>
            <h2>No Past Orders</h2>
           
        <?php
        } else {

        ?>
            <table>
                <tr>

                    <th>Sr No.</th>
                    <th>Order Id</th>
                    <th>Order Item</th>
                    <th>Total Cost</th>

                    <th>Payment Id</th>


                    <th>Timestamp</th>
                </tr>

                <?php
                $i = 1;

                while ($row = mysqli_fetch_assoc($res)) {
                    // print_r($row);

                    $order_id = $row['id'];
                    $user_id = $row['user_id'];
                    $user_contact = $row['contact'];
                    $items = $row['items'];
                    $total = $row['total_price'];
                    $payment_id = $row['payment_id'];
                    $payment_status = $row['payment_status'];
                    $order_status = $row['order_status'];
                    $time_stamp = $row['time_stamp'];

                ?>

                    <tr>
                        <td><?php echo $order_id; ?></td>
                        <td><a href="#" onclick="mydetails(this)"><?php echo $order_id; ?></a></td>
                        <td>
                            <ul>
                            <?php 
                                $items = explode(",",$items);
                                foreach ($items as $item){
                                    ?>
                                    <li><?php echo $item; ?></li>
                                    <?php
                                }
                            ?>
                            </ul>
                    </td>
                        <td><?php echo $total; ?></td>

                        <td><?php echo $payment_id; ?></td>
                        
                        <td><?php echo $time_stamp; ?></td>
                    </tr>

            <?php
                    $i++;
                }
            }
            ?>
            </table>
    </div>
    <div class="hoverbutton" id="u_order">
        <a href="umenu.php" target="_blank" title="Order Now" class="float"><i class="fas fa-plus"></i></a>
    </div>
</div>
<script>
    function mydetails(x) {
        console.log(x.innerText);
        var id = x.innerText;

        // <?php

            // $sql = "SELECT menu_items.name, order_details.price, order_details.quantity FROM order_details JOIN menu_items ON order_details.item_id = menu_items.id WHERE order_details.order_id = $id; ";

            // $res = mysqli_query($conn, $sql);

            // while ($row = mysqli_fetch_assoc($res)) {

            //     $name = $row['name'];
            //     $price = $row['price'];
            //     $quantity = $row['quantity'];
            //     echo "Im in";
            //     print_r($row);
            // }
            // 
            ?>
    }
</script>

<?php
include('../php/partials/footer.php');
?>