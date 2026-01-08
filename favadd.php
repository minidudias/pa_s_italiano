<?php 
session_start(); 
require "connection.php";

if(isset($_SESSION["logged-in-user"])){
    if(isset($_GET["id"])){
        $email=$_SESSION["logged-in-user"]["email"];
        $pid=$_GET["id"];

        $watchlist_rs=Database::search("SELECT * FROM `watchlist` WHERE `product_id`='".$pid."' AND
        `user_email`='".$email."'");

        $watchlist_n=$watchlist_rs->num_rows;

        if($watchlist_n==1){
            $watchlist_data=$watchlist_rs->fetch_assoc();
            $list_id=$watchlist_data["id"];

            Database::iud("DELETE FROM `watchlist` WHERE `id`='".$list_id."'");
            echo("Removed");
        }else{
            Database::iud("INSERT INTO `watchlist`(`user_email`,`product_id`) VALUES ('".$email."','".$pid."')");
            echo("Added");
        }
    }else{
        echo("Something Went Wrong!");
    }

}else{
    echo("Please Sign in First.");
}
?>