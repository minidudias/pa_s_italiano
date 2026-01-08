<?php 
require "connection.php";

$product=$_GET["p"];

$productresultset=Database::search("SELECT * FROM `product` WHERE `id`='".$product."'");
$product_num=$productresultset->num_rows;

if($product_num==1){
    
    $product_dt=$productresultset->fetch_assoc();
    $status=$product_dt["status_id"];

    if($status==1){

        Database::iud("UPDATE `product` SET `status_id`='2' WHERE `id`='".$product."'");
        echo("deactivated");

    }else if($status==2){
        Database::iud("UPDATE `product` SET `status_id`='1' WHERE `id`='".$product."'");
        echo("activated");
    }

}else{

    echo("Something Went Wrong! Please Try Again Later.");

}

?>