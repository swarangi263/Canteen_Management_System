<?php
include('../config/constants.php');

$user_id = $_POST['user_id'];
$college_id = $_POST['college_id'];
$total_price = $_POST['total_price']; //Total cost of the order

// Query to add the total into order lists table
$sql = "INSERT INTO order_lists(user_id,college_id,total_price) VALUES('$user_id','$college_id','$total_price')";

$res = mysqli_query($conn, $sql);

if ($res) {
    echo json_encode("Order placed");

    $order_id = mysqli_insert_id($conn); //id of the order being placed
    echo json_encode($order_id);

    //Query to get item details from cart
    $sql_c = "SELECT * FROM cart_items WHERE user_id = '$user_id' ";
    
    $res_c = mysqli_query($conn, $sql_c);
    if ($res_c) {

        while ($row_c = mysqli_fetch_assoc($res_c)) {

            $item_id = $row_c['item_id'];
            $price = $row_c['total_item_price'];
            $quantity = $row_c['quantity'];

            //Query to add the details of the order placed
            $sql_o = "INSERT INTO order_details(order_id,college_id,user_id,item_id,price,quantity) VALUES('$order_id', '$college_id', '$user_id', $item_id,'$price', '$quantity')";

            $res_o = mysqli_query($conn, $sql_o);
            if ($res_o) {

                //Query to remove the items from cart table after the order is placed
                $sql_d = "DELETE FROM cart_items WHERE user_id = '$user_id' AND item_id = '$item_id'";
                
                $res_d = mysqli_query($conn, $sql_d);
                if ($res_d) {
                    echo json_encode("Item deleted from cart");
                } else {
                    echo json_encode("Couldn't delete the item");
                }
            } else {
                echo json_decode("Couldn't add the details");
            }
        }
    } else {
        echo json_decode("Something went wrong");
    }
} else {
    echo json_encode("Couldn't place order");
}
