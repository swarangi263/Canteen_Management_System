<?php
include('../config/constants.php');

$college_id = $_POST['college_id'];

$search = $_POST['search'];


$sql = "SELECT menu_items.id, menu_items.name, menu_items.category_id, 
menu_items.image, menu_items.summary, menu_items.price, 
menu_items.availability, categories.name 
AS cat_name FROM menu_items 
JOIN categories ON menu_items.category_id = categories.id 
WHERE menu_items.college_id = $college_id AND (menu_items.name LIKE '$search%' OR menu_items.name LIKE '%$search' OR menu_items.name LIKE '%$search%') ";

$res = mysqli_query($conn, $sql);


if ($res){
    if (mysqli_num_rows($res) >0){
        $arr = array();
        $i = 0;
        
        while ($row = mysqli_fetch_assoc($res)) {
        
            $arr[$i]['id'] =  $row['id'];
            $arr[$i]['name'] =  $row['name'];
            $arr[$i]['image'] =  $row['image'];
            $arr[$i]['summary'] =  $row['summary'];
            $arr[$i]['price'] =  $row['price'];
            $arr[$i]['availability'] =  $row['availability'];
            $arr[$i]['catName'] = $row['cat_name'];
            $i++;
        }
        echo json_encode($arr);
    }
    else{
        echo json_encode("No Matches Found");
    }
}
else{
    echo json_encode("Something went wrong");
}