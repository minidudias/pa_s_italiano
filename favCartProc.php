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
            $qty=1;
            $cart_data=$cart_rs->fetch_assoc();
            $current_quantity=$cart_data["qty"];
            $new_quantity=(int)$current_quantity+$qty;
            Database::iud("UPDATE `cart` SET `qty`='".$new_quantity."' WHERE 
            `product_id`='".$pid."' AND `user_email`='".$email."'");
            
        }else{
            $cart_data=$cart_rs->fetch_assoc();
            $current_quantity=$cart_data["qty"];
            $new_quantity=(int)$current_quantity+$qty;
            Database::iud("UPDATE `cart` SET `qty`='".$new_quantity."' WHERE 
            `product_id`='".$pid."' AND `user_email`='".$email."'");
            
        }    
    }else{
        if($qty == ""){
            $qty=1;
            Database::iud("INSERT INTO `cart`(`user_email`,`product_id`,`qty`) VALUES ('".$email."','".$pid."','".$qty."')");
            
        }else{
            Database::iud("INSERT INTO `cart`(`user_email`,`product_id`,`qty`) VALUES ('".$email."','".$pid."','".$qty."')");
            
        }    
    }
       
    }else{
        echo("Something Went Wrong!");
    }

}else{
    echo("Please Sign in First.");
}

?>