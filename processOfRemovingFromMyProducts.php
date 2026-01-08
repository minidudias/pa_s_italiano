<?php 
require "connection.php"; 

if(isset($_GET["id"])){
    $prod_id=$_GET["id"];

    $prod_rs=Database::search("SELECT * FROM `product` WHERE `id`='".$prod_id."'");
    $prod_num=$prod_rs->num_rows;
    $prod_data=$prod_rs->fetch_assoc();

    if($prod_num==0){
        echo("Something went wrong. Please try again!");
    }else{
        Database::iud("DELETE FROM `images` WHERE `product_id`='".$prod_id."'");
        Database::iud("DELETE FROM `invoice` WHERE `product`='".$prod_id."'");
        Database::iud("DELETE FROM `watchlist` WHERE `product_id`='".$prod_id."'");
        Database::iud("DELETE FROM `cart` WHERE `product_id`='".$prod_id."'");
        Database::iud("DELETE FROM `feedback` WHERE `product_id`='".$prod_id."'");
        Database::iud("DELETE FROM `product` WHERE `id`='".$prod_id."'");

        echo("Removed");
    }
}else{
    echo("Please select a product.");
}

?>