<?php 
session_start(); 
require "connection.php";

if(isset($_SESSION["logged-in-user"])){
    if(isset($_GET["pid"])){
        $email=$_SESSION["logged-in-user"]["email"];
        $pid=$_GET["pid"];
        $qty=$_GET["qty"];
        $cart_rs=Database::search("SELECT * FROM `cart` WHERE `product_id`='".$pid."'
    AND `user_email`='".$email."'");
    $cart_num=$cart_rs->num_rows;
    if($cart_num==1){      
        if($qty == ""){
            Database::iud("DELETE FROM `cart` WHERE `product_id`='".$pid."' AND `user_email`='".$email."'");
        }else{
            Database::iud("UPDATE `cart` SET `qty`='".$qty."' WHERE 
            `product_id`='".$pid."' AND `user_email`='".$email."'");
        }    
    }else{
        echo("This Product is Not in the Cart!");
    }
       
    }else{
        echo("Something Went Wrong!");
    }

}else{
    echo("Please Sign in First.");
}

?>