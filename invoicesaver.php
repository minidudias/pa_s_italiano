<?php
session_start();
require "connection.php";

if(isset($_SESSION["logged-in-user"])){
    $o_id=$_POST["o"];
    $p_id=$_POST["i"];
    $mail=$_POST["m"];
    $amount=$_POST["a"];
    $qty=$_POST["q"];

    // $product_rs=Database::search("SELECT * FROM `product` WHERE `id`='".$p_id."'");
    // $product_dat=$product_rs->fetch_assoc();

    // $curr_qty=$product_dat["qty"];
    // $updated_qty=$curr_qty-$qty;

    // Database::iud("UPDATE `product` SET `qty`='".$updated_qty."' WHERE `id`='".$p_id."'");

    $d=new DateTime();
    $tz=new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date=$d->format("Y-m-d H:i:s");

    if($qty == ""){

    Database::iud("INSERT INTO `invoice`(`order_id`,`date`,`total`,`qty`,`status`,`product`,`user`,`visible_to_user`) VALUES 
    ('".$o_id."','".$date."','".$amount."','1','0','".$p_id."','".$mail."','1')");
    }else{
        Database::iud("INSERT INTO `invoice`(`order_id`,`date`,`total`,`qty`,`status`,`product`,`user`,`visible_to_user`) VALUES 
    ('".$o_id."','".$date."','".$amount."','".$qty."','0','".$p_id."','".$mail."','1')");
    }

    echo("1");
}
?>